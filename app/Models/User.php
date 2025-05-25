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
    ];

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
    public function getFormattedStatusAttribute()
    {
        if ($this->status === 'active') {
            return '<span style="background-color: green; color: white; padding: 4px 8px; border-radius: 4px;">Active</span>';
        } elseif ($this->status === 'inactive') {
            return '<span style="background-color: red; color: white; padding: 4px 8px; border-radius: 4px;">Inactive</span>';
        }

        return $this->status;
    }
    public function subjectTeachers(){
        return $this->hasMany(SubjectTeacher::class, 'user_id');
    }
}
