<!-- app-Header -->
<div class=" bg-gray-200 py-4 w-full">
    <div
        class="container px-[1rem] md:px-[0px] lg:px-[3rem] w-full h-full mx-auto flex items-center justify-between gap-4">
        <a href="{{ route('view.home') }}" class="w-[6rem] md:w-[8rem] h-[4rem] -mb-[1rem] hidden md:block">
            <img src="{{ asset('assets/images/brand/logo.png') }}" alt="Logo" class="w-full h-full object-contain ">
        </a>

        <div class="block md:hidden">
            <span id="openSidebar" class="mdi mdi-menu text-3xl text-[#333333] cursor-pointer"></span>
        </div>

        <a href="{{ route('view.home') }}" class="w-[10rem] md:w-[8rem] -mb-[.5rem] block md:hidden">
            <img src="{{ asset('assets/images/brand/logo-compact-noir.png') }}" alt="Logo"
                class="w-full h-full object-contain transition ease-out duration-300">
        </a>

        <div class="w-full md:flex justify-start md:w-1/3 hidden">
            <div class="relative w-full">
                <form action="{{ route('view.catalog') }}" method="GET">
                    @csrf
                    <input value="{{ request('search') }}" name="search"
                        class="rounded-2xl border-gray-200 focus:outline-none border py-3 px-6 outline-none w-full shadow-xl"
                        type="text" placeholder="Rechercher un materiel...">
                    <button onclick="this.form.submit()"
                        class="absolute left-2 z-30 inset-y-0 flex items-center pr-2 cursor-pointer">
                        <span class="mdi mdi-magnify text-xl text-[#f2722b]"></span>
                    </button>
                </form>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <a target="_blank" href="https://web.facebook.com/logisticaafrica" class="hover:text-[#f2722b]">
                <span class="text-xl mdi mdi-facebook"></span>
            </a>

            <a target="_blank" href="https://www.linkedin.com/company/logisticafrica/" class="hover:text-[#f2722b]">
                <span class="text-xl mdi mdi-linkedin"></span>
            </a>

            <a target="_blank" href="https://www.tiktok.com/@logistica.africa?_t=ZM-8z0mDhRr2Cj&_r=1"
                class="hover:text-[#f2722b] w-[20px]">
                <img src="https://img.icons8.com/?size=100&id=soupkpLfTkZi&format=png&color=000000"
                    class=" hover:text-[#f2722b]" alt="">
            </a>
        </div>
    </div>

    <div class="w-full flex md:hidden justify-center mt-2">
        <div class="relative max-w-xl">
            <form action="{{ route('view.catalog') }}" method="GET">
                @csrf
                <input value="{{ request('search') }}" name="search"
                    class="rounded-2xl border-gray-200 focus:outline-none border py-3 px-6 outline-none w-full shadow-xl"
                    type="text" placeholder="Rechercher un materiel...">
                <button onclick="this.form.submit()"
                    class="absolute left-2 z-30 inset-y-0 flex items-center pr-2 cursor-pointer">
                    <span class="mdi mdi-magnify text-xl text-[#f2722b]"></span>
                </button>
            </form>
        </div>
    </div>
