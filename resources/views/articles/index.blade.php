@extends('layout')

@section('content')

<div id="wrapper">
    <div id="page" class="container">
        <div id="content">
            @foreach ($articles as $article)
            <div class="title">
                <h2>
                    <a href="{{ $article->path() }}">{{ $article->title }}</a>
                </h2>
                <span class="byline">{{ $article->excerpt }}</span>
            </div>
            <p>
                <img src="/images/banner.jpg" alt="" class="image image-full" />
            </p>

            {{ $article->body }}
            @endforeach


        </div>

    </div>
</div>

@endsection
