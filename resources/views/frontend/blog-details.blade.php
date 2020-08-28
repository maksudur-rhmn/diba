@extends('layouts.frontend')

@section('content')

<main id="tg-main" class="tg-main tg-haslayout">
    <div class="container">
        <div class="row">
            <div id="tg-twocolumns" class="tg-twocolumns">
                <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12 pull-right">
                    <div id="tg-content" class="tg-content">
                        <article class="tg-post tg-postdetail">
                            <figure class="tg-postimg"><a href="#"><img src="{{ asset('uploads/blogs') }}/{{ $blog->blog_image }}" alt="image description"></a></figure>
                            <div class="tg-postcontent">
                                <time class="tg-postdate" datetime="2011-10-10">{{ $blog->created_at->format('M') }} <span>{{ $blog->created_at->format('d') }}</span></time>
                                <div class="tg-posttitle">
                                    <h3>{{ $blog->blog_title }}</h3>
                                </div>
                                <ul class="tg-metadata">
                                    <li>
                                        <em>Posted By: </em>
                                        <a href="{{ route('front.blogDetails', $blog->blog_slug) }}">{{ $blog->posted_by }}</a>
                                    </li>
                                    <li>
                                        <em>Category: </em>
                                        <a href="{{ route('front.blogDetails', $blog->blog_slug) }}">{{ $blog->relationBetweenCategory->category_name }}</a>
                                    </li>
                                </ul>
                                <div class="tg-description">
                                    {!! $blog->blog_description !!}
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection