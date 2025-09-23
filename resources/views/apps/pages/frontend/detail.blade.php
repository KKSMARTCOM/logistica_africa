@extends('layouts.main')

@section('title', 'Details d\'un engin')

@section('content')
    @include('components.widgets.breadcrumb')

    <section class="container px-[1rem] md:px-[0px] lg:px-[3rem] mx-auto py-[2.5rem] md:py-[5rem]">
        <div class="block md:flex gap-6">
            <div class="w-full md:flex-1 mb-6 md:mt-0 block md:hidden">
                <div class="h-[400px] rounded-lg overflow-hidden mb-4">
                    <img src="{{ asset($machine->image ?? 'assets/images/brand/photo.png') }}" alt="{{ $machine->name }}"
                        class="w-full h-ful object-cover">
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <div class="border p-1">
                        <img src="{{ asset($machine->image ?? 'assets/images/brand/photo.png') }}"
                            alt="{{ $machine->name }}" class="w-full h-ful object-cover">
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/2 space-y-6">
                <h2 class="text-lg sm:text-[1.5rem] leading-7 font-semibold">{{ $machine->name }}</h2>
                <div class="text-sm sm:text-[1rem] leading-7 space-y-2">
                    <h2 class="font-semibold">Informations générales</h2>

                    @if ($machine->characteristics && count(json_decode($machine->characteristics)) > 0)
                        @foreach (json_decode($machine->characteristics) as $char)
                            <div class="flex items-center py-2 bg-gray-50 px-2 rounded-sm justify-between">
                                <p>{{ $char->label }}</p>
                                <p>{{ $char->value }}</p>
                            </div>
                        @endforeach
                    @else
                        <p>Pas d'informations</p>
                    @endif
                </div>
                <div class="text-sm sm:text-[1rem] leading-7 border-b border-gray-200 space-y-2">
                    {{-- Add product in cart --}}
                    <form action="{{ route('cart.add') }}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $machine->id }}">
                        <button type="submit" class=" btn-custom">Demander un devis
                        </button>
                    </form>
                </div>
                <div class="text-sm sm:text-[1rem] leading-7 space-y-2">
                    <h2 class="font-semibold">Description</h2>
                    <p>{{ $machine->description }}</p>
                </div>
            </div>
            <div class="w-full md:flex-1 hidden md:block">
                <div class="h-[400px] rounded-lg overflow-hidden mb-4">
                    <img src="{{ asset($machine->image ?? 'assets/images/brand/photo.png') }}" alt="{{ $machine->name }}"
                        class="w-full h-ful object-cover">
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <div class="border p-1">
                        <img src="{{ asset($machine->image ?? 'assets/images/brand/photo.png') }}"
                            alt="{{ $machine->name }}" class="w-full h-ful object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
