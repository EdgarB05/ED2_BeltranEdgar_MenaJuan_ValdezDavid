<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservaciones extends Model
{
    //
    protected $fillable = ['nombrehuesped', 'fechaingreso', 'fechafin', 'numhabitacion', 'metodopago', 'estadocontrato', 'servicios'];
}
