@extends('admin.layout.structure')

@section('content')
      
      <main class="col-md-10 ms-sm-auto px-4">

      <div class="body-wrapper-inner">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h1 class="h3 mt-3">Edit Catalogue</h1>
              <div class="card">
                <div class="card-body">

            <form action="{{ url('edit_catalogues/'.$data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
        <!-- CATEGORY -->
        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category_id" class="form-control" required>
    <option value="">-- Select Category --</option>

    @foreach($cate_arr as $cat)
        <option value="{{ $cat->id }}"
            {{ $cat->id == $data->category_id ? 'selected' : '' }}>
            {{ $cat->category_name }}
        </option>
    @endforeach
</select>
        </div>

        <!-- NAME -->
        <div class="mb-3">
            <label>Catalogue Name</label>
            <input type="text" name="catalogue_name"
       value="{{ $data->catalogue_name }}"
       class="form-control" required>
        </div>

        <!-- DESCRIPTION -->
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" required>{{ $data->description }}</textarea>
        </div>

        <!-- IMAGE -->
        <div class="mb-3">
            <label>Catalogue Image</label><br>

            <img src="{{ url('upload/catalogues/' . $data->image) }}"
                 width="120" class="mb-2 rounded"><br>

            <input type="file" name="image" class="form-control">
            <small class="text-muted">Leave empty to keep old image</small>
        </div>

        <!-- BUTTONS -->
        <button type="submit" name="update" class="btn btn-primary">
            Update Catalogue
        </button>

        <a href="catelogues_management" class="btn btn-danger">
            Cancel
        </a>

    </form>

</main>

