<?php
session_start();
require_once 'data.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $user = findUser($username, $password);

    if ($user) {
        $_SESSION['user'] = $user;
        if ($user['role'] === 'dosen') {
            header('Location: dosen/stream.php');
        } else {
            header('Location: mahasiswa/stream.php');
        }
        exit;
    } else {
        $error = 'Username atau password salah.';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – Sistem Absensi Elektronik | Universitas Trunojoyo Madura</title>
    <meta name="description" content="Masuk ke Sistem Absensi Elektronik Universitas Trunojoyo Madura untuk mengelola kehadiran perkuliahan secara digital.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --blue-primary: #2563eb;
            --blue-dark:    #1d4ed8;
            --blue-light:   #3b82f6;
            --indigo:       #5b6fd6;
            --indigo-dark:  #4a5ac4;
            --white:        #ffffff;
            --gray-50:      #f8fafc;
            --gray-100:     #f1f5f9;
            --gray-200:     #e2e8f0;
            --gray-400:     #94a3b8;
            --gray-500:     #64748b;
            --gray-700:     #334155;
            --gray-900:     #0f172a;
            --red-500:      #ef4444;
            --shadow-md:    0 4px 6px -1px rgba(0,0,0,.1), 0 2px 4px -2px rgba(0,0,0,.1);
            --shadow-lg:    0 10px 15px -3px rgba(0,0,0,.1), 0 4px 6px -4px rgba(0,0,0,.1);
        }

        html, body {
            height: 100%;
            font-family: 'Inter', sans-serif;
            background: var(--gray-50);
        }

        /* ── Layout ─────────────────────────────────────── */
        .login-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* ── Left Panel ─────────────────────────────────── */
        .left-panel {
            width: 360px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: var(--white);
            padding: 48px 40px 32px;
            box-shadow: 4px 0 24px rgba(0,0,0,.06);
            position: relative;
            z-index: 1;
        }

        .left-panel__brand {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
        }

        .brand-logo img {
            height: 90px;
            width: auto;
            object-fit: contain;
        }

        .brand-title {
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--blue-primary);
            line-height: 1.3;
        }

        .brand-subtitle {
            font-size: 0.875rem;
            color: var(--gray-500);
            font-weight: 400;
            margin-top: 4px;
        }

        /* Social icons */
        .left-panel__footer {}

        .social-links {
            display: flex;
            gap: 20px;
            margin-bottom: 24px;
        }

        .social-links a {
            color: var(--gray-400);
            transition: color .2s;
            display: flex;
            align-items: center;
        }

        .social-links a:hover { color: var(--blue-primary); }

        .social-links svg {
            width: 22px;
            height: 22px;
            fill: currentColor;
        }

        .left-panel__copyright {
            background: var(--indigo);
            margin: 0 -40px -32px;
            padding: 14px 40px;
            color: var(--white);
            font-size: 0.8rem;
        }

        .left-panel__copyright strong { font-weight: 600; }

        /* ── Right Panel ─────────────────────────────────── */
        .right-panel {
            flex: 1;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .right-panel__bg {
            position: absolute;
            inset: 0;
            background-image: url('img/bg.png');
            background-size: cover;
            background-position: center;
            filter: brightness(0.72);
            transition: transform 8s ease;
        }

        .right-panel:hover .right-panel__bg {
            transform: scale(1.03);
        }

        /* ── Login Card ───────────────────────────────────── */
        .login-card {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 460px;
            margin: 24px;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255,255,255,0.28);
            border-radius: 16px;
            padding: 40px 36px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.28);
            animation: cardIn .5s ease both;
        }

        @keyframes cardIn {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .login-card__heading {
            text-align: center;
            margin-bottom: 28px;
        }

        .login-card__heading h1 {
            font-size: 1rem;
            font-weight: 400;
            color: rgba(255,255,255,0.92);
            letter-spacing: 0.01em;
        }

        .login-card__heading p {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--white);
            margin-top: 6px;
        }

        /* ── Form fields ─────────────────────────────────── */
        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            font-size: 0.8rem;
            font-weight: 500;
            color: rgba(255,255,255,0.85);
            margin-bottom: 6px;
        }

        .form-group input {
            width: 100%;
            padding: 11px 14px;
            background: rgba(255,255,255,0.18);
            border: 1px solid rgba(255,255,255,0.35);
            border-radius: 8px;
            color: var(--white);
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: border-color .2s, background .2s, box-shadow .2s;
        }

        .form-group input::placeholder {
            color: rgba(255,255,255,0.45);
        }

        .form-group input:focus {
            border-color: rgba(255,255,255,0.7);
            background: rgba(255,255,255,0.25);
            box-shadow: 0 0 0 3px rgba(255,255,255,0.12);
        }

        .error-message {
            background: rgba(239,68,68,0.22);
            border: 1px solid rgba(239,68,68,0.5);
            color: #fca5a5;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 0.82rem;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* ── Divider ─────────────────────────────────────── */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 20px 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255,255,255,0.25);
        }

        .divider span {
            font-size: 0.78rem;
            color: rgba(255,255,255,0.55);
            white-space: nowrap;
        }

        /* ── Buttons ─────────────────────────────────────── */
        .btn-login {
            width: 100%;
            padding: 12px;
            background: var(--blue-primary);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: background .2s, transform .15s, box-shadow .2s;
            margin-bottom: 4px;
        }

        .btn-login:hover {
            background: var(--blue-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(37,99,235,0.45);
        }

        .btn-login:active { transform: translateY(0); }

        .btn-google {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 11px 16px;
            background: transparent;
            color: var(--white);
            border: 1.5px solid rgba(255,255,255,0.55);
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: background .2s, border-color .2s, transform .15s;
            text-decoration: none;
        }

        .btn-google:hover {
            background: rgba(255,255,255,0.12);
            border-color: rgba(255,255,255,0.85);
            transform: translateY(-1px);
        }

        .btn-google:active { transform: translateY(0); }

        .btn-google .google-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        /* ── Responsive ──────────────────────────────────── */
        @media (max-width: 768px) {
            .left-panel {
                display: none;
            }

            .login-card {
                margin: 16px;
                padding: 32px 24px;
            }
        }
    </style>
</head>
<body>

<div class="login-wrapper">

    <!-- ── LEFT PANEL ─────────────────────────────────────── -->
    <aside class="left-panel">
        <div class="left-panel__brand">
            <div class="brand-logo">
                <img src="img/login-logo.png" alt="Logo Sistem Absensi Elektronik">
            </div>
            <div>
                <div class="brand-title">Sistem Absensi Elektronik</div>
                <div class="brand-subtitle">Universitas Trunojoyo Madura</div>
            </div>
        </div>

        <div class="left-panel__footer">
            <div class="social-links">
                <!-- Facebook -->
                <a href="#" aria-label="Facebook">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                    </svg>
                </a>
                <!-- Instagram -->
                <a href="#" aria-label="Instagram">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5" fill="none" stroke="currentColor" stroke-width="2"/>
                        <circle cx="12" cy="12" r="4" fill="none" stroke="currentColor" stroke-width="2"/>
                        <circle cx="17.5" cy="6.5" r="1.2"/>
                    </svg>
                </a>
                <!-- Twitter/X -->
                <a href="#" aria-label="Twitter">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                    </svg>
                </a>
                <!-- YouTube -->
                <a href="#" aria-label="YouTube">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 0 0 1.46 6.42 29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58 2.78 2.78 0 0 0 1.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.96A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/>
                        <polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="white"/>
                    </svg>
                </a>
            </div>

            <div class="left-panel__copyright">
                2026 &mdash; <strong>Universitas Trunojoyo Madura</strong>
            </div>
        </div>
    </aside>

    <!-- ── RIGHT PANEL ────────────────────────────────────── -->
    <main class="right-panel">
        <div class="right-panel__bg" aria-hidden="true"></div>

        <div class="login-card">
            <div class="login-card__heading">
                <h1>Selamat Datang di Aplikasi Sistem Absensi Elektronik</h1>
                <p>Masuk ke Akun Anda</p>
            </div>

            <?php if ($error): ?>
            <div class="error-message">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                <?= htmlspecialchars($error) ?>
            </div>
            <?php endif; ?>

            <form method="POST" action="index.php" id="loginForm">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Masukkan username"
                        value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                        autocomplete="username"
                        required
                    >
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                        required
                    >
                </div>

                <button type="submit" class="btn-login" id="btnLogin">Masuk</button>
            </form>

            <div class="divider"><span>atau</span></div>

            <a href="#" class="btn-google" id="btnGoogle">
                <!-- Google "G" SVG -->
                <svg class="google-icon" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#FFC107" d="M43.611 20.083H42V20H24v8h11.303c-1.649 4.657-6.08 8-11.303 8-6.627 0-12-5.373-12-12s5.373-12 12-12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4 12.955 4 4 12.955 4 24s8.955 20 20 20 20-8.955 20-20c0-1.341-.138-2.65-.389-3.917z"/>
                    <path fill="#FF3D00" d="m6.306 14.691 6.571 4.819C14.655 15.108 18.961 12 24 12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4 16.318 4 9.656 8.337 6.306 14.691z"/>
                    <path fill="#4CAF50" d="M24 44c5.166 0 9.86-1.977 13.409-5.192l-6.19-5.238A11.91 11.91 0 0 1 24 36c-5.202 0-9.619-3.317-11.283-7.946l-6.522 5.025C9.505 39.556 16.227 44 24 44z"/>
                    <path fill="#1976D2" d="M43.611 20.083H42V20H24v8h11.303a12.04 12.04 0 0 1-4.087 5.571l.003-.002 6.19 5.238C36.971 39.205 44 34 44 24c0-1.341-.138-2.65-.389-3.917z"/>
                </svg>
                Masuk Dengan Google
            </a>
        </div>
    </main>

</div>

</body>
</html>
