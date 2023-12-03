<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
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

        return Inertia::render('Admin/Users', [
            'items'         => $items->toArray(),
            'items_count'   => $countItems,
            'page_current'  => $page,
            'per_page'      => $perPage,
        ]);
    }
}
