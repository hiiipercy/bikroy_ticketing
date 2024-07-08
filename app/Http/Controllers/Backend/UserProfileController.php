<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user(); // Get the authenticated user
        return view('backend.modules.profile.edit', compact('user'));

    }

    public function update(Request $request)
    {
        $user = auth()->user();

        // Validate incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'required',
            // Add more fields as needed
        ]);

        // Update user information
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        // Update other fields as needed

        // $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }
}
