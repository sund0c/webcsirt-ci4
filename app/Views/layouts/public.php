<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'CSIRT Provinsi') ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">

</head>

<body class="bg-gray-50 text-gray-800">

    <!-- HEADER -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <!-- Logo -->
            <div>
                <h1 class="text-lg md:text-xl font-semibold text-blue-800">
                    CSIRT Provinsi
                </h1>
                <p class="text-xs text-gray-500 hidden md:block">
                    Tim Tanggap Insiden Siber Pemerintah Daerah
                </p>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex space-x-6 text-sm font-medium items-center">

                <a href="/" class="hover:text-blue-700">Beranda</a>
                <a href="/tentang" class="hover:text-blue-700">Tentang</a>
                <a href="/advisory" class="hover:text-blue-700">Advisory</a>
                <a href="/kontak" class="hover:text-blue-700">Kontak</a>

                <a href="/lapor"
                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                    Laporkan Insiden
                </a>
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
            <a href="/tentang" class="block py-2">Tentang</a>
            <a href="/advisory" class="block py-2">Advisory</a>
            <a href="/kontak" class="block py-2">Kontak</a>

        </div>
    </header>



    <!-- CONTENT -->
    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <!-- FOOTER -->
    <footer class="bg-blue-900 text-white mt-20">
        <div class="max-w-7xl mx-auto px-6 py-10 grid md:grid-cols-3 gap-8 text-sm">

            <div>
                <h3 class="font-semibold mb-3">Tentang CSIRT</h3>
                <p class="text-blue-200">
                    CSIRT Provinsi bertugas dalam penanganan insiden siber,
                    koordinasi keamanan informasi, dan peningkatan ketahanan siber pemerintah daerah.
                </p>
            </div>

            <div>
                <h3 class="font-semibold mb-3">Kontak Resmi</h3>
                <p>Email: csirt@prov.go.id</p>
                <p>Hotline: (0361) 123456</p>
                <p>Jam Operasional: 08.00 – 16.00 WITA</p>
            </div>

            <div>
                <h3 class="font-semibold mb-3">Informasi</h3>
                <p><a href="/privacy" class="hover:underline">Kebijakan Privasi</a></p>
                <p><a href="/disclaimer" class="hover:underline">Disclaimer</a></p>
            </div>

        </div>

        <div class="bg-blue-950 text-center py-4 text-xs text-blue-300">
            © <?= date('Y') ?> Pemerintah Provinsi. Semua Hak Dilindungi.
        </div>
    </footer>

    <script>
        document.getElementById('menuBtn').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.classList.toggle('hidden');
        });
    </script>


</body>

</html>