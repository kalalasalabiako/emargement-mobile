@extends('layouts.base')

@section('title')
Signature
@endsection

 @push('styles')
@vite('resources/css/emargements.css')
@endpush

@push('scripts')
@vite('resources/js/emargements.js')
@endpush

@section('content')

<div class="signature-page">

    <div class="page-title">
        <h1>✍️ Signature de présence</h1>
    </div>

    <!-- Informations séance -->
    <div class="card-custom">

        <h3 class="card-title">
            📚 Informations de la séance
        </h3>

        <div class="info-row">
            <span class="info-label">📅 Date</span>
            <span>{{ \Carbon\Carbon::parse($seance['date'])->format('d/m/Y') }}</span>
        </div>

        <div class="info-row">
            <span class="info-label">🕒 Horaire</span>
            <span>
                {{ \Carbon\Carbon::parse($seance['heure_debut'])->format('H:i') }}
                à
                {{ \Carbon\Carbon::parse($seance['heure_fin'])->format('H:i') }}
            </span>
        </div>

        <div class="info-row">
            <span class="info-label">👨‍🏫 Formateur</span>
            <span>{{ $seance['user']['name'] ?? 'Inconnu' }}</span>
        </div>

        <div class="info-row">
            <span class="info-label">🎓 Matière</span>
            <span>{{ $seance['matiere'] }}</span>
        </div>

    </div>

<!-- Liste des apprenants -->
<div class="card-custom">

    <h3 class="card-title">
        👥 Suivi des émargements
    </h3>

    @if(isset($apprenants) && count($apprenants) > 0)

        @foreach($apprenants as $apprenant)

            <div class="info-row">
                <span>
                    {{ $apprenant['prenom'] }} {{ $apprenant['nom'] }}
                </span>

                @if($apprenant['signe'])
                    <span style="color: green; font-weight: bold;">
                        🟢 Signé
                    </span>
                @else
                    <span style="color: red; font-weight: bold;">
                        🔴 Non signé
                    </span>
                @endif
            </div>

        @endforeach

    @else
        <p>Aucun apprenant trouvé pour cette séance.</p>
    @endif

</div>

    <!-- Signature -->
    <div class="card-custom">

        <h3 class="card-title">
            ✍️ Signature
        </h3>

       <form method="POST" action="{{ route('emargements.store', absolute: false) }}">
            @csrf

            <input
                type="hidden"
                name="seance_id"
                value="{{ $seance['id'] }}"
            >

            <input
                type="hidden"
                name="signature"
                id="signature_input"
            >

            <div class="signature-wrapper">

                <canvas
                    id="signature-pad"
                    class="signature-pad">
                </canvas>

                <p class="signature-help">
                    Signez dans la zone ci-dessus
                </p>

            </div>

            <div class="actions">

                <button
                    type="submit"
                    id="save"
                    class="btn-sign">

                    ✓ Signer la séance

                </button>

                <button
                    type="button"
                    id="clear"
                    class="btn-clear">

                    ✕ Effacer

                </button>

            </div>

        </form>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

    </div>

</div>

@endsection
