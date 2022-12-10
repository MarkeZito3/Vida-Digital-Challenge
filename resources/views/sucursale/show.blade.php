@extends('layouts.app')

@section('template_title')
    {{ $sucursale->name ?? 'Show Sucursale' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Sucursale</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('sucursales.index') }}?empresa={{$sucursale->id_empresa_sucursales}}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Direccion:</strong>
                            {{ $sucursale->direccion }}
                        </div>
                        <div class="form-group">
                            <strong>Localidad:</strong>
                            {{ $sucursale->localidad }}
                        </div>
                        <div class="form-group">
                            <strong>Telefono:</strong>
                            {{ $sucursale->telefono }}
                        </div>
                        <div class="form-group">
                            <strong>Id Empresa Sucursales:</strong>
                            {{ $sucursale->id_empresa_sucursales }}
                        </div>
                        @if (Auth::check())
                        @if($lista_usuario == Auth::user()->id)
                            <br>
                            <div class="float-right">
                                <a class="btn btn-primary" href="{{ route('empleados.index') }}?sucursal={{$sucursale->id}}"> Empleados</a>
                            </div>
                        @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
