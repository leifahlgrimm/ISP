<?php require_once __DIR__.'/header.php'?>

    <section class="container" id="createAccount">
        <form method="post" action="index.php/register">
            <div class="card">
                <div class="card-header">
                    Lege hier deinen neuen Account an
                </div>
                <div class="card-body">
                    <?php if($hasErrors):?>
                        <ul class="alert alert-danger">
                            <?php foreach($errors as $errorMessage):?>
                                <li><?= $errorMessage?></li>
                            <?php endforeach;?>
                        </ul>
                    <?php endif;?>
                    <div class="form-group">
                        <label for="username">Benutzername</label>
                        <input name="username" class="form-control" id="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Passwort</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success">Registrieren</button>
                </div>
            </div>
        </form>
    </section>

<?php require_once __DIR__.'/footer.php'?>