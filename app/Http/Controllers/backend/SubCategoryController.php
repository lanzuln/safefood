<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\SubCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;

class SubCategoryController extends Controller
{public function index() {

    $sub_categories = SubCategory::with('category')->get();
    // dd($sub_categories);


    return view('backend.page.sub-category.index', compact('sub_categories'));
}

/**
 * Show the form for creating a new resource.
 */
public function create() {
    return view('backend.page.category.create');
}

/**
 * Store a newly created resource in storage.
 */
public function store(StoreSubCategoryRequest $request) {

    if ($request->hasFile('image')) {

        $file = request()->file('image');
        $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension(); //for name making
        $file->move(public_path('/uploads/category'), $fileName);
        $filePath = "uploads/category/{$fileName}";

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $filePath,
        ]);

        toastr()->success('Category created with image');
        return redirect()->route('category.index');
    }
    Category::create([
        'name' => $request->name,
        'slug' => Str::slug($request->name),
    ]);
    toastr()->success('Category created without image');
    return redirect()->route('category.index');

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
    $category = Category::where('slug', $slug)->first();

    return view('backend.page.category.edit', compact('category'));

}

/**
 * Update the specified resource in storage.
 */
public function update(UpdateSubCategoryRequest $request, string $slug) {


    $category = Category::find('slug');
    if ($request->hasFile('image')) {

        // delete previues file path
        if ($category && File::exists(public_path($category->image))) {
            File::delete(public_path($category->image));
        }


        $file = request()->file('image');
        $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension(); //for name making
        $file->move(public_path('/uploads/category'), $fileName);
        $filePath = "uploads/category/{$fileName}";



        Category::where('slug', $slug)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $filePath,
        ]);

        toastr()->success('Category updated with image');
        return redirect()->route('category.index');

    }

    Category::where('slug', $slug)->update([
        'name' => $request->name,
        'slug' => Str::slug($request->name),

    ]);

    // Display an error toast with no title
    toastr()->success('Category updated without image');
    return redirect()->route('category.index');
}

/**
 * Remove the specified resource from storage.
 */
public function destroy(string $slug) {

    try {

        $category = Category::where('slug', $slug)->first();

        $oldImagePath = public_path($category->image); // Get the full path to the old image

        if (file_exists($oldImagePath)) {
            // Delete the old image
            unlink($oldImagePath);
        }

        Category::where('slug', $slug)->delete();

        toastr()->success('Category deleted');
        return redirect()->route('category.index');

    } catch (Exception $e) {
        return "something went wrong";
    }
}
}
