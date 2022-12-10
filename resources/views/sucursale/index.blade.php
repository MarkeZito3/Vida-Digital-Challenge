@extends('layouts.app')

@section('template_title')
    Sucursale
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <div class="float-right">
                                <a class="btn btn-primary" href="{{ route('empresas.show','/') }}/{{$id_empresa}}"> Back</a>
                            </div>

                            <span id="card_title">
                                {{ __('Sucursale') }}
                            </span>
                            @if(in_array($id_empresa,$lista_managers))
                                <div class="float-right">
                                    <a href="{{ route('sucursales.create','empresa=') }}{{$id_empresa}}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                    {{ __('Create New') }}
                                    </a>
                                </div>
                            @else
                                <div></div>
                            @endif
                            </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        
										<th>Direccion</th>
										<th>Localidad</th>
										<th>Telefono</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sucursales as $sucursale)
                                    @if ($sucursale->id_empresa_sucursales == $id_empresa)
                                        <!-- {{ $empresa }} -->
                                        <tr>
                                            
											<td>{{ $sucursale->direccion }}</td>
											<td>{{ $sucursale->localidad }}</td>
											<td>{{ $sucursale->telefono }}</td>

                                            <td>
                                                <form action="{{ route('sucursales.destroy',$sucursale->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('sucursales.show',$sucursale->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    @if(in_array($id_empresa,$lista_managers))
                                                        <a class="btn btn-sm btn-success" href="{{ route('sucursales.edit',$sucursale->id) }}/?empresa={{$id_empresa}}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que quieres borrar?')"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $sucursales->links() !!}
            </div>
        </div>
    </div>
@endsection
