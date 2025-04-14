<?php $this->layout('layouts/layout', ['title' => $title]) ?>

<h1>Home (<?= $pagination->getTotal(); ?>)</h1>


<h3><?= $pagination->getPerPage() ?></h3>

<ul>
    <?php foreach ($users as $user) : ?>
        <li><?= $user->username; ?></li>
    <?php endforeach; ?>
</ul>

<?= $pagination->links(); ?>