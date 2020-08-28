<section class="tg-main-section tg-haslayout">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="tg-sectionhead">
                    <div class="tg-sectiontitle">
                        <h2>Featured Listings</h2>
                        <img class="tg-svginject" src="{{ asset('frontend_assets/images/sectionline.svg') }}" alt="image description">
                    </div>
                </div>
                <ul id="tg-filterbalenav" class="tg-filterbalenav option-set">
                    {{-- <li><a class="tg-active" data-filter="*" href="javascript:void(0);">all</a></li> --}}
                    <li><a data-filter=".doctors" href="javascript:void(0);">ALl</a></li>
                    <li><a data-filter=".docs" href="javascript:void(0);">Doctors</a></li>
                    <li><a data-filter=".hos" href="javascript:void(0);">Hospitals</a></li>
                    <li><a data-filter=".phar" href="javascript:void(0);">Pharmacies</a></li>
                    <li><a data-filter=".ambu" href="javascript:void(0);">Ambulance</a></li>
                </ul>
                <div id="filter-masonry" class="tg-featureddirectposts tg-searchresult tg-filtermasonry">

                    @foreach ($doctors as $doctor)
                        <div class="tg-directpost doctors initial-show">
                            <figure class="tg-directpostimg">
                                <a href="#"><img src="{{ asset('uploads/doctors') }}/{{ $doctor->doctors_image }}" alt="image description"></a>
                            </figure>
                            <div class="tg-directinfo">
                                <div class="tg-leftarea">
                                    <div class="tg-directposthead">
                                        <h3><a href="#">{{ $doctor->name }}</a></h3>
                                        <div class="tg-sub">{{ $doctor->academic_details }} &amp; {{ $doctor->speciality }}</div>
                                    </div>
                                </div>
                                <div class="tg-rightarea">
                                    <div class="tg-bookappoinment">
                                        <a href="{{ url('/docs') }}" class="tg-btn" style="color:#fff;">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                   @foreach ($hospitals as $hospital)
                   <div class="tg-directpost doctors initial-show">
                    <figure class="tg-directpostimg">
                        <a href="#"><img src="{{ asset('uploads/hospitals') }}/{{ $hospital->hospitals_image }}" alt="image description"></a>
                    </figure>
                    <div class="tg-directinfo">
                        <div class="tg-leftarea">
                            <div class="tg-directposthead">
                                <h3><a href="#">{{ $hospital->name }}</a></h3>
                                <div class="tg-sub">{{ $hospital->address }} &amp; {{ $hospital->relationBetweenCity->name }}</div>
                            </div>
                        </div>
                        <div class="tg-rightarea">
                            <div class="tg-bookappoinment">
                                <a href="{{ url('/hos') }}" class="tg-btn" style="color:#fff;">Details</a>
                            </div>
                        </div>
                    </div>
                   </div>   
                   @endforeach
                    
                    @foreach ($ambulances as $ambulance)
                    <div class="tg-directpost doctors initial-show">
                        <figure class="tg-directpostimg">
                            <a href="#"><img src="{{ asset('uploads/ambulance') }}/{{ $ambulance->ambulance_image }}" alt="image description"></a>
                        </figure>
                        <div class="tg-directinfo">
                            <div class="tg-leftarea">
                                <div class="tg-directposthead">
                                    <h3><a href="#">{{ $ambulance->name }}</a></h3>
                                    <div class="tg-sub">{{ $ambulance->address }} &amp; {{ $ambulance->relationBetweenCity->name }}</div>
                                </div>
                            </div>
                            <div class="tg-rightarea">
                                <div class="tg-bookappoinment">
                                    <a href="{{ url('/ambu') }}" class="tg-btn" style="color:#fff;">Details</a>
                                </div>
                            </div>
                        </div>
                    </div>                        
                    @endforeach

                    @foreach ($pharmacies as $pharmacy)
                    <div class="tg-directpost doctors initial-show">
                        <figure class="tg-directpostimg">
                            <a href="#"><img src="{{ asset('uploads/pharmacies') }}/{{ $pharmacy->pharmacies_image }}" alt="image description"></a>
                        </figure>
                        <div class="tg-directinfo">
                            <div class="tg-leftarea">
                                <div class="tg-directposthead">
                                    <h3><a href="#">{{ $pharmacy->name }}</a></h3>
                                    <div class="tg-sub">{{ $pharmacy->address }} &amp; {{ $pharmacy->relationBetweenCity->name }}</div>
                                </div>
                            </div>
                            <div class="tg-rightarea">
                                <div class="tg-bookappoinment">
                                    <a href="{{ url('/phar') }}" class="tg-btn" style="color:#fff;">Details</a>
                                </div>
                            </div>
                        </div>
                    </div> 
                    @endforeach

                    @foreach ($allDocs as $doctor)
                    <div class="tg-directpost docs initial-show">
                        <figure class="tg-directpostimg">
                            <a href="#"><img src="{{ asset('uploads/doctors') }}/{{ $doctor->doctors_image }}" alt="image description"></a>
                        </figure>
                        <div class="tg-directinfo">
                            <div class="tg-leftarea">
                                <div class="tg-directposthead">
                                    <h3><a href="#">{{ $doctor->name }}</a></h3>
                                    <div class="tg-sub">{{ $doctor->academic_details }} &amp; {{ $doctor->speciality }}</div>
                                </div>
                            </div>
                            <div class="tg-rightarea">
                                <div class="tg-bookappoinment">
                                    <a href="{{ url('/docs') }}" class="tg-btn" style="color:#fff;">Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @foreach ($allHos as $hospital)
                    <div class="tg-directpost hos initial-show">
                        <figure class="tg-directpostimg">
                            <a href="#"><img src="{{ asset('uploads/hospitals') }}/{{ $hospital->hospitals_image }}" alt="image description"></a>
                        </figure>
                        <div class="tg-directinfo">
                            <div class="tg-leftarea">
                                <div class="tg-directposthead">
                                    <h3><a href="#">{{ $hospital->name }}</a></h3>
                                    <div class="tg-sub">{{ $hospital->address }} &amp; {{ $hospital->relationBetweenCity->name }}</div>
                                </div>
                            </div>
                            <div class="tg-rightarea">
                                <div class="tg-bookappoinment">
                                    <a href="{{ url('/hos') }}" class="tg-btn" style="color:#fff;">Details</a>
                                </div>
                            </div>
                        </div>
                       </div>   
                    @endforeach

                    @foreach ($allPhars as $pharmacy)
                    <div class="tg-directpost phar initial-show">
                        <figure class="tg-directpostimg">
                            <a href="#"><img src="{{ asset('uploads/pharmacies') }}/{{ $pharmacy->pharmacies_image }}" alt="image description"></a>
                        </figure>
                        <div class="tg-directinfo">
                            <div class="tg-leftarea">
                                <div class="tg-directposthead">
                                    <h3><a href="#">{{ $pharmacy->name }}</a></h3>
                                    <div class="tg-sub">{{ $pharmacy->address }} &amp; {{ $pharmacy->relationBetweenCity->name }}</div>
                                </div>
                            </div>
                            <div class="tg-rightarea">
                                <div class="tg-bookappoinment">
                                    <a href="{{ url('/phar') }}" class="tg-btn" style="color:#fff;">Details</a>
                                </div>
                            </div>
                        </div>
                    </div> 
                    @endforeach
                    
                    @foreach ($allAmbu as $ambulance)
                    <div class="tg-directpost ambu initial-show">
                        <figure class="tg-directpostimg">
                            <a href="#"><img src="{{ asset('uploads/ambulance') }}/{{ $ambulance->ambulance_image }}" alt="image description"></a>
                        </figure>
                        <div class="tg-directinfo">
                            <div class="tg-leftarea">
                                <div class="tg-directposthead">
                                    <h3><a href="#">{{ $ambulance->name }}</a></h3>
                                    <div class="tg-sub">{{ $ambulance->address }} &amp; {{ $ambulance->relationBetweenCity->name }}</div>
                                </div>
                            </div>
                            <div class="tg-rightarea">
                                <div class="tg-bookappoinment">
                                    <a  href="{{ url('/ambu') }}" class="tg-btn" style="color:#fff">Details</a>
                                </div>
                            </div>
                        </div>
                    </div>                        
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>