<?php
namespace App\Entities;

use CodeIgniter\Entity;

class General extends Entity {

    protected $attributes = [
        "general_id" => null,
        "inactivo" => null,
        "activa_subcat" => null,
        "activa_naveg" => null
    ];

}

?>