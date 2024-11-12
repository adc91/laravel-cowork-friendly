@extends('adminlte::page')

@section('title', 'Editar Sala')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Editar Sala</h1>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.rooms.update', $room) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nombre de la Sala</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $room->name) }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Descripción (opcional)</label>
                    <textarea class="form-control" id="description" name="description">{{ old('description', $room->description) }}</textarea>
                </div>
                @include('partials.alerts')
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
        </div>
    </div>
@stop
