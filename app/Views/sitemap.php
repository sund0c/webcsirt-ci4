<?= '<?xml version="1.0" encoding="UTF-8"?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <!-- Homepage -->
    <url>
        <loc><?= base_url('/') ?></loc>
        <priority>1.0</priority>
    </url>

    <!-- Static Pages -->
    <url>
        <loc><?= base_url('/advisory') ?></loc>
        <priority>0.8</priority>
    </url>

    <url>
        <loc><?= base_url('/about') ?></loc>
        <priority>0.6</priority>
    </url>

    <url>
        <loc><?= base_url('/contact') ?></loc>
        <priority>0.6</priority>
    </url>

    <!-- Advisory Dynamic -->
    <?php foreach ($advisories as $adv): ?>
        <url>
            <loc><?= base_url('advisory/' . $adv['slug']) ?></loc>
            <lastmod><?= date('Y-m-d', strtotime($adv['updated_at'] ?? $adv['published_at'])) ?></lastmod>
            <priority>0.7</priority>
        </url>
    <?php endforeach; ?>

</urlset>