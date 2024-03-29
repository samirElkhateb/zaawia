<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class child extends Model
{
    use HasFactory;
    protected $table = 'child';
    protected $fillable = [
        'id',
        'name',
        'icon',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function skill()
    {
        return $this->hasMany(Skill::class);
    }



    public function level()
    {
        return $this->hasMany(Level::class);
    }
}
