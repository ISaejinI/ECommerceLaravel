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
    public function __invoke(AddToCartRequest $request, Product $productId)
    {
        if (!Auth::check()) {
            return redirect(route('home'), 401);
        }
        
        $user = $request->user();
        $userCart = $user->customer->cart;

        if (!$userCart) {
            $userCart = Cart::create(['customer_id' => $user->customer->id]);
        }

        if ($userCart->products()->where('product_id', $request->productId)->exists()) {
            $userCart->products()->updateExistingPivot($request->productId,[
                "quantity"=>$userCart->products->find($request->productId)->pivot->quantity + $request->quantity
            ]);
        } else {
            $userCart->products()->attach($request->productId,[
                "quantity"=>$request->quantity
            ]);
        }
    }
}
