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
                        <a href="/modulo" class="btn btn-primary" title="Voltar">Voltar</a>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                        <?= $this->insert('partials/flash'); ?>
                    </div>
            </div>
            <div class="card-body">
                <form action="/modulo/save" method="post">
                    <?php echo getToken();  ?>
                    <input type="hidden" name="id" value="<?= $this->e($modulo->id) ?>" />
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="nome">Nome do Módulo</label>
                                <input type="text" class="form-control <?= isset($_SESSION['nome']) ? 'is-invalid' : '' ?>" name="nome" id="nome" aria-describedby="NomeModulo" value="<?= $this->e($modulo->nome) ?>" placeholder="Nome do Módulo">
                                <?php if (isset($_SESSION['nome'])) {
                                    echo flash('nome', 'field');
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="descricao">Descrição</label>
                                <input type="text" class="form-control <?= isset($_SESSION['descricao']) ? 'is-invalid' : '' ?>" name="descricao" id="descricao" value="<?= $this->e($modulo->descricao) ?>" placeholder="Descrição">
                                <?php if (isset($_SESSION['descricao'])) {
                                    echo flash('descricao', 'field');
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="icone">Ícone</label>
                                <input type="text" class="form-control <?= isset($_SESSION['icone']) ? 'is-invalid' : '' ?>" name="icone" value="<?= $this->e($modulo->icone) ?>" placeholder="icone">
                                <?php if (isset($_SESSION['icone'])) {
                                    echo flash('icone', 'field');
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="rota">Rota</label>
                                <input type="text" class="form-control <?= isset($_SESSION['rota']) ? 'is-invalid' : '' ?>" name="rota" value="<?= $this->e($modulo->rota) ?>" placeholder="rota">
                                <?php if (isset($_SESSION['rota'])) {
                                    echo flash('rota', 'field');
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="tipo_permissao">Tipo de Permissão</label>
                                <select name="tipo_permissao" id="tipo_permissao" class="form-select w-auto">
                                    <?php foreach ($niveis as $nivel): ?>
                                        <option value="<?= $nivel->id ?>" <?= $this->e($nivel->id) == $this->e($modulo->tipo_permissao) ? 'selected' : '' ?>>
                                            <?= $nivel->nome ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
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
<script src="<?= getenv('APP_URL') ?>/assets/js/pages/modulos.js"></script>
<?php $this->end() ?>
