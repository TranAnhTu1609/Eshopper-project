<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    private $product;
    private $category;
    public function __construct(Product $product,Category $category)
    {
        $this->product = $product;
        $this->category = $category;
    }

    function addToCart($id) {
        $product = $this->product->find($id);
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = $cart[$id]['quantity'] + 1;
        }
        else {
            $cart[$id] = [
                'name'=>$product->name,
                'price'=>$product->price,
                'quantity'=>1,
                'image'=>$product->feature_image_path
            ];
        }
        session()->put('cart',$cart);
        return response()->json([
            'code'=>200,
            'message'=>'success',
        ],200);
    }
    function showCart() {
        $categoryLimit = $this->category->where('parent_id',0)->latest()->take(3)->get();
        $carts = session()->get('cart');
        return View('products.cart.index',compact('carts','categoryLimit'));
    }
}
