@extends('layouts.admin')

@section('content')
<h4>Write New Article</h4>

<form method="POST"
      action="{{ route('staff.articles.store') }}"
      enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <input type="text" name="title" class="form-control"
               placeholder="Article title">
    </div>

    <div class="mb-3">
        <textarea name="content" rows="8"
                  class="form-control"
                  placeholder="Tell your story..."></textarea>
    </div>

    <div class="mb-3">
        <label for="thumbnail" class="form-label">Thumbnail Image</label>
        <input type="file" name="thumbnail" id="thumbnail" class="form-control"
               accept="image/*">
        <div class="form-text">Upload an image file for the article thumbnail</div>
    </div>

    <button type="submit" class="btn btn-dark">Save Draft</button>
</form>
@endsection
