<?php $this->layout('layout', ['title' => $title]) ?>

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
                        <h3><?= $title . (isset($count) ? " [" . $count . "]" : null) ?></h3>
                    </div>
                    
                    <div class="col d-flex justify-content-end">
                        <a href="/fornecedor" class="btn btn-primary" title="Voltar">Voltar</a>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                        <?= $this->insert('partials/flash'); ?>
                    </div>
            </div>
            <div class="card-body">
                <form action="/fornecedor/save" method="post">
                    <?php echo getToken();  ?>
                    <input type="hidden" name="id" value="<?= $this->e($fornecedor->id) ?>" />
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="nome">Nome da fornecedor</label>
                                <input type="text" class="form-control <?= isset($_SESSION['nome']) ? 'is-invalid' : '' ?>" name="nome" id="nome" aria-describedby="Nomefornecedor" value="<?= $this->e($fornecedor->nome) ?>" placeholder="Nome do Módulo">
                                <?php if (isset($_SESSION['nome'])) {
                                    echo flash('nome', 'field');
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="cnpj">CNPJ</label>
                                <input type="text" class="form-control <?= isset($_SESSION['cnpj']) ? 'is-invalid' : '' ?>" name="cnpj" id="cnpj" value="<?= $this->e($fornecedor->cnpj) ?>" placeholder="CNPJ">
                                <?php if (isset($_SESSION['cnpj'])) {
                                    echo flash('cnpj', 'field');
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="telefone">Telefone</label>
                                <input type="text" class="form-control <?= isset($_SESSION['telefone']) ? 'is-invalid' : '' ?>" name="telefone" value="<?= $this->e($fornecedor->telefone) ?>" placeholder="Telefone">
                                <?php if (isset($_SESSION['telefone'])) {
                                    echo flash('telefone', 'field');
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="email">E-mail</label>
                                <input type="text" class="form-control <?= isset($_SESSION['email']) ? 'is-invalid' : '' ?>" name="email" value="<?= $this->e($fornecedor->email) ?>" placeholder="E-mail">
                                <?php if (isset($_SESSION['email'])) {
                                    echo flash('email', 'field');
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="endereco">Endereço</label>
                                <input type="text" class="form-control <?= isset($_SESSION['endereco']) ? 'is-invalid' : '' ?>" name="endereco" value="<?= $this->e($fornecedor->endereco) ?>" placeholder="Endereço">
                                <?php if (isset($_SESSION['endereco'])) {
                                    echo flash('endereco', 'field');
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
<script src="<?= getenv('APP_URL') ?>/assets/js/pages/fornecedors.js"></script>
<?php $this->end() ?>
