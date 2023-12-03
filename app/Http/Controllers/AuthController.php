<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class AuthController extends Controller
{
    const RegisterFields = [
        'email',
        'first_name',
        'last_name',
        'birthday',
        'gender',
        'password'
    ];

    public function registerShow(): \Inertia\Response
    {
        return Inertia::render('Auth/Register', [
            'genders'   => User::data('Genders')->pluck('name')->toArray(),
        ]);
    }

    public function registerStepOne(UserRequest $request): \Illuminate\Http\RedirectResponse
    {
        Session::forget(self::RegisterFields);

        session([
            'email' => $request->validated()['email'],
        ]);

        return back();
    }

    public function registerStepTwo(UserRequest $request): \Illuminate\Http\RedirectResponse
    {
        session([
            'first_name'    => $request->validated()['first_name'],
            'last_name'     => $request->validated()['last_name'],
            'gender'        => $request->validated()['gender'],
            'birthday'      => $request->validated()['birthday'],
        ]);

        return back();
    }

    public function registerStepThree(UserRequest $request): \Illuminate\Http\RedirectResponse
    {
        session([
            'password'  => $request->validated()['password'],
        ]);

        foreach (self::RegisterFields as $field) {
            if (! session($field)) {
                return back()->withErrors('There is something wrong with the ' . $field . ' field.');
            }
        }

        $user = User::create([
            'first_name'    => session('first_name'),
            'last_name'     => session('last_name'),
            'email'         => session('email'),
            'birthday'      => session('birthday'),
            'gender'        => session('gender'),
            'password'      => Hash::make(session('password')),
        ]);

        Auth::login($user);

        Session::forget(self::RegisterFields);

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
