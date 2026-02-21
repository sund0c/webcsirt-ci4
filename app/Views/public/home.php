<?= $this->extend('public/layout') ?>
<?= $this->section('content') ?>





<!-- ── HERO ── -->

<section class="relative py-24 bg-blue-950 hero-bg">

    <div class="max-w-6xl mx-auto px-6">

        <h1 class="text-3xl md:text-4xl font-bold text-white text-center leading-tight mb-6">

            <?= esc($sections['hero']['title'] ?? 'BALIPROV CSIRT') ?>
        </h1>

        <p class="text-base md:text-lg text-blue-200 text-center leading-relaxed mb-10 max-w-3xl mx-auto">
            <?= esc($sections['hero']['subtitle'] ?? 'BALIPROV CSIRT') ?>
        </p>

        <div class="flex justify-center gap-3">
            <a href="<?= esc($sections['hero']['button_link'] ?? '#') ?>"
                class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded transition">
                <?= esc($sections['hero']['button_text'] ?? 'BALIPROV CSIRT') ?>
            </a>
        </div>

    </div>
</section>



<!-- ── SECURITY ADVISORY ── -->
<section class="py-20 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6">

        <div class="flex justify-between items-center mb-10">
            <div>
                <p class="text-xs font-semibold uppercase text-red-600 mb-2">SECURITY ADVISORIES</p>
                <h2 class="text-3xl font-bold text-gray-800">Himbauan Keamanan</h2>
            </div>
            <a href="/advisory"
                class="bg-blue-800 hover:bg-blue-900 text-white font-semibold px-5 py-3 rounded transition text-sm">
                Lihat Semua
            </a>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <?php foreach ($advisories as $adv): ?>
                <div class="bg-white rounded-xl shadow p-6 border-t-4 border-red-600 hover:shadow-md transition flex flex-col">
                    <h3 class="font-bold text-gray-800 text-lg mb-3 leading-tight">
                        <?= esc($adv['title'] ?? 'BALIPROV CSIRT') ?>
                    </h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6 flex-1">
                        <?= esc($adv['excerpt'] ?? 'BALIPROV CSIRT') ?>
                    </p>
                    <div class="flex justify-between items-center border-t border-gray-200 pt-4">
                        <span class="text-xs text-gray-500">
                            <?= esc($adv['published_at']
                                ? date('d M Y', strtotime($adv['published_at']))
                                : '-') ?></span>
                        <a href="#" class="text-red-600 text-xs font-semibold hover:underline">Detail →</a>
                    </div>
                </div>
            <?php endforeach; ?>


        </div>
    </div>
</section>

<!-- ── TENTANG ── -->
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-6">

        <div>
            <p class="text-xs font-semibold uppercase text-blue-700 mb-3"><?= esc($sections['about']['title'] ?? 'BALIPROV CSIRT') ?></p>
            <h2 class="text-3xl font-bold text-gray-800 mb-6 leading-tight">
                <?= esc($sections['about']['subtitle'] ?? 'BALIPROV CSIRT') ?>
            </h2>
            <p class="text-gray-600 leading-relaxed mb-8">
                <?= esc($sections['about']['content'] ?? 'BALIPROV CSIRT') ?>
            </p>

        </div>

    </div>
</section>

<?php
function renderIcon($name)
{
    switch ($name) {
        case 'shield':
            return '<svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 3l7 4v5c0 5-3.5 9-7 9s-7-4-7-9V7l7-4z"/>
                    </svg>';

        case 'target':
            return '<svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="9"/>
                        <circle cx="12" cy="12" r="5"/>
                        <circle cx="12" cy="12" r="1" fill="currentColor"/>
                    </svg>';

        default:
            return '<svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>';
    }
}

?>

