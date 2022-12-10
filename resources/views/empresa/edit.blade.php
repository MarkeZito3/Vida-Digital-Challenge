@extends('layouts.app')
@section('template_title')
    Editar Empresa
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div class="float-left">
                                <a class="btn btn-primary" href="{{ route('empresas.index') }}"> Back</a>
                            </div>
                            <span class="card-title">Editar Empresa</span>
                            <div class="float-right"></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('empresas.update', $empresa->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            <td><img src="{{ asset('storage').'/'.$empresa->logo }}" width="100" height="100"></td>
                            @csrf

                            @include('empresa.form')


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
