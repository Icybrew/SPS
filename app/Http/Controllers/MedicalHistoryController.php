<?php

namespace SPS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use SPS\User;
use SPS\PatientMedicalHistory;

class MedicalHistoryController extends Controller
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
    public function index($id = NULL)
    {
        // Checking if request is for specific user
        if ($id !== NULL) {

            // Getting patient with medical history
            $patient = User::with('medicalHistory')->findOrFail($id);

            // Checking if current user can view patients medical history
            $this->authorize('viewMedicalHistory', $patient);
            
            // Getting medical history from patient, ordered by visit date
            $medicalHistory = $patient->medicalHistory()->orderBy('visited_at', 'desc')->paginate();

            // Returning view with patient & medical history
            return view('patients.medical-history.index', compact('patient', 'medicalHistory'));
        } else {

            // Getting current users medical history, ordered by visit date
            $medicalHistory = Auth::user()->medicalHistory()->with('doctor')->orderBy('visited_at', 'desc')->paginate();

            // Returning view with medical history
            return view('medical-history.index', compact('medicalHistory'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($patient_id, $medical_history_id)
    {
        // Getting specific entry from medical history with patient
        $entry = PatientMedicalHistory::with('patient')->where('patient_id', '=', $patient_id)->findOrFail($medical_history_id);

        // Checking if current user can view specific medical history entry
        $this->authorize('view', $entry);

        // Getting patient from entry
        $patient = $entry->patient;

        // Returning view with patient & medical history entry
        return view('patients.medical-history.entry', compact('patient', 'entry'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($patient_id)
    {
        // Checking if current user can create new medical history entry
        $this->authorize('create', PatientMedicalHistory::class);

        // Getting user with extraInfoPatient who has patient role
        $patient = User::with('extraInfoPatient')->whereHas('roles', function ($q) {
            $q->where('name', config('roles.name.patient'));
        })->where('id', '=', $patient_id)->firstOrFail();

        // Returning view with patient
        return view('patients.medical-history.create', compact('patient'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $patient_id)
    {
        // Checking if current user can create new medical history entry
        $this->authorize('create', PatientMedicalHistory::class);
        
        // Validating data
        $request->validate([
            'disease_code' => 'required|regex:/^[a-zA-Z]{1}/',
            'description' => 'required',
            'duration' => 'required|numeric',
        ]);

        // Creating new entry
        $entry = new PatientMedicalHistory;

        $entry->patient_id = $patient_id;
        $entry->doctor_id = Auth::user()->id;
        $entry->disease_code = $request->disease_code;
        $entry->description = $request->description;
        $entry->visit_duration = $request->duration;
        $entry->visit_compensated = $request->has('compensated');
        $entry->visit_repeated = $request->has('repeated');

        // Saving new entry
        $entry->save();

        // Returning back with success message
        return redirect()->route('patients.medical-history.index', $patient_id)->with('success', 'New entry added');
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
