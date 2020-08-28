<div id="tg-homebanner" class="tg-homebanner tg-haslayout">
    <figure class="tg-bannerbg">
        <img src="{{ asset('frontend_assets/images/banner/img-01.jpg') }}" alt="image description">
    </figure>
    <div class="tg-bannercontent">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <form class="tg-formtheme tg-formsearch" action="{{ route('search.all') }}" method="GET">
                        <div class="tg-sectionhead">
                            <div class="tg-sectiontitle">
                                <h1>Find a Medical Help!</h1>
                                <img class="tg-svginject" src="{{ asset('frontend_assets/images/sectionline.svg') }}" alt="image description">
                            </div>
                        </div>
                        <fieldset>
                            <div class="tg-select">
                                <select name="city">
                                    <option value="">Select Area</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="tg-select">
                                <select name="category">
                                    <option value=" ">-Select Categories-</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="text" name="search" class="form-control" placeholder="Doctors, Hospitals, Phamacies, Ambulance">
                            <button type="submit" class="tg-btnformsearch"><i class="fa fa-search"></i></button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>