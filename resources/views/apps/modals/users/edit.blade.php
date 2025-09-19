<!-- Sidebar-right -->
<div class="sidebar sidebar-right sidebar-animate" id="update-users-form{{ $item->id }}">
    <div class="panel panel-primary card mb-0 shadow-none border-0">
        <div class="tab-menu-heading border-0 d-flex p-3">
            <div class="card-title mb-0">Modifier les informations d'un administrateur</div>
            <div class="card-options ms-auto">
                <a href="javascript:void(0);" class="sidebar-icon text-end float-end me-3 mb-1"
                    data-bs-toggle="sidebar-right" data-target="#update-users-form{{ 1 }}"><i
                        class="fe fe-x text-white"></i></a>
            </div>
        </div>
        <div class="panel-body tabs-menu-body latest-tasks p-0 border-0">
            <form action="{{ route('panel.users.update', $item->id) }}" method="POST">
                @csrf

                @method('PUT')

                <div class="pe-4 ps-4">
                    <div class="form-group">
                        <label for="name" class="form-label">Nom d'utilisateur (optionnel)</label>
                        <input type="text" name="name" class="form-control" id="name"
                            placeholder="Veuillez entrer le nom" value="{{ old('name', $item->name) }}"
                            autocomplete="name">
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email <span class="text-red">*</span></label>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="Veuillez entrez l'adresse email" value="{{ old('email', $item->email) }}"
                            readonly autocomplete="email">
                    </div>
                    <div class="form-group">
                        <label for="status-{{ $item->id }}" class="form-label">Statut </label>
                        <select class="form-control form-select select2" name="status" id="status-{{ $item->id }}">
                            <option value="1" {{ old('status', $item->status) == 1 ? 'selected' : '' }}>
                                Actif</option>
                            <option value="0" {{ old('status', $item->status) == 0 ? 'selected' : '' }}>
                                Inactif</option>
                        </select>
                    </div>
                </div>
                <div class="ps-4 pe-4">
                    <button class="btn btn-primary mt-4 mb-0 w-full">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--/Sidebar-right-->
