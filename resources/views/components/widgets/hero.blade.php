<section>
    <div style="background:url('{{ asset($banner->background_image ?? 'assets/images/brand/machine3.jpg') }}') center; background-repeat: no-repeat; background-size: cover;"
        class="h-[550px] max-h-auto relative hidden md:block">
        <div class="h-full w-full bg-black opacity-80"></div>

        <div class="absolute inset-y-0 left-0 w-full flex items-center">
            <div class="container px-[1rem] md:px-[0px] lg:px-[3rem] mx-auto">
                <div class="w-full md:w-1/2 text-white text-lg md:text-xl text-center md:text-start">
                    <h1 class="text-xl md:text-2xl font-bold mb-[1rem] uppercase">{{ $banner->title }}</h1>
                </div>
            </div>
        </div>

        <div id="banner-carousel-web"
            class="hidden md:block absolute w-[250px] md:w-[450px] lg:w-1/2 h-[300px] sm:h-[450px] rounded-tl-[20%] overflow-hidden bottom-0 right-0">
            @foreach ($bannerCarrousel as $item)
                <img src="{{ asset($item->image ?? 'assets/images/brand/photo.png') }}"
                    class="w-full h-full object-cover" alt="Carrousel">
            @endforeach
        </div>
    </div>
    <div id="banner-carousel-mobile" class="relative block md:hidden">
        @foreach ($bannerCarrousel as $item)
            <div>
                <div class="w-full h-[250px]">
                    <img src="{{ asset($item->image ?? 'assets/images/brand/photo.png') }}"
                        class="w-full h-full object-cover" alt="Carrousel">
                </div>
                <div class="p-5 bg-[#263135] h-[200px] flex flex-col justify-center">
                    <p class="text-lg md:text-2xl font-bold mb-[1rem] text-white">{{ $item->title }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>
