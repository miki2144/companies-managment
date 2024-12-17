<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route(Auth::user()->role . '.dashboard');
        }
        return redirect('/login');
    }

    public function superadminDashboard()
    {
        if (!Auth::check() || !Auth::user()->hasRole('superadmin')) {
            return redirect('/login');
        }
        
        // Fetch total number of admins and companies
        $totalAdmins = User::where('role', 'admin')->count();
        $totalCompanies = Company::count();
        
        // Pass the variables to the view
        return view('superadmin.dashboard', compact('totalAdmins', 'totalCompanies'));
    }

    public function showCreateAdmin()
    {
        $companies = Company::all(); // Fetch all registered companies
        return view('superadmin.createuser', compact('companies'));
    }

    // Store the new admin
    public function createAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users', // Validate username
            'email' => ['required', 'email', 'max:255', Rule::unique('users')],
            'password' => 'required|string|min:8|confirmed',
            'company_id' => ['required', 'exists:companies,company_id'], // Validate that the selected company exists
        ]);

        // Enable query log for debugging
        DB::enableQueryLog();

        // Create the admin user
        User::create([
            'name' => $request->name,
            'username' => $request->username, // Include username
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin', // Set the role explicitly
            'company_id' => $request->company_id,
        ]);

        // Debug: Log the database query and check the data being inserted
        dd(DB::getQueryLog());  // Show the SQL queries executed

        return redirect()->route('superadmin.dashboard')->with('success', 'Admin created successfully!');
    }

    public function showCreateCompany()
    {
        return view('superadmin.createcompany');
    }

    public function createCompany(Request $request)
{
    $request->validate([
        'name' => ['required', 'string', 'max:255', Rule::unique('companies')],
        'country' => 'required|string',
        'city' => 'required|string',
        'contact_email' => ['required', 'email', 'max:255'],
        'contact_phone' => 'required|string',
    ]);

    // Create a new company using the validated data
    Company::create([
        'name' => $request->name,
        'country' => $request->country,
        'city' => $request->city,
        'contact_email' => $request->contact_email,
        'contact_phone' => $request->contact_phone,
        'created_by' => Auth::id(),
    ]);

    return redirect()->route('superadmin.dashboard')->with('success', 'Company created successfully!');
}

  

    public function createUser(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => ['required', 'email', Rule::unique('users')],
            'password' => 'required|string|min:8|confirmed',
            'company_id' => ['required', 'exists:companies,company_id', 'unique:users,company_id'],
        ]);
    
        // Enable query log for debugging
        DB::enableQueryLog();
    
        User::create([
            'full_name' => $request->full_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'company_id' => $request->company_id,
        ]);
    
        // Log the database query for debugging
        // dd(DB::getQueryLog()); // Only for debugging
    
        return redirect()->route('superadmin.dashboard')->with('success', 'User created successfully!');
    }
    public function showCreateUser()
    {
        $companies = Company::all();
        return view('superadmin.createuser', compact('companies'));
    }
    public function adminDashboard()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/login');
        }

        $totalUsers = User::where('company_id', Auth::user()->company_id)->count();
        $users = User::where('company_id', Auth::user()->company_id)->get();

        return view('dashboards.admin', compact('totalUsers', 'users'));
    }

    public function financeDashboard()
    {
        if (!Auth::check() || Auth::user()->role !== 'finance') {
            return redirect('/login');
        }
    
        // Finance Dashboard
        $user = Auth::user();
        $company = $user->company;
    
        // Get all users within the company excluding finance, manager, and storekeeper roles if necessary
        $users = User::where('company_id', $company->company_id)
                     ->where('role', '!=', 'super_admin') // Optionally exclude other roles like 'super_admin'
                     ->get();
    
        return view('dashboards.finance', compact('user', 'company', 'users'));
    }
    public function managerDashboard()
    {
        if (!Auth::check() || Auth::user()->role !== 'manager') {
            return redirect('/login');
        }

        $user = Auth::user();
        $company = $user->company;

        // Fetching data for the dashboard
        // $requests = DB::table('requests')->where('company_id', $company->company_id)->get();
        // $plansAndReports = DB::table('plans_and_reports')->where('company_id', $company->company_id)->get();
        // $archivedDocs = DB::table('archived_documents')->where('company_id', $company->company_id)->get();
        // $inventories = DB::table('inventories')->where('company_id', $company->company_id)->get();
        // $budgetForecasts = DB::table('budgets')->where('company_id', $company->company_id)->get();

        // Passing data to the view
        return view('dashboards.manager', compact(
            'user', 'company'
        ));
        /////, 'requests', 'plansAndReports', 'archivedDocs', 'inventories', 'budgetForecasts'
    }
    public function storekeeperDashboard()
{
    if (!Auth::check() || Auth::user()->role !== 'storekeeper') {
        return redirect('/login');
    }

    $user = Auth::user();
    $company = $user->company;

    // Fetch inventory details or any other relevant information
    $inventories = DB::table('inventory')->where('managed_by', $user->id)->get();

    return view('dashboards.storekeeper', compact('user', 'company', 'inventories'));
}
public function employeeDashboard()
{
    if (!Auth::check() || Auth::user()->role !== 'employee') {
        return redirect('/login');
    }

    $user = Auth::user();
    $company = $user->company;

    // Example: Fetch tasks, attendance, or other employee-specific data
    // $tasks = DB::table('tasks')->where('assigned_to', $user->id)->get();
    // $attendanceRecords = DB::table('attendance')->where('user_id', $user->id)->get();

    // // Example metrics for display
    // $completedTasks = $tasks->where('status', 'completed')->count();
    // $pendingTasks = $tasks->where('status', 'pending')->count();

    return view('dashboards.employee', compact('user', 'company'));
    ////, 'tasks', 'attendanceRecords', 'completedTasks', 'pendingTasks'
}

    
}
