<?php $this->layout('layouts/layout', ['title' => $title]) ?>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5><?= $title; ?>s</h5>
            </div>
            <div class="card-body">
                <form action="/permissao/save" method="post">
                <?php echo getToken(); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="nivelSelect">Níveis de Permissão</label>
                                <select name="nivel_id" id="nivelSelect" class="form-select w-auto">
                                    <?php foreach ($niveis as $nivel): ?>
                                        <option value="<?= $nivel->id ?>">
                                            <?= $nivel->nome ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="moduloSelect">Módulos do Sistema</label>
                                <select name="modulo_id" id="moduloSelect" class="form-select w-auto">
                                    <?php foreach ($modulos as $modulo): ?>
                                        <option value="<?= $modulo->id ?>">
                                            <?= $modulo->nome ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <div class="form-group mb-0">
                                <label class="d-block text-muted my-3">Permissões para:</label>
                                <div class="form-check form-switch custom-switch-v1 form-check-inline">
                                    <input type="checkbox" class="form-check-input input-primary perm" id="ver" data-acao="ver">
                                    <label class="form-check-label" for="ver">VER</label>
                                </div>
                                <div class="form-check form-switch custom-switch-v1 form-check-inline">
                                    <input type="checkbox" class="form-check-input input-primary perm" id="editar" data-acao="editar">
                                    <label class="form-check-label" for="editar">EDITAR</label>
                                </div>
                                <div class="form-check form-switch custom-switch-v1 form-check-inline">
                                    <input type="checkbox" class="form-check-input input-primary perm" id="adicionar" data-acao="adicionar">
                                    <label class="form-check-label" for="adicionar">ADICIONAR</label>
                                </div>
                                <div class="form-check form-switch custom-switch-v1 form-check-inline">
                                    <input type="checkbox" class="form-check-input input-primary perm" id="excluir" data-acao="excluir">
                                    <label class="form-check-label" for="excluir">EXCLUIR</label>
                                </div>

                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="card-footer ">
                        <button class="btn btn-primary me-2">Salvar</button>
                        <button type="reset" class="btn btn-light">Limpar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- [ form-element ] end -->
</div>
<?php $this->push('css') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<?php $this->end() ?>

<?php $this->push('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<?php $this->end() ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const moduloSelect = document.getElementById("moduloSelect");
        const checkboxes = document.querySelectorAll(".perm");

        function atualizarNomes() {
            const moduloId = moduloSelect.value;
            checkboxes.forEach(cb => {
                const acao = cb.dataset.acao;
                cb.name = `permissoes[${moduloId}][${acao}]`;
            });
        }

        // Atualiza ao carregar e ao trocar o módulo
        atualizarNomes();
        moduloSelect.addEventListener("change", atualizarNomes);
    });
</script>