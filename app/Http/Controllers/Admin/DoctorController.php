<?php

namespace SPS\Http\Controllers\Admin;

use Illuminate\Http\Request;
use SPS\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;

use SPS\User;

use SPS\Role;
use SPS\UserRole;

use SPS\Specialization;
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
        $doctors = Role::where('name', '=', config('roles.name.doctor'))->first()->users()->paginate(config('admin.paginate.doctors.index'));
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

        // Getting specialization list for view
        $specializations = Specialization::all();

        return view('admin.doctors.create', compact('specializations'));
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
            'specialization' => 'required_without:customSpecialization|nullable|integer|exists:Specializations,id',
            'customSpecialization' => 'required_without:specialization|nullable|string|min:1|max:191|unique:specializations,name',
        ]);

        // Creating new user
        $doctor = new User;
        $doctor->firstname = $request->firstname;
        $doctor->lastname = $request->lastname;
        $doctor->email = $request->email;
        $doctor->password = Hash::make($request->password);
        $doctor->save();

        // Creating extra info
        $extraInfo = new ExtraInfoDoctor;
        $extraInfo->doctor_id = $doctor->id;
        if ($request->specialization !== NULL) {
            $extraInfo->specialization_id = $request->specialization;
        } elseif ($request->customSpecialization !== NULL) {
            $specialization = new Specialization;
            $specialization->name = $request->customSpecialization;
            $specialization->save();
            $extraInfo->specialization_id = $specialization->id;
        }
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

        // Getting specialization list for view
        $specializations = Specialization::all();

        return view('admin.doctors.edit', compact('doctor', 'specializations'));
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
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'password' => 'sometimes|nullable|string|min:4|max:255|confirmed',
            'specialization' => 'required_without:customSpecialization|nullable|integer|exists:Specializations,id',
            'customSpecialization' => 'required_without:specialization|nullable|string|min:1|max:191|unique:specializations,name',
        ]);

        // Updating user details
        $doctor->firstname = $request->firstname;
        $doctor->lastname = $request->lastname;
        if ($request->password != NULL) {
            $doctor->password = Hash::make($request->password);
        }
        $doctor->save();

        // Updating user extra details
        if ($doctor->extraInfoDoctor !== NULL) {
            if ($request->specialization !== NULL) {
                $doctor->extraInfoDoctor->specialization_id = $request->specialization;
            } else if ($request->customSpecialization !== NULL) {
                $specialization = new Specialization;
                $specialization->name = $request->customSpecialization;
                $specialization->save();
                $doctor->extraInfoDoctor->specialization_id = $specialization->id;
            }

            $doctor->extraInfoDoctor->save();
        } else {
            $extraInfoDoctor = new ExtraInfoDoctor;
            $extraInfoDoctor->doctor_id = $doctor->id;
            if ($doctor->specialization !== NULL) {
                $extraInfoDoctor->specialization_id = $request->specialization;
            } else if ($request->customSpecialization !== NULL) {
                $specialization = new Specialization;
                $specialization->name = $request->customSpecialization;
                $specialization->save();
                $extraInfoDoctor->specialization_id = $specialization->id;
            }

            $extraInfoDoctor->save();
        }

        return redirect()->route('admin.doctors.show', $doctor->id)->with('success', 'User has been updated');
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
