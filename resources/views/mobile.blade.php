<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Téléchargement APK</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .card{
            background:white;
            padding:40px;
            border-radius:12px;
            box-shadow:0 4px 10px rgba(0,0,0,0.1);
            text-align:center;
        }

        .btn{
            display:inline-block;
            margin-top:20px;
            padding:12px 24px;
            background:#2563eb;
            color:white;
            text-decoration:none;
            border-radius:8px;
        }

        .btn:hover{
            background:#1d4ed8;
        }
    </style>
</head>
<body>

    <div class="card">
        <h1>Application Mobile</h1>

        <p>Téléchargez l'application Android</p>

        <a
            href="{{ asset('app-release.apk') }}"
            download
            class="btn"
        >
            Télécharger l'APK
        </a>
    </div>

</body>
</html>
