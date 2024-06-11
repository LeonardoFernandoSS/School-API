<?php

namespace App\Models;

use App\Models\Scopes\DisciplineScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Discipline extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new DisciplineScope);
    }

    public function curricula(): HasMany
    {
        return $this->hasMany(Curriculum::class);
    }
}
