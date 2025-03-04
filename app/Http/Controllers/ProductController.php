<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $product_slug)
    {
        $product = Product::where('label', $product_slug)->firstOrFail();
        return Inertia::render('Product', [
            'product' => $product->load(['categories', 'images']),
        ]);
    }
}
