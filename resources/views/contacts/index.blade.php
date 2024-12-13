@extends('layouts.app')

@section('title', 'Lista de Contatos')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <h2 class="mb-4">Lista de Contatos</h2>
    <a href="{{ route('contacts.create') }}" class="btn btn-primary mb-3">Adicionar Novo Contato</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Contacto</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->contact }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>
                        <a href="{{ route('contacts.show', $contact) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
