<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\JsonResponse;

class CharactersController extends Controller
{

    /**
     * @OA\Get(
     *     path="/characters",
     *     tags={"Characters"},
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        $characters = Character::orderBy('position')->get();

        $result = $characters->map(fn($c) => [
            'id' => $c->id,
            'name' => $c->name,
            'imageSrc' => $c->image_src,
            'description' => $c->description,
        ]);

        return response()->json($result, 200);
    }
}
