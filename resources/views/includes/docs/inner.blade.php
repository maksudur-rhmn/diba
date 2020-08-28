<div class="tg-pageinnerbanner tg-haslayout tg-parallaximg" data-appear-top-offset="600" data-parallax="scroll" data-image-src="{{ asset('frontend_assets/images/banner/img-02.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="tg-pageheadcontent">
                <form class="tg-formtheme tg-formsearch">
                    <fieldset>
                            <div class="tg-select">
                                <select>
                                    <option value="">Select Area</option>
                                     @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option> 
                                     @endforeach
                                </select>
                            </div>
                            <div class="tg-select">
                                <select>
                                    <option>Select Categories</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        <input type="text" name="category" class="form-control" placeholder="Search here by doctor name">
                        <button type="submit" class="tg-btnformsearch"><i class="fa fa-search"></i></button>
                    </fieldset>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>