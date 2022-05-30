<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // return dd($request);
        // Get request data
        $userData = [
            'first_name'    => $request->input('first_name'),
            'last_name'     => $request->input('last_name'),
            'full_name'     => $request->input('full_name'),
            'email'         => $request->input('email'),
            'password'      => Hash::make($request->input('password')),
        ];

        // Define rules
        $rules = ['email' => 'unique:users'];

        // Create validator
        $validator = Validator::make($userData, $rules);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Email sudah terdaftar pada sistem'
            ], 400);
        }

        // Create new user
        $user = User::create($userData);

        // Check if user created successfully
        if ($user) {
            return response()->json([
                'success' => 'Registrasi akun berhasil!'
            ], 200);
        }

        // Error handling
        return response()->json([
            'error' => 'Registrasi akun gagal!'
        ], 400);
    }
}
