<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\Response;

class RestController extends Controller {

    public function __construct() {
        $this->session = \Config\Services::session();
        Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
        Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
        Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed
    }

    public function index($id=null) {
        $request = service('request');
        $this->response->setHeader('Content-Type','application/json;charset=utf-8');
        $method = $request->getMethod();
        if (isset($id)) {
            $msg = null;
            if ($method=='get') {
                $data = $this->getId($id);
                $msg = "Encontrado";
            } else if ($method=='put') {
                try {
                    $data = $this->put($id,$request->getJSON());
                } catch (RestException $ex) {
                    $this->response409($ex->getErrores()[0]);
                    return;
                }
                $msg = "Modificado";
            } else if ($method=='delete') {
                try {
                    $data = $this->delete($id);
                } catch (RestException $ex) {
                    $this->response409($ex->getErrores()[0]);
                    return;
                }
                $msg = "Borrado";
            } else {
                echo $method." no implementado todavía!";
                return;
            }
            if (!isset($data) || $data==null) {
                $this->response404("No encontrado.");
            } else {
                $this->response200($data, $msg);
            }
        } else {
            if ($method=='get') {
                $data = $this->get($_GET);
                $this->response200($data, "Obtenidos");
            } else if ($method=='post') {
                try {
                    $data = $this->post($request->getJSON());
                    $this->response200($data);
                } catch (RestException $ex) {
                    $this->response400($ex->getErrores());
                }
            } else {
                echo $method." no implementado todavía!";
            }
        }
    }

    protected function validarUsuario() {
        $validacion = null;
        if (null == $this->session->get("usuario")) {
            $validacion[] = "Debe encontrarse logueado";
        } 
        return $validacion;
    }

    protected function usuarioLogueado() {
        return $this->session->get("usuario");
    }

    protected function get($params) {
        echo json_encode("GET no implementado");
    }

    protected function delete($id) {
        echo json_encode("DELETE no implementado");
    }

    protected function getId($id) {
        //echo json_encode("GET de item ".$id." no implementado");
        return null;
    }

    protected function post($input) {
        echo json_encode("POST no implementado");
    }

    protected function put($id,$input) {
        echo json_encode("PUT no implementado");
    }

    protected function escapeIsset($input) {
        return isset($input)?$input:null;
    }
    
    protected function response200($data, $msg = 'Creado') {
        $this->response->setStatusCode(Response::HTTP_OK);
        $response = new RestResponse($data, $msg);
        echo json_encode($response);
    }

    protected function response204() {
        $this->response->setStatusCode(Response::HTTP_NO_CONTENT);
    }

    protected function response400($mensaje) {
        $this->response->setStatusCode(Response::HTTP_BAD_REQUEST);
        $response = new RestResponse(null, $mensaje);
        echo json_encode($response);
    }

    protected function response404($mensaje) {
        $this->response->setStatusCode(Response::HTTP_NOT_FOUND);
        $response = new RestResponse(null, $mensaje);
        echo json_encode($response);
    }

    protected function response405($mensaje) {
        $this->response->setStatusCode(Response::HTTP_METHOD_NOT_ALLOWED);
        $response = new RestResponse(null, $mensaje);
        echo json_encode($response);
    }

    protected function response409($mensaje) {
        $this->response->setStatusCode(Response::HTTP_CONFLICT);
        $response = new RestResponse(null, $mensaje);
        echo json_encode($response);
    }

    protected function response500($mensaje) {
        $this->response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        $response = new RestResponse(null, $mensaje);
        echo json_encode($response);
    }

}
?>