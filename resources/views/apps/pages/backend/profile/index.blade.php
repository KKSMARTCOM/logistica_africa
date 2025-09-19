@extends('layouts.app')

@section('title', 'Profil')
@section('header', 'Profil')

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Profil</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('view.home') }}">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profil</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- Row -->
    <div class="row">
        <!-- ABOUT -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">Informations</div>
                <div class="card-body">
                    <form action="{{ route('panel.settings.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name', auth()->user()->name) }}">

                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ old('email', auth()->user()->email) }}">
                        </div>

                        <div class="form-group">
                            <label for="current_password" class="form-label">Mot de passe actuel</label>
                            <input type="password" name="current_password" id="current_password" class="form-control"
                                placeholder="Entrez votre mot de passe actuel">
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">Nouveau mot de passe</label>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Laissez vide si vous ne changez pas">
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">Confirmation</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control" placeholder="Confirmez le mot de passe">
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
@endsection
