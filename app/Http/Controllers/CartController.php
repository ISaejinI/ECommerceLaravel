<?php

namespace App\Http\Controllers;

// use App\Models\Cart;

use App\Models\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $currentUser = auth()->user();

        $currentUserCart = $currentUser->customer->cart->products;

        return Inertia::render('Cart', [
            "products" => $currentUserCart,
        ]);
    }
}
