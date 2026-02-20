<?= $this->extend('internal/layout') ?>
<?= $this->section('content') ?>

<div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow">


    <form action="<?= base_url('portal-internal-x83fj9/csirtbalis/update/' . $item['id']) ?>"
        method="post"
        enctype="multipart/form-data">

        <?= csrf_field() ?>

        <!-- Judul -->
        <?= view('components/form/input', [
            'name'  => 'title',
            'label' => 'Nama',
            'value' => old('title', $item['title'] ?? '')
        ]) ?>


        <?= view('components/form/input', [
            'name' => 'site_link',
            'label' => 'Website',
            'value' => old('site_link', $item['site_link'] ?? '')
        ]) ?>



        <div class="flex justify-end space-x-3">
            <a href="<?= base_url('portal-internal-x83fj9/csirtbalis') ?>"
                class="px-4 py-2 border rounded-lg text-gray-600">
                Batal
            </a>

            <button type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Update Artikel
            </button>
        </div>

    </form>
</div>

<?= $this->endSection() ?>