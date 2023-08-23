@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Edit Advertisement'])
<div class="card shadow-lg mx-4">
    <div class="card-body p-3">
        <form id="form" action="" method="" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="post_title" class="form-label">Post Title</label>
                <input type="test" value="{{@$ad->post_title}}" class="form-control post_title" name="post_title" id="post_title" placeholder="New Post Title">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control image" name="image" id="image">
            </div>
            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" value="{{@$ad->start_date}}" class="form-control start_date" name="start_date" id="start_date" placeholder="Enter url">
            </div>
            <div class="mb-3">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" value="{{@$ad->end_date}}" class="form-control end_date" name="end_date" id="end_date" placeholder="Enter url">
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" {{@$ad->status === 'active' ? 'checked': ''}} type="radio" name="status" id="active" value="active">
                <label class="form-check-label" for="active">Active</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" {{@$ad->status === 'inactive' ? 'checked': ''}} type="radio" name="status" id="inactive" value="inactive">
                <label class="form-check-label" for="inactive">Inactive</label>
            </div>
            <div class="mb-3">
                <button type="submit" data-id="{{@$ad->id}}" id="id" class="btn btn-secondary">Update</button>
                <button type="cancel" class="btn btn-danger">Cancel</button>
            </div>
        </form>
    </div>
</div>
@push('js')


<!-- jQuery and form validation script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        $("#form").validate({
            rules: {
                post_title: {
                    required: true
                }
                , image: {
                    required: true
                }
                , start_date: {
                    required: true
                }
                , end_date: {
                    required: true
                }
                , status: {
                    required: true
                }

            }
            , messages: {
                post_title: {
                    required: "Please enter post title"
                }
                , image: {
                    required: "Please enter image"
                }
                , start_date: {
                    required: "Please enter start date"
                }
                , end_date: {
                    required: "Please enter end date"
                }
                , status: {
                    required: "Please select post status"
                }

            }
            , submitHandler: function(form) {
                var formData = new FormData(form);
                console.log(formData);
                var imageFile = $('#image')[0].files[0];
                var id = $('#id').data('id');
                formData.append('image', imageFile);


                var url = `{{url("update-advertisement")}}/${id}`;


                $.ajax({

                    url: url
                    , type: 'POST'
                    , data: formData,

                    contentType: false
                    , processData: false
                    , success: function(response) {
                        window.location.href = '/all-advertisements';
                       
                    }
                    , error: function(xhr, status, error) {
                        // Handle error response
                        console.error("Error saving user data:", error);
                    }
                });
            }
        });
    });

</script>
@endpush
@include('layouts.footers.auth.footer')
@endsection
