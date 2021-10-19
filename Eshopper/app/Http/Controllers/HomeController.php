<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $slider;
    private $category;
    private $product;
    public function __construct(Slider $slider,Category $category,Product $product)
    {
        $this->slider = $slider;
        $this->category = $category;
        $this->product = $product;
    }

    public function index() {
        $sliders = $this->slider->latest()->get();
        $categorys = $this->category->where('parent_id',0)->latest()->get();
        $featuresItems = $this->product->latest()->take(6)->get();
        $recommendedItems = $this->product->latest('views_count','desc')->take(6)->get();
        $categoryLimit = $this->category->where('parent_id',0)->latest()->take(3)->get();
        return view('home.home',compact('sliders','categorys','featuresItems','recommendedItems','categoryLimit'));
    }
}
