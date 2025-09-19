<!-- Sidebar-right -->
<div class="sidebar sidebar-right sidebar-animate" id="edit-values-{{ $item->id }}">
    <div class="panel panel-primary card mb-0 shadow-none border-0">
        <div class="tab-menu-heading border-0 d-flex p-3">
            <div class="card-title mb-0">Modifier une valeur</div>
            <div class="card-options ms-auto">
                <a href="javascript:void(0);" class="sidebar-icon text-end float-end me-3 mb-1"
                    data-bs-toggle="sidebar-right" data-target="#edit-values-{{ $item->id }}">
                    <i class="fe fe-x text-white"></i>
                </a>
            </div>
        </div>
        <div class="panel-body tabs-menu-body latest-tasks p-0 border-0">
            <form action="{{ route('panel.values.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="p-5">
                    <div class="form-group">
                        <label for="title-{{ $item->id }}" class="form-label">Titre <span
                                class="text-red">*</span></label>
                        <input type="text" name="title" class="form-control" id="title-{{ $item->id }}"
                            placeholder="Veuillez entrer le titre" value="{{ old('title', $item->title) }}"
                            autocomplete="title">
                    </div>

                    <div class="form-group">
                        <label for="image-{{ $item->id }}" class="form-label">Image</label>
                        @if ($item->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $item->image ?? 'assets/images/brand/photo.png') }}"
                                    alt="Image actuelle" class="img-thumbnail" width="100">
                            </div>
                        @endif
                        <input type="file" name="image" class="form-control" id="image-{{ $item->id }}">
                    </div>

                    <div class="form-group">
                        <label for="description-{{ $item->id }}" class="form-label">Description</label>
                        <textarea rows="4" name="description" class="form-control" id="description-{{ $item->id }}"
                            placeholder="Veuillez entrer une description" autocomplete="description">{{ old('description', $item->description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="status-{{ $item->id }}" class="form-label">Statut </label>
                        <select class="form-control form-select select2" name="status"
                            id="status-{{ $item->id }}">
                            <option value="1" {{ old('status', $item->status) == 1 ? 'selected' : '' }}>
                                Actif</option>
                            <option value="0" {{ old('status', $item->status) == 0 ? 'selected' : '' }}>
                                Inactif</option>
                        </select>
                    </div>
                </div>

                <div class="ps-4 pe-4 pb-5">
                    <button class="btn btn-primary mt-4 mb-0 w-full">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--/Sidebar-right-->
