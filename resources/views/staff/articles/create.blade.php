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
        <input type="file" name="thumbnail" class="form-control">
    </div>

    <button class="btn btn-dark">Save Draft</button>
</form>
@endsection
