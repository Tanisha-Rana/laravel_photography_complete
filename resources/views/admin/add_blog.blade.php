@extends('admin.layout.structure');
@section('content');

<main class="col-md-10 ms-sm-auto px-4">
  <div class="d-flex justify-content-between align-items-center mt-3">
    <h1 class="h3">Add New Blog Post</h1>
    <a href="blog_management" class="btn btn-secondary">Back to List</a>
  </div>
  
  <div class="card shadow-sm mt-4 p-4 rounded-4 border-0">
    <form method="post" enctype="multipart/form-data">
        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label fw-bold">Post Title</label>
                <input type="text" name="title" class="form-control" placeholder="Enter title" required>
            </div>
            
            <div class="col-md-4">
                <label class="form-label fw-bold">Status</label>
                <select name="status" class="form-select">
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                </select>
            </div>

            <div class="col-md-12">
                <label class="form-label fw-bold">Feature Image</label>
                <input type="file" name="image" class="form-control" required>
            </div>

            <div class="col-md-12">
                <label class="form-label fw-bold">Content</label>
                <textarea name="content" class="form-control" rows="10" placeholder="Write post content here..." required></textarea>
            </div>

            <div class="col-md-12 mt-4 text-center">
                <button type="submit" name="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm rounded-pill">
                    <i class="bi bi-check2-circle me-1"></i> Publish Now
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
@endsection