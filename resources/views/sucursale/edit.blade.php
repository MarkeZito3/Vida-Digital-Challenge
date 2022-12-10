@extends('layouts.app')

@section('template_title')
    Update Sucursale
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Sucursale</span>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('sucursales.index') }}?empresa={{$sucursale->id_empresa_sucursales}}"> Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('sucursales.update', $sucursale->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('sucursale.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
