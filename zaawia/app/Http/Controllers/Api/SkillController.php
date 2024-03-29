<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;
use App\Http\Requests\DefineSkillRequest;
use App\Http\Resources\SkillResource;
use App\Models\Game;

class SkillController extends Controller
{
    // public function define_skill(Request $request)
    // {
    //     $request->validate([
    //         'child_id' => 'required|integer',
    //         'skill_id' => 'required|integer',
    //         'skill_name' => 'required|string|max:255',
    //         'is_completed' => 'required|boolean',
    //     ]);

    //     $skill = new Skill();
    //     $skill->skill_id = $request->input('skill_id');
    //     $skill->skill_name = $request->input('skill_name');
    //     $skill->is_completed = $request->input('is_completed');
    //     $skill->child_id = $request->input('child_id');
    //     $skill->save();

    //     return response()->json([
    //         'message' => 'you are in skill ' . $skill->skill_name,
    //         'data' => $skill
    //     ], 201);
    // }
    public function define_skill(DefineSkillRequest  $request)
    {
        $validatedData = $request->validated();

        $skill = Skill::create($validatedData);

        return new SkillResource($skill);
    }

    public function complete_skill($skill_id)
    {
        $games = Game::where('skill_id', $skill_id)->get();
        $correctAnswersCount = 0;
        foreach ($games as $game)
            if ($game->is_completed == 1) {
                $correctAnswersCount++;
            }

        $skill = Skill::where('skill_id', $skill_id)->first();

        if ($correctAnswersCount >= 1) {
            $skill->is_completed = true;
            $skill->save();

            return  response()->json([
                'message' => 'You won! go to the next skill',
                'status' => 1
            ], 200);
        } else {
            return   response()->json([
                'message' => 'You must complete all games ',
                'status' => 0
            ], 403);
        }
    }
}
