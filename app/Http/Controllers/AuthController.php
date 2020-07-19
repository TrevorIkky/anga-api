<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function login(Request $request)
    {
        if (!$this->loginValidation($request)->fails()) {
            if (Auth::attempt([
                "username" => $request['username'],
                "password" => $request['password']
            ])) {
                //login success full
                return response()
                    ->json([
                        'message' => 'Successfull login',
                        'user_id' => Auth::id(),
                        'access_token' =>  Auth::user()->createToken('auth_token')->accessToken
                    ]);
            } else {
                return response()
                    ->json(['message' => 'Invalid credentials. Enter a valid email and password and try again'], 403);
            }
        }
    }

    public function register(Request $request)
    {
        $validator = $this->registerValidation($request);
        if (!$validator->fails()) {
            $created =   User::create([
                'username' => $request['username'],
                'password' => Hash::make($request['password'])
            ]);
            if ($created) {
                return response()
                    ->json(['message' => 'Registered successfully!'], 200);
            } else {
                return response()
                    ->json(['message' => 'Something went wrong, please try again'], 500);
            }
        } else {
            return response()
                ->json(['message' => $validator->errors()], 422);
        }
    }

    public function userExists(Request $request)
    {
        $validator = Validator::make($request->all(), ['username' => 'required|min:4']);
        if (!$validator->fails()) {
            $user =  User::where('username', 'LIKE', '%{$request[\'username\']%')->limit(1)->get();
            if ($user) {
                return response()->json(['result' => true], 200);
            } else {
                return response()->json(['result' => false], 200);
            }
        } else {
            return response()->json(['result' => false], 200);
        }
    }

    public function loginValidation(Request $request)
    {
        return Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|min:8'
        ]);
    }

    public function registerValidation(Request $request)
    {
        return Validator::make($request->all(), [
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8'
        ]);
    }
}
