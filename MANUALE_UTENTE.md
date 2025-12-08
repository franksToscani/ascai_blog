# 📖 MANUALE UTENTE - ASCAI Bologna

**Guida completa all'utilizzo del sito web dell'Associazione Camerun Ascai Italia**

---

## 📑 Indice

1. [Introduzione](#introduzione)
2. [Area Pubblica](#area-pubblica)
3. [Area Amministrativa](#area-amministrativa)
4. [Gestione Contenuti](#gestione-contenuti)
5. [Impostazioni e Sicurezza](#impostazioni-e-sicurezza)
6. [FAQ e Risoluzione Problemi](#faq-e-risoluzione-problemi)

---

## 🌟 Introduzione

Il sito web ASCAI Bologna è una piattaforma moderna per gestire la presenza online dell'associazione. Permette di:
- Pubblicare notizie e articoli
- Organizzare e promuovere eventi
- Condividere foto nelle gallerie
- Ricevere messaggi dai visitatori
- Gestire contenuti in modo semplice e sicuro

### 🎯 A chi si rivolge questo manuale

- **Visitatori**: Sezione [Area Pubblica](#area-pubblica)
- **Amministratori**: Sezioni [Area Amministrativa](#area-amministrativa) e [Gestione Contenuti](#gestione-contenuti)

---

## 🌍 Area Pubblica

### Homepage

La homepage del sito presenta:

#### 🎨 Hero Carousel (Slider in Alto)
- **3 slide automatiche** che cambiano ogni 5 secondi
- **Frecce laterali** (← →) per navigazione manuale
- **Pallini in basso** per saltare a una slide specifica
- Contenuto:
  - Slide 1: Benvenuto in ASCAI Bologna
  - Slide 2: Eventi e Attività
  - Slide 3: Unisciti a Noi

#### 📰 Ultime News
- Mostra le **3 news più recenti** pubblicate
- Ogni card contiene:
  - Badge "News" azzurro
  - Data di pubblicazione
  - Titolo (cliccabile)
  - Anteprima testo
  - Link "Leggi tutto"

#### 📅 Prossimi Eventi
- Mostra i **3 eventi futuri** più vicini
- Ogni card contiene:
  - Badge "Evento" verde
  - Data inizio evento
  - Titolo (cliccabile)
  - Icona e luogo
  - Anteprima descrizione
  - Link "Scopri di più"

#### 🖼️ Mini Galleria
- Mostra le **8 foto più recenti**
- Griglia 2x4 (mobile 2 colonne, desktop 4 colonne)
- Hover mostra il titolo della foto
- Click porta alla galleria completa

### 🧭 Navigazione Principale

**Header Sticky** (rimane visibile quando scorri):
- **Logo ASCAI** (click torna alla home)
- **Home** 🏠 - Homepage
- **Eventi** 📅 - Lista eventi
- **News** 📰 - Lista articoli
- **Galleria** 🖼️ - Tutte le foto
- **Contatti** 💬 - Form contatti (pulsante evidenziato)

**Menu Mobile** (su smartphone):
- Click sull'icona hamburger (☰) in alto a destra
- Si apre il menu verticale con tutte le voci
- Click fuori dal menu o su una voce per chiuderlo

### 📝 Pagina News

**Lista News**:
- Visualizza tutte le news pubblicate
- **Barra di ricerca** in alto per cercare per titolo
- Card con:
  - Badge status (Draft/Published)
  - Data pubblicazione
  - Titolo e anteprima
  - Link "Leggi tutto"
- **Paginazione** in basso (15 news per pagina)

**Dettaglio News**:
- Titolo completo
- Data pubblicazione
- Testo completo formattato
- Pulsante "Torna alle news"

### 📅 Pagina Eventi

**Lista Eventi**:
- Visualizza tutti gli eventi pubblici e pubblicati
- **Barra di ricerca** per cercare per titolo o luogo
- Card con:
  - Badge "Evento"
  - Data e ora inizio
  - Titolo e luogo (con icona 📍)
  - Anteprima descrizione
  - Link "Scopri di più"
- **Paginazione** (15 eventi per pagina)

**Dettaglio Evento**:
- Titolo completo
- Data e ora inizio/fine
- Luogo dell'evento
- Descrizione completa
- Pulsante "Torna agli eventi"

### 🖼️ Pagina Galleria

- Visualizza tutte le foto pubblicate
- **Griglia responsive**:
  - Mobile: 2 colonne
  - Desktop: 4 colonne
- **Lazy loading**: Le immagini si caricano solo quando scorri
- **Hover effect**: Il titolo appare sopra la foto al passaggio del mouse
- **Paginazione** (12 foto per pagina)

### 💬 Pagina Contatti

**Form di Contatto**:
1. Compila i campi:
   - **Nome** (obbligatorio)
   - **Email** (obbligatorio, deve essere valida)
   - **Oggetto** (obbligatorio)
   - **Messaggio** (obbligatorio)
2. Click su **"Invia Messaggio"**
3. Riceverai una conferma "Messaggio inviato con successo!"

**Protezioni**:
- Puoi inviare **massimo 5 messaggi ogni 24 ore** dallo stesso dispositivo
- Gli amministratori ricevono una **email automatica** per ogni nuovo messaggio

### 👣 Footer (Fondo Pagina)

**Colonna Sinistra - Dove Siamo**:
- Indirizzo sede
- Partita IVA

**Colonna Destra - Contatti**:
- Email
- Link Linktree
- Pulsante "Contattaci"

**Social Media** (icone con colori al passaggio del mouse):
- Facebook (blu)
- Instagram (gradiente arcobaleno)
- TikTok (nero/blu)
- X/Twitter (nero)
- WhatsApp (verde)

**Copyright e Link Admin**:
- Copyright ASCAI Bologna
- Link "Accesso amministratori" (con icona lucchetto 🔒)

---

## 🔐 Area Amministrativa

### Accesso all'Area Admin

1. **Vai alla pagina di login**:
   - Click su "Accesso amministratori" nel footer
   - Oppure vai direttamente a `/login`

2. **Inserisci le credenziali**:
   - Email amministratore
   - Password

3. **Autenticazione a Due Fattori (2FA)** (se attivata):
   - Inserisci il codice dal tuo app di autenticazione

4. **Login riuscito**: Verrai reindirizzato alla Dashboard

### 📊 Dashboard Amministrativa

La dashboard mostra una panoramica rapida:

#### 📈 Statistiche (Card in Alto)
- **News Totali**: Numero di articoli nel database
- **Eventi Totali**: Numero di eventi creati
- **Foto Galleria**: Numero di foto caricate
- **Messaggi Non Letti**: Numero di messaggi da leggere

#### 🔍 Accesso Rapido (Pulsanti)
- **Gestisci News** → Vai a CRUD news
- **Gestisci Eventi** → Vai a CRUD eventi
- **Gestisci Galleria** → Vai a CRUD foto
- **Visualizza Messaggi** → Vedi messaggi contatti

#### 📜 Audit Log (Registro Attività)

**Cosa Mostra**:
- Tutte le azioni degli amministratori
- Tipo di azione: Creazione, Modifica, Eliminazione
- Chi ha fatto l'azione
- Quando è stata fatta
- Su quale elemento (Post, Event, Photo, etc.)

**Filtri Disponibili**:
1. **Tipo di Contenuto**: Tutti, Post, Event, GalleryPhoto, etc.
2. **Azione**: Tutte, created, updated, deleted
3. **Utente**: Tutti gli admin o uno specifico
4. **Periodo**: Da data → A data

**Come Usare i Filtri**:
1. Seleziona i criteri desiderati nei menu a tendina
2. (Opzionale) Inserisci date nel formato `YYYY-MM-DD` (es: 2025-12-08)
3. Click "Filtra"
4. La tabella si aggiornerà con i risultati
5. Click "Reset" per tornare alla vista completa

---

## 📝 Gestione Contenuti

### 📰 Gestione News

#### Vedere Tutte le News

1. Vai a **Dashboard** → **Gestisci News**
   - Oppure clicca "News" nel menu laterale
2. Vedrai la **lista completa** con:
   - Titolo
   - Status (Draft/Published)
   - Data creazione
   - Azioni: Modifica | Elimina

**Barra di Ricerca**:
- Cerca news per titolo
- I risultati si aggiornano automaticamente

**Paginazione**:
- 15 news per pagina
- Usa i numeri in basso per navigare

#### Creare una Nuova News

1. Click **"Crea Nuova News"** (pulsante azzurro in alto)
2. Compila il form:
   - **Titolo** (obbligatorio)
     - Esempio: "ASCAI Bologna organizza torneo di calcio"
   - **Slug** (opzionale)
     - Si genera automaticamente dal titolo
     - Puoi personalizzarlo per URL SEO
     - Esempio: `torneo-calcio-2025`
   - **Excerpt** (Estratto - opzionale)
     - Breve riassunto (max 200 caratteri)
     - Appare nelle card e anteprime
   - **Contenuto** (obbligatorio)
     - Testo completo dell'articolo
     - Usa gli **a capo** per separare i paragrafi
   - **Status**
     - **Draft** (Bozza): Visibile solo agli admin
     - **Published** (Pubblicato): Visibile a tutti
3. Click **"Crea News"**
4. Conferma: "News creata con successo!"

#### Modificare una News

1. Nella lista news, click **"Modifica"** sulla riga della news
2. Il form si apre con i dati attuali
3. Modifica i campi desiderati
4. Click **"Aggiorna News"**
5. Conferma: "News aggiornata con successo!"

**Tip**: Puoi passare da Draft a Published per rendere visibile la news al pubblico.

#### Eliminare una News

1. Nella lista news, click **"Elimina"** sulla riga
2. **Conferma** l'eliminazione nel popup
3. La news viene rimossa dal database
4. Conferma: "News eliminata con successo!"

⚠️ **Attenzione**: L'eliminazione è **permanente** e non può essere annullata!

#### Azioni Inline dalle Pagine Pubbliche

Se sei loggato come admin e visiti la pagina pubblica delle news:
- Vedrai i pulsanti **"Modifica"** e **"Elimina"** su ogni card
- Click "Modifica" → Vai direttamente al form di modifica
- Click "Elimina" → Elimina direttamente (con conferma)

### 📅 Gestione Eventi

#### Vedere Tutti gli Eventi

1. Vai a **Dashboard** → **Gestisci Eventi**
   - Oppure clicca "Eventi" nel menu laterale
2. Vedrai la **lista completa** con:
   - Titolo
   - Data inizio
   - Luogo
   - Status (Draft/Published)
   - Visibilità (Pubblico/Privato)
   - Azioni: Modifica | Elimina

**Barra di Ricerca**:
- Cerca eventi per titolo o luogo

**Paginazione**:
- 15 eventi per pagina

#### Creare un Nuovo Evento

1. Click **"Crea Nuovo Evento"** (pulsante verde in alto)
2. Compila il form:
   - **Titolo** (obbligatorio)
     - Esempio: "Festa della Comunità 2025"
   - **Slug** (opzionale)
     - Si genera automaticamente dal titolo
   - **Descrizione** (obbligatorio)
     - Testo completo con dettagli evento
   - **Luogo** (obbligatorio)
     - Indirizzo completo
     - Esempio: "Via Marconi 10, Bologna"
   - **Data e Ora Inizio** (obbligatorio)
     - Formato: `YYYY-MM-DD HH:MM`
     - Esempio: `2025-12-25 18:00`
   - **Data e Ora Fine** (opzionale)
     - Stesso formato di inizio
   - **Visibilità**
     - ☑️ **Pubblico**: Visibile a tutti
     - ☐ **Privato**: Visibile solo agli admin
   - **Status**
     - **Draft**: Non pubblicato
     - **Published**: Pubblicato
3. Click **"Crea Evento"**
4. Conferma: "Evento creato con successo!"

#### Modificare un Evento

1. Nella lista eventi, click **"Modifica"**
2. Aggiorna i campi desiderati
3. Click **"Aggiorna Evento"**
4. Conferma: "Evento aggiornato con successo!"

#### Eliminare un Evento

1. Click **"Elimina"** sulla riga dell'evento
2. **Conferma** l'eliminazione
3. L'evento viene rimosso
4. Conferma: "Evento eliminato con successo!"

⚠️ **Attenzione**: L'eliminazione è **permanente**!

#### Azioni Inline dalle Pagine Pubbliche

Se sei loggato come admin:
- Vedrai i pulsanti **"Modifica"** e **"Elimina"** su ogni card evento
- Funzionano come nella sezione News

### 🖼️ Gestione Galleria

#### Vedere Tutte le Foto

1. Vai a **Dashboard** → **Gestisci Galleria**
   - Oppure clicca "Galleria" nel menu laterale
2. Vedrai la **griglia di foto** (4 colonne) con:
   - Anteprima immagine
   - Titolo
   - Stato visibilità
   - Data pubblicazione
   - Azioni: Modifica | Elimina (al hover)

**Paginazione**:
- 12 foto per pagina

#### Caricare una Nuova Foto

1. Click **"Carica Nuova Foto"** (pulsante azzurro in alto)
2. Compila il form:
   - **Titolo** (obbligatorio)
     - Esempio: "Torneo di Calcio 2025"
   - **Didascalia** (opzionale)
     - Descrizione più lunga della foto
     - Esempio: "Foto di gruppo finale del torneo"
   - **Immagine** (obbligatorio)
     - Click su **"Scegli File"**
     - Seleziona la foto dal tuo computer
     - Formati supportati: JPG, PNG, GIF, WebP
     - Dimensione massima: 2MB (raccomandato)
   - **Visibile**
     - ☑️ **Sì**: Appare nella galleria pubblica
     - ☐ **No**: Visibile solo agli admin
   - **Data Pubblicazione** (opzionale)
     - Formato: `YYYY-MM-DD HH:MM`
     - Lascia vuoto per usare data/ora corrente
3. Click **"Carica Foto"**
4. Conferma: "Foto caricata con successo!"

**Tip**: Le foto vengono salvate in `storage/app/public/gallery/`

#### Modificare una Foto

1. Nella galleria admin, **hover sulla foto** → Appare "Modifica"
2. Click **"Modifica"**
3. Aggiorna:
   - Titolo
   - Didascalia
   - Visibilità
   - Data pubblicazione
   - (Opzionale) Sostituisci l'immagine caricandone una nuova
4. Click **"Aggiorna Foto"**
5. Conferma: "Foto aggiornata con successo!"

#### Eliminare una Foto

1. **Hover sulla foto** → Appare "Elimina"
2. Click **"Elimina"**
3. **Conferma** l'eliminazione
4. La foto viene rimossa dal database E dal server
5. Conferma: "Foto eliminata con successo!"

⚠️ **Attenzione**: Il file immagine viene **cancellato definitivamente** dal server!

#### Azioni Inline dalla Galleria Pubblica

Se sei loggato come admin e visiti la galleria pubblica:
- **Hover su una foto** → Appaiono i pulsanti "Modifica" e "Elimina"
- Funzionano come nell'area admin

### 💬 Gestione Messaggi Contatti

#### Visualizzare i Messaggi

1. Vai a **Dashboard** → **Visualizza Messaggi**
   - Oppure clicca "Messaggi" nel menu laterale
2. Vedrai la **tabella messaggi** con:
   - Nome mittente
   - Email
   - Oggetto
   - Data invio
   - Status (Non letto / Letto)

**Badge Status**:
- 🔴 **Rosso** = Non letto
- 🟢 **Verde** = Letto

#### Leggere un Messaggio

1. Click su una riga della tabella
2. Si apre il **dettaglio messaggio** con:
   - Nome e email mittente
   - Oggetto
   - Testo completo
   - Data/ora invio
3. Il messaggio viene automaticamente segnato come **"Letto"**
4. Badge diventa verde

#### Rispondere a un Messaggio

1. Copia l'**email del mittente** dal dettaglio
2. Apri il tuo client email (Gmail, Outlook, etc.)
3. Componi una nuova email all'indirizzo copiato
4. Scrivi la risposta

**Tip**: Al momento non c'è una funzione "Rispondi" integrata. Usa il tuo client email.

#### Eliminare un Messaggio

Al momento non è possibile eliminare messaggi dall'interfaccia. Se necessario, contatta l'amministratore di sistema.

---

## ⚙️ Impostazioni e Sicurezza

### 👤 Profilo Utente

1. Click sul **nome utente** in alto a destra (menu admin)
2. Seleziona **"Profilo"**
3. Puoi modificare:
   - Nome
   - Email
   - Password

#### Cambiare Password

1. Vai a **Profilo**
2. Sezione "Aggiorna Password"
3. Inserisci:
   - **Password Attuale**
   - **Nuova Password**
   - **Conferma Nuova Password**
4. Click **"Salva"**
5. Conferma: "Password aggiornata con successo!"

**Requisiti Password**:
- Minimo 8 caratteri
- Almeno una lettera maiuscola
- Almeno una lettera minuscola
- Almeno un numero

### 🔐 Autenticazione a Due Fattori (2FA)

#### Attivare il 2FA

1. Vai a **Profilo** → Sezione "Two Factor Authentication"
2. Click **"Attiva"**
3. Scansiona il **QR Code** con un'app di autenticazione:
   - Google Authenticator
   - Microsoft Authenticator
   - Authy
4. Inserisci il **codice a 6 cifre** generato dall'app
5. Click **"Conferma"**
6. **Salva i Recovery Codes** in un luogo sicuro
   - Usa questi codici se perdi l'accesso all'app
7. 2FA attivo! ✅

#### Disattivare il 2FA

1. Vai a **Profilo** → Sezione "Two Factor Authentication"
2. Click **"Disattiva"**
3. Inserisci il **codice a 6 cifre** dall'app
4. Click **"Conferma"**
5. 2FA disattivato

⚠️ **Raccomandazione**: Tieni il 2FA sempre **attivo** per maggiore sicurezza!

### 🚪 Logout

1. Click sul **nome utente** in alto a destra
2. Seleziona **"Logout"**
3. Verrai disconnesso e reindirizzato alla homepage pubblica

**Tip**: Fai sempre logout quando usi un computer condiviso!

---

## ❓ FAQ e Risoluzione Problemi

### Domande Frequenti

#### 🔹 "Non riesco a fare login"

**Soluzione**:
1. Verifica di aver inserito l'email corretta
2. Controlla che la password sia corretta (maiuscole/minuscole)
3. Se hai il 2FA attivo, verifica il codice dell'app
4. Prova a usare la funzione **"Password Dimenticata"**:
   - Click su "Forgot your password?" nella pagina login
   - Inserisci la tua email
   - Riceverai un link per reimpostare la password

#### 🔹 "Ho perso l'accesso all'app 2FA"

**Soluzione**:
1. Usa uno dei **Recovery Codes** salvati durante l'attivazione
2. Se non hai i Recovery Codes, contatta l'amministratore di sistema

#### 🔹 "L'immagine caricata non si vede"

**Possibili Cause**:
1. File troppo grande (max 2MB)
2. Formato non supportato (usa JPG, PNG, GIF, WebP)
3. Symbolic link mancante

**Soluzione**:
- Riduci le dimensioni dell'immagine
- Converti in un formato supportato
- Contatta l'amministratore se il problema persiste

#### 🔹 "Non riesco a inviare un messaggio dal form contatti"

**Possibile Causa**: Hai superato il limite di 5 messaggi in 24 ore

**Soluzione**:
- Aspetta 24 ore dal primo messaggio inviato
- Oppure contatta ASCAI via email diretta o telefono

#### 🔹 "La mia news non appare sul sito pubblico"

**Possibili Cause**:
1. Status è "Draft" invece di "Published"
2. Non hai salvato le modifiche

**Soluzione**:
1. Vai a **Gestisci News** → **Modifica** la news
2. Cambia Status da "Draft" a **"Published"**
3. Click **"Aggiorna News"**

#### 🔹 "L'evento non appare sul sito pubblico"

**Possibili Cause**:
1. Status è "Draft"
2. Visibilità è "Privato" (checkbox non selezionata)
3. Data inizio è nel passato (eventi passati sono in fondo alla lista)

**Soluzione**:
1. Vai a **Gestisci Eventi** → **Modifica** l'evento
2. Verifica:
   - Status = **"Published"**
   - Checkbox **"Pubblico"** = ☑️ selezionato
   - Data inizio corretta
3. Click **"Aggiorna Evento"**

#### 🔹 "La ricerca non trova i miei contenuti"

**Possibile Causa**: La ricerca cerca solo nel titolo (news) o titolo/luogo (eventi)

**Soluzione**:
- Verifica che la parola cercata sia nel titolo
- Per news: la ricerca non cerca nel contenuto, solo nel titolo
- Per eventi: la ricerca cerca in titolo e luogo

#### 🔹 "Non vedo le statistiche aggiornate in dashboard"

**Soluzione**:
- Ricarica la pagina (F5 o Ctrl+R)
- Le statistiche si aggiornano a ogni caricamento della dashboard

#### 🔹 "L'Audit Log è vuoto"

**Possibili Cause**:
1. Hai applicato filtri troppo restrittivi
2. Non sono state fatte azioni recenti

**Soluzione**:
1. Click **"Reset"** per rimuovere tutti i filtri
2. Verifica che ci siano azioni registrate (crea/modifica/elimina qualcosa)

### Problemi Tecnici Comuni

#### 🔧 "Errore 500 - Internal Server Error"

**Cosa Significa**: Errore del server

**Soluzione**:
1. Ricarica la pagina
2. Se persiste, contatta l'amministratore di sistema
3. Fornisci:
   - Cosa stavi facendo quando è apparso l'errore
   - Screenshot dell'errore (se possibile)
   - Data e ora

#### 🔧 "Errore 404 - Page Not Found"

**Cosa Significa**: Pagina non trovata

**Soluzione**:
1. Verifica l'URL nella barra indirizzi
2. Torna alla homepage e naviga da lì
3. Se il link è interno al sito, segnala l'errore all'amministratore

#### 🔧 "Errore 403 - Forbidden"

**Cosa Significa**: Non hai i permessi per accedere a quella pagina

**Soluzione**:
1. Verifica di aver fatto login come amministratore
2. Se sei già loggato, potresti non avere i permessi necessari
3. Contatta l'amministratore di sistema

#### 🔧 "Il caricamento delle immagini è lento"

**Soluzione**:
- È normale: le immagini hanno il **lazy loading** attivo
- Si caricano solo quando scorri fino a loro (risparmia banda)
- Se la connessione è lenta, aspetta qualche secondo

### Segnalazione Bug

Se trovi un problema non elencato qui:

1. **Raccogli le informazioni**:
   - Descrizione del problema
   - Cosa stavi facendo
   - Browser usato (Chrome, Firefox, Safari, etc.)
   - Screenshot (se possibile)
   - Data e ora

2. **Contatta l'amministratore di sistema** via email o telefono

3. L'amministratore analizzerà il problema e ti fornirà una soluzione

---

## 📞 Contatti e Supporto

### Supporto Tecnico

Per assistenza sull'utilizzo del sito web:

- **Email**: admin@ascai.it
- **Telefono**: [Inserire numero]

### Supporto ASCAI Bologna

Per informazioni sull'associazione:

- **Email**: info@ascai.it
- **Linktree**: [Link nel footer]
- **Social Media**: Facebook, Instagram, TikTok, X, WhatsApp

---

## 📚 Risorse Aggiuntive

### Link Utili

- **Sito Pubblico**: https://www.ascai.it
- **Repository GitHub**: https://github.com/franksToscani/ascai_blog
- **README Tecnico**: Vedi file `README.md` per dettagli sviluppo

### Credenziali di Test (Solo Ambiente di Sviluppo)

```
Admin ASCAI:
  Email: admin@ascai.it
  Password: [Contatta amministratore]

Test Admin:
  Email: testadmin@ascai.it
  Password: password
```

⚠️ **Attenzione**: NON usare queste credenziali in produzione!

---

## 📝 Note Finali

### Versione Manuale
- **Versione**: 1.0
- **Data**: Dicembre 2025
- **Ultimo Aggiornamento**: 08/12/2025

### Changelog
- **v1.0** (08/12/2025): Versione iniziale del manuale con tutte le funzionalità Sprint 1

### Convenzioni Usate in Questo Manuale

- 🔹 = Domanda frequente
- 🔧 = Problema tecnico
- ⚠️ = Attenzione / Avviso importante
- **Grassetto** = Azioni / Pulsanti da cliccare
- `Codice` = Valori da inserire / Formati
- ☑️ = Checkbox da selezionare
- ☐ = Checkbox non selezionata

---

**© 2025 ASCAI Bologna - Tutti i diritti riservati**

*Questo manuale è stato creato per facilitare l'utilizzo del sito web dell'Associazione Camerun Ascai Italia. Per suggerimenti o correzioni, contatta l'amministratore di sistema.*
