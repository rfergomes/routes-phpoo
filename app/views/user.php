<?php $this->layout('layout', ['title' => $title]) ?>
<div class="col-xl-7 col-md-12">
    <div class="card user-list table-card">
        <div class="card-header">
            <h5>Lista de Usuários</h5>
        </div>
        <div class="card-body pb-0">
            <div class="table-responsive">
                <div class="user-scroll simplebar-scrollable-y simplebar-scrollable-x" style="height:380px;position:relative;" data-simplebar="init">
                    <div class="simplebar-wrapper" style="margin: 0px;">
                        <div class="simplebar-height-auto-observer-wrapper">
                            <div class="simplebar-height-auto-observer"></div>
                        </div>
                        <div class="simplebar-mask">
                            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: scroll;">
                                    <div class="simplebar-content" style="padding: 0px;">
                                        <table class="table table-hover m-0">
                                            <thead>
                                                <tr>
                                                    <th>Avatar</th>
                                                    <th>Usuário</th>
                                                    <th>Tipo</th>
                                                    <th>Status</th>
                                                    <th>Último Login</th>
                                                    <th class="text-center">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($users as $user) : ?>
                                                    <tr>
                                                        <td><img class="rounded-circle" style="width:40px;" src="<?= '../assets/images/user/' . $user->image  ?>" alt="activity-user"></td>
                                                        <td>
                                                            <p class="m-0"><?= $user->name; ?></p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-1"><?= $user->group_name; ?></p>
                                                        </td>
                                                        <td>
                                                            <p class="m-0"><?= $user->status; ?></p>
                                                        </td>
                                                        <td>
                                                            <p class="m-0"><?= $user->last_login; ?></p>
                                                        </td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn " style="border: none;" title="Editar" data-bs-toggle="modal" data-bs-target="#userEdit">
                                                                <i class="icon feather icon-edit f-16 text-success"></i>
                                                            </button>
                                                            <button type="button" class="btn" title="Cadastrar" data-bs-toggle="modal" data-bs-target="#userAdd">
                                                                <i class="feather icon-trash-2 f-16 ms-3 text-danger"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="simplebar-placeholder" style="width: 484px; height: 439px;"></div>
                    </div>
                    <div class="simplebar-track simplebar-horizontal" style="visibility: visible;">
                        <div class="simplebar-scrollbar" style="width: 373px; display: block; transform: translate3d(0px, 0px, 0px);"></div>
                    </div>
                    <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                        <div class="simplebar-scrollbar" style="height: 328px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->push('scripts') ?>
<script src="../assets/js/pages/user.js"></script>
<?php $this->end() ?>


<!-- Modal -->
<div class="modal fade" id="userEdit" tabindex="-1" aria-labelledby="userEditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="userEditLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="userAdd" tabindex="-1" aria-labelledby="userAddLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="userAddLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<h1>User</h1>
<?php echo flash('created') ?>

<form action="/user/update" method="post">
    <?php echo flash('firstName', 'color:red') ?>
    <input type="text" name="firstName" value="Alexandre">

    <?php echo flash('lastName', 'color:red') ?>
    <input type="text" name="lastName" value="Cardoso">

    <?php echo getToken(); ?>

    <?php echo flash('email') ?>
    <input type="text" name="email" value="xandecar@hotmail.com">

    <?php echo flash('password') ?>
    <input type="password" name="password" value="123">

    <button type="submit">Atualizar</button>

</form>