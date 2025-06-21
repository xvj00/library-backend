<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $data = $request -> validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        $user = User::create($data);
        return response()->json(['message'=>'User created successfully','user'=>$user]);
    }
    public function update(Request $request, $id)
    {
        $data = $request -> validate([
            'password' => 'nullable|string',
            'role' => 'required|string',
        ]);
        $user = User::find($id);

        if ($user->role === Role::ADMIN->value) {
            return response()->json(['message' => 'Admin cannot be updated'], 403);
        } else {
            if (!empty($data['password'])) {
                $data['password'] = bcrypt($data['password']);
            } else{
                unset($data['password']);
            }
            $user->update($data);
            return response()->json(['message'=>'User updated successfully', 'user'=>$user]);
        }

    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user->role === Role::ADMIN->value) {
            return response()->json(['message' => 'Admin cannot be deleted'], 403);
        } else {
            $user->delete();
            return response()->json(['message'=>'User deleted successfully']);
        }
    }
    public function restore($id)
    {
        User::withTrashed()->find($id)->restore();
       return response()->json(['message'=>'User restored successfully']);
    }

    public function forceDelete($id)
    {
        User::withTrashed()->find($id)->forceDelete();
        return response()->json(['message'=>'User Force deleted successfully']);
    }
}
