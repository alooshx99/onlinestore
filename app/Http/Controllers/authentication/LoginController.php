<?php

namespace App\Http\Controllers\authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username'    => 'required_with:email | string | exists:users',
            'email'       => 'required_with:username | string | email | exists:users',
            'password'    => 'required | string',
        ]);

        $user = User::where('email', $request->email)->orWhere('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'Message' => ['The provided credentials are incorrect.'],
            ]);
        }

        $data = [
            'token' => $user->createToken('token')->plainTextToken
        ];

        return Response::json($data)->setStatusCode(201);
    }

}
