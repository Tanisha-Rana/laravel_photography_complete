<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enquiry;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Mail;
use App\Mail\enquirymail;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('website.contact');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $table=new enquiry;
        $table->name=$request->name;
        $table->email=$request->email;
        $table->subject=$request->subject;
        $table->message=$request->message;
        $table->save();
         $data = [
        "name" => $request->name
    ];

    Mail::to($request->email)->send(new enquirymail($data));
        Alert::success('Message sent successfully');
        return redirect('/contact');
    }

    /**
     * Display the specified resource.
     */
    public function show(enquiry $Enquiry)
    {
        $data=Enquiry::all();
        return view('admin.enquiry_management',["enquiry_arr"=>$data]);
    }

    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
