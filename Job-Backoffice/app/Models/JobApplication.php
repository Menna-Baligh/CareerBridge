<?php

namespace App\Models;

use App\Models\Resume;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobApplication extends Model
{
    use HasFactory, Notifiable , HasUuids , SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'job_applications';

    protected $fillable = [
        'status',
        'aiGeneratedScore',
        'aiGeneratedFeedback',
        'jobVacanyId',
        'userId' ,
        'resumeId',
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

    public function jobVacany(){
        return $this->belongsTo(JobVacany::class , 'jobVacanyId' , 'id');
    }

    public function user(){
        return $this->belongsTo(User::class , 'userId' , 'id');
    }

    public function resume(){
        return $this->belongsTo(Resume::class , 'resumeId' , 'id');
    }
}
