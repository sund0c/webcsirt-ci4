<?= $this->extend('internal/layout') ?>
<?= $this->section('content') ?>

<div class="bg-white rounded-xl shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">

        <a href="<?= base_url('portal-internal-x83fj9/guides') ?>"
            class="inline-block px-3 py-2 text-xs border rounded-lg text-gray-600">Kembali
        </a>
    </div>
    <div class="overflow-x-auto">
        <table id="dtTable" class="min-w-full text-sm border border-gray-200 rounded-lg">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3">Judul</th>
                    <th class="px-4 py-3">File Name</th>
                    <!-- <th class="px-4 py-3">File Hash</th> -->
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Tgl Publish</th>
                    <th class="px-4 py-3">Restore</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700 divide-y">
                <?php foreach ($guides as $guide) : ?>
                    <tr>

                        <td class="px-4 py-3"><?= esc($guide['title']) ?><br><?= esc($guide['description']) ?></td>
                        <?php
                        $size = (int) $guide['file_size'];

                        if ($size >= 1048576) {
                            $sizeFormatted = round($size / 1048576, 2) . ' MB';
                        } else {
                            $sizeFormatted = round($size / 1024, 2) . ' KB';
                        }
                        ?>

                        <td class="px-4 py-3">
                            <a href="<?= site_url('portal-internal-x83fj9/guides/preview/' . $guide['id']) ?>"
                                target="_blank"
                                class="text-blue-600 hover:underline">
                                <?= esc($guide['file_name']) ?>
                            </a>
                            <span class="text-gray-500 text-sm">
                                (<?= $sizeFormatted ?>)
                            </span>
                        </td>


                        <!-- <td class="px-4 py-3"><?= esc($guide['file_hash']) ?></td> -->
                        <td class="px-4 py-3">
                            <?php if ($guide['status'] === 'PUBLISHED'): ?>
                                <span class="px-4 py-1 text-xs bg-green-100 text-green-700 rounded">
                                    Published
                                </span>
                            <?php else: ?>
                                <span class="px-4 py-1 text-xs bg-gray-100 text-gray-700 rounded">
                                    Draft
                                </span>
                            <?php endif ?>
                        </td>
                        <td class="px-4 py-3">
                            <?= $guide['published_at']
                                ? date('d M Y', strtotime($guide['published_at']))
                                : '-' ?>
                        </td>


                        <td class="px-4 py-3">


                            <!-- Restore -->
                            <button
                                data-restore-id="<?= $guide['id'] ?>"
                                data-restore-title="<?= esc($guide['title']) ?>"
                                data-restore-url="/portal-internal-x83fj9/guides/restore/"
                                class="btn-restore inline-flex items-center justify-center px-3 py-1 text-xs 
           bg-red-600 text-white rounded hover:bg-red-700 transition duration-150">
                                Draft
                            </button>
                        </td>

                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>


</div>

<?= $this->endSection() ?>