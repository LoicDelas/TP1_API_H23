<?php

namespace App\Http\Controllers;

use App\Http\Resources\CriticResource;
use App\Models\Critic;
use Exception;
use Illuminate\Http\Request;

class CriticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $request->validate([
            'score' => 'required|decimal:0,1|min:0|max:99.9',
            'user_id' => 'required|integer|exists:users,id',
            'film_id' => 'required|integer|exists:films,id'
        ]);

        try
        {
            $critic = Critic::create($request->all());

            return (new CriticResource($critic))
                ->response()
                ->setStatusCode(201);
        }
        catch (Exception $ex)
        {
            abort(500, 'Erreur Serveur');
        }
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
