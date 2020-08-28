@extends('layouts.dashboard')


@section('ambulance-active')
    active
@endsection

@section('breadcrumb')
<h4 class="page-title float-left">Ambulance</h4>

<ol class="breadcrumb float-right">
   <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ centralSettings()->title }}</a></li>
   {{-- <li class="breadcrumb-item"><a href="#">Pages</a></li> --}}
   <li class="breadcrumb-item active">Ambulance Details</li>
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
                    {{ $ambulance->name }}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th> Name</th>
                                <td>{{ $ambulance->name }}</td>
                            </tr>
                               <tr>
                                <th>Ambulance image</th>
                                <td>
                                    <img src="{{ asset('uploads/ambulance') }}/{{ $ambulance->ambulance_image }}" alt="not found">
                                </td>
                               </tr>
                               <tr> 
                                 <th>Address</th>
                                 <td>{{ $ambulance->address }}</td>
                               </tr>
                               <tr>
                                <th>Phone</th>
                                <td>{{ $ambulance->phone }}</td>
                               </tr>
                                <tr>
                                    <th>Category</th>
                                    <td>{{ $ambulance->relationBetweenCategory->category_name }}</td>
                                </tr>
                                <tr>
                                    <th>Featured Listing</th>
                                    <td>
                                        @if($ambulance->featured_listing == 1)
                                          {{ $ambulance->name }} is featured on home page.
                                        @else 
                                         Not Featured
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>City</th>
                                    <td>{{ $ambulance->relationBetweenCity->name }}</td>
                                </tr>
                        </table>

                        <div class="p-3">
                            @if($ambulance->featured_listing == 0)
                                <a href="{{ route('ambulance.feature', $ambulance->id) }}" class="btn btn-primary">Feature ambulance in Homepage (Maximum 2 allowed)</a>
                            @else
                               <a href="{{ route('ambulance.revoke', $ambulance->id) }}" class="btn btn-danger">Remove ambulance from Homepage</a>
                            @endif
                            <a href="{{ route('ambulance.all') }}" class="btn btn-success">Back to ambulance Overview</a>
            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection