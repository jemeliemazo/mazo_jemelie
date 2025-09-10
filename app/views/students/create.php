<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Add Student</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-pink-100 via-purple-100 to-blue-100 min-h-screen flex items-center justify-center p-6">

  <div class="max-w-3xl w-full bg-white shadow-2xl rounded-2xl p-8 flex gap-8">
    
    <!-- Left Side: Form -->
    <div class="flex-1">
      <h2 class="text-3xl font-bold text-pink-600 mb-6 text-center">✨ Add New Student ✨</h2>

      <form action="/students/store" method="post" class="space-y-5">
        
        <div>
          <label class="block font-semibold text-gray-700 mb-1">📝 Last Name</label>
          <input type="text" name="last_name" 
                 class="w-full border-2 border-pink-300 px-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-pink-400"
                 required>
        </div>

        <div>
          <label class="block font-semibold text-gray-700 mb-1">📝 First Name</label>
          <input type="text" name="first_name" 
                 class="w-full border-2 border-purple-300 px-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-purple-400"
                 required>
        </div>

        <div>
          <label class="block font-semibold text-gray-700 mb-1">📧 Email</label>
          <input type="email" name="email" 
                 class="w-full border-2 border-blue-300 px-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-400"
                 required>
        </div>

        <div class="flex justify-between pt-4">
          <a href="/students/index" 
             class="bg-gradient-to-r from-gray-400 to-gray-500 text-white px-5 py-2 rounded-full shadow hover:scale-105 transition">
            ⬅ Back
          </a>

          <button type="submit" 
                  class="bg-gradient-to-r from-green-400 to-green-500 text-white px-6 py-2 rounded-full shadow hover:scale-105 transition">
            💾 Save
          </button>
        </div>
      </form>
    </div>

    <!-- Right Side: Cute GIF -->
    <div class="w-1/3 flex items-center justify-center">
      <div class="bg-pink-100 border-4 border-pink-300 rounded-2xl p-4 shadow-md">
        <img src="https://media.tenor.com/apGSV-Mt_bgAAAAj/tkthao219-bubududu.gif" 
             alt="Cute Gif" 
             class="rounded-xl shadow-lg w-full object-cover">
      </div>
    </div>

  </div>

</body>
</html>
