<?php $this->layout('layout', ['title' => $title]) ?>

<div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-sm-12">

        <!-- Formulário -->
        <form action="/user/save" method="post" id="userForm" name="userForm" enctype="multipart/form-data">
            <?php echo getToken(); ?>
            <input type="hidden" name="id" id="id">
            <!-- Avatar personalizável -->
            <div class="avatar-container text-center mb-3">
                <label for="image" class="avatar-label d-block">
                    <img class="rounded-circle img-fluid wid-90 img-thumbnail" id="imagePreview"
                        src="../assets/images/user/default-avatar.png" alt="Avatar">
                    <span class="avatar-text d-block mt-2 text-primary">Trocar Avatar</span>
                </label>
                <input type="file" name="image" id="image" class="form-control d-none" accept="image/*">
            </div>

            <!-- Campos de Entrada -->
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nome completo">
                <div class="error-message" id="error-name"></div> <!-- Atualizei o ID do erro para corresponder ao campo -->
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Seu E-mail">
                <div class="error-message" id="error-email"></div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="username" class="form-label">Usuário</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="username" name="username"
                            placeholder="Nome de Usuário">
                        <div class="input-group-text">@</div>
                        <div class="error-message" id="error-username"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Senha">
                    <div class="error-message" id="error-password"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="user_level" class="form-label">Grupo</label>
                    <select class="form-select" id="user_level" name="user_level">
                        <option value="1">Administrador</option>
                        <option value="2">Usuário</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="1">Ativo</option>
                        <option value="0">Inativo</option>
                    </select>
                </div>
            </div>

            <!-- Rodapé do Modal -->
            <div class="modal-footer mt-4">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
        <!-- End Formulário -->
    </div>
</div>