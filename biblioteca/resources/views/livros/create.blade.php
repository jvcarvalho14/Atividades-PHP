@extends('layouts.app')

@section('title', 'Novo livro')

@section('content')
<h1 class="mb-4">Novo livro</h1>

<form method="POST" action="{{ route('livros.store') }}">
    @csrf
    @include('livros._form')

    <button class="btn btn-primary">Salvar</button>
    <a href="{{ route('livros.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection