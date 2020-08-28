@php
    error_reporting(0);
@endphp
@extends((Auth::user()->role == 2) ? 'layouts.dashboard' : 'layouts.customer')

@section('title')
    ANA | Users
@endsection

@section('user-active')
    active
@endsection

@section('breadcrumb')
<h4 class="page-title float-left">Change Password</h4>

<ol class="breadcrumb float-right">
   <li class="breadcrumb-item"><a href="{{ route('home') }}">ANA</a></li>
   {{-- <li class="breadcrumb-item"><a href="#">Pages</a></li> --}}
   <li class="breadcrumb-item active">{{ $user->name }}</li>
   <li class="breadcrumb-item active">Change Password</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        {{-- Error Message --}}
         @if($errors->all())
           @foreach ($errors->all() as $error)
               <div class="alert alert-danger">
                <li>{{ $error }}</li>
               </div>
           @endforeach
         @endif
        {{-- Error Message --}}

        {{-- Success Message --}}
         @if (session('success'))
             <div class="alert alert-success">
                 {{ session('success') }}
             </div>
         @endif
        {{-- Success Message --}}
        <form action="{{ route('password.updated') }}" class="form-group" method="post">
         @csrf

         <div class="py-3">
             <label for="old_password">Old password</label>
             <input id="old_password" type="password" class="form-control" name="old_password" placeholder="Enter old password">
         </div>

         <div class="py-3">
             <label for="password">New password</label>
             <input id="password" type="password" class="form-control" name="password" placeholder="Enter new password">
         </div>

         <div class="py-3">
             <label for="password_confirmation">Confirm password</label>
             <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Enter new password">
         </div>
         
          <div class="py-3">
              <button type="submit" class="btn btn-success">Update password</button>
          </div>
        </form>
    </div>
</div>

@endsection