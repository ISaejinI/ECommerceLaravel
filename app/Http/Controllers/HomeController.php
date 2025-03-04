<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
    */
    
    public function __invoke(Request $request)
    {
        $categories = Category::all();
        return Inertia::render('Home', [
            'categories' => $categories,
        ]);
    }
}
