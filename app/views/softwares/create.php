<?php $this->layout('layouts/layout', ['title' => $title]) ?>

<?php $this->push('css') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<?php $this->end() ?>

<div class="row ">
    <!-- [ sample-page ] start -->
    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="card-header">
                <div class="row py-2">
                    <div class="col d-flex justify-content-start">
                        <h3><?= $this->e($title) ?></h3>
                    </div>
                    
                    <div class="col d-flex justify-content-end">
                        <a href="/software" class="btn btn-primary" title="Voltar">Voltar</a>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                        <?= $this->insert('partials/flash'); ?>
                    </div>
            </div>
            <div class="card-body">
                <form action="/software/save" method="post">
                    <?php echo getToken();  ?>
                    <input type="hidden" name="id" value="" />
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="nome">Nome do software</label>
                                <input type="text" class="form-control <?= isset($_SESSION['nome']) ? 'is-invalid' : '' ?>" name="nome" id="nome" aria-describedby="Nomesoftware" value="<?= $this->e(getOld('nome')) ?>" placeholder="Nome do Fabricante">
                                <?php if (isset($_SESSION['nome'])) {
                                    echo flash('nome', 'field');
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="versao">Versão</label>
                                <input type="text" class="form-control <?= isset($_SESSION['versao']) ? 'is-invalid' : '' ?>" name="versao" id="versao" value="<?= $this->e(getOld('versao')) ?>" placeholder="Versão">
                                <?php if (isset($_SESSION['versao'])) {
                                    echo flash('versao', 'field');
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="tipo_licenca">Tipo de Licença</label>
                                <input type="text" class="form-control <?= isset($_SESSION['tipo_licenca']) ? 'is-invalid' : '' ?>" name="tipo_licenca" value="<?= $this->e(getOld('tipo_licenca')) ?>" placeholder="Tipo">
                                <?php if (isset($_SESSION['tipo_licenca'])) {
                                    echo flash('tipo_licenca', 'field');
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="chave_licenca">Chave de Licença</label>
                                <input type="text" class="form-control <?= isset($_SESSION['chave_licenca']) ? 'is-invalid' : '' ?>" name="chave_licenca" value="<?= $this->e(getOld('chave_licenca')) ?>" placeholder="E-Chave de Licença">
                                <?php if (isset($_SESSION['chave_licenca'])) {
                                    echo flash('chave_licenca', 'field');
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="validade">Validade</label>
                                <input type="text" class="form-control <?= isset($_SESSION['validade']) ? 'is-invalid' : '' ?>" name="validade" value="<?= $this->e(getOld('validade')) ?>" placeholder="Validade">
                                <?php if (isset($_SESSION['validade'])) {
                                    echo flash('validade', 'field');
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="fabricante_id">Fabricante</label>
                                <select name="fabricante_id" id="fabricante_id" class="form-select w-auto">
                                    <option value="0" selected>Selecione um Fabricante</option>
                                    <?php foreach ($fabricantes as $fabricante): ?>
                                        <option value="<?= $fabricante->id ?>">
                                            <?= $fabricante->nome ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset($_SESSION['fabricante_id'])) {
                                    echo flash('fabricante_id', 'field');
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
<?php $this->end() ?>
