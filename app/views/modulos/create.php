<?php $this->layout('layout', ['title' => $title]) ?>

<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0">Módulos</h5>
            <a href="/modulos/create" class="btn btn-primary">Novo Módulo</a>
        </div>

        <?= flash('success', 'alert') ?>
        <?= flash('danger', 'alert') ?>

        <div class="card">
            <div class="card-body p-0">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Novo Módulo</h5>
                    <a href="/modulos" class="btn btn-secondary">Voltar</a>
                </div>

                <?= flash('danger', 'alert') ?>
                <?= flash('success', 'alert') ?>

                <form action="/modulos/store" method="post" autocomplete="off">
                    <div class="card">
                        <div class="card-body">

                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" name="nome" id="nome" class="form-control" value="<?= getOld('nome') ?>">
                                <?= flash('nome', 'field') ?>
                            </div>

                            <div class="mb-3">
                                <label for="descricao" class="form-label">Descrição</label>
                                <textarea name="descricao" id="descricao" class="form-control"><?= getOld(key: 'descricao'); ?></textarea>
                                <?= flash('descricao', 'field') ?>
                            </div>

                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->push('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<?php $this->end() ?>