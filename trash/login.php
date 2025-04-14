<?php $this->layout('auth', ['title' => 'Login']) ?>

<div class="container d-flex align-items-center justify-content-center min-vh-100 bg-light">
  <div class="card shadow p-4" style="max-width: 400px; width: 100%; border-radius: 1rem;">
    <div class="text-center mb-4">
      <img src="/assets/images/logo.png" alt="Logo" class="mb-3" style="height: 60px;">
      <h4 class="fw-bold">Acesso ao Sistema</h4>
    </div>

    <?php if (isset($_SESSION['error'])): ?>
      <div class="alert alert-danger">
        <?= $_SESSION['error'];
        unset($_SESSION['error']); ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="/authenticate">
      <?php echo getToken(); ?>
      <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" class="form-control" id="email" name="email" required autofocus value="admin@admin.com.br">
      </div>

      <div class="mb-3">
        <label for="senha" class="form-label">Senha</label>
        <input type="password" class="form-control" id="senha" name="senha" required value="123">
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-primary">Entrar</button>
      </div>
    </form>
  </div>
</div>