<?php

namespace SPS\Http\Controllers\Admin;

use Illuminate\Http\Request;
use SPS\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;

use SPS\User;

use SPS\Role;
use SPS\UserRole;

use SPS\ExtraInfoPharmacist;

class PharmacistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pharmacists = Role::where('name', '=', config('roles.name.pharmacist'))->first()->users()->paginate(config('admin.paginate.pharmacist.index'));
        return view('admin.pharmacists.index', compact('pharmacists'));
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

        return view('admin.pharmacists.create');
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
            'workplace' => 'required|string|starts_with:VŠĮ,UAB,AB,MB',
            'birthday' => 'sometimes|nullable|date|before_or_equal:' . date('Y-m-d'),
            'password' => 'required|confirmed',
        ]);

        // Creating new user
        $pharmacist = new User;
        $pharmacist->firstname = $request->firstname;
        $pharmacist->lastname = $request->lastname;
        $pharmacist->email = $request->email;
        if ($request->birthday !== NULL) {
            $pharmacist->birthday = $request->birthday;
        }
        $pharmacist->password = Hash::make($request->password);
        $pharmacist->save();

        // Creating extra info
        $extraInfo = new ExtraInfoPharmacist;
        $extraInfo->pharmacist_id = $pharmacist->id;
        $extraInfo->workplace = $request->workplace;
        $extraInfo->save();

        // Assigning pharmacist role for newly created user
        $userRole = new UserRole;
        $userRole->user_id = $pharmacist->id;
        $userRole->role_id = Role::where('name', '=', config('roles.name.pharmacist'))->first()->id;
        $userRole->save();

        return redirect()->route('admin.pharmacists.index')->with('success', 'New pharmacist has been added');
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
        $pharmacist = User::with('extraInfoPharmacist')->whereHas('roles', function ($q) {
            $q->where('name', config('roles.name.pharmacist'));
        })->where('id', '=', $id)->firstOrFail();

        // Authorizing action
        $this->authorize('view', $pharmacist);

        return view('admin.pharmacists.pharmacist', compact('pharmacist'));
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
        $pharmacist = User::with('extraInfoPharmacist')->whereHas('roles', function ($q) {
            $q->where('name', config('roles.name.pharmacist'));
        })->where('id', '=', $id)->firstOrFail();

        // Authorizing action
        $this->authorize('update', $pharmacist);

        return view('admin.pharmacists.edit', compact('pharmacist'));
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
        $pharmacist = User::with('extraInfoPharmacist')->whereHas('roles', function ($q) {
            $q->where('name', config('roles.name.pharmacist'));
        })->where('id', '=', $id)->firstOrFail();

        // Authorizing action
        $this->authorize('update', $pharmacist);

        // Validating data
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'workplace' => 'required|string|starts_with:VŠĮ,UAB,AB,MB',
            'birthday' => 'sometimes|nullable|date|before_or_equal:' . date('Y-m-d'),
            'password' => 'sometimes|nullable|min:4|max:255|confirmed',
        ]);

        // Updating user details
        $pharmacist->firstname = $request->firstname;
        $pharmacist->lastname = $request->lastname;
        if ($request->password !== NULL) {
            $pharmacist->password = Hash::make($request->password);
        }
        if ($request->birthday !== NULL) {
            $pharmacist->birthday = $request->birthday;
        }
        $pharmacist->save();

        // Updating user extra details
        if ($pharmacist->extraInfoPharmacist !== NULL) {
            $pharmacist->extraInfoPharmacist->workplace = $request->workplace;
            $pharmacist->extraInfoPharmacist->save();
        } else {
            $extraInfoPharmacist = new ExtraInfoPharmacist;
            $extraInfoPharmacist->pharmacist_id = $pharmacist->id;
            $extraInfoPharmacist->workplace = $request->workplace;
            $extraInfoPharmacist->save();
        }

        return redirect()->route('admin.pharmacists.show', $pharmacist->id)->with('success', 'Pharmacist has been updated');
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
        $pharmacist = User::with('extraInfoPharmacist')->whereHas('roles', function ($q) {
            $q->where('name', config('roles.name.pharmacist'));
        })->where('id', '=', $id)->firstOrFail();

        // Authorizing action
        $this->authorize('delete', $pharmacist);

        // Deleting user
        $pharmacist->delete();

        return view('admin.pharmacists.index')->with('success', 'Pharmacist has been deleted');
    }
}
