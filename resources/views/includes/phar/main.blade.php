<main id="tg-main" class="tg-main tg-haslayout">
    <div class="container">
        <div class="row">
            <div id="tg-onecolumns" class="tg-onecolumns">
                @php
                    $i = 1;
                @endphp
                @foreach($pharmacies as $pharmacy)   
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 py-4">
                    <div id="tg-content" class="tg-content">
                        <div class="tg-directpost tg-detailpage">
                            <figure class="tg-directpostimg">
                                <a href="{{ route('front.phar') }}"><img src="{{ asset('uploads/pharmacies') }}/{{ $pharmacy->pharmacies_image }}" alt="image description"></a>
                            </figure>
                            

                            <div class="tg-directinfo">
                                <div class="tg-directposthead">
                                    <h2>{{ $pharmacy->name }}</h2>
                                    <div class="tg-subjects"><span>Address:</span>{{ $pharmacy->address }}</div>
                                    <div class="tg-subjects"><span>City:</span>{{ $pharmacy->relationBetweenCity->name }}</div>
                                    <div class="tg-subjects"><span>Phone:</span>{{ $pharmacy->phone }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            {{ $pharmacies->links() }}
        </div> 
    </div>
</main>


