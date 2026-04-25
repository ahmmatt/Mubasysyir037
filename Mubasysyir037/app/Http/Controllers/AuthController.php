<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validasi Input dasar
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cek Autentikasi
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            // Membuat Token berbasis Sanctum
            $token = $user->createToken('API-TOKEN')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Login Berhasil',
                'data' => [
                    'user' => $user,
                    'token' => $token
                ]
            ]);
        }

        // Standar Respon Error jika gagal login
        return response()->json([
            'success' => false,
            'message' => 'Email atau Password salah'
        ], 401);
    }
}
