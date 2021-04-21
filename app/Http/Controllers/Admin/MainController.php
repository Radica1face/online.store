<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $count_products = Product::all()->count();
        return view('admin.home.index', compact(['count_products']));
    }
}
