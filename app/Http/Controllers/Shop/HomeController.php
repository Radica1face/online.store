<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id')
            ->limit(8)
            ->with(['category', 'images'])
            ->get();

        return view('home.index', compact('products'));
    }
}
