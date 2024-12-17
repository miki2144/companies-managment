<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SuperAdminController extends Controller
{
    public function superadminDashboard()
    {
        // Check for authorization.  Middleware is a better approach.
        if (!Auth::check() || !Auth::user()->hasRole('superadmin')) {
            return redirect('/login');
        }
        return view('superadmin.dashboard'); //You need to create this view.
    }

    public function createCompany(Request $request)
    {
        // Authorization check should be here, not in superadminDashboard
        if (!Auth::check() || !Auth::user()->hasRole('superadmin')) {
            return redirect('/login');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('companies')],
            'country' => 'required',
            'city' => 'required',
            'contact_email' => ['required', 'email', 'max:255'],
            'contact_phone' => 'required',
        ]);

        Company::create($request->all());
        return redirect()->route('superadmin.create-user')->with('success', 'Company created successfully!');
    }

    public function createUser(Request $request)
    {
        // Authorization check should be here, not in superadminDashboard
        if (!Auth::check() || !Auth::user()->hasRole('superadmin')) {
            return redirect('/login');
        }

        $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')],
            'password' => 'required',
            'company_id' => ['required', 'exists:companies,id'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'company_id' => $request->company_id,
        ]);

        return redirect()->route('superadmin.create-user')->with('success', 'User created successfully!');
    }

    public function showCreateUser()
    {
        // Authorization check should be here, not in superadminDashboard
        if (!Auth::check() || !Auth::user()->hasRole('superadmin')) {
            return redirect('/login');
        }

        $companies = Company::all();
        return view('superadmin.createuser', compact('companies'));
    }

    public function showCreateCompany()
    {
        // Authorization check should be here, not in superadminDashboard
        if (!Auth::check() || !Auth::user()->hasRole('superadmin')) {
            return redirect('/login');
        }

        return view('superadmin.createcompany');
    }
}