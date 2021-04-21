<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showProduct($category, $product)
    {
        $product = Product::where('slug', $product)
            ->with('images')
            ->first();

        return view('products.product', compact(['category', 'product']));
    }

    public function showCategory(Request $request, $cat)
    {
        $category = Category::where('slug', $cat)
//            ->with('products')
            ->first();
        $products = Product::where('category_id', $category->id)
            ->with('images')
            ->paginate(8);

        if(isset($request->orderBy)){
            if($request->orderBy == 'price-low-high'){
                $products = Product::where('category_id', $category->id)
                    ->orderBy('price')
                    ->paginate(8);
            }
            if($request->orderBy == 'price-high-low'){
                $products = Product::where('category_id', $category->id)->orderBy('price', 'desc')->paginate(8);
            }
            if($request->orderBy == 'name-a-z'){
                $products = Product::where('category_id', $category->id)->orderBy('title')->paginate(8);
            }
            if($request->orderBy == 'name-z-a'){
                $products = Product::where('category_id', $category->id)->orderBy('title', 'desc')->paginate(8);
            }
        }
        if($request->ajax()){
            return view('ajax.order-by', compact(['category', 'products']))
                ->render();
        }

        return view('categories.category', compact(['category', 'products']));
    }
}
