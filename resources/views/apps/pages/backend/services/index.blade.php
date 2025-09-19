@extends('layouts.app')

@section('title', 'Gestion des Services')

@section('header', 'Gestion des Services')

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Liste des Services</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Liste des Services</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <div class="page_header_bottom">

        <div class="page_header_bottom_right">
            <a href="javascript:void(0);" data-bs-toggle="sidebar-right" data-target=".add-service-form"
                class="btn btn-primary">Ajouter</a>
        </div>
    </div>

    <!-- Row -->
    <div class="row">

        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    @if ($services && $services->count() > 0)
                        <div class="table-responsive">
                            <table class="table border text-nowrap text-md-nowrap table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Titre</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $id = 1;
                                    @endphp
                                    @foreach ($services as $item)
                                        <tr>
                                            <td>{{ $id++ }}</td>
                                            <td>
                                                <div class="partner-image-circle">
                                                    <img src="{{ asset('storage/' . $item->image ?? 'assets/images/brand/photo.png') }}"
                                                        alt="{{ $item->title }}" title="{{ $item->title }}">

                                                </div>
                                            </td>
                                            <td>{{ $item->title }}</td>
                                            <td>
                                                <span class="badge {{ $item->status ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $item->status ? 'Actif' : 'Inactif' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="table-btn">
                                                    <a href="javascript:void(0);" data-bs-toggle="sidebar-right"
                                                        data-target="#edit-service-{{ $item->id }}"
                                                        class="text-secondary">Modifier</a>

                                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $item->id }}"
                                                        class="text-danger">Supprimer</a>
                                                </div>
                                            </td>
                                        </tr>


                                        @include('apps.modals.delete', [
                                            'id' => $item->id,
                                            'route' => route('panel.services.destroy', $item->id),
                                            'message' => 'le service',
                                        ])

                                        @include('apps.modals.services.edit')
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

    @include('apps.modals.services.add')
@endsection
