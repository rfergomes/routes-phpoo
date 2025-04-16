<?php $this->layout('layouts/layout', ['title' => $title]) ?>

<div class="row">
    <div class="col-sm-12">
        <div class="card table-card user-profile-list">
            <div class="card-header py-3 bg-white">
                <div class="row">
                    <div class="col-md-6">
                        <h3><?= $title; ?></h3>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <div class="d-flex align-items-center">
                            <!--<a href="/permissao/create" class="btn btn-primary btn-sm me-2">Adicionar Permissão</a>-->
                        </div>
                    </div>
                </div>
                <div class="datatable-top pt-3">
                    <div class="datatable-dropdown">
                        <label>Nível de Permissão</label>
                        <form id="permissoesForm" action="/permissao" method="get">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="input-group">
                                    <select name="nivel_id" id="nivelSelect" class="form-select w-auto">
                                        <?php foreach ($niveis as $nivel): ?>
                                            <option value="<?= $nivel->id ?>" <?= ($nivel->id == $nivel_id) ? 'selected' : '' ?>>
                                                <?= $nivel->nome ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button class="btn btn-outline-secondary" type="submit">OK</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="datatable-search">
                        <?= $this->insert('partials/flash'); ?>
                    </div>
                </div>
            </div>
            <div class="card-body table-card">
                <div class="datatable-wrapper datatable-loading no-footer searchable fixed-columns">
                    <div class="datatable-container">

                        <form action="/permissao/save" method="post">
                            <?php echo getToken(); ?>
                            <input type="hidden" name="nivel_id" value="<?= isset($permissoes[0]) ? $permissoes[0]->nivel_id : "" ?>">
                            <table class="table datatable-table" id="pc-dt-simple">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th>MÓDULO</th>
                                        <th>VER</th>
                                        <th>EDITAR</th>
                                        <th>CADASTRAR</th>
                                        <th>EXCLUIR</th>
                                    </tr>
                                </thead>
                                <?php if (!empty($permissoes)) : ?>
                                    <?php foreach ($permissoes as $permissao) : ?>
                                        <?php
                                        $tipo = [
                                            'ver' => $permissao->pode_ver ?? false,
                                            'editar' => $permissao->pode_editar ?? false,
                                            'adicionar' => $permissao->pode_adicionar ?? false,
                                            'excluir' => $permissao->pode_excluir ?? false,
                                        ];
                                        ?>
                                        <tr>
                                            <td class="text-start"><?= $permissao->modulo_nome ?></td>
                                            <?php foreach (['ver', 'editar', 'adicionar', 'excluir'] as $acao): ?>
                                                <td>
                                                    <!--<input type="checkbox"
                                                        name="permissoes[<?= $permissao->modulo_id ?>][<?= $acao ?>]"
                                                        <?= $tipo[$acao] ? 'checked' : '' ?> class="form-check-input">-->

                                                    <div class="form-check form-switch custom-switch-v1 mb-2">
                                                        <input type="hidden"
                                                            name="permissoes[<?= $permissao->modulo_id ?>][<?= $acao ?>]"
                                                            value="0">
                                                        <input type="checkbox"
                                                            class="form-check-input input-success"
                                                            name="permissoes[<?= $permissao->modulo_id ?>][<?= $acao ?>]"
                                                            <?= $tipo[$acao] ? 'checked' : '' ?>>
                                                    </div>
                                                </td>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Nenhum módulo encontrado.</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                            <div class="card-footer bg-white">
                                <div class="text-end mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i>&nbsp;&nbsp;Salvar Permissões
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div> <!-- fim col -->
</div> <!-- fim row -->

<?php $this->push('css') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<?php $this->end() ?>

<?php $this->push('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const moduloSelect = document.getElementById("moduloSelect");
        const checkboxes = document.querySelectorAll(".perm");

        function atualizarNomes() {
            const moduloId = moduloSelect.value;
            checkboxes.forEach(cb => {
                const acao = cb.dataset.acao;
                cb.name = `dados[${moduloId}][${acao}]`;
            });
        }
        atualizarNomes();
        moduloSelect.addEventListener("change", () => {
            atualizarNomes();
        });
    });
</script>

<?php $this->end() ?>