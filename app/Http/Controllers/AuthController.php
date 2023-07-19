<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // buat function signup
    public function signUp(Request $request)
    {
        // create user baru
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'picture' => env('AVATAR_GENERATOR_URL') . $request['name'],
        ]);
        // autentikasi user dengan token
        $token = auth()->login($user);
        // jika tokennya tidak ada(response gagal)
        if (!$token) {
            return response()->json([
                'meta' => [
                    'code' => 500,
                    'status' => 'error',
                    'message' => 'Cannot add user.',
                ],
                'daata' => [],
            ], 500);
        }
        // jika tokennya ada(response berhasil)
        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Cannot Created successfully.',
            ],
            'daata' => [
                'user'=> [
                    'name' => $user->name,
                    'email' => $user->email,
                    'picture' => $user->picture,
                ],
                'access_token'=> [
                    'token' => $token,
                    'type' => 'Bearer',
                    'expires_in' => strtotime('+'.auth()->factory()->getTTL().' minutes'),
                ]
            ],
        ]);
    }
}
