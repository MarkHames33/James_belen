<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Products | CRUD LavaLust</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  :root{
    --primary: #7c6cff;
    --primary-dark: #6052dc;
    --ink: #eef2ff;
    --ink-soft: #aab5d6;
    --line: rgba(173, 188, 255, .16);
    --bg-top: #080b22;
    --bg-bottom: #151a40;
    --danger: #dc2626;
    --danger-bg: #fee2e2;
    --success: #16a34a;
  }
  * { box-sizing: border-box; }
  html, body { margin: 0; min-height: 100vh; }
  body {
    font-family: 'Inter', sans-serif;
    color: var(--ink);
    background: linear-gradient(135deg, var(--bg-top), var(--bg-bottom));
    padding: 48px 24px 80px;
  }
  body::before { content: ''; position: fixed; inset: -20%; pointer-events: none; background: radial-gradient(ellipse at 10% 15%, rgba(109,231,255,.15), transparent 35%), radial-gradient(ellipse at 90% 85%, rgba(139,124,255,.18), transparent 40%); animation: drift 18s ease-in-out infinite alternate; }
  body::after { content: ''; position: fixed; inset: 0; pointer-events: none; opacity: .55; background-image: radial-gradient(circle, #fff 0 1px, transparent 1.5px), radial-gradient(circle, #6de7ff 0 1px, transparent 1.5px); background-size: 113px 137px, 179px 163px; animation: stars 28s linear infinite; }
  .page { position: relative; z-index: 1; max-width: 960px; margin: 0 auto; }
  header.top { display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 16px; margin-bottom: 6px; }
  h1 { font-family: 'Poppins', sans-serif; font-weight: 700; font-size: clamp(1.8rem, 4vw, 2.4rem); margin: 0; color: var(--ink); text-shadow: 0 0 24px rgba(109,231,255,.25); }
  .sub { margin: 6px 0 0; color: var(--ink-soft); font-size: 0.95rem; }
  .session-info { text-align: right; font-size: 0.88rem; color: var(--ink-soft); }
  .session-info a { color: var(--primary); text-decoration: none; font-weight: 600; }
  .session-info a:hover { text-decoration: underline; }
  .role-badge { display: inline-block; margin-top: 8px; padding: 4px 9px; border-radius: 999px; background: rgba(255,209,102,.14); color: #ffe08a; border: 1px solid rgba(255,209,102,.3); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.04em; }
  .toolbar { display: flex; justify-content: space-between; align-items: center; margin: 28px 0 16px; flex-wrap: wrap; gap: 12px; }
  .toolbar p { margin: 0; color: var(--ink-soft); font-size: 0.9rem; }
  .btn { display: inline-flex; align-items: center; gap: 6px; border: 0; border-radius: 8px; padding: 10px 18px; font: 600 0.92rem 'Inter', sans-serif; text-decoration: none; cursor: pointer; transition: background 0.15s ease; }
  .btn-primary { background: linear-gradient(100deg, var(--primary), #57cee7); color: #fff; box-shadow: 0 8px 24px rgba(109,231,255,.18); }
  .btn-primary:hover { background: var(--primary-dark); }
  .btn-edit { background: #fef3c7; color: #92400e; padding: 7px 14px; font-size: 0.85rem; }
  .btn-edit:hover { background: #fde68a; }
  .btn-delete { background: var(--danger-bg); color: var(--danger); padding: 7px 14px; font-size: 0.85rem; border: 0; }
  .btn-delete:hover { background: #fecaca; }
  .card {
    background: rgba(19, 24, 56, .78);
    border: 1px solid var(--line);
    border-radius: 14px;
    box-shadow: 0 20px 70px rgba(0,0,0,.28), inset 0 1px rgba(255,255,255,.08);
    backdrop-filter: blur(18px);
    overflow: hidden;
  }
  table { width: 100%; border-collapse: collapse; }
  thead th {
    text-align: left; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.04em;
    color: #fff; background: rgba(124,108,255,.65); padding: 14px 20px; font-weight: 600;
  }
  tbody td { padding: 14px 20px; font-size: 0.94rem; border-bottom: 1px solid var(--line); vertical-align: top; }
  tbody tr:last-child td { border-bottom: none; }
  tbody tr:hover { background: rgba(109,231,255,.07); }
  .desc-cell { color: var(--ink-soft); max-width: 260px; }
  .price-cell { font-variant-numeric: tabular-nums; font-weight: 600; }
  .qty-cell { font-variant-numeric: tabular-nums; }
  .qty-low { color: var(--danger); font-weight: 600; }
  .row-actions { display: flex; gap: 8px; flex-wrap: wrap; }
  .row-actions form { margin: 0; }
  .empty-row td { text-align: center; padding: 48px 20px; color: var(--ink-soft); font-style: italic; }
  .view-only { margin: 20px 0 0; padding: 12px 16px; border-left: 4px solid #6de7ff; background: rgba(109,231,255,.1); color: #b8f4ff; font-size: 0.9rem; }
  @keyframes drift { from { transform: translate3d(-2%, -1%, 0) scale(1); } to { transform: translate3d(2%, 1%, 0) scale(1.08); } }
  @keyframes stars { from { transform: translateY(0); } to { transform: translateY(-90px); } }
  @media (prefers-reduced-motion: reduce) { *, *::before, *::after { animation-duration: .01ms !important; animation-iteration-count: 1 !important; } }
  /* Business portal theme */
  body { background: #0b141c; color: #edf4f7; }
  body::before, body::after { display: none; }
  h1 { color: #fff; text-shadow: none; }
  .sub, .session-info, .toolbar p, footer.note { color: #9eb0bd; }
  .session-info a { color: #6ee7d8; }
  .role-badge { background: rgba(110,231,216,.12); color: #6ee7d8; border: 1px solid rgba(110,231,216,.3); }
  .btn { border-radius: 6px; }
  .btn-primary { background: #0f766e; box-shadow: none; }
  .btn-primary:hover { background: #0b5f59; }
  .card { background: #14232e; border: 1px solid #2b414f; border-radius: 10px; box-shadow: 0 20px 50px rgba(0,0,0,.3); backdrop-filter: none; }
  thead th { background: #203846; color: #dce8ed; }
  tbody td { color: #dce8ed; border-color: #2b414f; }
  tbody tr:nth-child(even) { background: rgba(255,255,255,.025); }
  tbody tr:hover { background: rgba(110,231,216,.08); }
  .desc-cell { color: #9eb0bd; }
  .view-only { border-left-color: #6ee7d8; background: rgba(110,231,216,.1); color: #b7fff4; }
  .btn-edit { background: #f0b44c; color: #2d210d; }
  .btn-delete { background: #632b31; color: #ffb4aa; }
  .product-scene { position: fixed; inset: 0; z-index: 0; overflow: hidden; pointer-events: none; }
  .top-nav { display: flex; align-items: center; justify-content: flex-end; gap: 8px; margin: 0 0 24px; }
  .nav-btn { display: inline-flex; align-items: center; padding: 9px 14px; border: 1px solid #334757; border-radius: 6px; color: #c5d2dc; background: #162532; font-size: .82rem; font-weight: 700; text-decoration: none; }
  .nav-btn:hover, .nav-btn.active { color: #fff; background: #0f766e; border-color: #0f766e; }
  .nav-btn-logout { color: #ffb4aa; }
  .product-photo { position: absolute; width: 150px; aspect-ratio: 1; border-radius: 14px; background-size: cover; background-position: center; opacity: .12; filter: saturate(.8); box-shadow: 0 18px 45px rgba(24,50,74,.18); animation: product-float 24s ease-in-out infinite alternate; }
  .photo-watch { top: 12%; left: 3%; background-image: url('https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=320&q=80'); }
  .photo-shoe { top: 54%; right: 2%; background-image: url('https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=320&q=80'); animation-delay: -8s; }
  .photo-headphones { bottom: 4%; left: 12%; background-image: url('https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=320&q=80'); animation-delay: -15s; }
  @keyframes product-float { from { transform: translate3d(0, 12px, 0) rotate(-4deg); } to { transform: translate3d(18px, -18px, 0) rotate(5deg); } }
  @media (max-width: 700px) { .product-photo { width: 95px; opacity: .08; } }
  @media (prefers-reduced-motion: reduce) { .product-photo { animation: none; } }
  footer.note { margin: 22px 4px 0; font-size: 0.82rem; color: var(--ink-soft); }
  @media (max-width: 640px) {
    thead th, tbody td { padding: 10px 12px; font-size: 0.85rem; }
    .desc-cell { max-width: 140px; }
  }
</style>
</head>
<body>
  <div class="product-scene" aria-hidden="true">
    <div class="product-photo photo-watch"></div>
    <div class="product-photo photo-shoe"></div>
    <div class="product-photo photo-headphones"></div>
  </div>
  <div class="page">
    <nav class="top-nav" aria-label="Main navigation">
      <a class="nav-btn active" href="<?= site_url('products') ?>">Products</a>
      <a class="nav-btn" href="<?= site_url('users') ?>">Users</a>
      <a class="nav-btn nav-btn-logout" href="<?= site_url('logout') ?>">Sign out</a>
    </nav>
    <header class="top">
      <div>
        <h1>Commerce Inventory</h1>
        <p class="sub">Track products, pricing, and stock in one place.</p>
      </div>
      <div class="session-info">
        <?php if (!empty($auth_user)): ?>
          Signed in as <strong><?= htmlspecialchars($auth_user['username']) ?></strong> (<?= htmlspecialchars($auth_user['role']) ?>)<br>
          <span class="role-badge"><?= htmlspecialchars($auth_user['role']) ?> access</span><br>
          Account: <?= htmlspecialchars($auth_user['username']) ?>
        <?php else: ?>
          <a href="<?= site_url('login') ?>">Sign in</a>
        <?php endif; ?>
      </div>
    </header>

    <div class="toolbar">
      <p><?= count($products ?? []) ?> product(s) in inventory</p>
      <?php $is_admin = (($auth_user['role'] ?? '') === 'admin'); ?>
      <?php if ($is_admin): ?><a class="btn btn-primary" href="<?= site_url('products/create') ?>">&#43; Add Product</a><?php endif; ?>
    </div>

    <?php if (!$is_admin): ?><p class="view-only"><strong>View-only mode.</strong> Only administrators can add, edit, or delete products.</p><?php endif; ?>

    <div class="card">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Quantity</th>
            <?php if ($is_admin): ?><th>Action</th><?php endif; ?>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
              <tr>
                <td><?= htmlspecialchars($product['id']) ?></td>
                <td><strong><?= htmlspecialchars($product['product_name']) ?></strong></td>
                <td class="desc-cell"><?= htmlspecialchars($product['description'] ?? '') ?></td>
                <td class="price-cell">&#8369;<?= number_format((float) $product['price'], 2) ?></td>
                <td class="qty-cell <?= (int) $product['quantity'] <= 5 ? 'qty-low' : '' ?>"><?= htmlspecialchars($product['quantity']) ?></td>
                <?php if ($is_admin): ?><td>
                  <div class="row-actions">
                    <a class="btn btn-edit" href="<?= site_url('products/edit/' . (int) $product['id']) ?>">Edit</a>
                    <form method="post" action="<?= site_url('products/delete/' . (int) $product['id']) ?>" onsubmit="return confirm('Delete this product? This cannot be undone.');">
                      <button class="btn btn-delete" type="submit">Delete</button>
                    </form>
                  </div>
                </td><?php endif; ?>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr class="empty-row">
              <td colspan="<?= $is_admin ? '6' : '5' ?>">No products yet &mdash; <?php if ($is_admin): ?>click &ldquo;Add Product&rdquo; to create one.<?php else: ?>there are no products to display.<?php endif; ?></td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <footer class="note">Data from the <code>products</code> table.</footer>
  </div>
</body>
</html>
