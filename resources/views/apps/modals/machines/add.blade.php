<!-- Sidebar-right -->
<div class="sidebar sidebar-right sidebar-animate add-machine-form">
    <div class="panel panel-primary card mb-0 shadow-none border-0">
        <div class="tab-menu-heading border-0 d-flex p-3">
            <div class="card-title mb-0">Ajouter une machine</div>
            <div class="card-options ms-auto">
                <a href="javascript:void(0);" class="sidebar-icon text-end float-end me-3 mb-1"
                    data-bs-toggle="sidebar-right" data-target=".add-machine-form"><i class="fe fe-x text-white"></i></a>
            </div>
        </div>
        <div class="panel-body tabs-menu-body latest-tasks p-0 border-0">
            <form action="{{ route('panel.machines.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="p-5">
                    <div class="form-group">
                        <label for="name" class="form-label">Nom <span class="text-red">*</span></label>
                        <input type="text" name="name" class="form-control" id="name"
                            placeholder="Veuillez entrer le nom" autocomplete="name">
                    </div>
                    <div class="form-group">
                        <label for="price" class="form-label">Prix <span class="text-red">*</span></label>
                        <input type="text" name="price" class="form-control" id="price"
                            placeholder="Veuillez entrer le prix" autocomplete="price">
                    </div>
                    <div class="form-group">
                        <label for="image" class="form-label">Image principale <span
                                class="text-red">*</span></label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="additionnal_images" class="form-label">Images additionnelles (optionnel)</label>
                        <input type="file" name="additionnal_images[]" class="form-control" multiple>
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">Description (optionnel)</label>
                        <textarea rows="4" name="description" class="form-control" id="description"
                            placeholder="Veuillez entrer une description" autocomplete="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="model" class="form-label">Caractéristiques (optionnel)</label>
                        <div id="characteristics-wrapper">
                            <!-- Les champs caractéristiques apparaissent ici -->
                        </div>
                        <button type="button" id="add-characteristic" class="btn btn-outline-primary mt-2">
                            + Ajouter une caractéristique
                        </button>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Catégorie <span class="text-red">*</span></label>
                        <select class="form-control form-select select2" name="category_id"
                            data-bs-placeholder="Select">
                            <option value="" label="Veuillez choisir la catégorie">Veuillez choisir la catégorie
                            </option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="ps-4 pe-4 pb-5">
                    <button class="btn btn-primary mt-4 mb-0 w-full">Enrégistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--/Sidebar-right-->
