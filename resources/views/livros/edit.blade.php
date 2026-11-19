@extends('layouts.app')

@section('title', 'Editar livro')

@section('content')
<h1 class="mb-4">Editar livro</h1>

<form method="POST" action="{{ route('livros.update', $livro) }}">
    @csrf
    @method('PUT')
    @include('livros._form')

    <button class="btn btn-primary">Atualizar</button>
    <a href="{{ route('livros.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection