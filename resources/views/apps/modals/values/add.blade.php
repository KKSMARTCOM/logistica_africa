<!-- Sidebar-right -->
<div class="sidebar sidebar-right sidebar-animate add-values-form">
    <div class="panel panel-primary card mb-0 shadow-none border-0">
        <div class="tab-menu-heading border-0 d-flex p-3">
            <div class="card-title mb-0">Ajouter une valeur</div>
            <div class="card-options ms-auto">
                <a href="javascript:void(0);" class="sidebar-icon text-end float-end me-3 mb-1"
                    data-bs-toggle="sidebar-right" data-target=".add-values-form"><i class="fe fe-x text-white"></i></a>
            </div>
        </div>
        <div class="panel-body tabs-menu-body latest-tasks p-0 border-0">
            <form action="{{ route('panel.values.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="p-5">
                    <div class="form-group">
                        <label for="title" class="form-label">Titre <span class="text-red">*</span></label>
                        <input type="text" name="title" class="form-control" id="title"
                            placeholder="Veuillez entrer le titre" autocomplete="title">
                    </div>
                    <div class="form-group">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Description<span class="text-red">*</span></label>
                        <textarea rows="4" name="description" class="form-control" id="description"
                            placeholder="Veuillez entrer une description" autocomplete="description"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="status" class="form-label">Statut </label>
                        <select class="form-control form-select select2" name="status" data-bs-placeholder="Select">
                            <option label="Veuillez choisir le statut"></option>
                            <option selected value="1">Actif</option>
                            <option value="0">Inactif</option>
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
