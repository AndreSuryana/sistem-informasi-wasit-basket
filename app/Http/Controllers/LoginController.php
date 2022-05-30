<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        // Set remember value
        $remember = false;
        
        if ($request->has('remember')) {
            $remember = true;
        }

        // Init validator
        $validator = Validator::make($request->all(), [
            'email'      => 'required|email',
            'password'   => ['required', Password::min(6)->letters()->numbers()],
        ]);
            
        // If validator fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Get validated credentials
        $credentials = $validator->validated();

        // Attempt login
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']], $remember)) {
            $request->session()->regenerate();
            return response()->json([
                'data' => ['user_id' => Auth::id()],
                'success' => 'Akun berhasil masuk!'
            ], 200);
        } else {
            return response()->json(['error' => 'Email atau password salah!'], 400);
        }

        // Error handling
        return response()->json(['error' => 'Terjadi kesalahan pada server!'], 400);
    }

    public function logout(Request $request)
    {
        // Logout from auth session
        Auth::logout();

        // Clear session token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Return
        return response()->json(['success' => 'Logout berhasil!'], 200);
    }
}
