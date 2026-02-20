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
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 12l9-9 9 9M4 10v10h16V10" />
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
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5" fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 3l7 4v5c0 5-3 8-7 9-4-1-7-4-7-9V7l7-4z" />
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
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2"
                            d="M12 6v12m0 0c-3-2-6-2-9 0V6c3-2 6-2 9 0m0 12c3-2 6-2 9 0V6c-3-2-6-2-9 0" />
                    </svg>
                    <span>Guides</span>
                </a>

                <!-- landing -->
                <a href="/portal-internal-x83fj9/landing"
                    class="flex items-center gap-3 px-4 py-2 rounded hover:bg-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2"
                            d="M3 4h18v6H3zM3 14h18v6H3z" />
                    </svg>
                    <span>Landing Page</span>
                </a>

                <!-- layanan -->
                <a href="/portal-internal-x83fj9/services"
                    class="flex items-center gap-3 px-4 py-2 rounded hover:bg-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h6v6H4zM14 6h6v6h-6zM4 16h6v6H4zM14 16h6v6h-6z" />
                    </svg>
                    <span>Layanan</span>
                </a>

                <a href="<?= base_url('portal-internal-x83fj9/settings') ?>"
                    class="flex items-center gap-3 px-4 py-2 rounded hover:bg-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M11.983 3a1 1 0 011 1v1.06a7.002 7.002 0 012.121.879l.75-.75a1 1 0 011.414 0l1.414 1.414a1 1 0 010 1.414l-.75.75a7.002 7.002 0 01.879 2.121H20a1 1 0 011 1v2a1 1 0 01-1 1h-1.06a7.002 7.002 0 01-.879 2.121l.75.75a1 1 0 010 1.414l-1.414 1.414a1 1 0 01-1.414 0l-.75-.75a7.002 7.002 0 01-2.121.879V20a1 1 0 01-1 1h-2a1 1 0 01-1-1v-1.06a7.002 7.002 0 01-2.121-.879l-.75.75a1 1 0 01-1.414 0L3.343 17.4a1 1 0 010-1.414l.75-.75a7.002 7.002 0 01-.879-2.121H2a1 1 0 01-1-1v-2a1 1 0 011-1h1.06a7.002 7.002 0 01.879-2.121l-.75-.75a1 1 0 010-1.414L4.603 3.343a1 1 0 011.414 0l.75.75a7.002 7.002 0 012.121-.879V4a1 1 0 011-1h2z" />
                    </svg>
                    <span>Site Settings</span>
                </a>

                <a href="<?= base_url('portal-internal-x83fj9/csirtbalis') ?>"
                    class="flex items-center gap-3 px-4 py-2 rounded hover:bg-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M11.983 3a1 1 0 011 1v1.06a7.002 7.002 0 012.121.879l.75-.75a1 1 0 011.414 0l1.414 1.414a1 1 0 010 1.414l-.75.75a7.002 7.002 0 01.879 2.121H20a1 1 0 011 1v2a1 1 0 01-1 1h-1.06a7.002 7.002 0 01-.879 2.121l.75.75a1 1 0 010 1.414l-1.414 1.414a1 1 0 01-1.414 0l-.75-.75a7.002 7.002 0 01-2.121.879V20a1 1 0 01-1 1h-2a1 1 0 01-1-1v-1.06a7.002 7.002 0 01-2.121-.879l-.75.75a1 1 0 01-1.414 0L3.343 17.4a1 1 0 010-1.414l.75-.75a7.002 7.002 0 01-.879-2.121H2a1 1 0 01-1-1v-2a1 1 0 011-1h1.06a7.002 7.002 0 01.879-2.121l-.75-.75a1 1 0 010-1.414L4.603 3.343a1 1 0 011.414 0l.75.75a7.002 7.002 0 012.121-.879V4a1 1 0 011-1h2z" />
                    </svg>
                    <span>CSIRT se-Bali</span>
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