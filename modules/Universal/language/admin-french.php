<?php

#####################################################
#													#
#	Universal Module 2.5							#
#	For PHP-Nuke 6.5+								#
#	By Barry Caplin - http://www.e-devstudio.com	#
#													#
#	This is software is bound by the terms of the	#
#	license distrubuted with it. 					#
#	Please read license.txt							#
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.nukeplanet.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Copyright (c) 2007 - 2017 by http://www.platinumnukepro.com          */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on this CMS    */
/*******************************************************************************/
/* This file is part of the PlatinumNukePro CMS - http://platinumnukepro.com   */
/*                                                                             */
/* This program is free software; you can redistribute it and/or               */
/* modify it under the terms of the GNU General Public License                 */
/* as published by the Free Software Foundation; either version 2              */
/* of the License, or any later version.                                       */
/*                                                                             */
/* This program is distributed in the hope that it will be useful,             */
/* but WITHOUT ANY WARRANTY; without even the implied warranty of              */
/* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               */
/* GNU General Public License for more details.                                */
/*                                                                             */
/* You should have received a copy of the GNU General Public License           */
/* along with this program; if not, write to the Free Software                 */
/* Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA. */
/*******************************************************************************/

// Main Admin Header

define("_ADADMINMENU","Administration Principale");
define("_ADVERSIONCHECK","Vérifier la Version");
define("_ADPHPVERSION","Version PHP");
define("_ADMYSQLVERSION","Version MySQL");
define("_ADPRODUCTNAME","Produit");

// Module Statistics

define("_ADSTATUS","Status actuel du module");
define("_ADTOTALCAT","Nombre de Catégories");
define("_ADTOTALITEMS","Nombre d'articles");
define("_ADTOTALWAITING","Nombres d'articles en attente");
define("_ADTOTALREQUESTS","Nombre de requêtes");
define("_ADTOTALREQUESTSW","Nombre de requêtes en attente");
define("_ADWAITINGMODS","Modifications en attente");
define("_ADMODREQUESTSSW","Modifications en Instance");
define("_ADRLINKS","Liens relatifs");

// Admin Nav Block

define("_ADCONFIG","Configuration");
define("_ADCENSORLIST","Editer la liste de censure");
define("_AUTOAPPROVE","Auto Approuver les utilisateurs");
define("_ADADDNEWCAT2","Administration des catégories");
define("_ADREQUESTADMIN","Admin Requêtes");
define("_ADRELATEDADMIN","Admin liens relatifs.");
define("_ADMODIFYITEM","Modifier un article existant");
define("_ADDELETEITEM","Effacer un article existant");
define("_ACTIVEDEACTIVE","Active/Deactivate Items");
define("_ADADDNEWITEM","Ajouter une nouvelle entrée");
define("_ADMODIFYITEM","Modifier un article existant");
define("_ADDELETEITEM","Effacer un article existant");
define("_ADITEMQUEUE","Articles en attente dans la file");
define("_UPLOADIMAGE","Uploader une image");

// Module Links Block

define("_ADMAININDEX","Index Principal");
define("_ADSUBMITITEM","Soumettre un article");
define("_ADTOPRATED","Top des Votes");
define("_ADRANDOMITEM","Article aléatoire");
define("_ADMOSTWANTED","Plus désiré");

