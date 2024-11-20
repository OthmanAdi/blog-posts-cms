@extends('layouts.app')
@section('title', 'Blog Post')
@section('content')
<div class="container mx-auto px-6 py-4">
    <div class="grid gap-6">
        @foreach ($posts as $post)
        <article class="bd-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold mb-4">
                {{ $post->getTitle() }}
            </h2>
            <div class="pros max max-w-none">
                {!! $post->render() !!}
            </div>
            @if ($post->excerpt)
            <p class="text-grau-600 mt-4">
                {{$post->excerpt}}
            </p>
            @endif
            <div class="mt-4 text-sm text-gray-500">
                Posted: {{$post->created_at->format('M d, Y') }}
            </div>
        </article>
        @endforeach
    </div>
</div>
@endsection
hat Kontextmenü

