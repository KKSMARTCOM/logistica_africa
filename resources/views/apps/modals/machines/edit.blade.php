<!-- Sidebar-right -->
<div class="sidebar sidebar-right sidebar-animate " id="update-machine-form{{ $item->id }}">
    <div class="panel panel-primary card mb-0 shadow-none border-0">
        <div class="tab-menu-heading border-0 d-flex p-3">
            <div class="card-title mb-0">Modifier les informations d'une marchine</div>
            <div class="card-options ms-auto">
                <a href="javascript:void(0);" class="sidebar-icon text-end float-end me-3 mb-1"
                    data-bs-toggle="sidebar-right" data-target="#update-machine-form{{ $item->id }}"><i
                        class="fe fe-x text-white"></i></a>
            </div>
        </div>
        <div class="panel-body tabs-menu-body latest-tasks p-0 border-0">
            <form action="{{ route('panel.machines.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                @method('PUT')

                <div class="p-5">
                    <div class="form-group">
                        <label for="name" class="form-label">Nom <span class="text-red">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $item->name) }}"
                            id="name" placeholder="Veuillez entrer le nom" autocomplete="name">
                    </div>
                    <div class="form-group">
                        <label for="price" class="form-label">Prix (optionnel)</label>
                        <input type="number" name="price" class="form-control"
                            value="{{ old('price', $item->price) }}" id="price"
                            placeholder="Veuillez entrer le prix" autocomplete="price">
                    </div>
                    <div class="form-group">
                        <label for="image" class="form-label">Image principale <span
                                class="text-red">*</span></label>
                        @if ($item->image)
                            <img src="{{ asset($item->image ?? 'assets/images/brand/photo.png') }}" alt="Image"
                                class="img-thumbnail mb-2" width="150">
                        @endif
                        <input type="file" name="image" class="form-control" id="image"
                            placeholder="Veuillez choisir une image">
                    </div>
                    <div class="form-group">
                        <label for="additionnal_images" class="form-label">Images additionnelles (optionnel)</label>

                        @if ($item->additionnal_images)
                            <div class="d-flex flex-wrap gap-3 mb-2">
                                @foreach (json_decode($item->additionnal_images) as $img)
                                    <div class="position-relative">
                                        <img src="{{ asset($img ?? 'assets/images/brand/photo.png') }}"
                                            class="img-thumbnail" width="120">
                                        <label class="d-block">
                                            <input type="checkbox" name="delete_additionnel_images[]"
                                                value="{{ $img }}">
                                            Supprimer
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <input type="file" name="additionnal_images[]" class="form-control" id="additionnal_images"
                            placeholder="Veuillez choisir les images" multiple>
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">Description (optionnel)</label>
                        <textarea rows="4" name="description" class="form-control" id="description"
                            placeholder="Veuillez entrer une description" autocomplete="description">{{ $item->description ?? '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="model" class="form-label">Caractéristiques (optionnel)</label>
                        <div id="characteristics-wrapper">
                            @php $characteristics = old('characteristics', $item->characteristics ?? []); @endphp

                            @if (!empty($characteristics))
                                @foreach (json_decode($characteristics, true) as $index => $char)
                                    <div class="row mb-2 characteristic-item">
                                        <div class="col-md-5">
                                            <input type="text" name="characteristics[{{ $index }}][label]"
                                                class="form-control" placeholder="Libellé"
                                                value="{{ $char['label'] ?? '' }}">
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" name="characteristics[{{ $index }}][value]"
                                                class="form-control" placeholder="Valeur"
                                                value="{{ $char['value'] ?? '' }}">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-danger remove-char">X</button>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <button type="button" id="add-char" class="btn btn-outline-primary mt-2">
                            + Ajouter une caractéristique
                        </button>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Catégorie <span class="text-red">*</span></label>
                        <select class="form-control form-select select2" name="category_id"
                            data-bs-placeholder="Select">
                            <option value="">Veuillez choisir la catégorie</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="ps-4 pe-4 pb-5">
                    <button class="btn btn-primary mt-4 mb-0 w-full">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--/Sidebar-right-->
