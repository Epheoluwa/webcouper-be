<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    

    public function Register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return new JsonResponse([
                'status' => 422,
                'message' => $validator->errors()
            ], 422);
        }

        $data = [
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        User::create($data);
        return new JsonResponse([
            'status' => 201,
            'message' => 'User Account Successfully Created'
        ], 201);
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            

            // Check if the user is active before creating the token
            if (!$user->is_active) {
                return new JsonResponse([
                    'status' => 401,
                    'message' => 'User is not active',
                ], 401);
            }
            $token = $user->createToken('auth_token')->plainTextToken;
            return new JsonResponse([
                'status' => 201,
                'message' => 'Login Successfully',
                'token' => $token
            ], 201);
        }
        return new JsonResponse([
            'status' => 401,
            'message' => 'Invalid login credentials',
        ], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return new JsonResponse([
            'status' => 201,
            'message' => 'Logged out successfully',
        ], 201);
    }


    public function activate($username)
    {
        User::where('username', $username)->update(['is_active' => true]);

        return new JsonResponse([
            'status' => 201,
            'message' => 'User activated',
        ], 201);
    }
    
    public function deactivate(Request $request)
    {
        $request->user()->update(['is_active' => false]);
        $request->user()->tokens()->delete();

        return new JsonResponse([
            'status' => 201,
            'message' => 'User deactivated',
        ], 201);
    }
}
