<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion - GEFOR</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            background: url("{{ asset('background/img.png') }}") no-repeat center center/cover;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(10, 18, 40, 0.35);
        }

        .login-card {
            width: 430px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 28px;
            padding: 42px 38px;
            position: relative;
            z-index: 1;
            box-shadow: 0 25px 70px rgba(0,0,0,0.45);
            backdrop-filter: blur(12px);
        }

        .logo-box {
            width: 92px;
            height: 92px;
            border-radius: 50%;
            margin: 0 auto 18px;
            border: 4px solid #ed6728;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            overflow: hidden;
        }

        .logo-box img {
            width: 72px;
            height: auto;
        }

        h1 {
            text-align: center;
            color: #112246;
            font-size: 28px;
            margin-bottom: 30px;
        }

        .input-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            color: #112246;
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 16px;
        }

        input {
            width: 100%;
            height: 54px;
            border-radius: 14px;
            border: 1px solid #cfcfcf;
            padding: 0 16px;
            font-size: 16px;
            outline: none;
            background: white;
        }

        input:focus {
            border-color: #ed6728;
            box-shadow: 0 0 0 3px rgba(237, 103, 40, 0.18);
        }

        .forgot {
            text-align: right;
            color: #ed6728;
            font-size: 14px;
            margin-bottom: 28px;
        }

        .login-btn {
            width: 100%;
            height: 56px;
            border: none;
            border-radius: 14px;
            background: #ed6728;
            color: white;
            font-size: 17px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.25s;
        }

        .login-btn:hover {
            background: #d9561d;
            transform: translateY(-2px);
        }

        .alert {
            background: #ffe5e5;
            color: #9b1c1c;
            padding: 12px;
            border-radius: 12px;
            text-align: center;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .mobile-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            padding: 16px;
            border-radius: 14px;
            border: 2px solid #112246;
            color: #112246;
            text-decoration: none;
            font-weight: bold;
        }

        .mobile-link:hover {
            background: #112246;
            color: white;
        }
    </style>
</head>

<body>

    <div class="login-card">

        <div class="logo-box">

        </div>

        <h1>Connexion</h1>

        @if (session('error'))
            <div class="alert">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('connexion.post', [], false) }}">
            @csrf

            <div class="input-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" required autofocus>
            </div>

            <div class="input-group">
                <label for="password">Mot de passe *</label>
                <input type="password" id="password" name="password" required>
            </div>

            <p class="forgot">Mot de passe oublié ?</p>

            <button type="submit" class="login-btn">
                Connexion
            </button>
        </form>



    </div>

</body>
</html>
