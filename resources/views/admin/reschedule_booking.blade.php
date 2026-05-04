<?php
include ('sidebar.php');
?>

<div class="main-content">
    <div class="mb-4">
        <h3 class="fw-bold">Reschedule Booking</h3>
        <p class="text-muted">Change the session date and time for Booking #<?= $data->booking_id ?></p>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h5 class="fw-bold mb-3">Current Schedule</h5>
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar-sm bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3">
                        <i class="bi bi-calendar-event fs-4"></i>
                    </div>
                    <div>
                        <div class="small text-muted">Current Date</div>
                        <div class="fw-bold"><?= date('d F, Y', strtotime($data->appointment_date)) ?></div>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar-sm bg-info bg-opacity-10 text-info rounded-circle p-2 me-3">
                        <i class="bi bi-clock fs-4"></i>
                    </div>
                    <div>
                        <div class="small text-muted">Current Slot</div>
                        <div class="fw-bold"><?= $data->slot_name ?> (<?= date('h:i A', strtotime($data->start_time)) ?>)</div>
                    </div>
                </div>
                <hr>
                <div class="small text-muted mb-1">Client Name</div>
                <div class="fw-bold mb-3"><?= $data->client_name ?></div>
                <div class="small text-muted mb-1">Package</div>
                <div class="fw-bold"><?= $data->package_name ?> (<?= $data->category_name ?>)</div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold mb-4">New Schedule Details</h5>
                <form action="reschedule_booking" method="post">
                    <input type="hidden" name="booking_id" value="<?= $data->booking_id ?>">
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold">Select New Date</label>
                        <input type="date" name="shoot_date" class="form-control form-control-lg border-2" 
                               value="<?= ($data->appointment_date != '0000-00-00') ? $data->appointment_date : date('Y-m-d') ?>" 
                               required min="<?= date('Y-m-d') ?>">
                        <div class="form-text mt-2">Pick the availability date for the session.</div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Select Time Slot</label>
                        <select name="slot_id" class="form-select form-select-lg border-2" required>
                            <?php foreach($slots_arr as $s) { ?>
                                <option value="<?= $s->slot_id ?>" <?= ($data->appt_slot_id == $s->slot_id) ? 'selected' : '' ?>>
                                    <?= $s->slot_name ?> (<?= date('h:i A', strtotime($s->start_time)) ?> - <?= date('h:i A', strtotime($s->end_time)) ?>)
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-3 mb-4 small">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        Confirming this will automatically update the client's dashboard and send them a system notification.
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" name="submit_reschedule" class="btn btn-primary rounded-pill px-5">Confirm Reschedule</button>
                        <a href="booking_management" class="btn btn-light rounded-pill px-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
