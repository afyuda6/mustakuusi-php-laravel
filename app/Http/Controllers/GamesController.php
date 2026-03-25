<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Screenshot;
use App\Models\GameCharacter;
use Illuminate\Http\JsonResponse;

class GamesController extends Controller
{

    /**
     * @OA\Get(
     *     path="/games",
     *     tags={"Games"},
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        $games = Game::with(['screenshots', 'gameCharacters.character'])
            ->orderByDesc('release_date')
            ->orderByDesc('id')
            ->get();

        $games->each(function ($game) {
            $game->screenshots = Screenshot::where('game_id', $game->id)->get();
            $game->gameCharacters = GameCharacter::where('game_id', $game->id)->get();
        });

        $result = $games->map(function ($game) {
            return [
                'id' => $game->id,
                'title' => $game->title,
                'imageSrc' => $game->image_src,
                'date' => $game->release_date->timezone('Asia/Jakarta')->toIso8601String(),
                'description' => $game->description,
                'categories' => $game->categories,
                'detail' => $game->detail,
                'privacyPolicyLink' => $game->privacy_policy_link,
                'downloadLink' => $game->download_link,
                'longDescription' => $game->long_description,
                'screenshots' => $game->screenshots->sortBy(fn($c) => $c->id)->pluck('image_src')->toArray(),
                'characters' => $game->gameCharacters
                    ->sortBy(fn($gc) => $gc->character->position)
                    ->pluck('character.id')
                    ->toArray(),
            ];
        });

        return response()->json($result, 200);
    }
}
