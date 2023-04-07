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
}
