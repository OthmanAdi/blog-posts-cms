@extends('layouts.app')

@section('title', $post->getTitle())

@section('content')
<article class="bg-white tounded-lg shadow p-6">
    <h1 class="text-3xl font-bold mb-6">{{ @post->getTitle() }} </h1>

    <div class="proxe max-w-none">
        {!! $post->render !!}
    </div>

    @if ($post->getAuthot())
        <div class="mt-6 pt-6 border-t">
            <p class="text-sm text-grau-500">
                Written By: {{ $post->getAuthor()->name }}
            </p>
        </div>
    @endif
</article>
@endsection
