<?php

namespace App\Http\Controllers;

use App\Http\Resources\PortfolioResource;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if($lang = $request->input('locale')){
            app()->setLocale($lang);
        }
        $projects = Portfolio::online()->inRandomOrder()->get();

        return PortfolioResource::collection($projects);
    }
}