@extends('layouts.app')

@section('template_title')
    {{ $empresa->name ?? 'Show Empresa' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Empresa</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('empresas.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $empresa->nombre }}
                        </div>
                        <br>
                        <div class="form-group">
                            <strong>Logo:</strong>
                            <img src="{{ asset('storage').'/'.$empresa->logo }}" width="100" height="100">
                        </div>
                        <br>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('sucursales.index','empresa=')}}{{$empresa->id}}"> Sucursales</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<div>
    @yield('index-content')
</div>