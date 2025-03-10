<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shipping_address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateOrderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Product $product, Address $address)
    {
        if (!Auth::check()) {
            return redirect(route('home'), 401);
        }

        $customer = $request->user()->customer;

        $customerCartContent = $customer->cart->products()->get();

        $customerAddress = $customer->addresses()->where('is_default', true)->first();

        if ($customer && $customerCartContent && $customerAddress) {
            $totalAmount = 0;
            foreach ($customerCartContent as $prod) {
                $totalAmount += $prod->price * $prod->pivot->quantity;
            }

            $shippingAddress = Shipping_address::create([
                'street' => $customerAddress->street,
                'postcode' => $customerAddress->postcode,
                'city' => $customerAddress->city,
            ]);

            $order = Order::create([
                'customer_id' => $customer->id,
                'total_amount' => $totalAmount,
                'status' => OrderStatus::PAID,
                'shipping_address_id' => $shippingAddress->id,
            ]);

            foreach ($customerCartContent as $theProd) {
                $order->products()->attach($theProd->id, [
                    'quantity' => $theProd->pivot->quantity,
                    'price' => $theProd->price,
                ]);
            }

            $customer->cart->products()->detach();
        } else {
            return redirect(route('home'), 401);
        }
    }
}
