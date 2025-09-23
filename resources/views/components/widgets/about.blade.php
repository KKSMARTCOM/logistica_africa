<section class="mb-[2.5rem] md:mb-[5rem] bg-[#f8f9fb]">
    <div class="container px-[1rem] md:px-[0px] lg:px-[3rem] mx-auto py-[2.5rem] space-y-4 md:space-y-6">
        @include('components.widgets.title', ['title' => 'A propos de nous'])

        <div class="block md:flex gap-[2rem] items-center">
            <div class="w-full md:w-1/2 wow fadInUp reveal revealleft">
                <div class="w-full overflow-hidden rounded-xl">
                    <img src="{{ asset($about->about_image ?? 'assets/images/brand/photo.png') }}"
                        class="w-full h-full object-cover" alt="About">
                </div>
            </div>
            <div class="w-full md:w-1/2 mt-4 md:mt-0 space-y-6 wow fadInUp">
                <p class="text-sm sm:text-[1rem] leading-7">{{ $about->about_text }}</p>
                <div class="flex">
                    <a href="{{ route('view.about') }}" class="btn-custom px-4 py-2">Lire plus</a>
                </div>
            </div>
        </div>
    </div>
</section>
