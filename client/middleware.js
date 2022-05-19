class Middleware {
   constructor() {
      this.url = 'http://localhost/public_html/rest/incidenti/restmiddleware.php';
   }

   // Funzione che gestisce la connessione al rest-middleware (AJAX)
   connect(url, method, body, callback) {
      const xhr = new XMLHttpRequest();
      xhr.open(method, url);
      let manageResponse = () => {
         if (xhr.status != 200) { 
            alert(`Error ${xhr.status}: ${xhr.statusText}`); 
          } else { 
            callback(xhr.response);
          }
      }
      xhr.onload = manageResponse;
      xhr.send(body);  
   }

   // Funzione che spedisce l'oggetto contenente i dati del SINISTRO
   createSinistro(sinistro, codice, callback) {
      const body = JSON.stringify(sinistro);

      // Modifica URL per garantire un corretto trasferimento dell'oggetto
      const url = this.url + '?codice=' + codice;
      this.connect(url, 'POST', body, () => {
         this.readSinistro(callback);
      })
      callback(); 
   }

   // Funzione che spedisce l'oggetto contenente i dati dell'IMPORTO
   createImporto(importo, targa, callback) {
      const body = JSON.stringify(importo);
      console.log(body);

      // Modifica URL per garantire un corretto trasferimento dell'oggetto
      const url = this.url + '?targa=' + targa;
      this.connect(url, 'POST', body, () => {
         this.readSinistro(callback);
      })
      callback(); 
   }

   // Funzione che richiede, attraverso metodo GET, un oggetto contenente
   // tutti i dati riguardanti i SINISTRI
   readSinistro(callback) {
      let action = (response) => {
         const data = JSON.parse(response);
         callback(data);
      };
      this.connect(this.url, 'GET', null, action);
   }

   // Funzione che richiede, attraverso metodo GET, un oggetto contenente
   // i dati dei veicoli coinvolti in un certo incidente
   readCodice(codice, callback) {
      let action = (response) => {
         const data = JSON.parse(response);
         callback(data);
      };

      // Modifica URL per garantire un corretto trasferimento
      const url = this.url + '?codice=' + codice;
      this.connect(url, 'GET', null, action);
   }

   // Funzione che richiede, attraverso metodo GET, un oggetto contenente
   // i dati dei sinistri in cui e' coinvolta una targa
   readTarga(targa, callback) {
      let action = (response) => {
         const data = JSON.parse(response);
         callback(data);
      };

      // Modifica URL per garantire un corretto trasferimento
      const url = this.url + '?targa=' + targa;
      this.connect(url, 'GET', null, action);
   }
}