<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function edit(Ticket $ticket)
    {
        return view('tickets.edit', compact('ticket'));
    }
    public function update(Request $request, Ticket $ticket)
    {
        $data = $request->validate([
            'company' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'footer' => 'required | max:500',
        ]);
        $ticket->update($data);
        return response()->json([], 200);
    }
}
