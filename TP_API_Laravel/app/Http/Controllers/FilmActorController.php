<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActorResource;
use App\Models\Film;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class FilmActorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        try
        {
            return ActorResource::collection(Film::findOrFail($id)->actors)->response()->setStatusCode(200);
        }
        catch(ModelNotFoundException $ex)
        {
            abort(404, $ex->getMessage());
        }
        catch (Exception $ex)
        {
            abort(500, 'Erreur serveur');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
