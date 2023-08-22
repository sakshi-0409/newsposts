@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'New Post'])
<div class="card shadow-lg mx-4">
    <div class="card-body p-3">
        <form id="form" action="" method="" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="post_title" class="form-label">Post Title</label>
                <input type="test" class="form-control post_title" name="post_title" id="post_title" placeholder="New Post Title">
            </div>
            <div class="mb-3">
                <label for="post_image" class="form-label">Image</label>
                <input type="file" class="form-control post_image" name="post_image" id="post_image">
            </div>
            <div class="mb-3">
                <label for="post_url" class="form-label">Url</label>
                <input type="url" class="form-control post_url" name="post_url" id="post_url" placeholder="Enter url">
            </div>
            <div class="mb-3">
                <label for="post_des" class="form-label">Post Something Latest</label>
                <textarea class="form-control post_des" name="post_des" id="editor" rows="3"></textarea>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="active" value="active">
                <label class="form-check-label" for="active">Active</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="inactive" value="inactive">
                <label class="form-check-label" for="inactive">Inactive</label>
              </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-secondary">Post</button>
                <button type="cancel" class="btn btn-danger">Cancel</button>
            </div>
        </form>
    </div>
</div>
@push('js')
<script>
    ClassicEditor
    .create(document.querySelector('#editor'), {
        image: {
            toolbar: ['toggleImageCaption', 'imageTextAlternative']
        }
        , simpleUpload: {
            uploadUrl: '/newpost', // URL where files will be uploaded
        }
        
    })
    .then(editor => {
        console.log(editor);
    })
    .catch(error => {
        console.error(error);
    });
    
</script>

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
                , post_des: {
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
                , post_des: {
                    required: "Please enter some content"
                }
                , status: {
                    required: "Please select post status"
                }

            }
            , submitHandler: function(form) {
                var formData = new FormData(form);
                console.log(formData);
                var imageFile = $('#post_image')[0].files[0];
                formData.append('post_image', imageFile);

                var url = '{{url("create-post")}}';


                $.ajax({

                    url: url
                    , type: 'POST'
                    , data: formData,

                    contentType: false
                    , processData: false
                    , success: function(response) {
                        $('#form').trigger('reset');
                        // $('#editor').html('');
                        // CKEDITOR.instances['editor'].setData('');
                        // window.location.reload();
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
