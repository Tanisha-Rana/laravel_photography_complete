@extends('admin.layout.structure')

@section('content')
<style>
    @media print {
        .sidebar, .navbar, .btn-print, .btn-back { display: none !important; }
        .main-content { margin: 0 !important; padding: 0 !important; }
        .invoice-card { box-shadow: none !important; border: 1px solid #eee !important; }
    }
    .invoice-card {
        max-width: 850px;
        margin: auto;
        background: #fff;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    }
    .invoice-header {
        border-bottom: 2px solid #f8f9fb;
        padding-bottom: 25px;
        margin-bottom: 30px;
    }
    .brand-name {
        font-size: 28px;
        font-weight: 800;
        color: #E7B894;
    }
    .invoice-label {
        color: #6c757d;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 4px;
        font-weight: 600;
    }
    .invoice-value {
        font-weight: 700;
        color: #222;
        font-size: 15px;
    }
    .table-totals td {
        border: none !important;
        padding: 8px 0;
    }
    .grand-total {
        font-size: 20px;
        font-weight: 800;
        color: #000;
        border-top: 2px solid #222 !important;
        padding-top: 15px !important;
    }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 max-850 mx-auto">
        <a href="{{ url('booking_management') }}" class="btn btn-light rounded-pill px-4 btn-back">
            <i class="bi bi-arrow-left me-2"></i> Back to Bookings
        </a>
        <button onclick="window.print()" class="btn btn-dark rounded-pill px-4 btn-print">
            <i class="bi bi-printer me-2"></i> Print Invoice
        </button>
    </div>

    <div class="invoice-card">
        <!-- HEADER -->
        <div class="invoice-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="brand-name">Photography By Monali</div>
                    <p class="text-muted small mb-0">Professional Photography Services<br>Pune, Maharashtra, India</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h2 class="fw-black text-uppercase letter-spacing-2 mb-1">INVOICE</h2>
                    <p class="text-muted small mb-0">{{ $invoice->invoice_number }}</p>
                </div>
            </div>
        </div>

        <!-- DETAILS -->
        <div class="row mb-5">
            <div class="col-md-4">
                <div class="invoice-label">Billed To</div>
                <div class="invoice-value fs-5">{{ $booking->name }}</div>
                <div class="text-muted small">{{ $booking->phone }}<br>{{ $booking->email }}</div>
            </div>
            <div class="col-md-4 text-md-center">
                <div class="invoice-label">Invoice Date</div>
                <div class="invoice-value">{{ date('d M, Y', strtotime($invoice->updated_at)) }}</div>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="invoice-label">Session Date</div>
                <div class="invoice-value">{{ date('d M, Y', strtotime($booking->appointment_date)) }}</div>
                <div class="small text-muted">{{ $booking->slot_name }}</div>
            </div>
        </div>

        <!-- SERVICES TABLE -->
        <div class="table-responsive mb-5">
            <table class="table table-borderless">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-3 py-3 rounded-start">SERVICE DESCRIPTION</th>
                        <th class="text-center py-3">QTY</th>
                        <th class="text-end pe-3 py-3 rounded-end">AMOUNT</th>
                    </tr>
                </thead>
                <tbody class="border-bottom">
                    <tr>
                        <td class="ps-3 pt-4">
                            <div class="fw-bold">{{ $booking->category_name }}</div>
                            <small class="text-muted">Package: {{ $booking->package_name }}</small>
                            @if($booking->theme_names)
                                <br><small class="text-muted">Themes: {{ $booking->theme_names }}</small>
                            @endif
                            @if($booking->addons)
                                <br><small class="text-info">Addons: {{ $booking->addons }}</small>
                            @endif
                        </td>
                        <td class="text-center pt-4">1</td>
                        <td class="text-end pe-3 pt-4">₹{{ number_format($booking->total_amount, 2) }}</td>
                    </tr>
                    @if($booking->extra_charges > 0)
                    <tr>
                        <td class="ps-3">
                            <div class="fw-bold">Extra Charges</div>
                            <small class="text-muted">Travel/Petrol/Misc</small>
                        </td>
                        <td class="text-center">1</td>
                        <td class="text-end pe-3">₹{{ number_format($booking->extra_charges, 2) }}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- TOTALS -->
        <div class="row mt-4">
            <div class="col-md-7">
                <div class="invoice-label">Terms & Conditions</div>
                <ul class="text-muted x-small" style="font-size: 11px;">
                    <li>Raw photos are not part of the deliverables unless specified.</li>
                    <li>20% Advance is non-refundable in case of cancellation.</li>
                    <li>Full payment must be cleared before the final delivery.</li>
                </ul>
            </div>
            <div class="col-md-5">
                <table class="table table-totals">
                    <tr>
                        <td class="text-muted">Subtotal</td>
                        <td class="text-end fw-bold">₹{{ number_format($booking->total_amount + ($booking->extra_charges ?? 0), 2) }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Discount</td>
                        <td class="text-end text-success fw-bold">- ₹0.00</td>
                    </tr>
                    <tr>
                        <td class="invoice-value grand-total">Total Amount</td>
                        <td class="text-end grand-total">₹{{ number_format($booking->total_amount + ($booking->extra_charges ?? 0), 2) }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- FOOTER -->
        <div class="mt-5 pt-4 text-center border-top">
            <p class="mb-1 fw-bold">Thank you for choosing Photography By Monali!</p>
            <p class="text-muted small">This is a system generated invoice. No signature required.</p>
        </div>
    </div>
</div>

<style>
    .max-850 { max-width: 850px; }
    .x-small { font-size: 11px; }
    .fw-black { font-weight: 900; }
    .letter-spacing-2 { letter-spacing: 2px; }
</style>
@endsection
