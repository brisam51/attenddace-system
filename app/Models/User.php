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
    public function bankInfo()
    {
        return $this->hasMany(BankInfo::class);
    }

    public function  documents()
    {
        return $this->hasMany(Document::class);
    }
    //===================End Relationships===============
    //==========Start relationship with pivot table project_job_user============

    //Defin relationship with project via pivot ProjectJobUser
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_job_user', 'user_id', 'project_id')
            ->withPivot('job_detail_id', 'file_contract');
    }
    //Defin relationship with job_detail via pivot ProjectJobUser
    public function jobDetail()
    {
        return $this->belongsToMany(JobDetails::class, 'project_job_user', 'user_id', 'job_detail_id')
            ->withPivot('project_id', 'file_contract');
    }
}
