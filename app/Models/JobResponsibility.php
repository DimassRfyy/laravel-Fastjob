<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobResponsibility extends Model
{
    protected $fillable = [
        'company_job_id',
        'name',
    ];

    public function companyJob() {
        return $this->belongsTo(CompanyJob::class);
    }
}
