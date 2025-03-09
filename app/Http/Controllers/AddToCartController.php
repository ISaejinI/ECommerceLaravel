<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddToCartController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Product $productId)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1|max:'.$productId->stock,
        ]);

        if (!Auth::check()) {
            return redirect(route('home'), 401);
        }
        
        $user = $request->user();
        $userCart = $user->customer->cart;

        if (!$userCart) {
            $userCart = Cart::create(['customer_id' => $user->customer->id]);
        }

        if ($userCart->products()->where('product_id', $productId->id)->exists()) {
            $userCart->products()->updateExistingPivot($productId->id,[
                "quantity"=>$userCart->products->find($productId->id)->pivot->quantity + $request->quantity
            ]);
        } else {
            $userCart->products()->attach($productId->id,[
                "quantity"=>$request->quantity
            ]);
        }
    }
}
