<?php include_once('header.php'); ?>

<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0 rounded-4 p-4">
                <h4 class="fw-bold mb-3 text-primary"><i class="bi bi-star-fill me-2"></i> Rate Your Session</h4>
                <p class="text-muted small">Your feedback helps us grow and capture better memories!</p>
                <hr>

                <form method="post" action="process_review">
                    <input type="hidden" name="booking_id" value="<?= $_GET['booking_id'] ?>">
                    
                    <div class="mb-4 text-center">
                        <label class="form-label d-block fw-bold">Select Rating</label>
                        <div class="rating-stars h3 text-warning">
                            <i class="bi bi-star cursor-pointer" onclick="setRating(1)"></i>
                            <i class="bi bi-star cursor-pointer" onclick="setRating(2)"></i>
                            <i class="bi bi-star cursor-pointer" onclick="setRating(3)"></i>
                            <i class="bi bi-star cursor-pointer" onclick="setRating(4)"></i>
                            <i class="bi bi-star cursor-pointer" onclick="setRating(5)"></i>
                        </div>
                        <input type="hidden" name="rating" id="rating_val" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Your Comments</label>
                        <textarea name="comment" class="form-control rounded-3" rows="4" placeholder="Share your experience..." required></textarea>
                    </div>

                    <button type="submit" name="submit_review" class="btn btn-primary w-100 py-2 rounded-pill shadow-sm">
                        Submit Review
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.cursor-pointer { cursor: pointer; transition: 0.2s; }
.cursor-pointer:hover { transform: scale(1.2); }
.bi-star-fill { color: #ffc107; }
</style>

<script>
function setRating(val) {
    document.getElementById('rating_val').value = val;
    let stars = document.querySelectorAll('.rating-stars i');
    stars.forEach((star, index) => {
        if(index < val) {
            star.classList.replace('bi-star', 'bi-star-fill');
        } else {
            star.classList.replace('bi-star-fill', 'bi-star');
        }
    });
}
</script>

<?php include_once('footer.php'); ?>
