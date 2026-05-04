@extends('website.layout.structure')

@section('content')

<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="text-center mb-5">
                <h1 class="font-dancing-script text-primary border-bottom d-inline-block pb-2">Finalize Your Booking</h1>
                <p class="text-muted mt-2">Secure your photography session with a payment</p>
            </div>
            
            <div class="row g-4">
                <!-- Booking Summary Card -->
                <div class="col-md-5">
                    <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                        <div class="bg-primary p-4 text-white text-center">
                            <h5 class="mb-0">Booking Summary</h5>
                            <small class="opacity-75">ID: #<?= $booking->booking_id ?></small>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Category:</span>
                                <span class="fw-bold text-dark"><?= $booking->category_name ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-3 text-end">
                                <span class="text-muted">Themes:</span>
                                <span class="fw-bold text-dark ms-3"><?= $booking->theme_names ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Package:</span>
                                <span class="fw-bold text-dark"><?= $booking->package_name ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Date:</span>
                                <span class="fw-bold text-dark"><?= date('d M Y', strtotime($booking->appointment_date)) ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-4">
                                <span class="text-muted">Time Slot:</span>
                                <span class="fw-bold text-primary"><?= $booking->slot_name ?></span>
                            </div>
                            
                            <hr class="dashed">
                            
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <h5 class="mb-0">Total Amount:</h5>
                                <h3 id="live_total" class="mb-0 text-primary">₹<?= number_format($booking->total_amount, 2) ?></h3>
                            </div>
                            <div id="extras_detail" class="small text-muted mt-1"></div>
                        </div>
                        <div class="bg-light p-3 text-center">
                            <i class="bi bi-shield-lock-fill text-success me-2"></i> 
                            <small class="text-muted">100% Secure SSL Payment</small>
                        </div>
                    </div>
                </div>

                <!-- Payment Form Card -->
                <div class="col-md-7">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-body p-4">
                            <form method="post" id="paymentForm">
                                @csrf
                                <input type="hidden" name="booking_id" value="<?= $booking->booking_id ?>">
                                <input type="hidden" name="total_amount" id="db_total" value="<?= $booking->total_amount ?>" data-base="<?= $booking->total_amount ?>">

                                <!-- Extras section -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Additional Charges (optional)</label>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small">Petrol Charges (₹)</label>
                                                <input type="number" min="0" step="0.01" id="petrol_charge" name="petrol_charge" value="500" class="form-control" onchange="recalcTotal()">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small">Venue / Home Visit Charges (₹)</label>
                                                <input type="number" min="0" step="0.01" id="venue_charge" name="venue_charge" value="1000" class="form-control" onchange="recalcTotal()">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <label class="form-label fw-bold mb-3">Select Payment Method</label>
                                <div class="row g-3 mb-4">
                                    <div class="col-6">
                                        <?php $advance = round($booking->total_amount * 0.20, 2); // 20% Advance ?>
                                        <div class="payment-option text-center p-3 rounded-3 border active" onclick="setPaymentType('advance', <?= $advance ?>); togglePayMethod('card')">
                                            <input type="radio" name="payment_type" value="advance" class="d-none" checked>
                                            <i class="bi bi-clock-history fs-3 d-block mb-1"></i>
                                            <span class="fw-bold">20% Advance</span>
                                            <small class="d-block text-muted">₹<?= number_format($advance, 2) ?></small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="payment-option text-center p-3 rounded-3 border" onclick="setPaymentType('full', <?= $booking->total_amount ?>); togglePayMethod('card')">
                                            <input type="radio" name="payment_type" value="full" class="d-none">
                                            <i class="bi bi-wallet2 fs-3 d-block mb-1"></i>
                                            <span class="fw-bold">Pay Full</span>
                                            <small class="d-block text-muted">₹<?= number_format($booking->total_amount, 2) ?></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex mb-4 gap-2">
                                    <button type="button" class="btn btn-outline-dark flex-fill py-2 active-method" id="btn-qr" onclick="togglePayMethod('qr')">
                                        <i class="bi bi-qr-code-scan me-2"></i> QR Code
                                    </button>
                                    <button type="button" class="btn btn-outline-dark flex-fill py-2" id="btn-card" onclick="togglePayMethod('card')">
                                        <i class="bi bi-credit-card me-2"></i> Card
                                    </button>
                                </div>

                                <div id="payment-content">
                                    <!-- CARD DETAILS -->
                                    <div id="card-section" class="payment-details-form bg-light p-4 rounded-3 border" style="display: none;">
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">CARD HOLDER NAME</label>
                                            <input type="text" name="card_holder" class="form-control border-0 shadow-sm" placeholder="Enter Full Name" id="card_holder">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">CARD NUMBER</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control border-0 shadow-sm" maxlength="19" placeholder="0000 0000 0000 0000" id="card_num">
                                                <span class="input-group-text border-0 bg-white"><i class="bi bi-credit-card"></i></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 mb-3">
                                                <label class="form-label small fw-bold">EXPIRY DATE</label>
                                                <input type="text" class="form-control border-0 shadow-sm" placeholder="MM/YY" maxlength="5">
                                            </div>
                                            <div class="col-6 mb-3">
                                                <label class="form-label small fw-bold">CVV</label>
                                                <input type="password" class="form-control border-0 shadow-sm" placeholder="***" maxlength="3">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- QR CODE SECTION -->
                                    <div id="qr-section" class="bg-white p-4 rounded-4 border shadow-sm text-center mx-auto" style="display: block; max-width: 400px;">
                                        <!-- QR image + info -->
                                        <div id="qr-image-container" style="display: block;">
                                            <div class="mb-4">
                                                <div class="d-inline-block p-2 bg-success bg-opacity-10 rounded-circle mb-3">
                                                    <i class="bi bi-qr-code-scan text-success fs-3"></i>
                                                </div>
                                                <h5 class="fw-bold mb-1">Scan to Pay</h5>
                                                <p class="small text-muted mb-0">Scan with any UPI App – amount will auto‑fill</p>
                                            </div>

                                            <?php 
                                                // UPI parameters used by JS as well
                                                $upi_id = "tanvirana2316@okicici";
                                                $advanceAmt = round($booking->total_amount * 0.20, 2); // 20% advance amount
                                                $baseTotal = $booking->total_amount;
                                                $initialAmt = $advanceAmt; // start with advance
                                                $qr_text = "upi://pay?pa=$upi_id&pn=TanishaRana&am=$initialAmt&cu=INR";
                                                $qr_url = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=" . urlencode($qr_text);
                                            ?>

                                            <div class="position-relative d-inline-block bg-white p-3 rounded-4 shadow-sm mb-4" style="border: 2px solid #f0f0f0;">
                                                <img src="<?= asset('admin/images/WhatsApp Image 2026-03-29 at 4.08.49 PM.jpeg') ?>" alt="QR Code" id="qr_image" class="img-fluid rounded" style="width: 240px;">
                                            </div>

                                            <div class="bg-light p-3 rounded-4 mb-3 border">
                                                <h3 class="fw-bold text-dark mb-1" id="pay_amt_text">₹<?= number_format($initialAmt,2) ?></h3>
                                                <div class="d-flex align-items-center justify-content-center gap-2">
                                                    <span class="small text-muted">Paying to: <b>Tanisha Rana</b></span>
                                                    <i class="bi bi-patch-check-fill text-success small"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                        <div class="mb-3">
                                            <span class="badge bg-white text-dark border px-3 py-2 rounded-pill small">
                                                <i class="bi bi-shield-check text-success me-1"></i> 100% Secure Payment
                                            </span>
                                        </div>

                                        <div class="d-flex justify-content-center gap-3 opacity-50 mt-4">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b2/Google_Pay_Logo.svg" height="22">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/e/e1/UPI-Logo.png" height="22">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/2/24/Paytm_Logo_%28standalone%29.svg" height="18">
                                        </div>
                                    </div>

                                    <button type="submit" name="pay_now" id="pay_btn" class="btn btn-primary w-100 py-3 fw-bold mt-4 shadow rounded-pill">
                                        <i class="bi bi-check2-circle me-2"></i> Confirm I have Paid (₹2,000.00)
                                    </button>
                                </div>

                                <!-- VERIFYING SECTION (Appears after scanner hidden) -->
                                <div id="verifying-section" class="text-center py-5" style="display: none;">
                                    <div class="spinner-border text-primary mb-3" role="status" style="width: 3rem; height: 3rem;">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <h4 class="fw-bold">Verifying Payment...</h4>
                                    <p class="text-muted">Please wait while we confirm your transaction with the bank.</p>
                                    <div class="alert alert-info py-2 small d-inline-block mt-3">
                                        <i class="bi bi-info-circle me-1"></i> Do not refresh or close this page
                                    </div>
                                </div>
                                
                                <p class="text-center mt-3 mb-0 small text-muted">
                                    By clicking Pay, you agree to our <a href="#" class="text-decoration-none">Terms & Conditions</a>.
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.dashed { border-top: 2px dashed #eee; border-left: none; border-bottom: none; opacity: 1; }
.payment-option { cursor: pointer; transition: 0.3s; background: #fff; }
.payment-option:hover { border-color: #d81b60; background: #fffafb; }
.payment-option.active { border-color: #d81b60; background: #d81b60; color: #fff; }
.payment-option.active small { color: rgba(255,255,255,0.8) !important; }
</style>

<script>
// Handle Form Submission (Direct Confirm)
document.getElementById('paymentForm').onsubmit = function(e) {
    var qrSection = document.getElementById('qr-section');
    if(qrSection.style.display !== 'none') {
        // Show verifying screen immediately
        document.getElementById('payment-content').style.display = 'none';
        document.getElementById('verifying-section').style.display = 'block';
        return true;
    }
    return true; // Proceed for Card
};

function togglePayMethod(method) {
    var card = document.getElementById('card-section');
    var qr = document.getElementById('qr-section');
    var btnCard = document.getElementById('btn-card');
    var btnQr = document.getElementById('btn-qr');
    var payBtn = document.getElementById('pay_btn');
    
    // Reset Button Styles
    payBtn.classList.add('btn-primary');
    payBtn.classList.remove('btn-success');
    
    if(method == 'qr') {
        card.style.display = 'none';
        qr.style.display = 'block';
        btnQr.classList.add('bg-dark', 'text-white', 'active');
        btnCard.classList.remove('bg-dark', 'text-white', 'active');
        
        var currentAmt = document.getElementById('pay_amt_text').innerText;
        payBtn.innerHTML = '<i class="bi bi-check2-circle me-2"></i> Confirm I have Paid (' + currentAmt + ')';

        // Remove required from card fields
        document.getElementById('card_holder').required = false;
        document.getElementById('card_num').required = false;
    } else {
        card.style.display = 'block';
        qr.style.display = 'none';
        btnCard.classList.add('bg-dark', 'text-white', 'active');
        btnQr.classList.remove('bg-dark', 'text-white', 'active');
        
        var currentAmt = document.getElementById('pay_amt_text').innerText;
        var label = payBtn.innerText.includes('Advance') ? 'Pay Advance' : 'Pay Fully';
        payBtn.innerHTML = '<i class="bi bi-lock me-2"></i> ' + label + ' (' + currentAmt + ')';

        // Add required back to card fields
        document.getElementById('card_holder').required = true;
        document.getElementById('card_num').required = true;
    }
}

function setPaymentType(type, amount) {
    // UI Update for Option Cards
    document.querySelectorAll('.payment-option').forEach(opt => opt.classList.remove('active'));
    event.currentTarget.classList.add('active');
    
    // Radio selection
    document.querySelectorAll('input[name="payment_type"]').forEach(radio => {
        if(radio.value == type) radio.checked = true;
    });
    
    // Update Button & Display Amounts
    var btn = document.getElementById('pay_btn');
    var amtText = '₹' + amount.toLocaleString() + '.00';
    document.getElementById('pay_amt_text').innerText = amtText;
    
    if(document.getElementById('qr-section').style.display !== 'none') {
        btn.innerHTML = '<i class="bi bi-check2-circle me-2"></i> Confirm I have Paid (' + amtText + ')';
    } else {
        var label = (type == 'full') ? 'Pay Fully' : 'Pay Advance';
        btn.innerHTML = '<i class="bi bi-lock me-2"></i> ' + label + ' (' + amtText + ')';
    }
}

// Global totals (base from server, 20% advance defined in PHP)
var baseTotal = parseFloat(document.getElementById('db_total').value) || 0;
var fixedAdvance = Math.round(baseTotal * 0.20); 

// Recalculate totals when extras or payment type changes
function recalcTotal() {
    var petrol = parseFloat(document.getElementById('petrol_charge').value) || 0;
    var venue = parseFloat(document.getElementById('venue_charge').value) || 0;
    var extras = petrol + venue;
    var totalAll = baseTotal + extras;
    // update hidden base total so server sees new value
    document.getElementById('db_total').value = totalAll;

    // update booking summary display
    document.getElementById('live_total').innerText = '₹' + totalAll.toLocaleString(undefined,{minimumFractionDigits:2,maximumFractionDigits:2});
    // show extras breakdown if any
    var extrasDetail = document.getElementById('extras_detail');
    if (extras > 0) {
        extrasDetail.innerText = '(includes ₹' + petrol.toLocaleString() + ' petrol, ₹' + venue.toLocaleString() + ' venue)';
    } else {
        extrasDetail.innerText = '';
    }

    // determine payment amount based on selected type
    var selectedRadio = document.querySelector('input[name="payment_type"]:checked');
    var selectedType = selectedRadio ? selectedRadio.value : 'advance';
    var amount = (selectedType === 'advance') ? (fixedAdvance + extras) : totalAll;

    setPaymentType(selectedType, amount);

    // update QR code image to include new amount if visible
    var upiId = "<?= $upi_id ?>";
    // Dynamic QR update removed since we use static WhatsApp image

}

// Initial state
window.onload = function() {
    togglePayMethod('qr');
    
    // wire up payment option clicks to recalc extras properly
    document.querySelectorAll('.payment-option').forEach(opt => {
        opt.addEventListener('click', function(){
            setTimeout(recalcTotal, 10);
        });
    });
    
    // Check if amount or payment_type is in URL
    var paymentTypeFromUrl = getUrlParameter('payment_type');
    if (paymentTypeFromUrl) {
        var paymentOptions = document.querySelectorAll('.payment-option');
        if (paymentTypeFromUrl === 'advance') {
            paymentOptions[0].click();
        } else if (paymentTypeFromUrl === 'full') {
            paymentOptions[1].click();
        }
    }
    
    // perform initial calculation with any default extras (zero)
    recalcTotal();
};

// New: Handle Form Submission (Hide QR when clicking pay)
document.getElementById('paymentForm').onsubmit = function(e) {
    var qrSection = document.getElementById('qr-section');
    if(qrSection.style.display !== 'none') {
        // Switch views
        document.getElementById('payment-content').style.display = 'none';
        document.getElementById('verifying-section').style.display = 'block';
    }
    // Allow the form to submit to control.php
    return true;
};

// Utility to get URL parameters
function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
};

// Simple card number formatting
document.getElementById('card_num').addEventListener('input', function (e) {
    e.target.value = e.target.value.replace(/[^\d]/g, '').replace(/(.{4})/g, '$1 ').trim();
});
</script>

@endsection
