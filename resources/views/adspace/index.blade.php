@extends('layouts.dashboard')


@section('ads-active')
    active
@endsection

@section('breadcrumb')
<h4 class="page-title float-left">Ad Space</h4>

<ol class="breadcrumb float-right">
   <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ centralSettings()->title }}</a></li>
   {{-- <li class="breadcrumb-item"><a href="#">Pages</a></li> --}}
   <li class="breadcrumb-item active">Ad Space</li>
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
                      Add Advertisement
                  </div>
                  <div class="card-body">
                      <form action="{{ route('ads.store') }}" class="form-group" method="POST" enctype="multipart/form-data">
                        @csrf 

                        <div class="p-3">
                            <label for="category">Ad Image Left</label>
                            <input id="category" type="file" class="form-control" name="ad_left">
                        </div>
                        <div class="p-3">
                            <label for="category">Ad Image Right</label>
                            <input id="category" type="file" class="form-control" name="ad_right">
                        </div>

                        <div class="p-3">
                            <button class="btn btn-primary" type="submit">Add Advertisement</button>
                        </div>
                      </form>
                  </div>
              </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="card">
                  <div class="card-header">
                      All Advertisement
                  </div>
                  <div class="card-body">
                      <div class="table-responsive">
                          <table class="table table-striped table-bordered">
                              <tr>
                                  <th>Sl</th>
                                  <th>AD Left</th>
                                  <th>AD Right</th>
                                  <th>Action</th>
                              </tr>

                              @forelse ($ads as $ad)
                                  <tr>
                                      <td>{{ $loop->index + 1 }}</td>
                                      <td>
                                          <img src="{{ asset('uploads/ads') }}/{{ $ad->ad_left }}" alt="not found" width="300" height="300">
                                      </td>
                                      <td>
                                          <img src="{{ asset('uploads/ads') }}/{{ $ad->ad_right }}" alt="not found" width="300" height="300">
                                      </td>
                                      <td>
                                          <form action="{{ route('ads.destroy', $ad->id) }}" method="POST">
                                            @csrf 
                                            {{ method_field('DELETE') }}

                                            <input class="form-control" type="hidden" name="id" value="{{ $ad->id }}">
                                            <button class="btn btn-danger" type="submit">DELETE</button>
                                          </form>
                                      </td>
                                  </tr>
                              @empty
                                  <tr>
                                      <td>No advertisement available</td>
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