@extends('layouts.app')

@section('template_title')
    {{ $manager->name ?? 'Show Manager' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Manager</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('managers.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id User:</strong>
                            {{ $manager->id_user }}
                        </div>
                        <div class="form-group">
                            <strong>Id Empresa:</strong>
                            {{ $manager->id_empresa }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
