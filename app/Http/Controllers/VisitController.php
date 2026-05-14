<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Visit;
use App\Notifications\VisitPageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if(Auth::guest()){
            $request->validate([
                'ip_address' => 'required|ip',
                'country_code' => 'required|string|max:5',
                'uag' => 'nullable|string',
                'date' => 'required|string',
            ]);
            $visit = Visit::create($request->only(['ip_address', 'country_code', 'uag', 'date']));
            if ($visit) {
                $request->session()->put('ip_address', $visit->ip_address);
                User::first()->notify(new VisitPageNotification($visit));
    
                return response()->json(['status' => 'succeed']);
            }
    
            return response()->json(['status' => 'failed']);
        }
    }
}