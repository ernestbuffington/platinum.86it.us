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

define("_UMIINSTALLTITLE","Installation du module Universel");
define("_UMINOTALLOWED","Vous n'êtes pas autorisé à accéder à ce fichier");

define("_UMIWARNBIG","AVERTISSEMENT");
define("_UMICANTWRITE1","Je ne peux écrire dans");
define("_UMICANTWRITE2","Veuillez  autorisé ce dossier en écriture autrement l'installation ne pourra être complétée");
define("_UMICANTWRITE3","S'il vous plaît");
define("_UMICANTWRITE4","essayez après avoir autorisé le dossier en écriture");
define("_UMICLICKHERE","Cliquer ici");

define("_UMIINSTALLTITLE2","Système d'installation du module Universel 2.5");
define("_UMINEWINSTALL","Nouvelle installation");
define("_UMINEWINSTALLMESS1","Cliquer ce bouton, si c'est une première installation");
define("_UMINEWINSTALLMESS2","Ceci annulera toutes tables existantes");
define("_UMINEWINSTALLMESS3","Si elles ont votre préfixe choisi");
define("_UMIUPGRADEFROM","Mise à jour de");
define("_UMIUPGRADE1MESS","Ciquez sur ce bouton, si vous mettez à jour de");

define("_UMITYPEMAINPREFIX","Veuillez taper votre préfixe principal pour votre base de données");
define("_UMIDEFAULTPREFIX","Si vous n'en entrez pas un, par défaut 'articles' sera utilisé");
define("_UMICONTINUEINSTALL","Continuer l'Installation");

define("_MAINCMESS","Configuration du module Universel");
define("_MODTITLE","Titre du Module");
define("_RIGHTBLOCKS","Blocs droits");
define("_LOGOIMAGE","Image du logo");
define("_ITEMSPERPAGE","Articles par Page");
define("_ALLOWUSERSUBMIT","Autoriser les utilisateurs à soumettre");
define("_ITEMSONPAGE","Combien d'articles sur la nouvelle page");
define("_VIEWSPOPULAR","Lectures pour que l'article soit populaire");
define("_ONPOPULARPAGE","Combien d'articles sur la page populaire");
define("_MAXSEARCHRESULTS","Maximum de résultats de recherche autorisés");
define("_SHOWITEMQUEUE","Montrer les articles en attente dans la file sur l'Index");
define("_ONLYREGUSERS","Seuls les utiloisateurs enregistrés peuvent soumettre des articles");
define("_SUBMITMODIFYR","Autoriser les utilisateurs à soumettre des requêtes de modification");
define("_IMAGEUPLOADUSERS","Autoriser l'uploade des images pour les utilisateurs");
define("_RESTRICTIMAGEUPLOAD","Restreindre l'uploade des images aux utilisateurs enregistrés");
define("_ALLOWCOMMENTS","Autoriser l'envoi de commentaire");
define("_RESTRICTCOMMENTS","Restraindre l'envoi des commentaires aux utilisateurs enregistrés");
define("_MAXTOPRATED","Max. Nombre d'articles sur la page estimation");
define("_MAINPREFIX","Préfixe de la base de données principale");
define("_MOSTPOPBLOCK","Bloc plus populaire sur l'index du module");
define("_NEWBLOCK","Bloc nouveau sur l'index du module");
define("_MAXSUBCATS","Max. Sous-catégories affichées dans le bas de la première page");
define("_ALLOWRATINGS","Autoriser à voter dans les articles");
define("_MOSTWANTEDSYSTEM","Système des plus recherchés");
define("_MWPOSTINGLEVEL","Système des plus recherchés rang signalétique");
define("_SORTBYTYPE","Classer par Type");
define("_MWPERPAGE","Articles par page pour la section la plus recherchée");
define("_SAVESETTINGS","Sauvegarder les paramétres");
define("_ADYES","Oui");
define("_ADNO","Non");
define("_ADON","Marche");
define("_ADOFF","Arrêt");
define("_EVERYONE","Tout le monde");
define("_REGUSERS","Utilisateurs Enreg.");
define("_ADMINONLY","Les admins seulement");
define("_DROPDOWNBOX","Boite Drop-Down");
define("_TEXTLINKS","Liens Texte");
define("_QUICKVIEW","Revue Rapide dans l'index du module");
define("_QUICKVIEWNUM","Nombre d'articles à afficher dans la fonction revue rapide");
define("_RANDOMQUICK","Faire une revue rapide des articles aléatoires");
define("_QVARTICLE","Affichage de revue rapide d'un exemple de contenu");
define("_QVACHARLIMIT","Numbre de caractères that quickview displays du contenu");
define("_CATUSEDESCRIP","L'index des catégories affiche la description des articles, s'il n'y a pas un exemple de contenu");
define("_LIMITMODREQUESTS","Les requêtes de modifcation se limite à l'utilisateur qui a soumis l'article");
define("_JSCHECKING","Désactiver la vérification de l'auteur et du site web lors des soumissions d'articles");
define("_USEPHPBBNUMBERING","Autoriser la numérotation des pages style phpBB");
define("_USEMULTILINGUELFEATURE","Autoriser les paramétres multilingue");
define("_NOSUBCATS","Désactiver les Sous-Catégories");

define("_UMIINSTALLCOMPLETE","Installation Complète");
define("_UMIPLEASEDELETE","Veuillez effacer ce fichier immédiatement pour éviter à quelqu'un de");
define("_UMIRESETDATABASE","réinstaller votre base de données");
define("_UMIUPGRADECOMPLETE","Mise à Jour Complète");

?>