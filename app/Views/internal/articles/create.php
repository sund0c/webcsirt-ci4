<?= $this->extend('internal/layout') ?>
<?= $this->section('content') ?>

<div class="bg-white rounded-xl shadow-sm p-6 max-w-3xl">


    <form method="post"
        action="<?= site_url('portal-internal-x83fj9/articles/store') ?>"
        enctype="multipart/form-data">
        <?= csrf_field(); ?>

        <?= view('components/form/input', [
            'name' => 'title',
            'label' => 'Judul'
        ]) ?>

        <?= view('components/form/textarea', [
            'name' => 'content',
            'label' => 'Konten'
        ]) ?>

        <?= view('components/form/textarea', [
            'name' => 'excerpt',
            'label' => 'Excerpt'
        ]) ?>

        <div class="mb-6">
            <label class="block text-sm font-medium mb-2">Status</label>
            <select name="status"
                class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200">
                <option value="DRAFT">DRAFT</option>
                <option value="PUBLISHED">PUBLISHED</option>
            </select>
        </div>

        <?= view('components/form/gbr', [
            'name' => 'featured_image',
            'label' => 'Featured Image'
        ]) ?>

        <?= view('components/form/input', [
            'name' => 'image_caption',
            'label' => 'Caption Gambar'
        ]) ?>




        <div class="flex justify-end space-x-3">
            <a href="<?= base_url('portal-internal-x83fj9/articles') ?>"
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