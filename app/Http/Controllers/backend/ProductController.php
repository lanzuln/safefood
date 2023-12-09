<?php

namespace App\Http\Controllers\backend;

use App\Models\Product;
use App\Models\Category;
use App\Models\MiltiImage;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller {

    public function index() {
        $product = Product::latest()->get();
        return view('backend.page.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $category = Category::latest()->get();
        $sub_category = SubCategory::latest()->get();
        return view('backend.page.product.create', compact('category', 'sub_category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request) {

        // image process
        $file = $request->file('image');
        $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('/uploads/product/'), $fileName);
        $filePath = "uploads/product/{$fileName}";

        $product = Product::create([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'real_price' => $request->real_price,
            'sale_price' => $request->sale_price,
            'qty' => $request->qty,
            'weight' => $request->weight,
            'u_code' => $request->u_code,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            'image' => $filePath,
        ]);

        $product_id = $product->id;

        // for multi image
        $multiImage = $request->file('multi_image');
        foreach ($multiImage as $key => $image) {

            $fileName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/product/multiple/'), $fileName);
            $filePath = "uploads/product/multiple/{$fileName}";

            MiltiImage::create([
                'product_id' => $product_id,
                'multi_image' => $filePath,
            ]);
        }

        toastr()->success('product created successfully');
        return redirect()->route('product.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id) {

        $category = Category::latest()->get();
        $sub_category = SubCategory::latest()->get();
        $product =  Product::find($id);
        $multiImgs = MiltiImage::where('product_id', $id)->get();

        return view('backend.page.product.edit', compact('category', 'sub_category','product','multiImgs'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $id) {
        $product_id = $id;
        Product::findOrFail($product_id)->update([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'real_price' => $request->real_price,
            'sale_price' => $request->sale_price,
            'qty' => $request->qty,
            'weight' => $request->weight,
            'u_code' => $request->u_code,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
        ]);
        toastr()->success('product update successfully');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
   // Retrieve the product model instance
   $product = Product::find($id);

   // Check if the product exists before proceeding
   if ($product) {
       // Delete the product thumbnail file
       unlink($product->image);

       // Delete the product record
       $product->delete();


       // Delete associated multi-images
       $multi_images = MiltiImage::where('product_id', $id)->get();
       foreach ($multi_images as $image) {
           unlink($image->multi_image);

           $image->delete();
       }

       toastr()->success('Product Deleted Successfully');
   } else {
       toastr()->error('Product not found');
   }

   return redirect()->back();
}

    public function UpdateThambnail(Request $request) {

        $product_id = $request->id;
        $oldImage = $request->old_img;


        $file = $request->file('image');
        $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('/uploads/product/'), $fileName);
        $filePath = "uploads/product/{$fileName}";

        if (file_exists($oldImage)) {
            unlink($oldImage);
        }

        Product::where('id',$product_id)->update([
            'image' => $filePath,
        ]);

        toastr()->success('Product image updated');

        return redirect()->back();

    }

    public function UpdateMultiimage(Request $request) {

        $imgs = $request->multi_img;

        foreach ($imgs as $id => $img) {

            $imgDel = MiltiImage::findOrFail($id);

            unlink($imgDel->multi_image);

            $fileName = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('/uploads/product/multiple/'), $fileName);
            $filePath = "uploads/product/multiple/{$fileName}";

            MiltiImage::where('id', $id)->update([
                'multi_image' => $filePath,

            ]);
        } // end foreach

        toastr()->success('Product Multi Image Updated Successfully');

        return redirect()->back();

    }
    public function MulitImageDelelte($id){

        $oldImg = MiltiImage::findOrFail($id);
        unlink($oldImg->multi_image);

        MiltiImage::findOrFail($id)->delete();

        toastr()->success('Multi image delete successfull');

        return redirect()->back();

    }// End Method

}
