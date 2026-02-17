<?= $this->extend('internal/layout') ?>
<?= $this->section('content') ?>

<div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow">


    <form action="<?= base_url('portal-internal-x83fj9/pages/update/' . $page['id']) ?>"
        method="post"
        enctype="multipart/form-data">

        <?= csrf_field() ?>

        <!-- Judul -->
        <?= view('components/form/input', [
            'name'  => 'title',
            'label' => 'Judul',
            'value' => old('title', $page['title'] ?? '')
        ]) ?>

        <!-- Konten -->
        <?= view('components/form/textarea_tinymce', [
            'name' => 'content',
            'label' => 'Isi Page',
            'value' => old('body', $page['body'] ?? ''),
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
                $selectedStatus = old('status', $page['status']);
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
            <a href="<?= base_url('portal-internal-x83fj9/pages') ?>"
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