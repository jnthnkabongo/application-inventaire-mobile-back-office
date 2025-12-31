<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class etat_mate extends Model
{
    use HasFactory;

    protected $table = 'etat_mates';
    protected $fillable = [
        'name'
    ];
}
