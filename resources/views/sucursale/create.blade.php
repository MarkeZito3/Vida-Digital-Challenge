@extends('layouts.app')

@section('template_title')
    Create Sucursale
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Sucursale</span>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('sucursales.index') }}?empresa={{$id_empresa}}"> Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('sucursales.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('sucursale.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
