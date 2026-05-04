<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Booking;
use App\Models\Enquiry;
use App\Models\Package;
use App\Models\Gallery;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_revenue' => Booking::where('booking_status', 'confirm')->sum('total_amount'),
            'total_clients' => Client::count(),
            'total_bookings' => Booking::count(),
            'total_enquiries' => Enquiry::count(),
            'total_packages' => Package::count(),
            'total_gallery' => Gallery::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function reports()
    {
        // Top Packages
        $pop_pkg = DB::table('bookings')
            ->join('packages', 'bookings.package_id', '=', 'packages.id')
            ->select('packages.package_name', DB::raw('count(bookings.id) as count'))
            ->groupBy('packages.id', 'packages.package_name')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get();

        // Category Breakdown
        $cat_dist = DB::table('bookings')
            ->join('categories', 'bookings.category_id', '=', 'categories.id')
            ->select('categories.category_name', DB::raw('count(bookings.id) as count'))
            ->groupBy('categories.id', 'categories.category_name')
            ->get();

        // Monthly Revenue (Last 6 Months)
        $rev_chart = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $total = Booking::where('booking_status', 'confirm')
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->sum('total_amount');

            $rev_chart[] = (object)[
                'month' => $month->format('M Y'),
                'total' => $total
            ];
        }

        return view('admin.reports', compact('pop_pkg', 'cat_dist', 'rev_chart'));
    }
}

