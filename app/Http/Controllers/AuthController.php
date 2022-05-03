<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function user(Request $request){
        return ['user' => $request->user()];  //'token' => $request->user()->currentAccessToken()
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        //check if password correct
        if(!$user || !Hash::check($request->password, $user->password))
            return response(['status' => 'login failed'], 401);

        if($user->rank >= 2)  //上校特權
            $token = $user->createToken('tasksToken', ['check-confidential'])->plainTextToken;
        else
            $token = $user->createToken('tasksToken', ['check-nomal'])->plainTextToken;
        return ['token' => $token];
    }
}
