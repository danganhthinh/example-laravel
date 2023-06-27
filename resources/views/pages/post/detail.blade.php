@extends('layouts.master')

@section('css')
    <link href="{{ asset('css/detailPost.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8">
                    <div class="post-news post-news-single">
                        <img width="872" height="462" src="/storage/posts/{{ $post->thumbnail }}"
                            class="thumnail wp-post-image" alt="" decoding="async"
                            sizes="(max-width: 872px) 100vw, 872px" style="border-radius: 4px">
                        <h1 class="single-title">
                            {{ $post->title }}
                        </h1>
                        <div class="meta">
                            <span>
                                {{ \Carbon\Carbon::parse($post->created_at)->format('F d, Y') }} • {{ $post->author }}
                            </span>
                        </div>
                        <article class="post-content">
                            {{ $post->content }}
                        </article>

                        <div class="lienquan row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="title">
                                    <h3>関連記事</h3>
                                    <p></p>
                                </div>
                                <div class="content-lienquan row">
                                    @if (count($relatedPosts))
                                        @foreach ($relatedPosts as $post)
                                            <div class="col-md-4 mb-3">
                                                <div class="related-article">
                                                    <div class="new-img">
                                                        <a href="{{ route('post.detail', ['id' => $post->id]) }}">
                                                            <img class="related-img-post" alt="" decoding="async"
                                                                src="/storage/posts/{{ $post->thumbnail }}" loading="lazy">
                                                        </a>
                                                    </div>
                                                    <div class="item-list">
                                                        <div class="meta-list">
                                                            <span>
                                                                <td>{{ \Carbon\Carbon::parse($post->updated_at)->format('Y/m/d') }}
                                                                </td>

                                                            </span>
                                                        </div>
                                                        <h4>
                                                            <a href="{{ route('post.detail', ['id' => $post->id]) }}">
                                                                {{ $post->content }}
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div class="clear"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="text-center col-12 font-weight-bold">
                                            データなし
                                        </div>
                                    @endif

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="sidebar">
                        <div class="sidebar">
                            <div class="widget">
                                <div class="title">
                                    <h3>最新の記事</h3>
                                    <p></p>
                                </div>
                                <div class="content-new">
                                    @if (count($hotPosts))
                                        @foreach ($hotPosts as $post)
                                            <div class="mt-2">
                                                <div class="row">
                                                    <a class="title-hot-post"
                                                        href="{{ route('post.detail', ['id' => $post->id]) }}">
                                                        <div class="col-xs-3 col-sm-3 col-md-3">
                                                            <img width="80" height="80"
                                                                src="/storage/posts/{{ $post->thumbnail }}"
                                                                class="thumnail wp-post-image" alt=""
                                                                decoding="async" sizes="(max-width: 80px) 100vw, 80px"
                                                                style="border-radius: 4px">
                                                        </div>
                                                        <div class="col-xs-8 col-sm-8 col-md-8">
                                                            <div class="info-post">
                                                                <a class="title-hot-post"
                                                                    href="{{ route('post.detail', ['id' => $post->id]) }}">{{ $post->title }}</a>
                                                                <div style="color:#8C8C8C">
                                                                    <span>{{ \Carbon\Carbon::parse($post->created_at)->format('F d, Y') }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>


                                            </div>
                                        @endforeach
                                    @else
                                        <div class="text-center col-12 font-weight-bold">
                                            データなし
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
