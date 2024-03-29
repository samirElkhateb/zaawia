<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    protected $table = 'skills';
    protected $primaryKey = 'skill_id';

    protected $fillable = [
        'skill_id',
        'skill_name',
        'is_completed',
        'child_id'
    ];


    public function games()
    {
        return $this->hasMany(Game::class);
    }

    public function child()
    {
        return $this->belongsTo(child::class);
    }
}
