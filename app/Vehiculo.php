<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'vehiculo';
 
    protected $fillable = ['id', 'descripcion', 'color', 'marca'];
 
    protected $hidden = ['created_at', 'updated_at'];

}
