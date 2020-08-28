@extends('layouts.dashboard')


@section('doctors-active')
    active
@endsection

@section('breadcrumb')
<h4 class="page-title float-left">Doctors</h4>

<ol class="breadcrumb float-right">
   <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ centralSettings()->title }}</a></li>
   {{-- <li class="breadcrumb-item"><a href="#">Pages</a></li> --}}
   <li class="breadcrumb-item active">{{ $doctor->name }}</li>
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
                    Edit Doctors info
                </div>
                <div class="card-body">
                    <form action="{{ route('doctors.update', $doctor->id) }}" class="form-group" method="POST" enctype="multipart/form-data">
                      @csrf 
                        {{ method_field('PUT') }}
                      <div class="p-3">
                          <label for="name">Doctors Name</label>
                          <input id="name" type="text" class="form-control" name="name" value="{{ $doctor->name }}">
                      </div>
                      <div class="p-3">
                          <label for="image">Doctors Image</label>
                          <input id="image" type="file" class="form-control" name="doctors_image">

                      </div>
                      <div class="p-3 text-center">
                          <img src="{{ asset('uploads/doctors') }}/{{ $doctor->doctors_image }}" alt="">
                      </div>
                      <div class="p-3">
                        <label for="speciality">Doctors Speciality</label>
                        <input id="speciality" type="text" class="form-control" name="speciality" value="{{ $doctor->speciality }}">
                    </div>
                      <div class="p-3">
                        <label for="academic_details">Doctors Academic Details</label>
                        <input id="academic_details" type="text" class="form-control" name="academic_details" value="{{ $doctor->academic_details }}">
                    </div>
                      <div class="p-3">
                        <label for="chamber_details">Doctors Chamber Details</label>
                        <input id="chamber_details" type="text" class="form-control" name="chamber_details" value="{{ $doctor->chamber_details }}">
                    </div>
                    <div class="p-3">
                        <label for="visiting_hours">Doctors Visiting Hours (Please use comma to separate days)</label>
                        <input id="visiting_hours" type="text" class="form-control" name="visiting_hours" value="{{ $doctor->visiting_hours }}">
                    </div>
                    <div class="p-3">
                        <label for="designation">Doctors Designation</label>
                        <input id="designation" type="text" class="form-control" name="designation" value="{{ $doctor->designation }}">
                    </div>
                    <div class="p-3">
                        <label for="experience">Doctors Experience</label>
                        <input id="experience" type="text" class="form-control" name="experience" value="{{ $doctor->experience }}">
                    </div>
                    <div class="p-3">
                        <label for="doctors_email">Doctors Email</label>
                        <input id="doctors_email" type="text" class="form-control" name="doctors_email" value="{{ $doctor->doctors_email }}">
                    </div>
                    <div class="p-3">
                        <label for="for_appointment">For Appointment Call</label>
                        <input id="for_appointment" type="text" class="form-control" name="for_appointment" value="{{ $doctor->for_appointment }}">
                    </div>
                    <div class="p-3">
                        <label for="category_id">Listing Category</label>
                         <select class="form-control" name="category_id" id="category_id">
                             <option value="{{ $doctor->category_id }}">{{ $doctor->relationBetweenCategory->category_name }}</option>
                             @foreach ($categories as $category)
                                 <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                             @endforeach
                         </select>
                    </div>
                    <div class="p-3">
                        <label for="city_id">Doctor's City</label>
                         <select class="form-control" name="city_id" id="city_id">
                            <option value="{{ $doctor->city_id }}">{{ $doctor->relationBetweenCity->name }}</option>
                             @foreach ($cities as $city)
                                 <option value="{{ $city->id }}">{{ $city->name }}</option>
                             @endforeach
                         </select>
                    </div>

                      <div class="p-3">
                          <button class="btn btn-primary" type="submit">Update Informations.</button>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection