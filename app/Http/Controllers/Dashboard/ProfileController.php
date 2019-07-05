<?php

namespace App\Http\Controllers\Dashboard;

use App\Rules\CurrentPasswordRule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('dashboard.profile.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,'.auth()->id()
        ]);

        auth()->user()->update($request->all());

        return back()->with('status', __('Profile successfully updated.'));
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'old_password' => ['required', 'min:3', new CurrentPasswordRule()],
            'password' => ['required', 'min:6', 'confirmed', 'different:old_password'],
            'password_confirmation' => ['required', 'min:6'],
        ]);

        auth()->user()->update([
            'password' => Hash::make($request->input('password'))
        ]);

        return back()->with('status', __('Password successfully updated.'));
    }
}
