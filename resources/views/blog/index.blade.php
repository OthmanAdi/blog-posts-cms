@extends('layouts.app')

{{-- da section nur text ist, kein container wird es nicht geschlossen. --}}
@section('title', 'Blog Posts')


@section('content')
<div class="container mx-auto px-4">
    <div class="grid gap-6">
        @foreach ($posts as $post)
            <article class="bg-white rounded-lg px-4">
                <h2 class="text-2xl font-bold mb-4">
                    {{$post->title}}
                </h2>

                <div class="pros max-w-none">
                    {{$post->content}}
                </div>
                @if ($post->excerpt)
                <p class="text-gray-200 mt-4">
                    {{$post->excerpt}}
                </p>
                @endif

                <div class="mt-4 text-sm text-gray-500">
                    Posted: {{ $post->created_at->format('M, d, Y') }}
                </div>
            </article>
        @endforeach
    </div>
</div>
@endsection


