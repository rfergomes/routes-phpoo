<?php $this->layout('layouts/layout', ['title' => $title]) ?>

<h1><?= $this->e($title) ?></h1>

<!-- [ Main Content ] start -->
<div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Hello card</h5>
            </div>
            <div class="card-body">
                <ul>
                    <?php foreach ($users as $user) : ?>
                        <li>
                            <p><?= $this->e($user->nome); ?><br /><small class="text-muted"><?= $this->e($user->cargo); ?></small></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <pre>
                    <?php print_r(['Usuarios' => $user, 'Permissões' => $permissions]);
                    print_r($_SESSION['permissions']); ?>
                </pre>
            </div>
        </div>
    </div>
    <!-- [ sample-page ] end -->
</div>