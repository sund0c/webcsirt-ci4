<?= $this->extend('internal/layout') ?>
<?= $this->section('content') ?>

<div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow">

    <form action="<?= site_url('portal-internal-x83fj9/services/update/' . $service['id']) ?>"
        method="post">

        <?= csrf_field() ?>

        <?= view('components/form/input', [
            'name' => 'title',
            'label' => 'Judul',
            'value' => old('title', $service['title'])
        ]) ?>

        <?= view('components/form/textarea', [
            'name' => 'description',
            'label' => 'Deskripsi',
            'value' => old('description', $service['description'])
        ]) ?>

        <?= view('components/form/input', [
            'name' => 'icon',
            'label' => 'Icon (misal: shield, bug, book)',
            'value' => old('icon', $service['icon'])
        ]) ?>

        <?= view('components/form/input', [
            'name' => 'link',
            'label' => 'Link',
            'value' => old('link', $service['link'])
        ]) ?>

        <div class="flex justify-end space-x-3">
            <a href="<?= base_url('portal-internal-x83fj9/services') ?>"
                class="px-4 py-2 border rounded-lg text-gray-600">
                Batal
            </a>

            <button type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Update
            </button>
        </div>

    </form>

</div>

<?= $this->endSection() ?>