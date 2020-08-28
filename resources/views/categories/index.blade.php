@extends('layouts.dashboard')


@section('categories-active')
    active
@endsection

@section('breadcrumb')
<h4 class="page-title float-left">Categories</h4>

<ol class="breadcrumb float-right">
   <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ centralSettings()->title }}</a></li>
   {{-- <li class="breadcrumb-item"><a href="#">Pages</a></li> --}}
   <li class="breadcrumb-item active">Categories</li>
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
          <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="card">
                  <div class="card-header">
                      Add Categories
                  </div>
                  <div class="card-body">
                      <form action="{{ route('categories.store') }}" class="form-group" method="POST">
                        @csrf 

                        <div class="p-3">
                            <label for="category">Category Name</label>
                            <input id="category" type="text" class="form-control" name="category_name" placeholder="Category Name...">
                        </div>

                        <div class="p-3">
                            <button class="btn btn-primary" type="submit">Add Category</button>
                        </div>
                      </form>
                  </div>
              </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="card">
                  <div class="card-header">
                      All Categories
                  </div>
                  <div class="card-body">
                      <div class="table-responsive">
                          <table class="table table-striped table-bordered">
                              <tr>
                                  <th>Sl</th>
                                  <th>Category Name</th>
                                  <th>Action</th>
                              </tr>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $loop-> index + 1 }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>
                                          <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                                             @csrf
                                             {{ method_field('DELETE') }} 
                                             
                                             <input class="form-control" type="hidden" name="id" value="{{ $category->id }}">
                                             <button class="btn btn-danger" type="submit">DELETE</button>
                                          </form>
                                    </td>
                                </tr>
                                @empty 
                                <tr>
                                    <td>No category available.</td>
                                </tr>
                            @endforelse
                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
    
@endsection