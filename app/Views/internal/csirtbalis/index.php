<?= $this->extend('internal/layout') ?>
<?= $this->section('content') ?>

<div class="bg-white rounded-xl shadow-sm p-6">

    <div class="flex justify-between items-center mb-8">

        <div class="flex items-center gap-3">
            <a href="<?= site_url('portal-internal-x83fj9/csirtbalis/create') ?>"
                class="inline-block px-3 py-2 text-xs bg-blue-600 text-white rounded hover:bg-blue-700">
                ＋ Tambah CSIRT
            </a>
            <a href="<?= site_url('portal-internal-x83fj9/csirtbalis/trash') ?>"
                class="inline-block px-3 py-2 text-xs bg-red-600 text-white rounded hover:bg-red-700">CSIRT Dihapus
            </a>



        </div>
    </div>

    <div class="overflow-x-auto">
        <table id="dtTable" class="min-w-full text-sm border border-gray-200 rounded-lg">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">URL</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td class="px-4 py-3"><?= esc($item['title']) ?></td>
                        <td class="px-4 py-3"><?= esc($item['site_link']) ?></td>
                        <td class="px-4 py-3">
                            <div class="flex justify-center items-center space-x-3">

                                <!-- Edit -->
                                <a href="<?= base_url('portal-internal-x83fj9/csirtbalis/edit/' . $item['id']) ?>"
                                    class="inline-flex items-center justify-center px-3 py-1 text-xs 
                   bg-blue-600 text-white rounded
                   hover:bg-blue-700 transition duration-150">
                                    Edit
                                </a>

                                <!-- Delete -->
                                <a href="<?= base_url('portal-internal-x83fj9/csirtbalis/delete/' . $item['id']) ?>"
                                    class="inline-flex items-center justify-center px-3 py-1 text-xs
                   bg-red-600 text-white rounded 
                   hover:bg-red-700 transition duration-150">
                                    Hapus
                                </a>

                            </div>
                        </td>

                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

</div>


<?= $this->endSection() ?>