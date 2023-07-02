<?php

namespace App\Controllers\API;

use App\Models\CategoryModel;
use CodeIgniter\RESTful\ResourceController;

class Category extends ResourceController
{
    public function __construct()
    {
        $this->model = $this->setModel(new CategoryModel());
    }
    //protected $format = 'json';
    public function index()
    {
        $categories = $this->model->get();
        return $this->respond($categories);
    }
    public function create()
    {
        try {
            $category = $this->request->getJSON();
            if($this->model->insert($category))
            {
                $category->id = $this->model->insertID($category);
                return $this->respondCreated($category);
            }
            else
            {
                return $this->failValidationErrors($this->model->validation->listErros());
            } 
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage()," Ha ocurrido un error en el servidor");
        }
    }
    public function get($id = null)
    {
        try {
           if($id == null)
           {
            return $this->failValidationError('No se ha pasado un id valido');
           }
           $category = $this->model->find($id);

           if($category == null)
           {
            return $this->failNotFound('No se encontro la categoria la id:'.$id.' no es valida');
           }
           return $this->respond($category);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage()," Ha ocurrido un error en el servidor");
        }
    }
    public function update($id = null)
    {
        try {
           if($id == null)
           {
            return $this->failValidationError('No se ha pasado un id valido');
           }
           $categoryVal = $this->model->find($id);

           if($categoryVal == null)
           {
            return $this->failNotFound('No se encontro la categoria la id:'.$id.' no es valida');
           }
           $category = $this->request->getJSON();

            if($this->model->update($id, $category))
            {
                $category->id = $id;
                return $this->respondUpdated($category);
            }
            else
            {
                return $this->failValidationErrors($this->model->validation->listErros());
            } 
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage()," Ha ocurrido un error en el servidor");
        }
    }
    public function delete($id = null)
    {
        try {
           if($id == null)
           {
            return $this->failValidationError('No se ha pasado un id valido');
           }
           $categoryVal = $this->model->find($id);

           if($categoryVal == null)
           {
            return $this->failNotFound('No se encontro la categoria la id:'.$id.' no es valida');
           }

            if($this->model->delete($id))
            {
                //$category->id = $id;
                return $this->respondDeleted($categoryVal);
            }
            else
            {
                return $this->failServerError('No se ha podido eliminar el registro');
            } 
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage()," Ha ocurrido un error en el servidor");
        }
    }
}