<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservaciones extends Model
{
    //
    protected $fillable = ['equipos', 'estadio', 'fecha', 'hora', 'zona', 'fila', 'asiento'];
}
