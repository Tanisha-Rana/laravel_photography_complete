<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Catalogue;


use RealRashid\SweetAlert\Facades\Alert;

class CatalogueController extends Controller
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
        $cate_arr = Category::all();
         return view('admin.add_catalogues',["cate_arr"=>$cate_arr]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $table = new Catalogue;
        $table->category_id = $request->category_id;
        $table->catalogue_name = $request->catalogue_name;
        $table->description = $request->description;
        
        if ($request->hasFile('image')) {

         $file = $request->file('image');
            $filename = time() . "_img." . $file->getClientOriginalExtension();
            $file->move(public_path('upload/catalogues/'), $filename);

             $table->image = $filename;
        }
        $table->status = 'active';
       
        $table->save();

        Alert::success('Catalogue Added', 'New catalogue has been added successfully.');
        return redirect('/catelogues_management');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
         $data = Catalogue::all();
        return view('admin.catelogues_management', ['catalogue_arr'=>$data]);
    }

    public function websiteCatalogues(Request $request)
    {
    if ($request->has('id')) {
        $catalogue_arr = Catalogue::where('category_id', $request->id)->get();
    } else {
        
        $catalogue_arr = Catalogue::all();
    }

        return view('website.catalogues', ['catalogue_arr' => $catalogue_arr]);
    }


  

    /**
     * Show the form for editing the specified resource.
     */
   

public function edit($id)
{
    $data = Catalogue::find($id);
    $cate_arr = Category::all(); // 👈 ADD THIS

    return view('admin.edit_catalogues', [
        "data" => $data,
        "cate_arr" => $cate_arr
    ]);
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Catalogue $catalogue, $id)
    {
        $data=Catalogue::find($id);
        $data->catalogue_name=$request->catalogue_name;
        $data->description=$request->description;
        $data->category_id=$request->category_id;
        if($request->hasFile('image')) {
            unlink('upload/catalogues/'.$data->image);
            $file = $request->file('image');
            $filename = time() . "_img." . $file->getClientOriginalExtension();
            $file->move(public_path('upload/catalogues/'), $filename);
            $data->image = $filename;
        }
        $data->update();
        Alert::success('Catalogue Updated Successfully');
        return redirect('/catelogues_management');
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Catalogue $catalogue, $id)
    {
        $data = Catalogue::find($id);
        unlink('upload/catalogues/'.$data->image);
        $data->delete();

        Alert()->success('Catalogue Deleted Successfully', 'Success');

        return redirect('catelogues_management');
    }
}