</div>
<div id="navbar"
    class="h-18 absolute py-[0.5rem] left-0 right-0 backdrop-blur-sm z-50 md:flex items-center shadow-sm hidden">
    <div class="container px-[.5rem] md:px-[0px] lg:px-[3rem] mx-auto flex items-center justify-between">
        <div class="w-[6rem] md:w-[8rem] h-[4rem] -mb-[1rem] block md:hidden">
            <img src="{{ asset('assets/images/brand/logo-blanc.png') }}" alt="Logo"
                class="w-full h-full object-contain transition ease-out duration-300 logo1">
            <img src="{{ asset('assets/images/brand/logo.png') }}" alt="Logo"
                class="w-full h-full object-contain hidden transition ease-out duration-300 logo2">
        </div>
        <ul id="menu-list" class=" md:flex items-center gap-8 text-[#ffffff] uppercase">
            <li>
                <a href="{{ route('view.home') }}"
                    class="hover:text-[#f2722b] transition-all ease-in-out duration-300 {{ Request::is('/') ? 'font-medium text-[#f2722b]' : '' }}">Accueil</a>
            </li>
            <li>
                <a href="{{ route('view.about') }}"
                    class="hover:text-[#f2722b] transition-all ease-in-out duration-300 {{ Request::is('about') ? 'font-medium text-[#f2722b]' : '' }}">A
                    propos</a>
            </li>
            <li>
                <a href="{{ route('view.catalog') }}"
                    class="hover:text-[#f2722b] transition-all ease-in-out duration-300 {{ Request::is('catalog') || Request::is('detail*') || Request::is('devis*') || Request::is('congrats*') || Request::is('search*') ? 'font-medium text-[#f2722b]' : '' }}">Catalogue</a>
            </li>
            <li>
                <a href="{{ route('view.posts') }}"
                    class="hover:text-[#f2722b] transition-all ease-in-out duration-300 {{ Request::is('posts') || Request::is('post*') ? 'font-medium text-[#f2722b]' : '' }}">Actualités</a>
            </li>
            <li>
                <a href="{{ route('view.contact') }}"
                    class="hover:text-[#f2722b] transition-all ease-in-out duration-300 {{ Request::is('contact') ? 'font-medium text-[#f2722b]' : '' }}">Contacts</a>
            </li>
        </ul>
        <div class="flex items-center gap-3">
            <a href="{{ route('view.devis') }}" class="hidden sm:flex items-center btn-custom">Devis
                <span class="mdi mdi-calculator text-lg"></span></a>
        </div>
    </div>
</div>
<!-- /app-Header -->

{{-- app-Sidebar --}}
<div class="fixed top-0 left-0 w-full h-screen z-[9999] transition duration-300 ease-in-out hidden sidebar-container">
    <div class="w-full h-full backdrop-blur-sm sidebar-overlay"></div>
    <div class="absolute top-0 right-0 w-[250px] md:w-[300px] h-full bg-white p-[2rem]">
        <div class="flex flex-col gap-[2rem]">
            <div class="flex justify-end">
                <a href="javascript:void();" id="closeSidebar" class="hover:text-[#000000]">
                    <i class="mdi mdi-close text-2xl font-medium"></i>
                </a>
            </div>

            <ul class="flex flex-col gap-[1.5rem]">
                <li>
                    <a class="text-[1rem]  hover:text-[#f2722b] transition-all ease-in-out duration-300 {{ Request::is('/') ? 'font-medium text-[#f2722b]' : '' }}"
                        href="{{ route('view.home') }}">Accueil</a>
                </li>
                <li>
                    <a class="text-[1rem]  hover:text-[#f2722b] transition-all ease-in-out duration-300 {{ Request::is('about') ? 'font-medium text-[#f2722b]' : '' }}"
                        href="{{ route('view.about') }}">A propos</a>
                </li>
                <li>
                    <a class="text-[1rem]  hover:text-[#f2722b] transition-all ease-in-out duration-300 {{ Request::is('catalog') || Request::is('detail*') || Request::is('devis*') || Request::is('congrats*') || Request::is('search*') ? 'font-medium text-[#f2722b]' : '' }}"
                        href="{{ route('view.catalog') }}">Catalogue</a>
                </li>
                <li>
                    <a class="text-[1rem]  hover:text-[#f2722b] transition-all ease-in-out duration-300 {{ Request::is('posts') || Request::is('post*') ? 'font-medium text-[#f2722b]' : '' }}"
                        href="{{ route('view.posts') }}">Actualités</a>
                </li>
                <li>
                    <a class="text-[1rem]  hover:text-[#f2722b] transition-all ease-in-out duration-300 {{ Request::is('contact') ? 'font-medium text-[#f2722b]' : '' }}"
                        href="{{ route('view.contact') }}">Contacts</a>
                </li>
            </ul>

            <div class="flex">
                <a href="{{ route('view.devis') }}" class="flex items-center btn-custom">Devis
                    <span class="mdi mdi-calculator text-lg"></span></a>
            </div>
        </div>

    </div>
</div>
{{-- /app-Sidebar --}}
