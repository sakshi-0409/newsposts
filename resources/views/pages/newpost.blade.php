@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'New Post'])
<div class="card shadow-lg mx-4">
    <div class="card-body p-3">
        <form id="form" action="" method="" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="post_title" class="form-label">Post Title</label>
                <input type="test" class="form-control" name="post_title" id="post_title" placeholder="New Post Title">
            </div>
            <div class="mb-3">
                <label for="post_des" class="form-label">Post Something Latest</label>
                <textarea class="form-control" name="post_des" id="editor" rows="3"></textarea>
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

            }
            , messages: {
                post_title: {
                    required: "Please enter post title"
                }
                , post_des: {
                    required: "Please enter some content"
                }

            }
            , submitHandler: function(form) {
                var formData = new FormData(form);
                console.log(formData);
                
                var url = '{{url("create-post")}}';
                
                
                $.ajax({

                    url: url
                    , type: 'POST'
                    , data: formData,

                    contentType: false
                    , processData: false
                    , success: function(response) {
                        $('#form').trigger('reset');
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
