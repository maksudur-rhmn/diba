@extends((Auth::user()->role == 2) ? 'layouts.dashboard' : 'layouts.customer')

@section('title')
    ANA | Users
@endsection

@section('user-active')
    active
@endsection

@section('breadcrumb')
<h4 class="page-title float-left">Edit Profile</h4>

<ol class="breadcrumb float-right">
   <li class="breadcrumb-item"><a href="{{ route('home') }}">ANA</a></li>
   {{-- <li class="breadcrumb-item"><a href="#">Pages</a></li> --}}
   <li class="breadcrumb-item active">{{ $user->name }}</li>
</ol>
@endsection

@section('content')


<div class="row">
      @if($errors->all())
      <div class="alert alert-danger">
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </div>
      @endif
    <div class="col-lg-12 col-md-12 col-sm-12">
        <form action="{{ route('users.update', $user->id) }}" class="form-group" method="post" enctype="multipart/form-data">
         @csrf
         {{ method_field('PUT') }}
         <div class="py-3">
             <label for="name">Full name</label>
             <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}">
         </div>
         <div class="py-3">
             <label for="email">Email Address</label>
             <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}">
         </div>
         <div class="py-3">
             <label for="profile_picture">Profile picture</label>
             <input id="profile_picture" type="file" class="form-control" name="profile_picture">
         </div>
         <div class="py-3">
             <img src="{{ asset('uploads/users') }}/{{ $user->profile_picture }}" alt="Not found" width="200" height="200">
         </div>
         <div class="py-3">
             <label for="personal_info">Personal information</label>
             <textarea name="personal_info" id="personal_info" class="form-control" placeholder="Enter personal informations">{{ $user->personal_info }}</textarea>
         </div>
         <div class="py-3">
             <label for="phone_number">Phone number</label>
             <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" placeholder="Enter phone number">
         </div>
          <div class="py-3">
              <label for="country">Country</label>
             <select name="country_id" id="country" class="form-control">
                 @if($user->country_id)
                  <option value="{{ $user->country_id }}">{{ $user->getCountry->name }}</option>
                 @else 
                  <option value="">-Select Your Country-</option>
                 @endif
                 @foreach ($countries as $country)
                     <option value="{{ $country->id }}">{{ $country->name }}</option>
                 @endforeach
             </select>
          </div>
          <div class="py-3">
              <label for="fb_id">Enter Facebook address</label>
              <input id="fb_id" name="fb_id" type="text" class="form-control" value="{{ $user->fb_id }}" placeholder="Enter your facebook url">
          </div>
          <div class="py-3">
              <label for="twitter_id">Enter Twitter address</label>
              <input id="twitter_id" name="twitter_id" type="text" class="form-control" value="{{ $user->twitter_id }}" placeholder="Enter your twitter url">
          </div>
          <div class="py-3">
              <label for="linkedin_id">Enter Linkedin address</label>
              <input id="linkedin_id" name="linkedin_id" type="text" class="form-control" value="{{ $user->linkedin_id }}" placeholder="Enter your linkedin url">
          </div>
          <div class="py-3">
              <button type="submit" class="btn btn-success">Update profile</button>
          </div>
        </form>
    </div>
</div>
   
@endsection