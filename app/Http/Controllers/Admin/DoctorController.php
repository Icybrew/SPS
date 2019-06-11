<?php

namespace SPS\Http\Controllers\Admin;

use Illuminate\Http\Request;
use SPS\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;

use SPS\User;
use SPS\UserRole;
use SPS\Role;
use SPS\ExtraInfoDoctor;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Role::where('name', '=', config('roles.name.doctor'))->first()->users;
        return view('admin.doctors.index', compact('doctors'));
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

        return view('admin.doctors.create');
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
            'specialization' => 'required',
        ]);

        // Creating new user
        $doctor = new User;
        $doctor->name = $request->firstname . ' ' . $request->lastname;
        $doctor->email = $request->email;
        $doctor->password = Hash::make($request->password);
        $doctor->save();

        $extraInfo = new ExtraInfoDoctor;
        $extraInfo->doctor_id = $doctor->id;
        $extraInfo->specialization = $request->specialization;
        $extraInfo->save();

        // Assigning doctor role for newly created user
        $userRole = new UserRole;
        $userRole->user_id = $doctor->id;
        $userRole->role_id = Role::where('name', '=', config('roles.name.doctor'))->first()->id;
        $userRole->save();

        return redirect()->route('admin.doctors.index')->with('success', 'New user with doctor role has been created');
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
        $doctor = User::with('extraInfoDoctor')->whereHas('roles', function ($q) {
            $q->where('name', 'Doctor');
        })->where('id', '=', $id)->firstOrFail();

        // Authorizing action
        $this->authorize('view', $doctor);

        return view('admin.doctors.doctor', compact('doctor'));
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
        $doctor = User::with('extraInfoDoctor')->whereHas('roles', function ($q) {
            $q->where('name', 'Doctor');
        })->where('id', '=', $id)->firstOrFail();

        // Authorizing action
        $this->authorize('update', $doctor);

        return view('admin.doctors.edit', compact('doctor'));
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
        $doctor = User::with('extraInfoDoctor')->whereHas('roles', function ($q) {
            $q->where('name', 'Doctor');
        })->where('id', '=', $id)->firstOrFail();

        // Authorizing action
        $this->authorize('update', $doctor);

        // Validating data
        $request->validate([
            'name' => 'required|string',
            'password' => 'sometimes|nullable|string|min:4|max:255|confirmed',
            'specialization' => 'required|string'
        ]);

        // Updating user details
        $doctor->name = $request->name;
        if ($request->password != NULL) {
            $doctor->password = Hash::make($request->password);
        }
        $doctor->save();

        // Updating user extra details
        $doctor->extraInfoDoctor->specialization = $request->specialization;
        $doctor->extraInfoDoctor->save();

        return view('admin.doctors.doctor', compact('doctor'))->with('success', 'User has been updated');
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
        $doctor = User::with('extraInfoDoctor')->whereHas('roles', function ($q) {
            $q->where('name', 'Doctor');
        })->where('id', '=', $id)->firstOrFail();

        // Authorizing action
        $this->authorize('delete');

        // Deleting user
        $doctor->delete();

        return view('admin.doctors.index')->with('success', 'User has been deleted');
    }
}
