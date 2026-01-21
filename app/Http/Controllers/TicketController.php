<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function edit(Ticket $ticket)
    {
        $this->authorize('update', $ticket);
        return view('tickets.edit', compact('ticket'));
    }
    public function update(Request $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);
        $data = $request->validate([
            'company' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'whatsapp' => 'required',
            'footer' => 'required | max:500',
        ], [
            'company.required' => 'La compañia es requerida.',
            'address.required' => 'La dirección es requerida.',
            'phone_number.rquired' => 'El número de télefono es requerido.',
            'footer.required' => 'El pie de página es requerido.',
            'footer.max' => 'El máximo de caracteres del pie de página son 500.',
            'city.required' => 'La ciudad es requerida.',
            'postal_code.required' => 'El codigo postal es requiredo.',
            'whatsapp' => 'El whatsapp es requerido.'
        ]);
        $ticket->update($data);
        return response()->json([], 200);
    }
}
