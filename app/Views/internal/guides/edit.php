<?= $this->extend('internal/layout') ?>
<?= $this->section('content') ?>

<div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow">


    <form action="<?= base_url('portal-internal-x83fj9/guides/update/' . $guide['id']) ?>"
        method="post"
        enctype="multipart/form-data">

        <?= csrf_field() ?>


        <?= view('components/form/input', [
            'name' => 'title',
            'label' => 'Judul',
            'value' => old('title', $guide['title'] ?? '')
        ]) ?>

        <?= view('components/form/input', [
            'name' => 'description',
            'label' => 'Deskripsi',
            'value' => old('description', $guide['description'] ?? '')
        ]) ?>

        <!-- File Upload -->
        <!-- File Lama -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                File Saat Ini
            </label>

            <?php
            $size = (int) $guide['file_size'];
            $sizeFormatted = $size >= 1048576
                ? round($size / 1048576, 2) . ' MB'
                : round($size / 1024, 2) . ' KB';
            ?>

            <div class="bg-gray-100 p-3 rounded text-sm">
                <strong><?= esc($guide['file_name']) ?></strong>
                <span class="text-gray-500">(<?= $sizeFormatted ?>)</span>
            </div>
        </div>

        <!-- Upload File Baru -->
        <?= view('components/form/file', [
            'name'  => 'file',
            'label' => 'Ganti File (Opsional)'
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
                $selectedStatus = old('status', $guide['status']);
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

        <div class="flex justify-end space-x-3">
            <a href="<?= base_url('portal-internal-x83fj9/guides') ?>"
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