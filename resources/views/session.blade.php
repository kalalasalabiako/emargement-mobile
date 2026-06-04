@extends('layouts.base')

@section('title')
    Session
@endsection

@push('styles')
@vite('resources/css/session.css')
@endpush

@push('scripts')
@vite('resources/js/session.js')
@endpush

@section('content')
<h1>Session à venir</h1>

<div class="sidebar">
    <h3>📊 Tableau de bord</h3>
    <a href="#">Cours</a>
    <a href="#">Signature</a>
</div>

<div class="main">

    <div class="topbar">
        <div class="session">Session DORA</div>
    </div>

    <div class="card">
        <h3>Cours à venir</h3>
        <div class="table">
            <div><span>Gestion de projet</span><span>Jean MOULIN</span></div>
            <div><span>Mathématiques</span><span>Pierre BORIN</span></div>
            <div><span>CEJM</span><span>Ryan ZEMA</span></div>
            <div><span>Anglais</span><span>Paul DUPONT</span></div>
            <div><span>CGE</span><span>Serge POMMIER</span></div>
            <div><span>Service support</span><span>Patrick DOMPLON</span></div>
        </div>
    </div>

    <div class="session-list">
        <h3>Session à venir :</h3>

        @foreach(['CEJM','Mathématique','CGE','Anglais','Services Support','Gestion de projet'] as $cours)
            <div class="session-item">
                <span>{{ $seances }}</span>

                <a class="sign-btn"
                   href="{{ route('emargements', ['id' => $seances], false) }}">
                    Signer ici
                </a>
            </div>
        @endforeach

    </div>

</div>

<button class="logout">Déconnexion</button>
@endsection
