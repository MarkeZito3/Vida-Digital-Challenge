<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Illuminate\Http\Request;
use App\Models\Empresa; // importo el modelo de los datos de las empresas
use App\Models\User; // importo el modelo de los datos de los usuarios
use Illuminate\Support\Facades\DB;


/**
 * Class ManagerController
 * @package App\Http\Controllers
 */
class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $managers = Manager::paginate();

        return view('manager.index', compact('managers'))
            ->with('i', (request()->input('page', 1) - 1) * $managers->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $empresa = Empresa::pluck('nombre','id');
        $user = User::pluck('name','id');

        $manager = new Manager();
        return view('manager.create', compact('manager','user','empresa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Manager::$rules);

        $manager = Manager::create($request->all());

        return redirect()->route('managers.index')
            ->with('success', 'Manager created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $manager = Manager::find($id);

        return view('manager.show', compact('manager'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $manager = Manager::find($id);

        return view('manager.edit', compact('manager'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Manager $manager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manager $manager)
    {
        request()->validate(Manager::$rules);

        $manager->update($request->all());

        return redirect()->route('managers.index')
            ->with('success', 'Manager updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $manager = Manager::find($id)->delete();

        return redirect()->route('managers.index')
            ->with('success', 'Manager deleted successfully');
    }
}
