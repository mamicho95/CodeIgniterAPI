<?php namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'category';
    protected $primarykey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['title'];

    protected $validationRules =[
        'title' => 'required|alpha_space|min_length[1]|max_length[50]'
    ];
    protected $validationMessages = [
        'title' => ['valid_title' => 'ingrese un titulo valido']
    ];
    protected $skipValidation = false;
    public function get($id = null)
    {
        if ($id === null)
        {
            return $this->findAll();
        }
        return $this->asArray()
        ->where(['id' => $id])
        ->first();
    }

}

?>