
<?php $this->layout('layouts/layout', ['title' => $title]) ?>

<div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-sm-12">
        <div class="card table-card user-profile-list">
            <div class="card-header py-3 bg-white">
                <div class="row ">
                    <div class="col-md-6">
                        <h3><?= $title; ?></h3>
                    </div>
                    <?php if (can('usuarios', 'adicionar')): ?>
                        <a href="/usuario/create" class="btn btn-primary" title="Cadastrar Usuário">Novo Usuário</a>
                    <?php endif; ?>
                </div>
                <div class="datatable-top pt-3">
                    <div class="datatable-dropdown">
                        <form action="/usuario/" method="get">
                            <div class="form-group">
                                <div class="input-group">
                                    <select class="form-control datatable-selector" name="items">
                                        <option value="5" selected="">5</option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                        <option value="25">25</option>
                                    </select>
                                    <button class="btn btn-outline-secondary" type="submit">OK</button>
                                </div>
                                <small>Itens por página</small>
                            </div>
                        </form>
                    </div>
                    <div class="datatable-search">
                        <form method="get" action="/usuario/" class="d-flex">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="search" placeholder="Pesquisar..." aria-label="Pesquisar..." aria-describedby="button-addon2">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
                // Disparar toast (será mostrado após o refresh via JS)
                echo flash('success', 'toast');
                ?>
                <?php if (isset($_SESSION['danger'])) {
                    echo flash('error', 'alert');
                } ?>
                <?php if (isset($_SESSION['success'])) {
                    echo flash('success', 'alert');
                } ?>
            </div>
            <div class="card-body table-card">
                <div class="datatable-wrapper datatable-loading no-footer searchable fixed-columns">
                    <div class="datatable-container">

                        <table class="table table-hover datatable-table" id="pc-dt-simple">
                            <thead class="bg-dark">
                                <tr>
                                    <th style="width: 5.172413793103448%; color:white;">#</th>
                                    <th style="width: 30.39080459770115%; color:white;">NOME</th>
                                    <th style="width: 26.689655172413794%; color:white;">USUÁRIO / TIPO</th>
                                    <th style="width: 19.310344827586206%; color:white;">ÚLTIMO LOGIN</th>
                                    <th class="text-center" style="width: 18.436781609195402%; color:white;">STATUS / AÇÃO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $Cont = 0;
                                foreach ($users as $user) : ?>
                                    <tr data-index="<?= $Cont; ?>">
                                        <td>
                                            <?= $user->id; ?>
                                        </td>
                                        <td><?= $user->name; ?></td>
                                        <td>
                                            <div class="d-inline-block align-middle">
                                                <img src="<?= getenv('APP_URL') . '/assets/images/user/' . $user->image ?? 'default-avatar.png'  ?>" alt="user image"
                                                    class="img-radius align-top m-r-15" style="width:40px;">
                                                <div class="d-inline-block">
                                                    <h6 class="m-b-0"><?= $user->username; ?></h6>
                                                    <p class="m-b-0 text-primary"><?= $user->group_name; ?></p>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <p class="m-0"><?= $user->last_login; ?></p>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-light-<?= $user->status === 1 ? 'success' : 'danger'; ?>"><?= $user->status === 1 ? 'ATIVO' : 'INATIVO'; ?></span>
                                            <div class="overlay-edit">
                                                <ul class="list-inline me-auto mb-0">
                                                    <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" aria-label="Visualizar" data-bs-original-title="Visualizar">
                                                        <a href="usuario/read" class="avtar avtar-xs btn-link-warning btn-pc-default" data-bs-toggle="modal" data-bs-target="#userModal">
                                                            <i class="ti ti-eye f-18"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item align-bottom">
                                                        <a href="/usuario/edit/<?= $user->id; ?>" class="avtar avtar-xs btn-link-success btn-pc-default" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                                                            <i class="ti ti-edit-circle f-18"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" aria-label="Excluir" data-bs-original-title="Excluir">
                                                        <a href="/usuario/delete/<?= $user->id; ?>" class="avtar avtar-xs btn-link-danger btn-pc-default btn-delete">
                                                            <i class="ti ti-trash f-18"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php $Cont++;
                                endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="datatable-bottom">
                            <?= $pagination->getFootPage(); ?>
                            <nav class="datatable-pagination">
                                <?= $pagination->links(); ?>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ sample-page ] end -->
</div>

<?php $this->push('css') ?>
<link rel="stylesheet" href="<?= getenv('APP_URL') ?>/assets/css/pages/user.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<?php $this->end() ?>

<?php $this->push('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="<?= getenv('APP_URL') ?>/assets/js/pages/pg_user.js"></script>
<?php $this->end() ?>

<!-- Start Modal -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="userModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <!-- Alertas Dinâmicos -->
                <?php $this->insert('partials/flash'); ?>
                <div id="alerts-container">
                    <div class="alert alert-danger d-none" id="alert" role="alert">
                        <strong>Erro!</strong> <span id="alertMessage"></span>
                    </div>
                    <div class="alert alert-success d-none" id="success" role="alert">
                        <strong>Sucesso!</strong> <span id="successMessage"></span>
                    </div>
                    <div class="alert alert-warning d-none" id="warning" role="alert">
                        <strong>Atenção!</strong> <span id="warningMessage"></span>
                    </div>
                    <div class="alert alert-info d-none" id="info" role="alert">
                        <strong>Informação!</strong> <span id="infoMessage"></span>
                    </div>
                </div>

                <!-- Formulário -->
                <form action="/user/save" method="post" id="userForm" name="userForm" enctype="multipart/form-data">
                    <?php echo getToken(); ?>
                    <input type="hidden" name="id" id="id">
                    <!-- Avatar personalizável -->
                    <div class="avatar-container text-center mb-3">
                        <label for="image" class="avatar-label d-block">
                            <img class="rounded-circle img-fluid wid-90 img-thumbnail" id="imagePreview"
                                src="<?= getenv('APP_URL') ?>/assets/images/user/default-avatar.png" alt="Avatar">
                            <span class="avatar-text d-block mt-2 text-primary">Trocar Avatar</span>
                        </label>
                        <input type="file" name="image" id="image" class="form-control d-none" accept="image/*">
                    </div>

                    <!-- Campos de Entrada -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nome completo">
                        <div class="error-message" id="error-name"></div> <!-- Atualizei o ID do erro para corresponder ao campo -->
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Seu E-mail">
                        <div class="error-message" id="error-email"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="username" class="form-label">Usuário</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Nome de Usuário">
                                <div class="input-group-text">@</div>
                                <div class="error-message" id="error-username"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha"
                                placeholder="Senha">
                            <div class="error-message" id="error-senha"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="user_level" class="form-label">Grupo</label>
                            <select class="form-select" id="user_level" name="user_level">
                                <option value="1">Administrador</option>
                                <option value="2">Usuário</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="1">Ativo</option>
                                <option value="0">Inativo</option>
                            </select>
                        </div>
                    </div>

                    <!-- Rodapé do Modal -->
                    <div class="modal-footer mt-4">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- End Modal -->
