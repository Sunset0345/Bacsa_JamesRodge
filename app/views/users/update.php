<!DOCTYPE html>
<html lang="en">
  <style>
    body { background: linear-gradient(135deg,#012a4a 0%, #0077b6 50%, #00b4d8 100%); }
    .glass-container { background: rgba(3,57,80,0.16); backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.06); box-shadow: 0 10px 30px rgba(2,35,49,0.45); }
    .badge-sea { background: linear-gradient(90deg,#0096c7,#00b4d8); color:#012a4a; }
  </style>
    }
    .table-bg {
      background: rgba(255, 255, 255, 0.05);
    }
  </style>
</head>
<body class="font-sans text-white">

  <div class="max-w-6xl mx-auto mt-10 p-8 rounded-3xl glass-container">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-4xl font-extrabold text-white drop-shadow-lg">User Directory</h1>
      <div class="flex items-center gap-4">
        <form method="get" action="<?=site_url('')?>" class="flex items-center gap-2">
          <input type="text" name="q" value="<?= isset($q) ? htmlspecialchars($q, ENT_QUOTES) : '' ?>" placeholder="Search name or email"
            class="px-4 py-2 rounded-full bg-white bg-opacity-10 text-white focus:outline-none" />
          <button type="submit" class="px-4 py-2 rounded-full bg-indigo-600 hover:bg-indigo-500">Search</button>
        </form>

        <!-- show signed-in user and logout -->
        <?php $uid = function_exists('lava_instance') ? lava_instance()->session->userdata('user_id') : null; ?>
        <?php if ($uid): ?>
          <?php $suser = lava_instance()->UsersModel->find($uid); ?>
          <div class="text-sm text-white">Signed in as <strong><?= htmlspecialchars($suser['email'] ?? 'unknown') ?></strong>
            <a href="<?= site_url('auth/logout') ?>" class="ml-3 text-indigo-300 hover:underline">Logout</a>
            <?php if (isset($suser['role']) && $suser['role'] === 'admin'): ?>
              <a href="<?= site_url('admin') ?>" class="ml-3 text-indigo-300 hover:underline">Admin Panel</a>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <div class="overflow-x-auto rounded-xl">
      <!-- Instead of the table, show the update form centered inside the glass container -->
      <div class="w-full flex justify-center py-8">
        <div class="w-full max-w-2xl bg-white/5 backdrop-blur-md p-8 rounded-2xl border border-gray-700">
          <div class="flex items-center gap-4 mb-4">
            <div class="bg-gradient-to-br from-cyan-500 to-blue-600 rounded-full p-3 shadow-md">
              <i class="fa-solid fa-user-pen text-white text-2xl"></i>
            </div>
            <div>
              <h2 class="text-2xl font-bold text-white">Update User</h2>
              <p class="text-sky-200 text-sm">Edit user details. Leave password blank to keep current password.</p>
            </div>
          </div>

          <?php $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1; ?>
          <?php $q_param = isset($q) ? $q : ''; ?>
          <form action="<?=site_url('index.php/users/update/'.$user['id'])?>" method="POST">
            <input type="hidden" name="page" value="<?= $current_page ?>">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
              <!-- Left: Avatar / Info -->
              <div class="md:col-span-1 flex flex-col items-center text-center">
                <div class="w-32 h-32 rounded-full flex items-center justify-center text-4xl font-bold text-white" style="background:linear-gradient(90deg,#0077b6,#00b4d8)">
                  <?= strtoupper(substr(($user['fname'] ?? 'U'),0,1) . substr(($user['lname'] ?? ''),0,1)) ?>
                </div>
                <h3 class="mt-4 text-lg font-semibold text-white"><?= htmlspecialchars(($user['fname'] ?? '') . ' ' . ($user['lname'] ?? '')) ?></h3>
                <p class="text-sky-100 text-sm">ID: <?= $user['id'] ?></p>
                <p class="mt-2 text-sm text-sky-200">Edit profile details and update the account information.</p>
              </div>

              <!-- Right: Form fields -->
              <div class="md:col-span-2">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <div>
                    <label class="block text-sky-100 mb-1 font-medium">First Name</label>
                    <div class="relative">
                      <span class="absolute left-3 top-3 text-sky-300"><i class="fa-solid fa-user"></i></span>
                      <input type="text" name="fname" value="<?= html_escape($user['fname'])?>" required
                           class="pl-10 w-full px-4 py-3 bg-[rgba(1,42,74,0.08)] text-white border border-[rgba(255,255,255,0.04)] rounded-xl focus:ring-2 focus:ring-sky-400 focus:outline-none shadow-sm transition duration-200">
                    </div>
                  </div>

                  <div>
                    <label class="block text-sky-100 mb-1 font-medium">Last Name</label>
                    <div class="relative">
                      <span class="absolute left-3 top-3 text-sky-300"><i class="fa-solid fa-user"></i></span>
                      <input type="text" name="lname" value="<?= html_escape($user['lname'])?>" required
                           class="pl-10 w-full px-4 py-3 bg-[rgba(1,42,74,0.08)] text-white border border-[rgba(255,255,255,0.04)] rounded-xl focus:ring-2 focus:ring-sky-400 focus:outline-none shadow-sm transition duration-200">
                    </div>
                  </div>
                </div>

                <div class="mt-4">
                  <label class="block text-sky-100 mb-1 font-medium">Email Address</label>
                  <div class="relative">
                    <span class="absolute left-3 top-3 text-sky-300"><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" name="email" value="<?= html_escape($user['email'])?>" required
                         class="pl-10 w-full px-4 py-3 bg-[rgba(1,42,74,0.08)] text-white border border-[rgba(255,255,255,0.04)] rounded-xl focus:ring-2 focus:ring-sky-400 focus:outline-none shadow-sm transition duration-200">
                  </div>
                </div>

                <div class="mt-4">
                  <label class="block text-sky-100 mb-1 font-medium">Password <span class="text-xs text-sky-200">(leave blank to keep current)</span></label>
                  <div class="relative">
                    <span class="absolute left-3 top-3 text-sky-300"><i class="fa-solid fa-key"></i></span>
                    <input type="password" name="password" value=""
                         class="pl-10 w-full px-4 py-3 bg-[rgba(1,42,74,0.08)] text-white border border-[rgba(255,255,255,0.04)] rounded-xl focus:ring-2 focus:ring-sky-400 focus:outline-none shadow-sm transition duration-200">
                  </div>
                </div>

                <div class="mt-6 flex gap-3 items-center">
                  <button type="submit" class="flex-1 bg-gradient-to-r from-cyan-500 to-blue-400 hover:from-blue-500 hover:to-sky-500 text-white font-semibold py-3 rounded-xl shadow-lg transition duration-200">
                    <i class="fa-solid fa-save mr-2"></i> Update Now
                  </button>

                  <?php $back_q = $q_param !== '' ? '?q=' . urlencode($q_param) . '&page=' . $current_page : '?page=' . $current_page; ?>
                  <a href="<?= site_url('') . $back_q ?>" class="px-4 py-3 bg-[rgba(2,35,49,0.6)] text-sky-100 rounded-xl hover:bg-[rgba(2,35,49,0.8)] transition duration-200">Cancel</a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
        
    <div class="mt-6">
      <!-- empty spot for pagination if needed -->
    </div>
  </div>
</body>
</html>