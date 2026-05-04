<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('admin.add_categories');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $table = new Category;
        $table->category_name = $request->category_name;
        
        if ($request->hasFile('category_image')) {

         $file = $request->file('category_image');
            $filename = time() . "_img." . $file->getClientOriginalExtension();
            $file->move(public_path('upload/categories/'), $filename);

             $table->category_image = $filename;
        }
        $table->status = 'Block';
       
        $table->save();

        Alert::success('Category Added', 'New category has been added successfully.');
        return redirect('/categories_management');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
         $data = Category::all();
        return view('admin.categories_management', ['cate_arr'=>$data]);
    }

    public function websiteCategories()
    {
        $categories = Category::all();
        return view('website.categories',  ['cate_arr'=>$categories]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data=Category::find($id);
        return view('admin.edit_categories',["data"=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $data = Category::find($id);

    $data->category_name = $request->category_name;

    if ($request->hasFile('category_image')) {

    // old image delete
    if ($data->category_image && file_exists(public_path('upload/categories/'.$data->category_image))) {
        unlink(public_path('upload/categories/'.$data->category_image));
    }

    $file = $request->file('category_image');
    $filename = time() . "_img." . $file->getClientOriginalExtension();
    $file->move(public_path('upload/categories/'), $filename);

    $data->category_image = $filename;
    }
  $data->status = $request->status; 

    $data->save(); 

    Alert::success('Category Updated Successfully');
    return redirect('/categories_management');
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, $id)
    {
        $data = Category::find($id);
        unlink('upload/categories/'.$data->category_image);
        $data->delete();

        Alert()->success('Category Deleted Successfully', 'Success');

        return redirect('categories_management');
    }

    public function status_change($id)
    {
        $data = Category::find($id);
        
        if ($data->status == "Unblock") {
            // Change to Block
            $data->status = "Block";
            $data->save();
            Alert::success('Category Blocked', 'Category has been blocked successfully.');
        } else {
            // Change to Unblock
            $data->status = "Unblock";
            $data->save();
            Alert::success('Category Unblocked', 'Category has been unblocked successfully.');
        }

        return redirect('/categories_management');
    }
}
