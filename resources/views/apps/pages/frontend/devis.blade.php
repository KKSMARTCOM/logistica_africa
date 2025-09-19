@extends('layouts.main')

@section('title', 'Demande de devis')

@section('content')
    @include('components.widgets.breadcrumb')


    <section class="container px-[1rem] md:px-[0px] lg:px-[3rem] mx-auto py-[2.5rem] md:py-[5rem]">
        <div class="border rounded-md p-5">
            <!-- Onglets -->
            <div class="flex justify-center mb-6 space-x-4">
                <button id="show-recap"
                    class="switcher-btn px-4 py-2 rounded-md text-sm font-semibold {{ $cart && count($cart) > 0 ? 'bg-primary text-[#f2722b] border border-[#f2722b]' : 'bg-gray-200 text-gray-700' }}">
                    Récapitulatif
                </button>
                <button id="show-form"
                    class="switcher-btn px-4 py-2 rounded-md text-sm font-semibold {{ $cart && count($cart) > 0 ? 'bg-gray-200 text-gray-700' : 'bg-primary text-[#f2722b] border border-[#f2722b]' }}">
                    Formulaire
                </button>
            </div>

            <div class="{{ $cart && count($cart) > 0 ? '' : 'hidden' }}" id="recap-section">
                <h2 class="text-sm sm:text-[1rem] text-center font-semibold mb-6">Récapitulatif</h2>
                @if ($cart && count($cart) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @foreach ($cart as $item)
                            <div class="flex items-center gap-4 bg-white border border-gray-200 rounded-lg shadow-sm p-4">
                                <div class="w-32 h-32 rounded-lg overflow-hidden">
                                    <img src="{{ asset('storage/' . $item['product']['image'] ?? 'assets/images/brand/photo.png') }}"
                                        alt="{{ $item['product']['name'] }}" class="w-full h-full object-cover ">
                                </div>
                                <div class="flex-1 block lg:flex gap-4 items-center">
                                    <div>
                                        <h3 class="text-lg text-gray-800">
                                            {{ strlen($item['product']['name'] ?? '') > 30 ? substr($item['product']['name'], 0, 30) . '...' : $item['product']['name'] ?? 'N/A' }}
                                        </h3>
                                        <span
                                            class="text-lg font-semibold text-nowrap text-gray-900 mr-4">{{ $item['total'] }}
                                            F CFA /Jours</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <form action="{{ route('cart.decrease') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id"
                                                    value="{{ $item['product']['id'] }}">
                                                <button
                                                    class="text-gray-600 hover:text-gray-800 focus:outline-none mr-4 font-semibold text-lg">-</button>
                                            </form>

                                            <span class="text-gray-700 w-[15px]">
                                                <input class="outline-none w-full" type="text"
                                                    value="{{ $item['qty'] }}">
                                            </span>

                                            <form action="{{ route('cart.increase') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id"
                                                    value="{{ $item['product']['id'] }}">
                                                <button
                                                    class="text-gray-600 hover:text-gray-800 focus:outline-none font-semibold ml-4 text-lg">+</button>
                                            </form>
                                        </div>
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $item['product']['id'] }}">
                                            <button class="text-red-600 hover:text-red-800 focus:outline-none ml-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em"
                                                    viewBox="0 0 24 24">
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="1.5"
                                                        d="M4.687 6.213L6.8 18.976a2.5 2.5 0 0 0 2.466 2.092h3.348m6.698-14.855L17.2 18.976a2.5 2.5 0 0 1-2.466 2.092h-3.348m-1.364-9.952v5.049m3.956-5.049v5.049M2.75 6.213h18.5m-6.473 0v-1.78a1.5 1.5 0 0 0-1.5-1.5h-2.554a1.5 1.5 0 0 0-1.5 1.5v1.78z" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <h1 class="text-center text-sm sm:text-[1rem]">Pas de machine selectionnée. Vous pouvez choisir une
                        machine
                        pour une demande de devis <a class="text-blue-700 hover:underline"
                            href="{{ route('view.catalog') }}">ici</a> </h1>
                @endif

                <div class="mt-6 flex justify-center">
                    <button id="next-step" class="px-6 py-2 btn-custom">Continuer</button>
                </div>
            </div>
            <div class="{{ $cart && count($cart) > 0 ? 'hidden' : '' }}" id="form-section">
                <h2 class="text-sm sm:text-[1rem] text-center font-semibold mb-2">Informations</h2>
                <p class="text-center mb-6">Pour demander un devis veuillez svp nous donner quelques détails</p>
                <form action="{{ route('cart.save') }}" method="POST" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Nom entreprise -->
                        <div class="flex flex-col space-y-1">
                            <label for="company_name">Nom de l'entreprise <span class="text-red-500">*</span></label>
                            <input type="text" id="company_name" name="company_name" placeholder="Ex : Société ABC"
                                value="{{ old('company_name') }}"
                                class="rounded-md border border-gray-200 py-2 px-4 w-full focus:outline-none">
                        </div>

                        <!-- Représentant -->
                        <div class="flex flex-col space-y-1">
                            <label for="representative_name">Nom du représentant <span class="text-red-500">*</span></label>
                            <input type="text" id="representative_name" name="representative_name"
                                placeholder="Ex : Jean Dupont" value="{{ old('representative_name') }}"
                                class="rounded-md border border-gray-200 py-2 px-4 w-full focus:outline-none">
                        </div>

                        <!-- Lieu d'utilisation -->
                        <div class="flex flex-col space-y-1">
                            <label for="usage_location">Lieu d'utilisation <span class="text-red-500">*</span></label>
                            <input type="text" id="usage_location" name="usage_location"
                                placeholder="Ex : Chantier Cotonou" value="{{ old('usage_location') }}"
                                class="rounded-md border border-gray-200 py-2 px-4 w-full focus:outline-none">
                        </div>

                        <!-- Durée en jours -->
                        <div class="flex flex-col space-y-1">
                            <label for="usage_duration">Durée de location (en jours) <span
                                    class="text-red-500">*</span></label>
                            <input type="number" id="usage_duration" name="usage_duration" placeholder="Ex : 14"
                                value="{{ old('usage_duration') }}" min="1"
                                class="rounded-md border border-gray-200 py-2 px-4 w-full focus:outline-none"
                                oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                        </div>

                        <!-- Email -->
                        <div class="flex flex-col space-y-1">
                            <label for="email">Adresse email</label>
                            <input type="email" id="email" name="email" placeholder="exemple@mail.com"
                                value="{{ old('email') }}"
                                class="rounded-md border border-gray-200 py-2 px-4 w-full focus:outline-none">
                        </div>

                        <!-- Contact GSM -->
                        <div class="flex flex-col space-y-1">
                            <label for="gsm_number">Contact GSM ou WhatsApp <span class="text-red-500">*</span></label>
                            <input type="tel" id="gsm_number" placeholder="0161000000"
                                value="{{ old('gsm_number_display') }}"
                                class="phone-input rounded-md border border-gray-200 py-2 w-full focus:outline-none">
                            <!-- Champ caché pour envoyer la valeur complète -->
                            <input type="hidden" name="gsm_number" id="gsm_number_full">
                        </div>

                        <!-- Date mobilisation -->
                        <div class="flex flex-col space-y-1">
                            <label for="mobilization_date">Date de mobilisation souhaitée</label>
                            <input type="date" id="mobilization_date" name="mobilization_date"
                                value="{{ old('mobilization_date') }}"
                                class="rounded-md border border-gray-200 py-2 px-4 w-full focus:outline-none">
                        </div>
                    </div>

                    <!-- Autres détails -->
                    <div class="flex flex-col space-y-1">
                        <label for="additional_details">Autres détails</label>
                        <textarea id="additional_details" name="additional_details" rows="4"
                            placeholder="Ajoutez ici toutes précisions utiles..."
                            class="rounded-md border border-gray-200 py-2 px-4 w-full focus:outline-none"></textarea>
                    </div>

                    <!-- Bouton -->
                    <div class="flex justify-start mt-4">
                        <button type="submit" class="px-4 py-2 btn-custom">Envoyer</button>
                    </div>
                </form>
                <p class="text-sm sm:text-[1rem] mt-6"> <span class="font-semibold underline">NB:</span> Nos cotations ne
                    prennent pas en compte le gasoil et le perdiem du conducteur de l'engin.</p>
            </div>
        </div>
    </section>

@endsection
