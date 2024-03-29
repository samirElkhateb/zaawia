<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    protected $table = 'games';
    protected $primaryKey = 'game_id';
    // protected $primaryKey = ['game_id', 'skill_id'];
    // public $incrementing = false;
    protected $fillable = [
        'game_id',
        'game_name',
        'skill_id',
        'is_completed',
        'child_id'
    ];
    // public function getIncrementing()
    // {
    //     return false;
    // }



    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }

    public function levels()
    {
        return $this->hasMany(Level::class);
    }
}
