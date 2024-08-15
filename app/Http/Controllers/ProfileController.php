<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;

// class ProfileController extends Controller
// {
//     public function show()
//     {
//         $user = Auth::user();
//         return view('profile', compact('user'));
//     }

//     public function update(Request $request)
//     {
//         $request->validate([
//             'email' => 'required|email|unique:users,email,' . Auth::id(),
//             'password' => 'nullable|min:8|confirmed',
//         ]);

//         $user = Auth::user();
//         $user->email = $request->email;
        
//         if ($request->filled('password')) {
//             $user->password = Hash::make($request->password);
//         }

//         $user->save();

//         return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
//     }
// }

