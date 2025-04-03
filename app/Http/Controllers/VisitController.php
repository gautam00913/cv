<?php

namespace App\Http\Controllers;

use App\Models\Visit;
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
        return response()->json(['status' => $visit ? 'succeed' : 'failed']);
    }
}
