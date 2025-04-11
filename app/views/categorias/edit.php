<?php $this->layout('layout', ['title' => 'Editar Categoria']) ?>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Editar Categoria</h4>
            </div>
            <div class="card-body">
                <?= flash('error', 'alert') ?>
                <?= flash('success', 'toast') ?>
                <form action="/categoria/update/<?= $categoria->id ?>" method="post" autocomplete="off">
                    <input type="hidden" name="id" value="<?= $categoria->id ?>">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome da Categoria</label>
                        <input type="text" name="nome" id="nome" class="form-control" required value="<?= getOld('nome', $categoria->nome); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="1" <?= $categoria->status ? 'selected' : '' ?>>Ativo</option>
                            <option value="0" <?= !$categoria->status ? 'selected' : '' ?>>Inativo</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="/categoria" class="btn btn-secondary">Voltar</a>
                        <button type="submit" class="btn btn-success">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
