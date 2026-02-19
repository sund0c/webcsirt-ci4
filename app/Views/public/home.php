<?= $this->extend('public/layout') ?>

<?= $this->section('content') ?>



<!-- HERO -->
<section class="bg-blue-800 text-white py-20">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">
            CSIRT Provinsi
        </h2>
        <p class="text-base md:text-lg text-blue-100 mb-8">
            Melindungi Infrastruktur Digital Pemerintah dari Ancaman Siber
        </p>
        <div class="flex justify-center">
            <a href="/lapor"
                class="bg-red-600 px-6 py-3 rounded text-white font-semibold hover:bg-red-700">
                Laporkan Insiden Sekarang
            </a>
        </div>
    </div>
</section>


<!-- LAYANAN -->
<section class="py-20">
    <div class="max-w-6xl mx-auto px-6">
        <h3 class="text-2xl font-semibold mb-10 text-center">
            Layanan Kami
        </h3>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white shadow rounded p-6">
                <h4 class="font-semibold mb-3">Penanganan Insiden</h4>
                <p class="text-gray-600 text-sm">
                    Respon cepat terhadap insiden keamanan siber di lingkungan pemerintah daerah.
                </p>
            </div>

            <div class="bg-white shadow rounded p-6">
                <h4 class="font-semibold mb-3">Monitoring Ancaman</h4>
                <p class="text-gray-600 text-sm">
                    Pemantauan berkelanjutan terhadap potensi ancaman dan kerentanan sistem.
                </p>
            </div>

            <div class="bg-white shadow rounded p-6">
                <h4 class="font-semibold mb-3">Edukasi & Advisory</h4>
                <p class="text-gray-600 text-sm">
                    Publikasi panduan keamanan dan peringatan dini terhadap risiko siber.
                </p>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>