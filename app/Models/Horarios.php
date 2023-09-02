<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horarios extends Model
{
    use HasFactory;

    protected $primaryKey = 'Id_timeTable';

    protected $fillable = [
        'Jornada',
        'Fecha_inicio',
        'Fecha_finalizacion',
        'time_start',
        'time_finish',
        'ficha_id'
    ];

    public function ficha()
    {
        return $this->belongsTo(Ficha::class, 'ficha_id');
    }

}
