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
                Create account
            </div>

            <!-- login -->
            <form action="<?= site_url('/register') ?>" method="post">
                <label for="name" class="font-medium">Name</label>
                <input type="text" name="name" id="name" class="border border-neutral-400 px-2 py-2 rounded w-96 block mt-1 mb-4" placeholder="Enter name" required>

                <label for="email" class="font-medium">Email</label>
                <input type="email" name="email" id="email" class="border border-neutral-400 px-2 py-2 rounded w-96 block mt-1 mb-4" placeholder="Enter email" required>


                <label for="password" class="font-medium">Password</label>
                <input type="password" name="password" id="password" class="border border-neutral-400 px-2 py-2 rounded w-96 block mt-1 mb-4" placeholder="Enter password" required>

                <label for="confPassword" class="font-medium">Confirm password</label>
                <input type="password" name="confPassword" id="confPassword" class="border border-neutral-400 px-2 py-2 rounded w-96 block mt-1 mb-4" placeholder="Confirm password" required>

                <input type="submit" value="Create account" class="px-4 py-2 my-4 bg-blue-500 w-full rounded text-white cursor-pointer hover:bg-blue-600 active:bg-blue-700">

                <!-- register -->
                <div class=" w-full text-center">
                    <a href="<?= site_url('/') ?>" class="text-blue-500 hover:text-blue-600 active:text-blue-700">Sign in</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>