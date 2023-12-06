<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;

class SubCategoryController extends Controller {public function index() {

    $sub_categories = SubCategory::latest()->get();
    return view('backend.page.sub-category.index', compact('sub_categories'));
}

/**
 * Show the form for creating a new resource.
 */
    public function create() {
        $allCategory = Category::latest()->get();
        return view('backend.page.sub-category.create', compact('allCategory'));
    }

/**
 * Store a newly created resource in storage.
 */
    public function store(StoreSubCategoryRequest $request) {

        if ($request->hasFile('image')) {

            $file = request()->file('image');
            $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension(); //for name making
            $file->move(public_path('/uploads/subCategory/'), $fileName);
            $filePath = "uploads/subCategory/{$fileName}";

            SubCategory::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'image' => $filePath,
                'category_id' => $request->category_id,

            ]);

            toastr()->success('Category created with image');
            return redirect()->route('sub-category.index');
        }
        SubCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,
        ]);
        toastr()->success('Category created without image');
        return redirect()->route('sub-category.index');

    }

/**
 * Display the specified resource.
 */
    public function show(string $id) {
        //
    }

/**
 * Show the form for editing the specified resource.
 */
    public function edit(string $slug) {
        $allCategory = Category::latest()->get();
        $sub_category = SubCategory::where('slug', $slug)->first();

        return view('backend.page.sub-category.edit', compact('allCategory','sub_category'));

    }

/**
 * Update the specified resource in storage.
 */
    public function update(UpdateSubCategoryRequest $request, $slug) {

        $sub_category = SubCategory::whereSlug($slug)->first();
        // dd($sub_category);

        if ($request->hasFile('image')) {

            // delete previues file path
            if ($sub_category && File::exists(public_path($sub_category->image))) {
                File::delete(public_path($sub_category->image));
            }

            $file = request()->file('image');
            $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension(); //for name making
            $file->move(public_path('/uploads/subCategory/'), $fileName);
            $filePath = "uploads/subCategory/{$fileName}";

            SubCategory::where('slug', $slug)->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'image' => $filePath,
                'category_id' => $request->category_id,

            ]);

            toastr()->success('Sub Category updated with image');
            return redirect()->route('sub-category.index');

        }

        SubCategory::where('slug', $slug)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,

        ]);

        // Display an error toast with no title
        toastr()->success('Sub Category updated without image');
        return redirect()->route('sub-category.index');
    }

/**
 * Remove the specified resource from storage.
 */
    public function destroy(string $slug) {

        try {

            $sub_category = SubCategory::where('slug', $slug)->first();

            $oldImagePath = public_path($sub_category->image); // Get the full path to the old image

            if (file_exists($oldImagePath)) {
                // Delete the old image
                unlink($oldImagePath);
            }

            SubCategory::where('slug', $slug)->delete();

            toastr()->success('Category deleted');
            return redirect()->route('sub-category.index');

        } catch (Exception $e) {
            return "something went wrong";
        }
    }




    public function loadSubcategory($category_id)
    {
        $sub_category = SubCategory::where('category_id', $category_id)->orderBy('name','ASC')->get();
        return json_encode($sub_category);
    }

}
