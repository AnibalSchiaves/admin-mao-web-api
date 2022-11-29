<?php
namespace App\Controllers;

use App\Controllers\RestController;
use App\Controllers\RestException;

class General extends RestController {

    public function __construct() {
        parent::__construct();
    }

    protected function getId($id) {
        if ($id==1) {
            $resp = array(
                "desactivarSitio" => false,
                "activarSubcategorias" => false,
                "activarLinksNavegacion" => true
            );
            return $resp;
        }
    }

}

?>