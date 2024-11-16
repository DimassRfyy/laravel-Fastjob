<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobCandidate extends Model
{
    protected $fillable = [
        'user_id',
        'company_job_id',
        'resume',
        'message',
        'is_hired',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function companyJob() {
        return $this->belongsTo(CompanyJob::class);
    }
}
