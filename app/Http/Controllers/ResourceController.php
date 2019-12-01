<?php

namespace App\Http\Controllers;
use App\Resource;
use Illuminate\Http\Request;
use App\Http\Requests\SaveResourceRequest;

class ResourceController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('checkRole:accRecurso');
    }

    public function index(Request $request)
    {
        if (!$request->has('tipo'))
            return view('resources.index', [
                'resources' => Resource::whereNull('estado')->orderBy('tipo')->orderBy('nombre')->oldest('id')->paginate(10),
                'TipoFilter' => 0, 'Pag' => 10
            ]);
        else
        {
            $resources = Resource::whereNull('estado');
            if ($request->tipo != "0")
                $resources->where('tipo', $request->tipo);
            return view('resources.index', [
                'resources' => $resources->oldest('id')->paginate($request->cntPage)->appends(request()->query()),
                'TipoFilter' => $request->tipo, 'Pag' => $request->cntPage
            ]);
        }
    }
    public function show(Resource $resource){
        return view('resources.show', [
            'resource' => $resource
        ]);
    }

    public function create(){
        return view('resources.create', [
            'resource' => new Resource
        ]);
    }

    public function store(SaveResourceRequest $request){
        Resource::create($request->validated());

        return redirect()->route('resource.index')->with('status','El Recurso fue Creado con Éxito');
    }

    public function edit(Resource $resource){
        return view('resources.edit', [
            'resource' => $resource
        ]);
    }

    public function update(Resource $resource, SaveResourceRequest $request){
        $resource->update($request->validated());

        return redirect()->route('resource.index')->with('status','El Recurso fue Actualizado con Éxito');
    }

    public function destroy(Resource $resource){
        $resource->delete();

        return redirect()->route('resource.index')->with('status','El Recurso fue Eliminado con Éxito');
    }

    public function updateState(Resource $resource){
        $resource->update(['estado' => 0]);
        return redirect()->route('resource.index')->with('status','El Recurso fue Eliminado con Éxito');
    }
}
