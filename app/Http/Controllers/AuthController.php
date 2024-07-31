<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        $validateData = $request->validated();
        $validateData['password'] = bcrypt($validateData['password']);
        $user = User::create($validateData);
        $token = auth('api')->login($user);
        return $this->respondWithToken($token);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->orWhere('mobile', $request->mobile)->first();



        $credentials = $request->only('email', 'password');
        if (!$token = $this->guard()->attempt($credentials)) {
            $credentials = $request->only('username', 'password');
            if (!$token = $this->guard()->attempt($credentials)) {
                $credentials = $request->only('mobile', 'password');
                if (!$token = $this->guard()->attempt($credentials)) {
                    return response()->json(['error' => 'Unauthorized'], 401);
                }
                // return $this->respondWithToken($token);
            }
            // return $this->respondWithToken($token);
        }


        $request->validate([
            'email' => 'required_without_all:mobile,username|string|email',
            'mobile' => 'required_without_all:email,username|string',
            'username' => 'required_without_all:email,mobile|string',
        ]);
        $user = User::where('email', $request->email)
            ->orWhere('mobile', $request->mobile)
            ->orWhere('username', $request->username)
            ->first();
        if (!$user || (!$user->email_verified_at && !$user->mobile_verified_at)) {
            return response()->json(['error' => 'Unverified'], 401);
        }
        return $this->respondWithToken($token);
    }


    public function me()
    {
        return response()->json($this->guard()->user());
    }

    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }


    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer'
        ]);
    }

    public function guard()
    {
        return Auth::guard('api');
    }
}
