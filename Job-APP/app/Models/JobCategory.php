<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobCategory extends Model
{
    use HasFactory, Notifiable , HasUuids , SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'job_categories';

    protected $fillable = [
        'name',
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

    public function jobVacanies(){
        return $this->hasMany(JobVacany::class , 'categoryId' , 'id');
    }

}
