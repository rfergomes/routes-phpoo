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
                        <h3><?= $title ?></h3>
                    </div>
                    
                    <div class="col d-flex justify-content-end">
                        <a href="/equipamento" class="btn btn-primary" title="Voltar">Voltar</a>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                        <?= $this->insert('partials/flash'); ?>
                    </div>
            </div>
            <div class="card-body">
                <form action="/equipamento/save" method="post">
                    <?php echo getToken();  ?>
                    <input type="hidden" name="id" value="<?= $this->e($equipamento->id) ?>" />
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="nome">Nome do Equipamento</label>
                                <input type="text" class="form-control <?= isset($_SESSION['nome']) ? 'is-invalid' : '' ?>" name="nome" id="nome" aria-describedby="NomeEquipamento" value="<?= $this->e($equipamento->nome) ?>" placeholder="Nome do Equipamento">
                                <?php if (isset($_SESSION['nome'])) {
                                    echo flash('nome', 'field');
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="modelo">Modelo</label>
                                <input type="text" class="form-control <?= isset($_SESSION['modelo']) ? 'is-invalid' : '' ?>" name="modelo" id="modelo" value="<?= $this->e($equipamento->modelo) ?>" placeholder="Modelo">
                                <?php if (isset($_SESSION['modelo'])) {
                                    echo flash('modelo', 'field');
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="numero_serie">Número de Série</label>
                                <input type="text" class="form-control <?= isset($_SESSION['numero_serie']) ? 'is-invalid' : '' ?>" name="numero_serie" id="numero_serie" value="<?= $this->e($equipamento->numero_serie) ?>" placeholder="Nº de Série">
                                <?php if (isset($_SESSION['numero_serie'])) {
                                    echo flash('numero_serie', 'field');
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="service_tag">Service Tag</label>
                                <input type="text" class="form-control <?= isset($_SESSION['service_tag']) ? 'is-invalid' : '' ?>" name="service_tag" id="service_tag" value="<?= $this->e($equipamento->service_tag) ?>" placeholder="Service Tag">
                                <?php if (isset($_SESSION['service_tag'])) {
                                    echo flash('service_tag', 'field');
                                } ?>
                            </div>
                        </div>                                              
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="fabricante">Fabricante</label>
                                <select name="fabricante_id" id="fabricante" class="form-select w-auto">
                                    <?php foreach ($fabricantes as $fabricante): ?>
                                        <option value="<?= $fabricante->id ?>" <?= $fabricante->id == $equipamento->fabricante_id ? 'selected' : '' ?>>
                                            <?= $fabricante->nome ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>                       
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="fornecedor">Fornecedor</label>
                                <select name="fornecedor_id" id="fornecedor" class="form-select w-auto">
                                    <?php foreach ($fornecedores as $fornecedor): ?>
                                        <option value="<?= $fornecedor->id ?>" <?= $fornecedor->id == $equipamento->fornecedor_id ? 'selected' : '' ?>>
                                            <?= $fornecedor->nome ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>                       
                        <div class="col-md-6">
                            <label class="form-label" for="situacao_id">Ativo</label>
                            <div class="form-group form-check form-switch custom-switch-v1 mb-2">  
                                <input type="hidden" name="situacao_id" id="situacao_id" value="false">                                                   
                                <input type="checkbox"
                                    class="form-check-input input-success"
                                    name="situacao_id" id="situacao_id"
                                    <?= $this->e($equipamento->situacao_id) == true ? 'checked' : '' ?> value="<?= $this->e($equipamento->situacao_id) ? true : false ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="observacao">Observacao</label>
                                <input type="text" class="form-control <?= isset($_SESSION['observacao']) ? 'is-invalid' : '' ?>" name="observacao" id="observacao" value="<?= $this->e($equipamento->observacao) ?>" placeholder="Observacao">
                                <?php if (isset($_SESSION['observacao'])) {
                                    echo flash('observacao', 'field');
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
<script src="<?= getenv('APP_URL') ?>/assets/js/pages/equipamentos.js"></script>
<script>
    $(document).ready(function() {
        $('input[type="checkbox"]').change(function() {
            if ($(this).prop('checked')) {
            $(this).val('true');
            } else {
            $(this).val('false');
            }
        });
    });
</script>
<?php $this->end() ?>
