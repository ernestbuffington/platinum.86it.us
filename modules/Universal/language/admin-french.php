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
define("_ADVERSIONCHECK","V�rifier la Version");
define("_ADPHPVERSION","Version PHP");
define("_ADMYSQLVERSION","Version MySQL");
define("_ADPRODUCTNAME","Produit");

// Module Statistics

define("_ADSTATUS","Status actuel du module");
define("_ADTOTALCAT","Nombre de Cat�gories");
define("_ADTOTALITEMS","Nombre d'articles");
define("_ADTOTALWAITING","Nombres d'articles en attente");
define("_ADTOTALREQUESTS","Nombre de requ�tes");
define("_ADTOTALREQUESTSW","Nombre de requ�tes en attente");
define("_ADWAITINGMODS","Modifications en attente");
define("_ADMODREQUESTSSW","Modifications en Instance");
define("_ADRLINKS","Liens relatifs");

// Admin Nav Block

define("_ADCONFIG","Configuration");
define("_ADCENSORLIST","Editer la liste de censure");
define("_AUTOAPPROVE","Auto Approuver les utilisateurs");
define("_ADADDNEWCAT2","Administration des cat�gories");
define("_ADREQUESTADMIN","Admin Requ�tes");
define("_ADRELATEDADMIN","Admin liens relatifs.");
define("_ADMODIFYITEM","Modifier un article existant");
define("_ADDELETEITEM","Effacer un article existant");
define("_ACTIVEDEACTIVE","Active/Deactivate Items");
define("_ADADDNEWITEM","Ajouter une nouvelle entr�e");
define("_ADMODIFYITEM","Modifier un article existant");
define("_ADDELETEITEM","Effacer un article existant");
define("_ADITEMQUEUE","Articles en attente dans la file");
define("_UPLOADIMAGE","Uploader une image");

// Module Links Block

define("_ADMAININDEX","Index Principal");
define("_ADSUBMITITEM","Soumettre un article");
define("_ADTOPRATED","Top des Votes");
define("_ADRANDOMITEM","Article al�atoire");
define("_ADMOSTWANTED","Plus d�sir�");

define("_ADMESSAGE","<strong><i><u>Qu'est ce que le module Universel??</u></i></strong><br><br>
		Le Module Universel est en son c�ur un module d'enregistrement de contenu, il a �t� con�u au d�but
		pour l'affichage (REMARQUE : c'est le syst�me le plus d�sir�) et vous pouvez tout faire et 
            afficher n'importe quoi juste en changeant les dossiers langage. .<br><br>Cette nouvelle version du 
		module Universel tire profit des options de style semblabme au (bbcode) comme
		<a target=\"_blank\" href=\"http://www.phpbb.com\">phpBB</a> pour ajouter des images, liens, 
		et autres options de style permettant d'ajouter du contenu tr�s facilement. <br><br><strong><i><u>Comment utiliser le 
		Module Universel??</u></i></strong><br><br>Ce module est tr�s ais�, juste naviguer dans la section 
		administration avec les liens situ�s � droite. <a href=\"modules.php?name=$modulename\">
		Le module principal</a> est aussi que facile dans sa navigation que son utilisation. <br><br>
		<strong><i><u>Commentaires � propos du Copyright??</u></i></strong><br><br><strong>AFFICHAGE DES NOTICES DU COPYRIGHT REQUISES</strong><br>
		Toutes les notes du copyright utilis�e � l'int�rieur du module que le module g�n�re, DOIVENT rester 
		intact. De plus, ces notifications doivent rester visibles. La licence de ce module n'implique pas 
		la licence pour la revente ou redistribution de n'importe quel de ces articles sans la permission �mise.<br><br>
		<strong>MODIFICATION ET DISTRIBUTION</strong><br>Les utilisateurs peuvent changer ou peuvent modifier le module � leur propre risque, mais 
		Mais seulement pour leur propre usage. Vous pouvez  aussi  me demander pour modifier votre propre copie du module. <br><br>
		Bien que les utilisateurs peuvent modifier le code pour leur propore usage, leur code modifi� ne peut pas �tre vendu 
		ou distribu�, sans ma permission �crite express. Cette interdiction s'applique � mon code modifi� 
		et n'importe quel code d�velopp� par les utilisateurs sp�cialement utilis� avec mes modules. <br><br>
		<strong><i><u>Comment pouvoir vous venir en aide??</u></i></strong><br><br>Si vous aimez mon travail et que vous souhaitez 
		m'apporter votre soutien, vous pouvez faire un don par l'interm�diaire de paypal pour cela il vous suffit de 
		cliquer sur le bouton ci-dessous: <center>
		<form action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"post\" target=\"_blank\">
		<input type=\"hidden\" name=\"cmd\" value=\"_xclick\">
		<input type=\"hidden\" value=\"bcaplin@hypermax.net.au\" name=\"business\">
		<input type=\"hidden\" value=\"Don pour Universal Module\" name=\"item_name\">
		<input type=\"image\" alt=\"Make payments with PayPal - it's fast, free and secure!\" 
		src=\"modules/$modulename/images/paypal5.png\" border=\"0\" name=\"submit\"> 
		</form></center><p><i>Si vous suivez ces r�gles, il n'y aura pas de probl�me :D,<br>
		<strong>Barry Caplin<br>D�veloppeur du module Universel.</strong></i>");

