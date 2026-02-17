<?= $this->extend('internal/layout') ?>
<?= $this->section('content') ?>

<div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow">


    <form action="<?= base_url('portal-internal-x83fj9/articles/update/' . $article['id']) ?>"
        method="post"
        enctype="multipart/form-data">

        <?= csrf_field() ?>

        <!-- Judul -->
        <?= view('components/form/input', [
            'name'  => 'title',
            'label' => 'Judul',
            'value' => old('title', $article['title'] ?? '')
        ]) ?>

        <!-- Konten -->
        <?= view('components/form/textarea', [
            'name'  => 'content',
            'label' => 'Konten',
            'rows'  => 6,
            'value' => old('content', $article['body'] ?? '')
        ]) ?>

        <!-- Excerpt -->
        <?= view('components/form/textarea', [
            'name'  => 'excerpt',
            'label' => 'Excerpt',
            'rows'  => 6,
            'value' => old('excerpt', $article['excerpt'] ?? '')
        ]) ?>



        <!-- Status -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Status
            </label>

            <select name="status"
                class="w-full px-4 py-2 rounded-lg border
                    <?= session('errors.status') ? 'border-red-500' : 'border-gray-300' ?>">

                <?php
                $selectedStatus = old('status', $article['status']);
                ?>

                <option value="DRAFT"
                    <?= $selectedStatus === 'DRAFT' ? 'selected' : '' ?>>
                    Draft
                </option>

                <option value="PUBLISHED"
                    <?= $selectedStatus === 'PUBLISHED' ? 'selected' : '' ?>>
                    Published
                </option>
            </select>

            <?= view('components/form/error', ['field' => 'status']) ?>
        </div>

        <!-- Gambar Lama -->
        <?php if (!empty($article['featured_image'])) : ?>
            <div class="mb-4">
                <p class="text-sm text-gray-600 mb-2">Gambar Saat Ini:</p>
                <img src="<?= base_url('image/articles/' . $article['featured_image']) ?>"
                    class="w-48 rounded-lg shadow">
            </div>
        <?php endif ?>

        <!-- Upload Gambar Baru -->
        <?= view('components/form/gbr', [
            'name'  => 'featured_image',
            'label' => 'Ganti Gambar (Opsional)'
        ]) ?>

        <!-- Caption -->
        <?= view('components/form/input', [
            'name'  => 'image_caption',
            'label' => 'Caption Gambar',
            'value' => old('image_caption', $article['image_caption'] ?? '')
        ]) ?>

        <div class="flex justify-end space-x-3">
            <a href="<?= base_url('portal-internal-x83fj9/articles') ?>"
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