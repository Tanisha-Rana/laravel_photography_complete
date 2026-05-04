<?php 
include_once ('sidebar.php'); 
include_once ('header.php');
?>

<main class="col-md-10 ms-sm-auto px-4 mt-3">
  <div class="d-flex justify-content-between align-items-center">
    <h1 class="h3">Edit Coupon</h1>
    <a href="coupon_management" class="btn btn-secondary">Back to List</a>
  </div>
  
  <div class="card shadow border-0 mt-4 rounded-4 p-4">
    <form method="post">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-bold small text-muted">Coupon Code</label>
                <input type="text" name="code" value="<?= $fetch->code ?>" class="form-control text-uppercase" required maxlength="10">
            </div>
            
            <div class="col-md-6">
                <label class="form-label fw-bold small text-muted">Discount Type</label>
                <select name="discount_type" class="form-select" required>
                    <option value="percentage" <?= ($fetch->discount_type == 'percentage') ? 'selected' : '' ?>>Percentage (%)</option>
                    <option value="fixed" <?= ($fetch->discount_type == 'fixed') ? 'selected' : '' ?>>Fixed Amount (₹)</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold small text-muted">Discount Value</label>
                <input type="number" name="discount_value" value="<?= $fetch->discount_value ?>" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold small text-muted">Expiry Date</label>
                <input type="date" name="expiry_date" value="<?= $fetch->expiry_date ?>" class="form-control" required min="<?= date('Y-m-d') ?>">
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold small text-muted">Status</label>
                <div class="mt-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="active" value="active" <?= ($fetch->status == 'active') ? 'checked' : '' ?>>
                        <label class="form-check-label text-success fw-bold small" for="active">Active</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="inactive" value="inactive" <?= ($fetch->status == 'inactive') ? 'checked' : '' ?>>
                        <label class="form-check-label text-danger fw-bold small" for="inactive">Inactive</label>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-4 text-center">
                <button type="submit" name="update" class="btn btn-primary px-5 py-2 fw-bold shadow-sm rounded-pill">
                    <i class="bi bi-save me-1"></i> Update Coupon
                </button>
            </div>
        </div>
    </form>
  </div>
</main>

<script src="./assets/libs/jquery/dist/jquery.min.js"></script>
<script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="./assets/js/sidebarmenu.js"></script>
<script src="./assets/js/app.min.js"></script>
<script src="./assets/libs/simplebar/dist/simplebar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
