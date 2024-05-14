<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class AdminController extends Controller
{
    public function view_category()
    {
        $data = Category::all();
        return view("admin.category", compact('data'));
    }
    public function add_category(Request $request)
    {
        // $category = Category::create($request->all());
        $category = new Category;
    
        $category->category_name = $request->category;
        $category->save();
        //notification mesage using toastr
        toastr()->closeButton()->success('Category Added Successfully');

        return redirect()->back();
    }
}
