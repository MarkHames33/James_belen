<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Enter the Archive | LavaLust</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500;600;700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root { --ink: #eef2ff; --muted: #aab5d6; --violet: #8b7cff; --cyan: #6de7ff; --gold: #ffd166; --panel: rgba(19, 24, 56, .78); }
        * { box-sizing: border-box; }
        body { min-height: 100vh; margin: 0; padding: 44px 20px; display: grid; place-items: center; overflow: hidden; color: var(--ink); font-family: 'DM Sans', sans-serif; background: #080b22; }
        body::before { content: ''; position: fixed; inset: -20%; background: radial-gradient(ellipse at 20% 15%, rgba(109,231,255,.2), transparent 35%), radial-gradient(ellipse at 80% 80%, rgba(139,124,255,.2), transparent 38%), linear-gradient(135deg, #080b22, #14183d 52%, #080b22); animation: sky-shift 16s ease-in-out infinite alternate; }
        body::after { content: ''; position: fixed; inset: 0; opacity: .7; background-image: radial-gradient(circle, rgba(255,255,255,.9) 0 1px, transparent 1.5px), radial-gradient(circle, rgba(109,231,255,.8) 0 1px, transparent 1.5px); background-size: 97px 113px, 157px 181px; background-position: 10px 20px, 60px 90px; animation: stars 24s linear infinite; }
        main { position: relative; z-index: 1; width: min(100%, 440px); }
        .badge { width: 68px; height: 68px; display: grid; place-items: center; margin-bottom: 12px; border: 1px solid rgba(255,209,102,.8); border-radius: 50%; background: rgba(255,209,102,.12); color: var(--gold); font-size: 2rem; box-shadow: 0 0 36px rgba(255,209,102,.35); animation: float 4s ease-in-out infinite; }
        h1 { margin: 0; color: var(--ink); font: 700 clamp(2.4rem, 10vw, 4rem)/0.95 'Baloo 2', sans-serif; text-shadow: 0 0 24px rgba(109,231,255,.28); }
        .intro { margin: 12px 0 24px; color: var(--muted); font-size: 1.05rem; }
        form { display: grid; gap: 12px; padding: 28px; background: var(--panel); border: 1px solid rgba(109,231,255,.28); border-radius: 18px; box-shadow: 0 20px 70px rgba(0,0,0,.35), inset 0 1px rgba(255,255,255,.1); backdrop-filter: blur(18px); }
        label { color: #dce4ff; font-weight: 600; }
        input { width: 100%; padding: 12px 14px; border: 1px solid rgba(170,181,214,.35); border-radius: 9px; font: inherit; color: var(--ink); background: rgba(7,10,31,.65); }
        input:focus { outline: 2px solid var(--cyan); border-color: var(--cyan); }
        button { margin-top: 8px; padding: 12px 18px; border: 0; border-radius: 999px; background: linear-gradient(100deg, var(--violet), #5acde8); color: #fff; font: 600 1rem 'DM Sans', sans-serif; cursor: pointer; box-shadow: 0 8px 24px rgba(109,231,255,.2); transition: transform .2s, box-shadow .2s; }
        button:hover { transform: translateY(-2px); box-shadow: 0 12px 30px rgba(109,231,255,.35); }
        .error { padding: 10px 12px; border-radius: 8px; background: rgba(239,111,97,.18); color: #ffb4aa; font-weight: 600; }
        .hint { margin: 22px 0 0; color: var(--muted); font-size: 0.9rem; text-align: center; }
        @keyframes sky-shift { from { transform: translate3d(-2%, -1%, 0) scale(1); } to { transform: translate3d(2%, 1%, 0) scale(1.08); } }
        @keyframes stars { from { transform: translateY(0); } to { transform: translateY(-80px); } }
        @keyframes float { 50% { transform: translateY(-8px) rotate(5deg); } }
        @media (prefers-reduced-motion: reduce) { *, *::before, *::after { animation-duration: .01ms !important; animation-iteration-count: 1 !important; } }
        /* Business portal theme */
        body { overflow: auto; background: #0b141c; color: #edf4f7; }
        body::before, body::after { display: none; }
        main { width: min(100%, 430px); }
        .badge { width: 52px; height: 52px; margin-bottom: 16px; border: 0; border-radius: 10px; background: #0f766e; color: #fff; font-size: 1.45rem; box-shadow: none; animation: none; }
        h1 { color: #fff; text-shadow: none; font-size: clamp(2rem, 8vw, 3rem); }
        .intro { color: #9eb0bd; }
        form { padding: 30px; background: #14232e; border: 1px solid #2b414f; border-radius: 12px; box-shadow: 0 20px 50px rgba(0,0,0,.3); backdrop-filter: none; }
        label { color: #dce8ed; }
        input { color: #edf4f7; background: #0f1c25; border: 1px solid #3b5362; border-radius: 6px; }
        input:focus { outline: 3px solid rgba(110,231,216,.15); border-color: #6ee7d8; }
        button { border-radius: 6px; background: #0f766e; box-shadow: none; }
        button:hover { background: #0b5f59; transform: none; box-shadow: none; }
        .error { background: #632b31; color: #ffb4aa; border: 1px solid #9d4b51; }
        .hint { color: #9eb0bd; }
        .commerce-scene { position: fixed; inset: 0; overflow: hidden; pointer-events: none; z-index: 0; }
        .commerce-photo { position: absolute; width: 160px; aspect-ratio: 1; border-radius: 14px; background-size: cover; background-position: center; opacity: .08; filter: saturate(.7); animation: commerce-float 22s ease-in-out infinite alternate; }
        .commerce-photo.one { top: 10%; left: 5%; background-image: url('https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=360&q=80'); }
        .commerce-photo.two { right: 5%; bottom: 12%; background-image: url('https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=360&q=80'); animation-delay: -9s; }
        @keyframes commerce-float { from { transform: translate3d(0, 12px, 0) rotate(-5deg); } to { transform: translate3d(22px, -16px, 0) rotate(5deg); } }
        @media (max-width: 700px) { .commerce-photo { width: 105px; opacity: .06; } }
        @media (prefers-reduced-motion: reduce) { .commerce-photo { animation: none; } }
    </style>
</head>
<body>
    <div class="commerce-scene" aria-hidden="true">
        <div class="commerce-photo one"></div>
        <div class="commerce-photo two"></div>
    </div>
    <main>
    <div class="badge" aria-hidden="true">&#9733;</div>
    <h1>Commerce Portal</h1>
    <p class="intro">Sign in to manage your store inventory.</p>
    <?php if (!empty($error)): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
    <form method="post" action="<?= site_url('login') ?>">
        <label for="username">Username</label>
        <input id="username" name="username" required autocomplete="username">
        <label for="password">Password</label>
        <input id="password" name="password" type="password" required autocomplete="current-password">
        <button type="submit">Sign in to dashboard</button>
    </form>
    <p class="hint">Secure access for your business workspace.</p>
    </main>
</body>
</html>