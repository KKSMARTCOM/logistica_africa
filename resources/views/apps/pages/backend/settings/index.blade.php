@extends('layouts.app')

@section('title', 'Paramètres')

@section('header', 'Paramètres')

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Paramètres</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Paramètres</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- Row -->
    <div class="row">
        <!-- ABOUT -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">À propos</div>
                <div class="card-body">
                    <form action="{{ route('panel.settings.about.update', $about->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="mb-3">
                            <label>Texte</label>
                            <textarea name="about_text" rows="6" class="form-control">{{ $about->about_text }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Image actuelle</label><br>
                            <img src="{{ asset('storage/' . $about->about_image ?? 'assets/images/brand/photo.png') }}"
                                width="150">
                            <input type="file" name="about_image" class="form-control mt-2">
                        </div>
                        <div class="mb-3">
                            <label>Mission</label>
                            <textarea name="mission_text" rows="6" class="form-control">{{ $about->mission_text }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Image mission</label><br>
                            <img src="{{ asset('storage/' . $about->mission_image ?? 'assets/images/brand/photo.png') }}"
                                width="150">
                            <input type="file" name="mission_image" class="form-control mt-2">
                        </div>
                        <button class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- APP BASICS -->
        <div class="col-sm-12 mt-4">
            <div class="card">
                <div class="card-header">Paramètres généraux</div>
                <div class="card-body">
                    <form action="{{ route('panel.settings.appbasics.update', $appBasics->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="mb-3">
                            <label>Contact</label>
                            <input type="text" name="contact" class="form-control" value="{{ $appBasics->contact }}">
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $appBasics->email }}">
                        </div>
                        <div class="mb-3">
                            <label>Politique de confidentialité</label>
                            <textarea name="privacy_policy" rows="6" class="form-control">{{ $appBasics->privacy_policy }}</textarea>
                        </div>
                        <button class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- BANNER -->
        <div class="col-sm-12 mt-4">
            <div class="card">
                <div class="card-header">Bannière</div>
                <div class="card-body">
                    <form action="{{ route('panel.settings.banner.update', $banner->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="mb-3">
                            <label>Titre</label>
                            <input type="text" name="title" class="form-control" value="{{ $banner->title }}">
                        </div>
                        <div class="mb-3">
                            <label>Sous-titre</label>
                            <input type="text" name="subtitle" class="form-control" value="{{ $banner->subtitle }}">
                        </div>
                        <div class="mb-3">
                            <label>Image de fond</label><br>
                            <img src="{{ asset('storage/' . $banner->background_image ?? 'assets/images/brand/photo.png') }}"
                                width="150">
                            <input type="file" name="background_image" class="form-control mt-2">
                        </div>
                        <button class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- CARROUSEL -->
        <div class="col-sm-12 mt-4">
            <div class="card">
                <div class="card-header">Carrousel</div>
                <div class="card-body">
                    <form action="{{ route('panel.settings.carrousel.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Titre</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <button class="btn btn-success">Ajouter</button>
                    </form>

                    <div class="mt-3">
                        <h5>Images actuelles</h5>
                        @foreach ($carrousels as $carrousel)
                            <div>
                                <p>{{ $carrousel->title }}</p>
                                <img src="{{ asset('storage/' . $carrousel->image ?? 'assets/images/brand/photo.png') }}"
                                    width="150">
                                <form action="{{ route('panel.settings.carrousel.destroy', $carrousel->id) }}"
                                    method="POST" class="my-4">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
@endsection
