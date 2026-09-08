<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit User | Business Portal</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 560px; margin: 48px auto; padding: 0 20px; color: #17324d; }
        form { display: grid; gap: 12px; padding: 24px; border: 1px solid #c9e5f5; border-radius: 8px; }
        input, button { font: inherit; padding: 10px; }
        button { cursor: pointer; background: #2f6690; color: white; border: 0; border-radius: 4px; }
        .error { color: #b42318; background: #fff0ef; border: 1px solid #f4c7c3; padding: 10px 12px; border-radius: 6px; }
        body { max-width: none; min-height: 100vh; margin: 0; padding: 48px 20px; background: #f3f6fa; color: #18324a; }
        main { max-width: 560px; margin: 0 auto; }
        h1 { font-size: 2.25rem; margin-bottom: 8px; }
        form { background: #fff; border: 1px solid #dce5ed; border-radius: 10px; box-shadow: 0 15px 35px rgba(24,50,74,.08); }
        label { font-weight: 600; color: #29445d; }
        input { border-color: #cbd8e3; border-radius: 6px; background: #fbfcfd; }
        input:focus { outline: 3px solid rgba(15,118,110,.15); border-color: #0f766e; }
        button { background: #0f766e; border-radius: 6px; }
        button:hover { background: #0b5f59; }
        a { color: #0f766e; }
    </style>
</head>
<body>
    <h1>Edit user</h1>
    <?php if (!empty($error)): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
    <form method="post" action="<?= site_url('users/update/' . (int) $user['id']) ?>">
        <label for="firstname">First name</label>
        <input id="firstname" name="firstname" value="<?= htmlspecialchars($user['firstname'] ?? '') ?>" required>
        <label for="lastname">Last name</label>
        <input id="lastname" name="lastname" value="<?= htmlspecialchars($user['lastname'] ?? '') ?>" required>
        <label for="email">Email</label>
        <input id="email" name="email" type="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
        <label for="username">Username</label>
        <input id="username" name="username" value="<?= htmlspecialchars($user['username'] ?? '') ?>" required>
        <button type="submit">Save changes</button>
    </form>
    <p><a href="<?= site_url('users') ?>">Cancel</a></p>
</body>
</html>