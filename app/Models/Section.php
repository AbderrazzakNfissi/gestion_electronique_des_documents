<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Document;
use App\Models\Dossier;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'user_id',
    ];


    public function dossiers(){
        return $this->hasMany(Dossier::class);
    }

    public function documents(){
        return $this->hasMany(Document::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
