<?= $this->extend('internal/layout') ?>
<?= $this->section('content') ?>

<div class="bg-white rounded-lg shadow p-8">

    <h2 class="text-2xl font-semibold mb-4">
        Dashboard Admin
    </h2>

    <p class="text-gray-600 mb-8">
        Selamat datang, <strong><?= esc(session('username')) ?></strong>
    </p>

    <div class="grid md:grid-cols-3 gap-6">

        <div class="bg-blue-100 p-6 rounded-lg">
            <p class="text-sm text-gray-600">Total Advisory</p>
            <p class="text-3xl font-bold text-blue-900">
                <?= $totalArticles ?? 0 ?>
            </p>
        </div>

        <div class="bg-green-100 p-6 rounded-lg">
            <p class="text-sm text-gray-600">Published</p>
            <p class="text-3xl font-bold text-green-900">
                <?= $publishedArticles ?? 0 ?>
            </p>
        </div>

        <div class="bg-yellow-100 p-6 rounded-lg">
            <p class="text-sm text-gray-600">Draft</p>
            <p class="text-3xl font-bold text-yellow-900">
                <?= $draftArticles ?? 0 ?>
            </p>
        </div>

    </div>

</div>

<?= $this->endSection() ?>