<?php

namespace SPS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use SPS\User;
use SPS\PatientPrescription;
use SPS\MedicalSubstance;
use SPS\MeasurementUnit;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($patient_id = NULL)
    {
        // Checking if request if for specific patient
        if ($patient_id !== NULL) {
            // Getting patient with prescription relation
            $patient = User::with(['prescriptions.doctor', 'prescriptions.patient', 'prescriptions.medicalSubstance', 'prescriptions.measurementUnit'])->findOrFail($patient_id);

            // Getting prescription list from patient
            $prescriptions = $patient->prescriptions()->orderByRaw('-expires_at asc')->paginate();

            return view('patients.prescriptions.index', compact('patient', 'prescriptions'));
        } else {
            $prescriptions = User::with(['prescriptions.doctor', 'prescriptions.patient', 'prescriptions.medicalSubstance', 'prescriptions.medicalSubstance.measurementUnit'])->find(Auth::user()->id)->prescriptions()->orderByRaw('-expires_at asc')->paginate();

            return 'WIP';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($patient_id, $prescription_id)
    {
        // Getting specific prescription with relations
        $prescription = PatientPrescription::with(['doctor', 'patient', 'medicalSubstance', 'measurementUnit', 'purchases', 'purchases.pharmacist'])->findOrFail($prescription_id);

        // Getting patient from prescription relation
        $patient = $prescription->patient;

        return view('patients.prescriptions.prescription', compact('patient', 'prescription'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($patient_id)
    {
        // Getting user with extraInfoPatient who has patient role
        $patient = User::with('extraInfoPatient')->whereHas('roles', function ($q) {
            $q->where('name', config('roles.name.patient'));
        })->where('id', '=', $patient_id)->firstOrFail();

        // Getting all medical substances
        $substances = MedicalSubstance::all();

        // Getting all measurement units
        $measurementUnits = MeasurementUnit::all();

        return view('patients.prescriptions.create', compact('patient', 'substances', 'measurementUnits'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $patient_id)
    {
        // Validating data
        $request->validate([
            'expiration' => 'sometimes|nullable|date',
            'medicine' => 'required|numeric|exists:medical_substances,id',
            'amount' => 'required|numeric',
            'unit' => 'required|numeric|exists:measurement_units,id',
            'description' => 'required|string'
        ]);

        // Creating new prescription
        $prescription = new PatientPrescription;

        $prescription->doctor_id = Auth::user()->id;
        $prescription->patient_id = $patient_id;
        $prescription->medical_substance_id = $request->medicine;
        $prescription->substance_in_dose = $request->amount;
        $prescription->measurement_unit_id = $request->unit;
        $prescription->description = $request->description;

        // Saving new prescription
        $prescription->save();
        
        return redirect()->route('patients.prescriptions.index', $patient_id)->with('success', 'New prescription added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
