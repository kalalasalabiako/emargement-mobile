@extends('layouts.base')

@section('title')
Signature
@endsection

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
@vite('resources/css/emargements.css')
@endpush

@push('scripts')
@vite('resources/js/emargements.js')
@endpush

@section('content')

<div class="signature-page">

    <nav class="signature-navbar">
        <div class="brand">
            <div class="brand-icon">
                <i class="bi bi-mortarboard-fill"></i>
            </div>
            <span>Groupe</span>
            <strong>GEFOR</strong>
        </div>

        <div class="nav-links">
            <a href="{{ route('accueil', [], false) }}">
                <i class="bi bi-house-door-fill"></i>
                Accueil
            </a>

            <a href="{{ route('seances', [], false) }}">
                <i class="bi bi-calendar-event-fill"></i>
                Séances
            </a>

            <a href="{{ route('emargements', [$seance['id']], false) }}" class="active">
                <i class="bi bi-pencil-fill"></i>
                Signature
            </a>
        </div>

        <a href="{{ route('deconnexion', [], false) }}" class="logout-btn">
            <i class="bi bi-power"></i>
            Déconnexion
        </a>
    </nav>

    <main class="signature-container">

        <section class="hero-signature">
            <div class="hero-icon">
                <i class="bi bi-pencil"></i>
            </div>

            <div>
                <h1>Signature de présence</h1>
                <p>Validez votre présence en signant ci-dessous</p>
                <span class="hero-line"></span>
            </div>

            <div class="hero-drawing">
                <i class="bi bi-pencil"></i>
            </div>
        </section>

        <section class="info-card">
            <div class="section-heading">
                <div class="section-icon blue">
                    <i class="bi bi-calendar-event-fill"></i>
                </div>

                <h2>Informations de la séance</h2>
            </div>

            <div class="info-grid">

                <div class="info-item">
                    <div class="info-icon blue">
                        <i class="bi bi-calendar3"></i>
                    </div>

                    <div>
                        <span>Date</span>
                        <strong>{{ \Carbon\Carbon::parse($seance['date'])->format('d/m/Y') }}</strong>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon blue">
                        <i class="bi bi-clock"></i>
                    </div>

                    <div>
                        <span>Horaire</span>
                        <strong>
                            {{ \Carbon\Carbon::parse($seance['heure_debut'])->format('H:i') }}
                            à
                            {{ \Carbon\Carbon::parse($seance['heure_fin'])->format('H:i') }}
                        </strong>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon orange">
                        <i class="bi bi-person"></i>
                    </div>

                    <div>
                        <span>Formateur</span>
                        <strong>{{ $seance['user']['name'] ?? 'Inconnu' }}</strong>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon blue">
                        <i class="bi bi-book"></i>
                    </div>

                    <div>
                        <span>Matière</span>
                        <strong>{{ $seance['matiere'] }}</strong>
                    </div>
                </div>

            </div>
        </section>

        @if(session('remote_user.role') === 'enseignant' || session('remote_user.role') === 'formateur')
            <section class="info-card">
                <div class="section-heading">
                    <div class="section-icon orange">
                        <i class="bi bi-people-fill"></i>
                    </div>

                    <h2>Suivi des émargements</h2>
                </div>

                <div class="students-list">
                    @if(isset($apprenants) && count($apprenants) > 0)
                        @foreach($apprenants as $apprenant)
                            <div class="student-row">
                                <span>{{ $apprenant['prenom'] }} {{ $apprenant['nom'] }}</span>

                                @if($apprenant['signe'])
                                    <strong class="status signed">Signé</strong>
                                @else
                                    <strong class="status unsigned">Non signé</strong>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <p class="empty-text">Aucun apprenant trouvé pour cette séance.</p>
                    @endif
                </div>
            </section>
        @endif

        <section class="signature-card">

            <div class="signature-card-header">
                <div class="section-heading">
                    <div class="section-icon orange">
                        <i class="bi bi-pencil"></i>
                    </div>

                    <div>
                        <h2>Votre signature</h2>
                        <p>Signez dans le cadre ci-dessous</p>
                    </div>
                </div>

                <button type="button" id="clear" class="clear-link">
                    <i class="bi bi-arrow-clockwise"></i>
                    Effacer
                </button>
            </div>

            <form method="POST" action="{{ route('emargements.store', absolute: false) }}">
                @csrf

                <input type="hidden" name="seance_id" value="{{ $seance['id'] }}">
                <input type="hidden" name="signature" id="signature_input">

                <div class="signature-wrapper">
                    <canvas id="signature-pad" class="signature-pad"></canvas>

                    <div class="signature-placeholder">
                        <i class="bi bi-pencil"></i>
                        <span>Signez ici</span>
                    </div>
                </div>

                <button type="submit" id="save" class="btn-sign">
                    <i class="bi bi-lock-fill"></i>
                    Enregistrer la signature
                </button>
            </form>

            @if(session('status'))
                <div class="alert-message success">
                    {{ session('status') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert-message error">
                    {{ session('error') }}
                </div>
            @endif

        </section>

        <section class="secure-card">
            <div class="secure-icon">
                <i class="bi bi-shield-check"></i>
            </div>

            <div>
                <h3>Votre signature est sécurisée</h3>
                <p>Elle atteste de votre présence à cette séance.</p>
            </div>

            <div class="secure-watermark">
                <i class="bi bi-patch-check"></i>
            </div>
        </section>

    </main>

</div>

@endsection
