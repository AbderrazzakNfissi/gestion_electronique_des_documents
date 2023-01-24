<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Entreprise extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'telephone',
        'email',
        'pays',
        'industrie',
        'password',
        'path_logo'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }
    
}
