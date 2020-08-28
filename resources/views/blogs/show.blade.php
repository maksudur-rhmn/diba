@extends('layouts.dashboard')


@section('blogs-active')
    active
@endsection

@section('breadcrumb')
<h4 class="page-title float-left">Blogs</h4>

<ol class="breadcrumb float-right">
   <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ centralSettings()->title }}</a></li>
   {{-- <li class="breadcrumb-item"><a href="#">Pages</a></li> --}}
   <li class="breadcrumb-item active">Blog Details</li>
</ol>
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

<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    Blog
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Title</th>
                                <td>{{ $blog->name }}</td>
                            </tr>
                               <tr>
                                <th>Image</th>
                                <td class="text-center">
                                    <img src="{{ asset('uploads/blogs') }}/{{ $blog->blog_image }}" alt="not found">
                                </td>
                               </tr>
                               <tr>
                                   <th>Category</th>
                                   <td>{{ $blog->relationBetweenCategory->category_name }}</td>
                               </tr>
                               <tr> 
                                 <th>Description</th>
                                 <td>{!! $blog->blog_description !!}</td>
                               </tr>
                                <tr>
                                    <th>Posted by</th>
                                    <td>{{ $blog->posted_by }}</td>
                                </tr>
                        </table>

                        <div class="p-3">
                            <a href="{{ route('blogs.all') }}" class="btn btn-success">Back to blog's Overview</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection