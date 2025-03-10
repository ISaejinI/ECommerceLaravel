<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateAddressController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Address $address)
    {
        $request->validate([
            'is_default' => 'required|boolean',
        ]);

        if (!Auth::check()) {
            return redirect(route('home'), 401);
        }

        $customer = $request->user()->customer;

        if ($customer->addresses()->where('id', $address->id)) {
            $customer->addresses()->where('id', $address->id)->update(['is_default' => $request->is_default]);
            $customer->addresses()->where('id', '!=', $address->id)->update(['is_default' => !$request->is_default]);
        } else {
            return ;
        }
    }
}
