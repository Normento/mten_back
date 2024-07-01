<?php

namespace App\Models;

use App\Models\User;
use App\Models\Actualite;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryActualite extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'name',
        'user_id',
        'description'

    ];

    protected $table = 'category_actualites';

    public function actualites():HasMany
    {
        return $this->hasMany(Actualite::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
