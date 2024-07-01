<?php

namespace App\Models;

use App\Models\Direction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryDirection extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'name',
        'user_id',
        'description'

    ];

    protected $table = 'category_directions';

    public function directions():HasMany
    {
        return $this->hasMany(Direction::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
