<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Login</title>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
<div class="absolute top-4 left-1/2 transform -translate-x-1/2 w-96">
<!-- //--------------------------flash message-------- -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="text-red-500 mb-4 p-2 bg-red-100 border border-red-400 rounded relative">
                <button onclick="this.parentElement.style.display='none'" class="absolute top-0 right-0 p-2 text-red-700 hover:text-red-900 bg-transparent border-none">
                    ×
                </button>
                <?php echo session()->getFlashdata('error'); ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="text-green-500 mb-4 p-2 bg-green-100 border border-green-400 rounded relative">
                <button onclick="this.parentElement.style.display='none'" class="absolute top-0 right-0 p-2 text-green-700 hover:text-green-900 bg-transparent border-none">
                    ×
                </button>
                <?php echo session()->getFlashdata('success'); ?>
            </div>
        <?php endif; ?>
    </div>


    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h1 class="text-3xl font-semibold text-center text-gray-700 mb-6">Login</h1>
        <form action="<?= base_url('/login') ?>" method="post">
            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter your email"
                    class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-medium mb-2">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password"
                    class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <!-- Submit Button -->
            <div class="mb-4">
                <button type="submit"
                    class="w-full py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Login
                </button>
            </div>

            <!-- not register user -->
            <div class="text-center">
                <p class="text-sm text-gray-600">Don't have an account? <a href="/signup" class="text-blue-500 hover:underline">register here</a></p>
            </div>
        </form>
    </div>

</body>

</html>