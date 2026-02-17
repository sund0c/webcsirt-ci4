<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token-name" content="<?= csrf_token() ?>">
    <meta name="csrf-token-hash" content="<?= csrf_hash() ?>">

    <title><?= esc($title ?? 'Admin') ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>

<body class="bg-gray-100">


    <div class="flex min-h-screen">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-blue-900 text-white flex flex-col">

            <div class="p-6 border-b border-blue-800">
                <h2 class="text-lg font-semibold">CSIRT Admin</h2>
                <p class="text-xs text-blue-300">Provinsi</p>
            </div>

            <nav class="mt-6 space-y-2 text-sm">

                <!-- Dashboard -->
                <a href="/portal-internal-x83fj9/dashboard"
                    class="flex items-center gap-3 px-4 py-2 rounded hover:bg-blue-700">
                    <!-- Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 3h7v7H3V3zm11 0h7v7h-7V3zM3 14h7v7H3v-7zm11 7v-7h7v7h-7z" />
                    </svg>
                    <span>Dashboard</span>
                </a>

                <!-- Articles -->
                <a href="/portal-internal-x83fj9/articles"
                    class="flex items-center gap-3 px-4 py-2 rounded hover:bg-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12h6m-6 4h6M5 4h14v16H5z" />
                    </svg>
                    <span>Articles</span>
                </a>

                <!-- Advisory -->
                <a href="/portal-internal-x83fj9/advisories"
                    class="flex items-center gap-3 px-4 py-2 rounded hover:bg-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 9v2m0 4h.01M5.07 19h13.86L12 4 5.07 19z" />
                    </svg>
                    <span>Advisory</span>
                </a>

                <!-- Pages -->
                <a href="/portal-internal-x83fj9/pages"
                    class="flex items-center gap-3 px-4 py-2 rounded hover:bg-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M7 8h10M7 12h6m-6 4h10M5 4h14v16H5z" />
                    </svg>
                    <span>Pages</span>
                </a>

                <!-- Guides -->
                <a href="/portal-internal-x83fj9/guides"
                    class="flex items-center gap-3 px-4 py-2 rounded hover:bg-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M7 8h10M7 12h6m-6 4h10M5 4h14v16H5z" />
                    </svg>
                    <span>Guides</span>
                </a>

            </nav>



            <div class="p-4 border-t border-blue-800 text-sm">
                <a href="/portal-internal-x83fj9/logout"
                    class="text-red-300 hover:text-red-100">
                    Logout
                </a>
            </div>

        </aside>

        <!-- CONTENT AREA -->
        <div class="flex-1 flex flex-col">

            <!-- TOPBAR -->
            <header class="bg-white shadow-sm px-8 py-4 flex justify-between items-center">
                <h1 class="text-lg font-semibold text-gray-800">
                    <?= esc($title ?? '') ?>
                </h1>

                <div class="text-sm text-gray-600">
                    <?= esc(session('username')) ?>
                </div>
            </header>

            <!-- MAIN CONTENT -->
            <main class="flex-1 p-8">
                <div class="max-w-6xl mx-auto">
                    <?= $this->renderSection('content') ?>
                </div>
            </main>

        </div>

    </div>

    <link rel="stylesheet" href="<?= base_url('assets/css/datatables.min.css') ?>">
    <script src="<?= base_url('assets/js/datatables.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/datatable-init.js') ?>"></script>

    <?= view('components/toast') ?>
    <script src="<?= base_url('assets/js/toast.js') ?>"></script>

    <script src="<?= base_url('assets/vendor/tinymce/tinymce.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/tinymce-init.js') ?>"></script>


</body>

</html>