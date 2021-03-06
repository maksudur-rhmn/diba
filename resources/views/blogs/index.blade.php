@extends('layouts.dashboard')


@section('inline-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.css">
@endsection

@section('top-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.js"></script>
@endsection

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
        <div class="col-lg-10 col-md-10 col-sm-12 m-auto">
            <div class="card">
                <div class="card-header">
                    Add Blogs
                </div>
                <div class="card-body">
                    <form action="{{ route('blogs.store') }}" class="form-group" method="POST" enctype="multipart/form-data">
                      @csrf 

                      <div class="p-3">
                          <label for="name">Blog Title</label>
                          <input id="name" type="text" class="form-control" name="blog_title" placeholder="Blog Title...">
                      </div>
                      <div class="p-3">
                          <label for="image">Blog Image</label>
                          <input id="image" type="file" class="form-control" name="blog_image">
                      </div>
                      <div class="p-3">
                        <label for="x">Blog Description</label>
                        <input placeholder="Blog description...." id="x" type="hidden" name="blog_description">
                        <trix-editor input="x"></trix-editor>
                    </div>
                    <div class="p-3">
                        <label for="posted">Posted by</label>
                        <input id="posted" type="text" class="form-control" name="posted_by" placeholder="Posted by...">
                    </div>
                    <div class="p-3">
                        <label for="category_id">Blog Category</label>
                         <select class="form-control" name="category_id" id="category_id">
                            <option value="">-Select Category-</option>
                             @foreach ($categories as $category)
                                 <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                             @endforeach
                         </select>
                    </div>

                      <div class="p-3">
                          <button class="btn btn-primary" type="submit">Add Blog</button>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection