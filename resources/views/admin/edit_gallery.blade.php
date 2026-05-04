@extends('admin.layout.structure')
@section('content')
<main class="col-md-10 ms-sm-auto px-4">
  <h1 class="h3 mt-3">Edit Gallery</h1>



<form method="post" action="{{ url('edit_gallery/'. $data->id) }}" enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="id" value="<?php echo $data->id; ?>">

    
    

    

    <div class="mb-3">
        <label>Current Images</label><br>
        @php 
            $decoded = json_decode($data->image, true); 
            $images = is_array($decoded) ? $decoded : [$data->image];
        @endphp
        @foreach($images as $img)
            @if($img)
                <img src="{{ url('upload/gallery/' . $img) }}"
                    width="80" class="mb-1 me-1 rounded border shadow-sm">
            @endif
        @endforeach
    </div>


    <div class="mb-3">
        <label>Change Images (Note: This will replace all images in this record)</label>
        <input type="file" name="image[]" multiple class="form-control">
    </div>


    
    <button type="submit" name="update" class="btn btn-success">
        Update Gallery
    </button>

</form>
</main>

@endsection
