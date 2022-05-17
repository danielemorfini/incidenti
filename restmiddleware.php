<?php
require_once("incidentiLogic.php");

/*
URL endpoints:

[GET] ./restmiddleware.php -> getIncidenti()
[GET] ./restmiddleware.php/?codice=$codice -> getVeicoliCoinvolti()
[GET] ./restmiddleware.php/?targa=$targa -> getIncidentiTarga()

[POST] ./restmiddleware.php -> postSinistro()
[POST] ./restmiddleware.php -> postImporto()
*/

class RestService {

   private $httpVersion = "HTTP/1.1";

   private function setHttpHeaders($contentType, $statusCode){
		http_response_code($statusCode);		
		header("Content-Type:". $contentType);
      header("Access-Control-Allow-Origin: *");
	}

   public function encodeJson($responseData) {
		$jsonResponse = json_encode($responseData);
		return $jsonResponse;		
	}

   public function returnOk() {
      $this->setHttpHeaders("application/json", 200);
      echo "{\"result\": \"ok\"}";
   }

   public function returnKO($statusCode) {
      $this->setHttpHeaders("application/json", $statusCode);
      echo "{\"result\": \"ko\"}";
   }

   public function parseRequest() {
      try {
         $incidente = new Incidenti();
         switch($_SERVER['REQUEST_METHOD']) {
            // 3 SELECT
            case 'GET': {
               if (isset($_GET['targa'])) {
                  $result = $incidente->getIncidentiTarga($_GET['targa']);
                  $this->setHttpHeaders("application/json", 200);
                  $jsonResponse = $this->encodeJson($result);
                  echo $jsonResponse;
               }
               else if (isset($_GET['codice'])) {
                  $result = $incidente->getVeicoliCoinvolti($_GET['codice']);
                  $this->setHttpHeaders("application/json", 200);
                  $jsonResponse = $this->encodeJson($result);
                  echo $jsonResponse;
               }
               else {
                  $result = $incidente->getIncidenti();
                  $this->setHttpHeaders("application/json", 200);
                  $jsonResponse = $this->encodeJson($result);
                  echo $jsonResponse;
               }
            }
            break;

            // 2 POST
            case 'POST': {
               $data = json_decode(file_get_contents('php://input'), true);
               if (isset($_GET['codice']))
               {
                  if (array_key_exists("data",$data) && array_key_exists("luogo",$data) && array_key_exists("codice",$data)) {
                     $result = $incidente->postSinistro($data);
                     if ($result) {
                        $this->returnOk();
                     } else {
                        $this->returnKO(400);
                     }
                  } else {
                     $this->returnKO(400);
                  }
               }
               if (isset($_GET['targa']))
               {
                  if (array_key_exists("targa",$data) && array_key_exists("codice",$data) && array_key_exists("importo",$data)) {
                     $result = $incidente->postImporto($data);
                     if ($result) {
                        $this->returnOk();
                     } else {
                        $this->returnKO(400);
                     }
                  } else {
                     $this->returnKO(400);
                  }
               }
            }
            break;

            // What should I do????
            /*case 'PUT': {
               if(isset($_GET["id"])) {
                  $result = $todos->completeOne($_GET["id"]);
                  if ($result) {
                     $this->returnOk();
                  } else {
                     $this->returnKO(400);
                  }
               } else {
                  $this->returnKO(400);
               }
            }
            break;
            case 'DELETE': {
               if(isset($_GET["id"])) {
                  $result = $todos->deleteOne($_GET["id"]);
                  if ($result) {
                     $this->returnOk();
                  } else {
                     $this->returnKO(400);
                  }
               } else {
                  $this->returnKO(400);
               }
            }
            break;*/
         } 
      } catch (Exception $e) {
         echo $e->getMessage();
      }
      
   }

}

$restService = new RestService();
$restService->parseRequest();
