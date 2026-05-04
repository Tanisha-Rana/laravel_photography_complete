<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhotographerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Models\Client;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\NotificationController;    
use App\Http\Controllers\PackageController;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\SupportTicketController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdvancePaymentController;
use App\Http\Controllers\FullPaymentController;
use App\Http\Controllers\PhotographerDashboardController;
use App\Http\Controllers\EditorDashboardController;
use App\Http\Controllers\PhotographerLoginController;
use App\Http\Controllers\AssignedTaskController;


//----Website Routes----//


Route::get('/', function () {
    $gallery_arr = \App\Models\Gallery::latest()->take(12)->get();
    return view('website.index', compact('gallery_arr'));
});

Route::get('/index', function () {
    return view('website.index');
});

Route::get('/about', function () {
    return view('website.about');
});



Route::get('/booking-status', function () {
    return view('website.booking-status');
});

Route::get('/booking', [BookingController::class, 'create']);
Route::post('/booking', [BookingController::class, 'store']);
Route::get('/get-category-data', [BookingController::class, 'getCategoryData']);

Route::get('/catalogues', [CatalogueController::class, 'websiteCatalogues']);

Route::get('/categories', [CategoryController::class, 'websiteCategories']);

Route::get('/contact', [EnquiryController::class, 'create']);
Route::post('/contact', [EnquiryController::class, 'store']);

Route::get('/edit_profile', function () {
    if (!session()->has('client_id')) {
        return redirect('/login');
    }

    $user = Client::find(session('client_id'));
    if (!$user) {
        return redirect('/login');
    }

    return view('website.edit_profile', compact('user'));
});

Route::post('/edit_profile', function (\Illuminate\Http\Request $request) {
    if (!session()->has('client_id')) {
        return redirect('/login');
    }

    $user = Client::find(session('client_id'));
    if (!$user) {
        return redirect('/login');
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
    ]);

    $user->name = $request->name;
    $user->phone = $request->phone;

    $user->save();
    return redirect('/')->with('profile_updated', 'Your profile has been updated successfully.');
});

Route::get('/gallery', [GalleryController::class, 'websiteGallery']);


Route::get('/invoice', function () {
    return view('website.invoice');
});

Route::get('/login',[ClientController::class,'login']);
Route::post('/login_auth',[ClientController::class,'login_auth']);
Route::get('/logout',[ClientController::class,'logout']);


Route::get('/forgot-password', function () {
    return view('website.forgot_password');
});

Route::post('/forgot/send-otp', [AuthController::class, 'sendForgotOtp']);
Route::post('/forgot/reset', [AuthController::class, 'resetPassword']);

Route::get('/mybooking', [BookingController::class, 'mybookings']);
Route::get('/cancel_booking', [BookingController::class, 'cancelBooking']);

Route::get('/notifications', function () {
    $client_id = session('client_id');
    $notifications = \App\Models\Notification::where('client_id', $client_id)
        ->orderBy('id', 'asc')
        ->get();
    
    // Mark as read
    if ($client_id) {
        \App\Models\Notification::where('client_id', $client_id)
            ->update(['is_read' => 'yes']);
    }
        
    return view('website.notifications', compact('notifications'));
});

Route::get('/packages', [PackageController::class, 'show_package']);

Route::get('/payment-confirm', function () {
    return view('website.payment-confirm');
});

Route::get('/payment-failed', function () {
    return view('website.payment-failed');
});

