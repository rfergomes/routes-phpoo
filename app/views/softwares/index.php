<?php $this->layout('layouts/layout', ['title' => $title]) ?>

<div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-sm-12">
        <div class="card table-card user-profile-list">
            <div class="card-header py-1 bg-white">
                <div class="row py-3">
                    <div class="col-md-6">
                        <h3><?= $title ?></h3>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <?php if (can($moduloId, 'adicionar')): ?>
                            <a href="/software/create" class="btn btn-sm btn-primary" title="Cadastrar Usuário">Nova software</a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="datatable-top py-0 ">
                    <div class="datatable-dropdown">

                        <form method="get" action="/software" class="form-search d-flex">
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
                        <form method="get" action="/software" class="form-search d-flex">
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
                                    <th>SOFTWARE</th>
                                    <th>VERSÃO</th>
                                    <th>TIPO</th>
                                    <th>STATUS</th>
                                    <th>AÇÃO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $Cont = 0;
                                if (!empty($softwares)) :
                                    foreach ($softwares as $software) : ?>
                                        <tr data-index="<?= $Cont; ?>">
                                            <td><?= $this->e($software->id); ?></td>
                                            <td> <?= $this->e($software->nome); ?></td>
                                            <td><?= $this->e($software->versao); ?></td>
                                            <td><?= $this->e($software->tipo_licenca); ?></td>
                                            <td><?= $this->e($software->status); ?></td>
                                            <td>
                                                <div class="overlay-edit">
                                                    <ul class="list-inline me-auto mb-0">
                                                        <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" aria-label="Visualizar" data-bs-original-title="Visualizar">
                                                            <a href="#" class="avtar avtar-xs btn-link-warning btn-pc-default btn-view"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#softwareModal"
                                                                data-nome="<?= $this->e($software->nome); ?>"
                                                                data-versao="<?= $this->e($software->versao); ?>"
                                                                data-tipo_licenca="<?= $this->e($software->tipo_licenca); ?>"
                                                                data-chave_licenca="<?= $this->e($software->chave_licenca); ?>"
                                                                data-validade="<?= $this->e($software->validade); ?>"
                                                                data-equipamento_id="<?= $this->e($software->equipamento_id); ?>"
                                                                data-fornecedor_id="<?= $this->e($software->fornecedor_id); ?>"
                                                                data-status="<?= $this->e($software->status); ?>"
                                                                data-observacoes="<?= $this->e($software->observacoes); ?>">
                                                                <i class="ti ti-eye f-18"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item align-bottom">
                                                            <a href="/software/edit/<?= $this->e($software->id); ?>" class="avtar avtar-xs btn-link-success btn-pc-default btn-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                                                                <i class="ti ti-edit-circle f-18"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" aria-label="Excluir" data-bs-original-title="Excluir">
                                                            <a href="/software/delete/<?= $this->e($software->id); ?>" class="avtar avtar-xs btn-link-danger btn-pc-default btn-delete">
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
                                        <td colspan="5" class="text-center text-danger">Nenhuma software encontrado.</td>
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
<?= $this->insert('softwares/modal'); ?>
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
                const software = this.getAttribute('data-nome');
                const versao = this.getAttribute('data-versao');
                const tipo_licenca = this.getAttribute('data-tipo_licenca');
                const chave_licenca = this.getAttribute('data-chave_licenca');
                const validade = this.getAttribute('data-validade');
                const equipamento_id = this.getAttribute('data-equipamento_id');
                const fornecedor_id = this.getAttribute('data-fornecedor_id');
                const status = this.getAttribute('data-status');
                const observacoes = this.getAttribute('data-observacoes');

                document.getElementById('modalSoftware').textContent = software || '-';
                document.getElementById('modalVersao').textContent = versao || '-';
                document.getElementById('modalTipoLicenca').textContent = tipo_licenca || '-';
                document.getElementById('modalChaveLicenca').textContent = chave_licenca || '-';
                document.getElementById('modalValidade').textContent = validade || '-';
                document.getElementById('modalEquipamentoId').textContent = equipamento_if || '-';
                document.getElementById('modalFornecedorId').textContent = fornecedor_id || '-';
                document.getElementById('modalStatus').textContent = status || '-';
                document.getElementById('modalObservacoes').textContent = observacoes || '-';
            });
        });
    });
</script>
<?php $this->end() ?>