@extends('layouts.frontend')

@section('content')

<main id="tg-main" class="tg-main tg-haslayout">
    <div class="container">
        <div class="row">
            <div id="tg-content" class="tg-content">
                <div class="col-sm-12 col-xs-12">
                    <div class="tg-sectionhead">
                        <div class="tg-sectiontitle">
                            <h2>Latest News</h2>
                            <img class="tg-svginject" src="{{ asset('frontend_assets/images/sectionline.svg') }}" alt="image description">
                        </div>
                    </div>
                </div>
                <div class="tg-latestnews tg-grid">

                    @forelse ($blogs as $blog)
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <article class="tg-post">
                            <figure class="tg-postimg"><a href="{{ route('front.blogDetails', $blog->blog_slug) }}"><img src="{{ asset('uploads/blogs') }}/{{ $blog->blog_image }}" alt="image description"></a></figure>
                            <div class="tg-postcontent">
                                <time class="tg-postdate" datetime="2011-10-10">{{ $blog->created_at->format('M') }} <span>{{ $blog->created_at->format('d') }}</span></time>
                                <div class="tg-posttitle">
                                    <h3><a href="{{ route('front.blogDetails', $blog->blog_slug) }}">{{ $blog->blog_title }}</a></h3>
                                </div>
                                <ul class="tg-metadata">
                                    <li>
                                        <em>Posted By: {{ $blog->posted_by }} </em>
                                    </li>
                                </ul>
                                <ul class="tg-metadata">
                                    <li>
                                        <em>Category: {{ $blog->relationBetweenCategory->category_name }} </em>
                                    </li>
                                </ul>
                                <div class="tg-description">
                                    <p>{!! Str::limit($blog->blog_description, 100) !!}</p>
                                </div>
                            </div>
                        </article>
                    </div>
                    @empty
                        <h5>No blogs available at the moment</h5>
                    @endforelse
                    
                </div>
                <div class="col-sm-12 col-xs-12">
                    
                       {{ $blogs->links() }}
                </div>
            </div>
        </div>
    </div>
</main>

@endsection