// Configuration Setttings

define("_MAINCMESS","Configuration du module universel");
define("_MODTITLE","Titre du Module");
define("_RIGHTBLOCKS","Blocs de droite");
define("_LOGOIMAGE","Logo Image");
define("_ITEMSPERPAGE","Articles par Page");
define("_ALLOWUSERSUBMIT","Autoriser les utilisateurs � soumettre");
define("_ITEMSONPAGE","Combien d'articles sur la page news");
define("_VIEWSPOPULAR","Lectures pour qu'un article soit populaire");
define("_ONPOPULARPAGE","Combien d'articles sur la page populaire");
define("_MAXSEARCHRESULTS","Maximum de r�sultats de recherche affich�s");
define("_SHOWITEMQUEUE","Montrer les articles dans la file d'attente sur l'Index");
define("_ONLYREGUSERS","Seulement les utilisateurs enregistr�s peuvent soumettre des articles");
define("_SUBMITMODIFYR","Autoriser les utilisateurs � soumettre des requ�tes de modification");
define("_IMAGEUPLOADUSERS","Autoriser les utilisateurs � uploader des images");
define("_RESTRICTIMAGEUPLOAD","Restreindre l'uploade des images aux utilisateurs enregistr�s");
define("_ALLOWCOMMENTS","Autoriser l'envoi de commentaires");
define("_RESTRICTCOMMENTS","Restreindre l'envoi de commentaires aux utilisateurs enregistr�s");
define("_MAXTOPRATED","Max. Nombre d'articles sur la page des estimation");
define("_MAINPREFIX","Pr�fixe principale de la base de donn�es");
define("_MOSTPOPBLOCK","Bloc plus populaire sur le Module Index");
define("_NEWBLOCK","Bloc nouveau sur le module Index");
define("_MAXSUBCATS","Max. Sous-cat�gories affich�es en bas de la principale");
define("_ALLOWRATINGS","Autoriser le vote dans les articles");
define("_MOSTWANTEDSYSTEM","Plus recherch�s Syst�me");
define("_MWPOSTINGLEVEL","Syst�me des plus recherch�s affectation du rang");
define("_SORTBYTYPE","Classement par Type");
define("_MWPERPAGE","Articles par Page pour la section des plus recherch�s");
define("_SAVESETTINGS","Sauvegarder les param�tres");
define("_ADYES","Oui");
define("_ADNO","Non");
define("_ADON","Marche");
define("_ADOFF","Arr�t");
define("_EVERYONE","Tout le monde");
define("_REGUSERS","Utilisateurs enregistr�s");
define("_DROPDOWNBOX","Boite Drop-Down");
define("_TEXTLINKS","Liens");
define("_QUICKVIEW","Vue rapide sur le module index");
define("_QUICKVIEWNUM","Nombre d'articles dans l'affichage de la fonction de revue rapide");
define("_RANDOMQUICK","Faire une vue rapide d'un article al�atoire");
define("_QVARTICLE","Affichage de revue rapide d'un exemple de contenu");
define("_QVACHARLIMIT","Numbre de caract�res that quickview displays du contenu");
define("_CATUSEDESCRIP","L'index des cat�gories affiche la description des articles, s'il n'y a pas un exemple de contenu");
define("_LIMITMODREQUESTS","Les requ�tes de modifcation se limite � l'utilisateur qui a soumis l'article");
define("_JSCHECKING","D�sactiver la v�rification de l'auteur et du site web lors des soumissions d'articles");
define("_USEPHPBBNUMBERING","Autoriser le style phpBB dans la num�rotation des pages");
define("_USEMULTILINGUELFEATURE","Autoriser les param�tres multilingue");
define("_NOSUBCATS","D�sactiver les sous-cat�gories");

// Confirmation Entries

