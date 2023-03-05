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
//if (!defined('_DATE')) define('_DATE','Dátum');
//if (!defined('_OF')) define('_OF','-');
define("_1WEEK","1 hét");
define("_2WEEKS","2 hét");
define("_30DAYS","30 nap");
define("_ADDADOWNLOAD","Új letöltés hozzáadása");
define("_ADDDOWNLOAD","Letöltés hozzáadása");
define("_ADDEDON","Felvétel napja");
define("_ADDITIONALDET","Egyéb részletek");
define("_ADDTHISFILE","Fájl felvétele");
define("_ALLOWTORATE","Tegye lehetõvé, hogy mások is osztályozhassák az Ön saját oldaláról!");
define("_AND","és");
define("_AUTHOR","Szerzõ");
define("_AUTHOREMAIL","Szerzõ e-mail címe");
define("_AUTHORNAME","Szerzõ neve");
define("_BREAKDOWNBYVAL","Értékelések eloszlása");
define("_BUTTONLINK","Nyomógomb");
define("_CATEGORIES","kategória");
if (!defined('_CATEGORY')) define("_CATEGORY","Kategória");
define("_CHECKFORIT","Nem adott meg e-mail címet. Hamarosan ellenõrizzük a linket, és bekerül az adatbázisba.");
define("_COMPLETEVOTE1","Elfogadtuk a szavazatát.");
define("_COMPLETEVOTE2","Már szavazott az elmúlt $anonwaitdays napban.");
define("_COMPLETEVOTE3","Kérem, csak egyszer szavazzon.<br>Minden szavazást mentünk.");
define("_COMPLETEVOTE4","A saját írására nem szavazhat.<br>Minden szavazást mentünk.");
define("_COMPLETEVOTE5","Nincs szavazat kiválasztva - nincs kijelölt szavazat");
define("_COMPLETEVOTE6","$outsidewaitdays naponta csak egy szavazatot fogadunk el IP címenként.");
if (!defined('_DATE')) define("_DATE","Dátum");
define("_DAYS","napban");
define("_DBESTRATED","Legjobbra osztályozott letöltések");
define("_DCATLAST3DAYS","Az elmúlt 3 napban hozzáadott letöltések ebben a kategóriában");
define("_DCATNEWTODAY","A ma hozzáadott letöltések ebben a kategóriában");
define("_DCATTHISWEEK","Az elmúlt héten hozzáadott letöltések ebben a kategóriában");
define("_DDATE1","Dátum (felül a régebbi letöltések)");
define("_DDATE2","Dátum (felül a legfrissebb letöltések)");
define("_DESCRIPTION","Leírás");
define("_DETAILS","Részletek");
define("_DLETSDECIDE","A visszajelzése segít másoknak eldönteni, mely fájlokat érdemes letölteni.");
define('_DONLYREGUSERSMODIFY','Csak regisztált felhasználók javasolhatnak változtatásokat a Letöltésekben. Itt <a href="modules.php?name=Your_Account">regisztrálhat vagy beléphet.</a>.');
define("_DOWNLOADALREADYEXT","HIBA: adatbázisunk már tartalmazza ezt a linket!");
define("_DOWNLOADCOMMENTS","Megjegyzések");
define("_DOWNLOADID","Letöltés azonosítója");
define("_DOWNLOADNAME","Program neve");
define("_DOWNLOADNODESC","HIBA: nem adta meg a link leírását!");
define("_DOWNLOADNOTITLE","HIBA: nem adta meg a link nevét!");
define("_DOWNLOADNOURL","HIBA: nem adta meg a linket!");
define("_DOWNLOADNOW","Töltse le most!");
define("_DOWNLOADPROFILE","Letöltés profilja");
define("_DOWNLOADRATING","Letöltés osztályozása");
define("_DOWNLOADRATINGDET","Osztályozás részletezése");
define("_DOWNLOADRECEIVED","Megkaptuk az Ön által ajánlott letöltés adatait. Köszönjük!");
define("_DOWNLOADS","Letöltés");
define("_DOWNLOADSMAIN","Letöltések");
define("_DOWNLOADSMAINCAT","Letöltések - fõ kategóriák");
define("_DOWNLOADSNOTUSER1","Nem regisztrált felhasználónk, vagy nem lépett be!");
define("_DOWNLOADSNOTUSER2","Miután regisztrálja magát, Ön is küldhet be linkeket.");
define("_DOWNLOADSNOTUSER3","A regisztráció gyors és egyszerû folyamat.");
define("_DOWNLOADSNOTUSER4","Miért kérünk regisztrációt egyes szolgáltatásaink eléréséhez?");
define("_DOWNLOADSNOTUSER5","Hogy minõségi és értékes tartalmat nyújthassunk, ");
define("_DOWNLOADSNOTUSER6","minden linket személyesen ellenõrzünk.");
define("_DOWNLOADSNOTUSER7","Reméljük, hogy jónak találja szolgáltatásainkat.");
define("_DOWNLOADSNOTUSER8","<a href=\"modules.php?name=Your_Account\">Regisztráljon!</a>");
define("_DOWNLOADVOTE","Szavazzon!");
define("_DPOSTPENDING","Az elküldött letöltések jóváhagyásra várnak.");
define("_DRATENOTE4","Nézze meg a legjobbra osztályozott <a href=\"modules.php?name=Downloads&amp;d_op=TopRated\">Top letöltések listáját</a>.");
define("_DSUBMITONCE","Egy letöltést csak egyszer küldjön el!");
define("_DTOTALFORLAST","új letöltés az elmúlt");
define("_EDITORIAL","Szerkesztõi vélemény");
define("_EDITORIALBY","Szerkesztõ:");
define("_EDITORREVIEW","Szerkesztõi vélemény");
define("_EDITTHISDOWNLOAD","Letöltés szerkesztése");
define("_FEELFREE2ADD","Nyugodtan küldje el megjegyzését ezzel a weboldallal kapcsolatban.");
define("_FILESIZE","Méret");
define("_FILEURL","Fájl linkje");
define("_HIGHRATING","Legmagasabb érték");
define("_HOMEPAGE","Honlap");
define("_HTMLCODE1","Ebben az esetben használja a következõ HTML kódot:");
define("_HTMLCODE2","A fenti gomb forráskódja:");
define("_HTMLCODE3","Ezzel az ûrlappal a látogatói közvetlenül szavazhatnak a weboldalára, a szavazatokat pedig mi tároljuk. A fenti ûrlap nem mûködik, de a következõ kód mûködni fog, ha beszúrja a weboldala forrásába:");
define("_IDREFER","szám a HTML forrásban a weboldala azonosító száma a(z) $sitename adatbázisban. Vigyázzon, nehogy kihagyja!");
define("_IFYOUWEREREG","Regisztrált felhasználóként megjegyzéseket fûzhetne ehhez a weboldalhoz.");
define("_INBYTES","bájtokban");
define("_INDB","található az adatbázisban");
define("_INOTHERSENGINES","más keresõkkel");
define("_INSTRUCTIONS","Útmutató");
define("_ISTHISYOURSITE","Ön küldte be ezt a linket?");
define("_LAST30DAYS","Múlt hónapban");
define("_LASTWEEK","Múlt héten");
define("_LDESCRIPTION","Leírás: (max. 255 karakter)");
define("_LINKSDATESTRING","%Y. %m. %d.");
define("_LOOKTOREQUEST","Hamarosan ellenõrizzük az információit.");
define("_LOWRATING","Legalacsonyabb érték");
define("_LTOTALVOTES","szavazat");
define("_LVOTES","szavazat");
define("_MAIN","Fõoldal");
define("_MODIFY","Változtatás");
define("_MOSTPOPULAR","Legkedveltebb");
define("_NEW","Legújabb");
define("_NEWDOWNLOADS","Új letöltések");
define("_NEWLAST3DAYS","Az elmúlt három nap linkjei");
define("_NEWTHISWEEK","Az elmúlt hét linkjei");
define("_NEWTODAY","Mai linkek");
define("_NEXT","Következõ oldal");
define("_NOEDITORIAL","Errõl a weboldalról még nincs szerkesztõi vélemény.");
define("_NOMATCHES","A keresés nem eredményezett találatot");
define("_NOOUTSIDEVOTES","Más weboldalakon még nem értékelték");
define("_NOREGUSERSVOTES","Regisztrált felhasználó még nem értékelte");
define("_NOUNREGUSERSVOTES","Nem regisztrált látogató még nem értékelte");
define("_NUMBEROFRATINGS","Értékelések száma");
define("_NUMOFCOMMENTS","Megjegyzések száma");
define("_NUMRATINGS","Értékelések száma");
define("_OFALL","az összesbõl");
define("_OUTSIDEVOTERS","Szavazatok más weboldalakról");
define("_OVERALLRATING","Átlag");
define("_POPULAR","Legnépszerûbb");
define("_POPULARITY","Népszerûség");
define("_POPULARITY1","Népszerûség (növekvõ sorrend)");
define("_POPULARITY2","Népszerûség (csökkenõ sorrend)");
define("_PREVIOUS","Elõzõ oldal");
define("_PROMOTE01","Talán érdekli valamelyik 'Szavazzon erre a weboldalra' lehetõségünk. Ezek lehetõvé teszik egy link (vagy akár szavazóûrlap) elhelyezését az Ön weboldalán, hogy növelje az oldala szavazatainak számát. Válasszon a lenti lehetõségek közül:");
define("_PROMOTE02","Látogatói szavazhatnak egyszerû szöveges link segítségével:");
define("_PROMOTE03","Ha esetleg többet szeretne, mint egy egyszerû szöveglink, használhat nyomógombot:");
define("_PROMOTE04","Ha valaki csal, a linkjét eltávolítjuk. Így fog kinézni a kérdõív, amellyel az oldalát más weboldalakról is értékelhetik:");
define("_PROMOTE05","Köszönjük! és sok sikert a szavazatokkal!");
define("_PROMOTEYOURSITE","Népszerûsítse a weboldalát");
define("_RATEIT","Szavazzon erre az oldalra!");
define("_RATENOTE1","Kérem, ne szavazzon kétszer egy linkre.");
define("_RATENOTE2","1-10-ig értékelhet, az 1-es a leggyengébb, a 10-es a legjobb érték.");
define("_RATENOTE3","Kérem, értékeljen objektívan, ha mindenki egyest vagy tizest kap, nem sok segítséget nyújtanak az értékelések...");
define("_RATENOTE5","Ha lehet, ne szavazzon saját, vagy közvetlen versenytársai weboldalára.");
define("_RATERESOURCE","Osztályozás");
define("_RATETHISSITE","Osztályozza ezt a weboldalt");
define("_RATING","osztályzat");
define("_RATING1","Osztályzatok (növekvõ sorrend)");
define("_RATING2","Osztályzatok (csökkenõ sorrend)");
define("_REGISTEREDUSERS","Regisztrált felhasználók");
define("_REMOTEFORM","Távoli szavazóûrlap");
define("_REPORTBROKEN","Törött link bejelentése");
define("_REQUESTDOWNLOADMOD","Letöltés változtatásának kérelme");
define("_RESSORTED","Sorbarendezés:");
define("_RETURNTO","Vissza az elõzõ oldalra:");
define("_SCOMMENTS","Megjegyzések");
define("_SEARCHRESULTS4","Keresés:");
define("_SECURITYBROKEN","Biztonsági szempontból ideiglenesen feljegyezzük a felhasználónevét és az IP címét is.");
define("_SELECTPAGE","Válasszon oldalt");
define("_SENDREQUEST","Kérés elküldése");
define("_SHOW","Megtekintés");
define("_SHOWTOP","Legnézettebb");
define("_SORTDOWNLOADSBY","Letöltések sorbarendezése:");
define("_STAFF","Munkatársak");
define("_TEXTLINK","Szöveges link");
define("_THANKSBROKEN","Köszönjük, hogy segít fenntartani a linktárunk mûködését.");
define("_THANKSFORINFO","Köszönjük az információt.");
define("_THANKSTOTAKETIME","Köszönöm, hogy idõt szánt egy oldal értékelésére itt nálam -");
define("_THENUMBER","A");
define("_THEREARE","Jelenleg");
define("_TITLE","Cím");
define("_TITLEAZ","Cím (A-Z)");
define("_TITLEZA","Cím (Z-A)");
define("_TO","Címzett");
define("_TOPRATED","Legjobbra osztályozott");
define("_TOTALNEWDOWNLOADS","új letöltés összesen");
define("_TOTALOF","Összesen");
define("_TOTALVOTES","Összes szavazat:");
define("_TRATEDDOWNLOADS","osztályozott letöltés");
define("_TRY2SEARCH","Keresés");
define("_TVOTESREQ","a minimálisan szükséges szavazatok sz.");
define("_UNKNOWN","Ismeretlen");
define("_UNREGISTEREDUSERS","Nem regisztrált látogatók");
define("_URL","URL");
define("_USER","felhasználó");
define("_USERANDIP","A felhasználónév és az IP cím feljegyzésre kerül, kérem, ne éljen vissza a rendszerrel.");
define("_USERAVGRATING","Felhasználók átlagos értékelése");
define("_USUBCATEGORIES","Alkategóriák");
define("_VERSION","Verzió");
define("_VOTE4THISSITE","Szavazzon erre az oldalra!");
define("_WEIGHNOTE","* Megjegyzés: a regisztrált felhasználók értékelése többet nyom, mint a látogatóké");
define("_WEIGHOUTNOTE","* Megjegyzés: a regisztrált felhasználók értékelése többet nyom, mint a más weboldalakon szavazóké");
define("_YOUARENOTREGGED","Nem regisztrált felhasználónk, vagy nem lépett be.");
define("_YOUAREREGGED","Ön regisztrált felhasználó, és belépett.");

?>
