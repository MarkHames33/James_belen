<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($form_title) ?> | Little Rhyme Roster</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500;600;700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root { --ink: #26354a; --coral: #ef6f61; --yellow: #ffd166; --mint: #a8e6cf; --sky: #bde7f7; --paper: #fffdf7; }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; padding: 44px 20px; color: var(--ink); font-family: 'DM Sans', sans-serif; background: linear-gradient(150deg, #bde7f7 0 42%, #fff1bd 42% 70%, #a8e6cf 70%); }
        main { max-width: 620px; margin: auto; }
        h1 { margin: 0 0 8px; font: 700 clamp(2.2rem, 6vw, 3.5rem)/1 'Baloo 2', sans-serif; color: #385a7c; }
        .intro { margin: 0 0 26px; }
        form { display: grid; gap: 12px; padding: 28px; background: var(--paper); border: 3px solid #385a7c; border-radius: 18px; box-shadow: 8px 8px 0 #385a7c; }
        label { font-weight: 600; }
        input { width: 100%; padding: 12px 14px; border: 2px solid #b7c9d9; border-radius: 9px; font: inherit; color: var(--ink); }
        input:focus { outline: 3px solid var(--yellow); border-color: #385a7c; }
        button, a.button { display: inline-block; border: 0; border-radius: 999px; padding: 11px 18px; font: 600 1rem 'DM Sans', sans-serif; text-decoration: none; cursor: pointer; }
        button { background: var(--coral); color: white; }
        a.button { background: var(--mint); color: var(--ink); }
        .actions { display: flex; gap: 10px; margin-top: 10px; flex-wrap: wrap; }
        .error { color: #b13d36; font-weight: 600; }
        /* Business portal theme */
        body { background: #f3f6fa; color: #18324a; }
        main { max-width: 620px; }
        h1 { font-family: 'DM Sans', sans-serif; font-size: clamp(1.8rem, 5vw, 2.4rem); color: #18324a; }
        .intro { color: #66788a; }
        form { background: #fff; border: 1px solid #dce5ed; border-radius: 10px; box-shadow: 0 15px 35px rgba(24,50,74,.08); }
        label { color: #29445d; }
        input { color: #18324a; background: #fbfcfd; border: 1px solid #cbd8e3; border-radius: 6px; }
        input:focus { outline: 3px solid rgba(15,118,110,.15); border-color: #0f766e; }
        button, a.button { border-radius: 6px; }
        button { background: #0f766e; }
        button:hover { background: #0b5f59; }
        a.button { background: #e9eef3; color: #29445d; }
        .error { color: #b42318; background: #fff0ef; border: 1px solid #f4c7c3; padding: 10px 12px; border-radius: 6px; }
    </style>
</head>
<body>
    <main>
        <h1><?= htmlspecialchars($form_title) ?></h1>
        <p class="intro">A new verse for the nursery rhyme roster.</p>
        <?php if (!empty($error)): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
        <form method="post" action="<?= site_url($form_action) ?>">
            <label for="firstname">First name</label>
            <input id="firstname" name="firstname" value="<?= htmlspecialchars($user['firstname'] ?? '') ?>" required>
            <label for="lastname">Last name</label>
            <input id="lastname" name="lastname" value="<?= htmlspecialchars($user['lastname'] ?? '') ?>" required>
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
            <label for="username">Username</label>
            <input id="username" name="username" value="<?= htmlspecialchars($user['username'] ?? '') ?>" required>
            <div class="actions">
                <button type="submit">&#43; <?= htmlspecialchars($submit_label) ?></button>
                <a class="button" href="<?= site_url('users') ?>">Back to roster</a>
            </div>
        </form>
    </main>
</body>
</html>