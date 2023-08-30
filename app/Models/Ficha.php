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

    public function members()
    {
        return $this->belongsToMany(User::class, 'members_fichas', 'ficha_id', 'user_id');
    }

}
