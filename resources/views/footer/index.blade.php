@extends('layouts.dashboard')


@section('footer-active')
    active
@endsection

@section('breadcrumb')
<h4 class="page-title float-left">Footers</h4>

<ol class="breadcrumb float-right">
   <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ centralSettings()->title }}</a></li>
   {{-- <li class="breadcrumb-item"><a href="#">Pages</a></li> --}}
   <li class="breadcrumb-item active">Footers</li>
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
                      Footer Settings
                  </div>
                  <div class="card-body">
                      <form action="{{ route('footer.update', $footer->id) }}" class="form-group" method="POST">
                        @csrf 
                        {{ method_field('PUT') }}
                        <div class="p-3">
                            <label for="address">Address</label>
                            <input id="address" type="text" class="form-control" name="address" value="{{ $footer->address }}">
                        </div>
                        <div class="p-3">
                            <label for="phone_one">Phone One</label>
                            <input id="phone_one" type="text" class="form-control" name="phone_one" value="{{ $footer->phone_one }}">
                        </div>
                        <div class="p-3">
                            <label for="phone_two">Phone Two</label>
                            <input id="phone_two" type="text" class="form-control" name="phone_two" value="{{ $footer->phone_one }}">
                        </div>
                        <div class="p-3">
                            <label for="email">Email</label>
                            <input id="email" type="text" class="form-control" name="email" value="{{ $footer->email }}">
                        </div>
                        <div class="p-3">
                            <label for="facebook_link">Facebook Account</label>
                            <input id="facebook_link" type="text" class="form-control" name="facebook_link" value="{{ $footer->facebook_link }}">
                        </div>
                        <div class="p-3">
                            <label for="twitter_link">Twitter Account</label>
                            <input id="twitter_link" type="text" class="form-control" name="twitter_link"  value="{{ $footer->twitter_link }}">
                        </div>
                        <div class="p-3">
                            <label for="linkedin_link">Linkedin Account</label>
                            <input id="linkedin_link" type="text" class="form-control" name="linkedin_link" value="{{ $footer->linkedin_link }}">
                        </div>

                        <div class="p-3">
                            <button class="btn btn-primary" type="submit">Update Footer Settings</button>
                        </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
    
@endsection