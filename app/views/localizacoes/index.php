<?php $this->layout('layouts/layout', ['title' => $title]) ?>

<div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-sm-12">
        <div class="card table-card user-profile-list">
            <div class="card-header py-1 bg-white">
                <div class="row py-3">
                    <div class="col-md-6">
                        <h3><?= $this->e($title); ?></h3>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <?php if (can($moduloId, 'adicionar')): ?>
                            <a href="/localizacao/create" class="btn btn-sm btn-primary" title="Cadastrar Usuário">Nova localizacao</a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="datatable-top py-0 ">
                    <div class="datatable-dropdown">

                        <form method="get" action="/localizacao" class="form-search d-flex">
                            <i class="ph-duotone ph-list-numbers icon-search"></i>
                            <select class="form-control datatable-selector" name="items">
                                <option value="5" <?= $itemPerPage == 5 ? 'selected' : '' ?>>5 Itens &nbsp;&nbsp;&nbsp; </option>
                                <option value="10" <?= $itemPerPage == 10 ? 'selected' : '' ?>>10 Itens &nbsp;&nbsp;&nbsp; </option>
                                <option value="15" <?= $itemPerPage == 15 ? 'selected' : '' ?>>15 Itens &nbsp;&nbsp;&nbsp; </option>
                                <option value="20" <?= $itemPerPage == 20 ? 'selected' : '' ?>>20 Itens &nbsp;&nbsp;&nbsp; </option>
                                <option value="25" <?= $itemPerPage == 25 ? 'selected' : '' ?>>25 Itens &nbsp;&nbsp;&nbsp; </option>
                            </select>
                            <button type="submit" class="btn btn-light-secondary btn-search"><i class="fas fa-check"></i></button>
                        </form>
                    </div>
                    <div class="datatable-search">
                        <form method="get" action="/localizacao" class="form-search d-flex">
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
                                    <th>#</th>
                                    <th>LOCALIZAÇÃO</th>
                                    <th>DESCRIÇÃO</th>
                                    <th>AÇÃO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $Cont = 0;
                                if (!empty($localizacoes)) :
                                    foreach ($localizacoes as $localizacao) : ?>
                                        <tr data-index="<?= $Cont; ?>">
                                            <td><?= $this->e($localizacao->id); ?></td>
                                            <td> <?= $this->e($localizacao->nome); ?></td>
                                            <td><?= $this->e($localizacao->descricao); ?></td>
                                            <td>
                                                <div class="overlay-edit">
                                                    <ul class="list-inline me-auto mb-0">
                                                        <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" aria-label="Visualizar" data-bs-original-title="Visualizar">
                                                            <a href="#" class="avtar avtar-xs btn-link-warning btn-pc-default btn-view"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#localizacaoModal"
                                                                data-nome="<?= $this->e($localizacao->nome); ?>"
                                                                data-cnpj="<?= $this->e($localizacao->descricao); ?>">
                                                                <i class="ti ti-eye f-18"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item align-bottom">
                                                            <a href="/localizacao/edit/<?= $this->e($localizacao->id); ?>" class="avtar avtar-xs btn-link-success btn-pc-default btn-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                                                                <i class="ti ti-edit-circle f-18"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" aria-label="Excluir" data-bs-original-title="Excluir">
                                                            <a href="/localizacao/delete/<?= $this->e($localizacao->id); ?>" class="avtar avtar-xs btn-link-danger btn-pc-default btn-delete">
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
                                        <td colspan="5" class="text-center text-danger">Nenhuma localizacao encontrado.</td>
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
<?= $this->insert('localizacoes/modal'); ?>
<?php $this->push('css') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<?php $this->end() ?>

<?php $this->push('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="<?= getenv('APP_URL') ?>/assets/js/pages/pg_user.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const viewButtons = document.querySelectorAll('.btn-view');

        viewButtons.forEach(button => {
            button.addEventListener('click', function() {
                const localizacao = this.getAttribute('data-nome');
                const cnpj = this.getAttribute('data-cnpj');
                const telefone = this.getAttribute('data-telefone');
                const email = this.getAttribute('data-email');
                const endereco = this.getAttribute('data-endereco');

                document.getElementById('modallocalizacao').textContent = localizacao || '-';
                document.getElementById('modalCnpj').textContent = cnpj || '-';
                document.getElementById('modalTelefone').textContent = telefone || '-';
                document.getElementById('modalEmail').textContent = email || '-';
                document.getElementById('modalEmailLink').setAttribute('href', 'mailto:' + email);
                document.getElementById('modalEndereco').textContent = endereco || '-';
            });
        });
    });
</script>
<?php $this->end() ?>