<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_competence';

    protected $fillable = [
        'name_competence',
        'description_competence',
        'ficha_id',
    ];

    public function ficha()
    {
        return $this->belongsTo(Ficha::class, 'ficha_id');
    }

    
}