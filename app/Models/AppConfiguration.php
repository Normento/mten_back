<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppConfiguration extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'app_configurations';

    protected $fillable = [
        'code',
        'name',
        'value',
        'type',
        'visible',
        'description',
    ];
}
