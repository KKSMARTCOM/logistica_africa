<!-- Sidebar-right -->
<div class="sidebar sidebar-right sidebar-animate " id="view-message{{ $item->id }}">
    <div class="panel panel-primary card mb-0 shadow-none border-0">
        <div class="tab-menu-heading border-0 d-flex p-3">
            <div class="card-title mb-0">Details du message</div>
            <div class="card-options ms-auto">
                <a href="javascript:voModifier les informations d'une marchineid(0);"
                    class="sidebar-icon text-end float-end me-3 mb-1" data-bs-toggle="sidebar-right"
                    data-target="#view-message{{ $item->id }}"><i class="fe fe-x text-white"></i></a>
            </div>
        </div>
        <div class="panel-body tabs-menu-body latest-tasks p-4 border-0">
            <div class="mb-3">
                <label class="fw-bold">Email :</label>
                <p class="text-muted mb-0">{{ $item->email }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold">Sujet :</label>
                <p class="text-muted mb-0">{{ $item->subject }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-bold">Message :</label>
                <div class="p-3">
                    {!! nl2br(e($item->message)) !!}
                </div>
            </div>

            <div class="ps-4 pe-4 pb-5">
                <button data-bs-toggle="sidebar-right" data-target="#view-message{{ $item->id }}"
                    class="btn btn-primary mt-4 mb-0 w-full">Fermer</button>
            </div>
        </div>
    </div>
</div>
<!--/Sidebar-right-->
