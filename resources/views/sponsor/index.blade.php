@extends('layouts.dashboard')


@section('sponsors-active')
    active
@endsection

@section('breadcrumb')
<h4 class="page-title float-left">Sponsors</h4>

<ol class="breadcrumb float-right">
   <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ centralSettings()->title }}</a></li>
   {{-- <li class="breadcrumb-item"><a href="#">Pages</a></li> --}}
   <li class="breadcrumb-item active">Sponsors</li>
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
                      Add Sponsors
                  </div>
                  <div class="card-body">
                      <form action="{{ route('sponsors.store') }}" class="form-group" method="POST" enctype="multipart/form-data">
                        @csrf 

                        <div class="p-3">
                            <label for="category">Sponsor Image</label>
                            <input id="category" type="file" class="form-control" name="sponsor">
                        </div>

                        <div class="p-3">
                            <button class="btn btn-primary" type="submit">Add Sponsors</button>
                        </div>
                      </form>
                  </div>
              </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="card">
                  <div class="card-header">
                      All Sponsors
                  </div>
                  <div class="card-body">
                      <div class="table-responsive">
                          <table class="table table-striped table-bordered">
                              <tr>
                                  <th>Sl</th>
                                  <th>Sponsor</th>
                                  <th>Action</th>
                              </tr>

                              @forelse ($sponsors as $sponsor)
                                  <tr>
                                      <td>{{ $loop->index + 1 }}</td>
                                      <td>
                                          <img src="{{ asset('uploads/sponsors') }}/{{ $sponsor->sponsor }}" alt="not found" width="170" height="30">
                                      </td>
                                      <td>
                                          <form action="{{ route('sponsors.destroy', $sponsor->id) }}" method="POST">
                                            @csrf 
                                            {{ method_field('DELETE') }}

                                            <input class="form-control" type="hidden" name="id" value="{{ $sponsor->id }}">
                                            <button class="btn btn-danger" type="submit">DELETE</button>
                                          </form>
                                      </td>
                                  </tr>
                              @empty
                                  <tr>
                                      <td>No sponsors available</td>
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