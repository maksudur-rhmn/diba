@extends('layouts.dashboard')


@section('doctors-active')
    active
@endsection

@section('breadcrumb')
<h4 class="page-title float-left">Doctors</h4>

<ol class="breadcrumb float-right">
   <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ centralSettings()->title }}</a></li>
   {{-- <li class="breadcrumb-item"><a href="#">Pages</a></li> --}}
   <li class="breadcrumb-item active">Doctor Details</li>
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
                    All Doctors
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Doctors Name</th>
                                <td>{{ $doctor->name }}</td>
                            </tr>
                               <tr>
                                <th>Doctors image</th>
                                <td>
                                    <img src="{{ asset('uploads/doctors') }}/{{ $doctor->doctors_image }}" alt="not found">
                                </td>
                               </tr>
                               <tr> 
                                 <th>Speciality</th>
                                 <td>{{ $doctor->speciality }}</td>
                               </tr>
                               <tr>
                                <th>Academic Details</th>
                                <td>{{ $doctor->academic_details }}</td>
                               </tr>
                                <tr>
                                    <th>Chamber Details</th>
                                    <td>{{ $doctor->chamber_details }}</td>
                                </tr>
                                <tr>
                                    <th>Visiting Hours</th>
                                    <td>{{ $doctor->visiting_hours }}</td>
                                </tr>
                                <tr>
                                    <th>Designation</th>
                                    <td>{{ $doctor->designation }}</td>
                                </tr>
                                <tr>
                                    <th>Experience</th>
                                    <td>{{ $doctor->experience }}</td>
                                </tr>
                                <tr>
                                    <th>Doctors email</th>
                                    <td>{{ $doctor->doctors_email }}</td>
                                </tr>
                                <tr>
                                    <th>Appoinment</th>
                                    <td>{{ $doctor->for_appoinment }}</td>
                                </tr>
                                <tr>
                                    <th>Category</th>
                                    <td>{{ $doctor->relationBetweenCategory->category_name }}</td>
                                </tr>
                                <tr>
                                    <th>Featured Listing</th>
                                    <td>
                                        @if($doctor->featured_listing == 1)
                                          Dr. {{ $doctor->name }} is featured on home page.
                                        @else 
                                         Not Featured
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Availablity</th>
                                    <td>
                                        @if($doctor->out_of_office == 1)
                                         Available for appointments.
                                        @else 
                                          Out of Office
                                        @endif
                                    </td>

                                </tr>
                                <tr>
                                    <th>City</th>
                                    <td>{{ $doctor->relationBetweenCity->name }}</td>
                                </tr>
                        </table>

                        <div class="p-3">
                            @if($doctor->featured_listing == 0)
                                <a href="{{ route('doctors.feature', $doctor->id) }}" class="btn btn-primary">Feature Doctor in Homepage (Maximum 2 allowed)</a>
                            @else
                               <a href="{{ route('doctors.revoke', $doctor->id) }}" class="btn btn-danger">Remove Doctor from Homepage</a>
                            @endif
                            @if($doctor->out_of_office == 1)
                                <a href="{{ route('doctors.outOfOffice', $doctor->id) }}" class="btn btn-danger">Activate Out of office mode</a>
                            @else
                              <a href="{{ route('doctors.inOffice', $doctor->id) }}" class="btn btn-info">Activate back to office mode</a>
                            @endif
                            <a href="{{ route('doctors.all') }}" class="btn btn-success">Back to Doctor's Overview</a>
            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection