<?= $this->extend('internal/layout') ?>
<?= $this->section('content') ?>

<div class="bg-white rounded-xl shadow-sm p-6 max-w-3xl">


    <form method="post"
        action="<?= site_url('portal-internal-x83fj9/guides/store') ?>"
        enctype="multipart/form-data">
        <?= csrf_field(); ?>

        <?= view('components/form/input', [
            'name' => 'title',
            'label' => 'Judul'
        ]) ?>

        <?= view('components/form/input', [
            'name' => 'description',
            'label' => 'Deskripsi',
        ]) ?>

        <!-- File Upload -->
        <?= view('components/form/file', [
            'name'  => 'file',
            'label' => 'Upload File (PDF Max 10MB)'
        ]) ?>

        <div class="mb-6">
            <label class="block text-sm font-medium mb-2">Status</label>
            <select name="status"
                class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200">
                <option value="DRAFT">DRAFT</option>
                <option value="PUBLISHED">PUBLISHED</option>
            </select>
        </div>
        <div class="flex justify-end space-x-3">
            <a href="<?= base_url('portal-internal-x83fj9/guides') ?>"
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