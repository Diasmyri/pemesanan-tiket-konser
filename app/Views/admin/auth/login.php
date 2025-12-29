<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Authentication | Secure Access</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --bg-slate: #0f172a;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --white: #ffffff;
            --error: #ef4444;
            --border: #e2e8f0;
        }

        * {
            box-sizing: border-box;
            -webkit-font-smoothing: antialiased;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: "Inter", sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--bg-slate);
            /* Background pattern halus */
            background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.05) 1px, transparent 0);
            background-size: 40px 40px;
            overflow: hidden;
        }

        /* Abstract Glows */
        .glow {
            position: absolute;
            width: 400px;
            height: 400px;
            background: var(--primary);
            filter: blur(150px);
            opacity: 0.15;
            z-index: -1;
        }

        .glow-1 { top: -100px; left: -100px; }
        .glow-2 { bottom: -100px; right: -100px; }

        .login-card {
            width: 100%;
            max-width: 440px;
            padding: 48px;
            background: rgba(255, 255, 255, 0.98);
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-header {
            text-align: left;
            margin-bottom: 32px;
        }

        .badge-admin {
            display: inline-block;
            padding: 4px 12px;
            background: rgba(37, 99, 235, 0.1);
            color: var(--primary);
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 12px;
        }

        .login-title {
            font-size: 28px;
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: -0.5px;
            margin: 0;
        }

        .login-subtitle {
            color: var(--text-muted);
            font-size: 14px;
            margin-top: 8px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-main);
        }

        .input-group {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-group i.prefix {
            position: absolute;
            left: 16px;
            color: var(--text-muted);
            font-size: 16px;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px 14px 45px;
            background: var(--white);
            border: 1.5px solid var(--border);
            border-radius: 10px;
            color: var(--text-main);
            outline: none;
            transition: all 0.2s ease;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        /* Toggle Password */
        .toggle-password {
            position: absolute;
            right: 16px;
            color: var(--text-muted);
            cursor: pointer;
            transition: 0.2s;
        }

        .toggle-password:hover { color: var(--primary); }

        .alert {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            background: #fef2f2;
            color: var(--error);
            border-radius: 10px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 24px;
            border: 1px solid #fee2e2;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 10px;
        }

        .btn-login:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.4);
        }

        .btn-login:active { transform: translateY(0); }

        .footer-copyright {
            margin-top: 32px;
            text-align: center;
            font-size: 12px;
            color: var(--text-muted);
            border-top: 1px solid var(--border);
            padding-top: 20px;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-card { padding: 32px 24px; width: 90%; }
        }
    </style>
</head>

<body>
    <div class="glow glow-1"></div>
    <div class="glow glow-2"></div>

    <div class="login-card">
        <div class="login-header">
            <span class="badge-admin">Internal Access Only</span>
            <h1 class="login-title">Sign In</h1>
            <p class="login-subtitle">Enter your credentials to access the console.</p>
        </div>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert">
                <i class="fas fa-circle-exclamation"></i>
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="/admin/auth/loginProcess" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <div class="input-group">
                    <i class="fas fa-envelope prefix"></i>
                    <input type="text" id="username" name="name" class="form-control" placeholder="admin.account" required autocomplete="off">
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <i class="fas fa-shield-halved prefix"></i>
                    <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
                    <i class="fas fa-eye toggle-password" id="eyeIcon" onclick="togglePass()"></i>
                </div>
            </div>

            <button type="submit" class="btn-login">
                Authenticate Access
            </button>
        </form>

        <div class="footer-copyright">
            &copy; <?= date('Y') ?> <strong>Ticketing System</strong> &bull; Core Engine v2.4
        </div>
    </div>

    <script>
        function togglePass() {
            const passInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passInput.type === 'password') {
                passInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>