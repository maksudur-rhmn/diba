    <!--************************************
				Footer Start
		*************************************-->
        <footer id="tg-footer" class="tg-footer tg-haslayout">
            <div class="tg-subscribe">
                <div class="container">
                    <div class="row">
                        <div class="tg-fcols">
                            <div class="col-sm-3">
                                <div class="tg-subscribetitle">
                                    <h3>Signup For Latest Updates and News</h3>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <form class="tg-formtheme tg-formsubscribe" action="{{ route('subscribers.store') }}" method="POST">
                                    @csrf
                                    <fieldset>
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" placeholder="Your Name">
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control" placeholder="Your Email">
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group"><button class="tg-btn" type="submit">Register Now</button></div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tg-quicklinks">
                <div class="container">
                    <div class="row">
                        <div class="tg-fcols">
                            <div class="tg-fcol">
                                <strong class="tg-logo">
                                    <a href="index.html"><img src="{{ asset('uploads/settings') }}/{{ centralSettings()->logo }}" alt="image description"></a>
                                </strong>
                                <ul class="tg-contactinfo">
                                    <li><a href="#"><i class="fa fa-location-arrow"></i>
                                            <address>{{ footerSettings()->address }}</address>
                                        </a></li>
                                    <li><a href="#"><i class="fa fa-phone"></i><span>{{ footerSettings()->phone_one }}</span></a></li>
                                    <li><a href="#"><i class="fa fa-envelope-o"></i><span>{{ footerSettings()->email }}</span></a></li>
                                    <li><a href="#"><i class="fa fa-fax"></i><span>{{ footerSettings()->phone_two }}</span></a></li>
                                </ul>
                                <ul class="tg-socialsharewithtext">
                                    <li class="tg-facebook">
                                        <a class="tg-roundicontext" href="{{ footerSettings()->facebook_link }}">
                                            <em class="tg-usericonholder">
                                                <i class="fa fa-facebook-f"></i>
                                                <span>share on facebook</span>
                                            </em>
                                        </a>
                                    </li>
                                    <li class="tg-twitter">
                                        <a class="tg-roundicontext" href="{{ footerSettings()->twitter_link }}">
                                            <em class="tg-usericonholder">
                                                <i class="fa fa-twitter"></i>
                                                <span>share on twitter</span>
                                            </em>
                                        </a>
                                    </li>
                                    <li class="tg-linkedin">
                                        <a class="tg-roundicontext" href="{{ footerSettings()->linkedin_link }}">
                                            <em class="tg-usericonholder">
                                                <i class="fa fa-linkedin"></i>
                                                <span>share on linkdin</span>
                                            </em>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tg-fcol tg-specialities">
                                <div class="tg-title">
                                    <h3>Our Services</h3>
                                </div>
                                <ul>
                                    <li><a href="{{ route('front.docs') }}">Doctors</a></li>
                                    <li><a href="{{ route('front.hos') }}">Hospitals</a></li>
                                    <li><a href="{{ route('front.phar') }}">Pharmacies</a></li>
                                    <li><a href="{{ route('front.ambu') }}">Ambulances</a></li>
                                </ul>
                            </div>
                            <div class="tg-fcol tg-latestlistings">
                                <div class="tg-title">
                                    <h3>Latest Listings</h3>
                                </div>
                                <ul>
                                    @forelse (latestDocs()->take(3) as $doctor)
                                        <li>
                                            <figure class="tg-authordp">
                                                <img src="{{ asset('uploads/doctors') }}/{{ $doctor->doctors_image }}" alt="image description" width="50" height="50">
                                            </figure>
                                            <div class="tg-directposthead">
                                                <h3><a href="#">{{ $doctor->name }}</a></h3>
                                                <div class="tg-sub">{{ $doctor->speciality }} &amp; {{ $doctor->academic_details }}</div>
                                            </div>
                                        </li> 
                                    @empty 
                                      <p>No doctor available</p>   
                                    @endforelse
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tg-footerbar">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <span class="tg-copyright">2020 All Rights Reserved &copy; <a href="{{ url('/') }}">Dibas Health Center</a> Developed by Farahnaz Ahmed</span>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--************************************
				Footer End
		*************************************-->
    </div>
    <!--************************************
			Wrapper End						
	*************************************-->
    <!--************************************
				Light Box Start				
	*************************************-->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <h2>Provide Your Information</h2>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Your Name</label>
                                <input type="text" placeholder="Enter Your Name">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" placeholder="Enter Your Phone Number">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <select class="cat">
                                    <option>Select Time Schedule</option>
                                    <option>Saturday</option>
                                    <option>Sunday</option>
                                    <option>Monday</option>
                                    <option>Tuesday</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!--************************************
				Light Box End				
    *************************************-->
    
    

    <script src="{{ asset('frontend_assets/js/vendor/jquery-library.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/mapclustering/data.json') }}"></script>
    <script src="{{ asset('frontend_assets/https://maps.google.com/maps/api/js?key=AIzaSyCR-KEWAVCn52mSdeVeTqZjtqbmVJyfSus&amp;language=en') }}"></script>
    <script src="{{ asset('frontend_assets/js/mapclustering/markerclusterer.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/mapclustering/infobox.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/customScrollbar.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/mapclustering/map.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/jquery.countdown.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/isotope.pkgd.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/packery-mode.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/svg-injector.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/collapse.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/parallax.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/readmore.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/countTo.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/loader.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/appear.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/gmap3.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/main.js') }}"></script>
</body></html>