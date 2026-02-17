<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="/assets/css/app.css">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded shadow w-96">
        <h2 class="text-xl font-bold mb-6 text-center">Login Admin</h2>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form method="post" action="/portal-internal-x83fj9/attempt">
            <?= csrf_field() ?>

            <div class="mb-4">
                <label class="block mb-1">Username</label>
                <input type="text" name="username"
                    class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Password</label>
                <input type="password" name="password"
                    class="w-full border p-2 rounded" required>
            </div>

            <button type="submit"
                class="w-full bg-blue-700 text-white p-2 rounded hover:bg-blue-900">
                Login
            </button>
        </form>
    </div>

</body>

</html>