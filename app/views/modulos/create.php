<?php $this->layout('layouts/layout', ['title' => $title]) ?>

<?php $this->push('css') ?>
<link rel="stylesheet" href="<?= getenv('APP_URL') ?>/assets/css/pages/modulo.css">
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
                    <input type="hidden" name="id" value="" />
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="nome">Nome do Módulo</label>
                                <input type="text" class="form-control <?= isset($_SESSION['nome']) ? 'is-invalid' : '' ?>" name="nome" id="nome" aria-describedby="NomeModulo" value="<?= getOld('nome') ?? ''?>" placeholder="Nome do Módulo">
                                <?php if (isset($_SESSION['nome'])) {
                                    echo flash('nome', 'field');
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="descricao">Descrição</label>
                                <input type="text" class="form-control <?= isset($_SESSION['descricao']) ? 'is-invalid' : '' ?>" name="descricao" id="descricao" value="<?= !empty(getOld('descricao')) ? $this->e(getOld('descricao')) : ''?>" placeholder="Descrição">
                                <?php if (isset($_SESSION['descricao'])) {
                                    echo flash('descricao', 'field');
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="icone">Ícone</label>
                                <input type="text" class="form-control <?= isset($_SESSION['icone']) ? 'is-invalid' : '' ?>" name="icone" value="<?= !empty(getOld('icone')) ? $this->e(getOld('icone')) : '' ?>" placeholder="icone">
                                <?php if (isset($_SESSION['icone'])) {
                                    echo flash('icone', 'field');
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="rota">Rota</label>
                                <input type="text" class="form-control <?= isset($_SESSION['rota']) ? 'is-invalid' : '' ?>" name="rota" value="<?= !empty(getOld('rota')) ? $this->e(getOld('rota')) : '' ?>" placeholder="rota">
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
                                        <option value="<?= $nivel->id ?>" <?= $this->e($nivel->id) === getOld('tipo_permissao') ? 'selected' : ''?>>
                                            <?= $nivel->nome; getOld('tipo_permissao'); ?> 
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="menu_id">Grupo de menu</label>
                                <select name="menu_id" id="menu_id" class="form-select w-auto">
                                    <?php foreach ($menus as $menu): ?>
                                        <option value="<?= $menu->id ?>" <?= $this->e($menu->id) === getOld('menu_id') ? 'selected' : ''?>>
                                            <?= $menu->nome; getOld('menu_id'); ?> 
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
                <pre><?php print_r($_SESSION['old']);?></pre>
                <pre><?= $_SESSION['old']['nome'];?></pre>
                <pre><?= getOld('tipo_permissao');?></pre>
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