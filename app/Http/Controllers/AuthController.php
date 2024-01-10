<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

//    public function __construct()
//    {
//        return $this->middleware('auth:sanctum');
//    }

    /**
     * @throws ValidationException
     */
    public function login(LoginRequest $request)
    {
        $user = User::query()->where('email', $request->email)->first();
//        dd($user);
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        return $this->success("",
        ['token' => $user->createToken($request->email)->plainTextToken
        ]);

//        return $user->createToken($request->email)->plainTextToken;
    }


    public function register(Request $request)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
