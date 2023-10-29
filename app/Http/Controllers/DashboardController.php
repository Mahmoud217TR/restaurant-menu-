<?php

namespace App\Http\Controllers;

use App\Http\Resources\MenuResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $menu = new MenuResource(auth()->user()->menu);
        return Inertia::render('Dashboard', compact('menu'));
    }
}
