<?php

namespace App\Http\Controllers\backend;

use Exception;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreServiceRequest;

class ServiceController extends Controller
{
    public function index()
    {
        $service = Service::latest()->get();
        return view('backend.page.service.index', compact('service'));
    }

    public function create()
    {
        return view('backend.page.service.create');
    }

    public function store(StoreServiceRequest $request)
    {
        $file = request()->file('image');
        $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension(); //for name making
        $file->move(public_path('/uploads/service/'), $fileName);
        $filePath = "uploads/service/{$fileName}";

        Service::create([


            'image' => $filePath,
            'title' => $request->title,
            'text' => $request->text ,
        ]);


    toastr()->success('Service created successfully.');
    return redirect()->route('service.index');
    }


    public function edit(string $id)
    {
        $service = Service::where('id',$id)->first();

        return view('backend.page.service.edit', compact('service'));
    }

    public function update(Request $request, string $id)
    {
        $service = Service::find($id);
        if ($request->hasFile('image')) {

            if ($service && File::exists(public_path($service->image))) {
                File::delete(public_path($service->image));
            }


            $file = request()->file('image');
            $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension(); //for name making
            $file->move(public_path('/uploads/service/'), $fileName);
            $filePath = "uploads/service/{$fileName}";



            Service::where('id', $id)->update([

                'image' => $filePath,
                'title' => $request->title,
                'text' => $request->text,
            ]);


        }
        toastr()->success('Service updated with image');
        return redirect()->route('service.index');


    }

    public function destroy(string $id)
    {
        try {

            $service = Service::where('id', $id)->first();
            $oldImagePath = public_path($service->image);


            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
            Service::where('id', $id)->delete();
            toastr()->success('Service deleted');
            return redirect()->route('service.index');

        } catch (Exception $e) {
            return "something went wrong";
        }
    }


}
