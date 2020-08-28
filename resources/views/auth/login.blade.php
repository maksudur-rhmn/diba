
@extends('layouts.regnloghandler')

@section('title')
    Dibas Health Centre | Login
@endsection

@section('content')
    
<!-- HOME -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
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
                <div class="wrapper-page">
                    
                    <div class="account-pages">
                        <div class="account-box">
                            <div class="account-logo-box">
                                <h2 class="text-uppercase text-center">
                                    <a href="{{ url('/login') }}" class="text-success">
                                        <span>Dibas Health Centre Login </span>
                                    </a>
                                </h2>
                                <h5 class="text-uppercase font-bold m-b-5 m-t-50">Sign In</h5>
                                <p class="m-b-0">Login to your account</p>
                            </div>
                            <div class="account-content">
                                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    
                                    <div class="form-group m-b-20 row">
                                        <div class="col-12">
                                            <label for="email">Email address</label>
                                            <input placeholder="Email or Phone number" id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row m-b-20">
                                                <div class="col-12">
                                                    @if (Route::has('password.request'))
                                                    <a class="text-muted pull-right" href="{{ route('password.request') }}">
                                                        {{ __('Forgot Your Password?') }}
                                                    </a>
                                                    @endif
                                                    <label for="password">Password</label>
                                                    <input  id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row m-b-20">
                                                <div class="col-12">
                                                    
                                                    <div class="checkbox checkbox-success">
                                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                        <label for="remember">
                                                            Remember me
                                                        </label>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row text-center m-t-10">
                                                <div class="col-12">
                                                    <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit">Sign In</button>
                                                </div>
                                            </div>
                                            
                                        </form>
                                        
                                        <div class="row">
                                        <div class="row m-t-50">
                                            <div class="col-sm-12 text-center">
                                                <p class="text-muted">Don't have an account? <a href="{{ url('/register') }}" class="text-dark m-l-5"><b>Sign Up</b></a></p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- end card-box-->
                            

                        </div>
                        <!-- end wrapper -->
                        
                    </div>
                </div>
            </div>
          </section>
          <!-- END HOME -->
          

          
 


@endsection