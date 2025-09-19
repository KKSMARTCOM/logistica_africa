<!-- Sidebar-right -->
<div class="sidebar sidebar-right sidebar-animate add-partners-form">
    <div class="panel panel-primary card mb-0 shadow-none border-0">
        <div class="tab-menu-heading border-0 d-flex p-3">
            <div class="card-title mb-0">Ajouter un partenaire</div>
            <div class="card-options ms-auto">
                <a href="javascript:void(0);" class="sidebar-icon text-end float-end me-3 mb-1"
                    data-bs-toggle="sidebar-right" data-target=".add-partners-form"><i class="fe fe-x text-white"></i></a>
            </div>
        </div>
        <div class="panel-body tabs-menu-body latest-tasks p-0 border-0">
            <form action="{{ route('panel.partners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="pe-4 ps-4">
                    <div class="form-group">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" name="name" class="form-control" id="name"
                            placeholder="Veuillez entrer le nom du partenaire" autocomplete="name">
                    </div>

                    <div class="form-group">
                        <label for="website_url" class="form-label">Site web (optionnel)</label>
                        <input type="url" name="website_url" class="form-control" id="website_url"
                            placeholder="Veuillez entrer le site web du partenaire" autocomplete="website_url">
                    </div>

                    <div class="form-group">
                        <label for="image" class="form-label">Logo <span class="text-red">*</span></label>
                        <input class="form-control" name="image" type="file">
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
                <div class="ps-4 pe-4">
                    <button class="btn btn-primary mt-4 mb-0 w-full">Enrégistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--/Sidebar-right-->
