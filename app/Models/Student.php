<?php

namespace App\Models;

use App\Models\Scopes\StudentScope;
use App\Models\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
    ];

    protected $guarded = [
        'user_id'
    ];

    protected $with = [
        'user',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new StudentScope);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withoutGlobalScope(UserScope::class);
    }
}
