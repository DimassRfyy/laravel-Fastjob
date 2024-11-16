<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function company(): BelongsTo {
        return $this->belongsTo(Company::class);
    }
    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function candidates(): HasMany {
        return $this->hasMany(JobCandidate::class);
    }
    public function responsibilities(): HasMany {
        return $this->hasMany(JobResponsibility::class);
    }
    public function qualifications(): HasMany {
        return $this->hasMany(JobQualification::class);
    }
}
