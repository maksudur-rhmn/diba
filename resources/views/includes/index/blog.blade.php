<section class="dc-haslayout dc-main-section">
    <div class="container">
        <div class="row justify-content-center align-self-center">
            <div class="col-sm-12 col-xs-12">
                <div class="tg-sectionhead">
                    <div class="tg-sectiontitle">
                        <h2><span>Healt Buletin & </span><em>Health Tips</em></h2>
                        <img class="tg-svginject" src="{{ asset('frontend_assets/images/sectionline.svg') }}" alt="image description">
                    </div>
                    <p>Lorem ipsum dolor amet consectetur adipisicing eliteiuim sete eiusmod tempor incididunt ut labore etnalom dolore magna aliqua udiminimate veniam quis norud.</p>
                </div>
            </div>
            <div class="dc-articlesholder">

                @forelse ($blogs->take(3) as $blog)
                <div class="col-12 col-sm-12 col-md-6 col-lg-4 float-left">
                        <div class="dc-article">
                            <figure class="dc-articleimg">
                                <img src="{{ asset('uploads/blogs') }}/{{ $blog->blog_image }}" alt="img description">
                                <figcaption>
                                    <div class="dc-articlesdocinfo">
                                        <span>{{ $blog->posted_by }}</span>
                                    </div>
                                </figcaption>
                            </figure>
                            <div class="dc-articlecontent">
                                <div class="dc-title">
                                    <h3><a href="{{ route('front.blogDetails', $blog->blog_slug) }}">{{ $blog->blog_title }}</a></h3>
                                    <p>Category: {{ $blog->relationBetweenCategory->category_name }}</p>
                                    <span class="dc-datetime"><i class="ti-calendar"></i>{{ $blog->created_at->format('d-M-Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h5>No blogs available at the moment.</h5>
                @endforelse
                
            </div>
            <div class="see-more">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <a href="{{ route('front.blogs') }}" class="tg-btn blg-btn">See More Blog post</a>
                </div>
            </div>
        </div>
    </div>
</section>