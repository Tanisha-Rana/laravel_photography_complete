<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index()
    {
        $inv_arr = DB::table('invoices')
            ->select('id as invoice_id', 'booking_id', 'invoice_number', 'invoice_date', 'total_amount', 'created_at')
            ->get();
        return view('admin.invoice_management', compact('inv_arr'));
    }

    public function generate($booking_id)
    {
        $booking = DB::table('bookings')
            ->join('clients', 'bookings.client_id', '=', 'clients.id')
            ->join('categories', 'bookings.category_id', '=', 'categories.id')
            ->join('packages', 'bookings.package_id', '=', 'packages.id')
            ->join('slots', 'bookings.slot_id', '=', 'slots.id')
            ->where('bookings.id', $booking_id)
            ->select('bookings.*', 'clients.*', 'categories.category_name', 'packages.package_name', 'slots.slot_name')
            ->first();

        if (!$booking) {
            return back()->with('error', 'Booking not found');
        }

        // Check if invoice already exists
        $invoice = Invoice::where('booking_id', $booking_id)->first();
        if (!$invoice) {
            $invoice = new Invoice();
            $invoice->booking_id = $booking_id;
            $invoice->invoice_number = 'INV-' . strtoupper(uniqid());
            $invoice->invoice_date = date('Y-m-d');
            $invoice->total_amount = $booking->total_amount + ($booking->extra_charges ?? 0);
            $invoice->save();
        }

        return redirect('admin/view_invoice/' . $invoice->id);
    }

    public function view($invoice_id)
    {
        $invoice = Invoice::findOrFail($invoice_id);
        $booking = DB::table('bookings')
            ->join('clients', 'bookings.client_id', '=', 'clients.id')
            ->join('categories', 'bookings.category_id', '=', 'categories.id')
            ->join('packages', 'bookings.package_id', '=', 'packages.id')
            ->join('slots', 'bookings.slot_id', '=', 'slots.id')
            ->where('bookings.id', $invoice->booking_id)
            ->select('bookings.*', 'clients.*', 'categories.category_name', 'packages.package_name', 'slots.slot_name')
            ->first();

        // Calculate themes/catalogues
        $booking->theme_names = '';
        if ($booking->catalogue_id) {
            $ids = explode(',', $booking->catalogue_id);
            $themes = DB::table('catalogues')->whereIn('id', $ids)->pluck('catalogue_name')->toArray();
            $booking->theme_names = implode(', ', $themes);
        }

        return view('admin.invoice_print', compact('invoice', 'booking'));
    }
}
