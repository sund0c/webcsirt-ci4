<?= $this->extend('internal/layout') ?>
<?= $this->section('content') ?>

<div class="bg-white rounded-xl shadow-sm p-6 max-w-3xl">


    <form method="post"
        action="<?= site_url('portal-internal-x83fj9/csirtbalis/store') ?>"
        enctype="multipart/form-data">
        <?= csrf_field(); ?>

        <?= view('components/form/input', [
            'name' => 'title',
            'label' => 'Nama'
        ]) ?>
        <?= view('components/form/input', [
            'name' => 'site_link',
            'label' => 'Website'
        ]) ?>


        <div class="flex justify-end space-x-3">
            <a href="<?= base_url('portal-internal-x83fj9/csirtbalis') ?>"
                class="px-4 py-2 border rounded-lg text-gray-600">
                Batal
            </a>

            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                Simpan
            </button>
        </div>

    </form>

</div>

<?= $this->endSection() ?>