<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // utilizo esto para poder borrar los archivos inútiles de storage

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
        $empresas = Empresa::paginate();

        return view('empresa.index', compact('empresas'))
            ->with('i', (request()->input('page', 1) - 1) * $empresas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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

        // $datos["created_at"] = date();
        // $datos["updated_at"] = $request->date();
        

        Empresa::create($datos);
        
        // request()->validate(Empresa::$rules);
        // $empresa = Empresa::create($request->all());


        return redirect()->route('empresas.index')
            ->with('success', 'Empresa creada exitosamente.');
        // return response()->json($datos);
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
        $empresa = Empresa::find($id)->delete();

        return redirect()->route('empresas.index')
            ->with('success', 'Empresa deleted successfully');
    }
}
