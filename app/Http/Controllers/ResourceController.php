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
        $this->middleware('auth')->except('index', 'show');
    }

    public function index()
    {
        return view('resources.index', [
            'resources' => Resource::oldest('id')->paginate(10)
        ]);
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

        return redirect()->route('resource.index')->with('status','El recurso fue creado con exito');
    }

    public function edit(Resource $resource){
        return view('resources.edit', [
            'resource' => $resource
        ]);
    }

    public function update(Resource $resource, SaveResourceRequest $request){
        $resource->update($request->validated());

        return redirect()->route('resource.index')->with('status','El recurso fue actualizado con exito');
    }

    public function destroy(Resource $resource){
        $resource->delete();

        return redirect()->route('resource.index')->with('status','El recurso fue eliminado con exito');
    }
}
