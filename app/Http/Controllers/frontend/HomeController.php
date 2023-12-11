<?php

namespace App\Http\Controllers\frontend;

use App\Models\Slider;
use App\Models\Product;
use App\Models\Service;
use App\Models\MiltiImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        $slider = Slider::latest()->get();
        $services = Service::get();
        $hit_product= Product::first();
        $multi_image= MiltiImage::where('product_id',$hit_product->id)->get();
        return view('frontend.pages.home.index',compact(
            'slider',
            'services',
            'hit_product',
            'multi_image'
        ));
    }
}
