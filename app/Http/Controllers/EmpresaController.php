<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // utilizo esto para poder borrar los archivos inútiles de storage
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // utilizo esto para poder autenticar el usuario


/**
 * Class EmpresaController
 * @package App\Http\Controllers
 */
class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // validador para que un usuario no pueda modificar una empresa si no le pertenece UwU y a su vez si está logged
        $lista_managers = array();
        if (Auth::check()) {
            $prueba = Manager::select('id_empresa')->where('id_user','=',Auth::user()->id)->get();
            foreach ($prueba as $pru) {
                array_push($lista_managers,$pru['id_empresa']);
            }
        }

        $empresas = Empresa::paginate();

        return view('empresa.index', compact('empresas','lista_managers'))
            ->with('i', (request()->input('page', 1) - 1) * $empresas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        // autenticación del login
        if (!Auth::check()){
            return redirect( __('login'));
        }
        $empresa = new Empresa();

        return view('empresa.create', compact('empresa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = request()->validate(Empresa::$rules);

        if($request->hasFile('logo')){
            $datos['logo'] = $request->file('logo')->store('uploads','public');
        }

        Empresa::create($datos);
        
        $empresa_id = DB::table('empresas')->where('logo','=',$datos['logo'])->where('nombre','=',$datos['nombre'])->get();
        $usuario_id = Auth::user()->id;
        $manager_create = array($usuario_id,$empresa_id[0]->id);
        // Manager::create($manager_create);
        DB::insert('insert into managers (id_user,id_empresa) values (?, ?)', [$usuario_id, $empresa_id[0]->id]);
        

        return redirect()->route('empresas.index')
            ->with('success', 'Empresa creada exitosamente. ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // esa ID, realmente existe?
        $existe_id = Empresa::where('id','=',$id)->get();
        if(empty($existe_id[0])){
            return redirect()->route('empresas.index');
        }

        $empresa = Empresa::find($id);

        return view('empresa.show', compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        // validador para que un usuario no pueda modificar una empresa si no le pertenece UwU y a su vez si está logged
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $lista_managers = array();
        $prueba = Manager::select('id_empresa')->where('id_user','=',Auth::user()->id)->get();
        foreach ($prueba as $pru) {
            array_push($lista_managers,$pru['id_empresa']);
        }
        if (!in_array($id,$lista_managers)) {
            return redirect()->route('empresas.index');
        }

        $empresa = Empresa::find($id);

        return view('empresa.edit', compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Empresa $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // request()->validate(Empresa::$rules);
        $datos = request()->except(['_token', '_method']);

        if($request->hasFile('logo')){
            $empresa = Empresa::findOrFail($id);
            Storage::delete('public/'.$empresa->logo);
            $datos['logo'] = $request->file('logo')->store('uploads','public');
        }

        Empresa::where('id','=',$id)->update($datos);

        $empresa = Empresa::findOrFail($id);

        // return view('empresa.edit', compact('empresa'))->with('success', 'Empresa updated successfully');
        return redirect()->route('empresas.index')
            ->with('success', 'se actualizó la empresa exitosamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $empresa_logo = Empresa::findOrFail($id);
        Storage::delete('public/'.$empresa_logo->logo);
        $empresa = Empresa::find($id)->delete();

        return redirect()->route('empresas.index')
            ->with('success', 'Empresa deleted successfully');
    }
}
