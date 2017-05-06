<?php

namespace App\Http\Middleware;

use Closure;
use App\Product;

class CheckProductOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // dapatkan product id dari url
        $product_id = $request->product;


        // base on product id
        $product = Product::find( $product_id);

        if ($product){
            // dapatkan user id untuk product tersebut
            $product_owner = $product->user_id;
            //dapatkan current user id logged
            $current_user_id = auth()->id();

            // check jika current uessr yg cuba akses tak sama macam product owner

            if ($current_user_id!=$product_owner){
                dd("BERIGAK JANGE MENCEOBOH");
            }
        }
  
        return $next($request);
    }
}
