@extends('adminlte::page')

@section('title', 'Crear Sala')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Crear Sala</h1>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.rooms.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nombre de la Sala</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción (opcional)</label>
                            <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                        </div>
                        @include('partials.alerts')
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
