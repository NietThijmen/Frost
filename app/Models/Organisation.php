<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organisation extends Model
{
    use HasUuids, SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'authData'
    ];

    protected $casts = [
        'authData' => 'encrypted:array' // this will hold stuff like API keys, etc.
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
