<?= $this->extend('internal/layout') ?>
<?= $this->section('content') ?>

<div class="bg-white rounded-xl shadow-sm p-6">

    <div class="flex justify-between items-center mb-8">

        <div class="flex items-center gap-3">
            <a href="<?= site_url('portal-internal-x83fj9/guides/create') ?>"
                class="inline-block px-3 py-2 text-xs bg-blue-600 text-white rounded hover:bg-blue-700">
                ＋ Tambah Guide
            </a>
            <a href="<?= site_url('portal-internal-x83fj9/guides/trash') ?>"
                class="inline-block px-3 py-2 text-xs bg-red-600 text-white rounded hover:bg-red-700">Guide Dihapus
            </a>



        </div>
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
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
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
                                <?= esc($guide['stored_name']) ?>
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
                            <div class="flex justify-center items-center space-x-3">

                                <!-- Edit -->
                                <a href="<?= base_url('portal-internal-x83fj9/guides/edit/' . $guide['id']) ?>"
                                    class="inline-flex items-center justify-center px-3 py-1 text-xs 
                   bg-blue-600 text-white rounded
                   hover:bg-blue-700 transition duration-150">
                                    Edit
                                </a>
                                <!-- Delete -->
                                <button
                                    data-delete-id="<?= $guide['id'] ?>"
                                    data-delete-title="<?= esc($guide['title']) ?>"
                                    data-delete-url="/portal-internal-x83fj9/guides/delete/"
                                    class="btn-delete inline-flex items-center justify-center px-3 py-1 text-xs 
           bg-red-600 text-white rounded hover:bg-red-700 transition duration-150">
                                    Hapus
                                </button>


                            </div>
                        </td>

                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

</div>


<?= $this->endSection() ?>