<?php
namespace App\Controllers;

use App\Controllers\RestController;
use App\Controllers\RestException;
use App\Models\GeneralModel;

class General extends RestController {

    public function __construct() {
        parent::__construct();
        $this->model = new GeneralModel();
    }

    protected function getId($id) {
        if ($id==1) {
            $general = $this->model->find($id);
            return $general;
        }
    }

    protected function post($input) {
        //Validaciones
        $validaciones = $this->validar($input);
        if (count($validaciones)>0)  {
            throw new RestException($validaciones);
        }
        if (isset($input->general_id) && $input->general_id != null) {
            $general = $this->model->find($input->general_id);
           
        } else {
            //Alta General
            $general = new \App\Entities\General();
        }
        
        $general->inactivo      = $input->inactivo;
        $general->activa_subcat = $input->activa_subcat;
        $general->activa_naveg  = $input->activa_naveg;
        $this->model->save($general);
        $general->general_id = $this->model->insertID;
        return $general;
    }

    protected function put($id, $input) {
        //Validaciones
        $validaciones = $this->validar($input);
        if (count($validaciones)>0)  {
            throw new RestException($validaciones);
        }
        $general = $this->model->find($id);
        
        $general->inactivo      = $input->inactivo;
        $general->activa_subcat = $input->activa_subcat;
        $general->activa_naveg  = $input->activa_naveg;
        $this->model->save($general);
        //$general->general_id = $this->model->insertID;
        return $general;
    }

    private function validar($input) {
        $validaciones = [];
        if (!isset($input->inactivo)) {
            $validaciones[] = "Debe indicar si inactiva el sitio";
        }
        if (!isset($input->activa_subcat)) {
            $validaciones[] = "Debe indicar si activa subcategorías";
        }
        if (!isset($input->activa_naveg)) {
            $validaciones[] = "Debe indicar si activa links de navegación";
        }
        return $validaciones;
    }

}

?>