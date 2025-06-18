<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->all();
        $user = User::create($data);
        $token = $user->createToken('main')->plainTextToken;
        Auth::login($user);
        return response()->json(['token' => $token, 'user' => $user]);
    }

    public function login(Request $request)
    {
        $data = $request->all();
        if (Auth::attempt($data)) {
            $token = Auth::user()->createToken('main')->plainTextToken;
            return response()->json(['token' => $token, 'user' => Auth::user()]);
        }
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}
