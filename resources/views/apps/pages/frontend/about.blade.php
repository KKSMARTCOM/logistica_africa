@extends('layouts.main')

@section('title', 'A propos')

@section('content')
    @include('components.widgets.breadcrumb')

    <section class="container mx-auto py-[2.5rem] md:py-[5rem]">
        <div class="block md:flex items-center">
            <div class="w-full md:w-1/2 flex justify-center reveal revealleft">
                <div class="w-full md:w-[80%] h-[300px] overflow-hidden rounded-xl">
                    <img src="{{ asset($about->mission_image ?? 'assets/images/brand/photo.png') }}"
                        class="w-full h-full object-contain" alt="Image">
                </div>
            </div>
            <div class="space-y-4 w-full md:w-1/2 mt-[2rem] md:mt-0">
                <h1 class="text-lg md:text-xl font-semibold text-[#f2722b]">Mission</h1>
                <p class="text-sm sm:text-[1rem] leading-7">{{ $about->mission_text }}
                </p>
            </div>
        </div>
    </section>
    <section class="mb-[2.5rem] md:mb-[5rem] bg-[#f8f9fb]">
        <div class="container mx-auto py-[2.5rem] space-y-4 md:space-y-6">
            @include('components.widgets.title', ['title' => 'Nos valeurs'])

            <div class="flex justify-center">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                    @foreach ($values as $item)
                        <div
                            class="space-y-4 flex flex-col items-center p-4 rounded-md border border-transparent hover:border-gray-200">
                            <div class="w-[8rem] h-[8rem] overflow-hidden rounded-full bg-white p-2">
                                <img src="{{ asset($item->image ?? 'assets/images/brand/photo.png') }}"
                                    class="w-full h-full object-cover rounded-full " alt="Icon">
                            </div>
                            <div class="text-sm sm:text-[1rem] space-y-2 leading-7">
                                <h2 class="font-semibold text-center uppercase">{{ $item->title }}</h2>
                                <p class="text-left md:text-center">{{ $item->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    @include('components.widgets.testimonial')
@endsection
