@extends('layouts.master')

@section('content')
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8">
                    @if (count($posts))
                        @foreach ($posts as $post)
                            <div class="post-news">
                                <div class="content-news">
                                    <div class="news-detail">
                                        <a href="{{ route('post.detail', ['id' => $post->id]) }}">
                                            <img width="872" height="462" src="storage/posts/{{ $post->thumbnail }}"
                                                class="thumnail wp-post-image" alt="" decoding="async"
                                                sizes="(max-width: 872px) 100vw, 872px" style="border-radius: 4px">
                                        </a>
                                        <div class="info-post">
                                            <h4><a
                                                    href="{{ route('post.detail', ['id' => $post->id]) }}">{{ $post->title }}</a>
                                            </h4>
                                            <div class="meta">
                                                <span>{{ \Carbon\Carbon::parse($post->created_at)->format('F d, Y') }}</span>
                                                <span>{{ $post->author }}</span>
                                            </div>
                                            <p>
                                                {{ $post->content }}
                                            </p>
                                            <a href="{{ route('post.detail', ['id' => $post->id]) }}" class="read-more">
                                                続きを読む
                                            </a>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                                <div class="quatrang">

                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center col-12 font-weight-bold">
                            データなし
                        </div>
                    @endif

                </div>
                <div class="col-xs-12 col-sm-12 col-md-4">
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
                                                        <img width="80" height="60"
                                                            src="storage/posts/{{ $post->thumbnail }}"
                                                            class="thumnail wp-post-image" alt="" decoding="async"
                                                            sizes="(max-width: 80px) 100vw, 60px"
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
@endsection
