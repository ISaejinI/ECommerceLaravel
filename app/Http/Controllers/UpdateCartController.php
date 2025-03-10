<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateCartController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1|max:'.$product->stock,
        ]);

        if (!Auth::check()) {
            return redirect(route('home'), 401);
        }

        $userId = $request->user()->customer->id;

        $userCart = $request->user()->customer->cart;

        if (!$userCart) {
            $userCart = Cart::create(['customer_id' => $userId]);
        }

        if ($userCart->products()->where('product_id', $product->id)->exists()) {
            $userCart->products()->updateExistingPivot($product->id,[
                "quantity"=>$request->quantity
            ]);
        } else {
            $userCart->products()->attach($product->id,[
                "quantity"=>$request->quantity
            ]);
        }

    }
}
