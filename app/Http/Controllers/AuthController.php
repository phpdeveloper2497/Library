<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use function PHPUnit\Framework\isFalse;

class AuthController extends Controller
{
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
            ['token' => $user->createToken($request->email)->plainTextToken]);

    }
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this->success('User logged out');
    }

    public function register(RegisterRequest $request, )
    {

    $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);
        $user->assignRole('librarian');

        if ($request->hasFile('photo'))
        {
            $path = $request->file('photo')->store('users/'.$user->id,'public');
            $user->photo()->create([
                'full_name' => $request->file('photo')->getClientOriginalName(),
                'path'=> $path,
            ]);

        }
        auth()->login($user);

        $token = $user->createToken($request->email)->plainTextToken;
        return $this->success('user registered',$token);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
//        if(auth()->user()->hasRole('user:delete'))
//        {
//            $user = User::find($id);
//            $user->delete();
////        return auth()->user()->remove($id);
//        }
    }

    public function restore()
    {
//        dd('ok');
//        Gate::authorize('user:restore');
////        $restore =User::withTrashed()->find($user->id)->restore();
//
//        $restore = User::withTrashed()
//            ->where('id', 7)
//            ->restore();
//        return $this->success('user restored',$restore);


    }
}
