<?= $this->extend('internal/layout') ?>
<?= $this->section('content') ?>

<div class="bg-white rounded-xl shadow-sm p-6">




    <table id="dtTable" class="min-w-full text-sm border border-gray-200 rounded-lg">
        <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
            <tr>
                <th class="px-4 py-3">Urutan</th>
                <th class="px-4 py-3">Judul</th>
                <th class="px-4 py-3">Icon</th>
                <th class="px-4 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($services as $service) : ?>
                <tr>
                    <td class="px-4 py-2">
                        <?= esc($service['sort_order']) ?>
                    </td>
                    <td class="px-4 py-2 font-medium">
                        <?= esc($service['title']) ?>
                    </td>
                    <td class="px-4 py-2 text-gray-600">
                        <?= esc($service['icon']) ?>
                    </td>
                    <td class="px-4 py-2 text-center">
                        <a href="<?= site_url('portal-internal-x83fj9/services/edit/' . $service['id']) ?>"
                            class="inline-flex items-center justify-center px-3 py-1 text-xs 
                   bg-blue-600 text-white rounded
                   hover:bg-blue-700 transition duration-150">
                            Edit
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<?= $this->endSection() ?>