<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Actualite;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use App\Mail\VerificationCodeMail;
use Illuminate\Support\Facades\Mail;
use Nette\Schema\Elements\Structure;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable , InteractsWithMedia, SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'lastname',
        'firstname',
        'phone',
        'email',
        'password',
        'can_login',
        'two_factor_enabled',
        'login_attempts',
        'last_login_at',
        'two_factor_code',
        'two_factor_expires_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function actualite():BelongsTo
    {
        return $this->belongsTo(Actualite::class);
    }


    public function sendVerificationCode()
    {
        $verificationCode = mt_rand(100000, 999999);
        $this->verification_code = $verificationCode;
        $this->save();

        // Envoyer le code de vérification par e-mail
        Mail::to($this->email)->send(new VerificationCodeMail($verificationCode));
    }


    public function secteurs(){
        return $this->hasMany(Secteur::class, 'user_id', 'id');
    }

    public function structures(){
        return $this->hasMany(Structure::class, 'user_id', 'id');
    }

    public function opportunites(){
        return $this->hasMany(Opportunite::class, 'user_id', 'id');
    }

    public function projets(){
        return $this->hasMany(Projet::class, 'user_id', 'id');
    }

    public function documents(){
        return $this->hasMany(Document::class, 'user_id', 'id');
    }

}
