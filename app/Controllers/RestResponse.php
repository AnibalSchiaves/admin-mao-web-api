<?php
namespace App\Controllers;

use Exception;

class RestResponse extends Exception {

    public $mensajes;
    public $data;

    public function __construct($data, $mensajes = []) {
        if (is_array($mensajes)) {
            $this->mensajes = $mensajes;
        } else {
            $this->mensaje = $mensajes;
        }
        $this->data = $data;
    }
}
?>