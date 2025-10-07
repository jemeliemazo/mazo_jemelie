<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Students List</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-pink-100 via-purple-100 to-blue-100 min-h-screen flex items-center justify-center p-6">

  <div class="max-w-6xl w-full bg-white shadow-2xl rounded-2xl p-8 flex gap-8">

    <!-- Left Side: Students Table -->
    <div class="flex-1">
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-pink-600">🎓 Students List</h1>
        <div class="flex items-center gap-4">
          <span class="text-gray-600">Welcome, <?= htmlspecialchars($username ?? '') ?> (<?= htmlspecialchars($user_role ?? '') ?>)</span>
          <a href="<?php echo site_url('logout'); ?>"
             class="bg-red-400 text-white px-4 py-2 rounded-full shadow hover:scale-105 transition">
            Logout
          </a>
        </div>
      </div>

      <!-- Search Bar -->
      <div class="mb-4 flex justify-center">
        <form method="get" action="<?php echo site_url('students/index'); ?>" class="flex gap-2">
          <input type="text" name="search" value="<?= htmlspecialchars($search ?? '') ?>" placeholder="Search by first name, last name, or email..."
                 class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-pink-400 w-80" />
          <button type="submit"
                  class="bg-gradient-to-r from-blue-400 to-blue-500 text-white px-5 py-2 rounded-full shadow-md hover:scale-105 transition">
            🔍 Search
          </button>
          <?php if (!empty($search)): ?>
            <a href="<?php echo site_url('students/index'); ?>"
               class="bg-gray-400 text-white px-5 py-2 rounded-full shadow-md hover:scale-105 transition">
              Clear
            </a>
          <?php endif; ?>
        </form>
      </div>

      <?php if ($user_role === 'admin'): ?>
      <div class="flex gap-3 justify-center mb-4">
        <a href="<?php echo site_url('students/create?page=' . $current_page); ?>"
           class="bg-gradient-to-r from-pink-400 to-pink-500 text-white px-5 py-2 rounded-full shadow-md hover:scale-105 transition">
          + Add Student
        </a>

        <a href="<?php echo site_url('students/delete_all'); ?>"
           onclick="return confirm('Are you sure you want to delete ALL records?')"
           class="bg-gradient-to-r from-red-400 to-red-500 text-white px-5 py-2 rounded-full shadow-md hover:scale-105 transition">
          🗑 Delete All
        </a>
      </div>
      <?php endif; ?>

      <!-- Students Table -->
      <div class="overflow-x-auto mt-6 rounded-lg shadow-md">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
          <thead>
            <tr class="bg-pink-200 text-pink-900 text-left">
              <th class="py-3 px-4 border-b">ID</th>
              <th class="py-3 px-4 border-b">Last Name</th>
              <th class="py-3 px-4 border-b">First Name</th>
              <th class="py-3 px-4 border-b">Email</th>
              <th class="py-3 px-4 border-b text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($students)): ?>
              <?php foreach ($students as $student): ?>
                <tr class="hover:bg-pink-50 transition">
                  <td class="py-3 px-4 border-b text-gray-700"><?= $student['id'] ?></td>
                  <td class="py-3 px-4 border-b text-gray-700"><?= $student['last_name'] ?></td>
                  <td class="py-3 px-4 border-b text-gray-700"><?= $student['first_name'] ?></td>
                  <td class="py-3 px-4 border-b text-gray-700"><?= $student['email'] ?></td>
                  <td class="py-3 px-4 border-b text-center">
                    <?php if ($user_role === 'admin'): ?>
                    <div class="flex flex-col items-center gap-2">
                      <a href="<?php echo site_url('students/edit/' . $student['id'] . '?page=' . $current_page); ?>"
                         class="bg-blue-400 text-white px-4 py-1 rounded-full shadow hover:scale-105 transition">
                        ✏️ Edit
                      </a>
                      <a href="<?php echo site_url('students/delete/' . $student['id'] . '/' . $current_page); ?>"
                         onclick="return confirm('Are you sure you want to delete this student?')"
                         class="bg-red-400 text-white px-4 py-1 rounded-full shadow hover:scale-105 transition">
                        ❌ Delete
                      </a>
                    </div>
                    <?php else: ?>
                    <span class="text-gray-500">View Only</span>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5" class="text-center py-6 text-gray-500">No students found. 🌸</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>

        <!-- Pagination Info -->
        <div class="mt-4 text-center text-gray-600">
          <?= $pagination_info ?? '' ?>
        </div>

        <!-- Pagination Links -->
        <div class="mt-4">
          <?= $pagination ?? '' ?>
        </div>
      </div>
    </div>

    <!-- Right Side: Cute GIF Placeholder -->
    <div class="w-1/3 flex items-center justify-center">
      <div class="bg-pink-100 border-4 border-pink-300 rounded-2xl p-4 shadow-md">
        <img src="https://media1.tenor.com/m/BoDofDkAurYAAAAd/peachcry-peachmad.gif" 
             alt="Cute Gif" 
             class="rounded-xl shadow-lg w-full object-cover">
      </div>
    </div>
  </div>

</body>
</html>
