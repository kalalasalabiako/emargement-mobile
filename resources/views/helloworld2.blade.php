@extends('layouts.base')


@section('title')

 Hello

@endsection

@push('styles')
@vite('resources/css/app1.css')
@endpush


 @section('content')

<h1>TEST</h1>
<a href="{{ route('connexion') }}">lien</a>
 @endsection

