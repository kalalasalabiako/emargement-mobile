@extends('layouts.base')

@section('title')
 Formateurs - Élèves
@endsection

@push('styles')
@vite('resources/css/profile.css')
@endpush


@push('scripts')
@vite('resources/js/profile.js')
@endpush

@section('content')

<div class="container">

    <div class="content"> <!-- IMPORTANT -->

        <!-- FORMULAIRE -->
        <div class="form-card">
            <h3>Ajoutez un élève</h3>

            <input type="text" id="nom" placeholder="Nom de l'élève">
            <input type="text" id="prenom" placeholder="Prénom">
            <textarea id="commentaire" placeholder="Commentaire"></textarea>

            <div class="buttons">
                <button class="cancel">Annuler</button>
                <button class="confirm" onclick="updatePreview()">Confirmer</button>
            </div>
        </div>

        <!-- APERÇU -->
        <div class="preview-card">
            <h3>Aperçu</h3>

            <img src="{{ asset('background/img.jpg') }}" id="preview-img">

            <p><strong>Nom :</strong> <span id="p-nom">-</span></p>
            <p><strong>Prénom :</strong> <span id="p-prenom">-</span></p>
            <p><strong>Classe :</strong> BTS Banque</p>
        </div>

    </div>

    <!-- PAGINATION -->
    <div class="pagination">
        <span>Page 1 sur 4</span>
        <button>←</button>
        <button>→</button>
    </div>

</div>
