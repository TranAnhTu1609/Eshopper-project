<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category;
    private $product;
    public function __construct(Category $category,Product $product) {
        $this->category = $category;
        $this->product = $product;
    }
    public function index($slug,$categoryId) {
        $categoryLimit = $this->category->where('parent_id',0)->latest()->take(3)->get();
        $categorys = $this->category->where('parent_id',0)->latest()->get();
        $productsInCategorys = $this->product->where('category_id',$categoryId)->latest()->paginate(9);
        return view('products.category.list',compact('categoryLimit','categorys','productsInCategorys'));
    }
}
