<?php

namespace App\Http\Controllers;

use App\Models\Sucursale;
use App\Models\Empresa; // importo el modelo de los datos de las empresas
use Illuminate\Http\Request;

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
        $empresa = Empresa::pluck('nombre','id','logo'); //agrego los datos de las empresas por las dudas xd

        $id_empresa = $request->empresa;

        return view('sucursale.index', compact('sucursales','empresa','id_empresa'))
            ->with('i', (request()->input('page', 1) - 1) * $sucursales->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $sucursale = new Sucursale();
        $empresa = Empresa::pluck('nombre','id','logo');
        
        $id_empresa = $request->empresa;
        echo $id_empresa;

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

        return redirect()->route('sucursales.index')
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
        $sucursale = Sucursale::find($id);
        $empresa = Empresa::pluck('nombre','id','logo');

        return view('sucursale.show', compact('sucursale','empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $sucursale = Sucursale::find($id);
        $empresa = Empresa::pluck('nombre','id','logo');

        $id_empresa = $request->empresa;
        echo $id_empresa;

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

        return redirect()->route('sucursales.index')
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
