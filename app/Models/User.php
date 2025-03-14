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
        'first_name',
        'last_name',
        'national_id',
        'card_id',
        'role',
        'work_status',
        'email',
        'birth_date',
        'image',
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
    //===================Staert Relationships==============
    public function Addresses()
    {
        return $this->hasMany(Address::class);
    }
    public function bankInfo(){
        return $this->hasMany(BankInfo::class);
    }

    public function jobs(){
        return $this->hasMany(JobDetails::class);
    }
    public function  documents(){
    return $this->hasMany(Document::class);
    }
    //===================End Relationships===============

}
