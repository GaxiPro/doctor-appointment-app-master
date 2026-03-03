@php
    $title = 'Ver Ticket de Soporte';
    $breadcrumbs = [
        ['name' => 'Inicio', 'href' => route('dashboard')],
        ['name' => 'Soporte', 'href' => route('admin.support.index')],
        ['name' => 'Ticket #' . $supportTicket->id],
    ];
@endphp

@component('layouts.admin', ['title' => $title, 'breadcrumbs' => $breadcrumbs])
    <div class="bg-white p-6 rounded-lg shadow max-w-3xl">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">#{{ $supportTicket->id }} - {{ $supportTicket->title }}</h2>
                <p class="text-gray-600 text-sm mt-1">Creado por: <strong>{{ $supportTicket->user?->name ?? 'Usuario desconocido' }}</strong></p>
            </div>
            <div class="text-right">
                @if ($supportTicket->status === 'abierto')
                    <span class="px-3 py-1 text-sm font-semibold text-white bg-yellow-500 rounded">Abierto</span>
                @elseif ($supportTicket->status === 'en progreso')
                    <span class="px-3 py-1 text-sm font-semibold text-white bg-blue-500 rounded">En Progreso</span>
                @elseif ($supportTicket->status === 'cerrado')
                    <span class="px-3 py-1 text-sm font-semibold text-white bg-green-500 rounded">Cerrado</span>
                @endif
            </div>
        </div>

        <hr class="my-6">

        {{-- Información del Ticket --}}
        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <p class="text-sm text-gray-600">Fecha de Creación</p>
                <p class="text-lg font-semibold text-gray-800">{{ $supportTicket->created_at?->format('d/m/Y H:i') ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Última Actualización</p>
                <p class="text-lg font-semibold text-gray-800">{{ $supportTicket->updated_at?->format('d/m/Y H:i') ?? 'N/A' }}</p>
            </div>
        </div>

        {{-- Descripción del Problema --}}
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-3">Descripción del Problema</h3>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <p class="text-gray-700 whitespace-pre-wrap">{{ $supportTicket->description }}</p>
            </div>
        </div>

        {{-- Botones de Acción --}}
        <div class="flex justify-between items-center">
            <a href="{{ route('admin.support.index') }}" class="inline-flex items-center px-4 py-2 text-gray-700 bg-gray-200 hover:bg-gray-300 font-semibold rounded-lg transition">
                <i class="fas fa-arrow-left mr-2"></i> Volver
            </a>
        </div>
    </div>
@endcomponent
