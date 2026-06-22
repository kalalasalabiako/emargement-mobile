@php
    $seances = $seances ?? [];
    $premiereSeance = !empty($seances) && count($seances) > 0 ? $seances[0] : null;
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - GEFOR</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    min-height:100vh;
    background:url("{{ asset('background/img.png') }}") no-repeat center/cover;
    display:flex;
    padding:24px;
    gap:28px;
}

.sidebar{
    width:270px;
    min-height:calc(100vh - 48px);
    background:linear-gradient(180deg, rgba(17,34,70,.96), rgba(18,24,40,.96));
    border-radius:28px;
    padding:28px 22px;
    color:white;
    box-shadow:0 25px 70px rgba(0,0,0,.35);
}

.brand{
    display:flex;
    align-items:center;
    gap:12px;
    margin-bottom:38px;
}

.brand h2{
    font-size:28px;
}

.menu{
    list-style:none;
    display:flex;
    flex-direction:column;
    gap:14px;
}

.menu a{
    text-decoration:none;
    color:rgba(255,255,255,.82);
    display:flex;
    align-items:center;
    gap:12px;
    padding:15px 16px;
    border-radius:18px;
    font-size:16px;
    font-weight:700;
    transition:.25s;
}

.menu a:hover,
.menu .active{
    background:white;
    color:#112246;
}

.main{
    flex:1;
    display:flex;
    justify-content:center;
    align-items:flex-start;
    padding-top:12px;
}

.card{
    width:min(900px, 100%);
    background:rgba(255,255,255,.92);
    border-radius:28px;
    overflow:hidden;
    box-shadow:0 25px 80px rgba(0,0,0,.28);
    backdrop-filter:blur(14px);
}

.card-header{
    height:92px;
    padding:0 34px;
    display:flex;
    align-items:center;
    justify-content:space-between;
}

.card-header img{
    height:42px;
}

.nav-links{
    display:flex;
    gap:12px;
}

.nav-links a{
    text-decoration:none;
    color:#112246;
    font-weight:700;
    padding:10px 16px;
    border-radius:14px;
}

.nav-links a:hover{
    background:#f1f3f8;
}

