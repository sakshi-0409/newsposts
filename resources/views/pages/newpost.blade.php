@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'New Post'])
    <div class="card shadow-lg mx-4">
    <div class="card-body p-3">
    <div class="mb-3">
        <label for="post" class="form-label">Post Title</label>
        <input type="test" class="form-control" name="post" id="post" placeholder="New Post Title">
      </div>
      <div class="mb-3">
        <label for="textarea" class="form-label">Post Something Latest</label>
        <textarea class="form-control" name="textarea" id="textarea" rows="3"></textarea>
      </div>
</div>
</div>
@include('layouts.footers.auth.footer')
@push('js')
<script>
    ClassicEditor
    .create( document.querySelector( '#textarea' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
</script>
@endpush
@endsection
