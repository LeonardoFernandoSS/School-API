<?php

namespace App\Models;

use App\Models\Scopes\CourseScope;
use App\Models\Scopes\PeriodScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'duration',
        'status',
    ];

    protected $guarded = [
        'period_id'
    ];

    protected $with = [
        'period',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new CourseScope);
    }

    public function period(): BelongsTo
    {
        return $this->belongsTo(Period::class)->withoutGlobalScope(PeriodScope::class);
    }

    public function curricula(): HasMany
    {
        return $this->hasMany(Curriculum::class);
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }
}
