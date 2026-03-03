<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    /**
     * Mostrar un listado de todos los tickets de soporte
     */
    public function index()
    {
        $tickets = SupportTicket::with('user')->latest()->paginate(15);
        return view('admin.support.index', compact('tickets'));
    }

    /**
     * Mostrar el formulario para crear un nuevo ticket
     */
    public function create()
    {
        $breadcrumbs = [
            ['name' => 'Soporte', 'href' => route('admin.support.index')],
            ['name' => 'Crear Ticket']
        ];
        return view('admin.support.create', compact('breadcrumbs'));
    }

    /**
     * Guardar un nuevo ticket en la base de datos
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'min:5',
                'max:255'
            ],
            'description' => [
                'required',
                'string',
                'min:10',
                'max:5000'
            ]
        ], [
            'title.required' => 'El título es obligatorio',
            'title.min' => 'El título debe tener al menos 5 caracteres',
            'description.required' => 'La descripción es obligatoria',
            'description.min' => 'La descripción debe tener al menos 10 caracteres'
        ]);

        // Crear el ticket con el usuario autenticado y estado abierto
        SupportTicket::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'status' => 'abierto'
        ]);

        return redirect()
            ->route('admin.support.index')
            ->with('success', 'Ticket creado exitosamente');
    }

    /**
     * Mostrar los detalles de un ticket específico
     */
    public function show(SupportTicket $supportTicket)
    {
        // Cargar la relación del usuario
        $supportTicket->load('user');
        
        $breadcrumbs = [
            ['name' => 'Soporte', 'href' => route('admin.support.index')],
            ['name' => 'Ver Ticket']
        ];
        return view('admin.support.show', compact('supportTicket', 'breadcrumbs'));
    }
}
