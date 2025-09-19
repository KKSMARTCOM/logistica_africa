<section id="services"
    class="container px-[1rem] md:px-[0px] lg:px-[3rem] mx-auto pb-[2.5rem] md:pb-[5rem] space-y-4 md:space-y-6">
    @include('components.widgets.title', ['title' => 'Nos services'])

    <div class="text-sm sm:text-[1rem] w-full leading-6">
        <h2 class="font-semibold mb-2 md:mb-4">La force logistique au service de vos chantiers</h2>
        <p class="max-w-4xl w-full">Solutions de transport, levage et location d’engins pour construire les projets
            d’aujourd’hui
            et relever les défis de demain.
        </p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        {{-- <div
            class="flex flex-col items-center text-sm sm:text-[1rem] p-[0.5rem] text-center space-y-2 md:space-y-4 rounded-xl bg-[#f8f9fb]">
            <div class="w-[6rem] h-[4rem]">
                <img src="{{ asset('assets/images/svgs/Logistics-cuate.svg') }}" class="w-full h-full object-contain"
                    alt="">
            </div>
            <h2 class="font-semibold">Location d'engins et d'équipements</h2>
            <p>Nous mettons à votre disposition une flotte d'engins robustes, contrôlés et immédiatement opérationnels
                pour répondre à tous vos besoins : terrassement, nivellement, levage, transport… Profitez de matériels
                fiables et d'un accompagnement réactif pour sécuriser vos chantiers.
            </p>
        </div> --}}
        @foreach ($services as $item)
            <div class="relative h-[350px] rounded-lg shadow-lg overflow-hidden group reveal">

                <!-- Image de fond + filtre noir -->
                <div class="absolute inset-0 bg-cover bg-center"
                    style="background-image: url('{{ asset('storage/' . $item->image ?? 'assets/images/brand/photo.png') }}');">
                    <div class="absolute inset-0 bg-black/50"></div>
                </div>

                <!-- Titre (visible par défaut) -->
                <div
                    class="absolute bg-white bottom-0 inset-x-0 z-10 flex items-center justify-center text-center py-6 transition-opacity duration-500 ease-in-out group-hover:opacity-0">
                    <h2 class="text-sm sm:text-[1rem] font-semibold">{{ $item->title }}</h2>
                </div>

                <!-- Contenu animé depuis le bas au hover -->
                <div
                    class="absolute inset-0 z-20 bg-white p-6 text-center transform translate-y-full group-hover:translate-y-0 transition-all duration-500 ease-[cubic-bezier(.17,.67,.5,1.03)] flex flex-col justify-center items-center">
                    <h2 class="text-sm sm:text-[1rem] font-semibold mb-4">{{ $item->title }}</h2>
                    <p class="text-sm sm:text-[1rem] leading-7">
                        {{ $item->description }}
                    </p>
                </div>

            </div>
        @endforeach
    </div>
</section>
