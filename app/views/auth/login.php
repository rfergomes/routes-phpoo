<?php $this->layout('layouts/auth', ['title' => 'Login']) ?>

<div class="auth-wrapper">
    <div class="auth-content">
        <div class="card">
            <div class="row align-items-center text-center">
                <div class="col-md-12">
                    <div class="card-body">
                        <h3 class="mb-4">Login</h3>
                        <?= isset($_SESSION['danger'])? flash('danger','alert'):''  ?>
                        <form action="/login" method="POST">
                            <?php echo getToken(); ?>
                            <div class="form-group mb-3">
                                <input type="text" name="email" class="form-control" placeholder="E-mail" required>
                                <?php if (isset($_SESSION['email'])) {
                                    echo flash('email', 'field');
                                } ?>
                            </div>
                            <div class="form-group mb-4">
                                <input type="senha" name="senha" class="form-control" placeholder="Senha" required>
                                <?php if (isset($_SESSION['senha'])) {
                                    echo flash('senha', 'field');
                                } ?>
                            </div>
                            <button type="submit" class="btn btn-primary shadow-2 mb-4 w-100">Entrar</button>
                        </form>

                        <p class="mb-0 text-muted">© <?= date('Y') ?> Sistema com FlatAble</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .auth-body {
        background: #f5f7fa;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .auth-wrapper {
        width: 100%;
        max-width: 420px;
    }
</style>