<section class="bg-[#f8f9fb] py-[2.5rem] md:py-[5rem] space-y-4 md:space-y-6">
    <div class="container px-[1rem] md:px-[0px] lg:px-[3rem] mx-auto flex items-center justify-between">
        @include('components.widgets.title', ['title' => 'Ils nous font confiance'])

        <!-- Arrows container -->
        <div id="partner-arrows" class="slick-arrows flex gap-2">
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

    <div class="py-5">
        @if ($partners)
            <div id="partner-carroussel" class="container mx-auto flex justify-center h-[50px] gap-2">
                @foreach ($partners as $item)
                    <img src="{{ asset($item->image ?? 'assets/images/brand/photo.png') }}"
                        class="mx-4 w-16 object-contain" alt="Partner Logo">
                @endforeach
            </div>
        @endif
    </div>
</section>
