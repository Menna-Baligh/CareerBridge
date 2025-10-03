<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resume extends Model
{
    use HasFactory, Notifiable , HasUuids , SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'resumes';

    protected $fillable = [
        'filename',
        'fileUri' ,
        'summary',
        'contactDetails',
        'education',
        'experience',
        'skills',
        'userId',
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

    public function user(){
        return $this->belongsTo(User::class , 'userId' , 'id');
    }

    public function jobApplications(){
        return $this->hasMany(JobApplication::class , 'resumeId' , 'id');
    }

}
