<?php

namespace App\Http\Controllers\authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $attribute = $request->validate([
            'email'    => 'required|string|email',
            'username'  => 'required|string|unique:users| min:3| max:30',
            'name'     => 'nullable|string',
            'password' => 'required|string',
        ]);

        $user = User::create($attribute)->assignRole('client')->load('roles');;

        return Response::json($user)->setStatusCode(201);

    }

}
