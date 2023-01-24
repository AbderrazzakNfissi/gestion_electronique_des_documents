<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Document;
use App\Models\Section;
class Dossier extends Model

{
    use HasFactory;
   
    protected $fillable = [
        'nom',
        'chemin',
        'taille',
        'section_id'
    ];


    public function documents(){
        return $this->hasMany(Document::class);
    }

    public function section(){
        return $this->belongsTo(Section::class);
    }
    
}
