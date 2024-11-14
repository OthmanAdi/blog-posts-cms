@extends('layouts.app')

@section('title', 'Blog Posts')

@section('content')
    <div class="container mx-auto px-4">
        <div class="grid gap-6">
            @foreach ($posts as $post)
                <article class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-2xl font-bold mb-4">
                        {{ $post->title }}
                    </h2>
                    <div class="prose max-w-none">
                        {{ $post->content }}
                    </div>
                    @if ($post->excerpt)
                        <p class="text-gray-600 mt-4">
                            {{ $post->excerpt }}
                        </p>
                    @endif
                    <div class="mt-4 text-sm text-gray-500">
                        Posted: {{ $post->created_at->format('M d, Y') }}
                    </div>
                </article>
            @endforeach
        </div>
    </div>
@endsection
