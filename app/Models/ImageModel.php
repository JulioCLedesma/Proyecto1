<?php

namespace App\Models;

use CodeIgniter\Model;

class ImageModel extends Model
{
    protected $table = 'images';
    protected $primaryKey = 'id';
    protected $allowedFields = ['publication_id', 'filename', 'created_at'];

    // Aquí puedes definir cualquier lógica adicional que necesites para manejar las imágenes
}
