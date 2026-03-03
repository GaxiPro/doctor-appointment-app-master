@php
    $title = 'Soporte';
    $breadcrumbs = [
        ['name' => 'Inicio', 'href' => route('dashboard')],
        ['name' => 'Soporte', 'href' => route('admin.support.index')],
    ];
@endphp

@component('layouts.admin', ['title' => $title, 'breadcrumbs' => $breadcrumbs])
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Gestión de Tickets de Soporte</h2>
            <a href="{{ route('admin.support.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                <i class="fas fa-plus mr-2"></i> Nuevo Ticket
            </a>
        </div>

        @if ($tickets->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th class="px-6 py-3">ID</th>
                            <th class="px-6 py-3">Usuario</th>
                            <th class="px-6 py-3">Título</th>
                            <th class="px-6 py-3">Estado</th>
                            <th class="px-6 py-3">Fecha</th>
                            <th class="px-6 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $ticket)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">#{{ $ticket->id }}</td>
                                <td class="px-6 py-4">{{ $ticket->user->name }}</td>
                                <td class="px-6 py-4">{{ $ticket->title }}</td>
                                <td class="px-6 py-4">
                                    @if ($ticket->status === 'abierto')
                                        <span class="px-2 py-1 text-xs font-semibold text-white bg-yellow-500 rounded">Abierto</span>
                                    @elseif ($ticket->status === 'en progreso')
                                        <span class="px-2 py-1 text-xs font-semibold text-white bg-blue-500 rounded">En Progreso</span>
                                    @elseif ($ticket->status === 'cerrado')
                                        <span class="px-2 py-1 text-xs font-semibold text-white bg-green-500 rounded">Cerrado</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.support.show', $ticket) }}" class="inline-flex items-center px-2 py-1 bg-gray-600 hover:bg-gray-700 text-white text-xs font-semibold rounded">
                                        <i class="fas fa-eye mr-1"></i> Ver
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="mt-6">
                {{ $tickets->links() }}
            </div>
        @else
            <div class="bg-gray-50 p-8 rounded-lg text-center">
                <i class="fas fa-inbox text-gray-400 text-4xl mb-4"></i>
                <p class="text-gray-600 font-medium">No hay tickets de soporte.</p>
                <p class="text-gray-500 text-sm">Crea uno nuevo para reportar un problema.</p>
            </div>
        @endif
    </div>
@endcomponent
