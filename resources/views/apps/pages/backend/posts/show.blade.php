@extends('layouts.main')

@section('title', 'Gestion des articles')

@section('header', 'Gestion des articles')

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        @if (!empty($post->id))
            <h1 class="page-title">{{ $post->title }}</h1>
        @endif
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Accueil</a></li>
                @if (!empty($post->id))
                    <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
                @endif
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- Row -->
    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-image-top">
                    <img src="{{ asset($post->image ?? 'assets/images/brand/photo.png') }}" alt="Card image cap">
                </div>
                <div class="card-body">
                    <div class="d-md-flex">
                        <a href="javascript:void(0);" class="d-flex me-4 mb-2"><i
                                class="fe fe-calendar fs-16 me-1 p-3 bg-secondary-transparent text-secondary bradius"></i>
                            <div class="mt-3 ms-1 text-muted font-weight-semibold">
                                {{ $post->published_at ?? $post->status == 'draft' ? 'Brouillon' : 'Archivé' }}</div>
                        </a>
                        {{-- <a href="profile.html" class="d-flex mb-2"><i
                                class="fe fe-user fs-16 me-1 p-3 bg-primary-transparent text-primary bradius"></i>
                            <div class="mt-3 ms-1 text-muted font-weight-semibold">Harry Fisher</div>
                        </a> --}}
                        <a href="javascript:void(0);" class="d-flex me-4 mb-2"><i
                                class="fe fe-eye fs-16 me-1 p-3 bg-primary-transparent text-primary bradius"></i>
                            <div class="mt-3 ms-1 text-muted font-weight-semibold">{{ $post->views }} Vue(s)</div>
                        </a>

                        <a href="javascript:void(0);" class="d-flex mb-2"><i
                                class="fe fe-clock fs-16 me-1 p-3 bg-primary-transparent text-primary bradius"></i>
                            <div class="mt-3 ms-1 text-muted font-weight-semibold">{{ $post->estimated_reading_time }}
                                min(s)</div>
                        </a>
                        <div class="ms-auto">
                            <a href="javascript:void(0);" class="d-flex mb-2"><i
                                    class="fe fe-message-square fs-16 me-1 p-3 bg-success-transparent text-success bradius"></i>
                                <div class="mt-3 ms-1 text-muted font-weight-semibold">{{ $post->comments_count }}
                                    Commentaire(s)</div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h3><a href="javascript:void(0)"> {{ $post->title }}</a></h3>
                    <p class="card-text">{{ $post->excerpt }}</p>
                    <p> {!! $post->content !!} </p>
                </div>
            </div>
            @if ($post->comments && $post->comments->count() > 0)
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Commentaire(s)</div>
                    </div>
                    <div class="card-body pb-0">

                        @foreach ($post->comments as $comment)
                            <div class="media mb-2 overflow-visible d-block d-sm-flex">
                                <div class="media-body overflow-visible">
                                    <div class="border mb-2 p-4 br-5">
                                        <nav class="nav float-end">
                                            <div class="dropdown">
                                                <a class="nav-link text-muted fs-16 p-0 ps-4" href="javascript:;"
                                                    data-bs-toggle="dropdown" role="button" aria-haspopup="true"
                                                    aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end" style="">
                                                    <a class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $comment->id }}"
                                                        href="javascript:void(0)"><i class="fe fe-edit mx-1"></i>
                                                        Modifier</a>

                                                    <a class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#confirmToggleModal{{ $comment->id }}"
                                                        href="javascript:void(0)"><i class="fe fe-corner-up-left mx-1"></i>
                                                        Approuver</a>

                                                    <a class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#confirmToggleModal{{ $comment->id }}Reject"
                                                        href="javascript:void(0)"><i class="fe fe-flag mx-1"></i>
                                                        Rejeter</a>

                                                    <a class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $comment->id }}"
                                                        href="javascript:void(0)"><i class="fe fe-trash-2 mx-1"></i>
                                                        Supprimer</a>
                                                </div>
                                            </div>
                                        </nav>
                                        <h5 class="mt-0">{{ $comment->user_name }}</h5>
                                        <h5 class="mt-0">{{ $comment->email }}</h5>
                                        <span><i class="fe fe-thumb-up text-danger"></i></span>
                                        <p class="font-13 text-muted">{{ $comment->content }}</p>
                                        <span class="" id="1">
                                            @if ($comment->status == 'pending')
                                                <a href="javascript:;"><span
                                                        class="badge btn-warning rounded-pill py-2 px-3">A
                                                        valider</span></a>
                                            @elseif ($comment->status == 'approved')
                                                <a href="javascript:;"><span
                                                        class="badge btn-success rounded-pill py-2 px-3">Approuvé</span></a>
                                            @else
                                                <a href="javascript:;"><span
                                                        class="badge btn-danger rounded-pill py-2 px-3">Rejeté</span></a>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>

                            @include('apps.modals.comments.edit')

                            @include('apps.modals.comments.confirmToggle', [
                                'id' => $comment->id,
                                'message' => 'Voulez-vous vraiment approuver ce commentaire ?',
                                'route' => route('Panel::toggleComment', $comment->id),
                                'status' => 'approved',
                            ])

                            @include('apps.modals.comments.confirmToggle', [
                                'id' => $comment->id . 'Reject',
                                'message' => 'Voulez-vous vraiment rejeter ce commentaire ?',
                                'route' => route('Panel::toggleComment', $comment->id),
                                'status' => 'rejected',
                            ])

                            @include('apps.modals.delete', [
                                'id' => $comment->id,
                                'route' => route('Panel::comments.destroy', $comment->id),
                                'message' => 'le commentaire',
                            ])
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Ajouter un commentaire</div>
                </div>
                <div class="card-body">
                    <form class="form-horizontal  m-t-20" action="{{ route('Panel::comments.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="blog_id"
                            value="{{ isset($post->id) ? $post->id : $comment->post->id }}">

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="user_name" required=""
                                    placeholder="Nom d'utilisateur*">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="email" name="user_email" required=""
                                    placeholder="Email*">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <textarea class="form-control" name="content" placeholder="Votre commentaire*" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="">
                            <button class="btn btn-primary btn-rounded  waves-effect waves-light">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Tags</div>
                </div>
                <div class="card-body">
                    <div class="tags">
                        @foreach (json_decode($post->tags, true) as $tag)
                            <a href="javascript:void(0)" class="tag">{{ $tag }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->

@endsection
