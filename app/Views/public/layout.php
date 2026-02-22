<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= esc($site['site_name']) ?>
    </title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
    <link rel="stylesheet" href="<?= base_url('media/hero-css') ?>">
    <?php if (!empty($site['favicon'])): ?>
        <link rel="icon"
            type="image/png"
            href="<?= base_url('media/settings/' . esc($site['favicon'])) ?>">
    <?php endif; ?>


</head>

<body class="bg-gray-50 text-gray-800">

    <!-- HEADER -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">

                <a href="<?= base_url('/') ?>" class="flex items-center space-x-4">

                    <!-- Logo -->
                    <img src="<?= base_url('media/settings/' . esc($site['logo'])) ?>"
                        class="h-10 w-auto"
                        alt="Logo CSIRT">

                    <!-- Nama -->
                    <div>
                        <h1 class="text-lg font-bold text-gray-800 leading-tight">
                            <?= esc($site['site_name'] ?? 'BALIPROV CSIRT') ?>
                        </h1>
                        <p class="text-sm text-gray-600">
                            <?= esc($site['site_tagline'] ?? 'BALIPROV CSIRT') ?>
                        </p>
                    </div>

                </a>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex space-x-6 text-sm font-medium items-center">

                <a href="/" class="hover:text-blue-700">Beranda</a>

                <a href="<?= base_url('tentang') ?>" class="hover:text-blue-700">Tentang</a>
                <a href="/advisory" class="hover:text-blue-700">Advisory</a>
                <a href="<?= base_url('layanan') ?>" class="hover:text-blue-700">Layanan</a>
                <a href="<?= base_url('rfc2350') ?>" class="hover:text-blue-700">RFC 2350</a>
                <a href="/panduan" class=" hover:text-blue-700">Panduan</a>

                <!-- <a href="/lapor"
                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                    Laporkan Insiden
                </a> -->
            </nav>

            <!-- Hamburger (Mobile Only) -->
            <button id="menuBtn"
                class="md:hidden text-blue-800 text-2xl focus:outline-none">
                ☰
            </button>

        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu"
            class="hidden md:hidden px-6 pb-4 border-t">

            <a href="/" class="block py-2">Beranda</a>
            <a href="<?= base_url('tentang') ?>" class="block py-2">Tentang</a>
            <a href="/advisory" class="block py-2">Advisory</a>
            <a href="/kontak" class="block py-2">Kontak</a>

        </div>
    </header>



    <!-- CONTENT -->
    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <!-- FOOTER -->
    <footer class="bg-blue-900 text-white">
        <div class="max-w-7xl mx-auto px-6 py-10 grid md:grid-cols-3 gap-8 text-sm">

            <div>
                <h3 class="font-semibold mb-3">Tentang CSIRT</h3>
                <p class="text-blue-200">
                    BALIPROV-CSIRT adalam Tim TIS Pemprov Bali yang terbentuk Tanggal 8 Maret 2021.
                </p>
            </div>

            <div>
                <h3 class="font-semibold mb-3">Kontak Resmi</h3>
                <p>Email: <?= esc($site['site_email'] ?? 'BALIPROV CSIRT') ?></p>
                <p>Telpon: <?= esc($site['site_phone'] ?? 'BALIPROV CSIRT') ?></p>
                <p>Jam Operasional Kantor: 08.00 – 16.00 WITA</p>
            </div>

            <div>
                <h3 class="font-semibold mb-3">Informasi</h3>
                <p><a href="/advisory" class="hover:underline">Advisory</a></p>
                <p><a href="/panduan" class="hover:underline">Panduan Teknis</a></p>
                <p><a href="/article" class="hover:underline">Artikel</a></p>
            </div>

        </div>

        <div class="bg-blue-950 text-center py-4 text-xs text-blue-300">
            © <?= date('Y') ?> <?= esc($site['site_name'] ?? 'BALIPROV CSIRT') ?>
        </div>
    </footer>

    <script src="<?= base_url('assets/js/app.js') ?>"></script>



</body>

</html>