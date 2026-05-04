<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Gallery;
use App\Models\Slot;
use App\Models\Feedback;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PhotographerDashboardController extends Controller
{
    public function index()
    {
        $photographer_id = Auth::guard('photographer')->id(); 
        
        $stats = [
            'total_bookings' => Booking::where('photographer_id', $photographer_id)->count(),
            'total_gallery' => Gallery::count(),
            'total_notifications' => Notification::count()
        ];
        
        return view('photographer.dashboard', compact('stats'));
    }

    public function appointments()
    {
        // Photographer usually views appointments linked to bookings they are assigned to
        $photographer_id = Auth::guard('photographer')->id();

        $appo_arr = DB::table('appointments')
            ->leftJoin('clients', 'appointments.client_id', '=', 'clients.id')
            ->leftJoin('slots', 'appointments.slot_id', '=', 'slots.id')
            ->leftJoin('bookings', 'appointments.id', '=', 'bookings.id') // Assuming connection or just based on bookings
            ->where('bookings.photographer_id', $photographer_id)
            ->orWhereNull('bookings.photographer_id') // Showing all if no strict photographer link? Usually photographer sees assignments.
            ->select(
                'appointments.*', 
                'appointments.id as appointment_id', 
                'clients.name as client_name', 
                'slots.slot_name'
            )
            ->get();

        return view('photographer.appointments', compact('appo_arr'));
    }

    public function bookings()
    {
        $photographer_id = Auth::guard('photographer')->id();
        
        $book_arr = DB::table('bookings')
            ->leftJoin('clients', 'bookings.client_id', '=', 'clients.id')
            ->leftJoin('categories', 'bookings.category_id', '=', 'categories.id')
            ->leftJoin('slots', 'bookings.slot_id', '=', 'slots.id')
            ->where('bookings.photographer_id', $photographer_id)
            ->select(
                'bookings.*', 
                'bookings.id as booking_id',
                'clients.name as client_name', 
                'categories.category_name', 
                'slots.slot_name'
            )
            ->get();
            
        return view('photographer.bookings', compact('book_arr'));
    }

    public function gallery()
    {
        // Fetching all gallery items with catalogue names
        $gallery_arr = DB::table('galleries')
            ->leftJoin('catalogues', 'galleries.catalogue_id', '=', 'catalogues.id')
            ->select('galleries.*', 'galleries.id as gallery_id', 'catalogues.catalogue_name')
            ->get();
            
        return view('photographer.gallery', compact('gallery_arr'));
    }

    public function slots()
    {
        $slot_arr = DB::table('slots')
            ->select('id as slot_id', 'slot_name', 'start_time', 'end_time', 'status')
            ->get();
            
        return view('photographer.slots', compact('slot_arr'));
    }

    public function private_gallery()
    {
        return view('photographer.private-gallery');
    }

    public function notifications()
    {
        $photographer_id = Auth::guard('photographer')->id();
        $notif_arr = Notification::where('user_role', 'photographer')
            ->where('user_id', $photographer_id)
            ->orderBy('id', 'desc')
            ->get();

        // Mark as read
        Notification::where('user_role', 'photographer')
            ->where('user_id', $photographer_id)
            ->update(['is_read' => 'yes']);

        return view('photographer.notifications', compact('notif_arr'));
    }

    public function feedback()
    {
        // Fetching feedback by joining bookings and clients
        $feed_arr = DB::table('feedback')
            ->leftJoin('bookings', 'feedback.booking_id', '=', 'bookings.id')
            ->leftJoin('clients', 'bookings.client_id', '=', 'clients.id')
            ->select(
                'feedback.*', 
                'feedback.id as feedback_id', 
                'clients.name as client_name', 
                'feedback.comment as feedback_message'
            )
            ->get();
            
        return view('photographer.feedback', compact('feed_arr'));
    }
}