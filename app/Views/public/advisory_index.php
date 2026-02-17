<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>

<section class="py-16 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6">

        <h2 class="text-3xl font-semibold mb-10 text-center">
            Advisory Keamanan Siber
        </h2>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

            <?php foreach ($articles as $article): ?>
                <div class="bg-white shadow rounded p-6 flex flex-col justify-between">

                    <div>
                        <h3 class="text-lg font-semibold mb-3">
                            <?= esc($article['title']) ?>
                        </h3>

                        <p class="text-sm text-gray-600 mb-4">
                            <?= esc(substr(strip_tags($article['excerpt']), 0, 120)) ?>...
                        </p>
                    </div>

                    <div class="mt-4">
                        <a href="/advisory/<?= esc($article['slug']) ?>"
                            class="text-blue-700 font-medium hover:underline">
                            Baca Selengkapnya →
                        </a>
                    </div>

                </div>
            <?php endforeach; ?>

        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            <?= $pager->links() ?>
        </div>

    </div>
</section>

<?= $this->endSection() ?>