<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Catalogue;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class GalleryController extends Controller
{
    public function index()
    {
        
    }

    public function create()
    {
        $catalogue_arr = Catalogue::all();
         return view('admin.add_gallery',["catalogue_arr"=>$catalogue_arr]);
    }

    public function store(Request $request)
    {
    if($request->hasFile('image'))
    {
        $image_names = [];
        foreach($request->file('image') as $file)
        {
            $filename = time().rand(1,100).'.'.$file->extension();
            $file->move(public_path('upload/gallery'), $filename);
            $image_names[] = $filename;
        }

        DB::table('galleries')->insert([
            'catalogue_id' => $request->catalogue_id,
            'image' => json_encode($image_names),
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    Alert::success('Success', 'Gallery added successfully!');
    return redirect('gallery_management');
    }   




    public function show()
    {
         $data = Gallery::all();
        return view('admin.gallery_management', ['gallery_arr'=>$data]);
    }

    public function websiteGallery()
{
    $gallery_arr = Gallery::all();  // ✅ sab images dikhegi
    return view('website.gallery', compact('gallery_arr'));
}

    public function edit($id)
    {
        $data = Gallery::find($id);
        $catalogue_arr = Catalogue::all();
        return view('admin.edit_gallery', ['data'=>$data, 'catalogue_arr'=>$catalogue_arr]);
    }

    public function update(Request $request, $id)
    {
        $data = Gallery::find($id);
       
        if($request->hasFile('image'))
        {
            $image_names = [];
            foreach($request->file('image') as $file)
            {
                $filename = time().rand(1,100).'.'.$file->extension();
                $file->move(public_path('upload/gallery'), $filename);
                $image_names[] = $filename;
            }
            $data->image = json_encode($image_names);
        }

        $data->status = 'active';
        $data->save();

        Alert::success('Success', 'Gallery updated successfully!');
        return redirect('gallery_management');
    }


    public function destroy($id)
    {
        $data = Gallery::find($id);
        $images = json_decode($data->image);
        if(is_array($images))
        {
            foreach($images as $img)
            {
                $filePath = public_path('upload/gallery/' . $img);
                if(file_exists($filePath))
                {
                    unlink($filePath);
                }
            }
        }
        
        $data->delete();
        Alert::success('Success', 'Gallery deleted successfully!');
    
        return redirect('gallery_management');
    }

   
    
}


