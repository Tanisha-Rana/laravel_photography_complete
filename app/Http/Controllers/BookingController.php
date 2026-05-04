<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Notification;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $book_arr = \Illuminate\Support\Facades\DB::table('bookings')
            ->leftJoin('clients', 'bookings.client_id', '=', 'clients.id')
            ->leftJoin('categories', 'bookings.category_id', '=', 'categories.id')
            ->leftJoin('packages', 'bookings.package_id', '=', 'packages.id')
            ->leftJoin('slots', 'bookings.slot_id', '=', 'slots.id')
            ->leftJoin('photographers', 'bookings.photographer_id', '=', 'photographers.id')


            ->select(
                'bookings.*', 
                'bookings.id as booking_id', // Alias id to booking_id
                'clients.name as client_name', 
                'clients.phone as client_phone',
                'categories.category_name', 
                'packages.package_name', 
                'slots.slot_name',
                'photographers.name as photographer_name'
            )
            ->get();

        $photographer_arr = \Illuminate\Support\Facades\DB::table('photographers')->select('id as photographer_id', 'name')->get();


        return view('admin.booking_management', compact('book_arr', 'photographer_arr'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cate_arr = \Illuminate\Support\Facades\DB::table('categories')->select('id as category_id', 'category_name')->get();
        $slot_arr = \Illuminate\Support\Facades\DB::table('slots')->select('id as slot_id', 'slot_name', 'start_time', 'end_time')->get();

        return view('website.booking', compact('cate_arr', 'slot_arr'));
    }

    public function getCategoryData(Request $request)
    {
        $category_id = $request->category_id;
        
        $packages = \Illuminate\Support\Facades\DB::table('packages')
            ->select('id as package_id', 'category_id', 'package_name', 'price', 'max_catelogues')
            ->where('category_id', $category_id)
            ->get();
            
        $themes = \Illuminate\Support\Facades\DB::table('catalogues')
            ->select('id as catalogue_id', 'category_id', 'catalogue_name', 'image')
            ->where('category_id', $category_id)
            ->get();
            
        return response()->json([
            'packages' => $packages,
            'themes' => $themes
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $table = new Booking;

        // Main Booking Data
        $table->client_id = session('client_id'); // Get logged in client ID
        $table->category_id = $request->category_id;
        $table->package_id = $request->package_id;

        // Multiple themes (checkbox array)
        $table->catalogue_id = implode(',', $request->catalogue_id ?? []);

        // Date & Slot
        $table->appointment_date = $request->appointment_date;
        $table->slot_id = $request->slot_id;

        // Venue
        $table->venue_type = $request->venue_type;
        $table->venue_address = $request->venue_address;

        // Addons (multiple) mapped to string "Name:Price"

        // Calculate Total Amount
        $package = \Illuminate\Support\Facades\DB::table('packages')->where('id', $request->package_id)->first();
        $total = $package ? $package->price : 0;
        
        if ($request->venue_type == 'home' || $request->venue_type == 'outdoor') {
            $total += 3500;
        }
        
       
        
        $table->total_amount = $total; 
        $table->booking_status = 'pending';
        $table->payment_status = 'unpaid';
        
        // Save
        $table->save();

        // If guest, track their booking in session
        if (!session()->has('client_id')) {
            $guest_bookings = session()->get('guest_bookings', []);
            $guest_bookings[] = $table->id;
            session()->put('guest_bookings', $guest_bookings);
        }

        // Success Message
        \RealRashid\SweetAlert\Facades\Alert::success('Booking Request Sent Successfully', 'Your total amount is ₹' . number_format($total, 2));

        // Notification for Admin
        Notification::createNotification(null, 'admin', 'New Booking Received', 'A new booking request has been received (ID: ' . $table->id . ')', '/booking_management');
        
        // Notification for Client if logged in
        if (session('client_id')) {
            Notification::createNotification(session('client_id'), 'client', 'Booking Received', 'Your booking request has been received and is under review.', '/mybooking');
        }

        return redirect('/mybooking');
    }

    public function mybookings()
    {
        $query = \Illuminate\Support\Facades\DB::table('bookings')
            ->leftJoin('categories', 'bookings.category_id', '=', 'categories.id')
            ->leftJoin('packages', 'bookings.package_id', '=', 'packages.id')
            ->leftJoin('slots', 'bookings.slot_id', '=', 'slots.id')
            ->select(
                'bookings.*', 
                'bookings.id as booking_id',
                'categories.category_name', 
                'packages.package_name', 
                'slots.slot_name', 'slots.start_time', 'slots.end_time'
            )
            ->orderBy('bookings.id', 'desc');

        if(session()->has('client_id')) {
            $query->where('bookings.client_id', session('client_id'));
        } else if (session()->has('guest_bookings') && count(session('guest_bookings')) > 0) {
            $query->whereIn('bookings.id', session('guest_bookings'));
        } else {
            // No login and no guest session bookings, return empty result
            $query->where('bookings.id', -1);
        }

        $my_bookings = $query->get();

        foreach($my_bookings as $book) {
            $book->theme_names = '';
            if ($book->catalogue_id) {
                $ids = explode(',', $book->catalogue_id);
                $themes = \Illuminate\Support\Facades\DB::table('catalogues')->whereIn('id', $ids)->pluck('catalogue_name')->toArray();
                $book->theme_names = implode(', ', $themes);
            }
        }

        return view('website.mybooking', compact('my_bookings'));
    }

    public function processPayment(Request $request)
    {
        $id = $request->booking_id;
        $booking = Booking::find($id);
        
        if ($booking) {
            // Update Extra Charges if any
            $extra = floatval($request->petrol_charge ?? 0) + floatval($request->venue_charge ?? 0);
            if ($extra > 0) {
                $booking->extra_charges = ($booking->extra_charges ?? 0) + $extra;
                // Add to total amount? Or leave it as just tracked in extra_charges?
                $booking->total_amount += $extra;
            }

            $booking->payment_status = ($request->payment_type == 'full') ? 'paid' : 'partial';
            $booking->booking_status = 'confirm'; // Client payment confirms the booking
            $booking->save();

            \RealRashid\SweetAlert\Facades\Alert::success('Payment Confirmed', 'Your booking has been successfully confirmed!');

            // Notification for Admin
            Notification::createNotification(null, 'admin', 'Payment Received', 'Payment received for booking ID: ' . $booking->id, '/booking_management');
            
            // Notification for Client
            if ($booking->client_id) {
                Notification::createNotification($booking->client_id, 'client', 'Payment Confirmed', 'Thank you! Your payment is confirmed and booking is now active.', '/mybooking');
            }
        } else {
            \RealRashid\SweetAlert\Facades\Alert::error('Error', 'Booking not found.');
        }

        return redirect('/mybooking');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $booking = Booking::find($id);
        if ($booking) {
            $booking->delete();
            \RealRashid\SweetAlert\Facades\Alert::success('Deleted', 'Booking record removed.');
        }
        return back();
    }
    public function manageStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        $booking = Booking::find($id);
        if ($booking) {
            $booking->booking_status = $status;
            $booking->save();
            \RealRashid\SweetAlert\Facades\Alert::success('Status Updated', 'Booking status changed to ' . $status);

            // Notification for Client
            if ($booking->client_id) {
                Notification::createNotification($booking->client_id, 'client', 'Booking Status Updated', 'Your booking status has been updated to ' . $status, '/mybooking');
            }
        }
        return back();
    }

    public function updateDetails(Request $request)
    {

        $booking = Booking::find($request->booking_id);
        if ($booking) {
            $booking->booking_status = $request->booking_status;
            $booking->payment_status = $request->payment_status;
            $booking->extra_charges = $request->extra_charges;
            $booking->admin_note = $request->admin_note;
            $booking->save();
            \RealRashid\SweetAlert\Facades\Alert::success('Success', 'Booking details updated.');

            // Notification for Client
            if ($booking->client_id) {
                Notification::createNotification($booking->client_id, 'client', 'Booking Details Updated', 'Admin has updated details for your booking.', '/mybooking');
            }
        }
        return back();
    }
    public function cancelBooking(Request $request)
    {
        $id = $request->cancel_id;
        $booking = Booking::find($id);

        if ($booking) {
            // Only allow cancellation if it's not already completed or cancelled
            if ($booking->booking_status == 'completed' || $booking->booking_status == 'cancelled') {
                \RealRashid\SweetAlert\Facades\Alert::error('Cannot Cancel', 'This booking cannot be cancelled as it is already ' . $booking->booking_status);
                return back();
            }

            $booking->booking_status = 'cancelled';
            $booking->save();

            \RealRashid\SweetAlert\Facades\Alert::success('Cancelled', 'Your booking request has been cancelled.');

            // Notification for Admin
            Notification::createNotification(null, 'admin', 'Booking Cancelled By Client', 'Booking ID: ' . $booking->id . ' has been cancelled by the client.', '/booking_management');
            
            // Notification for Client
            if ($booking->client_id) {
                Notification::createNotification($booking->client_id, 'client', 'Booking Cancelled', 'You have cancelled your booking request (ID: ' . $booking->id . ').', '/mybooking');
            }
        } else {
            \RealRashid\SweetAlert\Facades\Alert::error('Error', 'Booking not found.');
        }

        return back();
    }
}
