{{-- resources/views/clients/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Clients - Amane Bank')

@section('content')

<main class="main-content">

    <h1 class="page-title">Gestion des Clients</h1>
    <p class="page-subtitle">Recherche, tri et gestion complète de la clientèle</p>

    <!-- Message de succès -->
    @if(session('success'))
        <div style="background: rgba(16,185,129,0.15); border-left: 4px solid #10b981; padding: 18px 24px; border-radius: 12px; color: #10b981; margin-bottom: 32px; font-weight: 500; backdrop-filter: blur(10px);">
            {{ session('success') }}
        </div>
    @endif

    <!-- Barre d'actions + recherche -->
    <div style="display: flex; flex-wrap: wrap; gap: 16px; margin-bottom: 32px; justify-content: space-between; align-items: center;">
        <div style="display: flex; gap: 12px;">
            <a href="{{ route('clients.create') }}">
                <button style="padding: 14px 28px; background: linear-gradient(135deg, var(--accent), #f0c757); color: #0f172a; border: none; border-radius: 12px; font-weight: 700; cursor: pointer; box-shadow: 0 6px 20px rgba(212,175,55,0.3); transition: all 0.3s;">
                    Ajouter un client
                </button>
            </a>
        </div>

        <form method="GET" action="{{ route('clients.index') }}" style="display: flex; gap: 12px; flex-wrap: wrap; align-items: center;">
            <input type="text" name="search" placeholder="Rechercher un client..." value="{{ request('search') }}"
                   style="min-width: 280px; padding: 14px 18px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; color: white; font-size: 15px; transition: all 0.3s;"
                   onfocus="this.style.borderColor='#fbbf24'; this.style.boxShadow='0 0 0 3px rgba(251,191,36,0.2)'"
                   onblur="this.style.borderColor='rgba(255,255,255,0.15)'; this.style.boxShadow='none'">

            <select name="sort_by" style="padding: 14px 18px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; color: white; transition: all 0.3s;">
                <option value="">Trier par...</option>
                <option value="id" {{ request('sort_by')=='id' ? 'selected' : '' }}>ID</option>
                <option value="nom" {{ request('sort_by')=='nom' ? 'selected' : '' }}>Nom</option>
                <option value="prenom" {{ request('sort_by')=='prenom' ? 'selected' : '' }}>Prénom</option>
                <option value="email" {{ request('sort_by')=='email' ? 'selected' : '' }}>Email</option>
            </select>

            <select name="sort_direction" style="padding: 14px 18px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; color: white; transition: all 0.3s;">
                <option value="asc" {{ request('sort_direction')=='asc' ? 'selected' : '' }}>Croissant</option>
                <option value="desc" {{ request('sort_direction')=='desc' ? 'selected' : '' }}>Décroissant</option>
            </select>

            <button type="submit" style="padding: 14px 24px; background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; border: none; border-radius: 12px; font-weight: 600; cursor: pointer; box-shadow: 0 4px 15px rgba(59,130,246,0.3); transition: all 0.3s;">
                Appliquer
            </button>
        </form>
    </div>

    <!-- Tableau des clients -->
    <div class="stats-grid" style="grid-template-columns: 1fr;">
        <div class="stat-card" style="padding: 0; overflow: hidden; border-radius: 16px;">
            <div style="overflow-x: auto;">
                <table style="width: 100%; min-width: 1200px;">
                    <thead>
                        <tr style="background: rgba(255,255,255,0.08);">
                            <th style="padding: 20px; text-align: left; color: #e2e8f0; font-weight: 600;">ID</th>
                            <th style="padding: 20px; text-align: left; color: #e2e8f0; font-weight: 600;">Nom</th>
                            <th style="padding: 20px; text-align: left; color: #e2e8f0; font-weight: 600;">Prénom</th>
                            <th style="padding: 20px; text-align: left; color: #e2e8f0; font-weight: 600;">Sexe</th>
                            <th style="padding: 20px; text-align: left; color: #e2e8f0; font-weight: 600;">Né(e) le</th>
                            <th style="padding: 20px; text-align: left; color: #e2e8f0; font-weight: 600;">Téléphone</th>
                            <th style="padding: 20px; text-align: left; color: #e2e8f0; font-weight: 600;">Email</th>
                            <th style="padding: 20px; text-align: left; color: #e2e8f0; font-weight: 600;">Adresse</th>
                            <th style="padding: 20px; text-align: center; color: #e2e8f0; font-weight: 600;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clients as $client)
                        <tr style="border-top: 1px solid rgba(255,255,255,0.08); transition: all 0.3s;" onmouseover="this.style.background='rgba(255,255,255,0.05)'" onmouseout="this.style.background='transparent'">
                            <td style="padding: 20px; color: #94a3b8; font-family: 'Courier New', monospace;">#{{ $client->id }}</td>
                            <td style="padding: 20px; color: white; font-weight: 600;">
                                <a href="{{ route('clients.show', $client->id) }}" style="color: white; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#fbbf24'" onmouseout="this.style.color='white'">
                                    {{ $client->nom }}
                                </a>
                            </td>
                            <td style="padding: 20px; color: white;">
                                <a href="{{ route('clients.show', $client->id) }}" style="color: white; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#fbbf24'" onmouseout="this.style.color='white'">
                                    {{ $client->prenom }}
                                </a>
                            </td>
                            <td style="padding: 20px; color: #cbd5e1;">{{ ucfirst($client->sexe) }}</td>
                            <td style="padding: 20px; color: #cbd5e1;">
                                {{ $client->date_de_naissance ? \Carbon\Carbon::parse($client->date_de_naissance)->format('d/m/Y') : '-' }}
                            </td>
                            <td style="padding: 20px; color: #cbd5e1; font-family: 'Courier New', monospace;">{{ $client->phone ?? '-' }}</td>
                            <td style="padding: 20px; color: #cbd5e1;">{{ $client->email }}</td>
                            <td style="padding: 20px; color: #94a3b8; max-width: 280px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $client->adresse }}">
                                {{ $client->adresse ?? '-' }}
                            </td>
                            <td style="padding: 20px; text-align: center;">
                                <div style="display: flex; gap: 12px; justify-content: center;">
                                    <a href="{{ route('clients.show', $client->id) }}" title="Voir la fiche">
                                        <button style="width: 42px; height: 42px; background: linear-gradient(135deg, #10b981, #059669); color: white; border: none; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(16,185,129,0.3); transition: all 0.3s;">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </a>
                                    <a href="{{ route('clients.edit', $client->id) }}" title="Modifier">
                                        <button style="width: 42px; height: 42px; background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; border: none; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(59,130,246,0.3); transition: all 0.3s;">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>
                                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display: inline;">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Supprimer définitivement ce client ?')" title="Supprimer"
                                                style="width: 42px; height: 42px; background: linear-gradient(135deg, #ef4444, #dc2626); color: white; border: none; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(239,68,68,0.3); transition: all 0.3s;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" style="padding: 80px; text-align: center; color: #64748b; font-size: 18px;">
                                Aucun client trouvé<br><br>
                                <a href="{{ route('clients.create') }}" style="color: #fbbf24; font-weight: 600;">Ajouter le premier client</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</main>

@endsection