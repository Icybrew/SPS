<?php

namespace SPS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

use SPS\User;

use SPS\PatientPrescription;
use SPS\PatientPrescriptionPurchase;

use SPS\MedicalSubstance;
use SPS\MeasurementUnit;

class PrescriptionController extends Controller
{

    public function __construct() {

        // Making sure user is logged in.
        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($patient_id = NULL)
    {
        // Checking if request if for specific patient
        if ($patient_id !== NULL) {

            // Getting patient with prescriptions
            $patient = User::with(['prescriptions.doctor', 'prescriptions.patient', 'prescriptions.medicalSubstance', 'prescriptions.measurementUnit'])->findOrFail($patient_id);

            // Checking if current user can view patients prescriptions
            $this->authorize('viewPrescriptions', $patient);

            // Getting prescription list from patient, ordered by expiration date, nulls at top
            $prescriptions = $patient->prescriptions()->orderByRaw('-expires_at asc')->paginate();

            // Returning view with patient & prescriptions
            return view('patients.prescriptions.index', compact('patient', 'prescriptions'));
        } else {

            // Getting current users prescriptions, ordered by expiration date, nulls at top
            $prescriptions = User::with(['prescriptions.doctor', 'prescriptions.patient', 'prescriptions.medicalSubstance', 'prescriptions.medicalSubstance.measurementUnit'])->find(Auth::user()->id)->prescriptions()->orderByRaw('-expires_at asc')->paginate();

            // Returning view with patient & prescriptions
            return view('patients.prescriptions.index', compact('patient', 'prescriptions'));
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
        // Getting specific prescription with additional relations
        $prescription = PatientPrescription::with(['doctor', 'patient', 'medicalSubstance', 'measurementUnit', 'purchases', 'purchases.pharmacist'])
                ->where('patient_id', '=', $patient_id)
                ->findOrFail($prescription_id);

        // Checking if current user can view specific prescription
        $this->authorize('view', $prescription);

        // Getting patient from prescription relation
        $patient = $prescription->patient;

        // Returning view with patient & prescription
        return view('patients.prescriptions.prescription', compact('patient', 'prescription'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($patient_id)
    {
        // Checking if current user can create prescription
        $this->authorize('create', PatientPrescription::class);

        // Getting user with extraInfoPatient who has patient role
        $patient = User::with('extraInfoPatient')->whereHas('roles', function ($q) {
            $q->where('name', config('roles.name.patient'));
        })->where('id', '=', $patient_id)->firstOrFail();

        // Getting all medical substances
        $substances = MedicalSubstance::all();

        // Getting all measurement units
        $measurementUnits = MeasurementUnit::all();

        // Returning view with patient, substances & measurement units
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
        // Checking if current user can create prescription
        $this->authorize('create', PatientPrescription::class);

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

        // Returning back with success message
        return redirect()->route('patients.prescriptions.index', $patient_id)->with('success', 'New prescription added');
    }

    public function purchase(Request $request, $patient_id, $prescription_id)
    {
        // Validating data
        $request->validate([
            'purchase' => 'required|nullable|'
        ]);

        // Checking if current user can add purchase to the prescription
        $this->authorize('create', PatientPrescriptionPurchase::class);

        // Getting prescription
        $prescription = PatientPrescription::where('patient_id', '=', $patient_id)->where('id', '=', $prescription_id)->exists();

        // Checking if prescription is valid
        if ($prescription) {
            // Creating new purchase
            $purchase = new PatientPrescriptionPurchase;
            $purchase->pharmacist_id = Auth::user()->id;
            $purchase->patient_prescription_id = $prescription_id;

            // Saving new purchase
            $purchase->save();

            // Returning back with success message
            return redirect()->back()->with('success', 'Purchase added');
        } else {
            return redirect()->back()->withErrors(new MessageBag(['prescription' => 'Invalid prescription']));
        }
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
