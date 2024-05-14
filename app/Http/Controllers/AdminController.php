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
    public function delete_category($id)
    {
        $data = Category::find($id);

        $data->delete();
        toastr()->closeButton()->success('Category Deleted Successfully!');

        return redirect()->back();
    }
    public function edit_category($id)
    {
        $data = Category::find($id);
        return view('admin.edit_category', compact('data'));
    }

    public function update_category(Request $request)
    {
        $data = Category::find($request->id);

        $data->category_name = $request->category;

        $data->save();
        toastr()->closeButton()->success('Category Updated Successfully!');

        return redirect('/view_category');

    }
}
