<?php $this->layout('layouts/layout', ['title' => $title]) ?>

<div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-sm-12">
        <div class="card table-card user-profile-list">
            <div class="card-header py-1 bg-white">
                <div class="row py-3">
                    <div class="col-md-6">
                        <h3><?= $title . " [" . $count . "] " ?></h3>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <?php if (can($moduloId, 'adicionar')): ?>
                            <a href="/modulo/create" class="btn btn-sm btn-primary" title="Cadastrar Usuário">Novo Módulo</a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="datatable-top py-0 ">
                    <div class="datatable-dropdown">

                        <form method="get" action="/modulo" class="form-search d-flex">
                            <i class="ph-duotone ph-list-numbers icon-search"></i>
                            <select class="form-control datatable-selector" name="items">
                                <option value="5" <?= $itemPerPage == 5 ? 'selected' : '' ?>>5 Itens &nbsp;&nbsp;&nbsp; </option>
                                <option value="10" <?= $itemPerPage == 10 ? 'selected' : '' ?> >10 Itens &nbsp;&nbsp;&nbsp; </option>
                                <option value="15" <?= $itemPerPage == 15 ? 'selected' : '' ?>>15 Itens &nbsp;&nbsp;&nbsp; </option>
                                <option value="20" <?= $itemPerPage == 20 ? 'selected' : '' ?>>20 Itens &nbsp;&nbsp;&nbsp; </option>
                                <option value="25" <?= $itemPerPage == 25 ? 'selected' : '' ?>>25 Itens &nbsp;&nbsp;&nbsp; </option>
                            </select>
                            <button type="submit" class="btn btn-light-secondary btn-search"><i class="fas fa-check"></i></button>
                        </form>
                    </div>
                    <div class="datatable-search">

                        <form method="get" action="/modulo" class="form-search d-flex">
                            <i class="ph-duotone ph-magnifying-glass icon-search"></i>
                            <input type="search" name="search" class="form-control mr-3" placeholder="Pesquisar. . .">
                            <button type="submit" class="btn btn-light-secondary btn-search"><i class="fas fa-check"></i></button>
                        </form>

                    </div>
                </div>
                <?= $this->insert('partials/flash'); ?>
            </div>
            <div class="card-body table-card">
                <div class="datatable-wrapper datatable-loading no-footer searchable fixed-columns">
                    <div class="datatable-container">

                        <table class="table table-hover datatable-table" id="pc-dt-simple">
                            <thead class="bg-dark">
                                <tr>
                                    <th style="width: 5.172413793103448%; color:white;">#</th>
                                    <th style="width: 20.39080459770115%; color:white;">MÓDULO</th>
                                    <th style="width: 38.689655172413794%; color:white;">DESCRIÇÃO</th>
                                    <th style="width: 16.310344827586206%; color:white;">ÍCONE</th>
                                    <th style="width: 18.310344827586206%; color:white;">ROTA</th>
                                    <th class="text-center" style="width: 18.436781609195402%; color:white;">AÇÃO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $Cont = 0;
                                if (!empty($modulos)) :
                                    foreach ($modulos as $modulo) : ?>
                                        <tr data-index="<?= $Cont; ?>">
                                            <td><?= $this->e($modulo->id); ?></td>
                                            <td><?= $this->e($modulo->nome); ?></td>
                                            <td><?= $this->e($modulo->descricao); ?></td>
                                            <td>
                                                <div class="d-inline-block align-middle">
                                                    <i class="fa fa-<?= $this->e($modulo->icone) ?>"></i>
                                                    <div class="d-inline-block">
                                                        <h6 class="m-b-0"><?= $this->e($modulo->icone); ?></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="m-0"><?= $this->e($modulo->rota); ?></p>
                                            </td>
                                            <td class="text-center">

                                                <div class="overlay-edit">
                                                    <ul class="list-inline me-auto mb-0">
                                                        <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" aria-label="Visualizar" data-bs-original-title="Visualizar">
                                                            <a href="usuario/read" class="avtar avtar-xs btn-link-warning btn-pc-default" data-bs-toggle="modal" data-bs-target="#userModal">
                                                                <i class="ti ti-eye f-18"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item align-bottom">
                                                            <a href="/modulo/edit/<?= $this->e($modulo->id); ?>" class="avtar avtar-xs btn-link-success btn-pc-default" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                                                                <i class="ti ti-edit-circle f-18"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" aria-label="Excluir" data-bs-original-title="Excluir">
                                                            <a href="/modulo/delete/<?= $this->e($modulo->id); ?>" class="avtar avtar-xs btn-link-danger btn-pc-default btn-delete">
                                                                <i class="ti ti-trash f-18"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php $Cont++;
                                    endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-danger">Nenhum módulo encontrado.</td>
                                    </tr>
                                <?php endif; ?>
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
<script src="<?= getenv('APP_URL') ?>/assets/js/pages/pg_modulo.js"></script>
<?php $this->end() ?>