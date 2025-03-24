<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowDashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = auth()->user()->load('profile');
        return view('dashboard', [
            'user' => $user,
            'profile' => $user->profile->loadCount(['experiences', 'competences', 'educations', 'portfolios']),
        ]);
    }
}
