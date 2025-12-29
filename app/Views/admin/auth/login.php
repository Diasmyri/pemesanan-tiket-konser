<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #4e73df;
            --bg-color: #f8f9fc;
            --text-main: #5a5c69;
            --white: #ffffff;
            --border-color: #d1d3e2;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: "Poppins", sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--bg-color);
            background-image: linear-gradient(180deg, var(--primary-color) 10%, #224abe 100%);
            background-size: cover;
        }

        /* Menghilangkan overlay berat, diganti dengan subtle gradient background */
        .overlay {
            display: none; 
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background: var(--white);
            border-radius: 15px;
            border: none;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .login-title {
            text-align: center;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
            color: #333;
            text-shadow: none; /* Hilangkan glow neon */
        }

        .login-subtitle {
            text-align: center;
            color: #858796;
            font-size: 14px;
            margin-bottom: 30px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-main);
        }

        .form-control {
            width: 100%;
            margin-bottom: 20px;
            padding: 12px 15px;
            background: #fff;
            border: 1px solid var(--border-color);
            border-radius: 50px; /* Style admin modern biasanya rounded-full */
            color: #495057;
            outline: none;
            transition: all .2s ease-in-out;
            box-sizing: border-box;
            font-family: inherit;
        }

        .form-control:focus {
            background: #fff;
            border-color: #bac8f3;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
            color: #6e707e;
        }

        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 10px;
            font-size: 13px;
            text-align: center;
        }

        .alert-danger {
            background-color: #fff5f5;
            color: #e74a3b;
            border: 1px solid #ffebeb;
        }

        .btn-login {
            background-color: var(--primary-color);
            border: none;
            padding: 12px;
            margin-top: 10px;
            color: white;
            width: 100%;
            border-radius: 50px;
            font-weight: 600;
            font-size: 14px;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all .25s;
            cursor: pointer;
        }

        .btn-login:hover {
            background-color: #2e59d9;
            transform: translateY(-1px);
            box-shadow: 0 7px 14px rgba(0, 0, 0, 0.1);
        }

        /* Responsif */
        @media (max-width: 480px) {
            .login-card {
                width: 85%;
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>

    <div class="login-card">
        <div class="login-title">Welcome Back!</div>
        <div class="login-subtitle">Silahkan login ke panel admin</div>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="/admin/auth/loginProcess" method="post">
            <div style="margin-bottom: 15px;">
                <label>Username</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Username..." required>
            </div>

            <div style="margin-bottom: 15px;">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            <button type="submit" class="btn-login">Login System</button>
        </form>
    </div>

</body>
</html>