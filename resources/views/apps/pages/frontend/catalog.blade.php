@extends('layouts.main')

@section('title', 'Catalogue')

@section('content')
    @include('components.widgets.breadcrumb')

    <section class="container px-[1rem] md:px-[0px] lg:px-[3rem] mx-auto py-[2.5rem] md:py-[5rem]">
        <div class="block md:flex justify-end mb-[2rem]">
            <div class="flex items-center gap-4 text-sm sm:text-[1rem] leading-7">
                <label class="mb-0 font-semibold">Catégories</label>
                <div id="custom-category-select" class="relative w-64 text-sm">
                    <!-- Sélection affichée -->
                    <div
                        class="selected bg-white border border-gray-300 rounded-md py-2 px-3 cursor-pointer flex justify-between items-center">
                        <span id="selected-category-text" class="line-clamp-1">Sélectionner une catégorie</span>
                        <span class="text-gray-500">▼</span>
                    </div>

                    <!-- Liste des options -->
                    <ul
                        class="options absolute left-0 right-0 bg-white border border-gray-300 rounded-md mt-1 hidden max-h-60 overflow-y-auto z-10">
                        <li class="px-3 py-2 hover:bg-gray-100 cursor-pointer " data-value="">Sélectionner une
                            catégorie
                        </li>
                        @foreach ($categories as $category)
                            <li class="px-3 py-2 hover:bg-gray-100 cursor-pointer" data-value="{{ $category->id }}">
                                {{ $category->name }}
                            </li>
                        @endforeach
                    </ul>

                    <!-- Le vrai select caché pour le formulaire -->
                    <select id="category-filter" name="category" class="hidden">
                        <option value="">Sélectionner une catégorie</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="flex flex-col items-center">
            @if ($machines && $machines->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    @foreach ($machines as $item)
                        <a href="{{ route('view.detail', $item->id) }}"
                            class="block p-2 relative space-y-4 rounded-xl hover:shadow-lg transition-all ease-in-out duration-300 cursor-pointer">
                            <div class="h-[200px] w-full overflow-hidden rounded-xl">
                                <img src="{{ asset($item->image ?? 'assets/images/brand/photo.png') }}"
                                    class="w-full h-full object-cover" alt="">
                            </div>
                            <div class="bg-white p-4 space-y-2">
                                <h2 class="text-sm sm:text-[1rem] font-semibold">{{ $item->name }}</h2>
                                <p class="text-xs sm:text-[0.9rem] text-gray-600">Model & puissance: <span
                                        class="font-semibold">{{ $item->model }}</span>
                                </p>
                                {{-- <p class="text-xs sm:text-[0.9rem] text-gray-600">Prix de location/jour: <span
                                        class="font-semibold">{{ $item->price }}
                                        FCFA</span></p> --}}
                                <p class=" hover:text-[#f2722b] hover:underline">En savoir plus</p>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-[2rem] w-full">
                    {{ $machines->links('pagination::tailwind') }}
                </div>
            @else
                <div class="w-full flex flex-col items-center">
                    @include('components.no-data')
                    <h2 class="text-[1rem] md:text-[1.125rem] lg:text-[1.25rem] mt-[1rem]">Pas de données pour le moment
                    </h2>
                </div>
            @endif
        </div>
    </section>

    @include('components.widgets.testimonial')
@endsection
