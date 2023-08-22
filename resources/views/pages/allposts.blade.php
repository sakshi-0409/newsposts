@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-2">
                    <h6>All Posts</h6>
                </div>

                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-2">
                        <table id="myTable" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Post Title</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Content</th>

                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        image</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Url</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>

                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)

                                <tr>

                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{$post->post_title}}</p>
                                    </td>

                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{!!$post->post_des!!}</p>
                                    </td>
                                    <td>
                                        <img src="{{ asset('img/'.$post->post_image) }}" height="55px" width="60px" alt="img">
                                    </td>

                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{$post->post_url}}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{$post->status}}</p>
                                    </td>


                                    <td class="align-middle text-center text-sm">
                                        {{-- <span class="cursor-pointer badge badge-sm bg-gradient-success edit" data-id="{{$broker->id}}"><a href="{{url('editbroker')}}/{{$broker->id}}">Edit</a></span> --}}
                                        <span class="cursor-pointer badge badge-sm bg-gradient-danger delete" data-id="{{$post->id}}">Delete</span>
                                    </td>


                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    let table = new DataTable('#myTable');

</script>
<script>
    $(document).ready(function() {
        $('body').on('click', '.delete', function(e) {
            e.preventDefault();
            var row = $(this).closest('tr');
            var id = $(this).data('id');
            var url = `{{ url('/deletepost') }}/${id}`;

            console.log(url);
            $.ajax({

                url: url
                , data: jQuery('.remove').serialize()
                , type: 'get'
                , success: function(response) {
                    row.remove();
                }
            });
        });

    });

</script>
@endpush
@include('layouts.footers.auth.footer')
@endsection
