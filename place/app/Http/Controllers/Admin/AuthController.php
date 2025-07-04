<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Debug: Check if admin exists
        $admin = Admin::where('email', $request->email)->first();
        
        if (!$admin) {
            return back()->withErrors([
                'email' => 'No admin account found with this email address.',
            ])->withInput($request->only('email'));
        }

        // Debug: Check password
        if (!Hash::check($request->password, $admin->password)) {
            return back()->withErrors([
                'email' => 'The password is incorrect.',
            ])->withInput($request->only('email'));
        }

        // Login admin menggunakan guard khusus
        Auth::guard('admin')->login($admin);
        
        // Clear any existing user session
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }
        
        $request->session()->regenerate();
        
        return redirect()->route('admin.dashboard')
            ->with('success', 'Welcome back, ' . $admin->full_name . '!');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'You have been logged out successfully.');
    }
}
