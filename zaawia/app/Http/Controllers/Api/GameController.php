<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DefineGameRequest;
use App\Models\Game;
use App\Http\Resources\GameResource;
use App\Models\Level;

class GameController extends Controller
{
    public function define_game(DefineGameRequest $request)
    {
        $validatedData = $request->validated();

        $game = Game::create($validatedData);

        return new GameResource($game);
    }
    public function complete_game($game_id)
    {
        $levels = Level::where('game_id', $game_id)->get();
        $correctAnswersCount = 0;
        foreach ($levels as $level)
            if ($level->child_answer == 1) {
                $correctAnswersCount++;
            }

        $game = Game::where('game_id', $game_id)->first();


        if ($correctAnswersCount >= 2) {

            $game->is_completed = true;
            $game->save();
            return  response()->json([
                'message' => 'You won!',
                'status' => 1
            ], 200);
        } else {
            return   response()->json([
                'message' => 'You lost...',
                'status' => 0
            ], 403);
        }
    }
}
