<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $reservations = Auth::user()
            ->reservations()
            ->with('room')
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $rooms = Room::all();

        return view('reservations.create', compact('rooms'));
    }

    public function store(StoreReservationRequest $request)
    {
        Auth::user()->reservations()->create([
            'room_id' => $request->room_id,
            'start_time' => $request->start_time,
            'status' => 'Pendiente',
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reserva creada correctamente');
    }
}