.card-body{
    padding:38px;
    background:linear-gradient(135deg,#f8f9ff,#eef2ff);
}

.welcome{
    background:linear-gradient(135deg,#112246,#4f65b4);
    color:white;
    padding:30px;
    border-radius:26px;
    margin-bottom:24px;
}

.welcome h1{
    font-size:34px;
    margin-bottom:8px;
}

.welcome p{
    opacity:.9;
    font-size:17px;
}

.dropdown{
    background:white;
    border-radius:24px;
    box-shadow:0 12px 30px rgba(17,34,70,.08);
    overflow:hidden;
    margin-bottom:24px;
}

.dropdown-header{
    padding:22px 26px;
    cursor:pointer;
    display:flex;
    justify-content:space-between;
    align-items:center;
    color:#112246;
    font-size:20px;
    font-weight:800;
}

.dropdown-content{
    display:none;
    padding:0 24px 24px;
}

.dropdown-content.active{
    display:block;
}

.seance-card{
    background:#f7f8fc;
    border:1px solid #e7e9f2;
    padding:18px;
    border-radius:20px;
    margin-bottom:14px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:20px;
}

.seance-info h3{
    color:#112246;
    margin-bottom:8px;
}

.seance-info p{
    color:#4b5563;
    font-size:14px;
    margin-bottom:4px;
}

.sign-btn{
    background:#ed6728;
    color:white;
    padding:12px 20px;
    border-radius:14px;
    text-decoration:none;
    font-weight:800;
    transition:.25s;
    white-space:nowrap;
}

.sign-btn:hover{
    background:#d9561d;
    transform:translateY(-2px);
}

.signature-box{
    background:white;
    padding:28px;
    border-radius:24px;
    box-shadow:0 12px 30px rgba(17,34,70,.08);
}

.signature-box h2{
    color:#112246;
    font-size:26px;
    margin-bottom:12px;
}

.signature-box p{
    color:#4b5563;
    line-height:1.7;
}

.logout{
    position:fixed;
    right:28px;
    bottom:28px;
    background:#ed6728;
    color:white;
    padding:14px 24px;
    border-radius:18px;
    text-decoration:none;
    font-weight:800;
    box-shadow:0 15px 35px rgba(237,103,40,.35);
}

.logout:hover{
    background:#d9561d;
}
</style>
</head>

<body>

<div class="sidebar">
    <div class="brand">
        <h2>GEFOR</h2>
    </div>

    <ul class="menu">
        <li>
            <a href="{{ route('accueil', [], false) }}" class="active">
                Tableau de bord
            </a>
        </li>

        <li>
            <a href="{{ route('seances', [], false) }}">
                Séances
            </a>
        </li>

        <li>
            @if($premiereSeance)
                <a href="{{ route('emargements', ['id' => $premiereSeance['id']], false) }}">
                    Signature
                </a>
            @else
                <a href="{{ route('accueil', [], false) }}">
                    Signature
                </a>
            @endif
        </li>
    </ul>
</div>

<div class="main">
    <div class="card">

        <div class="card-header">
            <img src="{{ asset('background/logogefor.jpg') }}" alt="logo">

            <div class="nav-links">
                <a href="{{ route('accueil', [], false) }}">Accueil</a>

                @if($premiereSeance)
                    <a href="{{ route('emargements', ['id' => $premiereSeance['id']], false) }}">
                        Emargement
                    </a>
                @else
                    <a href="{{ route('accueil', [], false) }}">
                        Emargement
                    </a>
                @endif
            </div>
        </div>

        <div class="card-body">

            <div class="welcome">
                <h1>Bonjour {{ Auth::user()->name }} 👋</h1>
                <p>Retrouvez ici vos séances à venir et signez votre présence.</p>
            </div>

            <div class="dropdown">
                <div class="dropdown-header" id="dropdownBtn">
                    📅 Séances à venir
                    <span>▼</span>
                </div>

                <div class="dropdown-content" id="dropdownContent">
                    @forelse($seances as $seance)
                        <div class="seance-card">
                            <div class="seance-info">
                                <h3>{{ $seance['matiere'] ?? 'Cours' }}</h3>

                                <p>
                                    📅 {{ \Carbon\Carbon::parse($seance['date'])->format('d/m/Y') }}
                                </p>

                                <p>
                                    ⏰ {{ \Carbon\Carbon::parse($seance['heure_debut'])->format('H:i') }}
                                    à
                                    {{ \Carbon\Carbon::parse($seance['heure_fin'])->format('H:i') }}
                                </p>

                                <p>
                                    👨‍🏫 {{ $seance['user']['name'] ?? '' }}
                                    {{ $seance['user']['prenom'] ?? '' }}
                                </p>
                            </div>

                            <a href="{{ route('emargements', ['id' => $seance['id']], false) }}" class="sign-btn">
                                @if(session('remote_user.role') === 'formateur' || session('remote_user.role') === 'enseignant')
                                    Voir
                                @else
                                    Signer
                                @endif
                            </a>
                        </div>
                    @empty
                        <p>Aucune séance à venir.</p>
                    @endforelse
                </div>
            </div>

            <div class="signature-box">
                <h2>Signature numérique</h2>
                <p>
                    Vous pouvez signer électroniquement votre présence directement depuis votre espace étudiant.
                    Chaque signature est enregistrée automatiquement dans le système d’émargement GEFOR.
                </p>
            </div>

        </div>
    </div>
</div>

<a href="{{ route('deconnexion', [], false) }}" class="logout">
    Déconnexion
</a>

<script>
const dropdownBtn = document.getElementById('dropdownBtn');
const dropdownContent = document.getElementById('dropdownContent');

dropdownBtn.addEventListener('click', () => {
    dropdownContent.classList.toggle('active');
});
</script>

</body>
</html>
