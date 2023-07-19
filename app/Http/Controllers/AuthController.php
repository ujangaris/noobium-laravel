<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\SignUpRequest;

class AuthController extends Controller
{
    // buat function signup
    public function signUp(SignUpRequest $request)
    {
        // validattion
            $validated = $request->validated();
        // create user baru
        $user = User::create([
            'name' => $validated['name'],//pasang request validation
            'email' => $validated['email'],//pasang request validation
            'password' => bcrypt($validated['password']),//pasang request validation
            'picture' => env('AVATAR_GENERATOR_URL') . $validated['name'],//pasang request validation
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
            'data' => [
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
