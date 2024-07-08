<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user(); // Get the authenticated user
        return view('profile.edit', compact('user'));

    }

    public function update(ProfileUpdateRequest $request)
    {
        $user = User::find(auth()->user()->id);

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        return back()->with('success', 'Profile updated successfully.');
    }
}