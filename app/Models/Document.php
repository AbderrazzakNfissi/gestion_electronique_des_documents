<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Section;
use App\Models\User;
class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'chemin',
        'taille',
        'type',
        'logo_path',
        'content',
        'user_id',
        'dossier_id',
        'section_id',
        'entreprise_id',
        'visibility'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function section(){
        return $this->belongsTo(Section::class);
    }

    public function dossier(){
        return $this->belongsTo(Dossier::class);
    }
    public function entreprise(){
        return $this->belongsTo(Entreprise::class);
    }
}
