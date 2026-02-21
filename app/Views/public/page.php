<?= $this->extend('public/layout') ?>

<?= $this->section('content') ?>

<section class="bg-blue-950 py-24 hero-bg">
    <div class="max-w-6xl mx-auto px-6">

        <h1 class="text-3xl md:text-4xl font-bold text-white text-center leading-tight mb-6">

            <?= $page['title'] ?>
        </h1>

    </div>
</section>

<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-6">

        <div>
            <p class="text-gray-600 leading-relaxed mb-8">
                <?= $page['body'] ?>
            </p>

        </div>

    </div>
</section>


<?= $this->endSection() ?>