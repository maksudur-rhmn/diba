@extends('layouts.dashboard')


@section('Hospitals-active')
    active
@endsection

@section('breadcrumb')
<h4 class="page-title float-left">Hospitals</h4>

<ol class="breadcrumb float-right">
   <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ centralSettings()->title }}</a></li>
   {{-- <li class="breadcrumb-item"><a href="#">Pages</a></li> --}}
   <li class="breadcrumb-item active">Hospitals</li>
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
                    Add Hospital
                </div>
                <div class="card-body">
                    <form action="{{ route('hospitals.store') }}" class="form-group" method="POST" enctype="multipart/form-data">
                      @csrf 

                      <div class="p-3">
                          <label for="name">Hospitals Name</label>
                          <input id="name" type="text" class="form-control" name="name" placeholder="Hospitals Name...">
                      </div>
                      <div class="p-3">
                          <label for="image">Hospitals Image</label>
                          <input id="image" type="file" class="form-control" name="hospitals_image">
                      </div>
                      <div class="p-3">
                        <label for="speciality">Address</label>
                        <input id="speciality" type="text" class="form-control" name="address" placeholder="Hospitals Address...">
                    </div>
                      <div class="p-3">
                        <label for="academic_details">Hospitals Phone number</label>
                        <input id="academic_details" type="text" class="form-control" name="phone" placeholder="Hospitals Phone number...">
                    </div>
                    <div class="p-3">
                        <label for="category_id">Listing Category</label>
                         <select class="form-control" name="category_id" id="category_id">
                            <option value="">-Select Category-</option>
                             @foreach ($categories as $category)
                                 <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                             @endforeach
                         </select>
                    </div>
                    <div class="p-3">
                        <label for="city_id">Hospital's City</label>
                         <select class="form-control" name="city_id" id="city_id">
                            <option value="">-Select City-</option>
                             @foreach ($cities as $city)
                                 <option value="{{ $city->id }}">{{ $city->name }}</option>
                             @endforeach
                         </select>
                    </div>

                      <div class="p-3">
                          <button class="btn btn-primary" type="submit">Add Hospital</button>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection