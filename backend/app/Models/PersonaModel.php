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

    protected $validationRules = [
        'cedula' => 'required|is_unique[persona.cedula]',
        'nacionalidad' => 'required',
        'nombres' => 'required',
        'apellidos' => 'required',
        'fecha_nacimiento' => 'required|valid_date',
        'sexo' => 'required',
        'estado_civil' => 'required',
        'estado' => 'required',
        'municipio' => 'required',
        'parroquia' => 'required',
        'direccion' => 'required',
        'telefonos' => 'required',
        'correo_electronico' => 'required|valid_email',
        'cantidad_hijos' => 'required|integer',
        'sueldo_actual' => 'required|decimal',
    ];

    protected $validationMessages = [
        'cedula' => [
            'required' => 'La cédula es obligatoria.',
            'is_unique' => 'La cédula ya existe.',
        ],
        'correo_electronico' => [
            'required' => 'El correo electrónico es obligatorio.',
            'valid_email' => 'Por favor, proporciona un correo electrónico válido.',
        ],
        
    ];
    protected $skipValidation = false;
}
