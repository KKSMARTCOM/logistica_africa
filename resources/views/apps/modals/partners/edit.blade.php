<!-- Sidebar-right -->
<div class="sidebar sidebar-right sidebar-animate" id="edit-partner-{{ $item->id }}">
    <div class="panel panel-primary card mb-0 shadow-none border-0">
        <div class="tab-menu-heading border-0 d-flex p-3">
            <div class="card-title mb-0">Modifier un partenaire</div>
            <div class="card-options ms-auto">
                <a href="javascript:void(0);" class="sidebar-icon text-end float-end me-3 mb-1"
                    data-bs-toggle="sidebar-right" data-target="#edit-partner-{{ $item->id }}"><i
                        class="fe fe-x text-white"></i></a>
            </div>
        </div>
        <div class="panel-body tabs-menu-body latest-tasks p-0 border-0">
            <form action="{{ route('panel.partners.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                @method('PUT')

                <div class="pe-4 ps-4">

                    <div class="form-group">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" name="name" class="form-control" id="name"
                            value="{{ $item->name }}" placeholder="Veuillez entrer le nom du partenaire"
                            autocomplete="name">
                    </div>

                    <div class="form-group">
                        <label for="website_url" class="form-label">Site web (optionnel)</label>
                        <input type="url" name="website_url" class="form-control" id="website_url"
                            value="{{ $item->website_url }}" placeholder="Veuillez entrer le site web du partenaire"
                            autocomplete="website_url">
                    </div>

                    <div class="form-group">
                        <label for="image" class="form-label">Logo <span class="text-red">*</span></label>
                        @if ($item->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $item->image ?? 'assets/images/brand/photo.png') }}"
                                    alt="Image actuelle" class="img-thumbnail" width="100">
                            </div>
                        @endif
                        <input class="form-control" name="image" type="file">
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
                    <button class="btn btn-primary mt-4 mb-0 w-full">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--/Sidebar-right-->
