@extends('layouts.app')

@section('title', 'Editar Contato')

@section('content')
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <h2>Editar Contato</h2>
    <form action="{{ route('contacts.update', $contact) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $contact->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="contact">Contacto</label>
            <input type="text" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact', $contact->contact) }}" required>
            @error('contact')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $contact->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
