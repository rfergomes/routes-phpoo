<?php $this->layout('layout', ['title' => 'Nova Categoria']) ?>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Cadastrar Nova Categoria</h4>
            </div>
            <div class="card-body">
                <?= flash('error', 'alert') ?>
                <?= flash('success', 'toast') ?>
                <form action="/categoria/store" method="post" autocomplete="off">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome da Categoria</label>
                        <input type="text" name="nome" id="nome" class="form-control" required value="<?= getOld('nome'); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="1" selected>Ativo</option>
                            <option value="0">Inativo</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="/categoria" class="btn btn-secondary">Voltar</a>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
