<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>404 - Halaman Tidak Ditemukan</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>


<body class="bg-gray-900 min-h-screen flex flex-col">

    <!-- MAIN -->
    <main class="flex-1 flex items-center justify-center px-6 py-20">
        <div class="max-w-2xl w-full text-center">

            <!-- Grid background decoration -->
            <div class="relative mb-10">


                <p class="text-white select-none leading-none mb-6"
                    style="font-family:'Syne',sans-serif;font-size:200px;font-weight:800;letter-spacing:-12px;line-height:1;opacity:0.15;">
                    404
                </p>


            </div>

            <!-- Teks -->
            <div class="mb-10">
                <h1 class="text-3xl font-bold text-white mb-4 leading-tight">
                    Halaman Tidak Ditemukan
                </h1>
                <p class="text-blue-300 text-base leading-relaxed max-w-md mx-auto">
                    Halaman yang Anda cari tidak tersedia atau telah dipindahkan
                </p>
            </div>

            <!-- Divider -->
            <div class="flex justify-center mb-12">
                <div class="w-20 h-[2px] bg-white"></div>
            </div>
            <!-- CTA kembali -->
            <a href="/"
                class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-semibold px-8 py-3 rounded transition text-sm">
                <svg width="20" height="20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali ke Beranda
            </a>
            <div class="mt-10">
                <p class="text-white text-xs tracking-wide opacity-80">
                    © <?= date('Y') ?> BALIPROV-CSIRT
                </p>
            </div>


        </div>
    </main>


</body>

</html>