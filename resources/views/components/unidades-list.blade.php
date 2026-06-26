@props([
    'unidades'
])

@php
// Calcular contadores síncronos en servidor para la carga inicial (sin queries extra de base de datos)
$unidadesColl = collect($unidades);
$totalCount = $unidadesColl->count();
$pendientesCount = $unidadesColl->where('status', 'pendientes')->count();
$alDiaCount = $unidadesColl->where('status', 'al_dia')->count();
$sinActividadesCount = $unidadesColl->where('status', 'sin_actividades')->count();
@endphp

<div x-data="{ 
    search: '', 
    currentFilter: 'all',
    matchesFuzzy(name, status) {
        // Normalización Fuzzy: Eliminar acentos y mayúsculas
        const query = this.search.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '');
        const normName = name.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '');
        const matchText = normName.includes(query);
        
        if (!matchText) return false;
        if (this.currentFilter === 'all') return true;
        return status === this.currentFilter;
    }
}" style="width: 100%;">

    <!-- Barra de Búsqueda Fuzzy e Input Reactivo -->
    <div style="display: flex; justify-content: space-between; align-items: center; gap: 15px; margin-bottom: 25px; flex-wrap: wrap;">
        <div style="flex: 1; min-width: 280px;">
            <input type="text" 
                   x-model="search" 
                   class="form-input-control-caj" 
                   placeholder="🔍 Buscar unidad (coincidencia aproximada en memoria instantánea)..." 
                   style="width: 100%; height: 42px; border-radius: 8px; border: 1px solid #cbd5e1; padding: 0 16px; font-size: 0.9rem;">
        </div>

        <!-- Botonera de Filtros con Contadores Instantáneos en Frontend -->
        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
            <button type="button" 
                    @click="currentFilter = 'all'" 
                    :style="currentFilter === 'all' ? 'background-color: #0F69C4; color: #ffffff;' : 'background-color: #f8fafc; color: #475569; border: 1px solid #cbd5e1;'"
                    style="border: none; padding: 8px 14px; border-radius: 6px; font-weight: 700; cursor: pointer; font-size: 0.8rem; height: 42px; transition: all 0.15s ease;">
                Todos ({{ $totalCount }})
            </button>
            <button type="button" 
                    @click="currentFilter = 'pendientes'" 
                    :style="currentFilter === 'pendientes' ? 'background-color: #ef3340; color: #ffffff;' : 'background-color: #f8fafc; color: #475569; border: 1px solid #cbd5e1;'"
                    style="border: none; padding: 8px 14px; border-radius: 6px; font-weight: 700; cursor: pointer; font-size: 0.8rem; height: 42px; transition: all 0.15s ease;">
                Pendientes ({{ $pendientesCount }})
            </button>
            <button type="button" 
                    @click="currentFilter = 'al_dia'" 
                    :style="currentFilter === 'al_dia' ? 'background-color: #2b8a3e; color: #ffffff;' : 'background-color: #f8fafc; color: #475569; border: 1px solid #cbd5e1;'"
                    style="border: none; padding: 8px 14px; border-radius: 6px; font-weight: 700; cursor: pointer; font-size: 0.8rem; height: 42px; transition: all 0.15s ease;">
                Al día ({{ $alDiaCount }})
            </button>
            <button type="button" 
                    @click="currentFilter = 'sin_actividades'" 
                    :style="currentFilter === 'sin_actividades' ? 'background-color: #64748b; color: #ffffff;' : 'background-color: #f8fafc; color: #475569; border: 1px solid #cbd5e1;'"
                    style="border: none; padding: 8px 14px; border-radius: 6px; font-weight: 700; cursor: pointer; font-size: 0.8rem; height: 42px; transition: all 0.15s ease;">
                Sin actividades ({{ $sinActividadesCount }})
            </button>
        </div>
    </div>

    <!-- Catálogo de Unidades Normalizado -->
    <div style="overflow-x: auto; background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px;">
        <table class="table-custom-data" style="width: 100%; border-collapse: collapse; min-width: 700px;">
            <thead>
                <tr>
                    <th style="padding: 12px 16px; background-color: #f1f5f9; text-align: left; font-size: 0.8rem; font-weight: 700; color: #475569;">Unidad</th>
                    <th style="padding: 12px 16px; background-color: #f1f5f9; text-align: center; font-size: 0.8rem; font-weight: 700; color: #475569; width: 120px;">Pendientes</th>
                    <th style="padding: 12px 16px; background-color: #f1f5f9; text-align: center; font-size: 0.8rem; font-weight: 700; color: #475569; width: 120px;">Verificadas</th>
                    <th style="padding: 12px 16px; background-color: #f1f5f9; text-align: right; font-size: 0.8rem; font-weight: 700; color: #475569; width: 180px;">Progreso</th>
                    <th style="padding: 12px 16px; background-color: #f1f5f9; text-align: right; font-size: 0.8rem; font-weight: 700; color: #475569; width: 160px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($unidades as $stat)
                    <tr x-show="matchesFuzzy('{{ $stat['nombre'] }}', '{{ $stat['status'] }}')" 
                        style="border-bottom: 1px solid #e2e8f0; transition: all 0.1s ease;"
                        x-cloak>
                        <td style="padding: 14px 16px; font-weight: 700; color: #0F69C4; font-size: 0.9rem;">
                            {{ $stat['nombre'] }}
                            <span style="display: block; font-size: 0.75rem; color: #64748b; font-weight: normal; margin-top: 2px;">{{ $stat['email'] }}</span>
                        </td>
                        <td style="padding: 14px 16px; font-size: 0.85rem; color: #ef3340; text-align: center; font-weight: 600;">{{ $stat['cargadas'] }}</td>
                        <td style="padding: 14px 16px; font-size: 0.85rem; color: #2b8a3e; text-align: center; font-weight: 600;">{{ $stat['verificadas'] }}</td>
                        <td style="padding: 14px 16px; text-align: right;">
                            @if($stat['status'] === 'sin_actividades')
                                <span style="font-size: 0.8rem; font-weight: 600; color: #64748b; font-style: italic;">Sin actividades asignadas</span>
                            @else
                                <div style="display: flex; align-items: center; justify-content: flex-end; gap: 10px;">
                                    <span style="font-size: 0.8rem; font-weight: 700; color: #0d1b2a;">{{ $stat['avance'] }}%</span>
                                    <div style="width: 80px; height: 8px; background-color: #e2e8f0; border-radius: 4px; overflow: hidden; display: inline-block;">
                                        <div style="width: {{ $stat['avance'] }}%; height: 100%; background-color: #2b8a3e;"></div>
                                    </div>
                                </div>
                            @endif
                        </td>
                        <td style="padding: 14px 16px; text-align: right;">
                            <a href="{{ route('actividades.historial', ['uf' => $stat['id']]) }}" 
                               class="btn-acc" 
                               style="padding: 6px 12px; font-size: 0.8rem; font-weight: 700; text-decoration: none; border-color: #0F69C4; color: #0F69C4 !important; background-color: rgba(15, 105, 196, 0.02); border-radius: 4px; display: inline-block; text-align: center;">
                                Historial
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>