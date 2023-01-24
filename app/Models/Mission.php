<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_debut',
        'date_fin',
        'message',
        'user_id'
    ];

    public function user(){
        return $this->hasOne(User::class);
    }
}