define("_ADSETTINGSUPDATED","Les param�tres de configuration du module ont �t� mis � jour");
define("_ADADDEDCWORD","Le mot choisi a �t� ajout� dans la liste de censure");
define("_ADSAVEDCWORD","La liste de censure a �t� mise � jour");
define("_ADDELETEDCWORD","Les mots de censure ont �t� effac�s");
define("_CATEGORYSAVED","La Cat�gorie a �t� sauvegard�e");
define("_CATDELETE1","La cat�gorie s�lectionn�e a �t� effac�e.");
define("_CATDELETE2","La cat�gorie s�lectionn�e et les sous-cat�gories ont �t� effac�es.");
define("_SUBCATADDED","La sous-cat�gorie a �t� ajout�e.");
define("_NEWCATADDED","La nouvelle cat�gorie a �t� ajout�e.");
define("_REQUESTADDED","La requ�te d'article a �t� ajout�e.");
define("_REQUESTDELETED","La requ�te d'article a �t� effac�e");
define("_RELATEDLADDED","Le lien relatif a �t� ajout� et attach� � l'article requis");
define("_RELATEDLSAVED","Le lien relatif a �t� modifi� avec succ�s");
define("_RELATEDLDELETED","Le lien relatif a �t� effac�.");
define("_ITEMADDEDC","L'article a �t� ajout� avec succ�s.");
define("_ITEMDELETED","L'article s�lectionn� a �t� effac�");
define("_ITEMSAVED","Les modifications de l'article s�lectionn� ont �t� sauvegard�es");
define("_ITEMACTIVATED","L'article s�lectionn� est maintenant actif");
define("_ITEMDEACTIVATED","L'article s�lectionn� est maintenant d�sactiv�");
define("_ITEMAPPROVED","L'article s�lectionn� a �t� ajout� � la base de donn�es");
define("_ITEMQDELETED","L'article s�lectionn� a �t� effac� de la file d'attente");
define("_ITEMRAPPROVED","La requ�te de modification d'article a �t� approuv�e. L'article a �t� mis � jour");
define("_ITEMRDELETED","La requ�te de modification d'article a �t� effac�e");
define("_IMAGEUPLOADC","L'image s�lectionn�e a �t� mise � jour");

// Censor List

define("_CLWORD","Mots");
define("_CLFUNCTIONS","Fonctions");
define("_CLEDIT","Editer");
define("_CLDELETE","Effacer");
define("_CLADDWORD","Ajouter un mot dans la liste de censure");
define("_CLADDWORD2","Ajouter un mot");
define("_CLEDITINGWORD","Edition des mots censur�s");
define("_CLCENSORWORD","Censurer des mots");
define("_CLSAVECHANGES","Sauvegarder les changements");
define("_CLDELETINGWORD","Effacement des mots censur�s");
define("_CLDELTEINGWORD2","Etes vous sur de vouloir effacer les mots censurer");
define("_CLACTIONUNDONE","Cette action est irr�versible");

// Used in any function

define("_RYES","Oui");
define("_RNO","Non");

// Auto-Approve User Control

define("_THEUSER","L'utilisateur");
define("_USERADDED","a �t� ajout� � la liste des auto-approuv�s. Toutes les soumissions faites par cet utilisateur seront auto-approuv�e");
define("_USERDOESNTEXITS","does not exist in the database. Please check the spelling and try again");
define("_HASBEENREMOVED","a �t� enlev� de la liste des utilisateurs auto-approuv�s");
define("_USERSFOUND","The following user(s) that match your search request have been found");
define("_ADDUSERBUTTON","Ajouter un utilisateur");
define("_NORESULTS","Pas de r�sultat trouv� pour");
define("_ADDANUSER","Ajouter un utilisateur");
define("_SEARCHFORUSER","Ou rechercher pour un utilisateur");
define("_SEARCHBUTTON","Rechercher");
define("_SEARCHPMATCHES","Manchettes partiels");
define("_SEARCHAMATCHES","Toutes les manchettes");
define("_UCUSERNAME","Nom d'utilisateur");

// Edit Category

define("_ADEDITCAT","Editer/Effacer une Cat�gorie");
define("_ADCAT","Cat�gorie");
define("_ADEDIT","Editer");
define("_ADDELETE","Effacer");
define("_EDITACAT","Editer une Cat�gorie");
define("_ID","ID");
define("_SAVECHANGES","Sauvegarder les changements");
define("_DELCAT","Effacer la cat�gorie");
define("_NCATITLE","Titre");
define("_NCADESCRIP","Description");
define("_ADGOBUTTON","Go");

// Add New Category

define("_ADADDNEWCAT","Ajouter une nouvelle Cat�gorie");
define("_ADTITLE","Titre");
define("_ADDESCRIP","Description");
define("_ADADD","Ajouter");

// New Sub Cat

define("_ADNEWSUBCAT","Ajouter une nouvelle Sous-Cat�gorie");
define("_ADPCAT","Cat�gorie en relation");

