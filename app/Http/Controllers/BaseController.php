<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class BaseController
{
    protected string $class;

    public function index(Request $request)
    {
        return $this->class::paginate($request->per_page);
    }

    public function store(Request $request)
    {
        return response()
            ->json(
                $this->class::create($request->all()),
                201
            );
    }

    public function show(int $id)
    {
        $resource = $this->class::find($id);

        if (is_null($resource)) {
            return response()
                ->json('', 204);
        }

        return response()
            ->json($resource,404);
    }

    public function update(int $id, Request $request)
    {
        $resource = $this->class::find($id);

        if (is_null($resource)) {
            return response()->json(
                ['error' => 'Serie not found!'], 404);
        }

        $resource->fill($request->all());
        $resource->save();

        return $resource;
    }

    public function destroy(int $id)
    {   
        $qntResourceRemoved = $this->class::destroy($id); // retorna a quantidade de recursos destruídos
        if ($qntResourceRemoved === 0) {
            return response()->json(
                ['error' => 'Serie not found!'], 404);
        }

        return response()->json('', 204);

        // $resource = $this->class::find($id);

        // if (is_null($resource)) {
        //     return response()->json(['error' => 'Serie not found!'], 404);
        // }

        // $resource->remove();

        // return $resource;
    }
}
