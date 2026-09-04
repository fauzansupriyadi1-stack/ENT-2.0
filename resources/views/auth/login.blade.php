<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Admin | FZAN NEWS</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        :root {
            --c-teal: #076653;
            --c-teal-hover: #054f40;
            --c-darkest: #06231D;
            --c-bg: #FAFAF8;
            --c-text-main: #1A1A1A;
            --c-text-muted: #666666;
            --c-border: #EBEBEB;
            --font-serif: 'Playfair Display', Georgia, serif;
            --font-sans: 'Inter', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-sans);
            background: linear-gradient(135deg, #06231D 0%, #076653 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            color: var(--c-text-main);
        }

        .login-card {
            background: #ffffff;
            width: 100%;
            max-width: 440px;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 48px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .brand-logo {
            font-family: var(--font-serif);
            font-size: 32px;
            font-weight: 700;
            color: var(--c-darkest);
            text-decoration: none;
            display: inline-block;
            margin-bottom: 8px;
        }

        .brand-logo span {
            color: var(--c-teal);
        }

        .login-subtitle {
            font-size: 14px;
            color: var(--c-text-muted);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 13.5px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--c-text-main);
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 16px;
        }

        .form-control {
            width: 100%;
            padding: 13px 16px 13px 44px;
            border: 1.5px solid var(--c-border);
            border-radius: 10px;
            font-size: 14.5px;
            font-family: inherit;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--c-teal);
            box-shadow: 0 0 0 4px rgba(7, 102, 83, 0.1);
        }

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 13px;
            margin-bottom: 24px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            color: var(--c-text-muted);
        }

        .remember-me input {
            accent-color: var(--c-teal);
            width: 16px;
            height: 16px;
        }

        .btn-submit {
            width: 100%;
            background-color: var(--c-teal);
            color: #ffffff;
            border: none;
            padding: 14px;
            border-radius: 99px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 14px rgba(7, 102, 83, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover {
            background-color: var(--c-teal-hover);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(7, 102, 83, 0.4);
        }

        .login-footer {
            text-align: center;
            margin-top: 24px;
            font-size: 13px;
            color: var(--c-text-muted);
        }

        .login-footer a {
            color: var(--c-teal);
            font-weight: 600;
            text-decoration: none;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <a href="{{ url('/') }}" class="brand-logo">
                FZAN NEWS<span>.</span>
            </a>
            <p class="login-subtitle">Masuk ke Panel Dashboard Admin FZAN NEWS</p>
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label" for="email">Alamat Email</label>
                <div class="input-wrap">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" id="email" class="form-control" placeholder="admin@fzannews.com" required value="{{ old('email', 'admin@fzannews.com') }}">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Kata Sandi</label>
                <div class="input-wrap">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required value="password">
                </div>
            </div>

            <div class="form-options">
                <label class="remember-me">
                    <input type="checkbox" name="remember" checked> Ingat saya
                </label>
                <a href="{{ route('dashboard.index') }}" style="color: var(--c-teal); text-decoration: none; font-weight: 500;">Langsung ke Dashboard</a>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-sign-in-alt"></i> Masuk Sekarang
            </button>
        </form>

        <div class="login-footer">
            <p><a href="{{ url('/') }}"><i class="fas fa-arrow-left"></i> Kembali ke Beranda Utama</a></p>
        </div>
    </div>
</body>
</html>
