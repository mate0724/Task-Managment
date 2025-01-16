<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'leader_id',
    ];

    // Csoportvezető kapcsolat
    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    // Csoport tagjainak kapcsolata
    public function members()
    {
        return $this->belongsToMany(User::class, 'group_user', 'group_id', 'user_id');
    }
}
