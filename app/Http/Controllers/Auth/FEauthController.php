<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FEauthController extends Controller
{
    public function index()
    {
        return view('Auth/Registration');
    }

    public function loginRoute()
    {
        return view('Auth/Login');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first());
        }

        $data = [
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        try {
            User::create($data);
            return redirect()->route('login')->with('success', 'Registration successful');
        } catch (\Exception $e) {
            return back()->with('error', 'Unexpected error while creating account');
        }
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first());
        }

        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->email)->first();
        if($user['is_active'])
        {
            if (Auth::attempt($credentials)) {
                return redirect()->route('/')->with('success', 'Login successful');
            } else {
                return back()->with('error', 'Invalid credentials');
            }
        }else{
            return back()->with('error', 'Deactivated accounts cannot login. Please reach out to the administrator');
        }
     
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Logout successful');
    }

    public function deactivate()
    {
        $id = Auth::user()->id;
        User::whereId($id)->update(['is_active' => false]);
        return redirect('/login')->with('success', 'Deactivite successful');
    }

}
