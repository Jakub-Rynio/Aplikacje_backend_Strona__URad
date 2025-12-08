<?php
function coment_form($p) {

    // Generowanie tokenu CSRF, jeśli go nie ma
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    ?>

    <form method="post" action="/api/add_coment.php">
        <label>
            Autor:
            <input type="text" name="autor" required minlength="3">
        </label><br>

        <label>
            Treść:
            <textarea name="content" required minlength="5"></textarea>
        </label><br>
        <input type="hidden" name="id" value="<?php echo $p['id']?>">

        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

        <button type="submit">Dodaj komentarz</button>
    </form>
    <?php
}

function active_switch($p){
    ?>
 <form method="post" action="api/update_post_status.php">
                <input type="hidden" name="post_id" value="<?= $p['id'] ?>">

                <label>
                    <input type="radio" name="active" value="1" <?= $p['active'] == 1 ? 'checked' : '' ?>>
                    Aktywny
                </label>

                <label>
                    <input type="radio" name="active" value="0" <?= $p['active'] == 0 ? 'checked' : '' ?>>
                    Nieaktywny
                </label>

                <button type="submit">Aktualizuj</button>
            </form>
        <hr>
    </div>
    <?php
}

function active_switch_coment($c){
    ?>
 <form method="post" action="api/update_coment_status.php">
                <input type="hidden" name="coment_id" value="<?= $c['id'] ?>">

                <label>
                    <input type="radio" name="active" value="1" <?= $c['active'] == 1 ? 'checked' : '' ?>>
                    Aktywny
                </label>

                <label>
                    <input type="radio" name="active" value="0" <?= $c['active'] == 0 ? 'checked' : '' ?>>
                    Nieaktywny
                </label>

                <button type="submit">Aktualizuj</button>
            </form>
        <hr>
    </div>
    <?php
}