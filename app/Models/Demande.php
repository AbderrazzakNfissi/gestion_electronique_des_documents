<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Demande extends Model
{
    use HasFactory;

    protected $fillable = [
        'etat',
        'emetteur_id',
        'recepteur_id',
        'document_id',
        'entreprise_id'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    
}
