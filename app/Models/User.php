<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Section;
use App\Models\Demande;
use App\Models\Document;
use App\Models\Entreprise;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'telephone',
        'email',
        'logo_path',
        'est_admin',
        'password',
        'entreprise_id'
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
    ];


    public function sections(){
        return $this->hasMany(Section::class);
    }

    public function demandes(){
        return $this->hasMany(Demande::class);
    }

    public function documents(){
        return $this->hasMany(Document::class);
    }

    public function entreprise(){
        return $this->belongsTo(Entreprise::class);
    }

    public function mission(){
        return $this->belongsTo(Mission::class);
    }

    
}
