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
    height:100vh;
    background:url("{{ asset('background/img.png') }}") no-repeat center/cover;
    display:flex;
    overflow:hidden;
}

/* ================= SIDEBAR ================= */

.sidebar{
    width:240px;
    height:92%;
    margin:20px;
    background:rgba(0,0,0,0.72);
    border-radius:25px;
    padding:25px;
    color:white;

    display:flex;
    flex-direction:column;
    justify-content:space-between;

    backdrop-filter:blur(12px);

    box-shadow:0 10px 40px rgba(0,0,0,0.4);
}

.sidebar-top h2{
    margin-bottom:30px;
    font-size:24px;
}

.menu{
    list-style:none;
}

.menu li{
    margin-bottom:15px;
}

.menu a{
    text-decoration:none;
    color:white;

    display:flex;
    align-items:center;
    gap:10px;

    padding:14px;
    border-radius:12px;

    transition:0.3s;
}

.menu a:hover,
.menu .active{
    background:white;
    color:black;
}

/* ================= MAIN ================= */

.main{
    flex:1;
    padding:30px;
    overflow-y:auto;
}

/* ================= CARD ================= */

.card{
    width:750px;

    background:rgba(255,255,255,0.92);

    border-radius:20px;

    overflow:hidden;

    box-shadow:0 20px 50px rgba(0,0,0,0.35);

    backdrop-filter:blur(15px);
}

/* HEADER */

.card-header{
    background:#f4f4f4;

    padding:18px 25px;

    display:flex;
    justify-content:space-between;
    align-items:center;
}

.card-header img{
    height:40px;
}

.nav-links{
    display:flex;
    gap:25px;
}

.nav-links span{
    cursor:pointer;
    transition:0.3s;
    font-weight:500;
}

.nav-links span:hover{
    color:#5567a5;
}

/* BODY */

.card-body{
    padding:30px;
    background:linear-gradient(135deg,#5567a5,#697dcb);
    color:white;
}

/* WELCOME */

.welcome{
    margin-bottom:25px;
}

.welcome h1{
    font-size:30px;
    margin-bottom:10px;
}

.welcome p{
    opacity:0.9;
}

/* ================= SEANCES ================= */

.seances-container{
    margin-top:20px;
}

.dropdown{
    background:rgba(255,255,255,0.12);
    border-radius:15px;
    overflow:hidden;
    margin-bottom:20px;
}

.dropdown-header{
    padding:18px 20px;
    cursor:pointer;

    display:flex;
    justify-content:space-between;
    align-items:center;

    font-size:18px;
    font-weight:bold;

    transition:0.3s;
}

.dropdown-header:hover{
    background:rgba(255,255,255,0.15);
}

.dropdown-content{
    display:none;
    padding:20px;
    background:rgba(255,255,255,0.08);
}

.dropdown-content.active{
    display:block;
}

/* CARTE SEANCE */

.seance-card{
    background:white;
    color:black;

    padding:18px;
    border-radius:15px;

    margin-bottom:15px;

    display:flex;
    justify-content:space-between;
    align-items:center;

    box-shadow:0 5px 20px rgba(0,0,0,0.15);
}

.seance-info h3{
    margin-bottom:8px;
    color:#5567a5;
}

.seance-info p{
    font-size:14px;
    margin-bottom:5px;
}

/* SIGNATURE BUTTON */

.sign-btn{
    background:#5567a5;
    color:white;

    padding:12px 18px;

    border-radius:12px;

    text-decoration:none;

    transition:0.3s;
}

.sign-btn:hover{
    background:#44538a;
    transform:scale(1.05);
}

/* ================= SIGNATURE ================= */

.signature-box{
    margin-top:25px;

    background:rgba(255,255,255,0.12);

    padding:25px;

    border-radius:20px;
}

.signature-box h2{
    margin-bottom:15px;
}

.signature-box p{
    opacity:0.9;
    line-height:1.6;
}

/* ================= LOGOUT ================= */

.logout{
    position:absolute;

    bottom:30px;
    right:40px;

    background:rgba(255,255,255,0.7);

    border:none;

    padding:12px 28px;

    border-radius:25px;

    cursor:pointer;

    transition:0.3s;

    text-decoration:none;
    color:black;
}

.logout:hover{
    background:white;
    transform:scale(1.05);
}

</style>

</head>

<body>

<!-- SIDEBAR -->

<div class="sidebar">

    <div class="sidebar-top">

        <h2>🎓 GEFOR</h2>

        <ul class="menu">

            <li>
                <a class="active">
                    📊 Tableau de bord
                </a>
            </li>

            <li>
                <a href="#">
                    📚 Séances
                </a>
            </li>

            <li>
                <a href="#">
                    ✍️ Signature
                </a>
            </li>

        </ul>

    </div>

</div>

<!-- MAIN -->

<div class="main">

    <div class="card">

        <!-- HEADER -->

        <div class="card-header">

            <img src="{{ asset('logo.png') }}" alt="logo">

            <div class="nav-links">
                <span>Accueil</span>
                <span>Emargement</span>
            </div>

        </div>

        <!-- BODY -->

        <div class="card-body">

            <!-- WELCOME -->

            <div class="welcome">

                <h1>
                    Bonjour {{ Auth::user()->name }} 👋
                </h1>

                <p>
                    Retrouvez ici vos séances à venir et signez votre présence.
                </p>

            </div>

            <!-- MENU DEROULANT -->

            <div class="seances-container">

                <div class="dropdown">

                    <div class="dropdown-header" id="dropdownBtn">

                        📅 Séances à venir

                        <span>▼</span>

                    </div>

                    <div class="dropdown-content" id="dropdownContent">

                        @forelse ($seances as $seance)

                            <div class="seance-card">

                                <div class="seance-info">

                                    <h3>
                                        {{ $seance['matiere'] ?? 'Cours' }}
                                    </h3>

                                    <p>
                                        📅
                                        {{ \Carbon\Carbon::parse($seance['date'])->format('d/m/Y') }}
                                    </p>

                                    <p>
                                        ⏰
                                        {{ \Carbon\Carbon::parse($seance['heure_debut'])->format('H:i') }}

                                        à

                                        {{ \Carbon\Carbon::parse($seance['heure_fin'])->format('H:i') }}
                                    </p>

                                    <p>
                                        👨‍🏫
                                        {{ $seance['user']['name'] ?? '' }}
                                        {{ $seance['user']['prenom'] ?? '' }}
                                    </p>

                                </div>

                                <a href="{{ route('emargements', $seance['id']) }}"
                                   class="sign-btn">

                                    Signer

                                </a>

                            </div>

                        @empty

                            <p>
                                Aucune séance à venir.
                            </p>

                        @endforelse

                    </div>

                </div>

            </div>

            <!-- ONGLET SIGNATURE -->

            <div class="signature-box">

                <h2>
                    ✍️ Signature numérique
                </h2>

                <p>
                    Vous pouvez signer électroniquement votre présence
                    directement depuis votre espace étudiant.
                    Chaque signature est enregistrée automatiquement
                    dans le système d’émargement GEFOR.
                </p>

            </div>

        </div>

    </div>

</div>

<!-- LOGOUT -->

<a href="{{ route('deconnexion', [], false) }}">
   class="logout">

    Déconnexion

</a>

<script>

/* MENU DEROULANT */

const dropdownBtn = document.getElementById('dropdownBtn');
const dropdownContent = document.getElementById('dropdownContent');

dropdownBtn.addEventListener('click', () => {

    dropdownContent.classList.toggle('active');

});

</script>

</body>
</html>
