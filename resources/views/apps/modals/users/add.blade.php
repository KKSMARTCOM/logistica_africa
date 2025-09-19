<!-- Sidebar-right -->
<div class="sidebar sidebar-right sidebar-animate add-users-form">
    <div class="panel panel-primary card mb-0 shadow-none border-0">
        <div class="tab-menu-heading border-0 d-flex p-3">
            <div class="card-title mb-0">Ajouter un administrateur</div>
            <div class="card-options ms-auto">
                <a href="javascript:void(0);" class="sidebar-icon text-end float-end me-3 mb-1"
                    data-bs-toggle="sidebar-right" data-target=".add-users-form"><i class="fe fe-x text-white"></i></a>
            </div>
        </div>
        <div class="panel-body tabs-menu-body latest-tasks p-0 border-0">
            <form action="{{ route('panel.users.store') }}" method="POST">
                @csrf

                <div class="pe-4 ps-4">
                    <div class="form-group">
                        <label for="name" class="form-label">Nom d'utilisateur (optionnel)</label>
                        <input type="text" name="name" class="form-control" id="name"
                            placeholder="Veuillez entrer le nom" autocomplete="name">
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email <span class="text-red">*</span></label>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="Veuillez entrez l'adresse email" autocomplete="email">
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Mot de passe <span class="text-red">*</span></label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                            placeholder="Veuillez entrez le mot de passe" autocomplete="password">
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
