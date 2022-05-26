# Incidenti stradali #
Progetto atto a simulare un sistema di gestione dell'anagrafica degli incidenti stradali di una piccola cittadina

**Funzionalita' previste:**
  - Inserimento di un incidente comprensivo dei veicoli coinvolti (almeno 1)
  - Inserimento, per un dato incidente, dell'ammontare del danno per ogni veicolo
  - Visualizzazione in tempo reale dell'elenco degli incidenti
  - Visualizzazione dell'elenco dei veicoli coinvolti in un incidente stradale
  - Visualizzazione di tutti gli incidenti in cui è coinvolta una certa targa

# Linguaggi e tecnologie utilizzati per lo sviluppo: #
  - **Frontend**: HTML, CSS
  - **Logica CLIENT**: JavaScript
  - **Logica SERVER, Backend**: PHP
  - **Ambiente di testing**: XAMPP, EasyPHP

# Modello architetturale: REST #
Representational state transfer (REST) è uno stile architetturale per sistemi distribuiti.
Il termine REST rappresenta un sistema di trasmissione di dati su HTTP senza ulteriori livelli, 
il sistema non prevede il concetto di sessione, è quindi stateless.
La comunicazione tra Client e Server avviene attraverso i pricipali metodi HTTP quali GET, POST, PUT, DELETE


# Step da seguire per un corretto inserimento #
Inserimento sinistro CON importo:
1. Data, luogo e codice     <> Invia Sinistro
2. Targa, codice, importo   <> Invia Importo

Inserimento sinistro con piu mezzi e importi:
1. Data, luogo e CODICE_UGUALE     <> Invia Sinistro
2. Targa, CODICE_UGUALE, importo   <> Invia Importo
3. Targa, CODICE_UGUALE, importo   <> Invia Importo
4. Targa, CODICE_UGUALE, importo   <> Invia Importo
5. Inserire per N volte quante necessarie
