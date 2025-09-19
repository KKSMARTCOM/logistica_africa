@extends('layouts.auth')

@section('title', 'Connexion')

@section('content')
    <div class="container-login100">
        <div class="wrap-login100 p-6">
            <form class="login100-form validate-form" action="{{ route('login.store') }}" method="POST">
                @csrf

                <span class="login100-form-title pb-5">
                    Connexion
                </span>

                <h4 class="text-center">Bienvenue 👋🏻! </h4>
                <p class="text-center text-muted">Veuillez vous connecter à votre compte avec vos identifiants.</p>

                <div class="panel panel-primary">
                    <div class="panel-body tabs-menu-body p-0 pt-5">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab5">
                                <div class="wrap-input100 validate-input input-group">
                                    <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                        <i class="zmdi zmdi-email text-muted" aria-hidden="true"></i>
                                    </a>
                                    <input class="input100 border-start-0 form-control ms-0" type="email"
                                        placeholder="Email" name="email" value="{{ old('email') }}">
                                </div>
                                <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                    <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                        <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                    </a>
                                    <input class="input100 border-start-0 form-control ms-0" type="password"
                                        placeholder="Mot de passe" name="password">
                                </div>
                                {{-- <div class="text-end pt-4">
                                    <p class="mb-0"><a href="" class="text-primary ms-1">Mot de passe
                                            oublié ?</a></p>
                                </div>
                                <div class="flex mb-1 mt-1 gap-2 align-items-center">
                                    <input id="checkbox-1" type="checkbox" name="remember"
                                        class="w-4 h-4 text-[#003169] bg-gray-100 border-gray-300 rounded focus:ring-[#003169] focus:ring-2 focus:outline-none focus:shadow-sm">
                                    <label for="checkbox-1" class="text-[15px] text-gray-900">
                                        Se souvenir de moi
                                    </label>
                                </div> --}}
                                <div class="container-login100-form-btn">
                                    <button type="submit" class="login100-form-btn btn-primary">
                                        Se connecter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
