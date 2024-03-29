<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Level;
use App\Http\Requests\LevelRequest;
use App\Http\Resources\LevelResource;



class LevelController extends Controller
{
    public function define_level(LevelRequest $request)
    {
        $validatedData = $request->validated();

        $game = Level::create($validatedData);

        return new LevelResource($game);
    }
}
