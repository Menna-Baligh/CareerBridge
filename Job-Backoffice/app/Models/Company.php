<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory, Notifiable , HasUuids , SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'address',
        'industry',
        'website',
        'ownerId'
    ];

    protected $dates = [
        'deleted_at',
    ];

    protected function casts(): array
    {
        return [
            'deleted_at' => 'datetime',
        ];
    }

    public function owner(){
        return $this->belongsTo(User::class , 'ownerId' ,'id');
    }

    public function jobVacancies(){
        return $this->hasMany(JobVacany::class , 'companyId' , 'id');
    }
    public function jobApplications(){
        return $this->hasManyThrough(JobApplication::class , JobVacany::class , 'companyId' , 'jobVacancyId' , 'id' , 'id');
    }
}
