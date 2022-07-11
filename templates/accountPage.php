<?php require_once __DIR__.'/header.php'?>

<div class="container">
    <div class="row">
        <div class="col-10">Dein Account, <?= $username?></div>
        <?php if($isAdmin !== "0"):?>
        <a class="btn btn-secondary col-2" href="/index.php/admin">Admin</a>
        <?php endif;?>
    </div>
    <div class="row">
        <?php require_once __DIR__.'/accountForm.php'?>
    </div>
</div>

<?php require_once __DIR__.'/footer.php'?>