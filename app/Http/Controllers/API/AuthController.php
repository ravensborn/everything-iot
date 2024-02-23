<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function createToken() {

        request()->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', request()->email)->first();

        if (! $user || ! Hash::check(request()->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'The provided credentials are incorrect.',
                'data' => [],
            ], 401);
        }

        if(\request()->email != 'yad@gmail.com') {
            return response()->json([
                'status' => false,
                'message' => 'You do not have permission to create tokens.',
                'data' => [],
            ], 401);
        }

        $token =  $user->createToken(request()->device_name)->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Successfully created new token',
            'data' => [
                'token' => $token,
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email
                ],
            ],
        ]);
    }

}
