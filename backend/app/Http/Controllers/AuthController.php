<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Cookie;


class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $credential = $request->only('username', 'password');

        if(!Auth::Attempt($credential))
        {
            return response()->json([
                'status' => false,
                'message' => 'Username dan Password Tidak Terdaftar'
            ]);
        }

        $user = $request->user();
        $token = $user->createToken('Sistem Informasi UPJ Token')->accessToken;
        $cookie = $this->getCookieDetails($token);
        //$token->save();

        return response()->json([
            'status' => true,
            'message' => 'Username ditemukan',
            'user' => $user,
        ])->cookie(
            $cookie['name'],
            $cookie['value'],
            $cookie['minutes'],
            $cookie['path'],
            $cookie['domain'],
            $cookie['secure'],
            $cookie['httponly'],
            $cookie['samesite']
        );
    }
    public function getUser(Request $request){
        return response()->json([
            'status' => true,
            'user' => $request->user()
        ]);
    }

    public function getCookieDetails($token){
        return [
            'name' => 'token',
            'value' => $token,
            'minutes' => 180,
            'path' => null,
            'domain' => null,
            'secure' => null,
            'httponly'=> true,
            'samesite' => true
        ];
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        $cookie = Cookie::forget('token');
        return response()->json([
            'status' => true,
            'message' => 'successful-logout'
        ])->withCookie($cookie);
    }
}
