@extends('layouts.dashboard')


@section('dash-active')
    active
@endsection

@section('breadcrumb')
<h4 class="page-title float-left">Home</h4>

<ol class="breadcrumb float-right">
   <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ centralSettings()->title }}</a></li>
   {{-- <li class="breadcrumb-item"><a href="#">Pages</a></li> --}}
   <li class="breadcrumb-item active">Home</li>
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

        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="card-box widget-box-two widget-two-custom">
                    <i class="mdi mdi-currency-usd widget-two-icon"></i>
                    <div class="wigdet-two-content">
                        <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Total Appointments</p>
                        <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup">{{ $appointment_total }}</span></h2>
                        
                    </div>
                </div>
            </div><!-- end col -->

            <div class="col-lg-4 col-md-6">
                <div class="card-box widget-box-two widget-two-custom">
                    <i class="mdi mdi-account-multiple widget-two-icon"></i>
                    <div class="wigdet-two-content">
                        <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Total Registrated users</p>
                        <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup">{{ $total_users }}</span></h2>
                    </div>
                </div>
            </div><!-- end col -->

            <div class="col-lg-4 col-md-6">
                <div class="card-box widget-box-two widget-two-custom">
                    <i class="mdi mdi-crown widget-two-icon"></i>
                    <div class="wigdet-two-content">
                        <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Total Doctors</p>
                        <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup">{{ $total_doctors }}</span></h2>
                    </div>
                </div>
            </div><!-- end col -->

        </div>
        <!-- end row -->
        <div style="width: 80%;margin: 0 auto;">
            {!! $chart->container() !!}
        </div>
        {{-- Load Chart --}}
        <script src="{{ asset('dashboard_assets/assets/js/chart.min.js') }}" charset="utf-8"></script>
        {!! $chart->script() !!}

@endsection
