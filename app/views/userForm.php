<?php $this->layout('layout', ['title' => $title]) ?>

<?php $this->push('css') ?>
<link rel="stylesheet" href="../assets/css/pages/user.css">
<?php $this->end() ?>

<?php $this->push('scripts') ?>
<script src="../assets/js/plugins/bouncer.min.js"></script>
<script src="../assets/js/pages/form-validation.js"></script>
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
                        <a href="#" class="btn btn-primary" title="Voltar">Voltar</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="/user/save" method="post" enctype="multipart/form-data" class="validate-me" data-validate="" novalidate="true">
                    <?php echo getToken(); ?>
                    <input type="hidden" name="id" id="id" value="<?= isset($user[0]->id) ? $user[0]->id : ''; ?>">
                    <!-- Avatar personalizável -->
                    <div class="avatar-container text-center mb-3">
                        <label for="image" class="avatar-label d-block">
                            <img class="rounded-circle img-fluid wid-90 img-thumbnail" id="imagePreview"
                                src="<?= isset($user[0]->image) ? '../assets/images/user/' . $user[0]->image : '../assets/images/user/default-avatar.png'; ?>" alt="Avatar">
                            <span class="avatar-text d-block mt-2 text-primary">Trocar Avatar</span>
                        </label>
                        <input type="file" name="image" id="image" class="form-control d-none" accept="image/*">
                        <small id="file-error-msg" class="form-text text-danger">
                            <div class="error-message" id="bouncer-error_file"><?php echo flash('image') ?></div>
                        </small>
                    </div>

                    <div class="row g-3">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control" name="name" id="name" required placeholder="Digite seu nome completo" value="<?= isset($user[0]->name) ? $user[0]->name : ''; ?>">
                                <small id="name-error-msg" class="form-text text-danger">
                                    <div class="error-message" id="bouncer-error_name"><?php echo flash('name') ?></div>
                                </small>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" required placeholder="Digite seu email" value="<?= isset($user[0]->email) ? $user[0]->email : ''; ?>">
                                <small id="email-error-msg" class="form-text text-danger">
                                    <div class="error-message" id="bouncer-error_email"><?php echo flash('email') ?></div>
                                </small>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label">Usuário</label>
                                <input type="text" class="form-control" name="username" id="username" required placeholder="Digite seu usuário" value="<?= isset($user[0]->name) ? $user[0]->name : ''; ?>">
                                <small id="username-error-msg" class="form-text text-danger">
                                    <div class="error-message" id="bouncer-error_username"><?php echo flash('username') ?></div>
                                </small>
                            </div>
                        </div>

                    </div>
                    <div class="row g-3">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label">Senha</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="feather icon-lock"></i></span>
                                    <input type="password" class="form-control" name="password" id="password" required data-bouncer-message="<?php echo flash('password') ?>" placeholder="Digite sua senha"><br>
                                    <small id="password-error-msg" class="form-text text-danger">
                                        <div class="error-message" id="bouncer-error_password"><?php echo flash('password') ?></div>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="user_level" class="form-label">Grupo</label>
                            <select class="form-select" id="user_level" name="user_level">
                                <?= isset($user[0]->user_level) ? "<option value=" . $user[0]->user_level . " Selected>" . $user[0]->group_name . "</option>" : ""; ?>
                                <option value="1">Administrador</option>
                                <option value="2">Usuário</option>
                            </select>
                            <small id="file-error-msg" class="form-text text-danger">
                                <div class="error-message" id="bouncer-error_file"><?php echo flash('user_level') ?></div>
                            </small>
                        </div>
                        <?php
                        if (isset($user[0]->status)) {
                            $status = $user[0]->status === 1 ? 'Ativo' : 'Inativo';
                        } else {
                            $status = '';
                        }
                        ?>
                        <div class="form-group col-md-4">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <?= isset($user[0]->status) ? "<option value=" . $user[0]->status . " Selected>" . $status . "</option>" : ""; ?>
                                <option value="1">Ativo</option>
                                <option value="0">Inativo</option>
                            </select>
                            <small id="file-error-msg" class="form-text text-danger">
                                <div class="error-message" id="bouncer-error_file"><?php echo flash('status') ?></div>
                            </small>
                        </div>
                    </div>
                    <!-- Rodapé do Modal -->
                    <div class="modal-footer mt-4">
                        <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!-- [ form-element ] end -->
</div>