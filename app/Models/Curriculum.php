<?php

namespace App\Models;

use App\Models\Scopes\CourseScope;
use App\Models\Scopes\CurriculumScope;
use App\Models\Scopes\DisciplineScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Curriculum extends Model
{
    use HasFactory;

    protected $fillable = [
        'period',
        'status',
    ];

    protected $guarded = [
        'course_id',
        'discipline_id',
    ];

    protected $with = [
        'course',
        'discipline',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new CurriculumScope);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class)->withoutGlobalScope(CourseScope::class);
    }

    public function discipline(): BelongsTo
    {
        return $this->belongsTo(Discipline::class)->withoutGlobalScope(DisciplineScope::class);
    }

    public function classrooms(): HasMany
    {
        return $this->hasMany(Classroom::class);
    }
}
