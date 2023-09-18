<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_attendance';

    protected $fillable = [
        'admission_time',
        'name_attendance',
        'code_attendance',
        'apprentices_assisted',
        'exit_time',
    ];

}
