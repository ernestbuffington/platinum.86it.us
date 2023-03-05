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
//if (!defined('_DATE')) define('_DATE','Date');
//if (!defined('_OF')) define('_OF','de');
define('_1WEEK','1 semaine');
define('_2WEEKS','2 semaines');
define('_30DAYS','30 jours');
define('_ADDADOWNLOAD','Ajouter un nouveau fichier');
define('_ADDDOWNLOAD','Ajouter un fichier t&eacute;l&eacute;chargeable');
define('_ADDEDON','Ajout&eacute; le');
define('_ADDITIONALDET','D&eacute;tails additionnels');
define('_ADDTHISFILE','Ajouter ce fichier');
define('_ALLOWTORATE','Autoriser les autres utilisateurs &agrave; voter depuis votre site Web !');
define('_AND','et');
define('_AUTHOR','Auteur');
define('_AUTHOREMAIL','Email de l\'auteur');
define('_AUTHORNAME','Nom de l\'auteur');
define('_BREAKDOWNBYVAL','D&eacute;coupage des &eacute;valuations par valeur');
define('_BUTTONLINK','Lien \'bouton\'');
define('_CATEGORIES','cat&eacute;gories');
if (!defined('_CATEGORY')) define('_CATEGORY','Cat&eacute;gorie');
define('_CHECKFORIT','Vous n\'avez pas entr&eacute; votre adresse Email.  Nous v&eacute;rifierons cependant votre lien prochainement.');
define('_COMPLETEVOTE1','Votre vote est enregistr�.');
define('_COMPLETEVOTE2','Vous avez d�j� vot� pour cette ressource dans le pass� '.$anonwaitdays.' jour(s).');
define('_COMPLETEVOTE3','Votez pour une ressource seulement une fois<br />Tous les votes sont logg�s');
define('_COMPLETEVOTE4','Vous ne pouvez pas voter sur un lien que vous avez proposez.<br />Tous les votes sont logg�s.');
define('_COMPLETEVOTE5','Aucune note n\'a �t� choisie - Le vote n\'a pas �t� pri en compte');
define('_COMPLETEVOTE6','Seulement un vote par adresse IP est autoris� tous les '.$outsidewaitdays.' jour(s).');
define('_DAYS','jours');
define('_DBESTRATED','Les produits les mieux cot&eacute;s - Top');
define('_DCATLAST3DAYS','Nouveaux fichiers dans cette cat&eacute;gorie ajout&eacute;s dans les 3 derniers jours');
define('_DCATNEWTODAY','Nouveaux fichiers dans cette cat&eacute;gorie ajout&eacute;s aujourd\'hui');
define('_DCATTHISWEEK','Nouveaux fichiers dans cette cat&eacute;gorie ajout&eacute;s cette semaine');
define('_DDATE1','Date (Anciens fichiers affich&eacute;s en premier)');
define('_DDATE2','Date (Nouveaux fichiers affich&eacute;s en premier)');
define('_DESCRIPTION','Description');
define('_DETAILS','D&eacute;tails');
define('_DLETSDECIDE','Les contributions d\'utilisateurs tels que vous aideront d\'autres visiteurs &agrave; mieux choisir les fichiers &agrave; t&eacute;l&eacute;charger.');
define('_DONLYREGUSERSMODIFY','Only registered users can suggest downloads modifications. Please <a href="modules.php?name=Your_Account">register or login</a>.');
define('_DOWNLOADALREADYEXT','ERREUR: Cet URL est d&eacute;j&agrave; pr&eacute;sent dans la base de donn&eacute;es!');
define('_DOWNLOADCOMMENTS','T&eacute;l&eacute;chargement - Commentaires');
define('_DOWNLOADID','ID du produit');
define('_DOWNLOADNAME','Nom du fichier');
define('_DOWNLOADNODESC','ERREUR: Vous devez saisir une DESCRIPTION pour votre URL!');
define('_DOWNLOADNOEMAIL','ERROR: You need to type a valid EMAIL address!');
define('_DOWNLOADNOTITLE','ERREUR: Vous devez saisir un TITRE pour votre URL!');
define('_DOWNLOADNOURL','ERREUR: Vous devez saisir un URL pour votre URL!');
define('_DOWNLOADNOW','T&eacute;l&eacute;charger ce fichier maintenant !');
define('_DOWNLOADPROFILE','T&eacute;l&eacute;chargement - Profil');
define('_DOWNLOADRATING','Evaluation des produits');
define('_DOWNLOADRATINGDET','D&eacute;tails des &eacute;valuations');
define('_DOWNLOADRECEIVED','Nous avons re&ccedil;u votre proposition de fichier. Merci !');
define('_DOWNLOADS','fichiers');
define('_DOWNLOADSMAIN','T&eacute;l&eacute;chargement - Page principale');
define('_DOWNLOADSMAINCAT','T&eacute;l&eacute;chargement - Cat&eacute;gories principales');
define('_DOWNLOADSNOTUSER1','Vous n\'&ecirc;tes pas un utilisateur enregistr&eacute;, ou vous ne vous &ecirc;tes pas connect&eacute;.');
define('_DOWNLOADSNOTUSER2','Si vous &eacute;tiez un utilisateur enregistr&eacute;, vous pourriez proposer vos fichiers en t&eacute;l&eacute;chargement depuis ce site.');
define('_DOWNLOADSNOTUSER3','Devenir un membre enregistr&eacute; est un processus simple et rapide.');
define('_DOWNLOADSNOTUSER4','Pourquoi l\'enregistrement est-il n&eacute;cessaire pour acc&eacute;der &agrave; certaines options ?');
define('_DOWNLOADSNOTUSER5','Nous pouvons vous offrir de cette mani&egrave;re un contenu de la plus haute qualit&eacute;,');
define('_DOWNLOADSNOTUSER6','chaque &eacute;l&eacute;ment est examin&eacute; individuellement et approuv&eacute; par notre &eacute;quipe.');
define('_DOWNLOADSNOTUSER7','Nous esp&eacute;rons vous offrir ainsi uniquement des informations de valeur.');
define('_DOWNLOADSNOTUSER8','<a href="modules.php?name=Your_Account">Ouvrir un compte</a>');
define('_DOWNLOADVOTE','Votez !');
define('_DPOSTPENDING','Tous les fichiers sont publi&eacute;s apr&egrave;s v&eacute;rification.');
define('_DRATENOTE4','Vous pouvez voir une liste des <a href="downloads.php?op=TopRated">produits les mieux cot&eacute;s</a>.');
define('_DSUBMITONCE','Veuillez ne soumettre un m&ecirc;me fichier qu\'une seule fois.');
define('_DTOTALFORLAST','Total des nouveaux fichiers depuis');
define('_EDITORIAL','Editorial');
define('_EDITORIALBY','Compte rendu par');
define('_EDITORREVIEW','Compte-rendu de l\'&eacute;diteur');
define('_EDITTHISDOWNLOAD','Editer ce produit');
define('_FEELFREE2ADD','Votre commentaire &agrave; propos de ce site est le bienvenu.');
define('_FILESIZE','Taille');
define('_FILEURL','Lien vers le fichier');
define('_HIGHRATING','Cote la plus haute');
define('_HOMEPAGE','Page d\'accueil');
define('_HTMLCODE1','Le code HTML &agrave; utiliser dans ce cas est::');
define('_HTMLCODE2','Le code source pour l\'utilisation du bouton ci-dessus est:');
define('_HTMLCODE3','L\'utilisation de ce formulaire autorise vos visiteurs &agrave; voter pour votre site directement depuis vos pages Web, et l\'&eacute;valuation sera enregistr&eacute;e ici.  Le formulaire ci-dessus est inactif, mais le code source suivant fonctionnera si vous le copiez et le collez sur une de vos pages Web.  Voici le code source:');
define('_IDREFER','dans le source HTML r&eacute;f&eacute;rence l\'ID de votre site dans la base de donn&eacute;es de '.$sitename.'.  Assurez vous que ce nombre est pr&eacute;sent.');
define('_IFYOUWEREREG','Si vous &eacute;tiez enregistr&eacute;, vous pourriez commenter ce site.');
define('_INBYTES','en octets');
define('_INDB','dans notre base de donn&eacute;e');
define('_INOTHERSENGINES','dans d\'autres moteurs de recherche');
define('_INSTRUCTIONS','Instructions');
define('_ISTHISYOURSITE','S\'agit-il de votre site Web ? ');
define('_LAST30DAYS','Les 30 derniers jours');
define('_LASTWEEK','La semaine derni&egrave;re');
define('_LDESCRIPTION','Description: (255 caract&egrave;res max)');
define('_LINKSDATESTRING','%d-%b-%Y');
define('_LOOKTOREQUEST','Nous examinerons votre requ&ecirc;te rapidement.');
define('_LOWRATING','Cote la plus basse');
define('_LTOTALVOTES','vote(s) au total');
define('_LVOTES','votes');
define('_MAIN','Principal');
define('_MODIFY','Modifier');
define('_MOSTPOPULAR','Les plus populaires - Top');
define('_NEW','Nouveaux');
define('_NEWDOWNLOADS','Nouveaux fichiers');
define('_NEWLAST3DAYS','Nouveau ces 3 derniers jours');
define('_NEWTHISWEEK','Nouveaux cette semaine');
define('_NEWTODAY','Nouveau aujourd\'hui');
define('_NEXT','Page Suivante');
define('_NOEDITORIAL','Il n\'y a pas de compte rendu disponible pour ce site.');
define('_NOMATCHES','Aucune correspondance trouv&eacute;e &agrave; votre requ&ecirc;te');
define('_NOOUTSIDEVOTES','Pas de votes d\'&eacute;lecteurs ext&eacute;rieurs');
define('_NOREGUSERSVOTES','Pas de votes d\'utilisateurs enregistr&eacute;s');
define('_NOUNREGUSERSVOTES','Pas de votes d\'utilisateurs non-enregistr&eacute;s');
define('_NUMBEROFRATINGS','Nombre d\'&eacute;valuations');
define('_NUMOFCOMMENTS','Nombre de commentaires');
define('_NUMRATINGS','Nbre d\'&eacute;valuations');
define('_OFALL','de tous les');
define('_OUTSIDEVOTERS','Electeurs ext&eacute;rieurs');
define('_OVERALLRATING','Evaluation g&eacute;n&eacute;rale');
define('_POPULAR','Populaires');
define('_POPULARITY','Popularit&eacute;');
define('_POPULARITY1','Popularit&eacute; (du plus petit au plus grand nombre de hits)');
define('_POPULARITY2','Popularit&eacute; (du plus grand au plus petit nombre de hits)');
define('_PREVIOUS','Page Pr&eacute;c&eacute;dente');
define('_PROMOTE01','Peut-&ecirc;tre serez-vous int&eacute;ress&eacute; par une de nos nombreuses options pour \'Evaluer un site\' &agrave; distance.  Celles-ci vous permettent de placer une image (ou un formulaire d\'&eacute;valuation) sur votre site pour augmenter le nombre de votes que votre site recevra.  Choisissez une des options pr&eacute;sent&eacute;es ci-dessous:');
define('_PROMOTE02','Un des moyens de mener vers le formulaire d\'&eacute;valuation est l\'utilisation d\'un lien textuel:');
define('_PROMOTE03','Si vous cherchez d\'autres solutions qu\'un simple lien textuel, vous choisirez peut-&ecirc;tre un lien par bouton:');
define('_PROMOTE04','Si vous tentez de tricher ici, nous enleverons votre lien. Ceci &eacute;tant dit, voici &agrave; quoi ressemble le formulaire d\'&eacute;valuation &agrave; distance.');
define('_PROMOTE05','Merci !  Et bonne chance pour l\'&eacute;valuation de votre site !');
define('_PROMOTEYOURSITE','Faites la promo de votre site Web');
define('_RATEIT','Votez pour ce site !');
define('_RATENOTE1','Ne votez pas pour le m&ecirc;me site plus d\'une fois SVP.');
define('_RATENOTE2','L\'&eacute;chelle est de 1 &agrave; 10, 1 &eacute;tant <I> faible </I> et 10 <I> excellent </I>.');
define('_RATENOTE3','Soyez objectif dans votre vote, si chacun re&ccedil;oit un 1 ou un 10, le syst&egrave;me d\'&eacute;valuation n\'est plus tr&egrave;s utile.');
define('_RATENOTE5','Ne votez pas pour votre propre site ou le site d\'un concurrent.');
define('_RATERESOURCE','Evaluer un fichier');
define('_RATETHISSITE','Evaluez ce site Web');
define('_RATING','Evaluation');
define('_RATING1','Evaluation (du plus petit au plus grand score)');
define('_RATING2','Evaluation (du plus grand au plus petit score)');
define('_REGISTEREDUSERS','Utilisateurs enregistr&eacute;s');
define('_REMOTEFORM','Formulaire d\'&eacute;valuation &agrave; distance');
define('_REPORTBROKEN','Signaler un lien mort');
define('_REQUESTDOWNLOADMOD','Requ&ecirc;te de modification pour un produit');
define('_RESSORTED','Les fichiers sont actuellement tri&eacute;s par');
define('_RETURNTO','Retour &agrave;');
define('_SCOMMENTS','Commentaires');
define('_SEARCHRESULTS4','R&eacute;sultats de la recherche pour');
define('_SECURITYBROKEN','Pour des raisons de s&eacute;curit&eacute;, votre nom d\'utilisateur et votre num&eacute;ro IP seront temporairement enregistr&eacute;s.');
define('_SELECTPAGE','Selectionnez la page');
define('_SENDREQUEST','Envoyer votre requ&ecirc;te');
define('_SHOW','Montrer');
define('_SHOWTOP','Montrer le Top');
define('_SORTDOWNLOADSBY','Trier les fichiers par');
define('_STAFF','Equipe');
define('_TEXTLINK','Lien textuel');
define('_THANKSBROKEN','Merci de votre aide pour maintenir l\'int&eacute;grit&eacute; de ce r&eacute;pertoire.');
define('_THANKSFORINFO','Merci pour cette information.');
define('_THANKSTOTAKETIME','Merci de prendre le temps d\'&eacute;valuer les sites sur');
define('_THENUMBER','Le nombre');
define('_THEREARE','Il y a');
define('_TITLE','Titre');
define('_TITLEAZ','Titre (de A &agrave; Z)');
define('_TITLEZA','Title (de Z &agrave; A)');
define('_TO','&agrave;');
define('_TOPRATED','Mieux cot&eacute;s');
define('_TOTALNEWDOWNLOADS','Total des nouveaux fichiers');
define('_TOTALOF','Total de');
define('_TOTALVOTES','Total des votes:');
define('_TRATEDDOWNLOADS','fichiers &eacute;valu&eacute;s au total');
define('_TRY2SEARCH','Essayez de rechercher');
define('_TVOTESREQ','minimum de votes requis');
define('_UNKNOWN','Inconnus');
define('_UNREGISTEREDUSERS','Utilisateurs non-enregistr&eacute;s');
define('_URL','URL');
define('_USER','Utilisateur');
define('_USERANDIP','L\'identifiant utilisateur et le num&eacute;ro IP sont enregistr&eacute;s, n\'abusez pas du syst&egrave;me svp.');
define('_USERAVGRATING','Moyenne des &eacute;valuations de l\'utilisateur');
define('_USUBCATEGORIES','Sous-cat&eacute;gories');
define('_VERSION','Version');
define('_VOTE4THISSITE','Votez pour ce site !');
define('_WEIGHNOTE','* Note: Le poid que donne ce site aux &eacute;valuations des utilisateurs enregistr&eacute;s par rapport &agrave; celles des utilisateurs anonymes est de');
define('_WEIGHOUTNOTE','* Note: Le poid que donne ce site aux &eacute;valuations des utilisateurs enregistr&eacute;s par rapport &agrave; celles des utilisateurs ext&eacute;rieurs est de');
define('_YOUARENOTREGGED','Vous n\'&ecirc;tes pas un utilisateur enregistr&eacute;, ou vous ne vous &ecirc;tes pas connect&eacute;.');
define('_YOUAREREGGED','Vous &ecirc;tes un utilisateur enregistr&eacute; et vous &ecirc;tes connect&eacute;.');

?>