@extends('adminlte::page')

@section('title', 'Crear Reserva')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Crear Reserva</h1>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('reservations.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="room_id">Seleccionar Sala</label>
                            <select name="room_id" id="room_id" class="form-control select2" required>
                                <option value="">Por favor, seleccione una sala</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>{{ $room->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="start_time">Seleccionar Fecha y Hora</label>
                            <input type="datetime-local" name="start_time" id="start_time" class="form-control" value="{{ old('start_time') }}" required>
                            <small class="form-text text-muted">Cada reserva tiene una duración de una hora.</small>
                        </div>
                        @include('partials.alerts')
                        <button type="submit" class="btn btn-primary">Reservar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
