<?php
/**************************************************************************/
/* PHP-NUKE: Advanced Content Management System						*/
/* ============================================						*/
/*														*/
/* This is the language module with all the system messages					*/
/*														*/
/* If you make a translation, please post them in the forums at					*/
/* www.ravenphpscripts.com										*/
/*														*/
/*														*/
/* You need to change the second quoted phrase, not the capitalised one			*/
/*														*/
/*														*/
/*														*/
/*														*/
/*														*/
/*														*/
/**************************************************************************/
global $anonwaitdays, $outsidewaitdays, $sitename;
//if (!defined('_DATE')) define('_DATE','Datum');
//if (!defined('_OF')) define('_OF','von');
define('_1WEEK','1 Woche');
define('_2WEEKS','2 Wochen');
define('_30DAYS','30 Tage');
define('_ADDADOWNLOAD','Neuen Download hinzuf&uuml;gen');
define('_ADDDOWNLOAD','Download hinzuf&uuml;gen');
define('_ADDEDON','Eingetragen am');
define('_ADDITIONALDET','Weitere Details');
define('_ADDTHISFILE','Datei hinzuf&uuml;gen');
define('_ALLOWTORATE','Erm&ouml;glichen Sie ihren Besuchern das Bewerten Ihrer Seite!');
define('_AND','und');
define('_AUTHOR','Autor');
define('_AUTHOREMAIL','eMail des Autors');
define('_AUTHORNAME','Name des Autors');
define('_BREAKDOWNBYVAL','Breakdown der Stimmen');
define('_BUTTONLINK','Buttonlink');
define('_CATEGORIES','Themen- Bereiche');
if (!defined('_CATEGORY')) define('_CATEGORY','Bereich');
define('_CHECKFORIT','Sie brauchen uns keine eMail zu schreiben. Wir werden Ihren Vorschlag baldm&ouml;glichst &uuml;berpr&uuml;fen.');
define('_COMPLETEVOTE1','Ihre Abstimmung wird gesch&auml;tzt.');
define('_COMPLETEVOTE2','Sie haben in den letzten '.$anonwaitdays.' Tagen schon einmal eine Stimme abgegeben.');
define('_COMPLETEVOTE3','Stimmen Sie bitte nur einmal ab.<br />Alle abgegebenen Stimmen werden geloggt und ausgewertet!.');
define('_COMPLETEVOTE4','Sie k&ouml;nnen nicht einen Link bewerten, den Sie selbst eingetragen haben.<br />Alle abgegebenen Stimmen werden geloggt und ausgewertet!.');
define('_COMPLETEVOTE5','Keine Bewertung ausgew&auml;hlt - Keine Stimme gez&auml;hlt');
define('_COMPLETEVOTE6','Nur eine Stimme pro IP-Adresse innerhalb von '.$outsidewaitdays.' Tagen erlaubt.');
define('_DAYS','Tagen');
define('_DBESTRATED','Bestbewertete Downloads');
define('_DCATLAST3DAYS','Neue Downloads in diesem Bereich- letzte 3 Tage');
define('_DCATNEWTODAY','Heute neue Downloads in diesem Bereich');
define('_DCATTHISWEEK','Neue Downloads in diesem Bereich- letzte 7 Tage');
define('_DDATE1','Datum (erst Alte)');
define('_DDATE2','Datum (erst Neue)');
define('_DESCRIPTION','Beschreibung');
define('_DETAILS','Details');
define('_DLETSDECIDE','Eingaben von Teilnehmern wie Ihnen helfen anderen Teilnehmern, zu entscheiden, welche Downloads diese probieren sollten.');
define('_DONLYREGUSERSMODIFY','Nur registrierte User k&ouml;nnen Download &Auml;nderungen vorschlagen. Bitte <a href="modules.php?name=Your_Account">registrieren oder einloggen.</a>');
define('_DOWNLOADALREADYEXT','Fehler: Diese URL befindet sich bereits in der Datenbank!');
define('_DOWNLOADCOMMENTS','Download- Kommentare');
define('_DOWNLOADID','Download ID');
define('_DOWNLOADNAME','Programname');
define('_DOWNLOADNODESC','Fehler: Sie m&uuml;ssen eine Homepage- Beschreibung eingeben!');
define('_DOWNLOADNOEMAIL','ERROR: You need to type a valid EMAIL address!');
define('_DOWNLOADNOTITLE','Fehler: Sie m&uuml;ssen Ihrer Seite einen Namen geben!');
define('_DOWNLOADNOURL','Fehler: Sie m&uuml;ssen f&uuml;r Ihre Homepage eine URL angeben!');
define('_DOWNLOADNOW','Datei herunterladen!');
define('_DOWNLOADPROFILE','Downloadprofil');
define('_DOWNLOADRATING','Download- Bewertung ');
define('_DOWNLOADRATINGDET','Downloadbewertungs- Details');
define('_DOWNLOADRECEIVED','Wir haben Ihr Downloadangebot erhalten. Vielen Dank');
define('_DOWNLOADS','Downloads');
define('_DOWNLOADSMAIN','Download- Index');
define('_DOWNLOADSMAINCAT','Download- Hauptkategorien');
define('_DOWNLOADSNOTUSER1','Sie sind kein registrierter User, oder nicht eingeloggt.');
define('_DOWNLOADSNOTUSER2','Nur wenn Sie angemeldet sind, k&ouml;nnen Sie hier Dateien anbieten.');
define('_DOWNLOADSNOTUSER3','Ein angemeldeter User zu werden ist ein schneller und einfacher Vorgang.');
define('_DOWNLOADSNOTUSER4','Warum ben&ouml;tigen wir Ihre Registration, um Ihnen den Zugriff zu gew&auml;hren?');
define('_DOWNLOADSNOTUSER5','Nur so k&ouml;nnen wir Ihnen diesen Topinhalt anbieten,');
define('_DOWNLOADSNOTUSER6','jedes File wird von unserem Team angesehen und ggbf. freigeschaltet.');
define('_DOWNLOADSNOTUSER7','Wir hoffen, Ihnen nur wertvolle Informationen zu pr&auml;sentieren.');
define('_DOWNLOADSNOTUSER8','<a href="modules.php?name=Your_Account">Mitglied werden</a>');
define('_DOWNLOADVOTE','Bewerten!');
define('_DPOSTPENDING','Alle neuen Downloads m&uuml;ssen erst freigeschaltet werden.');
define('_DRATENOTE4','Sie k&ouml;nnen sich eine <a href="modules.php?name=Downloads&amp;d_op=TopRated">Liste der bestbewertesten Downloads</a> anzeigen lassen.');
define('_DSUBMITONCE','Bitte eine Datei nur einmal hinzuf&uuml;gen');
define('_DTOTALFORLAST','Alle neuen Downloads der letzten');
define('_EDITORIAL','Einleitung');
define('_EDITORIALBY','Einleitung von');
define('_EDITORREVIEW','Editor- Bewertung');
define('_EDITTHISDOWNLOAD','&Auml;ndere diesen Download');
define('_FEELFREE2ADD','Sind Sie so frei und geben Sie einen Kommentar ein.');
define('_FILESIZE','Dateigr&ouml;&szlig;e');
define('_FILEURL','Dateipfad');
define('_HIGHRATING','H&ouml;chste Bewertung');
define('_HOMEPAGE','Homepage');
define('_HTMLCODE1','Folgenden HTML- Code sollten Sie in diesem Fall auf Ihrer Webseite einf&uuml;gen:');
define('_HTMLCODE2','Folgenden HTML- Code m&uuml;ssen Sie f&uuml;r den Button auf Ihrer Seite einf&uuml;gen:');
define('_HTMLCODE3','Die Benutzung dieses Formulars erlaubt es Ihren Besuchern, direkt von Ihrer Seite aus abzustimmen. Wir erhalten diese Bewertung und f&uuml;gen sie in unsere Datenbank ein. Das obige Beispiel ist deaktiviert, aber auf Ihrer Seite wird es funktionieren, wenn Sie den HTML- Code genau so dort einf&uuml;gen. Hier nun der HTML- Code:');
define('_IDREFER','im Code entspricht Ihrer Seiten- ID in der '.$sitename.' Datenbank. Bitte achten Sie darauf, dass diese Nummer angegeben ist.');
define('_IFYOUWEREREG','Wenn Sie registriert sind, k&ouml;nnen Sie auf dieser Seite Kommentare eingeben.');
define('_INBYTES','in Bytes');
define('_INDB','in unserer Datenbank');
define('_INOTHERSENGINES','in anderen Suchmaschinen');
define('_INSTRUCTIONS','Anleitung');
define('_ISTHISYOURSITE','Ist es von Ihnen?');
define('_LAST30DAYS','Letzte 30 Tage');
define('_LASTWEEK','Letzte Woche');
define('_LDESCRIPTION','Beschreibung: (maximal 255 Zeichen)');
define('_LINKSDATESTRING','%d-%b-%Y');
define('_LOOKTOREQUEST','Wir werden uns Ihren Vorschlag baldm&ouml;glichst ansehen.');
define('_LOWRATING','Niedrigste Bewertung');
define('_LTOTALVOTES','Stimmen- insgesamt');
define('_LVOTES','Stimmen');
define('_MAIN','Start');
define('_MODIFY','Modifizieren');
define('_MOSTPOPULAR','Beliebteste');
define('_NEW','Neu');
define('_NEWDOWNLOADS','Neue Downloads');
define('_NEWLAST3DAYS','In den letzten 3 Tagen neu');
define('_NEWTHISWEEK','Diese Woche neu');
define('_NEWTODAY','Heute neu');
define('_NEXT','N&auml;chste Seite');
define('_NOEDITORIAL','F&uuml;r diese Webseite ist bisher kein Editorial verf&uuml;gbar');
define('_NOMATCHES','Keine Treffer f&uuml;r diese Anfrage gefunden');
define('_NOOUTSIDEVOTES','Keine Abstimmenden von Extern');
define('_NOREGUSERSVOTES','Keine Stimmen von Mitgliedern');
define('_NOUNREGUSERSVOTES','Keine Stimmen von unregistrierten Teilnehmern');
define('_NUMBEROFRATINGS','Zahl der Stimmen');
define('_NUMOFCOMMENTS','Kommentaranzahl');
define('_NUMRATINGS','# der Stimmen');
define('_OFALL','von allen');
define('_OUTSIDEVOTERS','Extern abstimmenende');
define('_OVERALLRATING','Ingesamt bewertet');
define('_POPULAR','Beliebt');
define('_POPULARITY','Beliebtheit');
define('_POPULARITY1','Beliebtheit (unbeliebteste oben)');
define('_POPULARITY2','Beliebtheit (beliebteste oben)');
define('_PREVIOUS','Vorherige Seite');
define('_PROMOTE01','Vielleicht sind Sie ja an verschiedenen \'Bewerten Sie meine Webseite\'- Boxen interessiert, die wir anbieten? Diese erlauben Ihnen das platzieren eines Bildes (oder eines Abstimmformulars) direkt auf Ihrer Webseite, um die Anzahl der Stimmen, die Ihre Webseite hier bekommt, zu erh&ouml;hen. Bitte w&auml;hlen Sie aus einer der unten gegebenen M&ouml;glichkeiten eine f&uuml;r Ihre Webseite passende aus:');
define('_PROMOTE02','Eine M&ouml;glichkeit, Bewertungen in unserem System von Ihrer Webseite zu erhalten, ist ein Textlink:');
define('_PROMOTE03','Falls Ihnen der Sinn nach etwas mehr als einem Textlink steht, ist es vielleicht ein Buttonlink, den Sie gerne m&ouml;chten:');
define('_PROMOTE04','Falls Sie zu betr&uuml;gen versuchen, werden wir Ihren Link f&uuml;r immer von unserer Seite entfernen. Nachdem wir dieses gesagt haben- so k&ouml;nnte diese Box auf Ihrer Seite aussehen:');
define('_PROMOTE05','Vielen Dank! Und viel Erfolg bei der Linkbewertung!');
define('_PROMOTEYOURSITE','Bewerben Sie ihre Webseite');
define('_RATEIT','Bewerten Sie diese Seite!');
define('_RATENOTE1','Bitte stimmen Sie &uuml;ber einen Link nicht mehrmals ab.');
define('_RATENOTE2','Die Skala reicht von 1 - 10, wobei 1 die schlechteste und 10 die beste Bewertung ist.');
define('_RATENOTE3','Bitte sind Sie objektiv beim Abstimmen. Wenn jeder mit 1 oder 10 abstimmt, sind die Ergebnisse nicht sonderlich aussagekr&auml;ftig.');
define('_RATENOTE5','Bitte bewerten Sie nicht Ihre eigene oder die Seite eines direkten Konkurenten, Sie w&auml;ren ohnehin nicht objektiv.');
define('_RATERESOURCE','Bewerten');
define('_RATETHISSITE','Bewerten');
define('_RATING','Bewertung');
define('_RATING1','Bewertung (erst schlechtbewertete)');
define('_RATING2','Bewertung (erst gutbewertete)');
define('_REGISTEREDUSERS','Registrierte Nutzer');
define('_REMOTEFORM','Externe Abstimmbox');
define('_REPORTBROKEN','Fehlerhaften Link melden');
define('_REQUESTDOWNLOADMOD','Vorgeschlagene Download- &Auml;nderungen');
define('_RESSORTED','Dateien sind aktuell sortiert nach');
define('_RETURNTO','Zur&uuml;ck nach');
define('_SCOMMENTS','Kommentare');
define('_SEARCHRESULTS4','Suche Ergebnisse f&uuml;r');
define('_SECURITYBROKEN','Aus Sicherheitsgr&uuml;nden wird Ihr Username und Ihre IP- Adresse zeitweilig gespeichert.');
define('_SELECTPAGE','Seite ausw&auml;hlen');
define('_SENDREQUEST','Vorschlag senden');
define('_SHOW','Zeigen');
define('_SHOWTOP','Zeige Top');
define('_SORTDOWNLOADSBY','Sortiere Downloads nach');
define('_STAFF','Die Mitarbeiter');
define('_TEXTLINK','Textlink');
define('_THANKSBROKEN','Vielen Dank f&uuml;r Ihre Hilfe bei der Steigerung der Benutzbarkeit dieses Indexes.');
define('_THANKSFORINFO','Vielen Dank f&uuml;r diese Information.');
define('_THANKSTOTAKETIME','Vielen Dank f&uuml;r die Zeit, die Sie zum Bewerten einer Webseite hier bei uns aufgebracht haben');
define('_THENUMBER','Die Zahl');
define('_THEREARE','Es gibt');
define('_TITLE','Titel');
define('_TITLEAZ','Name (A nach Z)');
define('_TITLEZA','Name (Z nach A)');
define('_TO','zu');
define('_TOPRATED','Topbewertet');
define('_TOTALNEWDOWNLOADS','Alle neuen Downloads');
define('_TOTALOF','von insgesamt');
define('_TOTALVOTES','gesamte Stimmen:');
define('_TRATEDDOWNLOADS','ingesamt bewertete Downloads');
define('_TRY2SEARCH','Versuche die Suche');
define('_TVOTESREQ','Minimal notwendige Stimmen');
define('_UNKNOWN','Unbekannt');
define('_UNREGISTEREDUSERS','Unregistrierte Teilnehmer');
define('_URL','URL');
define('_USER','Leuten');
define('_USERANDIP','Username und IP werden gespeichert, bitte missbrauchen Sie unser System nicht.');
define('_USERAVGRATING','Durchschnittliche Bewertung');
define('_USUBCATEGORIES','Unterkategorien');
define('_VERSION','Version');
define('_VOTE4THISSITE','Bewerten Sie diese Seite!');
define('_WEIGHNOTE','* Achtung: Diese Seite bewertet Stimmen von registrierten und unregistrierten Usern im Verh&auml;ltnis');
define('_WEIGHOUTNOTE','* Achtung: Diese Seite bewertet interne zu externen Stimmen im Verh&auml;ltnis');
define('_YOUARENOTREGGED','Sie sind kein registriertes Mitglied oder aber nicht eingeloggt.');
define('_YOUAREREGGED','Du bist registriert und angemeldet.');

?>