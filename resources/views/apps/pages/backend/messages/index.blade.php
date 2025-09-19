@extends('layouts.app')

@section('title', 'Gestion des Messages')

@section('header', 'Gestion des Messages')

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Liste des Messages</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Liste des Messages</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    {{-- <div class="page_header_bottom">
        <div class="page_header_bottom_left">
            <div class="page_header_bottom_left_input">
                <input type="text" class="form-control" id="typehead" placeholder="Rechercher..." autocomplete="off">
                <button class="btn px-0 pt-2"><i class="fe fe-search" aria-hidden="true"></i></button>
            </div>
        </div>
        <div class="page_header_bottom_right">
            <a href="javascript:void(0);" data-bs-toggle="sidebar-right" data-target=".add-partners-form"
                class="btn btn-primary">Ajouter</a>
        </div>
    </div> --}}

    <!-- Row -->
    <div class="row">

        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    @if ($messages && $messages->count() > 0)
                        <div class="table-responsive">
                            <table class="table border text-nowrap text-md-nowrap table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Email</th>
                                        <th>Objet</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $id = 1;
                                    @endphp
                                    @foreach ($messages as $item)
                                        <tr>
                                            <td>{{ $id++ }}</td>
                                            <td>
                                                {{ $item->email }}
                                            </td>
                                            <td>{{ $item->subject }}</td>
                                            <td>
                                                <div class="table-btn">
                                                    <a href="javascript:void(0);" data-bs-toggle="sidebar-right"
                                                        data-target="#view-message{{ $item->id }}"
                                                        class="text-secondary">Voir plus</a>

                                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $item->id }}"
                                                        class="text-danger">Supprimer</a>
                                                </div>
                                            </td>
                                        </tr>

                                        @include('apps.modals.messages.view')

                                        @include('apps.modals.delete', [
                                            'id' => $item->id,
                                            'route' => route('panel.contacts.destroy', $item->id),
                                            'message' => 'le message',
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
