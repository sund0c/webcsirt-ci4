<?= $this->extend('internal/layout') ?>
<?= $this->section('content') ?>

<div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow">



    <form action="<?= base_url('portal-internal-x83fj9/settings/update') ?>"
        method="post"
        enctype="multipart/form-data">

        <?= csrf_field() ?>

        <?= view('components/form/input', [
            'name' => 'site_name',
            'label' => 'Site Name',
            'value' => old('site_name', $settings['site_name'] ?? '')
        ]) ?>

        <?= view('components/form/input', [
            'name' => 'site_tagline',
            'label' => 'Tagline',
            'value' => old('site_tagline', $settings['site_tagline'] ?? '')
        ]) ?>

        <?= view('components/form/input', [
            'name' => 'site_email',
            'label' => 'Email',
            'value' => old('site_email', $settings['site_email'] ?? '')
        ]) ?>

        <?= view('components/form/input', [
            'name' => 'site_phone',
            'label' => 'Phone',
            'value' => old('site_phone', $settings['site_phone'] ?? '')
        ]) ?>

        <?= view('components/form/textarea', [
            'name' => 'site_address',
            'label' => 'Address',
            'value' => old('site_address', $settings['site_address'] ?? '')
        ]) ?>

        <?= view('components/form/input', [
            'name' => 'kanal_aduan',
            'label' => 'URL Kanal Aduan',
            'value' => old('kanal_aduan', $settings['kanal_aduan'] ?? '')
        ]) ?>

        <!-- Logo -->
        <?= view('components/form/gbr', [
            'name'  => 'logo',
            'label' => 'Logo (PNG/JPG)'
        ]) ?>

        <?php if (!empty($settings['logo'])) : ?>
            <div class="mt-4">
                <p class="text-sm text-gray-600 mb-2">Logo Saat Ini:</p>
                <img src="<?= site_url('portal-internal-x83fj9/settings/preview/' . $settings['logo']) ?>"
                    class="w-32 rounded-lg shadow">
            </div>
        <?php endif ?>

        <!-- Favicon -->
        <?= view('components/form/gbr', [
            'name'  => 'favicon',
            'label' => 'Favicon (ICO/PNG)'
        ]) ?>

        <?php if (!empty($settings['favicon'])) : ?>
            <div class="mt-4">
                <p class="text-sm text-gray-600 mb-2">Favicon Saat Ini:</p>
                <img src="<?= site_url('portal-internal-x83fj9/settings/preview/' . $settings['favicon']) ?>"
                    class="w-16 rounded-lg shadow">
            </div>
        <?php endif; ?>

        <div class="mt-6 flex justify-end">
            <button type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded-lg">
                Simpan
            </button>
        </div>

    </form>
</div>

<?= $this->endSection() ?>