<?= $this->extend('public/layout') ?>

<?= $this->section('content') ?>

<section class="bg-blue-950 py-24 hero-bg">
    <div class="max-w-6xl mx-auto px-6">

        <h1 class="text-3xl md:text-4xl font-bold text-white text-center leading-tight mb-6">

            Panduan Teknis</h1>

    </div>
</section>

<section class="py-20 bg-white">
    <div class="bg-white rounded-xl shadow-sm p-6">

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm border border-gray-200 rounded-lg">

                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3">File</th>
                        <th class="px-4 py-3">Aksi</th>
                        <th class="px-4 py-3">Fingerprint (SHA-256)</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($guides as $guide): ?>

                        <?php
                        $size = (int) $guide['file_size'];

                        if ($size >= 1048576) {
                            $sizeFormatted = round($size / 1048576, 2) . ' MB';
                        } else {
                            $sizeFormatted = round($size / 1024, 2) . ' KB';
                        }

                        $hasFile = !empty($guide['file_name']);
                        ?>

                        <tr class="border-t">

                            <!-- FILE -->
                            <td class="px-4 py-3">
                                <strong><?= esc($guide['title']) ?></strong><br>

                                <span class="text-gray-500 text-sm">
                                    <?= esc($guide['file_name']) ?> (<?= $sizeFormatted ?>)
                                </span>
                            </td>

                            <!-- AKSI -->
                            <td class="px-4 py-3">
                                <?php if ($hasFile): ?>
                                    <a href="<?= base_url('media/guide/' . esc($guide['stored_name'])) ?>"
                                        class="inline-flex items-center justify-center px-3 py-1 text-xs 
                                   bg-blue-600 text-white rounded
                                   hover:bg-blue-700 transition duration-150">
                                        Unduh
                                    </a>
                                <?php else: ?>
                                    <span class="text-gray-400">-</span>
                                <?php endif; ?>
                            </td>

                            <!-- HASH -->
                            <td class="px-4 py-3 font-mono text-xs break-all">
                                <?= !empty($guide['file_hash']) ? esc($guide['file_hash']) : '-' ?>
                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>
        </div>

    </div>
</section>


<?= $this->endSection() ?>