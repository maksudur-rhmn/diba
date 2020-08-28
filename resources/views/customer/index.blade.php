@extends('layouts.customer')


@section('dash-active')
    active
@endsection

@section('breadcrumb')
<h4 class="page-title float-left">Appointments</h4>

<ol class="breadcrumb float-right">
   <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ centralSettings()->title }}</a></li>
   {{-- <li class="breadcrumb-item"><a href="#">Pages</a></li> --}}
   <li class="breadcrumb-item active">Appointments</li>
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
            <h4 class="m-t-0 header-title"><b>All appointments</b></h4>

            <table id="datatable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Appointment For</th>
                        <th>Apppointment Date</th>
                        <th>Status</th>
                    </tr>
                </thead>


                <tbody>
                  @forelse ($appointments as $appointment)
                   <tr style="color: #222;">
                    <td>{{ $loop-> index + 1 }}</td>
                    <td>{{ $appointment->item_name }}</td>
                    <td>{{ $appointment->appointment_time }}</td>
                    <td>
                        @if($appointment->status == 1)
                        <h6><span class="badge badge-success">Confirmed</span></h6>
                        @else 
                        <h6><span class="badge badge-danger">Cancelled</span></h6>
                        @endif
                    </td>
                   </tr>
                  @empty
                   <tr>
                       <td>No appointment available.</td>
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