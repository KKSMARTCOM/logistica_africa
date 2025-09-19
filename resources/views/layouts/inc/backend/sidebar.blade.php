<!--APP-SIDEBAR-->
<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="{{ route('panel.index') }}">
                <img src="{{ asset('assets/images/brand/logo.png') }}" style="width: 100%;height:100%;object-fit:cover;"
                    class="header-brand-img light-logo" alt="logo">
                <img src="{{ asset('assets/images/brand/logo.png') }}" class="header-brand-img light-logo1"
                    style="width: 100%;height:100%;object-fit:cover;margin-top:10px" alt="logo">
            </a>
            <!-- LOGO -->
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg></div>
            <ul class="side-menu">
                <li class="sub-category">
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link {{ Request::is('panel') ? 'active' : '' }}"
                        data-bs-toggle="slide" href="{{ route('panel.index') }}"><i
                            class="side-menu__icon mdi mdi-home"></i><span class="side-menu__label">Tableau de
                            bord</span></a>
                </li>

                {{--  <li class="slide">
                    <a class="side-menu__item has-link " data-bs-toggle="slide" href=""><i
                            class="side-menu__icon mdi mdi-calculator"></i><span class="side-menu__label">Demandes de
                            devis</span></a>
                </li> --}}

                <li class="slide">
                    <a class="side-menu__item has-link {{ Request::is('panel/categories') ? 'active' : '' }}"
                        data-bs-toggle="slide" href="{{ route('panel.categories.index') }}"><i
                            class="side-menu__icon mdi mdi-file"></i><span
                            class="side-menu__label">Catégories</span></a>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link {{ Request::is('panel/machines') ? 'active' : '' }}"
                        data-bs-toggle="slide" href="{{ route('panel.machines.index') }}"><i
                            class="side-menu__icon mdi mdi-factory"></i><span class="side-menu__label">Engins</span></a>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link {{ Request::is('panel/posts*') ? 'active' : '' }}"
                        data-bs-toggle="slide" href="{{ route('panel.posts.index') }}"><i
                            class="side-menu__icon mdi mdi-newspaper"></i><span
                            class="side-menu__label">Actualités</span></a>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link {{ Request::is('panel/contacts*') ? 'active' : '' }}"
                        data-bs-toggle="slide" href="{{ route('panel.contacts.index') }}"><i
                            class="side-menu__icon mdi mdi-message"></i><span
                            class="side-menu__label">Messages</span></a>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link {{ Request::is('panel/testimonials*') ? 'active' : '' }}"
                        data-bs-toggle="slide" href="{{ route('panel.testimonials.index') }}"><i
                            class="side-menu__icon mdi mdi-format-quote-close"></i><span
                            class="side-menu__label">Témoignages</span></a>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link {{ Request::is('panel/services*') ? 'active' : '' }}"
                        data-bs-toggle="slide" href="{{ route('panel.services.index') }}"><i
                            class="side-menu__icon mdi mdi-briefcase"></i><span
                            class="side-menu__label">Services</span></a>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link {{ Request::is('panel/partners*') ? 'active' : '' }}"
                        data-bs-toggle="slide" href="{{ route('panel.partners.index') }}"><i
                            class="side-menu__icon mdi mdi-briefcase"></i><span
                            class="side-menu__label">Partenaires</span></a>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link {{ Request::is('panel/values*') ? 'active' : '' }}"
                        data-bs-toggle="slide" href="{{ route('panel.values.index') }}"><i
                            class="side-menu__icon mdi mdi-bullhorn"></i><span
                            class="side-menu__label">Valeurs</span></a>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link {{ Request::is('panel/users') ? 'active' : '' }}"
                        data-bs-toggle="slide" href="{{ route('panel.users.index') }}"><i
                            class="side-menu__icon mdi mdi-account"></i><span
                            class="side-menu__label">Utilisateurs</span></a>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link {{ Request::is('panel/settings') ? 'active' : '' }}"
                        data-bs-toggle="slide" href="{{ route('panel.settings.index') }}"><i
                            class="side-menu__icon mdi mdi-settings"></i><span
                            class="side-menu__label">Paramètres</span></a>
                </li>

            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg></div>
        </div>
    </div>
    <!--/APP-SIDEBAR-->
</div>
