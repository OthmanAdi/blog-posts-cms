@extends('layouts.app')

 @section('title', $post->GetTitle())

 @section('content')
 <article class="bg-white rounded-lg shadow p-6">
    <h1 class="text-3xl font-bold mb-7">{{@post->getTitle()}}</h1>

    <div class="prose max-w-none">
        {{-- {{UNESCAPED CONTENT}}
        {{ WIR VERWENDET wenn tatsächlich html gerendert wird}} --}}
         {!! $post->render() !!}
    </div>

    @if ($post->getAuthor())
    <div class="mt-6 pt-6 border-t">
        <p class="text-sm text-gray-200">
            Written by : {{ $post->getAuthor()->name}}
        </p>
        <div>
    @endif
 </article>
