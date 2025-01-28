<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'scheduled_at', 'location', 'created_by'];


    
    protected $casts = [
        'scheduled_at' => 'datetime',
    ];


    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function attendees()
    {
        return $this->belongsToMany(User::class, 'meeting_user');
    }
}
