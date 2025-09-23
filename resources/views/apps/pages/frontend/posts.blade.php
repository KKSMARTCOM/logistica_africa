@extends('layouts.main')

@section('title', 'Actualités')

@section('content')
    @include('components.widgets.breadcrumb')

    <section class="container px-[1rem] md:px-[0px] lg:px-[3rem] mx-auto py-[2.5rem] md:py-[5rem]">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach ($posts as $item)
                <div class="space-y-4 rounded-xl hover:shadow-md transition-all ease-in-out duration-300">
                    <a href="{{ route('view.post', $item->id) }}"
                        class="h-[200px] block cursor-pointer w-full overflow-hidden rounded-xl">
                        <img src="{{ asset($item->cover_image ?? 'assets/images/brand/photo.png') }}"
                            class="w-full h-full object-cover" alt="Post Image">
                    </a>
                    <div class="p-4 space-y-2">
                        <p class="text-xs sm:text-[0.9rem] text-end text-gray-600">
                            {{ \Carbon\Carbon::parse($item->created_at)->locale('fr')->translatedFormat('d M Y') }}</p>

                        <a href="{{ route('view.post', $item->id) }}" class="block">
                            <h2 class="text-sm sm:text-[1rem] font-semibold">{{ $item->title }}</h2>
                        </a>
                        <p class="text-sm sm:text-[1rem] text-gray-600">
                            {!! Str::limit($item->content, 125, '...') !!}
                        </p>
                        <a href="{{ route('view.post', $item->id) }}"
                            class="hover:text-[#f2722b] hover:underline block">Lire
                            plus</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

@endsection
