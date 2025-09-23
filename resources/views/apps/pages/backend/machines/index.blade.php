@extends('layouts.app')

@section('title', 'Gestion des Machines')

@section('header', 'Gestion des Machines')

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Liste des engins</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Liste des engins</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <div class="page_header_bottom">
        {{--         <div class="page_header_bottom_left">
            <div class="page_header_bottom_left_input">
                <input type="text" class="form-control" id="typehead" placeholder="Rechercher..." autocomplete="off">
                <button class="btn px-0 pt-2"><i class="fe fe-search" aria-hidden="true"></i></button>
            </div>
        </div> --}}
        <div class="page_header_bottom_right">
            <a href="javascript:void(0);" data-bs-toggle="sidebar-right" data-target=".add-machine-form"
                class="btn btn-primary">Ajouter</a>

        </div>
    </div>

    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    @if ($machines && $machines->count() > 0)
                        <div class="table-responsive">
                            <table class="table border text-nowrap text-md-nowrap table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Libellé</th>
                                        <th>Image</th>
                                        <th>Catégorie</th>
                                        <th>Prix</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $id = 1;
                                    @endphp
                                    @foreach ($machines as $item)
                                        <tr>
                                            <td>{{ $id++ }}</td>
                                            <td>{{ $item->name ?? 'N/A' }}</td>
                                            <td>
                                                <div class="image-circle">
                                                    <img style="height: 100%;width:100%"
                                                        src="{{ asset($item->image ?? 'assets/images/brand/photo.png') }}"
                                                        alt="{{ $item->name }}" title="{{ $item->name }}">
                                                </div>
                                            </td>
                                            <td>{{ $item->category->name ?? 'N/A' }}</td>
                                            <td>{{ $item->price ?? 'N/A' }}</td>
                                            <td>
                                                <div class="table-btn">
                                                    <a href="javascript:void(0);" data-bs-toggle="sidebar-right"
                                                        data-target="#update-machine-form{{ $item->id }}"
                                                        class="text-primary">Modifier</a>

                                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $item->id }}"
                                                        class="text-danger">Supprimer</a>
                                                </div>
                                            </td>
                                        </tr>

                                        @include('apps.modals.machines.edit')
                                        @include('apps.modals.delete', [
                                            'id' => $item->id,
                                            'route' => route('panel.machines.destroy', $item->id),
                                            'message' => 'l\'engins',
                                        ])
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3 w-full">
                            {{ $machines->links('pagination::custom') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->

    @include('apps.modals.machines.add')
@endsection
