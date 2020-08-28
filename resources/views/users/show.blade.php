@extends((Auth::user()->role == 2) ? 'layouts.dashboard' : 'layouts.customer')


@section('content')
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title float-left">Profile</h4>

                                    <ol class="breadcrumb float-right">
                                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Ana</a></li>
                                        {{-- <li class="breadcrumb-item"><a href="#">Extras</a></li> --}}
                                        <li class="breadcrumb-item active">{{ $user->name }}</li>
                                    </ol>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="profile-bg-picture" style="background-image:url('{{ asset('dashboard_assets/assets/images/bg-profile.jpg') }}')">
                                    <span class="picture-bg-overlay"></span><!-- overlay -->
                                </div>
                                <!-- meta -->
                                <div class="profile-user-box">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <span class="pull-left m-r-15"><img src="{{ asset('uploads/users') }}/{{ $user->profile_picture }}" alt="" class="thumb-lg rounded-circle"></span>
                                            <div class="media-body">
                                                <h4 class="m-t-5 m-b-5 font-18 ellipsis">{{ $user->name }}</h4>
                                                <p class="font-13">
                                                    @foreach ($user->getRoleNames() as $role)
                                                        {{ $role }}
                                                    @endforeach
                                                </p>
                                                <p class="text-muted m-b-0"><small>{{  ($user->country_id) ? $user->getCountry->name : 'Location not available' }}</small></p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="text-right">
                                                @if(Auth::id() == $user->id)
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success waves-effect waves-light">
                                                    <i class="mdi mdi-account-settings-variant m-r-5"></i> Edit Profile
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ meta -->
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Personal-Information -->
                                <div class="card-box">
                                    <h4 class="header-title mt-0 m-b-20">Personal Information</h4>
                                    <div class="panel-body">
                                        <p class="text-muted font-13">
                                            {{ ($user->personal_info) ? $user->personal_info : "Personal Information not available" }}
                                        </p>

                                        <hr/>

                                        <div class="text-left">
                                            <p class="text-muted font-13"><strong>Full Name :</strong> <span class="m-l-15">{{ $user->name }}</span></p>

                                            <p class="text-muted font-13"><strong>Mobile :</strong><span class="m-l-15">{{ ($user->phone_number) ? $user->phone : "Phone number not available" }}</span></p>

                                            <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15">{{ $user->email }}</span></p>

                                            <p class="text-muted font-13"><strong>Location :</strong> <span class="m-l-15">{{ ($user->country_id) ? $user->getCountry->name : "Country not available" }}</span></p>
                                        </div>

                                        <ul class="social-links list-inline m-t-20 m-b-0">
                                            <li class="list-inline-item">
                                                <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="{{ ($user->fb_id) ? $user->fb_id : url('https://facebook.com') }}" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="{{ ($user->twitter_id) ? $user->twitter_id : url('https://twitter.com') }}" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="{{ ($user->linkedin_id) ? $user->linkedin_id : url('https://linkedin.com') }}" data-original-title="Linkedin" target="_blank"><i class="fa fa-linkedin"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                         

                            </div>
                            <div class="col-md-6">
                                <div class="text-center bg-white">
                                    <img src="{{ asset('uploads/users') }}/{{ $user->profile_picture }}" alt="" width="400" height="306">
                                </div>
                            </div>
                        </div>
@endsection