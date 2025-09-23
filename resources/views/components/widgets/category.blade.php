<section class="container px-[1rem] md:px-[0px] lg:px-[3rem] mx-auto my-[2.5rem] md:my-[5rem]">
    <div class="grid grid-cols-1 md:grid-cols-2">
        @foreach ($categories as $item)
            <div style="background:url('{{ asset($item->image ?? 'assets/images/brand/machine2.jpg') }}') center; background-repeat: no-repeat; background-size: cover;"
                class="h-[300px] relative">
                <div class="h-full w-full bg-black opacity-80"></div>

                <div class="absolute top-0 left-0 w-full flex items-center p-5">
                    <div class="space-y-4 text-white text-sm sm:text-[1rem]">
                        <p class="uppercase font-semibold">{{ $item->description }}</p>
                        <div class="flex">
                            <a href="{{ route('view.catalog', ['category' => $item->id]) }}"
                                class="btn-custom px-4 py-2">Découvrir</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
