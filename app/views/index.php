<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Auth</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-0 m-0 box-border h-svh bg-red-500">
    <div class="flex items-center justify-center bg-neutral-300 h-full">
        <div class="card p-8 border border-neutral-50 shadow rounded-lg bg-white">

            <div class="text-center text-2xl font-bold mb-8">
                Login
            </div>

            <!-- login -->
            <form action="<?= site_url('/') ?>" method="post">
                <label for="email" class="font-medium">Email</label>
                <input type="email" name="email" id="email" class="border border-neutral-400 px-2 py-2 rounded w-96 block mt-1 mb-4" placeholder="Enter email">

                <label for="password" class="font-medium">Password</label>
                <input type="password" name="password" id="password" class="border border-neutral-400 px-2 py-2 rounded w-96 block mt-1 mb-4" placeholder="Enter password">

                <input type="submit" value="Sign in" class="px-4 py-2 my-4 bg-blue-500 w-full rounded text-white cursor-pointer hover:bg-blue-600 active:bg-blue-700">

                <!-- register -->
                 <div class=" w-full text-center">
                    <a href="<?= site_url('/register') ?>" class="text-blue-500 hover:text-blue-600 active:text-blue-700">Create account</a>
                 </div>
            </form>
        </div>
    </div>
</body>
</html>