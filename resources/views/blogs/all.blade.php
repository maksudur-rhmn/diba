@extends('layouts.dashboard')


@section('blogs-active')
    active
@endsection

@section('breadcrumb')
<h4 class="page-title float-left">Blogs</h4>

<ol class="breadcrumb float-right">
   <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ centralSettings()->title }}</a></li>
   {{-- <li class="breadcrumb-item"><a href="#">Pages</a></li> --}}
   <li class="breadcrumb-item active">Blogs</li>
</ol>
@endsection


@section('inline-css')
 
<link href="{{ asset('dashboard_assets/assets/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('dashboard_assets/assets/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection


@section('content')
{{-- Success Alert --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
<h5 class="text-dark">
        
            {{ session('success') }}
            
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</h5>
</div>
@endif
{{-- Success Alert --}}

{{-- Error Alert --}}
@if($errors->all())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<h5 class="text-dark">
        
           @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
           @endforeach
            
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</h5>
</div>
@endif
{{-- Error Alert --}}

{{-- Warning Alert --}}
@if(session('warning'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
<h5 class="text-dark">
    {{ session('warning') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</h5>
</div>
@endif
{{-- Warning Alert --}}

<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>Manage blogs</b></h4>

            <table id="datatable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Blog Title</th>
                        <th>Blog image</th>
                        <th>Posted by</th>
                        <th>Action</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>


                <tbody>
                  @forelse ($blogs as $blog)
                   <tr style="color: #222;">
                    <td>{{ $loop-> index + 1 }}</td>
                                  <td>{{ $blog->blog_title }}</td>
                                  <td>
                                      <img src="{{ asset('uploads/blogs') }}/{{ $blog->blog_image }}" alt="Not found" width="100" height="100">
                                  </td>
                                  <td>{{ $blog->posted_by }}</td>
                                  <td>{{ $blog->visiting_hours }}</td>
                                  <td>{{ $blog->relationBetweenCategory->category_name }}</td>
                                  <td>
                                    <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-success">Details</a>
                                  </td>
                                  <td>
                                    <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-warning">Edit</a>
                                  </td>
                                  <td>
                                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="post">
                                           @csrf
                                           {{ method_field('DELETE') }} 
                                           
                                           <input class="form-control" type="hidden" name="id" value="{{ $blog->id }}">
                                           <button class="btn btn-danger" type="submit">DELETE</button>
                                        </form>
                                  </td>
                   </tr>
                  @empty
                   <tr>
                       <td>No blogs available.</td>
                   </tr>
                  @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div> <!-- end row -->

@endsection

@section('footer-script')
 <!-- Required datatable js -->
 
 <script src="{{ asset('dashboard_assets/assets/datatables/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('dashboard_assets/assets/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').DataTable();
    } );

</script>
@endsection