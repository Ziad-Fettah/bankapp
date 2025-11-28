@extends('layouts.app')

@section('title', 'Effectuer un Virement - Amane Bank')

@section('content')

<main class="main-content">

    <h1 class="page-title">
        Effectuer un Virement
    </h1>
    <p class="page-subtitle">Transférez de l’argent entre comptes bancaires en toute sécurité</p>

    {{-- SUCCESS --}}
    @if(session('success'))
        <div style="background: rgba(16,185,129,0.15); border-left: 4px solid #10b981; padding: 18px 24px; border-radius: 12px; color: #10b981; margin-bottom: 32px; font-weight: 500; backdrop-filter: blur(10px);">
            {{ session('success') }}
        </div>
    @endif

    {{-- ERRORS --}}
    @if($errors->any())
        <div style="background: rgba(239,68,68,0.15); border-left: 4px solid #ef4444; padding: 18px 24px; border-radius: 12px; color: #fca5a5; margin-bottom: 32px; font-weight: 500; backdrop-filter: blur(10px);">
            <strong>Erreurs détectées :</strong>
            <ul style="margin-top: 8px; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(460px, 1fr)); gap: 32px;">

        {{-- FORMULAIRE --}}
        <div class="stat-card" style="padding: 36px;">
            <form action="{{ route('transfers.store') }}" method="POST">
                @csrf

                {{-- CLIENT ÉMETTEUR --}}
                <div style="margin-bottom: 28px;">
                    <label style="display:block;color:#e2e8f0;font-weight:600;margin-bottom:12px;font-size:16px;">
                        Client émetteur
                    </label>
                    <select id="client_from"
                        style="width:100%; padding:18px 20px; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.2); border-radius:14px; color:white; font-size:16px;"
                        required>
                        <option value="">Sélectionner un client</option>
                        @foreach($clients as $cl)
                            <option value="{{ $cl->id }}">{{ $cl->nom }} {{ $cl->prenom }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- COMPTE ÉMETTEUR --}}
                <div style="margin-bottom: 28px;">
                    <label style="display:block;color:#e2e8f0;font-weight:600;margin-bottom:12px;font-size:16px;">
                        Compte source (débit)
                    </label>
                    <select name="from_account" id="account_from" required
                        style="width:100%; padding:18px 20px; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.2); border-radius:14px; color:white; font-size:16px;">
                        <option value="">Choisir un client d'abord</option>
                    </select>
                </div>

                {{-- CLIENT RÉCEPTEUR --}}
                <div style="margin-bottom: 28px;">
                    <label style="display:block;color:#e2e8f0;font-weight:600;margin-bottom:12px;font-size:16px;">
                        Client récepteur
                    </label>
                    <select id="client_to"
                        style="width:100%; padding:18px 20px; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.2); border-radius:14px; color:white; font-size:16px;"
                        required>
                        <option value="">Sélectionner un client</option>
                        @foreach($clients as $cl)
                            <option value="{{ $cl->id }}">{{ $cl->nom }} {{ $cl->prenom }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- COMPTE RÉCEPTEUR --}}
                <div style="margin-bottom: 28px;">
                    <label style="display:block;color:#e2e8f0;font-weight:600;margin-bottom:12px;font-size:16px;">
                        Compte destinataire (crédit)
                    </label>
                    <select name="to_account" id="account_to" required
                        style="width:100%; padding:18px 20px; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.2); border-radius:14px; color:white; font-size:16px;">
                        <option value="">Choisir un client d'abord</option>
                    </select>
                </div>

                {{-- MONTANT --}}
                <div style="margin-bottom: 28px;">
                    <label style="display:block;color:#e2e8f0;font-weight:600;margin-bottom:12px;font-size:16px;">
                        Montant du virement
                    </label>
                    <div style="position:relative;">
                        <input type="number" step="0.01" name="amount" value="{{ old('amount') }}" required
                               style="width:100%; padding:18px 20px 18px 60px; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.2); border-radius:14px; color:white; font-size:22px; font-weight:700;"
                               placeholder="0.00">
                        <span style="position:absolute; left:10px; top:50%; transform:translateY(-50%); color:var(--accent); font-size:19px; font-weight:700;">
                            MAD
                        </span>
                    </div>
                </div>

                {{-- DESCRIPTION --}}
                <div style="margin-bottom: 32px;">
                    <label style="display:block;color:#e2e8f0;font-weight:600;margin-bottom:12px;font-size:16px;">
                        Motif (facultatif)
                    </label>
                    <input type="text" name="description" value="{{ old('description') }}"
                           style="width:100%; padding:18px 20px; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.2); border-radius:14px; color:white; font-size:16px;"
                           placeholder="Ex : Loyer, remboursement, ...">
                </div>

                {{-- BUTTONS --}}
                <div style="display:flex; gap:16px;">
                    <button type="submit"
                            style="flex:1; padding:18px; background:linear-gradient(135deg, var(--accent), #f0c757); color:#0f172a; border:none; border-radius:14px; font-weight:700; font-size:17px; cursor:pointer; box-shadow:0 10px 30px rgba(212,175,55,0.4); transition:all 0.3s;">
                        Confirmer
                    </button>

                    <a href="{{ route('transfers.index') }}">
                        <button type="button"
                                style="flex:1; padding:18px; background:rgba(255,255,255,0.1); color:white; border:1px solid rgba(255,255,255,0.2); border-radius:14px; font-weight:600;">
                            Annuler
                        </button>
                    </a>
                </div>
            </form>
        </div>

        {{-- INFO CARD --}}
        <div class="stat-card" style="padding:36px; background:rgba(212,175,55,0.08); border:1px solid var(--accent); text-align:center;">
            <div style="margin-bottom:32px;">
                <div style="width:90px; height:90px; background:var(--accent); border-radius:50%; margin:0 auto 24px; display:flex; align-items:center; justify-content:center; font-size:20px; font-weight: 600;  color:#0f172a;">
                    Transfer
                </div>
                <h3 style="color:white; font-size:24px; margin-bottom:16px;">Virement sécurisé</h3>
                <p style="color:#cbd5e1; line-height:1.8; font-size:15px;">
                    • Vérification du solde<br>
                    • Historique complet<br>
                    • Confirmation instantanée<br>
                    • Protection anti-erreurs
                </p>
            </div>

            <div style="background:rgba(255,255,255,0.12); padding:20px; border-radius:12px;">
                <p style="color:#e2e8f0; font-size:15px;">
                    Le virement est <strong>irréversible</strong>.
                </p>
            </div>
        </div>

    </div>

</main>

<script>
const clients = @json($clients);

// FROM – client → accounts
document.getElementById('client_from').addEventListener('change', function () {
    const clientId = this.value;
    const accountSelect = document.getElementById('account_from');
    accountSelect.innerHTML = '<option value="">Sélectionner un compte</option>';

    if (!clientId) return;

    const client = clients.find(c => c.id == clientId);
    client.accounts.forEach(acc => {
        accountSelect.innerHTML += `<option value="${acc.id}">${acc.rib} — ${acc.solde} €</option>`;
    });
});

// TO – client → accounts
document.getElementById('client_to').addEventListener('change', function () {
    const clientId = this.value;
    const accountSelect = document.getElementById('account_to');
    accountSelect.innerHTML = '<option value="">Sélectionner un compte</option>';

    if (!clientId) return;

    const client = clients.find(c => c.id == clientId);
    client.accounts.forEach(acc => {
        accountSelect.innerHTML += `<option value="${acc.id}">${acc.rib} — ${acc.solde} €</option>`;
    });
});
</script>

@endsection
