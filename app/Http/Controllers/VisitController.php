<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Notifications\VisitPageNotification;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'ip_address' => 'required|ip',
            'country_code' => 'required|string|max:5',
            'uag' => 'nullable|string',
            'date' => 'required|string',
        ]);
        $visit = Visit::create($request->only(['ip_address', 'country_code', 'uag', 'date']));
        if($visit){
            $visit->notify(new VisitPageNotification());
            
            return response()->json(['status' => 'succeed']);
        }
        return response()->json(['status' => 'failed']);
    }
}