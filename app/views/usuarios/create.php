<?php $this->layout('layouts/layout', ['title' => $title]) ?>

<?php $this->push('css') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="<?= getenv('APP_URL') ?>/assets/css/pages/user.css">
<?php $this->end() ?>

<?php $this->push('scripts') ?>
<script src="<?= getenv('APP_URL') ?>/assets/js/plugins/bouncer.min.js"></script>
<script src="<?= getenv('APP_URL') ?>/assets/js/pages/form-validation.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="<?= getenv('APP_URL') ?>/assets/js/pages/user.js"></script>
<?= isset($_SESSION['danger']) ? flash('danger', 'toast') : '' ?>
<?= isset($_SESSION['success']) ? flash('success', 'toast') : '' ?>
<?php $this->end() ?>

<div class="row">
    <!-- [ form-element ] start -->
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="row ">
                    <div class="col-md-6">
                        <h4>Alterar dados do usuário</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end"> <!-- Flexbox alinhando à direita -->
                        <a href="/usuario" class="btn btn-primary" title="Voltar">Voltar</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="/usuario/save" method="post" enctype="multipart/form-data" class="validate-me" data-validate="" novalidate="true">
                    <?php echo getToken(); ?>
                    <input type="hidden" name="id" id="id" value="<?= isset($user[0]->id) ? $user[0]->id : ''; ?>">
                    <!-- Avatar personalizável -->
                    <!--<div class="avatar-container text-center mb-3">
                        <label for="image" class="avatar-label d-block">
                            <img class="rounded-circle img-fluid wid-90 img-thumbnail" id="imagePreview"
                                src="<?= isset($user[0]->image) ? getenv('APP_URL') . '/assets/images/user/' . $user[0]->image : getenv('APP_URL') . '/assets/images/user/default-avatar.png'; ?>" alt="Avatar">
                            <span class="avatar-text d-block mt-2 text-primary">Trocar Avatar</span>
                        </label>
                        <input type="file" name="image" id="image" class="form-control d-none" accept="image/*">
                        <small id="file-error-msg" class="form-text text-danger">
                            <div class="error-message" id="bouncer-error_file"><?php echo flash('image') ?></div>
                        </small>
                    </div>-->

                    <div class="row g-3">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control <?= isset($_SESSION['name']) ? 'error' : '' ?>" name="name" id="name" required placeholder="Digite seu nome completo" value="<?= getOld('name'); ?>">
                                <?php if (isset($_SESSION['name'])) {
                                    echo flash('name', 'field');
                                } ?>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control <?= isset($_SESSION['email']) ? 'is-invalid' : '' ?>" name="email" id="email" required placeholder="Digite seu email" value="<?= getOld('email'); ?>">
                                <?php if (isset($_SESSION['email'])) {
                                    echo flash('email', 'field');
                                } ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label">Usuário</label>
                                <input type="text" class="form-control <?= isset($_SESSION['username']) ? 'is-invalid' : '' ?>" name="username" id="username" required placeholder="Digite seu usuário" value="<?= getOld('username'); ?>">
                                <?php if (isset($_SESSION['username'])) {
                                    echo flash('username', 'field');
                                } ?>
                            </div>
                        </div>

                    </div>
                    <div class="row g-3">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label">Senha</label>
                                <div class="input-group ">
                                    <span class="input-group-text "><i class="feather icon-lock"></i></span>
                                    <input type="password" class="form-control <?= isset($_SESSION['senha']) ? 'is-invalid' : '' ?>" name="senha" id="senha" placeholder="Digite sua senha">
                                </div>
                                <?php if (isset($_SESSION['senha'])) {
                                    echo flash('senha', 'field');
                                } ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="user_level" class="form-label">Grupo</label>
                            <select class="form-select <?= isset($_SESSION['user_level']) ? 'is-invalid' : '' ?>" id="user_level" name="user_level">
                                <option value="">Selecione um grupo</option>
                                <option value="1" <?= getOld('user_level') == 1 ? 'selected' : '' ?>>Administrador</option>
                                <option value="2" <?= getOld('user_level') == 2 ? 'selected' : '' ?>>Usuário</option>
                            </select>
                            <?php if (isset($_SESSION['user_level'])) {
                                echo flash('user_level', 'field');
                            } ?>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select <?= isset($_SESSION['status']) ? 'is-invalid' : '' ?>" id="status" name="status">
                                <option value="">Selecione um Status</option>
                                <option value="0" <?= getOld('status') == '0' ? 'selected' : '' ?>>Inativo</option>
                                <option value="1" <?= getOld('status') == '1' ? 'selected' : '' ?>>Ativo</option>
                            </select>
                            <?php if (isset($_SESSION['status'])) {
                                echo flash('status', 'field');
                            } ?>
                        </div>
                        <small id="file-error-msg" class="form-text text-danger">
                            <div class="error-message" id="bouncer-error_file"><?php echo flash('status') ?></div>
                        </small>
                    </div>
            </div>
            <!-- Rodapé do Modal -->
            <div class="modal-footer mt-4">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>

            </form>
        </div>
    </div>

</div>
<!-- [ form-element ] end -->