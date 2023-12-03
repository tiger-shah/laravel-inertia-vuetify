<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AccountController extends Controller
{
    /**
     * @return Response
     */
    public function showSetting(): \Inertia\Response
    {
        return Inertia::render('Account/Settings', [
            'genders'   => User::data('Genders')->pluck('name')->toArray(),
        ]);
    }

    /**
     * @param UserRequest $request
     * @return RedirectResponse
     */
    public function updateSetting(UserRequest $request): \Illuminate\Http\RedirectResponse
    {
        if( Auth::user()->update($request->validated()) ) {
            return back()->with('success_message', 'Setting updated successfully.');
        } else {
            return back()->with('error_message', 'Something went wrong!');
        }
    }
}
