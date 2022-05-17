class Middleware {
   constructor() {
      this.url = 'http://localhost/public_html/rest/incidenti/restmiddleware.php';
   }

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

   createSinistro(sinistro, codice, callback) {
      const body = JSON.stringify(sinistro);
      const url = this.url + '?codice=' + codice;
      this.connect(url, 'POST', body, () => {
         this.readSinistro(callback);
      })
      callback(); 
   }

   createImporto(importo, targa, callback) {
      const body = JSON.stringify(importo);
      console.log(body);
      const url = this.url + '?targa=' + targa;
      this.connect(url, 'POST', body, () => {
         this.readSinistro(callback);
      })
      callback(); 
   }
   



   readSinistro(callback) {
      let action = (response) => {
         const data = JSON.parse(response);
         callback(data);
      };
      this.connect(this.url, 'GET', null, action);
   }

   readCodice(codice, callback) {
      let action = (response) => {
         const data = JSON.parse(response);
         callback(data);
      };
      const url = this.url + '?codice=' + codice;
      this.connect(url, 'GET', null, action);
   }

   readTarga(targa, callback) {
      let action = (response) => {
         const data = JSON.parse(response);
         callback(data);
      };
      const url = this.url + '?targa=' + targa;
      this.connect(url, 'GET', null, action);
   }
}