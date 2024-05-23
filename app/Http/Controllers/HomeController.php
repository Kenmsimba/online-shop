<?php

namespace App\Http\Controllers;

use App\Models\Product;

use App\Models\User;

use App\Models\Cart;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view("admin.index");
    }

    public function home()
    {
        $products = Product::all();

        return view('home.index',compact('products'));
    }

    public function login_home()
    {
        $products = Product::all();

        return view('home.index',compact('products'));
    }

    public function product_details($id)
    {
        $product = Product::find($id);
        return view('home.product_details',compact('product'));
    }

    public function add_cart($id)
    {
        $product_id = $id;

        $user = Auth::user();

        $user_id = $user->id;

        $data = new Cart;

        $data->user_id = $user_id;

        $data->product_id = $product_id;

        $data->save();

        toastr()->closeButton()->success('Product Added to Cart Successfully!');

        return redirect()->back();

    }
}
