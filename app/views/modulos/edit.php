<?php $this->layout('layout', ['title' => $title]) ?>

<?php $this->push('css') ?>
<link rel="stylesheet" href="<?= getenv('APP_URL') ?>/assets/css/pages/user.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<?php $this->end() ?>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Editar Módulo</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <a href="/modulos" class="btn btn-primary" title="Voltar">Voltar</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <?= flash('danger', 'alert') ?>
                <?= flash('success', 'alert') ?>

                <form action="/modulos/update/<?= $modulo['id'] ?>" method="post" autocomplete="off">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" name="nome" id="nome" class="form-control"
                               value="<?= getOld('nome') ?: $modulo['nome'] ?>">
                        <?= flash('nome', 'field') ?>
                    </div>

                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea name="descricao" id="descricao" class="form-control"><?= getOld('descricao') ?: $modulo['descricao'] ?></textarea>
                        <?= flash('descricao', 'field') ?>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->push('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="<?= getenv('APP_URL') ?>/assets/js/plugins/bouncer.min.js"></script>
<script src="<?= getenv('APP_URL') ?>/assets/js/pages/form-validation.js"></script>
<script src="<?= getenv('APP_URL') ?>/assets/js/pages/user.js"></script>
<?php $this->end() ?>
