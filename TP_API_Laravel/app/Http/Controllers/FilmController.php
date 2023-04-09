<?php

namespace App\Http\Controllers;

use App\Http\Resources\FilmCriticResource;
use App\Http\Resources\FilmResource;
use App\Models\Critic;
use App\Models\Film;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Exception;
use function PHPUnit\Framework\isNull;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {
            $films = $this->FilterRequest();

            return FilmResource::collection($films->paginate(20))->response()->setStatusCode(200);
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
        return 'you can add a movie since your admin';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try
        {
            return (new FilmCriticResource(Film::findOrFail($id)))->response()->setStatusCode(200);
        }
        catch(ModelNotFoundException $ex)
        {
            abort(404, $ex->getMessage());
        }
        catch (Exception $ex)
        {
            abort(500, 'Erreur Serveur');
        }
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

    private function FilterRequest()
    {
        $keywords = request('keywords');
        $rating = request('rating');
        $max_length = request('max-length');

        $films = Film::select();

        $films = empty($keywords) ? $films :
            $films->where(function($query) use ($keywords) {
                $query->where('title', 'like', '%' . $keywords . '%')
                      ->orWhere('description', 'like', '%' . $keywords . '%');
            });

        $films = empty($rating) ? $films :
            $films->where('rating', $rating);

        return empty($max_length) || is_nan($max_length) ? $films :
            $films->where('length', '<=', $max_length);
    }
}
