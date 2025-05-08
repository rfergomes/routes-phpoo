<?php $this->layout('layouts/layout', ['title' => $title]) ?>

<?php $this->push('css') ?>
<link rel="stylesheet" href="<?= getenv('APP_URL') ?>/assets/css/pages/user.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<?php $this->end() ?>

<div class="row ">
    <!-- [ sample-page ] start -->
    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="card-header">
                <div class="row py-2">
                    <div class="col d-flex justify-content-start">
                        <h3><?= $title . (isset($count) ? " [" . $count . "]" : null) ?></h3>
                    </div>

                    <div class="col d-flex justify-content-end">
                        <a href="/ativo" class="btn btn-primary" title="Voltar">Voltar</a>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <?= $this->insert('partials/flash'); ?>
                </div>
            </div>
            <div class="card-body">
                <form action="/ativo/save" method="post">
                    <?php echo getToken();  ?>
                    <input type="hidden" name="id" value="<?= $this->e($ativo->id) ?>" />
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="equipamento_id">Equipamento</label>
                                <select name="equipamento_id" id="equipamento_id" class="form-select w-auto">
                                    <?php foreach ($equipamentos as $equipamento): ?>
                                    <option value="<?= $equipamento->id ?>"
                                        <?= $this->e($equipamento->id) === $this->e($ativo->equipamento_id) ? 'selected' : '' ?>>
                                        <?= $equipamento->nome; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset($_SESSION['equipamento_id'])) {
                                    echo flash('equipamento_id', 'field');
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="tipo_id">Tipo de Ativo</label>
                                <select name="tipo_id" id="tipo_id" class="form-select w-auto">
                                    <?php foreach ($tipo_ativos as $tipo): ?>
                                    <option value="<?= $tipo->id ?>"
                                        <?= $this->e($tipo->id) === $this->e($ativo->tipo_id) ? 'selected' : '' ?>>
                                        <?= $tipo->nome; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset($_SESSION['tipo_id'])) {
                                    echo flash('tipo_id', 'field');
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="localizacao_id">Localização</label>
                                <select name="localizacao_id" id="localizacao_id" class="form-select w-auto">
                                    <?php foreach ($localizacoes as $localizacao): ?>
                                    <option value="<?= $localizacao->id ?>"
                                        <?= $this->e($localizacao->id) === $this->e($ativo->localizacao_id) ? 'selected' : '' ?>>
                                        <?= $localizacao->nome; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset($_SESSION['localizacao_id'])) {
                                    echo flash('localizacao_id', 'field');
                                } ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="responsavel_id">Responsável</label>
                                <select name="responsavel_id" id="responsavel_id" class="form-select w-auto">
                                    <?php foreach ($responsaveis as $responsavel): ?>
                                    <option value="<?= $responsavel->id ?>"
                                        <?= $this->e($responsavel->id) === $this->e($ativo->responsavel_id) ? 'selected' : '' ?>>
                                        <?= $responsavel->nome;
                                            getOld('responsavel_nome'); ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset($_SESSION['responsavel_id'])) {
                                    echo flash('responsavel_id', 'field');
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="observacoes">Observações</label>
                                <input type="text"
                                    class="form-control <?= isset($_SESSION['observacoes']) ? 'is-invalid' : '' ?>"
                                    name="observacoes" value="<?= $this->e($ativo->observacoes) ?>"
                                    placeholder="observacoes">
                                <?php if (isset($_SESSION['observacoes'])) {
                                    echo flash('observacoes', 'field');
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer px-0">
                        <div class="text-start">
                            <button type="submit" class="btn btn-primary">Salvar Dados</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- [ sample-page ] end -->
</div>


<?php $this->push('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="<?= getenv('APP_URL') ?>/assets/js/plugins/bouncer.min.js"></script>
<script src="<?= getenv('APP_URL') ?>/assets/js/pages/form-validation.js"></script>
<script src="<?= getenv('APP_URL') ?>/assets/js/pages/ativos.js"></script>
<?php $this->end() ?>