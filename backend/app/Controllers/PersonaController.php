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
        $data = $this->request->getPost();
        var_dump($data);
        $this->personaModel->save($data);
        return $this->response->setStatusCode(201, 'Persona creada');
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $data['id'] = $id; 
        $this->personaModel->save($data);
        return $this->response->setStatusCode(200, 'Persona actualizada');
    }

    public function delete($id)
    {
        $this->personaModel->delete($id);
        return $this->response->setStatusCode(200, 'Persona eliminada');
    }
}