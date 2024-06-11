<?php

namespace App\Models;

use App\Models\Scopes\CourseScope;
use App\Models\Scopes\EnrollmentScope;
use App\Models\Scopes\StudentScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_number',
        'status',
    ];

    protected $guarded = [
        'student_id',
        'course_id',
    ];

    protected $with = [
        'student',
        'course',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new EnrollmentScope);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class)->withoutGlobalScope(StudentScope::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class)->withoutGlobalScope(CourseScope::class);
    }

    public function classrooms(): BelongsToMany
    {
        return $this->belongsToMany(Classroom::class);
    }
}
