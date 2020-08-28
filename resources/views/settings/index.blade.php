@extends('layouts.dashboard')

@section('settings-active')
    active
@endsection

@section('breadcrumb')
<h4 class="page-title float-left">Central Settings</h4>

<ol class="breadcrumb float-right">
   <li class="breadcrumb-item"><a href="{{ route('home') }}">ANA</a></li>
   {{-- <li class="breadcrumb-item"><a href="#">Pages</a></li> --}}
   <li class="breadcrumb-item active">Central Settings</li>
</ol>
@endsection

@section('content')
    {{-- Error Alert --}}
    @if($errors->all())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif

    @hasrole('Admin')
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('settings.update', $setting->id) }}" class="form-group" method="post" enctype="multipart/form-data">
             @csrf
             {{ method_field('PUT') }}
             <div class="py-3">
                 <label for="title">Website Title</label>
                 <input id="title" type="text" class="form-control" name="title" value="{{ $setting->title }}">
             </div>
             <div class="py-3">
                 <label for="logo">Website Logo</label>
                 <input id="logo" type="file" class="form-control" name="logo">
             </div>
             <div class="py-3 text-center">
                 <img src="{{ asset('uploads/settings') }}/{{ $setting->logo }}" alt="Not found" width="300" height="300">
             </div>
             <div class="py-3">
                 <label for="favicon">Website Favicon</label>
                 <input id="favicon" type="file" class="form-control" name="favicon">
             </div>
             <div class="py-3 text-center">
                 <img src="{{ asset('uploads/settings') }}/{{ $setting->favicon }}" alt="Not found" width="200" height="200">
             </div>
              <div class="py-3">
                  <button type="submit" class="btn btn-success">Submit</button>
              </div>
            </form>
        </div>
    </div>
    @else 
        <h5>You do not have permission to change the central settings of the website.</h5>
    @endhasrole

@endsection