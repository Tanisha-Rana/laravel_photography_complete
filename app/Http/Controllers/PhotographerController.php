<?php

namespace App\Http\Controllers;

use App\Models\Photographer;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;

use App\Models\Booking;

class PhotographerController extends Controller
{
    // 🔹 Assign Photographer and Approve Booking
    public function assignPhotographer(Request $request)
    {
        $request->validate([
            'booking_id' => 'required',
            'photographer_id' => 'required'
        ]);

        $booking = Booking::find($request->booking_id);
        if ($booking) {
            $booking->photographer_id = $request->photographer_id;
            $booking->booking_status = 'confirm'; // Automatically approve on assign
            $booking->save();

            Alert::success('Success', 'Photographer assigned & booking approved.');
        } else {
            Alert::error('Error', 'Booking not found.');
        }

        return back();
    }

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
        return view('admin.add_photographer');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=new photographer;
        $data->name=$request->name;
        $data->email=$request->email;
        $data->phone=$request->phone;
         $data->password = Hash::make($request->password);
        $data->save();
        Alert()->success('Photographer Added Successfully', 'Success');
        return redirect('photographer_management');
    }

    /**
     * Display the specified resource.
     */
    public function show(photographer $photographer)
    {
        $data=photographer::all();
        return view('admin.photographer_management', ['photo_arr'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $data=Photographer::find($id);
        return view('admin.edit_photographer', ['fetch'=>$data]);

        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photographer $photographer, $id)
    {
        $data=photographer::find($id);
        $data->name=$request->name;
        $data->email=$request->email;
        $data->phone=$request->phone;
        $data->password = Hash::make($request->password);
        $data->save();
        Alert()->success('Photographer Updated Successfully', 'Success');
        return redirect('photographer_management');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photographer $photographer, $id)
    {
        $data = Photographer::find($id);
        $data->delete();

        Alert()->success('Photographer Deleted Successfully', 'Success');

        return redirect('photographer_management');
    }
}
