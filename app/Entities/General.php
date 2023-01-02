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

    public function getInactivo() {
        if ($this->attributes['inactivo'] == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function getActivaSubcat() {
        if ($this->attributes['activa_subcat'] == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function getActivaNaveg() {
        if ($this->attributes['activa_naveg'] == 0) {
            return false;
        } else {
            return true;
        }
    }
}

?>