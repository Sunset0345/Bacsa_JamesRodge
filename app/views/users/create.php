<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Sign Up</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
  <body class="min-h-screen flex items-center justify-center font-sans text-gray-100">

  <div class="w-full max-w-md p-8 rounded-3xl shadow-2xl animate-fadeIn border border-gray-700" style="background: rgba(5,64,91,0.16); backdrop-filter: blur(8px); box-shadow: 0 10px 30px rgba(2,35,49,0.45);">
    
    <!-- Header -->
    <div class="flex flex-col items-center mb-6">
      <div class="bg-gradient-to-br from-cyan-500 to-blue-600 rounded-full p-3 shadow-md">
        <i class="fa-solid fa-user-graduate text-white text-3xl drop-shadow-lg"></i>
      </div>
      <h2 class="text-2xl font-bold text-white mt-3">Create Your Student Account</h2>
      <p class="text-sky-200 text-sm">Join our oceanic community today!</p>
    </div>

    <!-- Form -->
    <?php $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1; ?>
  <form action="<?=site_url('index.php/users/create')?>" method="POST" class="space-y-5">
      <input type="hidden" name="page" value="<?= $current_page ?>">
      
      <!-- First Name -->
      <div>
        <label class="block text-gray-300 mb-1 font-medium">First Name</label>
   <input type="text" name="fname" placeholder="Enter your first name" required
     class="w-full px-4 py-3 bg-[rgba(1,42,74,0.12)] text-white border border-[rgba(255,255,255,0.06)] rounded-xl focus:ring-2 focus:ring-sky-400 focus:outline-none shadow-sm transition duration-200">
      </div>

      <!-- Last Name -->
      <div>
        <label class="block text-gray-300 mb-1 font-medium">Last Name</label>
        <input type="text" name="lname" placeholder="Enter your last name" required
               class="w-full px-4 py-3 bg-black/30 text-gray-200 border border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none shadow-sm transition duration-200">
      </div>

      <!-- Email -->
      <div>
        <label class="block text-gray-300 mb-1 font-medium">Email Address</label>
        <input type="email" name="email" placeholder="Enter your email" required
               class="w-full px-4 py-3 bg-black/30 text-gray-200 border border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none shadow-sm transition duration-200">
      </div>

      <!-- Password -->
      <div>
        <label class="block text-gray-300 mb-1 font-medium">Password (optional)</label>
        <input type="password" name="password" placeholder="Set a password (admin only)"
               class="w-full px-4 py-3 bg-black/30 text-gray-200 border border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none shadow-sm transition duration-200">
      </div>

      <!-- Role (admin only) -->
      <?php $role = function_exists('lava_instance') ? lava_instance()->session->userdata('role') : null; ?>
      <?php if ($role === 'admin'): ?>
      <div>
        <label class="block text-gray-300 mb-1 font-medium">Role</label>
        <select name="role" class="w-full px-4 py-3 bg-black/30 text-gray-200 border border-gray-600 rounded-xl">
          <option value="user">User</option>
          <option value="admin">Admin</option>
        </select>
      </div>
      <?php endif; ?>

      <!-- Sign Up Button -->
  <button type="submit"
      class="w-full bg-gradient-to-r from-cyan-500 to-blue-400 hover:from-blue-500 hover:to-sky-500 text-white font-semibold py-3 rounded-xl shadow-lg transition duration-300 transform hover:scale-105">
    <i class="fa-solid fa-user-plus mr-2"></i> Sign Up
  </button>
    </form>
  </div>
</body>
</html>