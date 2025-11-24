@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-md bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Connexion Admin</h2>

    @if ($errors->any())
        <div class="bg-red-200 text-red-800 p-2 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login.post') }}">
        @csrf
        <div class="mb-4">
            <label>Email</label>
            <input type="email" name="email" class="w-full border p-2 rounded" required>
        </div>
        <div class="mb-4">
            <label>Mot de passe</label>
            <input type="password" name="password" class="w-full border p-2 rounded" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Se connecter</button>
    </form>
</div>
@endsection
