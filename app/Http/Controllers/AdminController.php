<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function dashboard()
    {
        $user = Auth::user(); // Get the logged-in user
        $companyName = $user->company ? $user->company->name : 'No Company Assigned';

        // Fetch users associated with the admin's company (exclude super_admins)
        $users = User::where('company_id', $user->company_id)
                      ->where('role', '!=', 'super_admin')
                      ->get();

        // Count users in the company
        $totalUsers = $users->count();

        return view('dashboard', compact('companyName', 'users', 'totalUsers'));
    }


    /**
     * Display all users associated with the admin's company.
     */
    public function index()
    {
        $users = User::where('company_id', Auth::user()->company_id)
                     ->where('role', '!=', 'super_admin') // Exclude super admins
                     ->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form to create a new user.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        // Validate user input, no need to validate company_id as it's auto-filled
        $request->validate([
            'username' => 'required|unique:users,username',
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:employee,finance,manager,storekeeper',
        ]);

        // Get the admin's company ID
        $company_id = Auth::user()->company_id;

        // Create the user and associate with the admin's company
        User::create([
            'username' => $request->username,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'company_id' => $company_id, // Use the admin's company ID here
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    /**
     * Show the form to edit an existing user's details.
     */
    public function edit(User $user)
    {
        // Ensure the user being edited belongs to the same company
        if ($user->company_id !== Auth::user()->company_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('users.edit', compact('user'));
    }

    /**
     * Update an existing user's details.
     */
    public function update(Request $request, User $user)
    {
        // Ensure the user being updated belongs to the same company
        if ($user->company_id !== Auth::user()->company_id) {
            abort(403, 'Unauthorized action.');
        }
    
        // Validate updated input, excluding the current user from uniqueness checks
        $request->validate([
            'username' => 'required|unique:users,username,' . $user->user_id . ',user_id',
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->user_id . ',user_id',
            'role' => 'required|in:employee,finance,manager,storekeeper',
        ]);
    
        // Update the user
        $user->update($request->only('username', 'full_name', 'email', 'role'));
    
        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }
    public function showProfile()
{
    $user = Auth::user(); // Get the logged-in user
    return view('users.profile', compact('user'));
}

    /**
     * Delete a user.
     */
    public function destroy(User $user)
    {
        // Ensure the user being deleted belongs to the same company
        if ($user->company_id !== Auth::user()->company_id) {
            abort(403, 'Unauthorized action.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}
