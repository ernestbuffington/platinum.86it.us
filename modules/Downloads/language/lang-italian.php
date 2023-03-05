<?php
/**************************************************************************/
/* PHP-NUKE: Advanced Content Management System                           */
/* ============================================                           */
/*                                                                        */
/* This is the language module with all the system messages               */
/*                                                                        */
/* If you made a translation please post it in the forums at              */
/* www.ravenphpscripts.com                                                */
/*                                                                        */
/*                                                                        */
/* You need to change the second quoted phrase, not the capital one!      */
/*                                                                        */
/*                                                                        */
/*                                                                        */
/*                                                                        */
/*                                                                        */
/*                                                                        */
/**************************************************************************/

global $anonwaitdays, $outsidewaitdays, $sitename;
//if (!defined('_DATE')) define('_DATE','Data');
//if (!defined('_OF')) define('_OF','di');
define('_1WEEK','1 settimana');
define('_2WEEKS','2 settimane');
define('_30DAYS','30 giorni');
define('_ADDADOWNLOAD','Aggiungi un nuovo download');
define('_ADDDOWNLOAD','Aggiungi un download');
define('_ADDEDON','Aggiunto il');
define('_ADDITIONALDET','Dettagli aggiuntivi');
define('_ADDTHISFILE','Aggiungi questo file');
define('_ALLOWTORATE','Permetti agli altri utenti di votarla dal tuo sito web!');
define('_AND','e');
define('_AUTHOR','Autore');
define('_AUTHOREMAIL','Email dell\'autore');
define('_AUTHORNAME','Nome dell\'autore');
define('_BREAKDOWNBYVAL','Riassunto dei voti per valore');
define('_BUTTONLINK','Button Link');
define('_CATEGORIES','Categorie');
if (!defined('_CATEGORY')) define('_CATEGORY','Categoria');
define('_CHECKFORIT','Non hai inserito una Email. Comunque controlleremo presto il tuo link');
define('_COMPLETEVOTE1','Il tuo voto &egrave; gradito.');
define('_COMPLETEVOTE2','Hai gi&agrave; votato per questo argomento nei precedenti ' . $anonwaitdays . ' giorni.');
define('_COMPLETEVOTE3','Vota per un argomento solo una volta.<br>Tutti i voti sono registrati e valutati.');
define('_COMPLETEVOTE4','Non puoi votare un link inserito da te.<br>Tutti i voti sono registrati e valutati.');
define('_COMPLETEVOTE5','Nessuna valutazione selezionata - Nessun voto espresso');
define('_COMPLETEVOTE6','Solo un voto per indirizzo IP &egrave; permesso ogni ' . $outsidewaitdays . ' giorni.');
define('_DAYS','giorni');
define('_DBESTRATED','Download meglio valutati - Top');
define('_DCATLAST3DAYS','Nuovi download in questa categoria aggiunti negli ultimi 3 giorni');
define('_DCATNEWTODAY','Nuovi download in questa categoria aggiunti oggi');
define('_DCATTHISWEEK','Nuovi download in questa categoria aggiunti questa settimana');
define('_DDATE1','Data (vecchi prima)');
define('_DDATE2','Data (nuovi prima)');
define('_DESCRIPTION','Descrizione');
define('_DETAILS','Dettagli');
define('_DLETSDECIDE','L\'input degli utenti pu&ograve; aiutare gli altri visitatori a scegliere facilmente il miglior file da scaricare.');
define('_DONLYREGUSERSMODIFY','Solo gli utenti registrati possono suggerire modifiche ai download. Per favore <a href="modules.php?name=Your_Account">registrati od esegui il login</a>.');
define('_DOWNLOADALREADYEXT','ERRORE: questo URL &egrave; gi&agrave; inserito nel database!');
define('_DOWNLOADCOMMENTS','Commenti');
define('_DOWNLOADID','ID Download');
define('_DOWNLOADNAME','Nome programma');
define('_DOWNLOADNODESC','ERRORE: devi inserire una DESCRIZIONE per il tuo URL!');
define('_DOWNLOADNOEMAIL','ERRORE: devi inserire un indirizzo EMAIL valido!');
define('_DOWNLOADNOTITLE','ERRORE: devi inserire un TITOLO per il tuo URL!');
define('_DOWNLOADNOURL','ERRORE: devi inserire un URL!');
define('_DOWNLOADNOW','Scarica questo file ora!');
define('_DOWNLOADPROFILE','Profilo');
define('_DOWNLOADRATING','Voto');
define('_DOWNLOADRATINGDET','Dettaglio voti');
define('_DOWNLOADRECEIVED','Abbiamo regolarmente ricevuto la tua segnalazione. Grazie!');
define('_DOWNLOADS','Download');
define('_DOWNLOADSMAIN','Indice Download');
define('_DOWNLOADSMAINCAT','Indice categorie Download');
define('_DOWNLOADSNOTUSER1','Non sei registrato o non ti sei fatto riconoscere dal sistema.');
define('_DOWNLOADSNOTUSER2','Dopo la registrazione potrai aggiungere dei download in questo sito.');
define('_DOWNLOADSNOTUSER3','Diventare utente registrato &egrave; semplice, veloce e gratuito.');
define('_DOWNLOADSNOTUSER4','Perch&egrave; vi richiediamo la registrazione per l\'accesso ad alcuni servizi?');
define('_DOWNLOADSNOTUSER5','Solo cos&igrave; possiamo garantire una maggiore qualit&agrave; dei contenuti,');
define('_DOWNLOADSNOTUSER6','ogni aggiunta viene individualmente verificata e, se corrispondente ai nostri criteri, approvata dal nostro staff.');
define('_DOWNLOADSNOTUSER7','Cerchiamo di offrire solo informazioni veritiere e utili.');
define('_DOWNLOADSNOTUSER8','<a href="modules.php?name=Your_Account">Registrati</a>');
define('_DOWNLOADVOTE','Vota!');
define('_DPOSTPENDING','Tutti i download inseriti devono essere verificati.');
define('_DRATENOTE4','Puoi vedere la lista dei <a href="modules.php?name=Downloads&amp;d_op=TopRated">Top Download</a>.');
define('_DSUBMITONCE','Inserisci un download solo una volta.');
define('_DTOTALFORLAST','Totale nuovi download negli ultimi');
define('_EDITORIAL','Editoriale');
define('_EDITORIALBY','Editoriale di');
define('_EDITORREVIEW','Recensione Editore');
define('_EDITTHISDOWNLOAD','Modifica questo download');
define('_FEELFREE2ADD','Aggiungi i commenti che vuoi in questo sito.');
define('_FILESIZE','Dimensione file');
define('_FILEURL','File Link');
define('_HIGHRATING','Voto migliore');
define('_HOMEPAGE','Homepage');
define('_HTMLCODE1','Il codice HTML da usare in questo caso &egrave; il seguente:');
define('_HTMLCODE2','Il codice relativo &egrave;:');
define('_HTMLCODE3','Usando questo form si abilitano gli utenti a dare un giudizio direttamente dal proprio sito che viene da noi registrato. Il form di cui sopra &egrave; disabilitato, ma il seguente codice funziona perfettamente eseguendo un taglia e incolla sulle proprie pagine. Di seguito viene mostrato il codice:');
define('_IDREFER','in the HTML source references your site\'s ID number in '.$sitename.' database. Be sure this number is present.');
define('_IFYOUWEREREG','Quando sarai registrato potrai inviare tutti i commenti che vorrai in questo sito.');
define('_INBYTES','in byte');
define('_INDB','nel nostro database');
define('_INOTHERSENGINES','in altri Motori di Ricerca');
define('_INSTRUCTIONS','Istruzioni');
define('_ISTHISYOURSITE','Questa risorsa &egrave; tua?');
define('_LAST30DAYS','Ultimi 30 giorni');
define('_LASTWEEK','Ultima settimana');
define('_LDESCRIPTION','Descrizione: (255 caratteri max)');
define('_LINKSDATESTRING','%d-%b-%Y');
define('_LOOKTOREQUEST','Esamineremo presto la tua richiesta.');
define('_LOWRATING','Voto peggiore');
define('_LTOTALVOTES','voti totali');
define('_LVOTES','voti');
define('_MAIN','Principale');
define('_MODIFY','Modifica');
define('_MOSTPOPULAR','Popolari - Top');
define('_NEW','Nuovi');
define('_NEWDOWNLOADS','Nuovi download');
define('_NEWLAST3DAYS','Nuovo ultimi 3 giorni');
define('_NEWTHISWEEK','Nuovo questa settimana');
define('_NEWTODAY','Nuovo oggi');
define('_NEXT','Pagina successiva');
define('_NOEDITORIAL','Nessun editoriale disponibile attualmente per questo sito.');
define('_NOMATCHES','Nessun risultato per la tua ricerca');
define('_NOOUTSIDEVOTES','nessun voto esterno');
define('_NOREGUSERSVOTES','Nessun voto da utenti registrati');
define('_NOUNREGUSERSVOTES','Nessun voto da utenti anonimi');
define('_NUMBEROFRATINGS','Numero di voti');
define('_NUMOFCOMMENTS','Numero di commenti');
define('_NUMRATINGS','# di valutazioni');
define('_OFALL','di tutti');
define('_OUTSIDEVOTERS','Votanti esterni');
define('_OVERALLRATING','Giudizio globale');
define('_POPULAR','Popolari');
define('_POPULARITY','Popolarit&agrave;');
define('_POPULARITY1','Popolarit&agrave; (da meno a pi&ugrave; Hit)');
define('_POPULARITY2','Popolarit&agrave; (da pi&ugrave; a meno Hit)');
define('_PREVIOUS','Pagina precedente');
define('_PROMOTE01','Se desideri promuovere efficacemente il tuo Sito, probabilmente sarai interessato a uno dei nostri svariati metodi di votazione a distanza che ti mettiamo a disposizione. Questi in pratica abilitano, sistemando una immagine (o un form di votazione) sul tuo sito, gli utenti a votarti direttamente da li incrementando il numero di voti ricevuti e quindi la visibilit&agrave; nella nostra directory con relativo aumento di click ricevuti. Scegli tra uno dei metodi illustrati sotto:');
define('_PROMOTE02','Un modo per linkare il form di votazione &egrave; attraverso un semplice link testuale:');
define('_PROMOTE03','Se vuoi un p&ograve; di pi&ugrave; che un semplice e basilare link testuale, puoi scegliere di inserire un piccolo pulsante:');
define('_PROMOTE04','Abusi a questo sistema comportano la rimozione del link dal nostro database. Tienilo presente. Ecco come appare il corrente form di votazione a distanza.');
define('_PROMOTE05','Grazie! e buona fortuna!');
define('_PROMOTEYOURSITE','Promote Your Website');
define('_RATEIT','Rate this Site!');
define('_RATENOTE1','Non votare per la stessa risorsa pi&ugrave; di una volta, grazie.');
define('_RATENOTE2','La scala &egrave; 1 - 10, dove 1 significa pessimo e 10 significa eccellente.');
define('_RATENOTE3','Sii il pi&ugrave; obiettivo possibile nel voto, se ogni risorsa ricevesse un 1 od un 10, i voti non sarebbero molto utili.');
define('_RATENOTE5','Non votare da solo per il tuo sito o per quello dei tuoi concorrenti diretti, grazie.');
define('_RATERESOURCE','Vota Risorsa');
define('_RATETHISSITE','Vota per questa risorsa');
define('_RATING','Giudizio');
define('_RATING1','Giudizio (dal pi&ugrave; basso al pi&ugrave; alto)');
define('_RATING2','Giudizio (dal pi&ugrave; alto al pi&ugrave; basso)');
define('_REGISTEREDUSERS','Utenti registrati');
define('_REMOTEFORM','Form votazione remota');
define('_REPORTBROKEN','Segnala link errato');
define('_REQUESTDOWNLOADMOD','Richiedi modifiche al download');
define('_RESSORTED','Risorse correntemente ordinate per');
define('_RETURNTO','Ritorna a');
define('_SCOMMENTS','Commenti');
define('_SEARCHRESULTS4','Risultati della ricerca di');
define('_SECURITYBROKEN','Per ragioni di sicurezza il tuo nome utente e l\'indirizzo IP possono anche essere temporaneamente registrate.');
define('_SELECTPAGE','Seleziona pagina');
define('_SENDREQUEST','Invia richiesta');
define('_SHOW','Mostra');
define('_SHOWTOP','Mostra Top');
define('_SORTDOWNLOADSBY','Ordina download per');
define('_STAFF','Staff');
define('_TEXTLINK','Link di testo');
define('_THANKSBROKEN','Grazie per l\'aiuto a mantenere l\'integrit&agrave; di questa directory.');
define('_THANKSFORINFO','Grazie per l\'informazione.');
define('_THANKSTOTAKETIME','Grazie per aver speso un p&ograve; del tuo tempo per votare un sito qui su');
define('_THENUMBER','Il Numero');
define('_THEREARE','Ci sono');
define('_TITLE','Titolo');
define('_TITLEAZ','Titolo (da A a Z)');
define('_TITLEZA','Titolo (da Z a A)');
define('_TO','a');
define('_TOPRATED','Top');
define('_TOTALNEWDOWNLOADS','Totale nuovi download');
define('_TOTALOF','Totale di');
define('_TOTALVOTES','Voti totali:');
define('_TRATEDDOWNLOADS','totale download votati');
define('_TRY2SEARCH','Prova a cercare');
define('_TVOTESREQ','numero minimo di voti richiesto');
define('_UNKNOWN','Sconosciuto');
define('_UNREGISTEREDUSERS','Utenti anonimi');
define('_URL','URL');
define('_USER','Utente');
define('_USERANDIP','Nome utente ed IP vengono registrati, quindi non abusare del sistema.');
define('_USERAVGRATING','Giudizio medio utenti');
define('_USUBCATEGORIES','Sottocategorie');
define('_VERSION','Versione');
define('_VOTE4THISSITE','Vota per questo sito!');
define('_WEIGHNOTE','* NOTA: il sito valuta i voti degli utenti registrati con quelli degli anonimi');
define('_WEIGHOUTNOTE','* Note: This Resource weighs Registered vs. Outside voters ratings');
define('_YOUARENOTREGGED','Non sei un Utente Registrato oppure non ti sei fatto riconoscere dal sistema.');
define('_YOUAREREGGED','Sei un Utente Registrato e correttamente riconosciuto dal sistema.');

?>
