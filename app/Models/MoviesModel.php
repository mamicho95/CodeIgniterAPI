<?php namespace App\Models;

use CodeIgniter\Model;

class CatergoryModel extends Model
{
    protected $table = 'movies';
    protected $primarykey = 'id';
    protected $allowFields = ['title','description','category_id'];
    public function getAll()
    {
        return $this->asArray()
        ->select('movies.*, category.title as category')
        ->join('category','category.id = movies.category_id')
        ->first();
    }

}

?>