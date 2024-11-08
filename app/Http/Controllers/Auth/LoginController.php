<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            // Check the user role and redirect accordingly
            switch ($user->role->name) {
                case 'superadmin':
                    Toastr::success('Welcome, Superadmin!', 'Success');
                    return redirect()->route('superadmin.dashboard');
                case 'guest':
                    Toastr::success('Welcome, Guest!', 'Success');
                    return redirect()->route('guest.dashboard');
                case 'admin':
                    Toastr::success('Welcome, Admin!', 'Success');
                    return redirect()->route('admin.dashboard');
                case 'cashpower_operator':
                    Toastr::success('Welcome, Cashpower Operator!', 'Success');
                    return redirect()->route('cashpower_operator.dashboard');
                case 'customer_service':
                    Toastr::success('Welcome, Customer Service!', 'Success');
                    return redirect()->route('customer_service.dashboard');
                case 'customer':
                    Toastr::success('Welcome, Customer!', 'Success');
                    return redirect()->route('customer.dashboard');
                case 'technician':
                    Toastr::success('Welcome, Technician!', 'Success');
                    return redirect()->route('technician.dashboard');
                default:
                    Auth::logout();
                    Toastr::error('Your account role is not recognized. Please contact support.', 'Login Failed');
                    return redirect()->route('login');
            }
        }

        // Toastr error message for invalid credentials
        Toastr::error('Invalid email or password. Please try again.', 'Login Failed');
        return back()->withInput($request->only('email'));
    }

    public function logout()
    {
        Auth::logout();
        Toastr::success('Logout successful!', 'Success');
        return redirect()->route('login');
    }
}