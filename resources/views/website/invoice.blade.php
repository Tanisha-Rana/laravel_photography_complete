<?php
// Prevent any direct output before the script
ob_start();

// Include data context indirectly via model
include_once('../website/model.php');
$model = new model();

if (!isset($_GET['booking_id'])) {
    die("Booking ID required");
}

$booking_id = $_GET['booking_id'];

// Fetch booking details with extra info
$query = "SELECT b.*, c.category_name, p.package_name, p.price as package_price, a.appointment_date, s.slot_name, cl.name as client_name, cl.phone as client_phone, cl.email as client_email
          FROM bookings b
          JOIN appointments a ON b.appointment_id = a.appointment_id
          JOIN clients cl ON a.client_id = cl.client_id
          JOIN categories c ON b.category_id = c.category_id
          JOIN packages p ON b.package_id = p.package_id
          JOIN slots s ON a.slot_id = s.slot_id
          WHERE b.booking_id = $booking_id";

$res = $model->conn->query($query);
$data = $res->fetch_object();

if (!$data) {
    die("Booking not found");
}

// Calculate addon total for display logic
$addon_total = (float)$data->total_amount - (float)$data->package_price - (float)$data->petrol_charge - (float)$data->venue_charge;

// Clear any buffered output
ob_clean();

// Start of HTML content
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice_#<?= $data->booking_id ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #E7B894;
            --secondary-color: #2c3e50;
            --text-dark: #333;
            --text-light: #777;
            --border-color: #eee;
        }
        
        body { 
            font-family: 'Inter', sans-serif; 
            color: var(--text-dark); 
            line-height: 1.6; 
            background: #fdfdfd;
            margin: 0;
            padding: 20px;
        }
        
        .invoice-container { 
            max-width: 850px; 
            margin: auto; 
            padding: 50px; 
            background: #fff;
            border: 1px solid var(--border-color); 
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05); 
            position: relative;
        }
        
        /* Ribbon style status */
        .status-badge {
            position: absolute;
            top: 40px;
            right: -10px;
            padding: 8px 25px;
            color: #fff;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 14px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .status-paid { background: #28a745; }
        .status-partial { background: #007bff; }
        .status-unpaid { background: #dc3545; }

        .header { 
            display: flex; 
            justify-content: space-between; 
            align-items: flex-start; 
            border-bottom: 3px solid var(--primary-color); 
            padding-bottom: 30px; 
            margin-bottom: 40px; 
        }
        
        .brand-section { display: flex; align-items: center; gap: 20px; }
        .logo-img { width: 80px; height: 80px; object-fit: cover; border-radius: 12px; }
        .brand-name { 
            font-family: 'Dancing Script', cursive; 
            font-size: 32px; 
            color: var(--primary-color); 
            margin: 0; 
        }
        
        .invoice-title { text-align: right; }
        .invoice-title h1 { margin: 0; font-size: 40px; letter-spacing: -1px; color: #eee; text-transform: uppercase; }
        .invoice-title p { margin: 5px 0 0; font-weight: 600; color: var(--text-dark); }

        .info-grid { 
            display: grid; 
            grid-template-columns: 1fr 1fr; 
            gap: 40px; 
            margin-bottom: 50px; 
        }
        
        .info-box h4 { 
            margin: 0 0 15px; 
            font-size: 13px; 
            text-transform: uppercase; 
            color: var(--text-light); 
            letter-spacing: 1px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 5px;
        }
        .info-box p { margin: 2px 0; font-size: 15px; }

        .items-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 40px; 
        }
        .items-table th { 
            background: #fbfbfb; 
            padding: 15px; 
            text-align: left; 
            border-bottom: 2px solid var(--border-color); 
            font-size: 13px;
            text-transform: uppercase;
            color: var(--text-light);
        }
        .items-table td { 
            padding: 20px 15px; 
            border-bottom: 1px solid var(--border-color); 
            font-size: 15px;
        }
        .items-table td.amount { text-align: right; font-weight: 600; }

        .summary-section { 
            display: flex; 
            justify-content: flex-end; 
        }
        .summary-box { width: 300px; }
        .summary-row { display: flex; justify-content: space-between; padding: 10px 0; }
        .summary-row.grand-total { 
            border-top: 2px solid var(--primary-color); 
            margin-top: 10px; 
            font-size: 20px; 
            font-weight: 700;
            color: var(--primary-color);
        }

        .thank-you { 
            text-align: center; 
            margin-top: 80px; 
            padding: 30px;
            background: #fffaf7;
            border-radius: 15px;
        }
        .thank-you h3 { font-family: 'Dancing Script', cursive; font-size: 24px; color: var(--primary-color); margin-bottom: 10px; }
        
        .footer-note { 
            text-align: center; 
            margin-top: 30px; 
            font-size: 12px; 
            color: var(--text-light); 
        }

        .action-bar { 
            max-width: 850px; 
            margin: 0 auto 20px; 
            display: flex; 
            justify-content: flex-end; 
            gap: 15px;
        }
        .btn { 
            padding: 12px 25px; 
            border-radius: 8px; 
            font-weight: 600; 
            cursor: pointer; 
            border: none; 
            transition: 0.3s;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .btn-print { background: var(--primary-color); color: #000; }
        .btn-print:hover { background: #d4a37f; }
        
        @media print { 
            body { background: #fff; padding: 0; }
            .invoice-container { box-shadow: none; border: none; padding: 0; }
            .action-bar { display: none; }
            .status-badge { right: 0; }
        }
    </style>
</head>
<body>

<div class="action-bar">
    <button class="btn btn-print" onclick="window.print()">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
            <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1-1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
        </svg>
        Print / Save as PDF
    </button>
</div>

<div class="invoice-container">
    <div class="status-badge status-<?= $data->payment_status ?>">
        <?= $data->payment_status ?>
    </div>

    <div class="header">
        <div class="brand-section">
            <img src="img/image1.png" class="logo-img" alt="Logo">
            <div>
                <h1 class="brand-name">Photography By Monali</h1>
                <p style="margin:0; font-size:13px; color:var(--text-light);">Caturting Your Precious Moments</p>
            </div>
        </div>
        <div class="invoice-title">
            <h1>Invoice</h1>
            <p>Order #PH-<?= str_pad($data->booking_id, 4, '0', STR_PAD_LEFT) ?></p>
        </div>
    </div>

    <div class="info-grid">
        <div class="info-box">
            <h4>Billed To</h4>
            <p><strong><?= $data->client_name ?></strong></p>
            <p><?= $data->client_phone ?></p>
            <p><?= $data->client_email ?></p>
        </div>
        <div class="info-box" style="text-align: right;">
            <h4>Session Details</h4>
            <p><strong>Category:</strong> <?= $data->category_name ?></p>
            <p><strong>Date:</strong> <?= date('d M Y', strtotime($data->appointment_date)) ?></p>
            <p><strong>Slot:</strong> <?= $data->slot_name ?></p>
        </div>
    </div>

    <table class="items-table">
        <thead>
            <tr>
                <th>Description</th>
                <th style="width: 150px; text-align: right;">Rate</th>
                <th style="width: 150px; text-align: right;">Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <strong>Photography Package</strong><br>
                    <small style="color:var(--text-light)"><?= $data->package_name ?></small>
                </td>
                <td style="text-align: right;">₹<?= number_format($data->package_price, 2) ?></td>
                <td class="amount">₹<?= number_format($data->package_price, 2) ?></td>
            </tr>
            
            <?php if($addon_total > 0): ?>
            <tr>
                <td>
                    <strong>Add-on Services</strong><br>
                    <small style="color:var(--text-light)"><?= $data->addons ?></small>
                </td>
                <td style="text-align: right;">₹<?= number_format($addon_total, 2) ?></td>
                <td class="amount">₹<?= number_format($addon_total, 2) ?></td>
            </tr>
            <?php endif; ?>

            <?php if($data->petrol_charge > 0): ?>
            <tr>
                <td><strong>Travel & Transport Charges</strong></td>
                <td style="text-align: right;">₹<?= number_format($data->petrol_charge, 2) ?></td>
                <td class="amount">₹<?= number_format($data->petrol_charge, 2) ?></td>
            </tr>
            <?php endif; ?>

            <?php if($data->venue_charge > 0): ?>
            <tr>
                <td><strong>Outdoor Venue / Home Visit Charges</strong></td>
                <td style="text-align: right;">₹<?= number_format($data->venue_charge, 2) ?></td>
                <td class="amount">₹<?= number_format($data->venue_charge, 2) ?></td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="summary-section">
        <div class="summary-box">
            <div class="summary-row">
                <span>Subtotal:</span>
                <span>₹<?= number_format($data->total_amount, 2) ?></span>
            </div>
            <div class="summary-row" style="color: #28a745;">
                <span>Advance Paid:</span>
                <span>- ₹<?= number_format($data->advance_amount, 2) ?></span>
            </div>
            <div class="summary-row grand-total">
                <span>Balance Due:</span>
                <span>₹<?= number_format($data->remaining_amount, 2) ?></span>
            </div>
        </div>
    </div>

    <div class="thank-you">
        <h3>Thank You!</h3>
        <p style="margin:0; color:var(--text-light);">We look forward to capturing your beautiful story.</p>
    </div>

    <div class="footer-note">
        <p><strong>Photography By Monali Studio</strong></p>
        <p>Surat, Gujarat | +91 99999 88888 | monaliphotography@gmail.com</p>
        <p style="margin-top:20px; font-size:10px; opacity:0.6;">This is a computer-generated invoice. No signature required.</p>
    </div>
</div>

</body>
</html>
