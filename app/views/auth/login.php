<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-pink-100 via-purple-100 to-blue-100 min-h-screen flex items-center justify-center p-6">

  <div class="max-w-md w-full bg-white shadow-2xl rounded-2xl p-8">
    <h1 class="text-3xl font-bold text-pink-600 mb-6 text-center">🔐 Login</h1>

    <?php if (!empty($error)): ?>
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <form method="post" action="<?php echo site_url('login'); ?>" class="space-y-4">
      <div>
        <label for="username" class="block text-gray-700 font-medium mb-2">Username</label>
        <input type="text" id="username" name="username" required
               class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-pink-400">
      </div>

      <div>
        <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
        <input type="password" id="password" name="password" required
               class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-pink-400">
      </div>

      <button type="submit"
              class="w-full bg-gradient-to-r from-pink-400 to-pink-500 text-white py-2 rounded-full shadow-md hover:scale-105 transition">
        Login
      </button>
    </form>

    <div class="mt-4 text-center text-gray-600">
      <p>Demo accounts:</p>
      <p>Admin: admin / admin</p>
      <p>User: user / user</p>
    </div>
  </div>

</body>
</html>
