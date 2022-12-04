<?php
namespace App\Models;

use CodeIgniter\Model;

class GeneralModel extends Model {

    protected $table = 'general';
    protected $primaryKey = 'general_id';
    protected $allowedFields = [
        'inactivo', 'activa_subcat', 'activa_naveg'
    ];
    protected $returnType = 'App\Entities\General';

}
?>