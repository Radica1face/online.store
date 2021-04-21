<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->with('category')->paginate(25);

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = Product::make();
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('admin.product.create', compact(['item', 'categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCreateRequest $request)
    {
        $data = $request->input();
        if(empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $item = Product::create($data);

        if(! empty($request->image)){
            // Добавляем изображение в public/images
            $imageName = $request->file('image')->getClientOriginalName();
            $request->image->move(public_path('images') . '/products', $imageName);

            // Добавляем изображение в БД
            $dataImage = [
                'product_id' => $item->id,
                'image' => $imageName,
            ];

            $itemImage = ProductImage::create($dataImage);
        }
        if($item) {
            return redirect()->route('product.edit', $item->id)
                ->with(['success' => 'Товар добавлен']);
        }else{
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('created_at', 'desc')->get();

        return view('admin.product.edit', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        if (empty($product)) {
            return back()
                ->withErrors(['msg' => "Запись id = [ $product->id ] не найдена"])
                ->withInput();
        }

        $data = $request->input();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $result = $product->update($data);

        // Добавляем изображение в public/images
        if (! empty($request->image)) {

            $imageName = $request->file('image')->getClientOriginalName();
            $request->image->move(public_path('images') . '/products', $imageName);

            // Добавляем изображение в БД
            $dataImage = [
                'product_id' => $product->id,
                'image' => $imageName,
            ];

        $itemImage = ProductImage::create($dataImage);

        }
        if($result) {
            return redirect()
                ->route('product.edit', $product->id)
                ->with(['success' => 'Изменения сохранены']);
        }else{
            return back()
                ->withErrors(['msg' => "Ошибка сохранения"])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->back()->with(['msg' => 'Товар удален']);
    }
}
