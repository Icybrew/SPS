<?php

namespace SPS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use SPS\User;
use SPS\MeasurementUnit;
use SPS\MedicalSubstance;
use SPS\PatientPrescription;
use SPS\PatientPrescriptionPurchase;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Getting prescriptions with medical substances and measurement units
        $prescriptions = User::with(['prescriptions.doctor', 'prescriptions.patient', 'prescriptions.medicalSubstance', 'prescriptions.medicalSubstance.measurementUnit'])->find(Auth::user()->id)->prescriptions()->orderByRaw('-expires_at asc')->paginate();
        return view('prescriptions.index', compact('prescriptions'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Getting prescription with medical substance and measurement unit
        $prescription = PatientPrescription::with(['doctor', 'patient', 'medicalSubstance', 'medicalSubstance.measurementUnit', 'purchases', 'purchases.pharmacist'])->findOrFail($id);
        return view('prescriptions.prescription', compact('prescription'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
