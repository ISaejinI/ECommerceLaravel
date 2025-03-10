<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeleteFromCartController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Product $product)
    {
        if (!Auth::check()) {
            return redirect(route('home'), 401);
        }

        $userCart = $request->user()->customer->cart;

        if (!$userCart) {
            return redirect(route('home'), 401);
        }

        if (!$userCart->products()->where('product_id', $product->id)->limit(1)) {
            return redirect(route('home'), 401);  
        }

        $userCart->products()->detach($product->id);
    }
}
