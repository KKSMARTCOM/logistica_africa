<section id="clients"
    class="container px-[1rem] md:px-[0px] lg:px-[3rem] mx-auto mb-[2.5rem] md:mb-[5rem] space-y-4 md:space-y-6">
    <div class="flex items-center justify-between">
        @include('components.widgets.title', ['title' => 'Avis client'])

        <!-- Arrows container -->
        <div id="testimonial-arrows" class="slick-arrows flex gap-2">
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

    <div id="testimonial-caroussel" class="h-[160px]">
        @foreach ($testimonials as $item)
            <div class="space-y-4 p-4 text-sm sm:text-[1rem] bg-gray-200 rounded-md mx-4">
                <div class="flex items-center gap-4">
                    <div class="w-[4rem] h-[4rem] overflow-hidden rounded-full">
                        <img src="{{ asset($item->image ?? 'assets/images/brand/photo.png') }}"
                            class="w-full h-full object-cover" alt="Avatar">
                    </div>
                    <h2 class="font-semibold">{{ $item->name }}</h2>
                </div>
                <p>{{ $item->description }}</p>
            </div>
        @endforeach
    </div>
</section>
