<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        // Fetch users based on the admin's company
        $users = (Auth::user()->role === 'superadmin')
            ? User::all() // Superadmin can see all users
            : User::where('company_id', Auth::user()->company_id)->get(); // Admin sees only their company's users

        return view('users.index', compact('users')); // Pass data to the view
    }

    public function create()
    {
        return view('users.create'); // Show the form for creating a new user
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:employee,finance,manager,storekeeper', // Limit roles
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.create')
                ->withErrors($validator)
                ->withInput();
        }

        User::create([
            'username' => $request->username,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'company_id' => Auth::user()->company_id, // Assign to the same company
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user')); // Show the form for editing a user
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->user_id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:employee,finance,manager,storekeeper', // Limit roles
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.edit', $user->user_id)
                ->withErrors($validator)
                ->withInput();
        }

        $user->username = $request->username;
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->role = $request->role;
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete(); // Delete the user
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}