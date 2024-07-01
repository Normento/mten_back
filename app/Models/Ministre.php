<?php

namespace App\Models;

use App\Models\User;
use App\Models\Agenda;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ministre extends Model implements HasMedia
{
    use HasFactory , SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'firstname',
        'lastname',
        'poste',
        'biographie',
        'mot',
        'stardate',
        'enddate',
        'user_id', 
        'on_poste', 

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function agendas()
    {
        return $this->belongsTo(Agenda::class, 'ministre_id');
    }

}
