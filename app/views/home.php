<?php $this->layout('layouts/layout', ['title' => $title]) ?>

<h1><?= $this->e($title) ?></h1>

<ul>
    <?php foreach ($users as $user) : ?>
        <li><p><?= $this->e($user->nome); ?><br /><small class="text-muted"><?= $this->e($user->cargo); ?></small></p></li>
    <?php endforeach; ?>
</ul>
<pre>
    <?php print_r($users); ?>
</pre>
