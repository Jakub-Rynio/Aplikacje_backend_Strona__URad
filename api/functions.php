<?php
function coment_form($p) {

    // Generowanie tokenu CSRF, jeśli go nie ma
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    ?>

        <form method="post" action="api/add_coment.php" class="bg-red-50 p-6 rounded-xl space-y-4">

            <input type="hidden" name="id" value="<?= (int)$p['id']; ?>">

            <div>
                <label class="block text-sm font-medium text-gray-700">Autor</label>
                <input type="text" name="autor" required minlength="2" maxlength="32" class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-300 focus:border-red-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Treść komentarza</label>
                <textarea name="content" required minlength="3" rows="4" class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-300 focus:border-red-500"></textarea>
            </div>

            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">

            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-3 rounded-lg shadow transition">Dodaj komentarz</button>

        </form>
    <?php
}

function active_switch_coment($p, $c) {
    ?>
        <form method="post" action="api/update_coment_status.php" class="mt-3 flex flex-col sm:flex-row items-start sm:items-center gap-3 sm:gap-5">

            <input type="hidden" name="id" value="<?= (int)$p['id']; ?>">
    
            <input type="hidden" name="coment_id" value="<?= $c['id'] ?>">
    
            <div class="flex items-center space-x-4">
    
                <label class="flex items-center gap-2 text-sm text-gray-700">
                    <input type="radio" name="active" value="1"<?= $c['active'] == 1 ? 'checked' : '' ?> class="h-4 w-4 text-red-500 border-gray-300 focus:ring-red-300">Aktywny
                </label>
    
                <label class="flex items-center gap-2 text-sm text-gray-700">
                    <input type="radio" name="active" value="0" <?= $c['active'] == 0 ? 'checked' : '' ?> class="h-4 w-4 text-red-500 border-gray-300 focus:ring-red-300">Nieaktywny
                </label>
    
            </div>
    
            <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-semibold rounded-lg shadow transition">Aktualizuj</button>
    
        </form>

<?php
}