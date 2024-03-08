<?php

namespace App\Models;

use App\Models\Scopes\StudentScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    protected static function booted(): void
    {
        static::addGlobalScope(new StudentScope);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
