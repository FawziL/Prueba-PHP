<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PersonaModel;

class PersonaController extends Controller
{
    protected $personaModel;

    public function __construct()
    {
        $this->personaModel = new PersonaModel();
    }

    public function getAll()
    {
        $personas = $this->personaModel->findAll();
        return $this->response->setJSON($personas);
    }

    public function getByID($id)
    {
        $persona = $this->personaModel->find($id);
        if (!$persona) {
            return $this->response->setStatusCode(404, 'Persona no encontrada');
        }
        return $this->response->setJSON($persona);
    }

    public function create()
    {
        //Traigo la info y la foto si te la tengo
        $data = $this->request->getPost();
        $foto = $this->request->getFile('foto');
        $rutaFoto = null;

        $camposEsperados = [
            'cedula',
            'nacionalidad',
            'nombres',
            'apellidos',
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
            'sueldo_actual'
        ];

        $camposFaltantes = [];

        //confirmar cuales campos estan vacios

        foreach ($camposEsperados as $campo) {
            if (!isset($data[$campo]) || empty($data[$campo])) {
                $camposFaltantes[] = $campo;
            }
        }

        if (!empty($camposFaltantes)) {
            return $this->response->setStatusCode(400, 'Campos faltantes')->setJSON([
                'message' => 'Faltan los siguientes campos:',
                'campos_faltantes' => $camposFaltantes
            ]);
        }

        //ya con que esten todo los datos, confirmo si tengo imafen y la guardo

        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            // Generar un nombre único para la foto
            $nombreFoto = time() . '_' . $foto->getName();
            // Mover el archivo a la carpeta de uploads
            $foto->move(WRITEPATH . '../public/uploads', $nombreFoto);
            // Guardar la ruta de la foto
            $rutaFoto = base_url('uploads/' . $nombreFoto);
        }

        $data['foto'] = $rutaFoto;

        try {
            if ($this->personaModel->save($data)) {
                return $this->response->setJSON(['message' => 'Persona creada con éxito', 'data' => $data]);
            } else {
                return $this->response->setStatusCode(400, 'Error al guardar')->setJSON([
                    'errors' => $this->personaModel->errors()
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500, 'Error en el servidor: ' . $e->getMessage());
        }
    }

    public function update($id)
    {
        $data = $this->personaModel->find($id);
    
        if (!$data) {
            return $this->response->setStatusCode(404, 'Persona no encontrada');
        }
    
        $formData = $this->request->getPost();
        
        // Actualiza solo los campos que han sido enviados en el formulario
        foreach ($formData as $key => $value) {
            if (!empty($value)) {
                $data[$key] = $value; 
            }
        }
        $data['id'] = $id; 
        $foto = $this->request->getFile('foto'); 
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $nombreFoto = time() . '_' . $foto->getName();
            $foto->move(WRITEPATH . '../public/uploads', $nombreFoto);
            $data['foto'] = base_url('uploads/' . $nombreFoto);
        }
        
        try {
            if ($this->personaModel->save($data)) {
                return $this->response->setJSON(['message' => 'Persona actualizada con éxito', 'data' => $data]);
            } else {
                $errors = $this->personaModel->errors();
                return $this->response->setStatusCode(400, 'Errores de validación: ' . json_encode($errors));
            }
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500, 'Error al actualizar la persona: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $this->personaModel->delete($id);
        return $this->response->setStatusCode(200, 'Persona eliminada');
    }
}