<?php

namespace App\Http\Controllers\backend;

use Exception;
use App\Models\Slider;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slider = Slider::latest()->get();
        return view('backend.page.slider.index', compact('slider'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.page.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSliderRequest $request)
    {


            $file = request()->file('image');
            $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension(); //for name making
            $file->move(public_path('/uploads/slider/'), $fileName);
            $filePath = "uploads/slider/{$fileName}";

            Slider::create([
                'title' => $request->title,
                'content' => $request->content,
                'v_url' => $request->v_url,
                'image' => $filePath,
            ]);


        toastr()->success('Slider created');
        return redirect()->route('slider.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $slider = Slider::where('id',$id)->first();

        return view('backend.page.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSliderRequest $request, $id)
    {
        $slider = Slider::find($id);
        if ($request->hasFile('image')) {

            // delete previues file path
            if ($slider && File::exists(public_path($slider->image))) {
                File::delete(public_path($slider->image));
            }


            $file = request()->file('image');
            $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension(); //for name making
            $file->move(public_path('/uploads/slider/'), $fileName);
            $filePath = "uploads/slider/{$fileName}";



            Slider::where('id', $id)->update([
                'title' => $request->title,
                'content' => $request->content,
                'v_url' => $request->v_url,
                'image' => $filePath,
            ]);

            toastr()->success('Slider updated with image');
            return redirect()->route('slider.index');

        }

        Slider::where('id', $id)->update([
            'title' => $request->title,
            'content' => $request->content,
            'v_url' => $request->v_url,

        ]);

        // Display an error toast with no title
        toastr()->success('Slider updated without image');
        return redirect()->route('slider.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {

            $category = Slider::where('id', $id)->first();

            $oldImagePath = public_path($category->image);

            if (file_exists($oldImagePath)) {
                // Delete the old image
                unlink($oldImagePath);
            }

            Slider::where('id', $id)->delete();

            toastr()->success('Slider deleted');
            return redirect()->route('slider.index');

        } catch (Exception $e) {
            return "something went wrong";
        }
    }
}
