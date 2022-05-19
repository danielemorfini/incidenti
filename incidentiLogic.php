<?php
   require_once("dbaccess.php");

   class Incidenti {

      private $db;

      // Select
      public function getIncidenti() {
         $db = new DbAccess();
         $list = $db->selectIncidenti(); 
         return $list;
      }

      // Select
      public function getVeicoliCoinvolti($codice) {
         $db = new DbAccess();
         $list = $db->selectVeicoliCoinvolti($codice);
         return $list;
      }

      // Select
      public function getIncidentiTarga($targa) {
         $db = new DbAccess();
         $list = $db->selectIncidentiTarga($targa);
         return $list;
      }

      // Insert
      public function postSinistro($sinistro) {
         $db = new DbAccess();
         $result = $db->insertSinistro(
                           $sinistro['data'], 
                           $sinistro['luogo'],
                           $sinistro['codice']
         );
         return $result;
      }

      // Insert
      public function postImporto($importo) {
         $db = new DbAccess();
         $result = $db->insertImporto(
                           $importo['targa'], 
                           $importo['codice'],
                           $importo['importo']
         );
         return $result;
      }
   }
?>