define("_ADMESSAGE","<strong><i><u>Qu'est ce que le module Universel??</u></i></strong><br><br>
		Le Module Universel est en son cœur un module d'enregistrement de contenu, il a été conçu au début
		pour l'affichage (REMARQUE : c'est le système le plus désiré) et vous pouvez tout faire et 
            afficher n'importe quoi juste en changeant les dossiers langage. .<br><br>Cette nouvelle version du 
		module Universel tire profit des options de style semblabme au (bbcode) comme
		<a target=\"_blank\" href=\"http://www.phpbb.com\">phpBB</a> pour ajouter des images, liens, 
		et autres options de style permettant d'ajouter du contenu très facilement. <br><br><strong><i><u>Comment utiliser le 
		Module Universel??</u></i></strong><br><br>Ce module est très aisé, juste naviguer dans la section 
		administration avec les liens situés à droite. <a href=\"modules.php?name=$modulename\">
		Le module principal</a> est aussi que facile dans sa navigation que son utilisation. <br><br>
		<strong><i><u>Commentaires à propos du Copyright??</u></i></strong><br><br><strong>AFFICHAGE DES NOTICES DU COPYRIGHT REQUISES</strong><br>
		Toutes les notes du copyright utilisée à l'intérieur du module que le module génére, DOIVENT rester 
		intact. De plus, ces notifications doivent rester visibles. La licence de ce module n'implique pas 
		la licence pour la revente ou redistribution de n'importe quel de ces articles sans la permission émise.<br><br>
		<strong>MODIFICATION ET DISTRIBUTION</strong><br>Les utilisateurs peuvent changer ou peuvent modifier le module à leur propre risque, mais 
		Mais seulement pour leur propre usage. Vous pouvez  aussi  me demander pour modifier votre propre copie du module. <br><br>
		Bien que les utilisateurs peuvent modifier le code pour leur propore usage, leur code modifié ne peut pas être vendu 
		ou distribué, sans ma permission écrite express. Cette interdiction s'applique à mon code modifié 
		et n'importe quel code développé par les utilisateurs spécialement utilisé avec mes modules. <br><br>
		<strong><i><u>Comment pouvoir vous venir en aide??</u></i></strong><br><br>Si vous aimez mon travail et que vous souhaitez 
		m'apporter votre soutien, vous pouvez faire un don par l'intermédiaire de paypal pour cela il vous suffit de 
		cliquer sur le bouton ci-dessous: <center>
		<form action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"post\" target=\"_blank\">
		<input type=\"hidden\" name=\"cmd\" value=\"_xclick\">
		<input type=\"hidden\" value=\"bcaplin@hypermax.net.au\" name=\"business\">
		<input type=\"hidden\" value=\"Don pour Universal Module\" name=\"item_name\">
		<input type=\"image\" alt=\"Make payments with PayPal - it's fast, free and secure!\" 
		src=\"modules/$modulename/images/paypal5.png\" border=\"0\" name=\"submit\"> 
		</form></center><p><i>Si vous suivez ces règles, il n'y aura pas de problème :D,<br>
		<strong>Barry Caplin<br>Développeur du module Universel.</strong></i>");

// Configuration Setttings

define("_MAINCMESS","Configuration du module universel");
define("_MODTITLE","Titre du Module");
define("_RIGHTBLOCKS","Blocs de droite");
define("_LOGOIMAGE","Logo Image");
define("_ITEMSPERPAGE","Articles par Page");
define("_ALLOWUSERSUBMIT","Autoriser les utilisateurs à soumettre");
define("_ITEMSONPAGE","Combien d'articles sur la page news");
define("_VIEWSPOPULAR","Lectures pour qu'un article soit populaire");
define("_ONPOPULARPAGE","Combien d'articles sur la page populaire");
define("_MAXSEARCHRESULTS","Maximum de résultats de recherche affichés");
define("_SHOWITEMQUEUE","Montrer les articles dans la file d'attente sur l'Index");
define("_ONLYREGUSERS","Seulement les utilisateurs enregistrés peuvent soumettre des articles");
define("_SUBMITMODIFYR","Autoriser les utilisateurs à soumettre des requêtes de modification");
define("_IMAGEUPLOADUSERS","Autoriser les utilisateurs à uploader des images");
define("_RESTRICTIMAGEUPLOAD","Restreindre l'uploade des images aux utilisateurs enregistrés");
define("_ALLOWCOMMENTS","Autoriser l'envoi de commentaires");
define("_RESTRICTCOMMENTS","Restreindre l'envoi de commentaires aux utilisateurs enregistrés");
define("_MAXTOPRATED","Max. Nombre d'articles sur la page des estimation");
define("_MAINPREFIX","Préfixe principale de la base de données");
define("_MOSTPOPBLOCK","Bloc plus populaire sur le Module Index");
define("_NEWBLOCK","Bloc nouveau sur le module Index");
define("_MAXSUBCATS","Max. Sous-catégories affichées en bas de la principale");
define("_ALLOWRATINGS","Autoriser le vote dans les articles");
define("_MOSTWANTEDSYSTEM","Plus recherchés Système");
define("_MWPOSTINGLEVEL","Système des plus recherchés affectation du rang");
define("_SORTBYTYPE","Classement par Type");
define("_MWPERPAGE","Articles par Page pour la section des plus recherchés");
define("_SAVESETTINGS","Sauvegarder les paramétres");
define("_ADYES","Oui");
define("_ADNO","Non");
define("_ADON","Marche");
define("_ADOFF","Arrêt");
define("_EVERYONE","Tout le monde");
define("_REGUSERS","Utilisateurs enregistrés");
define("_DROPDOWNBOX","Boite Drop-Down");
define("_TEXTLINKS","Liens");
define("_QUICKVIEW","Vue rapide sur le module index");
define("_QUICKVIEWNUM","Nombre d'articles dans l'affichage de la fonction de revue rapide");
define("_RANDOMQUICK","Faire une vue rapide d'un article aléatoire");
define("_QVARTICLE","Affichage de revue rapide d'un exemple de contenu");
define("_QVACHARLIMIT","Numbre de caractères that quickview displays du contenu");
define("_CATUSEDESCRIP","L'index des catégories affiche la description des articles, s'il n'y a pas un exemple de contenu");
define("_LIMITMODREQUESTS","Les requêtes de modifcation se limite à l'utilisateur qui a soumis l'article");
define("_JSCHECKING","Désactiver la vérification de l'auteur et du site web lors des soumissions d'articles");
define("_USEPHPBBNUMBERING","Autoriser le style phpBB dans la numérotation des pages");
define("_USEMULTILINGUELFEATURE","Autoriser les paramétres multilingue");
define("_NOSUBCATS","Désactiver les sous-catégories");

