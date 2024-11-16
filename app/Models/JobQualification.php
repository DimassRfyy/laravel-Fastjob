<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobQualification extends Model
{
    protected $fillable = [
        'company_job_id',
        'name',
    ];
}
