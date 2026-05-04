<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Category;
use RealRashid\SweetAlert\Facades\Alert;

class PackageController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
{
    $cate_arr = Category::all();

    return view('admin.add_packages', compact('cate_arr'));
}

    public function store(Request $request)
    {
        $table=new Package;
        $table->category_id=$request->category_id;
        $table->package_name=$request->package_name;
        $table->price=$request->price;
        $table->max_catelogues=$request->max_catelogues;
        $table->description=$request->description;
        $table->save();
        Alert::success('Package added successfully');
        return redirect('/package_management');
    }

    public function show()
    {
        $data=Package::all();
        return view('admin.package_management',["pack_arr"=>$data]);

    }

    public function show_package(Request $request)
    {
        if ($request->has('id')) {
        $pack_arr = Package::where('category_id', $request->id)->get();
    } else {
        
        $pack_arr = Package::all();
    }

        return view('website.packages', ['pack_arr' => $pack_arr]);
    }

    public function edit($id)
{
    $package = Package::find($id);
    $cate_arr = Category::all(); // also needed for dropdown

    return view('admin.edit_packages', compact('package', 'cate_arr'));
}

    public function update(Request $request, $id)
    {
        $table=Package::find($id);
        $table->package_name=$request->package_name;
        $table->price=$request->price;
        $table->max_catelogues=$request->max_catelogues;
        $table->description=$request->description;
        $table->save();
        Alert::success('Package updated successfully');
        return redirect('/package_management');
    }

    public function destroy(Package $package, string $id)
    {
        $data=Package::find($id);
        $data->delete();
        Alert::success('Package deleted successfully');
        return redirect('/package_management');
    }

    
}
