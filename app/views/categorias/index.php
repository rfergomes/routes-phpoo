<?php $this->layout('layout', ['title' => $title]) ?>

<div class="row">
    <div class="col-sm-12">
        <div class="card table-card">
            <div class="card-header py-3 bg-white">
                <div class="row">
                    <div class="col-md-6">
                        <h3><?= $title; ?></h3>
                    </div>
                    <?php if (can(1, 'adicionar')): ?>
                        <a href="/categoria/create" class="btn btn-primary" title="Cadastrar Categoria">Nova Categoria</a>
                    <?php endif; ?>
                </div>
                <div class="datatable-top pt-3">
                    <div class="datatable-dropdown">
                        <form action="/categoria" method="get">
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
                        <form method="get" action="/categoria" class="d-flex">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="search" placeholder="Pesquisar..." aria-label="Pesquisar..." aria-describedby="button-addon2">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <?= flash('success', 'toast') ?>
                <?= flash('error', 'alert') ?>
                <?= flash('success', 'alert') ?>
            </div>

            <div class="card-body table-card">
                <div class="datatable-wrapper datatable-loading no-footer searchable fixed-columns">
                    <div class="datatable-container">
                        <table class="table table-hover datatable-table" id="pc-dt-categorias">
                            <thead class="bg-dark">
                                <tr>
                                    <th style="color:white;">#</th>
                                    <th style="color:white;">Nome</th>
                                    <th class="text-center" style="color:white;">Status / Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($categorias)): ?>
                                    <tr>
                                        <td colspan="3" class="text-center">Nenhum registro encontrado.</td>
                                    </tr>
                                <?php else : ?>
                                    <?php $i = 0;
                                    foreach ($categorias as $cat): ?>
                                        <tr data-index="<?= $i++; ?>">
                                            <td><?= $cat->id; ?></td>
                                            <td><?= $cat->nome; ?></td>
                                            <td class="text-center">
                                                <span class="badge bg-light-<?= $cat->status ? 'success' : 'danger'; ?>">
                                                    <?= $cat->status ? 'ATIVO' : 'INATIVO'; ?>
                                                </span>
                                                <div class="overlay-edit">
                                                    <ul class="list-inline me-auto mb-0">
                                                        <li class="list-inline-item align-bottom">
                                                            <a href="/categoria/edit/<?= $cat->id; ?>" class="avtar avtar-xs btn-link-success btn-pc-default" title="Editar">
                                                                <i class="ti ti-edit-circle f-18"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item align-bottom">
                                                            <a href="/categoria/delete/<?= $cat->id; ?>" class="avtar avtar-xs btn-link-danger btn-pc-default btn-delete" title="Excluir">
                                                                <i class="ti ti-trash f-18"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
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
</div>

<?php $this->push('css') ?>
<link rel="stylesheet" href="<?= getenv('APP_URL') ?>/assets/css/pages/categoria.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<?php $this->end() ?>

<?php $this->push('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="<?= getenv('APP_URL') ?>/assets/js/pages/categoria.js"></script>
<?php $this->end() ?>