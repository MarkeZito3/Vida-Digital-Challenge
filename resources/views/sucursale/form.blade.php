<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('direccion') }}
            {{ Form::text('direccion', $sucursale->direccion, ['class' => 'form-control' . ($errors->has('direccion') ? ' is-invalid' : ''), 'placeholder' => 'Direccion']) }}
            {!! $errors->first('direccion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('localidad') }}
            {{ Form::text('localidad', $sucursale->localidad, ['class' => 'form-control' . ($errors->has('localidad') ? ' is-invalid' : ''), 'placeholder' => 'Localidad']) }}
            {!! $errors->first('localidad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('telefono') }}
            {{ Form::text('telefono', $sucursale->telefono, ['class' => 'form-control' . ($errors->has('telefono') ? ' is-invalid' : ''), 'placeholder' => 'Telefono']) }}
            {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('id_empresa_sucursales') }}
            {{ 
                Form::text(
                    'id_empresa_sucursales',
                    $id_empresa,
                    [
                        'class' => 'form-control' . ($errors->has('id_empresa_sucursales') ? ' is-invalid' : ''), 
                        'placeholder' => 'Id Empresa Sucursales',
                        'disabled'
                    ]
                )}}
            {!! $errors->first('id_empresa_sucursales', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br/>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>