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

           /* BODY + overlay sombre */
           body {
               height: 100vh;
               background: url("background/img.png") no-repeat center center/cover;
               display: flex;
               justify-content: center;
               align-items: center;
               position: relative;
           }

           /* assombrit le fond comme sur la maquette */
           body::before {
               content: "";
               position: absolute;
               inset: 0;
               background: rgba(0,0,0,0.25);
               z-index: 0;
           }

           /* Carte principale */
           .login-card {
               width: 290px;
               height: 570px;
               background: linear-gradient(180deg, #4b5fa9, #5a6eb5);
               border-radius: 160px;
               display: flex;
               flex-direction: column;
               align-items: center;
               padding-top: 80px;
               position: relative;
               z-index: 1;

               /* ombre profonde */
               box-shadow: 0 30px 80px rgba(0,0,0,0.6);
           }




           /* Form */
           .form {
               width: 80%;
               margin-top: 60px;
           }

           /* Labels */
           .form label {
               color: white;
               font-size: 15px;
               display: block;
               margin-bottom: 6px;
           }

           /* Inputs */
           .form input {
               width: 100%;
               padding: 14px;
               border-radius: 30px;
               border: none;
               outline: none;
               margin-bottom: 22px;

               background: #dcdcdc;

               /* effet enfoncé */
               box-shadow:
                   inset 0 4px 8px rgba(0,0,0,0.25),
                   inset 0 -2px 3px rgba(255,255,255,0.5);
           }

           /* Bouton */
           .btn {
               margin-top: 10px;
               background: #ff7a00;
               color: white;
               border: none;
               padding: 14px 35px;
               border-radius: 30px;
               font-size: 16px;
               cursor: pointer;

               box-shadow: 0 6px 15px rgba(0,0,0,0.4);
               transition: 0.2s;
           }

           .btn:hover {
               transform: translateY(-2px);
           }

           /* Message erreur */
           .error {
               color: #ffcccc;
               font-size: 13px;
               margin-top: 10px;
               text-align: center;
           }
       </style>
     </head>


    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">

<div class="login-card">

    <div class="avatar"></div>

   <!-- <form class="form" id="loginForm">
        <label>Identifiant<span>*</span></label>
        <input type="text" id="username" required>

        <label>Mot de passe<span>*</span></label>
        <input type="password" id="password" required>

        <div style="text-align:center;">
            <button type="submit" class="btn"><a href="{{ route('accueil') }}">Connexion</a></button>


        </div>

        <div class="error" id="error"></div>
    </form>

</div>-->

@if (session('error'))
            <div class="alert">
                {{ session('error') }}
            </div>
        @endif

      <form method="POST" action="{{ route('connexion.post', absolute: false) }}">
            @csrf

            <div class="input-group">
                <label for="email">Email *</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    autofocus
                >
            </div>

            <div class="input-group">
                <label for="password">Mot de passe *</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                >
            </div>

            <p class="forgot">Mot de passe oublié ?</p>

            <button type="submit" class="login-btn">
                Connexion
            </button>

        </form>

        </body>
    </html>