// Confirmation Entries

define("_ADSETTINGSUPDATED","Les paramétres de configuration du module ont été mis à jour");
define("_ADADDEDCWORD","Le mot choisi a été ajouté dans la liste de censure");
define("_ADSAVEDCWORD","La liste de censure a été mise à jour");
define("_ADDELETEDCWORD","Les mots de censure ont été effacés");
define("_CATEGORYSAVED","La Catégorie a été sauvegardée");
define("_CATDELETE1","La catégorie sélectionnée a été effacée.");
define("_CATDELETE2","La catégorie sélectionnée et les sous-catégories ont été effacées.");
define("_SUBCATADDED","La sous-catégorie a été ajoutée.");
define("_NEWCATADDED","La nouvelle catégorie a été ajoutée.");
define("_REQUESTADDED","La requête d'article a été ajoutée.");
define("_REQUESTDELETED","La requête d'article a été effacée");
define("_RELATEDLADDED","Le lien relatif a été ajouté et attaché à l'article requis");
define("_RELATEDLSAVED","Le lien relatif a été modifié avec succés");
define("_RELATEDLDELETED","Le lien relatif a été effacé.");
define("_ITEMADDEDC","L'article a été ajouté avec succès.");
define("_ITEMDELETED","L'article sélectionné a été effacé");
define("_ITEMSAVED","Les modifications de l'article sélectionné ont été sauvegardées");
define("_ITEMACTIVATED","L'article sélectionné est maintenant actif");
define("_ITEMDEACTIVATED","L'article sélectionné est maintenant désactivé");
define("_ITEMAPPROVED","L'article sélectionné a été ajouté à la base de données");
define("_ITEMQDELETED","L'article sélectionné a été effacé de la file d'attente");
define("_ITEMRAPPROVED","La requête de modification d'article a été approuvée. L'article a été mis à jour");
define("_ITEMRDELETED","La requête de modification d'article a été effacée");
define("_IMAGEUPLOADC","L'image sélectionnée a été mise à jour");

// Censor List

define("_CLWORD","Mots");
define("_CLFUNCTIONS","Fonctions");
define("_CLEDIT","Editer");
define("_CLDELETE","Effacer");
define("_CLADDWORD","Ajouter un mot dans la liste de censure");
define("_CLADDWORD2","Ajouter un mot");
define("_CLEDITINGWORD","Edition des mots censurés");
define("_CLCENSORWORD","Censurer des mots");
define("_CLSAVECHANGES","Sauvegarder les changements");
define("_CLDELETINGWORD","Effacement des mots censurés");
define("_CLDELTEINGWORD2","Etes vous sur de vouloir effacer les mots censurer");
define("_CLACTIONUNDONE","Cette action est irréversible");

// Used in any function

define("_RYES","Oui");
define("_RNO","Non");

// Auto-Approve User Control

define("_THEUSER","L'utilisateur");
define("_USERADDED","a été ajouté à la liste des auto-approuvés. Toutes les soumissions faites par cet utilisateur seront auto-approuvée");
define("_USERDOESNTEXITS","does not exist in the database. Please check the spelling and try again");
define("_HASBEENREMOVED","a été enlevé de la liste des utilisateurs auto-approuvés");
define("_USERSFOUND","The following user(s) that match your search request have been found");
define("_ADDUSERBUTTON","Ajouter un utilisateur");
define("_NORESULTS","Pas de résultat trouvé pour");
define("_ADDANUSER","Ajouter un utilisateur");
define("_SEARCHFORUSER","Ou rechercher pour un utilisateur");
define("_SEARCHBUTTON","Rechercher");
define("_SEARCHPMATCHES","Manchettes partiels");
define("_SEARCHAMATCHES","Toutes les manchettes");
define("_UCUSERNAME","Nom d'utilisateur");

// Edit Category

define("_ADEDITCAT","Editer/Effacer une Catégorie");
define("_ADCAT","Catégorie");
define("_ADEDIT","Editer");
define("_ADDELETE","Effacer");
define("_EDITACAT","Editer une Catégorie");
define("_ID","ID");
define("_SAVECHANGES","Sauvegarder les changements");
define("_DELCAT","Effacer la catégorie");
define("_NCATITLE","Titre");
define("_NCADESCRIP","Description");
define("_ADGOBUTTON","Go");

// Add New Category

