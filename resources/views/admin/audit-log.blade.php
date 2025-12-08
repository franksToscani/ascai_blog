@extends('layouts.app')

@section('title', 'Audit Log - Admin')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold mb-2">Registro di audit</h1>
        <p class="text-sm text-slate-600">Tutte le modifiche ai dati dell'associazione</p>
    </div>

    {{-- FILTRI --}}
    <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
        <form method="GET" action="{{ route('admin.audit-log') }}" class="grid md:grid-cols-5 gap-3">
            {{-- Filtro Modello --}}
            <div>
                <label class="block text-xs font-medium text-slate-700 mb-1">Tipo di dato</label>
                <select name="model" class="w-full border border-slate-300 rounded px-2 py-1 text-sm">
                    <option value="">Tutti</option>
                    @foreach($models as $model)
                        @php
                            $modelName = class_basename($model);
                            $labels = [
                                'Post' => 'Post/News',
                                'Event' => 'Eventi',
                                'GalleryPhoto' => 'Galleria',
                            ];
                        @endphp
                        <option value="{{ $model }}" @selected(request('model') === $model)>
                            {{ $labels[$modelName] ?? $modelName }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Filtro Azione --}}
            <div>
                <label class="block text-xs font-medium text-slate-700 mb-1">Azione</label>
                <select name="action" class="w-full border border-slate-300 rounded px-2 py-1 text-sm">
                    <option value="">Tutte</option>
                    @foreach($actions as $action)
                        <option value="{{ $action }}" @selected(request('action') === $action)>
                            {{ ucfirst($action) }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Filtro Utente --}}
            <div>
                <label class="block text-xs font-medium text-slate-700 mb-1">Utente</label>
                <select name="user_id" class="w-full border border-slate-300 rounded px-2 py-1 text-sm">
                    <option value="">Tutti</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" @selected(request('user_id') == $user->id)>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Data da --}}
            <div>
                <label class="block text-xs font-medium text-slate-700 mb-1">Da</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}"
                    class="w-full border border-slate-300 rounded px-2 py-1 text-sm">
            </div>

            {{-- Data a --}}
            <div>
                <label class="block text-xs font-medium text-slate-700 mb-1">A</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}"
                    class="w-full border border-slate-300 rounded px-2 py-1 text-sm">
            </div>

            {{-- Pulsanti --}}
            <div class="flex gap-2 items-end">
                <button type="submit" class="flex-1 bg-sky-700 text-white px-3 py-1 rounded text-sm font-semibold">
                    Filtra
                </button>
                <a href="{{ route('admin.audit-log') }}" class="flex-1 bg-slate-300 text-slate-800 px-3 py-1 rounded text-sm text-center">
                    Reset
                </a>
            </div>
        </form>
    </div>

    {{-- LOG TABLE --}}
    @if($logs->isEmpty())
        <div class="bg-white rounded-lg shadow-sm p-6 text-center text-slate-600">
            Nessun evento di audit trovato.
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-slate-100 border-b">
                    <tr>
                        <th class="px-4 py-2 text-left">Data/Ora</th>
                        <th class="px-4 py-2 text-left">Azione</th>
                        <th class="px-4 py-2 text-left">Tipo</th>
                        <th class="px-4 py-2 text-left">Utente</th>
                        <th class="px-4 py-2 text-left">IP</th>
                        <th class="px-4 py-2 text-center">Dettagli</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                        <tr class="border-b last:border-0 hover:bg-slate-50">
                            <td class="px-4 py-2 whitespace-nowrap text-xs text-slate-600">
                                {{ $log->created_at->format('d/m/Y H:i:s') }}
                            </td>
                            <td class="px-4 py-2">
                                @php
                                    $colors = [
                                        'created' => 'bg-green-100 text-green-800',
                                        'updated' => 'bg-blue-100 text-blue-800',
                                        'deleted' => 'bg-red-100 text-red-800',
                                        'restored' => 'bg-amber-100 text-amber-800',
                                    ];
                                @endphp
                                <span class="px-2 py-1 rounded text-xs font-semibold {{ $colors[$log->action] ?? 'bg-slate-100' }}">
                                    {{ ucfirst($log->action) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-xs">
                                @php
                                    $labels = [
                                        'App\Models\Post' => 'Post',
                                        'App\Models\Event' => 'Evento',
                                        'App\Models\GalleryPhoto' => 'Foto',
                                    ];
                                @endphp
                                <span class="font-medium">
                                    {{ $labels[$log->model_type] ?? class_basename($log->model_type) }}
                                </span>
                                <span class="text-slate-500">#{{ $log->model_id }}</span>
                            </td>
                            <td class="px-4 py-2 text-sm">
                                @if($log->user)
                                    {{ $log->user->name }}
                                @else
                                    <span class="text-slate-400">Sistema</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-xs text-slate-500">
                                {{ $log->ip_address ?? '-' }}
                            </td>
                            <td class="px-4 py-2 text-center">
                                @if($log->old_values || $log->new_values)
                                    <button type="button"
                                        onclick="toggleDetails({{ $log->id }})"
                                        class="text-sky-700 hover:underline text-xs font-semibold">
                                        Mostra
                                    </button>
                                @else
                                    <span class="text-slate-400">-</span>
                                @endif
                            </td>
                        </tr>

                        {{-- Row dettagli (nascosto) --}}
                        @if($log->old_values || $log->new_values)
                            <tr id="details-{{ $log->id }}" class="hidden bg-slate-50 border-b">
                                <td colspan="6" class="px-4 py-3">
                                    <div class="grid md:grid-cols-2 gap-4 text-xs">
                                        @if($log->old_values)
                                            <div>
                                                <p class="font-semibold text-slate-700 mb-2">Valore precedente:</p>
                                                <div class="bg-white p-2 rounded border border-slate-200 max-h-40 overflow-auto">
                                                    @foreach($log->old_values as $key => $value)
                                                        <div class="py-1">
                                                            <span class="text-slate-600">{{ $key }}:</span>
                                                            <br>
                                                            <code class="text-red-600 break-words">
                                                                {{ is_array($value) ? json_encode($value) : $value }}
                                                            </code>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                        @if($log->new_values)
                                            <div>
                                                <p class="font-semibold text-slate-700 mb-2">Nuovo valore:</p>
                                                <div class="bg-white p-2 rounded border border-slate-200 max-h-40 overflow-auto">
                                                    @foreach($log->new_values as $key => $value)
                                                        <div class="py-1">
                                                            <span class="text-slate-600">{{ $key }}:</span>
                                                            <br>
                                                            <code class="text-green-600 break-words">
                                                                {{ is_array($value) ? json_encode($value) : $value }}
                                                            </code>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Paginazione --}}
        <div class="mt-6">
            {{ $logs->links() }}
        </div>
    @endif

    <script>
        function toggleDetails(id) {
            const details = document.getElementById('details-' + id);
            if (details) {
                details.classList.toggle('hidden');
            }
        }
    </script>
@endsection
