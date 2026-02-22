<?php
// Ambil links langsung dari pager (lebih kompatibel daripada mengandalkan $links)
$links = $pager->links();
?>

<?php if (!empty($links) || $pager->hasPrevious() || $pager->hasNext()): ?>
    <div class="flex justify-center items-center space-x-2 text-sm mt-10">

        <!-- Prev -->
        <?php if ($pager->hasPrevious()): ?>
            <a href="<?= $pager->getPreviousPageURI() ?>"
                class="px-3 py-1 border border-blue-600 text-blue-600 rounded hover:bg-blue-600 hover:text-white transition">
                «
            </a>
        <?php else: ?>
            <span class="px-3 py-1 border border-gray-300 text-gray-400 rounded cursor-default">«</span>
        <?php endif; ?>

        <!-- Numbers -->
        <?php foreach ($links as $link): ?>
            <?php if (!empty($link['active'])): ?>
                <span class="px-3 py-1 bg-blue-600 text-white rounded font-semibold shadow-sm">
                    <?= esc($link['title']) ?>
                </span>
            <?php else: ?>
                <a href="<?= $link['uri'] ?>"
                    class="px-3 py-1 border border-blue-500 text-blue-600 rounded hover:bg-blue-500 hover:text-white transition">
                    <?= esc($link['title']) ?>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>

        <!-- Next -->
        <?php if ($pager->hasNext()): ?>
            <a href="<?= $pager->getNextPageURI() ?>"
                class="px-3 py-1 border border-blue-600 text-blue-600 rounded hover:bg-blue-600 hover:text-white transition">
                »
            </a>
        <?php else: ?>
            <span class="px-3 py-1 border border-gray-300 text-gray-400 rounded cursor-default">»</span>
        <?php endif; ?>

    </div>
<?php endif; ?>