define("_ADADDNEWCAT","Ajouter une nouvelle Catégorie");
define("_ADTITLE","Titre");
define("_ADDESCRIP","Description");
define("_ADADD","Ajouter");

// New Sub Cat

define("_ADNEWSUBCAT","Ajouter une nouvelle Sous-Catégorie");
define("_ADPCAT","Catégorie en relation");

// Category Deletation

define("_DELCAT","Effacer la Catégorie");
define("_DELETE1","Effacer la catégorie");
define("_DELETECONFIRM","Etes vous sur de vouloir effacer cette catégorie");
define("_DELETEWARNBIG","AVERTISSEMENT");
define("_NOTE2","Si vous effacer une catégorie principale, toutes les sous-catégories contenues dedans seront effacées aussi.");
define("_DELETE2","Cette action ne peut revenir en arrière.");

// Request Administration

define("_APPROVEREQUEST","Approuver");
define("_RSUBMIT","Soumis");

// Item Queue

define("_SUBMITTER","Soumis par");
define("_FUNCTION","Fonctions");
define("_PREVIEW","Aperçu");
define("_DELETEITEMTOP","Effacer un article");
define("_DELETEITEM","Etes vous sur de vouloir effacer l'article");

// Related Link System

define("_ADDRELATED","Ajouter un lien relatif");
define("_ADDRELATED2","Ajout d'un lien relatif");
define("_EDITRLINK","Edition d'un lien relatif");
define("_LINKTITLE","Titre du lien");
define("_LINKURL","URL du lien");
define("_SAVERELATED","Sauvegarder un lien relatif");
define("_DELRELATEDLINK","Etes vous sûr de vouloir effacer le lien relatif");
define("_ATTACHEDITEM","Attaché à l'article");
define("_WARNINGBIG","AVERTISSEMENT");
define("_WARNMESS","Cette action sera irréversible");
define("_RLINKTITLE","Lien relatif sauvegardé dans la base de données.");
define("_RLINK","Lien relatif");
define("_RATTACHED","Cet article est attaché à");
define("_RFUNCTIONS","Fonctions");
define("_RITEM","Contenu");
define("_RYES","Oui");
define("_RNO","Non");
define("_SELECTCAT","Veuillez sélectionner une catégorie en premier");
define("_SWITCHWARNING","WARNING: Si vous avez changé le titre/adresse d'un lien, vous avez altérés également les vleursau pour le changement des catégories.");

// BBCode Stuff

define("_TUTBBCODE", "Code");
define("_TUTBBQUOTE", "Citer");
define("_TUTBBWROTE", "Ecrire");
define("_TUTBBDARKRED", "Rouge foncé");
define("_TUTBBRED", "Rouge");
define("_TUTBBORANGE", "Orange");
define("_TUTBBBROWN", "Marron");
define("_TUTBBYELLOW", "Jaune");
define("_TUTBBGREEN", "Vert");
define("_TUTBBOLIVE", "Olive");
define("_TUTBBCYAN", "Cyan");
define("_TUTBBBLUE", "Bleu");
define("_TUTBBDARKBLUE", "Bleu foncé");
define("_TUTBBINDIGO", "Indigo");
define("_TUTBBVIOLET", "Violet");
define("_TUTBBWHITE", "Blanc");
define("_TUTBBBLACK", "Noir");
define("_TUTBBFONTCOLOR", "Couleur de la police");
define("_TUTBBTINY", "Minuscule");
define("_TUTBBSMALL", "Petite");
define("_TUTBBNORMAL", "Normale");
define("_TUTBBLARGE", "Grande");
define("_TUTBBHUGH", "Très grande");
define("_TUTBBFONTSIZE", "Taille de la police");
define("_TUTBBFONTDEFAULT", "Police par défaut");

// Misc

define("_MODIFY","Modifier");
define("_INSERTPB","Insérer un Pagebreak");
define("_SNORESULTS","Pas de résultat trouvé à votre demande");
define("_SFRESULTS","Pour poursuivre les résultats où retourner pour votre demande");
define("_PREVIEWIMAGE","Activer l'Image");
define("_ITEMACTIVATE","Activer");
define("_ITEMDEACTIVEATE","Désactiver");

// Upload an Image

define("_UPLOADANIMAGE","Uploader une image");
define("_SELECTIMAGE","Veuillez sélectionner un image à uploader");
define("_UPLOADIMAGE","Uploader un Image");
define("_UPIERROR","Erreur: Vous devez sélectionner un fichier image valide à uploader");

// Comments Control

define("_EDITINGCOMMENT","Edition d'un commentaire");
define("_COMMENT","Commentaire");
define("_EDITCOMMENT","Editer un Commentaire");
define("_DELETINGCOMMENT","Effacement d'un Commentaire");
define("_COMAREYOUSURE","Etes vous sûr de vouloir effacer ce commentaire");

?>