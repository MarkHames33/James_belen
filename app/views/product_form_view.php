<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($form_title) ?> | CRUD LavaLust</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #7c6cff; --primary-dark: #6052dc; --ink: #eef2ff; --ink-soft: #aab5d6; --line: rgba(173, 188, 255, .2); --danger: #ff9f97; --danger-bg: rgba(239,111,97,.18); }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; padding: 48px 20px; color: var(--ink); font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #080b22, #151a40); }
        body::before { content: ''; position: fixed; inset: -20%; pointer-events: none; background: radial-gradient(ellipse at 15% 10%, rgba(109,231,255,.16), transparent 35%), radial-gradient(ellipse at 85% 85%, rgba(139,124,255,.2), transparent 40%); animation: drift 18s ease-in-out infinite alternate; }
        body::after { content: ''; position: fixed; inset: 0; pointer-events: none; opacity: .55; background-image: radial-gradient(circle, #fff 0 1px, transparent 1.5px), radial-gradient(circle, #6de7ff 0 1px, transparent 1.5px); background-size: 113px 137px, 179px 163px; animation: stars 28s linear infinite; }
        main { position: relative; z-index: 1; max-width: 560px; margin: auto; }
        h1 { margin: 0 0 6px; font: 700 clamp(1.7rem, 5vw, 2.2rem) 'Poppins', sans-serif; color: var(--ink); text-shadow: 0 0 24px rgba(109,231,255,.25); }
        .intro { margin: 0 0 24px; color: var(--ink-soft); font-size: 0.95rem; }
        form { display: grid; gap: 14px; padding: 28px; background: rgba(19, 24, 56, .78); border: 1px solid var(--line); border-radius: 14px; box-shadow: 0 20px 70px rgba(0,0,0,.28), inset 0 1px rgba(255,255,255,.08); backdrop-filter: blur(18px); }
        label { font-weight: 600; font-size: 0.9rem; }
        input, textarea { width: 100%; padding: 11px 14px; border: 1.5px solid var(--line); border-radius: 8px; font: inherit; color: var(--ink); background: rgba(7,10,31,.65); }
        input:focus, textarea:focus { outline: 2px solid #6de7ff; border-color: #6de7ff; }
        textarea { resize: vertical; min-height: 80px; }
        .btn { display: inline-flex; align-items: center; gap: 6px; border: 0; border-radius: 8px; padding: 11px 18px; font: 600 0.95rem 'Inter', sans-serif; text-decoration: none; cursor: pointer; }
        .btn-primary { background: linear-gradient(100deg, var(--primary), #57cee7); color: #fff; box-shadow: 0 8px 24px rgba(109,231,255,.18); }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-secondary { background: rgba(255,255,255,.08); color: var(--ink); }
        .btn-secondary:hover { background: rgba(255,255,255,.14); }
        .actions { display: flex; gap: 10px; margin-top: 6px; flex-wrap: wrap; }
        .error { margin: 0 0 4px; padding: 10px 14px; border-radius: 8px; background: var(--danger-bg); color: var(--danger); font-weight: 600; font-size: 0.88rem; }
        .row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        @keyframes drift { from { transform: translate3d(-2%, -1%, 0) scale(1); } to { transform: translate3d(2%, 1%, 0) scale(1.08); } }
        @keyframes stars { from { transform: translateY(0); } to { transform: translateY(-90px); } }
        @media (max-width: 480px) { .row { grid-template-columns: 1fr; } }
        @media (prefers-reduced-motion: reduce) { *, *::before, *::after { animation-duration: .01ms !important; animation-iteration-count: 1 !important; } }
        /* Business portal theme */
        body { background: #0b141c; color: #edf4f7; }
        body::before, body::after { display: none; }
        h1 { color: #fff; text-shadow: none; }
        .intro { color: #9eb0bd; }
        form { background: #14232e; border: 1px solid #2b414f; border-radius: 10px; box-shadow: 0 20px 50px rgba(0,0,0,.3); backdrop-filter: none; }
        label { color: #dce8ed; }
        input, textarea { color: #edf4f7; background: #0f1c25; border-color: #3b5362; border-radius: 6px; }
        input:focus, textarea:focus { outline: 3px solid rgba(110,231,216,.15); border-color: #6ee7d8; }
        .btn { border-radius: 6px; }
        .btn-primary { background: #0f766e; box-shadow: none; }
        .btn-primary:hover { background: #0b5f59; }
        .btn-secondary { background: #263946; color: #dce8ed; }
        .btn-secondary:hover { background: #334957; }
    </style>
</head>
<body>
    <main>
        <h1><?= htmlspecialchars($form_title) ?></h1>
        <p class="intro">Fill in the product details below.</p>
        <?php if (!empty($error)): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
        <form method="post" action="<?= site_url($form_action) ?>">
            <label for="product_name">Product name</label>
            <input id="product_name" name="product_name" value="<?= htmlspecialchars($product['product_name'] ?? '') ?>" required>

            <label for="description">Description</label>
            <textarea id="description" name="description"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>

            <div class="row">
                <div>
                    <label for="price">Price</label>
                    <input id="price" name="price" type="number" step="0.01" min="0" value="<?= htmlspecialchars((string) ($product['price'] ?? '')) ?>" required>
                </div>
                <div>
                    <label for="quantity">Quantity</label>
                    <input id="quantity" name="quantity" type="number" step="1" min="0" value="<?= htmlspecialchars((string) ($product['quantity'] ?? '')) ?>" required>
                </div>
            </div>

            <div class="actions">
                <button class="btn btn-primary" type="submit">&#43; <?= htmlspecialchars($submit_label) ?></button>
                <a class="btn btn-secondary" href="<?= site_url('products') ?>">Back to products</a>
            </div>
        </form>
    </main>
</body>
</html>
