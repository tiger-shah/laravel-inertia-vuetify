<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        $share_data = [];

        if (Auth::check()) {
            $user = Auth::user();
            $user->gender = $user->gender ? User::data('Genders')->getName($user->gender) : null;

            $share_data['user'] = $user->toArray();

            $share_data['user']['roles'] = $user->roles->pluck('name');
        }

        if ($message = $request->session()->get('error_message')) {
            $share_data['message']['type']= 'error';
            $share_data['message']['text']= $message;
        }

        if ($message = $request->session()->get('success_message')) {
            $share_data['message']['type']= 'success';
            $share_data['message']['text']= $message;
        }

        return array_merge(parent::share($request), $share_data);
    }
}
