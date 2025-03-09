<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */

    public function __invoke(Request $request)
    {
        $randomCategories = Category::all()->random(5);
        $mostSoldProducts = Product::withSum('orders as total_sold', 'order_product.quantity')
            ->orderByDesc('total_sold')
            ->limit(3)
            ->get();
        return Inertia::render('Home', [
            'randomCategories' => $randomCategories,
            'mostSoldProducts' => $mostSoldProducts,
        ]);
    }
}
