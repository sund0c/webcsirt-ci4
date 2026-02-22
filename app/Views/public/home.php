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
                        <a href="<?= base_url('advisory/' . esc($adv['slug'])) ?>" class="text-red-600 text-xs font-semibold hover:underline">Detail →</a>
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
            <div class="text-gray-600 leading-relaxed mb-8">
                <?= $sections['about']['content'] ?? 'BALIPROV CSIRT' ?>
            </div>

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
        case 'reaktif':
            return '<svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M3.124 7.5A8.969 8.969 0 015.292 3m13.416 0a8.969 8.969 0 012.168 4.5" />
                    </svg>';
        case 'proaktif':
            return '<svg class="w-10 h-10 text-blue-700" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.864 4.243A7.5 7.5 0 0119.5 10.5c0 2.92-.556 5.709-1.568 8.268M5.742 6.364A7.465 7.465 0 004.5 10.5a7.464 7.464 0 01-1.15 3.993m1.989 3.559A11.209 11.209 0 008.25 10.5a3.75 3.75 0 117.5 0c0 .527-.021 1.049-.064 1.565M12 10.5a14.94 14.94 0 01-3.6 9.75m6.633-4.596a18.666 18.666 0 01-2.485 5.33" />
                    </svg>';
        case 'manajemen':
            return '<svg class="w-10 h-10 text-blue-800" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
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