<!-- ── LAYANAN ── -->
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-6">

        <div class="text-center mb-10">
            <p class="text-xs font-semibold uppercase text-blue-700 mb-2">Apa yang Kami Lakukan</p>
            <h2 class="text-3xl font-bold text-gray-800">Layanan Tim TIS Pemprov Bali</h2>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <?php foreach ($services as $service): ?>
                <div class="bg-gray-50 rounded-xl p-8 border border-gray-200 hover:shadow-md transition">
                    <!-- <div class="text-3xl mb-4"></div> -->
                    <div class="flex justify-center mb-6">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-100 rounded-xl">
                            <?= renderIcon($service['icon'] ?? '') ?>
                        </div>
                    </div>

                    <h3 class="font-bold text-gray-800 text-lg mb-3"><?= esc($service['title'] ?? 'BALIPROV CSIRT') ?></h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        <?= esc($service['description'] ?? 'BALIPROV CSIRT') ?>
                    </p>
                </div>
            <?php endforeach; ?>

        </div>

    </div>
</section>


<!-- ── KONTAK ── -->
<section id="kontak" class="py-20 bg-gray-900">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-10 items-center">

            <div>
                <p class="text-xs font-semibold uppercase text-red-300 mb-3">Butuh Informasi ?</p>
                <h2 class="text-3xl font-bold text-white mb-4 leading-tight">
                    Kontak Tim TIS
                </h2>
                <p class="text-gray-300 leading-relaxed mb-8">
                    Hubungi kami terkait insiden keamanan siber Pemprov Bali melalui saluran resmi berikut.
                </p>
                <div class="space-y-3">
                    <div class="flex items-center gap-3 bg-blue-950 rounded-lg p-4 border border-blue-800">
                        <span class="text-xl">✉️</span>
                        <div>
                            <div class="text-blue-300 text-xs uppercase font-semibold mb-1">Email Resmi</div>
                            <div class="text-white font-medium"><?= esc($site['site_email'] ?? 'BALIPROV CSIRT') ?></div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 bg-blue-950 rounded-lg p-4 border border-blue-800">
                        <span class="text-xl">📞</span>
                        <div>
                            <div class="text-blue-300 text-xs uppercase font-semibold mb-1">Telepon Darurat</div>
                            <div class="text-white font-medium"><?= esc($site['site_phone'] ?? 'BALIPROV CSIRT') ?></div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 bg-blue-950 rounded-lg p-4 border border-blue-800">
                        <span class="text-xl">📍</span>
                        <div>
                            <div class="text-blue-300 text-xs uppercase font-semibold mb-1">Alamat</div>
                            <div class="text-white font-medium"><?= esc($site['site_address'] ?? 'BALIPROV CSIRT') ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-blue-950 rounded-xl p-8 border border-blue-800">
                <p class="text-xs font-semibold uppercase text-blue-300 mb-6">Website Tim TIS Pemerintah Kota/Kab se-Bali</p>
                <?php foreach ($csirtbalis as $cs): ?>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <span class="text-red-600">
                                ›
                            </span>
                            <a href="<?= esc($cs['site_link'] ?? 'BALIPROV CSIRT') ?>" class="text-gray-300 text-sm hover:text-white hover:underline">
                                <?= esc($cs['title'] ?? 'BALIPROV CSIRT') ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>

        </div>
    </div>
</section>

<!-- ── CTA ── -->
<section class="py-20 bg-blue-800">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">
            #jagaRuangSiber
        </h2>
        <p class="text-blue-200 text-base leading-relaxed mb-8">
            Laporkan kerentanan atau insiden yang Anda temukan. Laporan yang dinyatakan valid dan belum pernah terlaporkan, akan mendapatkan sertifikat apresiasi.
            Mari bersama kita jaga ruang siber Pemprov Bali.
        </p>
        <div class="flex justify-center gap-3">
            <a href="<?= esc($site['kanal_aduan'] ?? 'BALIPROV CSIRT') ?>"
                class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded transition">
                Laporkan Kerentanan Aset TI Pemprov Bali
            </a>
        </div>
    </div>
</section>

<?= $this->endSection() ?>