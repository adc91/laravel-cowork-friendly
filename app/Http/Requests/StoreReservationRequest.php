<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use App\Models\Reservation;
use Carbon\Carbon;

class StoreReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'room_id' => 'required|exists:rooms,id',
            'start_time' => 'required|date|after:now',
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $room_id = $this->room_id;
            $start_time = Carbon::parse($this->start_time);
            $end_time = $start_time->copy()->addHour();

            $conflict = Reservation::where('room_id', $room_id)
                ->where('status', '!=', 'Rechazado')
                ->where(function ($query) use ($start_time, $end_time) {
                    $query->whereBetween('start_time', [$start_time, $end_time->subSecond()])
                        ->orWhereBetween('start_time', [$start_time->copy()->subHour(), $end_time]);
                })
                ->exists();

            if ($conflict) {
                $validator->errors()->add('start_time', 'La sala ya está reservada en este horario.');
            }
        });
    }
}
