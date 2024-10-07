<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Auth</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-0 m-0 box-border bg-gray-100">
    <header>
        <nav class="sticky top-0 mb-8 p-8 flex items-center justify-between bg-white border-b border-neutral-400">
            <div class="text-center text-2xl font-bold">
                <?= $name ?>
            </div>
            <form action="<?= site_url('/logout') ?>" method="POST">
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 active:bg-red-700">Logout</button>
            </form>
        </nav>
    </header>
    <main>
        <div class="flex items-center justify-center">
            <div class="card p-8 border border-neutral-400 shadow rounded-lg bg-white w-1/2">

                <form action="<?= site_url('/dashboard') ?>" method="POST" enctype="multipart/form-data">
                    <!-- Recipient Email -->
                    <div class="mb-4">
                        <label for="toEmail" class="block mb-2 text-sm font-bold">To:</label>
                        <input type="email" name="toEmail" id="toEmail" class="w-full p-2 border border-neutral-300 rounded-lg" required placeholder="Recipient's Email">
                    </div>

                    <!-- Subject -->
                    <div class="mb-4">
                        <label for="subject" class="block mb-2 text-sm font-bold">Subject:</label>
                        <input type="text" name="subject" id="subject" class="w-full p-2 border border-neutral-300 rounded-lg" required placeholder="Email Subject">
                    </div>

                    <!-- Message Body -->
                    <div class="mb-4">
                        <label for="body" class="block mb-2 text-sm font-bold">Message:</label>
                        <textarea name="body" id="body" rows="6" class="w-full p-2 border border-neutral-300 rounded-lg" required placeholder="Type your message here..."></textarea>
                    </div>

                    <!-- Attachment -->
                    <div class="mb-4">
                        <label for="attach" class="block mb-2 text-sm font-bold">Attachment:</label>
                        <input type="file" name="attach" id="attach" size="20" class="w-full p-2 border border-neutral-300 rounded-lg">
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <input type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 active:bg-blue-700 my-4">
                    </div>
                </form>

            </div>
        </div>
    </main>

</body>

</html>