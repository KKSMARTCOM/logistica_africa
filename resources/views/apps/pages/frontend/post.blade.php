@extends('layouts.main')

@section('title', 'Actualités')

@section('content')
    @include('components.widgets.breadcrumb')

    <section class="container px-[1rem] md:px-[0px] lg:px-[3rem] mx-auto py-[2.5rem] md:py-[5rem]">
        <h1 class="text-xl md:text-[1.5rem] lg:text-[2rem] leading-7 font-semibold mb-6">{{ $post->title }}</h1>
        <div class="block sm:flex justify-end px-0 sm:px-10 gap-4 items-center mb-2">
            <p class="text-xs sm:text-[0.9rem] text-gray-600">{{ $post->estimated_reading_time }} minutes de
                lecture</p>
            <div class="hidden sm:block h-[.5rem] w-[.5rem] bg-gray-300 rounded-full"></div>
            <p class="text-xs sm:text-[0.9rem] text-gray-600">{{ $post->views }} vues</p>
        </div>
        <div class="h-[400px] overflow-hidden rounded-lg mb-6">
            <img src="{{ asset($post->cover_image ?? 'assets/images/brand/photo.png') }}"
                class="w-full h-full object-contain" alt="">
        </div>
        <div class="block md:flex gap-4">
            <div class="w-full md:w-2/3">
                <p class="text-sm sm:text-[1rem] leading-7">{{ $post->content }}</p>
            </div>
            <div class="w-full md:flex-1 mt-4 md:mt-0">
                <p class="text-sm sm:text-[1rem] mb-2">
                    <span class="text-sm sm:text-[1rem] font-semibold">Date de publication :
                    </span>{{ \Carbon\Carbon::parse($post->created_at)->locale('fr')->translatedFormat('d M Y') }}
                </p>

                @php
                    $tags = json_decode($post->tags);
                @endphp

                @if (is_array($tags) && count($tags) > 0)
                    <ul>
                        @foreach ($tags as $item)
                            <li>#{{ $item }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </section>
@endsection
