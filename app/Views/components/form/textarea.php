<?php
$error = session('errors.' . $name);
?>

<div class="mb-4">
    <?php if (isset($label)) : ?>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            <?= esc($label) ?>
        </label>
    <?php endif ?>

    <textarea name="<?= esc($name) ?>"
        rows="<?= $rows ?? 5 ?>"
        class="w-full px-4 py-2 rounded-lg border transition
                     <?= $error
                            ? 'border-red-500 focus:ring-red-500 focus:border-red-500'
                            : 'border-gray-300 focus:ring-blue-500 focus:border-blue-500' ?>"><?= old($name, $value ?? '') ?></textarea>

    <?= view('components/form/error', ['field' => $name]) ?>
</div>