<?php

namespace App\Http\Controllers\backend;

use App\Models\Product;
use App\Models\Category;
use App\Models\MiltiImage;
use App\Models\SubCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{

    public function index()
    {
        $product= Product::latest()->get();
        return view('backend.page.product.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category= Category::latest()->get();
        $sub_category= SubCategory::latest()->get();
        return view('backend.page.product.create',compact('category','sub_category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // image process
        $file = request()->file('image');
        $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension(); //for name making
        $file->move(public_path('/uploads/product'), $fileName);
        $filePath = "uploads/product/{$fileName}";

       $product = Product::create([
            'category_id'=>$request->category_id,
            'sub_category_id '=>$request->sub_category_id,
            'name'=>$request->name,
            'real_price'=>$request->real_price,
            'sale_price'=>$request->sale_price,
            'qty'=>$request->qty,
            'weight'=>$request->weight,
            'u_code'=>$request->u_code,
            'short_desc'=>$request->short_desc,
            'long_desc'=>$request->long_desc,
            'image'=>$request->filePath,
        ]);



        $product_id= $product->id;

        // for multi image
        $multiImage = request()->file('multi_image');
        foreach ($multiImage as $key => $image) {

            $fileName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); //for name making
            $file->move(public_path('/uploads/product/multiple/'), $fileName);
            $filePath = "uploads/product/multiple/{$fileName}";

            MiltiImage::create([
                'product_id'=>$product_id,
                'multi_image'=>$filePath,
            ]);
        }

        toastr()->success('product created successfully');
        return redirect()->route('product.index');



    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
