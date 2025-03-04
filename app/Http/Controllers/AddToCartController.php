<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class AddToCartController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AddToCartRequest $request, Product $product)
    {

        // Récupérer le customer -> user()->customer->customer.id // Récupérer le panier de l'user
            //Mettre des parenthèses pour pourvoir utiliser des fonctions derrère 
        // request -> validate
        
        $user = $request->user()->customer;
        $userCart = $user->cart;


        if (!$userCart) {
            $userCart = Cart::create(['customer_id' => $user->id]);
        }

        if($userCart->products->contains($product)){
            $userCart->products()->updateExistingPivot($product,[
                "quantity"=>$userCart->products->find($product)->pivot->quantity + $request->quantity
            ]);
        } else {
            $userCart->products()->attach($product,[
                "quantity"=>$request->quantity
            ]);
        }
        


        

        // if $produit -> ajouter la quantité en plus // Sinon ajouter au panier

        // Méthode create vient du model -> pas besoin de la définir
    



        //Créer un fichier de validation et remplacer le request

        dd($request);
    }
}
