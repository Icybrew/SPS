<?php

namespace SPS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use SPS\User;
use SPS\PatientMedicalHistory;

class MedicalHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = NULL)
    {
        //if ($id !== NULL) {
        $patient = User::with('medicalHistory')->findOrFail($id);
        $medicalHistory = $patient->medicalHistory()->orderBy('visited_at', 'desc')->paginate();
        return view('patients.medical-history.index', compact('patient', 'medicalHistory'));
//        } else {
//            $medicalHistory = Auth::user()->medicalHistory()->with('doctor')->orderBy('visited_at', 'desc')->paginate();
//            return view('medical-history.index', compact('medicalHistory'));
//        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($patient_id, $medical_history_id)
    {
        $entry = PatientMedicalHistory::with('patient')->findOrFail($medical_history_id);
        $patient = $entry->patient;

        return view('patients.medical-history.entry', compact('entry', 'patient'));
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
