<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!--
    Save this file as: app/views/users_view.php
    Winter-themed redesign — frosted glass, ice-blue palette, drifting snow.
-->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Users — Winter Roster</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500;600;700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  :root{
    --frost-deep:   #0e2a43;
    --frost-mid:    #2f6690;
    --frost-ice:    #6fb3d9;
    --frost-pale:   #dcf0fb;
    --frost-glow:   #f4fbff;
    --snow:         #ffffff;
    --ink:          #12283c;
    --ink-soft:     #4d6a82;
    --line:         #c9e5f5;
  }

  * { box-sizing: border-box; }

  html, body {
    margin: 0;
    min-height: 100vh;
  }

  body {
    font-family: 'Work Sans', sans-serif;
    color: var(--ink);
    background:
      radial-gradient(ellipse 900px 500px at 15% -10%, #ffffff 0%, transparent 60%),
      radial-gradient(ellipse 700px 500px at 110% 10%, #ffffff 0%, transparent 55%),
      linear-gradient(180deg, #eaf6ff 0%, #cfe9f7 45%, #b9dcf0 100%);
    padding: 64px 24px 96px;
    position: relative;
    overflow-x: hidden;
  }

  /* -- drifting snow, sparse and slow -- */
  .snow {
    position: fixed;
    top: -10px;
    border-radius: 50%;
    background: var(--snow);
    opacity: 0.75;
    pointer-events: none;
    animation: fall linear infinite;
  }
  @keyframes fall {
    to { transform: translateY(110vh); }
  }
  @media (prefers-reduced-motion: reduce) {
    .snow { animation: none; display: none; }
  }

  .page {
    max-width: 880px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
  }

  .masthead {
    display: flex;
    align-items: baseline;
    gap: 18px;
    margin-bottom: 8px;
  }

  .flake-mark {
    width: 34px;
    height: 34px;
    flex-shrink: 0;
    color: var(--frost-mid);
  }

  h1 {
    font-family: 'Fraunces', serif;
    font-weight: 500;
    font-optical-sizing: auto;
    font-size: clamp(2.4rem, 5vw, 3.4rem);
    letter-spacing: -0.01em;
    margin: 0;
    color: var(--frost-deep);
  }

  .sub {
    margin: 6px 0 40px 52px;
    color: var(--ink-soft);
    font-size: 1rem;
    max-width: 46ch;
  }

  .divider {
    height: 2px;
    margin: 0 0 40px 52px;
    background: linear-gradient(90deg, var(--frost-ice), transparent);
    border: none;
  }

  /* -- frosted glass card housing the table -- */
  .card {
    background: rgba(255, 255, 255, 0.62);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border: 1px solid rgba(255, 255, 255, 0.9);
    border-radius: 18px;
    box-shadow:
      0 30px 60px -30px rgba(14, 42, 67, 0.35),
      inset 0 1px 0 rgba(255, 255, 255, 0.8);
    overflow: hidden;
  }

  table {
    width: 100%;
    border-collapse: collapse;
  }

  thead th {
    text-align: left;
    font-family: 'Work Sans', sans-serif;
    font-weight: 600;
    font-size: 0.86rem;
    letter-spacing: 0.01em;
    color: var(--frost-glow);
    background: linear-gradient(180deg, var(--frost-mid), var(--frost-deep));
    padding: 16px 22px;
  }

  thead th:first-child { border-top-left-radius: 18px; }
  thead th:last-child  { border-top-right-radius: 18px; }

  tbody td {
    padding: 15px 22px;
    font-size: 0.96rem;
    color: var(--ink);
    border-bottom: 1px solid var(--line);
  }

  tbody tr:last-child td { border-bottom: none; }

  tbody tr:nth-child(even) {
    background: rgba(220, 240, 251, 0.5);
  }

  tbody tr {
    transition: background 0.2s ease;
  }

  tbody tr:hover {
    background: rgba(111, 179, 217, 0.18);
  }

  td:first-child {
    color: var(--frost-mid);
    font-variant-numeric: tabular-nums;
    width: 60px;
  }

  .empty-row td {
    text-align: center;
    padding: 40px 20px;
    color: var(--ink-soft);
    font-style: italic;
  }

  footer.note {
    margin: 28px 4px 0 52px;
    font-size: 0.82rem;
    color: var(--ink-soft);
  }

  @media (max-width: 640px) {
    .sub, .divider, footer.note { margin-left: 0; }
    thead th, tbody td { padding: 12px 14px; font-size: 0.88rem; }
  }

  /* Storybook palette for the nursery-rhyme roster. */
  :root {
    --frost-deep: #385a7c;
    --frost-mid: #ef6f61;
    --frost-ice: #ffd166;
    --frost-pale: #a8e6cf;
    --frost-glow: #fffdf7;
    --ink: #26354a;
    --ink-soft: #526b7f;
    --line: #c9dce5;
  }
  body {
    font-family: 'DM Sans', sans-serif;
    background: linear-gradient(150deg, #bde7f7 0 42%, #fff1bd 42% 70%, #a8e6cf 70%);
  }
  .page { max-width: 980px; }
  .masthead { align-items: center; }
  .flake-mark { color: var(--frost-mid); transform: rotate(8deg); }
  h1 { font-family: 'Baloo 2', sans-serif; font-weight: 700; letter-spacing: 0; color: var(--frost-deep); }
  .sub { color: var(--ink); font-weight: 500; }
  .divider { background: repeating-linear-gradient(90deg, var(--frost-mid) 0 12px, transparent 12px 20px); }
  .card { border: 3px solid var(--frost-deep); border-radius: 18px; box-shadow: 8px 8px 0 var(--frost-deep); }
  thead th { background: var(--frost-deep); }
  tbody tr:nth-child(even) { background: rgba(168, 230, 207, 0.38); }
  tbody tr:hover { background: rgba(255, 209, 102, 0.38); }
  .toolbar { display: flex; justify-content: space-between; align-items: center; gap: 14px; margin: 0 0 18px 52px; flex-wrap: wrap; }
  .toolbar p { margin: 0; font-weight: 600; }
  .button, .delete-button { display: inline-block; border: 0; border-radius: 999px; padding: 10px 16px; font: 600 0.92rem 'Work Sans', sans-serif; text-decoration: none; cursor: pointer; }
  .button { background: var(--frost-mid); color: white; }
  .button:hover { background: #d9574d; }
  .edit-button { background: var(--frost-ice); color: var(--ink); }
  .delete-button { background: #f8c4bd; color: #8f2f29; }
  .row-actions { display: flex; gap: 7px; align-items: center; flex-wrap: wrap; }
  .row-actions form { margin: 0; }
  footer.note { color: var(--ink-soft); }
  .account-links { color: var(--ink-soft); }
  .account-links a { color: var(--frost-deep); font-weight: 700; text-decoration: none; }
  .account-links a:hover { text-decoration: underline; }
  .logout-area { display: flex; justify-content: center; margin: 30px 0 0; }
  .logout-button { display: inline-flex; align-items: center; gap: 8px; padding: 11px 24px; border: 2px solid var(--frost-deep); border-radius: 999px; background: rgba(255, 255, 255, .55); color: var(--frost-deep); font: 700 .92rem 'DM Sans', sans-serif; text-decoration: none; box-shadow: 0 5px 0 rgba(56, 90, 124, .2); transition: transform .2s ease, background .2s ease, box-shadow .2s ease; }
  .logout-button:hover { transform: translateY(-2px); background: var(--frost-deep); color: #fff; box-shadow: 0 7px 0 rgba(56, 90, 124, .25); }
  @media (max-width: 640px) { .toolbar { margin-left: 0; } .row-actions { align-items: flex-start; flex-direction: column; } }
  /* Business portal theme */
  body { background: #f3f6fa; color: #18324a; padding-top: 48px; }
  .snow { display: none; }
  .page { max-width: 1080px; }
  .flake-mark { color: #0f766e; }
  h1 { font-family: 'DM Sans', sans-serif; font-size: clamp(2rem, 5vw, 2.8rem); color: #18324a; }
  .sub, footer.note { color: #66788a; }
  .divider { background: #dce5ed; }
  .card { background: #fff; border: 1px solid #dce5ed; border-radius: 10px; box-shadow: 0 15px 35px rgba(24,50,74,.08); }
  thead th { background: #18324a; color: #fff; }
  tbody td { color: #29445d; border-color: #e5ebf0; }
  tbody tr:nth-child(even) { background: #f8fafc; }
  tbody tr:hover { background: #f2f8f7; }
  .toolbar p { color: #66788a; }
  .button { border-radius: 6px; background: #0f766e; }
  .button:hover { background: #0b5f59; }
  .edit-button { background: #fff4d6; color: #8a5b00; }
  .delete-button { background: #fff0ef; color: #b42318; }
  .account-links a, .logout-button { color: #0f766e; }
  .logout-button { border-color: #0f766e; background: #fff; box-shadow: 0 4px 0 rgba(15,118,110,.12); }
  .logout-button:hover { background: #0f766e; color: #fff; box-shadow: 0 6px 0 rgba(15,118,110,.16); }
</style>
</head>
<body>

  <!-- sparse drifting snow -->
  <div class="snow" style="left:8%;  width:6px;  height:6px;  animation-duration:14s; animation-delay:0s;"></div>
  <div class="snow" style="left:22%; width:4px;  height:4px;  animation-duration:11s; animation-delay:2s;"></div>
  <div class="snow" style="left:38%; width:7px;  height:7px;  animation-duration:16s; animation-delay:1s;"></div>
  <div class="snow" style="left:55%; width:5px;  height:5px;  animation-duration:13s; animation-delay:4s;"></div>
  <div class="snow" style="left:70%; width:4px;  height:4px;  animation-duration:12s; animation-delay:3s;"></div>
  <div class="snow" style="left:84%; width:6px;  height:6px;  animation-duration:15s; animation-delay:5s;"></div>
  <div class="snow" style="left:93%; width:3px;  height:3px;  animation-duration:10s; animation-delay:1.5s;"></div>

  <div class="page">
    <div class="masthead">
      <svg class="flake-mark" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round">
        <path d="M12 2v20M4 7l16 10M20 7L4 17M8 3.5 12 7l4-3.5M8 20.5 12 17l4 3.5M2.5 9 6 12l-3.5 3M21.5 9 18 12l3.5 3"/>
      </svg>
      <h1>Little Rhyme Roster</h1>
    </div>
    <p class="sub">A cheerful little roll call of everyone in the kingdom.</p>
    <p>
      <?php if (!empty($auth_user)): ?>
        Signed in as <?= htmlspecialchars($auth_user['username']) ?> (<?= htmlspecialchars($auth_user['role']) ?>) |
        <a href="<?= site_url('products') ?>">Products</a> |
      <?php else: ?>
        <a href="<?= site_url('login') ?>">Sign in to edit</a>
      <?php endif; ?>
    </p>
    <hr class="divider">

    <?php if (in_array($auth_user['role'] ?? '', ['admin', 'moderator'], true)): ?>
      <div class="toolbar">
        <p>Pick a verse and make it shine.</p>
        <a class="button" href="<?= site_url('users/create') ?>">&#43; Add user</a>
      </div>
    <?php endif; ?>

    <div class="card">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Username</th>
            <?php if (in_array($auth_user['role'] ?? '', ['admin', 'moderator'], true)): ?><th>Action</th><?php endif; ?>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($users)): ?>
            <?php foreach ($users as $user): ?>
              <tr>
                <td><?= htmlspecialchars($user['id']) ?></td>
                <td><?= htmlspecialchars($user['firstname']) ?></td>
                <td><?= htmlspecialchars($user['lastname']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= htmlspecialchars($user['username']) ?></td>
                <?php if (in_array($auth_user['role'] ?? '', ['admin', 'moderator'], true)): ?>
                  <td>
                    <div class="row-actions">
                      <a class="button edit-button" href="<?= site_url('users/edit/' . (int) $user['id']) ?>">Edit</a>
                      <form method="post" action="<?= site_url('users/delete/' . (int) $user['id']) ?>" onsubmit="return confirm('Take this verse out of the roster?');">
                        <button class="delete-button" type="submit">Delete</button>
                      </form>
                    </div>
                  </td>
                <?php endif; ?>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr class="empty-row">
              <td colspan="6">No users yet — add a record to see it here.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <footer class="note">Data from the <code>users</code> table in <code>crudlava_auth</code>.</footer>
    <?php if (!empty($auth_user)): ?>
      <div class="logout-area">
        <a class="logout-button" href="<?= site_url('logout') ?>">&#8594; Log out</a>
      </div>
    <?php endif; ?>
  </div>

</body>
</html>