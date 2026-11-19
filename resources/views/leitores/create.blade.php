@extends('layouts.app')

@section('title', 'Novo leitor')

@section('content')
<h1 class="mb-4">Novo leitor</h1>

<form method="POST" action="{{ route('leitores.store') }}">
    @csrf
    @include('leitores._form')

    <button class="btn btn-primary">Salvar</button>
    <a href="{{ route('leitores.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection