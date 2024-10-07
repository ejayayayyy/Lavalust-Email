<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-0 m-0 box-border h-screen bg-gray-100">
    <div class="flex items-center justify-center h-full">
        <div class="card p-8 border border-neutral-50 shadow rounded-lg bg-white">
            <div class="text-center text-2xl font-bold mb-8 text-green-500">Verify Your Email</div>
            <p class="mb-8">We have sent a verification link to <strong><?= $email ?></strong>. Please check your email to verify your account.</p>
            <div class="w-full flex items-center justify-center">
                <a href="<?= site_url('/') ?>" class="text-white px-8 py-2 bg-blue-500 hover:bg-blue-600 active:bg-blue-700 rounded-lg">Login</a>
            </div>
        </div>
    </div>
</body>

</html>