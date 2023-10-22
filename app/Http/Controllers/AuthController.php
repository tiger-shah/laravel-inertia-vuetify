<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function register(UserRequest $request): \Illuminate\Http\RedirectResponse
    {
        $credentials = $request->validated();
        $credentials['password'] = Hash::make($credentials['password']);

        $user = User::create($credentials);

        Auth::login($user);

        return to_route('account.dashboard');
    }

    public function login(UserRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            return to_route('account.dashboard');
        } else {
            return back()->with('error_message', 'Your input data is incorrect!');
        }
    }

    public function logout(): \Illuminate\Http\RedirectResponse
    {
        if (Auth::check()) {
            Auth::logout();
        }

        return to_route('login');
    }
}
