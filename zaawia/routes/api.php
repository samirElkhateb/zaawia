<?php

use App\Http\Controllers\AddChildController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\SkillController;
use App\Http\Controllers\Api\LevelController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });





Route::group(['middleware' => 'api'], function ($routes) {
    // public route
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login'])->name("login");
    Route::post("/logout", [AuthController::class, "logout"]);
    Route::get("/profile", [AuthController::class, "profile"]);
    Route::post("/profile-update", [AuthController::class, "updateProfile"]);
    Route::get('send-verify-mail/{email}', [AuthController::class, "verifyMail"]);
    Route::get('refresh-token', [AuthController::class, "refreshToken"]);


    Route::post('/add-child-name', [AddChildController::class, 'store_child']);

    Route::post('/child/skill', [SkillController::class, 'define_skill']);
    Route::post('/child/skill/game', [GameController::class, 'define_game']);
    Route::post('/child/skill/game/level', [levelController::class, 'define_level']);


    Route::get('/child/skill/game/pass-or-not/{game_id}', [GameController::class, 'complete_game']);
    Route::get('/child/skill/pass-or-not/{skill_id}', [SkillController::class, 'complete_skill']);
});
Route::post('/forget-password', [AuthController::class, 'forgetPassword']);
