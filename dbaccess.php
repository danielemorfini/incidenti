<?php
   class DbAccess {

      private function connect() {
         $servername = "localhost";
         $database = "incidenti";
         $username = "root";
         $password = "";
         $conn = mysqli_connect($servername, $username, $password, $database);
         if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
         }
         return $conn;
      } 

      private function close($conn) {
         mysqli_close($conn);
      }

      public function selectIncidenti() {
         $sql = "select id, data, luogo, codice from sinistro;";
         $conn = $this->connect();
         $result = mysqli_query($conn, $sql);
         $list = array();
         while ($row = $result->fetch_assoc()) {
            $sinistro = [
               'id' => $row['id'],
               'data' => $row['data'],
               'luogo' => $row['luogo'],
               'codice' => $row['codice'],
            ];
            $list[] = $sinistro;
         }
         $this->close($conn);
         return $list;
      }

      public function selectVeicoliCoinvolti($codice) {
         $sql = <<<SQL
            select targa, luogo, data, codice
            from mezzo, sinistro, veicolo_coinvolto
            
            where mezzo.id=veicolo_coinvolto.id_mezzo
            and sinistro.id=veicolo_coinvolto.id_sinistro 
            and sinistro.codice="$codice";
         SQL;
         $conn = $this->connect();
         $result = mysqli_query($conn, $sql);
         $list = array();
         while ($row = $result->fetch_assoc()) {
            $sinistro = [
               'targa' => $row['targa'],
               'luogo' => $row['luogo'],
               'data' => $row['data'],
               'codice' => $row['codice'],
            ];
            $list[] = $sinistro;
         }
         $this->close($conn);
         return $list;
      }

      public function selectIncidentiTarga($targa) {
         $sql = <<<SQL
            select targa, codice, data, luogo, importo
            from mezzo, sinistro, veicolo_coinvolto
            
            where mezzo.id=veicolo_coinvolto.id_mezzo
            and sinistro.id=veicolo_coinvolto.id_sinistro
            and mezzo.targa="$targa";
         SQL;
         $conn = $this->connect();
         $result = mysqli_query($conn, $sql);
         $list = array();
         while ($row = $result->fetch_assoc()) {
            $sinistro = [
               'targa' => $row['targa'],
               'codice' => $row['codice'],
               'data' => $row['data'],
               'luogo' => $row['luogo'],
               'importo' => $row['importo'],
            ];
            $list[] = $sinistro;
         }
         $this->close($conn);
         return $list;
      }

      public function insertSinistro($data, $luogo, $codice) {
         $sqldata = date("Y-m-d", strtotime($data));
         $sql = <<<SQL
            insert into sinistro (data, luogo, codice)
            values ('$sqldata', '$luogo', '$codice');
         SQL;
         $conn = $this->connect();
         $result = mysqli_query($conn, $sql);
         $this->close($conn);
         return $result;
      }

      public function insertImporto($targa, $codice, $importo) {
         $sql = <<<SQL
            insert into veicolo_coinvolto (id_mezzo, id_sinistro, importo) 
            values ( 
               (select id from mezzo where targa='$targa'), 
               (select id from sinistro where codice='$codice'), 
               $importo
            );
         SQL;
         $conn = $this->connect();
         $result = mysqli_query($conn, $sql);
         $this->close($conn);
         return $result;
      }
   }
?> 