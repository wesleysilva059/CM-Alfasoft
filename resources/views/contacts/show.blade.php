@extends('layouts.app')

@section('title', 'Detalhes do Contato')

@section('content')
    <h2>Detalhes do Contato</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $contact->id }}</p>
            <p><strong>Nome:</strong> {{ $contact->name }}</p>
            <p><strong>Contacto:</strong> {{ $contact->contact }}</p>
            <p><strong>Email:</strong> {{ $contact->email }}</p>

            <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-warning">Editar</a>

            <!-- Formulário de exclusão -->
            <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este contato?')">Excluir</button>
            </form>

            <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
@endsection
