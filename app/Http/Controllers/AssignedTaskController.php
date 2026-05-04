<?php

namespace App\Http\Controllers;

use App\Models\AssignedTask;
use App\Models\Editor;
use App\Models\Booking;
use App\Models\Notification;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AssignedTaskController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $editor_arr = Editor::all();
        $booking_arr = Booking::with('client')->get(); // Assuming all bookings can have editors
        return view('admin.add_assigned_task', compact('editor_arr', 'booking_arr'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $task = new AssignedTask;
        $task->editor_id = $request->editor_id;
        $task->booking_id = $request->booking_id;
        $task->task_description = $request->task_description;
        $task->status = 'pending';
        $task->save();
        
        // Notify Editor
        Notification::createNotification($task->editor_id, 'editor', 'New Task Assigned', 'A new editing task has been assigned to you. (Booking ID: ' . $task->booking_id . ')', '/editor/tasks');

        Alert::success('Success', 'Task assigned successfully!');
        return redirect('assigned_tasks_management');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $task_arr = AssignedTask::with(['editor', 'booking.client'])->get();
        return view('admin.assigned_tasks_management', compact('task_arr'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = AssignedTask::find($id);
        $editor_arr = Editor::all();
        $booking_arr = Booking::with('client')->get();
        return view('admin.edit_assigned_task', compact('task', 'editor_arr', 'booking_arr'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $task = AssignedTask::find($id);
        $task->editor_id = $request->editor_id;
        $task->booking_id = $request->booking_id;
        $task->task_description = $request->task_description;
        $task->status = $request->status;
        $task->save();

        // Notify Editor if status changed or just general update
        Notification::createNotification($task->editor_id, 'editor', 'Task Updated', 'An assigned task has been updated. Status: ' . $task->status, '/editor/tasks');

        Alert::success('Success', 'Assigned task updated successfully!');
        return redirect('assigned_tasks_management');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = AssignedTask::find($id);
        $task->delete();

        Alert::success('Success', 'Assigned task deleted successfully!');
        return redirect('assigned_tasks_management');
    }
}