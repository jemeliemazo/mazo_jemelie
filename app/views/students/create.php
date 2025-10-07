<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Add Student</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-pink-100 via-purple-100 to-blue-100 min-h-screen flex items-center justify-center p-6">

  <div class="max-w-3xl w-full bg-white shadow-2xl rounded-2xl p-8">
    <h1 class="text-3xl font-bold text-pink-600 mb-6 text-center">➕ Add Student</h1>

    <form method="post" action="<?php echo site_url('students/store'); ?>">
      <input type="hidden" name="page" value="<?= $_GET['page'] ?? 1 ?>" />
      <div class="mb-4">
        <label for="last_name" class="block text-gray-700 font-semibold mb-2">Last Name</label>
        <input type="text" id="last_name" name="last_name" required
               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-400" />
      </div>

      <div class="mb-4">
        <label for="first_name" class="block text-gray-700 font-semibold mb-2">First Name</label>
        <input type="text" id="first_name" name="first_name" required
               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-400" />
      </div>

      <div class="mb-6">
        <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
        <input type="email" id="email" name="email" required
               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-400" />
      </div>

      <div class="flex justify-between items-center">
        <a href="<?php echo site_url('students/index/' . ($_GET['page'] ?? 1)); ?>"
           class="text-pink-600 hover:underline">← Back to List</a>
        <button type="submit"
                class="bg-gradient-to-r from-pink-400 to-pink-500 text-white px-6 py-2 rounded-full shadow-md hover:scale-105 transition">
          Add Student
        </button>
      </div>
    </form>
  </div>

</body>
</html>
