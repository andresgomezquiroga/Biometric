<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_ficha';

    public function programa()
    {
        return $this->belongsTo(Programa::class, 'programa_id');
    }
}
