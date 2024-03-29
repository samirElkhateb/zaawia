<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;



    protected $table = 'levels';
    protected $primaryKey = ['level_id', 'game_id'];
    public $incrementing = false;

    protected $fillable = [
        'level_id',
        'game_id',
        'level_number',
        'child_answer',
    ];

    public function getIncrementing()
    {
        return false;
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
