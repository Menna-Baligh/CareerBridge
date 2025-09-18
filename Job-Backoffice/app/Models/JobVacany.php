<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobVacany extends Model
{
    use HasFactory, Notifiable , HasUuids , SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'job_vacancies';

    protected $fillable  = [
        'title' ,
        'description' ,
        'location' ,
        'salary' ,
        'type' ,
        'categoryId' ,
        'companyId',
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

    public function jobCategory(){
        return $this->belongsTo(JobCategory::class , 'categoryId' , 'id');
    }

    public function company(){
        return $this->belongsTo(Company::class , 'companyId' , 'id');
    }

    public function jobApplications(){
        return $this->hasMany(JobApplication::class , 'jobVacanyId' , 'id');
    }

}
