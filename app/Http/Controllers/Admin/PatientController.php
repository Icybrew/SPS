<?php

namespace SPS\Http\Controllers\Admin;

use Illuminate\Http\Request;
use SPS\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;

use SPS\User;

use SPS\Role;
use SPS\UserRole;

use SPS\ExtraInfoPatient;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Role::where('name', '=', config('roles.name.patient'))->first()->users()->paginate(config('admin.paginate.patients.index'));
        return view('admin.patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Authorizing action
        $this->authorize('create', User::class);

        return view('admin.patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Authorizing actions
        $this->authorize('create', User::class);
        $this->authorize('create', UserRole::class);

        // Validating data
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'ssn' => 'required|integer|digits:11',
            'birthday' => 'required|date|before_or_equal:' . date('Y-m-d'),
        ]);

        // Creating new user
        $patient = new User;
        $patient->firstname = $request->firstname;
        $patient->lastname = $request->lastname;
        $patient->email = $request->email;
        $patient->password = Hash::make($request->password);
        $patient->birthday = $request->birthday;
        $patient->save();

        // Creating extra info
        $extraInfo = new ExtraInfoPatient;
        $extraInfo->patient_id = $patient->id;
        $extraInfo->ssn = $request->ssn;
        $extraInfo->save();

        // Assigning patient role for newly created user
        $userRole = new UserRole;
        $userRole->user_id = $patient->id;
        $userRole->role_id = Role::where('name', '=', config('roles.name.patient'))->first()->id;
        $userRole->save();

        return redirect()->route('admin.patients.index')->with('success', 'New patient has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Getting user with required role
        $patient = User::with('extraInfoPatient')->whereHas('roles', function ($q) {
            $q->where('name', config('roles.name.patient'));
        })->where('id', '=', $id)->firstOrFail();

        // Authorizing action
        $this->authorize('view', $patient);

        return view('admin.patients.patient', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Getting user with required role
        $patient = User::with('extraInfoPatient')->whereHas('roles', function ($q) {
            $q->where('name', config('roles.name.patient'));
        })->where('id', '=', $id)->firstOrFail();

        // Authorizing action
        $this->authorize('update', $patient);

        return view('admin.patients.edit', compact('patient'));
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
        // Getting user with required role
        $patient = User::with('extraInfoPatient')->whereHas('roles', function ($q) {
            $q->where('name', config('roles.name.patient'));
        })->where('id', '=', $id)->firstOrFail();

        // Authorizing action
        $this->authorize('update', $patient);

        // Validating data
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'password' => 'sometimes|nullable|min:4|max:255|confirmed',
            'ssn' => 'required|integer|digits:11',
            'birthday' => 'sometimes|nullable|date|before_or_equal:' . date('Y-m-d'),
        ]);

        // Updating user details
        $patient->firstname = $request->firstname;
        $patient->lastname = $request->lastname;
        if ($request->password !== NULL) {
            $patient->password = Hash::make($request->password);
        }
        if ($request->birthday !== NULL) {
            $patient->birthday = $request->birthday;
        }
        $patient->save();

        // Updating user extra details
        if ($patient->extraInfoPatient !== NULL) {
            $patient->ssn = $request->ssn;
            $patient->extraInfoPatient->save();
        } else {
            $extraInfoPatient = new ExtraInfoPatient;
            $extraInfoPatient->patient_id = $patient->id;
            $extraInfoPatient->ssn = $request->ssn;
            $extraInfoPatient->save();
        }

        return redirect()->route('admin.patients.show', $patient->id)->with('success', 'Patient has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Getting user with required role
        $patient = User::with('extraInfoPatient')->whereHas('roles', function ($q) {
            $q->where('name', config('roles.name.patient'));
        })->where('id', '=', $id)->firstOrFail();

        // Authorizing action
        $this->authorize('delete');

        // Deleting user
        $patient->delete();

        return view('admin.patients.index')->with('success', 'Patient has been deleted');
    }
}
