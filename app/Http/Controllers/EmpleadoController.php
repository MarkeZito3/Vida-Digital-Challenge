<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Sucursale;
use App\Models\Manager;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // utilizo esto para poder autenticar el usuario



/**
 * Class EmpleadoController
 * @package App\Http\Controllers
 */
class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $empleados = Empleado::paginate();

        $id_sucursal = $request->sucursal;

        // esto es un verificador de que se está en el link empleados?sucursal=nº, ya que si no lo están lo redireccione a empresas
        $url = $_SERVER["HTTP_HOST"] . "/empleados?sucursal=" . $id_sucursal;
        $url_2 = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        if ($url_2 == $url) {
            $redirect = 'empleado.index';
            
            // esa ID, realmente existe?
            $existe_id = Sucursale::where('id','=',$id_sucursal)->get();
            if(empty($existe_id[0])){
                return redirect()->route('sucursales.index'); // si la empresa no existe te redirecciona al index de empresas
            }
        } else {
            return redirect()->route('sucursales.index');
        }

        // validador para que un usuario no pueda modificar una empresa si no le pertenece UwU

        $id_user = Auth::user()->id;
        $es_igual = false;
        $lista_managers = array();
        $prueba = Sucursale::select('id_empresa_sucursales')->where('id','=', $id_sucursal)->get();
        $manager = Manager::select('id_empresa')->where('id_user','=', $id_user)->get();;
        foreach ($prueba as $pru) {
            foreach($manager as $man){
                if($pru['id_empresa_sucursales'] == $man['id_empresa']){
                    $es_igual = true;
                }
            }
        }
        if (!$es_igual){
            return redirect()->route('empresas.index');
        }

        return view('empleado.index', compact('empleados','id_sucursal','lista_managers'))
            ->with('i', (request()->input('page', 1) - 1) * $empleados->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $empleado_select = Sucursale::pluck('direccion','id');
        $id_sucursal = $request->sucursal;
        $empleado_select = [$id_sucursal=>$empleado_select[$id_sucursal]];

        $empleado = new Empleado();
        return view('empleado.create', compact('empleado','id_sucursal','empleado_select'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Empleado::$rules);

        $empleado = Empleado::create($request->all());

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Está logeado?
        if(!Auth::check()){
            return redirect(('login'));
        }

        // el empleado existe?
        $existe_id = Empleado::where('id','=',$id)->get();
        if(empty($existe_id[0])){
            return redirect()->route('empresas.index'); // si la empresa no existe te redirecciona al index de empresas
            echo "algo XD";
        }

        // validador para que un usuario no pueda modificar una empresa si no le pertenece UwU
        $id_user = Auth::user()->id;
        $es_igual = false;
        $lista_managers = array();
        $id_sucursal = Empleado::pluck('id_sucursales_empleados','id');
        // echo $id_sucursal[$id];
        $prueba = Sucursale::select('id_empresa_sucursales')->where('id','=', $id_sucursal[$id])->get();
        $manager = Manager::select('id_empresa')->where('id_user','=', $id_user)->get();;
        foreach ($prueba as $pru) {
            foreach($manager as $man){
                if($pru['id_empresa_sucursales'] == $man['id_empresa']){
                    $es_igual = true;
                }
            }
        }
        if (!$es_igual){
            return redirect()->route('empresas.index');
            // echo "no es igual";
        }

        $empleado = Empleado::find($id);

        return view('empleado.show', compact('empleado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        // $empleado_select = Sucursale::pluck('direccion','id');
        // $id_sucursal = $request->sucursal;
        // $empleado_select = [$id_sucursal=>$empleado_select[$id_sucursal]];

        request()->validate(Empleado::$rules);

        return view('empleado.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Empleado $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {
        request()->validate(Empleado::$rules);

        $empleado->update($request->all());

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $empleado = Empleado::find($id)->delete();

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado deleted successfully');
    }
}
