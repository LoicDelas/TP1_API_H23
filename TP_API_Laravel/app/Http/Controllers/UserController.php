<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
            'last_name' => 'required',
            'first_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        try {
            $user = User::create([
                'last_name' => $request->last_name,
                'first_name' => $request->first_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => 2
            ]);

            return (new UserResource($user))
            ->response()
            ->setStatusCode(201);
        }
        catch (Exception $ex)
        {
            abort(500, 'Erreur serveur');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            return (new UserResource(User::findOrFail($id)))->response()->setStatusCode(200);
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
        $request->validate([
            'last_name' => 'required|max:50',
            'first_name' => 'required|max:50',
            'email' => 'required',
        ]);

        $user = $request->user();
        $user->last_name = $request->last_name;
        $user->first_name = $request->first_name;

        try {
            if ($user->email != $request->email)
            {
                $request->validate(['email' => 'email|unique:users']);
                $user->email = $request->email;
                foreach ($user->tokens as $token)
                {
                    $token->name = 'Jeton de ' . $request->email;
                    $token->save();
                }
            }
            $user->save();

            return (new UserResource($user))
                ->response()
                ->setStatusCode(204);
        }
        catch (Exception $ex)
        {
            abort(500, 'Erreur Serveur');
        }
    }

    public function updatePassword(Request $request, string $id)
    {
        $request->validate([
            'old_password' => 'current_password',
            'password' => 'required|confirmed'
        ]);

        $user = $request->user();

        try {
            $user->password = Hash::make($request->password);
            $user->save();

            return (new UserResource($user))
                ->response()
                ->setStatusCode(204);
        }
        catch (Exception $ex)
        {
            abort(500, 'Erreur Serveur');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
