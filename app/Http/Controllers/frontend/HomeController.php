<?php

namespace App\Http\Controllers\frontend;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        $slider = Slider::latest()->get();
        return view('frontend.pages.home.index',compact('slider'));
    }
}
