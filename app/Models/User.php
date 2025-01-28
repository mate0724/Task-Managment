<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'job_title',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    /**
     * Azok a csoportok, amelyeknek a felhasználó tagja.
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_user');
    }

    /* Azok a csoportok, amelyeknek a felhasználó vezetője.*/
    public function ledGroups()
    {
        return $this->hasMany(Group::class, 'leader_id');
    }

    public function meetings()
    {
        return $this->belongsToMany(Meeting::class, 'meeting_user');
    }

    public function createdMeetings()
    {
        return $this->hasMany(Meeting::class, 'created_by');
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
