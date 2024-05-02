<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $allowedFields = ['name', 'login', 'password'];

    public function login($data)
    {
        return $this->asArray()->where($data)->first();
    }
}