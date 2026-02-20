<?= $this->extend('internal/layout') ?>
<?= $this->section('content') ?>

<div class="bg-white rounded-xl shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">

        <a href="<?= base_url('portal-internal-x83fj9/csirtbalis') ?>"
            class="inline-block px-3 py-2 text-xs border rounded-lg text-gray-600">Kembali
        </a>
    </div>
    <div class="overflow-x-auto">
        <table id="dtTable" class="min-w-full text-sm border border-gray-200 rounded-lg">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3">Judul</th>
                    <th class="px-4 py-3">Tanggal Dihapus</th>
                    <th class="px-4 py-3">Restore</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700 divide-y">
                <?php foreach ($csirtbalis as $csirtbali) : ?>
                    <tr>
                        <td class="px-4 py-3"><?= esc($csirtbali['title']) ?></td>
                        <td class="px-4 py-3">
                            <?= date('d M Y H:i', strtotime($csirtbali['deleted_at'])) ?>
                        </td>
                        <td class="px-4 py-3">

                            <a href="<?= base_url('portal-internal-x83fj9/csirtbalis/restore/' . $csirtbali['id']) ?>"
                                class="inline-block px-3 py-1 text-xs bg-blue-600 text-white rounded hover:bg-blue-700"
                                title="Draft">
                                Restore
                            </a>
                        </td>

                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>


</div>

<?= $this->endSection() ?>