@php
    $title = 'Crear Ticket de Soporte';
    $breadcrumbs = [
        ['name' => 'Inicio', 'href' => route('dashboard')],
        ['name' => 'Soporte', 'href' => route('admin.support.index')],
        ['name' => 'Crear Ticket'],
    ];
@endphp

@component('layouts.admin', ['title' => $title, 'breadcrumbs' => $breadcrumbs])
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800">Crear Nuevo Ticket</h2>

        <form action="{{ route('admin.support.store') }}" method="POST" class="space-y-6 max-w-2xl">
            @csrf

            {{-- Título del Ticket --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Título del Problema *</label>
                <input 
                    type="text"
                    name="title" 
                    placeholder="Describe brevemente tu problema"
                    value="{{ old('title') }}"
                    maxlength="255"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                    required
                />
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Descripción Detallada --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Descripción Detallada *</label>
                <textarea 
                    name="description" 
                    rows="6"
                    placeholder="Proporciona todos los detalles sobre tu problema. Nuestro equipo de soporte se pondrá en contacto contigo."
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                    required
                >{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Información de Ayuda --}}
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4">
                <p class="text-sm text-blue-700">
                    <i class="fas fa-info-circle mr-2"></i>
                    <strong>Nota:</strong> Tu ticket será creado con estado "Abierto" y nuestro equipo de soporte se pondrá en contacto pronto.
                </p>
            </div>

            {{-- Botones de Acción --}}
            <div class="flex justify-end gap-4">
                <a href="{{ route('admin.support.index') }}" class="px-4 py-2 text-gray-700 bg-gray-200 hover:bg-gray-300 font-semibold rounded-lg transition">
                    Cancelar
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                    <i class="fas fa-paper-plane mr-2"></i> Enviar Ticket
                </button>
            </div>
        </form>
    </div>
@endcomponent
