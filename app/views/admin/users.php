<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin - Users</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen p-8" style="background: linear-gradient(135deg,#012a4a 0%, #0077b6 50%, #00b4d8 100%); color: #e6f7ff;">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Admin - Users</h1>
        <div style="background: rgba(3,57,80,0.16); padding:1.5rem; border-radius:0.5rem; box-shadow:0 10px 30px rgba(2,35,49,0.45); border:1px solid rgba(255,255,255,0.04);">
            <div class="flex justify-between items-center mb-4">
                <?php $page_q = isset($_GET['page']) ? '?page='.(int)$_GET['page'] : ''; ?>
                <?php if (isset($_GET['q']) && $_GET['q'] !== '') { $page_q = '?q=' . urlencode($_GET['q']) . (isset($_GET['page']) ? '&page='.(int)$_GET['page'] : ''); } ?>
                <a href="<?= site_url('') . $page_q ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-400 hover:from-blue-500 rounded text-sm text-white">
                    <i class="fa-solid fa-arrow-left"></i> Back to Users
                </a>
                <div></div>
            </div>
            <table class="w-full text-left">
                <thead>
                    <tr class="text-sm text-gray-300">
                        <th class="p-2">ID</th>
                        <th class="p-2">Email</th>
                        <th class="p-2">Name</th>
                        <th class="p-2">Role</th>
                        <th class="p-2">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-200">
                    <?php foreach ($users as $u): ?>
                        <tr class="border-t border-gray-700">
                            <td class="p-2"><?= $u['id'] ?></td>
                            <td class="p-2"><?= htmlspecialchars($u['email']) ?></td>
                            <td class="p-2"><?= htmlspecialchars(($u['fname'] ?? '') . ' ' . ($u['lname'] ?? '')) ?></td>
                            <td class="p-2"><?= htmlspecialchars($u['role'] ?? 'user') ?></td>
                            <td class="p-2">
                                <form method="post" action="<?= site_url('admin/set_role/'.$u['id']) ?><?= isset($_GET['page']) ? '?page='.(int)$_GET['page'] : '' ?>">
                                    <select name="role" class="bg-gray-700 text-white px-2 py-1 rounded">
                                        <option value="user" <?= (isset($u['role']) && $u['role'] === 'user') ? 'selected' : '' ?>>User</option>
                                        <option value="admin" <?= (isset($u['role']) && $u['role'] === 'admin') ? 'selected' : '' ?>>Admin</option>
                                    </select>
                                    <button type="submit" class="ml-2 bg-indigo-600 px-3 py-1 rounded">Save</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="mt-4">
                <?= $pagination_html ?? '' ?>
            </div>
        </div>
    </div>
</body>
</html>