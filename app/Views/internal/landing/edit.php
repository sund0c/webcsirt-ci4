<?= $this->extend('internal/layout') ?>
<?= $this->section('content') ?>

<div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow">

    <h1 class="text-2xl font-bold mb-6">
        Edit Section: <?= esc($section['section_key']) ?>
    </h1>

    <form action="<?= site_url('portal-internal-x83fj9/landing/update/' . $section['id']) ?>"
        method="post" enctype="multipart/form-data">

        <?= csrf_field() ?>

        <?= view('components/form/input', [
            'name' => 'title',
            'label' => 'Title',
            'value' => old('title', $section['title'])
        ]) ?>

        <?= view('components/form/textarea', [
            'name' => 'subtitle',
            'label' => 'Subtitle',
            'value' => old('subtitle', $section['subtitle'])
        ]) ?>

        <?= view('components/form/textarea', [
            'name' => 'content',
            'label' => 'Content',
            'value' => old('content', $section['content'])
        ]) ?>

        <?= view('components/form/input', [
            'name' => 'button_text',
            'label' => 'Button Text',
            'value' => old('button_text', $section['button_text'])
        ]) ?>

        <?= view('components/form/input', [
            'name' => 'button_link',
            'label' => 'Button Link',
            'value' => old('button_link', $section['button_link'])
        ]) ?>

        <!-- Background Image Upload -->
        <?= view('components/form/gbr', [
            'name'  => 'background_image',
            'label' => 'Background Image (Opsional)'
        ]) ?>



        <?php if (!empty($section['background_image'])) : ?>
            <div class="mt-4">
                <p class="text-sm text-gray-600 mb-2">Background Saat Ini:</p>
                <img src="<?= site_url('portal-internal-x83fj9/landing/preview/' . $section['background_image']) ?>"
                    class="w-64 rounded-lg shadow">

            </div>
        <?php endif ?>


        <?= view('components/form/error', ['field' => 'status']) ?>


        <div class="flex justify-end space-x-3">
            <a href="<?= base_url('portal-internal-x83fj9/landing') ?>"
                class="px-4 py-2 border rounded-lg text-gray-600">
                Batal
            </a>
            <button type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded-lg">
                Update
            </button>
        </div>

    </form>

</div>

<?= $this->endSection() ?>