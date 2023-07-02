<?php 
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
class RestMovie extends ResourceController
{
    protected $modelName = 'App/Models/CategoryModel';
    protected $format = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }
}

?>