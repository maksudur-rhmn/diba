<section class="tg-main-section tg-haslayout">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="tg-trustedbymany">
                    <div class="tg-sectionhead">
                        <div class="tg-sectiontitle">
                            <h2>Sponsors</h2>
                            <img class="tg-svginject" src="{{ asset('frontend_assets/images/sectionline.svg') }}" alt="image description">
                        </div>
                    </div>
                    <div id="tg-brandsslider" class="tg-brandsslider tg-brands">


                        @forelse ($sponsors->chunk(2) as $sponsor)
                               <div class="item">
                            @foreach ($sponsor as $item)
                            <figure><a href="#"><img src="{{ asset('uploads/sponsors') }}/{{ $item->sponsor }}" alt="image description"></a></figure>
                            @endforeach
                               </div>
                        @empty
                            <h5>No sponsors available at the moment</h5>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


