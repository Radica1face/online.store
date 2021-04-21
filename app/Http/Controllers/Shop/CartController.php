<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $productsInCart = [];
        if(isset($_COOKIE['cartId'])) {
            $productsInCart = Cart::session($_COOKIE['cartId'])->getContent();
        }
        return view('cart.cart', compact('productsInCart'));
    }

    public function addToCart(Request $request)
    {
        $cartId = uniqid();
        if(! isset($_COOKIE['cartId'])){
            setcookie('cartId', $cartId);
        }

        $product = Product::where('id', $request->id)->first();

        $qty = (int) $request->qty;
        $price = $product->new_price ? $product->new_price : $product->price;

        Cart::session($_COOKIE['cartId'])->add([
            'id' => $product->id,
            'name' => $product->title,
            'price' => $price,
            'quantity' =>  $qty,
            'attributes' => [
                'img' => count($product->images) ? $product->images[0]->image : 'no_image.png',
                'c_slug' => $product->category->slug,
                'p_slug' => $product->slug,
            ]
        ]);

        return response()->json(Cart::session($_COOKIE['cartId'])->getContent());
    }

    public function cartInc(Request $request)
    {
        $productId = $request->id;
        Cart::session($_COOKIE['cartId'])->update($productId, array(
            'quantity' => +1,
        ));

        $cartCollection = Cart::session($_COOKIE['cartId'])->getContent($productId);

        return $cartCollection->toArray();
    }

    public function cartDec(Request $request)
    {
        $productId = $request->id;
        Cart::session($_COOKIE['cartId'])->update($productId, array(
            'quantity' => -1,
        ));

        $cartCollection = Cart::session($_COOKIE['cartId'])->getContent($productId);

        return $cartCollection->toArray();
    }
}
