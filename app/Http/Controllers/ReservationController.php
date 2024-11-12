<?php

namespace App\Http\Controllers;

use App\Http\Requests\Reservation\ReservationStoreRequest;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        return view('reservation.index', [
            'rooms' => Room::with('reservations')->get(),
        ]);
    }
    public function historic(Request $request)
    {
        $role = auth()->user()->getRoleNames()->first(); 
        $query = Reservation::with(['room', 'user', 'state']);

        if ($request->filled('state')) {
            $query->where('state_id', $request->state);
        }

        if ($request->filled('room')) {
            $query->where('room_id', $request->room);
        }

        if($role == 'client'){
            $query->where('user_id',auth()->id());
        }

        $reservations = $query->orderBy('state_id', 'asc')->orderBy('reservation_date', 'desc')->paginate(15);

        $states = State::all();
        $rooms = Room::all();

        return view('reservation.historic', compact('reservations', 'states', 'rooms'));
    }
    public function reservations($id, Request $request)
    {
        $room = Room::find($id);
        $selectedDate = $request->input('calendar', date('Y-m-d'));
        $startTime = Carbon::createFromTime(8, 0);
        $endTime = Carbon::createFromTime(17, 0);

        // Genera el array de horas disponibles
        $timeSlots = [];
        while ($startTime->lte($endTime)) {
            $timeSlots[] = $startTime->format('H:i');
            $startTime->addHour();
        }

        // Obtiene las horas reservadas para la fecha y sala actuales
        $reservedTimes = Reservation::where('reservation_date', $selectedDate)
            ->where('room_id', $room->id)
            ->whereIn('state_id', [1, 2])
            ->pluck('reservation_time')
            ->map(function ($time) {
                return Carbon::parse($time)->format('H:i');
            })
            ->toArray();

        return view('reservation.showRoomReservation', compact('room', 'timeSlots', 'reservedTimes', 'selectedDate'));
    }

    public function store(ReservationStoreRequest $request)
    {
        $validatedData = $request->validated();

        $existingReservation = Reservation::where('room_id', $validatedData['room_id'])
            ->where('reservation_date', $validatedData['reservation_date'])
            ->where('reservation_time', $validatedData['reservation_time'])
            ->whereIn('state_id', [1, 2])
            ->exists();

        if ($existingReservation) {
            return redirect()->back()->withErrors(['error' => 'Este horario ya está reservado.']);
        }

        Reservation::create([
            'user_id' => auth()->id(),
            'room_id' => $validatedData['room_id'],
            'reservation_date' => $validatedData['reservation_date'],
            'reservation_time' => $validatedData['reservation_time'],
            'state_id' => 1, // Estado pendiente
        ]);

        return redirect()->route('rooms.reservations', $request->room_id)->with('status', 'Reserva realizada exitosamente.');
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'new_state' => 'required|in:accepted,rejected',
        ]);

        $reservation = Reservation::find($request->reservation_id);

        $stateMapping = [
            'accepted' => 2,  
            'rejected' => 3,  
        ];
        
        $reservation->state_id = $stateMapping[$request->new_state];
        $reservation->save();

        return redirect()->route('reservations.historic')->with('status', 'Estado de la reserva actualizado exitosamente.');
    }
}
