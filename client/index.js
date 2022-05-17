class Presenter {
   constructor() {
      this.init();
      this.middleware = new Middleware();
      this.middleware.readSinistro(this.refresh);
   }

   init() {
      let cTime = new Date(); // currentTime
      document.querySelector("#data").value = cTime.toISOString().split('T')[0];
      document.querySelector("#time").value = `${cTime.getHours()}:${cTime.getMinutes()}`;
      

      document.querySelector("#sendSinistro").addEventListener('click', () => {
         this.addSinistro();
      });

      document.querySelector("#sendImporto").addEventListener('click', () => {
         this.addImporto();
      });


      document.querySelector("#getIncidenti").addEventListener('click', () => {
         this.middleware.readSinistro(this.refresh);
      });

      document.querySelector("#getVeicoliCoinvolti").addEventListener('click', () => {
         let codice = prompt("Inserire codice del sinistro");
         this.middleware.readCodice(codice, this.refresh);
      });

      document.querySelector("#getIncidentiTarga").addEventListener('click', () => {
         let targa = prompt("Inserire targa del mezzo");
         this.middleware.readTarga(targa, this.refresh);
      });
   }

   refreshForm() {
      let cTime = new Date(); // currentTime
      document.querySelector("#data").value = cTime.toISOString().split('T')[0];
      document.querySelector("#time").value = `${cTime.getHours()}:${cTime.getMinutes()}`;
      document.querySelector("#luogo").value = "";
      document.querySelector("#codice").value = "";
      document.querySelector("#targa").value = "";
      document.querySelector("#codice").value = "";
      document.querySelector("#importo").value = "";
   }

   addSinistro() {
      const sinistro = { // data, luogo, codice
         data: document.querySelector("#data").value,
         luogo: document.querySelector("#luogo").value,
         codice: document.querySelector("#codice").value
      }
      this.refreshForm();
      this.middleware.createSinistro(sinistro, sinistro.codice, this.refresh);
   }

   addImporto() {
      const importo = { // data, luogo, codice
         targa: document.querySelector("#targa").value,
         codice: document.querySelector("#codice").value,
         importo: document.querySelector("#importo").value
      }
      this.refreshForm();
      this.middleware.createImporto(importo, importo.targa, this.refresh);
   
   }

   refresh(list) {
      console.log(list);
      
      let template = `
         <tr>
            <td>%ID</td>
            <td>%DATA</td>
            <td>%LUOGO</td>
            <td>%CODICE</td>
         </tr>
      `;
      let html = "";

      list.forEach(element => {
         let date = new Date(element.data);

         let row = template;
         row = row.replace("%ID", element.id ?? element.targa);
         row = row.replace("%DATA", date.toLocaleDateString());
         row = row.replace("%LUOGO", element.luogo);
         row = row.replace("%CODICE", element.codice);
         html += row;
      });

      document.querySelector('tbody').innerHTML = html;
   }
}

let presenter;
window.addEventListener('load', () => {
   presenter = new Presenter();
})

