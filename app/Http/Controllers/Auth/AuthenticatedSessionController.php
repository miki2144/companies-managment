<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; // Ensure you import the correct Request class
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authenticate the user without "remember me" functionality
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            // Redirect based on user role
            $user = Auth::user();

            if ($user->role === 'superadmin') {
                return redirect()->intended('dashboards/superadmin'); 
            } elseif ($user->role === 'admin') {
                return redirect()->intended('dashboards/admin'); 
            } elseif ($user->role === 'manager') {
                return redirect()->intended('dashboards/manager'); 
            } elseif ($user->role === 'finance') { // Corrected spelling
                return redirect()->intended('dashboards/finance'); 
            } elseif ($user->role === 'storekeeper') { // Corrected spelling
                return redirect()->intended('dashboards/storekeeper'); 
            } elseif ($user->role === 'employee') {
                return redirect()->intended('dashboards/employee'); 
            } else {
                return redirect('/login');
            }
            
        }

        // If authentication fails, redirect back with an error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}