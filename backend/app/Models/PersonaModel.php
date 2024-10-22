<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonaModel extends Model
{
    protected $table      = 'persona';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'cedula',
        'nacionalidad',
        'nombres',
        'apellidos',
        'nombre_completo', 
        'fecha_nacimiento',
        'sexo',
        'estado_civil',
        'estado',
        'municipio',
        'parroquia',
        'direccion',
        'telefonos',
        'correo_electronico',
        'cantidad_hijos',
        'sueldo_actual',
        'foto',
    ];

}
