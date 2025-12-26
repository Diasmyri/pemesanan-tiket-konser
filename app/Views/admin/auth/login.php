<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Poppins", sans-serif;
            height: 100vh;
            overflow: hidden;
            color: white;

            background: url('https://images.unsplash.com/photo-1506157786151-b8491531f063?auto=format&fit=crop&w=1350&q=80')
                        no-repeat center center/cover;
            position: relative;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(10, 0, 30, 0.65);
            backdrop-filter: blur(4px);
        }

        .login-card {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 420px;
            padding: 40px 35px;
            background: rgba(0, 0, 0, 0.55);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow:
                0 0 30px rgba(150, 0, 255, 0.4),
                0 0 45px rgba(0, 217, 255, 0.25);
            backdrop-filter: blur(10px);
        }

        .login-title {
            text-align: center;
            font-size: 25px;
            font-weight: 600;
            margin-bottom: 25px;
            text-shadow: 
                0 0 8px rgba(255, 255, 255, 0.8),
                0 0 18px rgba(150, 0, 255, 0.7);
        }

        label {
            font-size: 14px;
            font-weight: 500;
            letter-spacing: 0.3px;
        }

        .form-control {
            width: 100%;
            margin-top: 5px;
            padding: 10px 12px;
            background: rgba(40, 40, 40, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            color: white;
            outline: none;
            transition: .25s;
        }

        .form-control:focus {
            background: rgba(55, 55, 55, 0.95);
            border-color: #b377ff;
            box-shadow: 0 0 12px #b377ff;
        }

        .btn-login {
            background: linear-gradient(135deg, #7f00ff, #00eaff);
            border: none;
            padding: 12px;
            margin-top: 18px;
            color: white;
            width: 100%;
            border-radius: 10px;
            font-weight: 600;
            letter-spacing: 0.5px;
            box-shadow: 0 0 12px rgba(127, 0, 255, 0.6);
            transition: .25s;
            cursor: pointer;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 20px rgba(127, 0, 255, 0.9);
        }

        .extra-links {
            margin-top: 12px;
            text-align: center;
            font-size: 14px;
        }

        .extra-links a {
            color: #8ecbff;
            text-decoration: none;
            font-weight: 500;
        }

        .extra-links a:hover {
            color: white;
            text-decoration: underline;
        }

        .register-btn {
            margin-top: 18px;
            width: 100%;
            padding: 10px;
            border-radius: 10px;
            font-weight: 500;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            cursor: pointer;
            transition: .25s;
            display: block;
            text-align: center;
        }

        .register-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
        }

        /* Responsif */
        @media (max-width: 480px) {
            .login-card {
                width: 90%;
                padding: 25px;
            }
        }
    </style>
</head>

<body>

    <div class="overlay"></div>

    <div class="login-card">
        <div class="login-title">Admin Login</div>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="/admin/auth/loginProcess" method="post">

            <label>Username</label>
            <input type="text" name="name" class="form-control" required>

            <label style="margin-top:15px;">Password</label>
            <input type="password" name="password" class="form-control" required>

            <button class="btn-login">Login</button>
        </form>


</body>
</html>
