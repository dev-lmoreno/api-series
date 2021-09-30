<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TokenController extends Controller
{
    public function generateToken(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email);

        if (is_null($user 
            || !Hash::check($request->password, $user->password))
        ) {
            return response()->json('Invalid User or Password', 401);
        }

        $token = JWT::encode(
            ['email' => $request->email], 
            env('JWT_KEY')
        );

        return [
            'access_token' => $token
        ];
    }
}
