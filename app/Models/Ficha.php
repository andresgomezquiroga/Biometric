<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Ficha extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_ficha';

    protected $fillable = [
        'number_ficha',
        'date_start',
        'date_end',
        'programa_id',
    ];

    public function programa()
    {
        return $this->belongsTo(Programa::class, 'programa_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'members_fichas', 'ficha_id', 'user_id');
    }

    public function instructors()
    {
        return $this->belongsToMany(User::class, 'members_fichas', 'ficha_id', 'user_id')
            ->whereHas('roles', function ($query) {
                $query->where('name', 'Instructor');
            });
    }
}
