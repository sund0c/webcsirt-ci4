<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?= esc($page['title']) ?></title>
    <link rel="stylesheet" href="/assets/css/app.css">
</head>

<body class="bg-gray-100">

    <div class="max-w-4xl mx-auto p-8 bg-white shadow mt-10 rounded">

        <h1 class="text-3xl font-bold mb-6">
            <?= esc($page['title']) ?>
        </h1>

        <div class="prose">
            <?= esc($page['body']) ?>
        </div>

    </div>

</body>

</html>