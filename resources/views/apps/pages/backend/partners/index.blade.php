@extends('layouts.app')

@section('title', 'Gestion des partenaires')

@section('header', 'Gestion des partenaires')

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Liste des partenaire</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Liste des partenaire</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <div class="page_header_bottom">

        <div class="page_header_bottom_right">
            <a href="javascript:void(0);" data-bs-toggle="sidebar-right" data-target=".add-partners-form"
                class="btn btn-primary">Ajouter</a>
        </div>
    </div>

    <!-- Row -->
    <div class="row">

        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    @if ($partners && $partners->count() > 0)
                        <div class="table-responsive">
                            <table class="table border text-nowrap text-md-nowrap table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Logo</th>
                                        <th>Nom</th>
                                        <th>Site web</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $id = 1;
                                    @endphp
                                    @foreach ($partners as $item)
                                        <tr>
                                            <td>{{ $id++ }}</td>
                                            <td>
                                                <div class="partner-image-circle">
                                                    <img src="{{ asset('storage/' . $item->image ?? 'assets/images/brand/photo.png') }}"
                                                        alt="{{ $item->name }}" title="{{ $item->name }}">

                                                </div>
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->website_url }}</td>
                                            <td>
                                                <div class="table-btn">
                                                    <a href="javascript:void(0);" data-bs-toggle="sidebar-right"
                                                        data-target="#edit-partner-{{ $item->id }}"
                                                        class="text-secondary">Modifier</a>

                                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $item->id }}"
                                                        class="text-danger">Supprimer</a>
                                                </div>
                                            </td>
                                        </tr>


                                        @include('apps.modals.delete', [
                                            'id' => $item->id,
                                            'route' => route('panel.partners.destroy', $item->id),
                                            'message' => 'le partenaire',
                                        ])

                                        @include('apps.modals.partners.edit')
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

    @include('apps.modals.partners.add')
@endsection
