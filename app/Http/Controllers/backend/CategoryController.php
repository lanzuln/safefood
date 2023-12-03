<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $categories = Category::latest('id', 'DESC')->get();
        return view('backend.page.category.index', compact('categories'));
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
    public function store(Request $request) {
        $request->validate([
            'title' => "required|string|max:50|unique:categories,title",
        ]);
        if ($request->hasFile('category_image')) {

            $file = request()->file('category_image');
            $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            Image::make($file)->resize(300, 280)->save(public_path('/uploads/category/' . $fileName));
            $filePath = "uploads/category/{$fileName}";

            Category::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'category_image' => $filePath,
            ]);

            toastr()->success('Category created with image');
            return redirect()->route('category.index');
        }
        Category::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
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
    public function update(Request $request, string $slug) {
        $request->validate([
            'title' => "required|string|max:50",
        ]);
        // dd($request);
        $category = Category::find('slug');
        if ($request->hasFile('category_image')) {
            if ($category && File::exists(public_path($category->category_image))) {
                File::delete(public_path($category->category_image));
            }
            $file = request()->file('category_image');
            $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
             Image::make($file)->resize(300, 280)->save(public_path('/uploads/category/' . $fileName));
            $filePath = "uploads/category/{$fileName}";

            Category::where('slug', $slug)->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'category_image' => $filePath,
                'is_active' => $request->filled('is_active'),
            ]);

            toastr()->success('Category updated with image');
            return redirect()->route('category.index');

        }

        Category::where('slug', $slug)->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'is_active' => $request->filled('is_active'),

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

            $category =  Category::where('slug', $slug)->first();


            $oldImagePath = public_path($category->category_image); // Get the full path to the old image

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
