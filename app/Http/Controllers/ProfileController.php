<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($request->user()->id),
            ]


        ]);
        $request->user()->update($data);
        return response()->json(['message' => 'Profile updated successfully']);

    }

    public function passwordUpdate(Request $request)
    {
        $data = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'confirmed', 'string', 'min:8'],
        ]);

        $request->user()->update([
            'password' => $data['password'],
        ]);
        
        return response()->json(['message' => 'Password updated successfully']);
    }


    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        $user->currentAccessToken()->delete();
        $user->forceDelete();

        return response()->json(['message' => 'Account deleted successfully']);

    }
}
