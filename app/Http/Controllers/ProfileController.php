<?php

namespace SPS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;

use SPS\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        return view('profile.index', compact('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('profile.profile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();

        return view('profile.edit', compact('user'));
    }

    public function editPassword($id)
    {
        $user = Auth::user();

        return view('profile.edit-password', compact('user'));
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
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'birthday' => 'required|date',
            'password' => 'required'
        ]);

        if (Hash::check($request->password, Auth::user()->password)) {
            Auth::user()->firstname = $request->firstname;
            Auth::user()->lastname = $request->lastname;
            Auth::user()->birthday = $request->birthday;
            Auth::user()->save();
            return redirect()->route('profile.index')->with('success', 'Profile has been updated');
        } else {
            return redirect()->back()->withErrors(new MessageBag(['password' => 'Incorrect password']));
        }
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password_old' => 'required|min:4|max:255',
            'password_new' => 'required|confirmed',
        ]);

        if (Hash::check(($request->password_old), Auth::user()->password)) {
            Auth::user()->password = Hash::make($request->password_new);
            Auth::user()->save();
            return redirect()->route('profile.index')->with('success', 'Password has been changed');
        } else {
            return redirect()->back()->withErrors(new MessageBag(['password_old' => 'Incorrect password']));
        }
    }

}
