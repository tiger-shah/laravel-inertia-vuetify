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

    public function showUsers(Request $request) {
        $page = (int) ($request->page ?? 1);
        $perPage = $request->per_page ?? 10;

        $query = User::select('*');

        if ($search = $request->search){
            $query->where(function($q) use ($search) {
                $q
                    ->where('first_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $search . '%');
            });
        }

        $countItems = $query->count();

        $items = $query->forPage($page, 10)->get()
            ->each(function (object $user, int $key) {
                $user->gender = $user->gender ? User::data('Genders')->getName($user->gender) : null;
            });

        return Inertia::render('Account/Users', [
            'items'         => $items->toArray(),
            'items_count'   => $countItems,
            'page_current'  => $page,
//            'pages_total'   => ceil($countItems / $perPage),
            'per_page'      => $perPage,
        ]);
    }
}
