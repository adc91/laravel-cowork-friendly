<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateReservationStatusRequest;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rooms = Room::all();

        $reservations = Reservation::
            when($request->room_id, function ($query, $room_id) {
                return $query->where('room_id', $room_id);
            })
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('admin.reservations.index', compact('reservations', 'rooms'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        return view('admin.reservations.edit', compact('reservation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationStatusRequest $request, Reservation $reservation)
    {
        $reservation->update($request->validated());

        return redirect()->route('admin.reservations.index')->with('success', 'Reserva actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('admin.reservations.index')->with('success', 'Reserva eliminada correctamente');
    }
}
