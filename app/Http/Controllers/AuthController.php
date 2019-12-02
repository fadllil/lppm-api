<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function login(Request $request){
        $username = $request->input('username');
        $password_hash = $request->input('password_hash');

        $user = User::where('username', $username)->first();

        if (Hash::check($password_hash, $user->password_hash)){
            $apiToken = base64_encode(str_random(40));

            $user->update([
                'api_token' => $apiToken
            ]);

            return response()->json([
                'error' => false,
                'message' => 'Login Berhasil!',
                'data' => [
                    'user' => $user,
                    'api_token' => $apiToken
                ]
            ], 201);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Login Gagal!',
                'data' => ''
            ]);
        }
    }
}
