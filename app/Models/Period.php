<?php

namespace App\Models;

use App\Models\Scopes\PeriodScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Period extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'status',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new PeriodScope);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
