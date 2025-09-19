@extends('layouts.main')

@section('title', 'Contact')

@section('content')
    @include('components.widgets.breadcrumb')

    <section class="container px-[1rem] md:px-[0px] lg:px-[3rem] mx-auto py-[2.5rem] md:py-[5rem]">
        <div class="flex justify-center">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-[10rem]">
                <div class="space-y-4 flex flex-col items-center">
                    <div class="h-[5rem] w-[5rem] rounded-full flex justify-center items-center bg-[#fff1e7]">
                        <span class="mdi mdi-email text-[#f2722b] text-[3rem] font-bold"></span>
                    </div>
                    <div class="space-y-2 text-sm sm:text-[1rem] text-center">
                        <p class="font-semibold">Email</p>
                        <p>{{ $appBasics->email }}</p>
                    </div>
                </div>

                <div class="space-y-4 flex flex-col items-center">
                    <div class="h-[5rem] w-[5rem] rounded-full flex justify-center items-center bg-[#fff1e7]">
                        <span class="mdi mdi-phone text-[#f2722b] text-[3rem] font-bold"></span>
                    </div>
                    <div class="space-y-2 text-sm sm:text-[1rem] text-center">
                        <p class="font-semibold">Téléphone</p>
                        <p>{{ $appBasics->contact }}</p>
                    </div>
                </div>

                <div class="space-y-4 flex flex-col items-center">
                    <div class="h-[5rem] w-[5rem] rounded-full flex justify-center items-center bg-[#fff1e7]">
                        <span class="mdi mdi-map-marker text-[#f2722b] text-[3rem] font-bold"></span>
                    </div>
                    <div class="space-y-2 text-sm sm:text-[1rem] text-center">
                        <p class="font-semibold">Adresse</p>
                        <p>Cotonou, Bénin</p>
                        {{-- <p>Abidjan, Côte d'Ivoire</p> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container mx-auto mb-[2.5rem] md:mb-[5rem]">
        <div class=" block md:flex items-center gap-8">
            <div class="w-full md:w-1/2 p-6 rounded-xl border border-dashed border-gray-200">
                <h2 class="text-sm sm:text-[1rem] font-semibold mb-4">Envoyez-nous un message</h2>
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div class="flex flex-col space-y-1">
                        <label for="email">Email</label>
                        <input type="email" id="email" placeholder="Veuillez entrer votre email" name="email"
                            value="{{ old('email') }}"
                            class="rounded-md border border-gray-200 focus:outline-none border-1 py-2 px-4 outline-none w-full">
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label for="subject">Objet</label>
                        <input type="text" id="subject" placeholder="Veuillez entrer l'objet" name="subject"
                            value="{{ old('subject') }}"
                            class="rounded-md border border-gray-200 focus:outline-none border-1 py-2 px-4 outline-none w-full">
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label for="message">Message</label>
                        <textarea id="message" placeholder="Veuillez entrer votre message" name="message" rows="4"
                            class="rounded-md border border-gray-200 focus:outline-none border-1 py-2 px-4 outline-none w-full"></textarea>
                    </div>
                    <div class="flex justify-start mt-4">
                        <button type="submit" class="px-4 py-2 btn-custom">Envoyer</button>
                    </div>
                </form>

            </div>
            <div class="w-full h-[400px] md:w-1/2 mt-6 md:mt-0">
                <div id="map" style="height:100%; width:100%; border-radius:20px"></div>
            </div>
        </div>
    </section>
@endsection
