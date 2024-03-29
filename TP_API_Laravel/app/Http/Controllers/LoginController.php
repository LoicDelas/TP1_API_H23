<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials))
        {
            try
            {
                $user = new UserResource(User::where('email', $credentials['email'])->first());
                $token = $user->createToken('Jeton de ' . $credentials['email']);

                return response()
                    ->json([
                        'user' => $user,
                        'token' => $token->plainTextToken
                    ])
                    ->setStatusCode(200);
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

        return response()->json([
            'message' => 'Vos informations de connexion ne sont pas valides.',
        ])->setStatusCode(401);
    }

    public function logout(): JsonResponse
    {
        Auth::user()->tokens()->delete();

        return response()->json(['message' => 'Vous avez été déconnecté avec succès'])->setStatusCode(200);
    }
}
