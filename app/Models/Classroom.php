<?php

namespace App\Models;

use App\Models\Scopes\ClassroomScope;
use App\Models\Scopes\CurriculumScope;
use App\Models\Scopes\TeacherScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'daytime',
        'status',
    ];

    protected $guarded = [
        'curriculum_id',
        'teacher_id',
    ];

    protected $with = [
        'curriculum',
        'teacher',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new ClassroomScope);
    }

    public function curriculum(): BelongsTo
    {
        return $this->belongsTo(Curriculum::class)->withoutGlobalScope(CurriculumScope::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class)->withoutGlobalScope(TeacherScope::class);
    }

    public function enrollments(): BelongsToMany
    {
        return $this->belongsToMany(Enrollment::class);
    }
}
