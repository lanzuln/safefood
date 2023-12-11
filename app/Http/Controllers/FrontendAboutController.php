<?php

namespace App\Http\Controllers;

use App\Models\FrontendAbout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FrontendAboutController extends Controller {
    public function fontendAbout() {
        $frontendAbout = FrontendAbout::first();
        return view('backend.page.home-about.edit', compact('frontendAbout'));
    }
    // public function updateFontendAbout(Request $request) {
    //     // dd($request->all());
    //     $request->validate([
    //         'title' => 'required',
    //         'content' => 'required',
    //         'name' => 'required',
    //         'designation' => 'required',
    //         'avator' => 'nullable',
    //         'signature' => 'nullable',
    //         'banner' => 'nullable',
    //     ]);
    //     $frontendAbout_id = $request->id;

    //     $frontendAbout = FrontendAbout::find($frontendAbout_id);

    //     if ($request->hasFile('avator')) {
    //         if ($frontendAbout && File::exists(public_path($frontendAbout->avator))) {
    //             File::delete(public_path($frontendAbout->avator));
    //         }

    //         $afile = $request->file('avator');
    //         $afileName = hexdec(uniqid()) . '.' . $afile->getClientOriginalExtension(); //for name making
    //         $afile->move(public_path('/uploads/about/'), $afileName);
    //         $afilePath = "uploads/about/{$afileName}";
    //         FrontendAbout::where('id', $frontendAbout_id)->update([
    //             'title' => $request->title,
    //             'content' => $request->content,
    //             'name' => $request->name,
    //             'designation' => $request->designation,
    //             'avator' => $afilePath,
    //         ]);
    //         toastr()->success('About Updared successfully');
    //         return redirect()->back();
    //     }


    //     if ($request->hasFile('signature')) {
    //         if ($frontendAbout && File::exists(public_path($frontendAbout->signature))) {
    //             File::delete(public_path($frontendAbout->signature));
    //         }
    //         $sfile = $request->file('signature');
    //         $sfileName = hexdec(uniqid()) . '.' . $sfile->getClientOriginalExtension(); //for name making
    //         $sfile->move(public_path('/uploads/about/'), $sfileName);
    //         $sfilePath = "uploads/about/{$sfileName}";

    //         FrontendAbout::where('id', $frontendAbout_id)->update([
    //             'title' => $request->title,
    //             'content' => $request->content,
    //             'name' => $request->name,
    //             'designation' => $request->designation,
    //             'signature' => $sfilePath,
    //         ]);
    //         toastr()->success('About Updared successfully');
    //         return redirect()->back();
    //     }


    //     if ($request->hasFile('banner')) {
    //         if ($frontendAbout && File::exists(public_path($frontendAbout->banner))) {
    //             File::delete(public_path($frontendAbout->banner));
    //         }

    //         $bfile = $request->file('banner');
    //         $bfileName = hexdec(uniqid()) . '.' . $bfile->getClientOriginalExtension(); //for name making
    //         $bfile->move(public_path('/uploads/about/'), $bfileName);
    //         $bfilePath = "uploads/about/{$bfileName}";
    //         FrontendAbout::where('id', $frontendAbout_id)->update([
    //             'title' => $request->title,
    //             'content' => $request->content,
    //             'name' => $request->name,
    //             'designation' => $request->designation,
    //             'banner' => $bfilePath,
    //         ]);
    //         toastr()->success('About Updared successfully');
    //         return redirect()->back();
    //     }

    // }
    public function updateFontendAbout(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'name' => 'required',
            'designation' => 'required',
            'avator' => 'nullable|image',
            'signature' => 'nullable|image',
            'banner' => 'nullable|image',
        ]);

        $frontendAbout_id = $request->id;
        $frontendAbout = FrontendAbout::find($frontendAbout_id);

        // Non-image updates
        $nonImageUpdates = [
            'title' => $request->title,
            'content' => $request->content,
            'name' => $request->name,
            'designation' => $request->designation,
        ];

        // Check for avator upload
        if ($request->hasFile('avator')) {
            $this->deleteIfFileExists($frontendAbout->avator);
            $nonImageUpdates['avator'] = $this->uploadFile($request->file('avator'));
        }

        // Check for signature upload
        if ($request->hasFile('signature')) {
            $this->deleteIfFileExists($frontendAbout->signature);
            $nonImageUpdates['signature'] = $this->uploadFile($request->file('signature'));
        }

        // Check for banner upload
        if ($request->hasFile('banner')) {
            $this->deleteIfFileExists($frontendAbout->banner);
            $nonImageUpdates['banner'] = $this->uploadFile($request->file('banner'));
        }

        // Update database
        FrontendAbout::where('id', $frontendAbout_id)->update($nonImageUpdates);

        toastr()->success('About Updated successfully');
        return redirect()->back();
    }

    private function deleteIfFileExists($path)
    {
        if ($path && File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }

    private function uploadFile($file)
    {
        $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('/uploads/about/'), $fileName);
        return "uploads/about/{$fileName}";
    }
}
