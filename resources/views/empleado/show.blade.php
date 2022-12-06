@extends('layouts.app')

@section('template_title')
    {{ $empleado->name ?? 'Show Empleado' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Empleado</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('empleados.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $empleado->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Apellido:</strong>
                            {{ $empleado->apellido }}
                        </div>
                        <div class="form-group">
                            <strong>Dni:</strong>
                            {{ $empleado->dni }}
                        </div>
                        <div class="form-group">
                            <strong>Telefono:</strong>
                            {{ $empleado->telefono }}
                        </div>
                        <div class="form-group">
                            <strong>Domicilio:</strong>
                            {{ $empleado->domicilio }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $empleado->email }}
                        </div>
                        <div class="form-group">
                            <strong>Cargos:</strong>
                            {{ $empleado->cargos }}
                        </div>
                        <div class="form-group">
                            <strong>Id Sucursales Empleados:</strong>
                            {{ $empleado->id_sucursales_empleados }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
