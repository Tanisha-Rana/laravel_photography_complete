<?php 
include_once ('sidebar.php'); 
include_once ('header.php');
?>

<main class="col-md-10 ms-sm-auto px-4 mt-3 pb-5">
  <div class="d-flex justify-content-between align-items-center">
    <h1 class="h3">Reply to Support Ticket #<?= $fetch->ticket_id ?></h1>
    <a href="support_ticket_management" class="btn btn-secondary">Back to List</a>
  </div>
  
  <div class="card shadow border-0 mt-4 rounded-4 p-4">
    <div class="row">
        <!-- Ticket Info -->
        <div class="col-md-5 border-end">
            <h6 class="fw-bold text-muted small text-uppercase">Client Details</h6>
            <p class="fw-bold fs-5 mb-0"><?= $client_data->name ?></p>
            <p class="text-muted small mb-4"><?= $client_data->email ?> | <?= $client_data->phone ?></p>

            <h6 class="fw-bold text-muted small text-uppercase">Original Message</h6>
            <div class="bg-light p-3 rounded-3 mb-4">
                <p class="fw-bold mb-1"><?= $fetch->subject ?></p>
                <p class="small italic mb-0 text-dark">"<?= $fetch->message ?>"</p>
                <div class="text-end small text-muted mt-2"><?= date('d M Y, h:i A', strtotime($fetch->created_at)) ?></div>
            </div>

            <?php if($fetch->status == 'replied' || $fetch->status == 'closed') { ?>
                <h6 class="fw-bold text-muted small text-uppercase">Previous Reply</h6>
                <div class="bg-primary bg-opacity-10 p-3 rounded-3 border-start border-primary border-4 text-primary">
                    <p class="small mb-0 italic">"<?= $fetch->admin_reply ? $fetch->admin_reply : '<em>No previous reply</em>' ?>"</p>
                </div>
            <?php } ?>
        </div>

        <!-- Reply Form -->
        <div class="col-md-7 ps-4">
            <h6 class="fw-bold text-muted small text-uppercase mb-3">Post Your Reply</h6>
            <form method="post">
                <div class="mb-4">
                    <textarea name="admin_reply" class="form-control" rows="8" placeholder="Type your professional response here..." required><?= $fetch->admin_reply ?></textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Update Status</label>
                    <div class="d-flex gap-4 mt-1">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="replied" value="replied" <?= ($fetch->status == 'replied' || $fetch->status == 'open') ? 'checked' : '' ?>>
                            <label class="form-check-label fw-bold text-info" for="replied">Mark as Replied</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="closed" value="closed" <?= ($fetch->status == 'closed') ? 'checked' : '' ?>>
                            <label class="form-check-label fw-bold text-success" for="closed">Close Ticket</label>
                        </div>
                    </div>
                    <p class="small text-muted mt-2"><i class="bi bi-info-circle me-1"></i> "Close Ticket" means no further communication is needed.</p>
                </div>

                <div class="text-end mt-5">
                    <button type="submit" name="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm rounded-pill">
                        <i class="bi bi-send-fill me-1"></i> Send Reply Now
                    </button>
                </div>
            </form>
        </div>
    </div>
  </div>
</main>

<script src="./assets/libs/jquery/dist/jquery.min.js"></script>
<script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="./assets/js/sidebarmenu.js"></script>
<script src="./assets/js/app.min.js"></script>
<script src="./assets/libs/simplebar/dist/simplebar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
