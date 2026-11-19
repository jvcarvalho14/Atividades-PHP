@extends('layouts.app')

@section('title', 'Editar leitor')

@section('content')
<h1 class="mb-4">Editar leitor</h1>

<form method="POST" action="{{ route('leitores.update', $leitor) }}">
    @csrf
    @method('PUT')
    @include('leitores._form')

    <button class="btn btn-primary">Atualizar</button>
    <a href="{{ route('leitores.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
