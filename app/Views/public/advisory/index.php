<?= $this->extend('public/layout') ?>
<?= $this->section('content') ?>



<section class="bg-blue-950 py-24 hero-bg">
    <div class="max-w-6xl mx-auto px-6">

        <h1 class="text-3xl md:text-4xl font-bold text-white text-center leading-tight mb-6">Security Advisory</h1>

    </div>
</section>


<section class="py-20 bg-gray-50">

    <div class="max-w-6xl mx-auto px-6">



        <div class="grid gap-8">

            <?php foreach ($advisories as $adv): ?>
                <div class="bg-white p-6 rounded shadow flex gap-6">

                    <img src="<?= base_url('media/advisory/' . esc($adv['featured_image'])) ?>"
                        alt="<?= esc($adv['title']) ?>"
                        width="220"
                        height="160"
                        class="rounded-lg">


                    <div class="flex flex-col flex-1">

                        <h2 class="font-bold text-lg mb-2">
                            <a href="<?= base_url('advisory/' . esc($adv['slug'])) ?>"
                                class="hover:text-blue-700">
                                <?= esc($adv['title']) ?>
                            </a>
                        </h2>

                        <p class="text-gray-600 text-sm mb-3">
                            <?= esc($adv['excerpt']) ?>
                        </p>

                        <span class="text-xs text-gray-500">
                            <?= date('d F Y', strtotime($adv['published_at'])) ?>
                        </span>

                    </div>

                </div>
            <?php endforeach; ?>

        </div>

        <!-- Pagination -->
        <div class="mt-10">
            <?= $pager->links() ?>
        </div>

    </div>
</section>

<?= $this->endSection() ?>