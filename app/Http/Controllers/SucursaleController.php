<?php

namespace App\Http\Controllers;

use App\Models\Sucursale;
use App\Models\Manager;
use App\Models\Empresa; // importo el modelo de los datos de las empresas
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // utilizo esto para poder autenticar el usuario


/**
 * Class SucursaleController
 * @package App\Http\Controllers
 */
class SucursaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sucursales = Sucursale::paginate();
        $empresa = Empresa::pluck('nombre','id'); //esta variable me sirve para los botones en el index :)

        $id_empresa = $request->empresa;
        
        // esto es un verificador de que se está en el link sucursales?empresa=nº, ya que si no lo están lo redireccione a empresas
        $url = $_SERVER["HTTP_HOST"] . "/sucursales?empresa=" . $id_empresa;
        $url_2 = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        if ($url_2 == $url) {
            $redirect = 'sucursale.index';
            
            // esa ID, realmente existe?
            $existe_id = Empresa::where('id','=',$id_empresa)->get();
            if(empty($existe_id[0])){
                return redirect()->route('empresas.index'); // si la empresa no existe te redirecciona al index de empresas
            }
        } else {
            return redirect()->route('empresas.index');
        }

        // validador para que un usuario no pueda modificar una empresa si no le pertenece UwU
        $lista_managers = array();
        if(Auth::check()){
            $prueba = Manager::select('id_empresa')->where('id_user','=',Auth::user()->id)->get();
            foreach ($prueba as $pru) {
                array_push($lista_managers,$pru['id_empresa']);
            }
        }

        

        return view($redirect, compact('sucursales','empresa','id_empresa','lista_managers'))
            ->with('i', (request()->input('page', 1) - 1) * $sucursales->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        // verifica si está logged in
        if (!Auth::check()){
            return redirect(('login'));
        }

        // validador para que un usuario no pueda modificar una empresa si no le pertenece UwU y a su vez si está logged

        $lista_managers = array();
        $prueba = Manager::select('id_empresa')->where('id_user','=',Auth::user()->id)->get();
        foreach ($prueba as $pru) {
            array_push($lista_managers,$pru['id_empresa']);
        }
        if (!in_array($request->empresa,$lista_managers)) {
            return redirect()->route('empresas.index');
        }

        $sucursale = new Sucursale();
        $empresa = Empresa::pluck('nombre','id');
        
        $id_empresa = $request->empresa;
        $empresa = [$id_empresa=>$empresa[$id_empresa]];



        return view('sucursale.create', compact('sucursale','empresa','id_empresa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Sucursale::$rules);

        $sucursale = Sucursale::create($request->all());

        return redirect()->route('empresas.index')
            ->with('success', 'Sucursale created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // $query = DB::select('select id_user, id_empresa 
        //                     from sucursales inner join managers on
        //                     sucursales.id_empresa_sucursales = managers.id_empresa
        //                     where sucursales = ?', [$id]); 
        $query = DB::table('sucursales')->select('id_user','id_empresa')
                    ->join('managers', 'sucursales.id_empresa_sucursales','=','managers.id_empresa')
                    ->where('sucursales.id', '=', $id)->get();

        $lista = array();

        foreach ($query as $row){
            foreach ($row as $row_2){
                // echo $row_2;
                array_push($lista,$row_2);
            }
        }
        $lista_usuario = $lista[0];
        $sucursale = Sucursale::find($id);

        return view('sucursale.show', compact('sucursale','lista_usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {

        // verifica si está logged in
        if (!Auth::check()){
            return redirect(('login'));
        }
        //verifica si la sucursal le pertenece UwU
        $lista_managers = array();
        $prueba = Manager::select('id_empresa')->where('id_user','=',Auth::user()->id)->get();
        foreach ($prueba as $pru) {
            array_push($lista_managers,$pru['id_empresa']);
        }
        if (!in_array($request->empresa,$lista_managers)){
            return redirect()->route('empresas.index');
        } 

        $sucursale = Sucursale::find($id);
        $empresa = Empresa::pluck('nombre','id');
        
        $id_empresa = $request->empresa;
        $empresa = [$id_empresa=>$empresa[$id_empresa]];

        return view('sucursale.edit', compact('sucursale','empresa','id_empresa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Sucursale $sucursale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sucursale $sucursale)
    {
        request()->validate(Sucursale::$rules);

        $id_empresa = $request->empresa;

        $sucursale->update($request->all());

        return redirect()->route('empresas.index')
            ->with('success', 'Sucursale updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $sucursale = Sucursale::find($id)->delete();

        return redirect()->route('sucursales.index')
            ->with('success', 'Sucursale deleted successfully');
    }
}
