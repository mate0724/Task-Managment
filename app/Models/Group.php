<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;

    public function membbers()
    {
        return $this->belongsToMany(User::class, 'group_user');
    }

    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }
}
