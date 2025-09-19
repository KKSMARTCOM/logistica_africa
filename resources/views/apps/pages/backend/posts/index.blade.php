@extends('layouts.app')

@section('title', 'Gestion des articles')

@section('header', 'Gestion des articles')

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Liste des articles</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Liste des articles</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <div class="page_header_bottom">
        {{-- <div class="page_header_bottom_left">
            <div class="page_header_bottom_left_input">
                <input type="text" class="form-control" id="typehead" placeholder="Rechercher..." autocomplete="off">
                <button class="btn px-0 pt-2"><i class="fe fe-search" aria-hidden="true"></i></button>
            </div>
        </div> --}}
        <div class="page_header_bottom_right">
            <a href="{{ route('panel.posts.create') }}" class="btn btn-primary">Ajouter</a>
        </div>
    </div>

    <!-- Row -->
    <div class="row">

        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    @if ($posts && $posts->count() > 0)
                        <div class="table-responsive">
                            <table class="table border text-nowrap text-md-nowrap table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Titre</th>
                                        <th>Nombre de vues</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $id = 1;
                                    @endphp
                                    @foreach ($posts as $item)
                                        <tr>
                                            <td>{{ $id++ }}</td>
                                            <td>{{ Str::limit($item->title, 35, '...') }}</td>
                                            <td>{{ $item->views }}</td>
                                            <td>
                                                @if ($item->status == 'draft')
                                                    <span class="badge bg-warning badge-sm  me-1 mb-1 mt-1">Brouillon</span>
                                                @elseif($item->status == 'publish')
                                                    <span class="badge bg-success badge-sm  me-1 mb-1 mt-1">Publié</span>
                                                @else
                                                    <span class="badge bg-danger badge-sm  me-1 mb-1 mt-1">Archivé</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="table-btn">
                                                    <a href="{{ route('panel.posts.edit', $item->id) }}"
                                                        class="text-secondary">Modifier</a>

                                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $item->id }}"
                                                        class="text-danger">Supprimer</a>
                                                </div>
                                            </td>
                                        </tr>


                                        @include('apps.modals.delete', [
                                            'id' => $item->id,
                                            'route' => route('panel.posts.destroy', $item->id),
                                            'message' => 'l\'article',
                                        ])
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->

@endsection
