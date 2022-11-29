<?php
namespace App\Controllers;

use Exception;

class RestException extends Exception {

    protected $type;

    protected $errors;

    public function __construct($messages, $type = null) {
        $this->type   = $type;
        $this->errors = $messages;
        parent::__construct($messages[0]);
    }

    public function addError($err) {
        $this->errors[] = $err;
    }

    public function getErrores() {
        return $this->errors;
    }

}
?>