// Category Deletation

define("_DELCAT","Effacer la Cat�gorie");
define("_DELETE1","Effacer la cat�gorie");
define("_DELETECONFIRM","Etes vous sur de vouloir effacer cette cat�gorie");
define("_DELETEWARNBIG","AVERTISSEMENT");
define("_NOTE2","Si vous effacer une cat�gorie principale, toutes les sous-cat�gories contenues dedans seront effac�es aussi.");
define("_DELETE2","Cette action ne peut revenir en arri�re.");

// Request Administration

define("_APPROVEREQUEST","Approuver");
define("_RSUBMIT","Soumis");

// Item Queue

define("_SUBMITTER","Soumis par");
define("_FUNCTION","Fonctions");
define("_PREVIEW","Aper�u");
define("_DELETEITEMTOP","Effacer un article");
define("_DELETEITEM","Etes vous sur de vouloir effacer l'article");

// Related Link System

define("_ADDRELATED","Ajouter un lien relatif");
define("_ADDRELATED2","Ajout d'un lien relatif");
define("_EDITRLINK","Edition d'un lien relatif");
define("_LINKTITLE","Titre du lien");
define("_LINKURL","URL du lien");
define("_SAVERELATED","Sauvegarder un lien relatif");
define("_DELRELATEDLINK","Etes vous s�r de vouloir effacer le lien relatif");
define("_ATTACHEDITEM","Attach� � l'article");
define("_WARNINGBIG","AVERTISSEMENT");
define("_WARNMESS","Cette action sera irr�versible");
define("_RLINKTITLE","Lien relatif sauvegard� dans la base de donn�es.");
define("_RLINK","Lien relatif");
define("_RATTACHED","Cet article est attach� �");
define("_RFUNCTIONS","Fonctions");
define("_RITEM","Contenu");
define("_RYES","Oui");
define("_RNO","Non");
define("_SELECTCAT","Veuillez s�lectionner une cat�gorie en premier");
define("_SWITCHWARNING","WARNING: Si vous avez chang� le titre/adresse d'un lien, vous avez alt�r�s �galement les vleursau pour le changement des cat�gories.");

// BBCode Stuff

define("_TUTBBCODE", "Code");
define("_TUTBBQUOTE", "Citer");
define("_TUTBBWROTE", "Ecrire");
define("_TUTBBDARKRED", "Rouge fonc�");
define("_TUTBBRED", "Rouge");
define("_TUTBBORANGE", "Orange");
define("_TUTBBBROWN", "Marron");
define("_TUTBBYELLOW", "Jaune");
define("_TUTBBGREEN", "Vert");
define("_TUTBBOLIVE", "Olive");
define("_TUTBBCYAN", "Cyan");
define("_TUTBBBLUE", "Bleu");
define("_TUTBBDARKBLUE", "Bleu fonc�");
define("_TUTBBINDIGO", "Indigo");
define("_TUTBBVIOLET", "Violet");
define("_TUTBBWHITE", "Blanc");
define("_TUTBBBLACK", "Noir");
define("_TUTBBFONTCOLOR", "Couleur de la police");
define("_TUTBBTINY", "Minuscule");
define("_TUTBBSMALL", "Petite");
define("_TUTBBNORMAL", "Normale");
define("_TUTBBLARGE", "Grande");
define("_TUTBBHUGH", "Tr�s grande");
define("_TUTBBFONTSIZE", "Taille de la police");
define("_TUTBBFONTDEFAULT", "Police par d�faut");

// Misc

define("_MODIFY","Modifier");
define("_INSERTPB","Ins�rer un Pagebreak");
define("_SNORESULTS","Pas de r�sultat trouv� � votre demande");
define("_SFRESULTS","Pour poursuivre les r�sultats o� retourner pour votre demande");
define("_PREVIEWIMAGE","Activer l'Image");
define("_ITEMACTIVATE","Activer");
define("_ITEMDEACTIVEATE","D�sactiver");

// Upload an Image

define("_UPLOADANIMAGE","Uploader une image");
define("_SELECTIMAGE","Veuillez s�lectionner un image � uploader");
define("_UPLOADIMAGE","Uploader un Image");
define("_UPIERROR","Erreur: Vous devez s�lectionner un fichier image valide � uploader");

// Comments Control

define("_EDITINGCOMMENT","Edition d'un commentaire");
define("_COMMENT","Commentaire");
define("_EDITCOMMENT","Editer un Commentaire");
define("_DELETINGCOMMENT","Effacement d'un Commentaire");
define("_COMAREYOUSURE","Etes vous s�r de vouloir effacer ce commentaire");

?>