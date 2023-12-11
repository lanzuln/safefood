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
    public function updateFontendAbout(Request $request) {
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'name' => 'required',
            'designation' => 'required',
            'avator' => 'required',
            'signature' => 'required',
            'banner' => 'required',
        ]);
        $frontendAbout_id = $request->id;

        $frontendAbout = FrontendAbout::find($frontendAbout_id);

        $avator = $request->hasFile('avator');
        $signature = $request->hasFile('signature');
        $banner = $request->hasFile('banner');

        if ($avator  || $signature || $banner) {
            if ($frontendAbout && File::exists(public_path($frontendAbout->avator))) {
                File::delete(public_path($frontendAbout->avator));
            } elseif ($frontendAbout && File::exists(public_path($frontendAbout->signature))) {
                File::delete(public_path($frontendAbout->signature));
            } elseif ($frontendAbout && File::exists(public_path($frontendAbout->banner))) {
                File::delete(public_path($frontendAbout->banner));
            }

            $afile = $request->file('avator');
            $afileName = hexdec(uniqid()) . '.' . $afile->getClientOriginalExtension(); //for name making
            $afile->move(public_path('/uploads/about/'), $afileName);
            $afilePath = "uploads/about/{$afileName}";

            $sfile = $request->file('signature');
            $sfileName = hexdec(uniqid()) . '.' . $sfile->getClientOriginalExtension(); //for name making
            $sfile->move(public_path('/uploads/about/'), $sfileName);
            $sfilePath = "uploads/about/{$sfileName}";

            $bfile = $request->file('banner');
            $bfileName = hexdec(uniqid()) . '.' . $bfile->getClientOriginalExtension(); //for name making
            $bfile->move(public_path('/uploads/about/'), $bfileName);
            $bfilePath = "uploads/about/{$bfileName}";

            FrontendAbout::where('id', $frontendAbout_id)->update([
                'title' => $request->title,
                'content' => $request->content,
                'name' => $request->name,
                'designation' => $request->designation,
                'avator' => $afilePath,
                'signature' => $sfilePath,
                'banner' => $bfilePath,
            ]);
            toastr()->success('About Updared successfully');
            return redirect()->back();
        }

    }
}