Route::get('/payment', function (\Illuminate\Http\Request $request) {
    // Basic rendering handler if you have raw PHP inside the view expecting $booking
    $id = $request->query('booking_id') ?? $request->session('booking_id');
    $book = \Illuminate\Support\Facades\DB::table('bookings')
        ->join('categories', 'bookings.category_id', '=', 'categories.id')
        ->join('packages', 'bookings.package_id', '=', 'packages.id')
        ->join('slots', 'bookings.slot_id', '=', 'slots.id')
        ->where('bookings.id', $id)
        ->select('bookings.*', 'bookings.id as booking_id', 'categories.category_name', 'packages.package_name', 'slots.slot_name')
        ->first();
    if (!$book) return redirect('/mybooking');
    
    $book->theme_names = '';
    if ($book->catalogue_id) {
        $ids = explode(',', $book->catalogue_id);
        $themes = \Illuminate\Support\Facades\DB::table('catalogues')->whereIn('id', $ids)->pluck('catalogue_name')->toArray();
        $book->theme_names = implode(', ', $themes);
    }
    
    return view('website.payment', ['booking' => $book]);
});

Route::post('/payment', [BookingController::class, 'processPayment']);



Route::get('/profile', function () {
    if (!session()->has('client_id')) {
        return redirect('/login');
    }

    $user = Client::find(session('client_id'));
    if (!$user) {
        return redirect('/login');
    }

    return view('website.profile', compact('user'));
});

Route::get('/registration', [ClientController::class, 'create']);
Route::post('/signup/verify', [ClientController::class, 'store']);
Route::post('/registration', [ClientController::class, 'store']);




Route::get('/submit-review', function () {
    return view('website.submit-review');
});



Route::get('/team', function () {
    return view('website.team');
});

Route::get('/testimonial', function () {
    return view('website.testimonial');
});



//----Admin Routes----//

use App\Http\Controllers\AdminDashboardController;

Route::get('/dashboard', [AdminDashboardController::class, 'index']);


Route::get('add_photographer', [PhotographerController::class, 'create']);
Route::post('add_photographer', [PhotographerController::class, 'store']);
Route::get('edit_photographer/{id}', [PhotographerController::class, 'edit']);
Route::post('edit_photographer/{id}', [PhotographerController::class, 'update']);
Route::get('/photographer_management', [PhotographerController::class, 'show']);
Route::get('delete_photographer/{id}', [PhotographerController::class, 'destroy']);
Route::post('admin/assign_photographer', [PhotographerController::class, 'assignPhotographer']);



Route::get('add_assigned_task', [AssignedTaskController::class, 'create']);
Route::post('add_assigned_task', [AssignedTaskController::class, 'store']);
Route::get('/assigned_tasks_management', [AssignedTaskController::class, 'show']);
Route::get('edit_assigned_task/{id}', [AssignedTaskController::class, 'edit']);
Route::post('edit_assigned_task/{id}', [AssignedTaskController::class, 'update']);
Route::get('delete_assigned_task/{id}', [AssignedTaskController::class, 'destroy']);




Route::match(['get', 'post'], 'admin_login', [AuthController::class, 'login']);


Route::get('/booking_management', [BookingController::class, 'index']);
Route::get('admin/manage_status', [BookingController::class, 'manageStatus']);
Route::post('admin/update_booking_details', [BookingController::class, 'updateDetails']);
Route::get('admin/delete_booking/{id}', [BookingController::class, 'destroy']);


Route::get('add_categories', [CategoryController::class, 'create']);
Route::post('add_categories', [CategoryController::class, 'store']);
Route::get('edit_categories/{id}', [CategoryController::class, 'edit']);
Route::post('edit_categories/{id}', [CategoryController::class, 'update']);
Route::get('/categories_management', [CategoryController::class, 'show']);
Route::get('delete_category/{id}', [CategoryController::class, 'destroy']);
Route::get('status_category/{id}', [CategoryController::class, 'status_change']);



Route::get('add_catalogues', [CatalogueController::class, 'create']);
Route::post('add_catalogues', [CatalogueController::class, 'store']);
Route::get('edit_catalogues/{id}', [CatalogueController::class, 'edit']);
Route::post('edit_catalogues/{id}', [CatalogueController::class, 'update']);
Route::get('/catelogues_management', [CatalogueController::class, 'show']);
Route::get('delete_catalogue/{id}', [CatalogueController::class, 'destroy']);


