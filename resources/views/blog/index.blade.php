@extends('layouts.app')
@section('title', 'Blog Post')
@section('content')



<div class="min-h-screen shadow-xl bg-gradient-to-b from-gray-300 to-gray-50 py-4 bg-cover bg-center" style="background-image: url('https://modnica.club/uploads/posts/2021-11/thumbs/1636014460_28-modnica-club-p-stilnaya-abstraktsiya-28.jpg');">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
         <!-- Header Section -->
     <div class="text-center mb-12">
         <h1 class="text-4xl hover:text-gray-600 text-black-600 font-mono tracking-widest">
          Blog Posts
         </h1>
         <h3 class="text-blue-900 font-bold mt-4"> your best expirience </h3>
     </div>
</div>

<div class="gap-8 bg-gradient-to-b from-gray-300 to-gray-100">
    <div class="container mx-auto px-6 py-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($posts as $post)

            <div class="group">

                <article class="bg-gray-200 rounded-lg shadow-xl p-6 transition-all duration-300 group-hover:bg-gray-100" style="height: 300px; overflow-y: auto;">

                    <!-- Title -->
                    <!-- Цветной Header-Стрейп -->
                <div class="bg-gradient-to-r from-blue-500 to-blue-200 h-2 rounded-t-lg">
                                    </div>
                <h2 class="text-2xl font-bold mb-4">
                 {{ $post->getTitle() }}
                 </h2>

                    <div class="pros max-w-none">
                    {!! $post->render() !!}
                    </div>

                     <!-- Content Preview -->
                     {{-- <div class="prose max-w-none text-gray-400 mb-4 line-clamp-3">
                        {!! Str::markdown(Str::limit($post->content, 150)) !!}
                    </div> --}}

                     @if ($post->excerpt)
                    <p class="text-gray-600 mt-4">
                    {{$post->excerpt}}
                    </p>
                    @endif

                    <!-- Category Tags -->
                    @if($post->categories)
                    <div class="flex flex-wrap gap-2 mb-4 ">
                        @foreach($post->categories as $category)
                            <span class="relative mt-4 px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">
                                {{ $category }}
                            </span>
                        @endforeach
                    </div>
                @endif

                    <div class="mt-4 text-sm text-gray-500">
                        <div class="relative mt-4 text-sm text-gray-500 h-32">
                            <span class="absolute bottom-20 left-0">
                                Posted: {{$post->created_at->format('M d, Y') }}
                            </span>
                        </div>

                        <div class="relative">
                        <a href="{{ route('blog.index') }}" class="absolute bottom-20 right-0 text-right font-bold shadow-xl text-blue-800 hover:text-blue-500 tracking-wide">
                            Mehr lesen
                        </a>
                    </div>
                 </div>
             </div>
            </article>
         @endforeach
        </div>

        <!-- Animation -->
        <div class="bg-gray-150 px-6 py-4 mt-10 relative flex justify-center">
            <!-- Datum und "Weiterlesen" Button -->
            <a href="#" class="w-10 h-10 bg-blue-200 rounded-full flex items-center justify-center animate-bounce hover:bg-blue-300 active:bg-blue-400 transition duration-300">
                <svg class="w-6 h-5 text-white">
                    <path fill="none" stroke="blue" stroke-width="2" d="M12 4v12m-7-7l7-7 7 7"></path>
                </svg>
            </a>
            </div>

    </div>
</div>

</div>
            <!-- Footer -->
            <div class="bg-blue-900 px-6 py-4 border-t border-gray-100">
                        <div class="text-center text-white">
                        <p>&copy; 2024 IT Serve. Anna Chernyshova</p>
                    </div>
            </div>
@endsection


