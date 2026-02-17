<?php

$error = session('errors.' . $name);

$id     = $id ?? uniqid('tinymce_');
$name   = $name ?? '';
$label  = $label ?? '';
$value  = $value ?? '';
$rows   = $rows ?? 10;
$height = $height ?? 500;
?>

<div class="mb-4">
    <?php if ($label): ?>
        <label for="<?= esc($id) ?>" class="block text-sm font-medium text-gray-700 mb-1">
            <?= esc($label) ?>
        </label>
    <?php endif; ?>

    <textarea
        id="<?= esc($id) ?>"
        name="<?= esc($name) ?>"
        rows="<?= esc($rows) ?>"
        data-tinymce="true"
        data-height="<?= (int)$height ?>"
        class="w-full border rounded px-4 py-2"><?= esc($value) ?></textarea>
    <?= view('components/form/error', ['field' => $name]) ?>
</div>