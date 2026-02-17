<?php if (session('errors.' . $field)) : ?>
    <p class="text-red-600 text-sm mt-1">
        <?= esc(session('errors.' . $field)) ?>
    </p>
<?php endif ?>