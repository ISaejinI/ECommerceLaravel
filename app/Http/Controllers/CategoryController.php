<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = $category->products;
        return Inertia::render('Category', [
            'slug' => $slug,
            'label' => $category->label,
            'products' => $products,
        ]);
    }
}
