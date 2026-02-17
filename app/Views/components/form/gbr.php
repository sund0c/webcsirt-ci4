<?php
$error = session('errors.' . $name);
?>

<div class="mb-4">
    <?php if (isset($label)) : ?>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            <?= esc($label) ?>
        </label>
    <?php endif ?>

    <input type="file"
        name="<?= esc($name) ?>"
        accept="image/jpeg,image/png,.jpg,.jpeg,.png"
        value="<?= old($name, $value ?? '') ?>"
        class="w-full text-sm border rounded-lg px-3 py-2 
               <?= $error ? 'border-red-500' : 'border-gray-300' ?>">

    <p class="text-xs text-gray-500 mt-1">
        Format diperbolehkan: JPG atau PNG (maksimal 2MB)
    </p>

    <?= view('components/form/error', ['field' => $name]) ?>
</div>