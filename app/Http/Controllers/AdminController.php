<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

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

    public function add_product()
    {
        $category = Category::all();
        return view('admin.add_product',compact('category'));
    }

    public function upload_product(Request $request)
    {
        // dd($request->file('image'));
        $data = new Product;

        $data->title = $request->title;
        $data->description = $request->description;
        // $data->image = $request->image;
        $data->price = $request->price;
        $data->category = $request->category;
        $data->quantity = $request->qty;

        $image = $request->image;
        //upload iamge to the public folder and store path in db
        //the folder is automatically created

        if($image)
        {
            $imagename = time().'.'.$image->getClientOriginalExtension();

            $request->image->move('products',$imagename);

            $data->image = $imagename;
        }




        $data->save();

        toastr()->closeButton()->success('Product Added Successfully!');
        return redirect()->back();

    }

    public function view_product()
    {
        //add pagination instead of displaying all();
        $products = Product::paginate(2);
        return view('admin.view_product',compact('products'));
    }

    public function delete_product($id)
    {
        $data = Product::find($id);

        // delete image
        $image_path = public_path('products/'.$data->image);

        if(file_exists($image_path))
        {
            unlink($image_path);
        }

        $data->delete();

        toastr()->closeButton()->success('Product deleted Successfully!');

        return redirect()->back();


    }

    public function update_product($id)
    {
        $data = Product::find($id);

        $categories = Category::all();


        return view('admin.update_product',compact('data','categories'));
    }

    public function edit_product(Request $request, $id)
    {
        $data = Product::find($id);

        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->quantity = $request->quantity;
        $data->category = $request->category;
        $image = $request->image;

        if ($image)
        {
            $imagename = time().'.'.$image->getClientOriginalExtension();

            $request->image->move('products', $imagename);

            $data->image = $imagename;
        }

        $data->save();

        toastr()->closeButton()->success('Product updated successfully!');

        return redirect('view_product');

    }

    public function product_search(Request $request)
    {
        $search = $request->search;

        $products = Product ::where('title','like','%' .$search.'%')->orWhere('category','like','%' .$search.'%')->paginate(3);

        return view('admin.view_product',compact('products'));
    }
}
