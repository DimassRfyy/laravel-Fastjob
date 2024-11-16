<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyJob extends Model
{
    protected $fillable = [
        'company_id',
        'category_id',
        'name',
        'slug',
        'about',
        'salary',
        'location',
        'skill_level',
        'type',
        'is_open',
        'thumbnail',
    ];
}
