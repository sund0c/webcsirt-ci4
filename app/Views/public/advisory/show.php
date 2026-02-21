<?= $this->extend('public/layout') ?>
<?= $this->section('content') ?>

<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-6">

        <h1 class="text-3xl font-bold mb-6">
            <?= esc($advisory['title']) ?>
        </h1>

        <div class="text-gray-500 text-sm mb-6">
            <?= date('d F Y', strtotime($advisory['published_at'])) ?>
        </div>

        <?php if (!empty($advisory['featured_image'])): ?>
            <img src="<?= base_url('media/advisory/' . esc($advisory['featured_image'])) ?>"
                class="w-full rounded mb-8">
        <?php endif; ?>


        <div class="prose max-w-none">
            <?= $advisory['body'] ?>
        </div>

    </div>
</section>

<?= $this->endSection() ?>