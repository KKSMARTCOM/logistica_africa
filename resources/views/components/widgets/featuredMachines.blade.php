<section class="container px-[1rem] md:px-[0px] lg:px-[3rem] mx-auto pb-[2.5rem] md:pb-[5rem] space-y-4 md:space-y-6">
    <div class="flex items-center justify-between">
        @include('components.widgets.title', ['title' => 'Machines en vedette'])

        <a href="{{ route('view.catalog') }}" class="btn-custom px-4 py-2 text-nowrap">Voir plus</a>
    </div>
    <div class="flex justify-end">
        <!-- Arrows container -->
        <div id="featured-arrows" class="slick-arrows flex gap-2">
            <button
                class="slick-prev bg-white border border-[#f2722b]  w-[2rem] h-[2rem] flex justify-center items-center shadow rounded-full p-2 hover:bg-gray-100">
                <span class="mdi mdi-chevron-double-left text-[#f2722b]"></span>
            </button>
            <button
                class="slick-next bg-white border border-[#f2722b]  w-[2rem] h-[2rem] flex justify-center items-center shadow rounded-full p-2 hover:bg-gray-100">
                <span class="mdi mdi-chevron-double-right text-[#f2722b]"></span>
            </button>
        </div>
    </div>
    <div id="featured-machine-carousel" class="h-[360px]">
        @foreach ($machines as $item)
            <div
                class="space-y-4 mx-4 h-[350px] rounded-xl overflow-hidden cursor-pointer hover:shadow-lg transition-shadow duration-300">
                <div class="h-[250px] overflow-hidden">
                    <img src="{{ asset('storage/' . $item->image ?? 'assets/images/brand/photo.png') }}"
                        class="w-full h-full object-cover" alt="">
                </div>
                <div class="text-sm sm:text-[1rem] space-y-2 px-2 py-4 rounded-b-xl">
                    <h1 class="font-semibold">{{ $item->name }}</h1>
                    <a href="{{ route('view.detail', $item->id) }}"
                        class="hover:underline hover:text-[#f2722b] block">Voir le materiel</a>
                </div>
            </div>
        @endforeach
    </div>
</section>
