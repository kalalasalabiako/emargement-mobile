@extends('layouts.base')

@section('title')
   Signature
@endsection

@push('styles')
@vite('resources/css/app1.css')
@endpush

@push('scripts')
@vite('resources/js/signature.js')
@endpush

@section('content')
    <h1>Signature</h1>

 <ul>

                  <li>
                      Seance le {{ \Carbon\Carbon::parse($seance['date'])->format('d/m/Y') }}
                      - {{ \Carbon\Carbon::parse($seance['heure_debut'])->format('H:i') }}
                      à {{ \Carbon\Carbon::parse($seance['heure_fin'])->format('H:i') }}
                      : {{ $seance['user']['name'] ?? 'Inconnu' }}
                      <a href="{{route('signature', $seance['id'])}">Signer</a>
                  </li>

 </ul>

    <p>Cours de CEMJ - 17/04/26 à 13h 30</p>


    <canvas id="signature-pad" class="signature-pad" width=400 height=200></canvas>

    <form method="POST" action="{{ route('signatures.store') }}">
            @csrf
            <input type="hidden" name="seances_id" value="{{ $seance['id'] }}">
            <input type="hidden" name="signature" id="signature-input">

                <button type="submit" id="save">Signer la séance</button>
                <button type="button" id="clear">Effacer la signature</button>
        </form>

    @if (session('error'))
    <p>{{session('error')}}</p>
    @endif

    <div>
      <button id="save">Save</button>
      <button id="clear">Clear</button>
    </div>
@endsection