Route::get('/client_management', [ClientController::class, 'show']);

Route::get('/enquiry_management', [EnquiryController::class, 'show']);

Route::get('/send-mail',[EnquiryController::class,'sendmail']);


Route::get('/feedback_management', function () {
    $feed_arr = \Illuminate\Support\Facades\DB::table('feedback')
        ->leftJoin('bookings', 'feedback.booking_id', '=', 'bookings.id')
        ->leftJoin('clients', 'bookings.client_id', '=', 'clients.id')
        ->select('feedback.*', 'feedback.id as feedback_id', 'clients.name as client_name')
        ->get();
    return view('admin.feedback_management', compact('feed_arr'));
});

Route::get('add_gallery', [GalleryController::class, 'create']);
Route::post('add_gallery', [GalleryController::class, 'store']);
Route::get('/gallery_management', [GalleryController::class, 'show']);
Route::get('delete_gallery/{id}', [GalleryController::class, 'destroy']);
Route::get('edit_gallery/{id}', [GalleryController::class, 'edit']);
Route::post('edit_gallery/{id}', [GalleryController::class, 'update']);


Route::get('/invoice_management', [InvoiceController::class, 'index']);

Route::get('admin/generate_invoice/{booking_id}', [InvoiceController::class, 'generate']);
Route::get('admin/view_invoice/{invoice_id}', [InvoiceController::class, 'view']);


Route::get('/notifications_management', function () {
    $notif_arr = \App\Models\Notification::orderBy('id', 'asc')->get();
    return view('admin.notifications_management', compact('notif_arr'));
});

Route::get('/package_management', [PackageController::class, 'show']);
Route::get('add_packages', [PackageController::class, 'create']);
Route::post('add_packages', [PackageController::class, 'store']);
Route::get('edit_packages/{id}', [PackageController::class, 'edit']);
Route::post('edit_packages/{id}', [PackageController::class, 'update']);
Route::get('delete_package/{id}', [PackageController::class, 'destroy']);

Route::get('/slot_management', [SlotController::class, 'show']);
Route::get('add_slots', [SlotController::class, 'create']);
Route::post('add_slots', [SlotController::class, 'store']);
Route::get('edit_slots/{id}', [SlotController::class, 'edit']);
Route::post('edit_slots/{id}', [SlotController::class, 'update']);
Route::get('delete_slot/{id}', [SlotController::class, 'destroy']);





Route::get('/reports', [AdminDashboardController::class, 'reports']);

Route::get('/advance_payment', function () {
    return view('admin.advance_payment');
});

Route::get('/full_payment', function () {
    return view('admin.full_payment');
});

//----Photographer Routes----//
Route::get('photographer/login', [PhotographerLoginController::class, 'login']);
Route::post('photographer/login', [PhotographerLoginController::class, 'loginVerify']);
Route::get('photographer/logout', [PhotographerLoginController::class, 'logout']);

Route::prefix('photographer')->group(function () {
    Route::get('/dashboard', [PhotographerDashboardController::class, 'index']);
    Route::get('/bookings', [PhotographerDashboardController::class, 'bookings']);
    Route::get('/gallery', [PhotographerDashboardController::class, 'gallery']);
    Route::get('/slots', [PhotographerDashboardController::class, 'slots']);

    Route::get('/notifications', [PhotographerDashboardController::class, 'notifications']);
    Route::get('/feedback', [PhotographerDashboardController::class, 'feedback']);

    // Admin-shared routes for photographer 
    Route::get('gallery_management', [GalleryController::class, 'show']);
    Route::get('add_gallery', [GalleryController::class, 'create']);
    Route::post('add_gallery', [GalleryController::class, 'store']);
    Route::get('edit_gallery/{id}', [GalleryController::class, 'edit']);
    Route::post('edit_gallery/{id}', [GalleryController::class, 'update']);
    Route::get('delete_gallery/{id}', [GalleryController::class, 'destroy']);
});








