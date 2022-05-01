<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login(){
        $user = User::findOrFail(1);
        $token = $user->createToken('tasksToken')->plainTextToken;
        return ['token' => $token];
    }
}
