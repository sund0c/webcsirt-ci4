<?php
$success = session()->getFlashdata('success');
$error   = session()->getFlashdata('error');
?>

<?php if ($success) : ?>
    <div id="toast"
        class="fixed top-5 right-5 z-50 bg-green-600 text-white px-5 py-3 rounded-xl shadow-lg">
        <?= esc($success) ?>
    </div>
<?php endif; ?>

<?php if ($error) : ?>
    <div id="toast"
        class="fixed top-5 right-5 z-50 bg-red-600 text-white px-5 py-3 rounded-xl shadow-lg">
        <?= esc($error) ?>
    </div>
<?php endif; ?>