<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slot;
use RealRashid\SweetAlert\Facades\Alert;

class SlotController extends Controller
{
    public function index()
    {
        
    }

    public function create()
    {
        return view('admin.add_slots');
    }

    public function store(Request $request)
    {
        
        $table = new Slot;
        $table->slot_name = $request->slot_name;
        $table->start_time = $request->start_time;
        $table->end_time = $request->end_time;
        $table->status = 'active';
        $table->save();

        Alert::success('Slot Added', 'New slot has been added successfully.');
        return redirect('/slot_management');
    }

    public function show()
    {
         $data = Slot::all();
        return view('admin.slot_management', ['slot_arr'=>$data]);
    }

    public function edit(string $id)
{
    $data = Slot::find($id);
    return view('admin.edit_slots', ['data' => $data]);
}

    public function update(Request $request, Slot $slot, $id)
    {
        $data=Slot::find($id);
        $data->slot_name=$request->slot_name;
        $data->start_time=$request->start_time;
        $data->end_time=$request->end_time;
        $data->update();
        Alert::success('Slot Updated Successfully');
        return redirect('/slot_management');
    }

    public function destroy(string $id)
        {
            $data=Slot::find($id);
            $data->delete();
            Alert::success('Slot Deleted Successfully');
            return redirect('/slot_management');
        }
}
