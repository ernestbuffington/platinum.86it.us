<?php 
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.2.2   nuke - Language Pack 0.93                //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002,2003 Gregory DEMAR <gdemar@wanadoo.fr>                 //
// http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                        //
// (http://coppermine.sf.net/team/)                                          //
// see /docs/credits.html for details                                        //
// ------------------------------------------------------------------------- //
// New Port by GoldenTroll                                                  //
// http://coppermine.findhere.org/                                          //
// Based on coppermine 1.1d by Surf  http://www.surf4all.net/               //
// ------------------------------------------------------------------------- //
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
// to all devs: stop update just before committing this file!
// info about translators and translated language
define('PIC_VIEWS', 'T�l�chargements');
define('PIC_VOTES', 'Votes');
define('PIC_COMMENTS', 'Commentaires');

$lang_translation_info = array('lang_name_english' => 'French', // the name of your language in English, e.g. 'Greek' or 'Spanish'
    'lang_name_native' => 'Fran�ais', // the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol'
    'lang_country_code' => 'fr', // the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
    'trans_name' => 'mels', // the name of the translator - can be a nickname
    'trans_email' => 'mels@wanadoo.fr', // translator's email address (optional)
    'trans_website' => 'http://www.everlasting-star.net/', // translator's website (optional)
    'trans_date' => '2003-10-15', // the date the translation was created / last modified
    );

$lang_charset = 'ISO-8859-1';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Octets', 'Ko', 'Mo');
// Day of weeks and months
$lang_day_of_week = array('Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam');
$lang_month = array('Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Aout', 'Sep', 'Oct', 'Nov', 'Dec');
// Some common strings
$lang_yes = 'Oui';
$lang_no = 'Non';
$lang_back = 'Retour';
$lang_continue = 'CONTINUER';
$lang_info = 'Information';
$lang_error = 'Erreur';
// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt = '%B %d, %Y';
$lastcom_date_fmt = '%m/%d/%y � %H:%M';
$lastup_date_fmt = '%B %d, %Y';
$register_date_fmt = '%B %d, %Y';
$lasthit_date_fmt = '%B %d, %Y � %I:%M %p';
$comment_date_fmt = '%B %d, %Y � %I:%M %p';
// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*', 'merde', 'putain', 'encul�*', 'salope', 'bite', 'cul', 'pute', 'p�nis', 'clito', 'couille', 'p�tasse', 'connard', 'salaud');

$lang_meta_album_names = array('random' => 'Images au hasard',
    'lastup' => 'Derniers ajouts',
    'lastupby' => 'My Last Additions', // new 1.2.2
    'lastalb' => 'Derniers albums mis en ligne',
    'lastcom' => 'Derniers commentaires',
    'lastcomby' => 'My Last comments', // new 1.2.2
    'topn' => 'Les plus populaires',
    'toprated' => 'Les mieux not�es',
    'lasthits' => 'Les derni�res vues',
    'search' => 'R�sultats de la recherche',
    'favpics' => 'Photos pr�f�r�es'
    );

$lang_errors = array('access_denied' => 'Vous n\'avez pas la permission d\'acc�der � cette page.',
    'perm_denied' => 'Vous n\'avez pas la permission d\'effectuer cette op�ration.',
    'param_missing' => 'Script appel� sans les param�tres n�cessaires.',
    'non_exist_ap' => 'L\'album/la photo demand�(e) n\'existe pas !',
    'quota_exceeded' => 'Espace disque d�pass�<br /><br />Vous avez un quota d\'espace de [quota]K, vos photos utilisent [space]K, le fait d\'ajouter cette photo vous ferait d�passer votre quota.',
    'gd_file_type_err' => 'L\'utilisation de "GD image library" ne vous permet d\'utiliser que de images de type JPEG et PNG.',
    'invalid_image' => 'L\'image que vous avez upload�e est corrompue ou ne peut pas �tre prise en charge par GD library',
    'resize_failed' => 'Impossible de cr�er l\'vignette ou l\'image r�duite.',
    'no_img_to_display' => 'Pas d\'image � afficher',
    'non_exist_cat' => 'La cat�gorie s�lectionn�e n\'existe pas',
    'orphan_cat' => 'Une cat�gorie a un parent inexistant, utilisez le gestionnaire de cat�gories afin de rem�dier au probl�me.',
    'directory_ro' => 'Le r�peretoire \'%s\' n\'est pas inscriptible : les images ne peuvent �tre supprim�es.',
    'non_exist_comment' => 'Le commentaire s�lectionn� n\'existe pas.',
    'pic_in_invalid_album' => 'L\'image se trouve dans un album qui n\'existe pas (%s)!?',
    'banned' => 'Vous �tes pour l\'instant banni de ce site.',
    'not_with_udb' => 'TCette fonction est d�sactiv�e dans Coppermine parce que la gallerie est int�gr�e � un forum. Soit l\'action que vous essayez d\'effectuer n\'est pas disponible dans cette configuration, soit vous devez l\'effectuer � partir du forum auquel vous avez int�gr� la galerie.',
    'members_only' => 'This function is for members only, please join.', // changed in cpg1.2.0nuke
    'mustbe_god' => 'This function is only for the site admin. You must be logged in as superadmin, god account to access this function'
    );
// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //
$lang_main_menu = array('alb_list_title' => 'Aller � la liste des albums',
    'alb_list_lnk' => 'Liste des albums',
    'my_gal_title' => 'Aller dans ma galerie personnelle',
    'my_gal_lnk' => 'Ma galerie',
    'my_prof_lnk' => 'Mon profil',
    'adm_mode_title' => 'Passer en mode admin',
    'adm_mode_lnk' => 'Mode admin',
    'usr_mode_title' => 'Passer en mode utilisateur',
    'usr_mode_lnk' => 'Mode utilisateur',
    'upload_pic_title' => 'Uploader une image dans un album',
    'upload_pic_lnk' => 'Uploader une image',
    'register_title' => 'Cr�er un compte',
    'register_lnk' => 'Inscription',
    'login_lnk' => 'S\'identifier',
    'logout_lnk' => 'Quitter',
    'lastup_lnk' => 'Derniers ajouts',
    'lastcom_lnk' => 'Derniers commentaires',
    'topn_lnk' => 'Images les plus populaires',
    'toprated_lnk' => 'Images les mieux not�es',
    'search_lnk' => 'Rechercher',
    'fav_lnk' => 'Mes favoris',
    );

$lang_gallery_admin_menu = array('upl_app_lnk' => 'Fichiers en attente',
    'config_lnk' => 'Configuration',
    'albums_lnk' => 'Albums',
    'categories_lnk' => 'Categories',
    'users_lnk' => 'Utilisateurs',
    'groups_lnk' => 'Groupes',
    'comments_lnk' => 'Commentaires',
    'searchnew_lnk' => 'FTP =>',
    'util_lnk' => 'Redimensionner les images',
    'ban_lnk' => 'Bannir des utilisateurs',
    );

$lang_user_admin_menu = array('albmgr_lnk' => 'Cr�er / classer mes albums',
    'modifyalb_lnk' => 'Modifier mes albums',
    'my_prof_lnk' => 'Mon profil',
    );

$lang_cat_list = array('category' => 'Cat�gorie',
    'albums' => 'Albums',
    'pictures' => 'Images',
    );

$lang_album_list = array('album_on_page' => '%d albums sur %d page(s)'
    );

$lang_thumb_view = array('date' => 'DATE',
    'name' => 'NOM DU FICHIER',
    'title' => 'TITRE',
    'sort_da' => 'Classer par date ascendantes',
    'sort_dd' => 'Classer par date descendantes',
    'sort_na' => 'Classer par nom ascendants',
    'sort_nd' => 'Classer par nom descendants',
    'sort_ta' => 'Classer par titre ascendants',
    'sort_td' => 'Classer par titre descendants',
    'pic_on_page' => '%d photos sur %d page(s)',
    'user_on_page' => '%d utilisateurs sur %d page(s)',
    'sort_ra' => 'Sort by rating ascending', // new in cpg1.2.0nuke
    'sort_rd' => 'Sort by rating descending', // new in cpg1.2.0nuke
    'rating' => 'RATING', // new in cpg1.2.0nuke
    'sort_title' => 'Sort pictures by:', // new in cpg1.2.0nuke
    );

$lang_img_nav_bar = array('thumb_title' => 'Retourner � la page des vignettes',
    'pic_info_title' => 'Afficher / cacher les informations sur l\'image',
    'slideshow_title' => 'Diaporama',
    'slideshow_disabled' => 'e-cards are disabled', // new in cpg1.2.0nuke
    'slideshow_disabled_msg' => $lang_errors['members_only'], // new in cpg1.2.0nuke
    'ecard_title' => 'Envoyer cette image en tant que carte �lectronique',
    'ecard_disabled' => 'les cartes �lectroniques sont d�sactiv�es',
    'ecard_disabled_msg' => 'Vous n\'avez pas l\'autorisation d\'envoyer des cartes',
    'prev_title' => 'Voir l\'image pr�c�dente',
    'next_title' => 'Voir l\'image suivante',
    'pic_pos' => 'PHOTO %s/%s',
    'no_more_images' => 'There are no more images in this gallery', // new in cpg1.2.0nuke
    'no_less_images' => 'This is the first image in the gallery', // new in cpg1.2.0nuke
    );

$lang_rate_pic = array('rate_this_pic' => 'Noter cette image ',
    'no_votes' => '(Pas encore de vote)',
    'rating' => '(note actuelle : %s / 5 pour %s votes)',
    'rubbish' => 'Tr�s mauvais',
    'poor' => 'Pauvre',
    'fair' => 'Moyen',
    'good' => 'Bon',
    'excellent' => 'Excellent',
    'great' => 'Superbe',
    );
// ------------------------------------------------------------------------- //
// File include/exif.inc.php
// ------------------------------------------------------------------------- //
// void
// ------------------------------------------------------------------------- //
// File include/functions.inc.php
// ------------------------------------------------------------------------- //
$lang_cpg_die = array(
    INFORMATION => $lang_info,
    ERROR => $lang_error,
    CRITICAL_ERROR => 'Erreur Critique',
    'file' => 'Fichier: ',
    'line' => 'Ligne: ',
    );

$lang_display_thumbnails = array('filename' => 'Nom du fichier : ',
    'filesize' => 'Poids du fichier : ',
    'dimensions' => 'Dimensions : ',
    'date_added' => 'Ajout� le : '
    );

$lang_get_pic_data = array('n_comments' => '%s commentaires',
    'n_views' => '%s t�l�chargements',
    'n_votes' => '(%s votes)'
    );
// ------------------------------------------------------------------------- //
// File include/init.inc.php
// ------------------------------------------------------------------------- //
// void
// ------------------------------------------------------------------------- //
// File include/picmgmt.inc.php
// ------------------------------------------------------------------------- //
// void
// ------------------------------------------------------------------------- //
// File include/smilies.inc.php
// ------------------------------------------------------------------------- //
if (defined('SMILIES_PHP')) $lang_smilies_inc_php = array('Exclamation' => 'Exclamation',
        'Question' => 'Question',
        'Very Happy' => 'Tr�s heureux',
        'Smile' => 'Sourire',
        'Sad' => 'Triste',
        'Surprised' => 'Surpris',
        'Shocked' => 'Choqu�',
        'Confused' => 'Confus',
        'Cool' => 'Cool',
        'Laughing' => 'Rire',
        'Mad' => 'Fou',
        'Razz' => 'Razz',
        'Embarassed' => 'Embarass�',
        'Crying or Very sad' => 'Pleure ou tr�s triste',
        'Evil or Very Mad' => 'Diabolique ou tr�s en col�re',
        'Twisted Evil' => 'Sadique',
        'Rolling Eyes' => 'L�ve les yeux au ciel',
        'Wink' => 'Clin d\'oeil',
        'Idea' => 'Id�e',
        'Arrow' => 'Fl�che',
        'Neutral' => 'Neutre',
        'Mr. Green' => 'Mr. Green',
        );
// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //
// void
// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //
if (defined('ADMIN_PHP')) $lang_admin_php = array(0 => 'D�connexion du mode administrateur...',
        1 => 'Passage au mode administrateur...',
        );
// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //
if (defined('ALBMGR_PHP')) $lang_albmgr_php = array('alb_need_name' => 'Les albums doivent avoir un nom !',
        'confirm_modifs' => 'Voulez-vous vraiment effectuer ces modifications ?',
        'no_change' => 'Vous n\'avez effectu� aucun changement !',
        'new_album' => 'Nouvel album',
        'confirm_delete1' => 'Voulez vous vraiment supprimer cet album ?',
        'confirm_delete2' => '\nToutes les images et tous les commentaires seront perdus !',
        'select_first' => 'Selectionnez d\'abord un album',
        'alb_mrg' => 'Gestionnaire d\'album',
        'my_gallery' => '* Ma galerie *',
        'no_category' => '* Pas de cat�gorie *',
        'delete' => 'Supprimer',
        'new' => 'Nouveau',
        'apply_modifs' => 'Appliquer les modifications',
        'select_category' => 'S�lectionner une categorie',
        );
// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) $lang_catmgr_php = array('miss_param' => 'Les param�tres requis pour l\'\'%s\'operation sont manquants !',
        'unknown_cat' => 'La cat�gorie s�lectionn�e n\'existe pas dans la base de donn�es',
        'usergal_cat_ro' => 'La galerie des utilisateurs ne peut pas �tre supprim�e!',
        'manage_cat' => 'G�rer les cat�gories',
        'confirm_delete' => 'Voulez vous vraiment SUPPRIMER cette cat�gorie ?',
        'category' => 'Categorie',
        'operations' => 'Op�rations',
        'move_into' => 'D�placer dans',
        'update_create' => 'Mettre � jour / cr�er la cat�gorie',
        'parent_cat' => 'Cat�gorie parente',
        'cat_title' => 'Titre de la cat�gorie',
        'cat_desc' => 'Description de la cat�gorie'
        );
// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //
if (defined('CONFIG_PHP')) $lang_config_php = array('title' => 'Configuration',
        'restore_cfg' => 'Restorer les param�tres d\'origine',
        'save_cfg' => 'Sauvergarder la nouvelle configuration',
        'notes' => 'Notes',
        'info' => 'Information',
        'upd_success' => 'La configuration de Coppermine a �t� mise � jour',
        'restore_success' => 'La configuration d\'origine de Coppermine a �t� restaur�e',
        'name_a' => 'Nom ascendant',
        'name_d' => 'Nom descendant',
        'title_a' => 'Titre ascendand',
        'title_d' => 'Titre descendant',
        'date_a' => 'Date ascendante',
        'date_d' => 'Date descendante',
        'rating_a' => 'Rating ascending', // new in cpg1.2.0nuke
        'rating_d' => 'Rating descending', // new in cpg1.2.0nuke
        'th_any' => 'Max Aspect',
        'th_ht' => 'Height',
        'th_wd' => 'Width'

        );
// start left side interpretation
if (defined('CONFIG_PHP'))
    $lang_config_data = array(
        // General settings
        'Param�tres g�n�raux',
        array(
            'Nom de la galerie', 'gallery_name', 0),
        array(
            'Description de la galerie', 'gallery_description', 0),
        array(
            'Email de l\'administrateur de la galerie', 'gallery_admin_email', 0),
        array(
            'Adresse sur laquelle le lien \'Voir plus de photos\' des e-cards doit pointer', 'ecards_more_pic_target', 0),
        array(
            'Langage', 'lang', 5),
// for postnuke change
        array(
            'Th�me', 'cpgtheme', 6),
        array(
            'Page Specific Titles instead of >Coppermine', 'nice_titles', 1), 
        array('Show blocks on the right', 'right_blocks', 1), // new 1.2.2
        // 'Album list view',
        'Affichage de la liste des albums',
        array(
            'Largeur du tableau principal (pixels ou %)', 'main_table_width', 0),
        array(
            'Nombre de niveaux de cat�gories � afficher', 'subcat_level', 0),
        array(
            'Nombre d\'albums � afficher', 'albums_per_page', 0),
        array(
            'Nombre de colonnes pour la liste des albums', 'album_list_cols', 0),
        array(
            'Taille des vignettes en pixels', 'alb_list_thumb_size', 0),
        array(
            'Le contenu de la page principale', 'main_page_layout', 0),
        array(
            'Afficher les vignettes de l\'album du premier niveau avec la cat�gorie', 'first_level', 1), 
        // 'Thumbnail view',
        'Affichage des vignettes',
        array(
            'Nombre de colonnes sur la page des vignettes', 'thumbcols', 0),
        array(
            'Nombre de lignes sur la page des vignettes', 'thumbrows', 0),
        array(
            'Nombre maximal d\'onglets � afficher', 'max_tabs', 0),
        array(
            'Afficher la l�gende de l\'image (en plus de son titre) sous la vignette', 'caption_in_thumbview', 1),
        array(
            'Afficher le nombre de commentaires sous les vignettes', 'display_comment_count', 1),
        array(
            'Classement par d�faut des images', 'default_sort_order', 3),
        array(
            'Nombre minimum de votes n�cessaires pour qu\'une image apparaisse dans la liste des images les mieux not�es', 'min_votes_for_rating', 0),
        array(
            'Alts and title tags of thumbnail show title and keyword instead of picinfo', 'seo_alts', 1), // new in cpg1.2.0nuke
        // 'Image view &amp; Comment settings',
        'Affichage des images &amp; param�tres des commentaires',
        array(
            'Largeur du tableau pour l\'affichage des images (pixels ou %)', 'picture_table_width', 0),
        array(
            'Les informations relatives � l\'image sont affich�es par d�faut', 'display_pic_info', 1),
        array(
            'Filtrer les gros mots dans les commentaires', 'filter_bad_words', 1),
        array(
            'Autoriser les smileys dans les commentaires', 'enable_smilies', 1),
        array(
            'Allow several consecutive comments on one pic from the same user', 'disable_flood_protection', 1), // new in cpg1.2.0nuke
        array(
            'Email site admin upon comment submission' , 'comment_email_notification', 1), // new in cpg1.2.0nuke
        array(
            'Longueur maximale pour la description des images', 'max_img_desc_length', 0),
        array(
            'Nombre maximal de lettres pour un mot', 'max_com_wlength', 0),
        array(
            'Nombre maximal de lignes pour un commentaire', 'max_com_lines', 0),
        array(
            'Longueur maximale d\'un commentaire', 'max_com_size', 0),
        array(
            'Afficher le n�gatif', 'display_film_strip', 1),
        array(
            'Nombre d\'images par n�gatif', 'max_film_strip_items', 0),
        array(
            'Allow viewing of full size pic by anonymous', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke
        array('Number of days between being able to vote on the same image','keep_votes_time',0), // new in cpg1.2.2c nuke
//'Pictures and thumbnails settings',
        'Param�tres des images et vignettes',
        array(
            'Qualit� pour les fichiers JPG', 'jpeg_qual', 0),
        array(
            'Dimension maximale pour les vignettes <strong>*</strong>', 'thumb_width', 0),
        array(
            'Utiliser la dimension ( largeur ou hauteur ou aspect max pour la vignette)<strong>*</strong>', 'thumb_use', 7),
        array(
            'Cr�er des images interm�diaires', 'make_intermediate', 1),
        array(
            'Largeur ou hauteur maximale pour une image interm�diaire <strong>*</strong>', 'picture_width', 0),
        array(
            'Poids max des images � uploader (Ko)', 'max_upl_size', 0),
        array(
            'Longueur ou hauteur maximale pour les images upload�es (en pixels)', 'max_upl_width_height', 0), 
        // 'User settings',
        'Param�tres Utilisateurs',
        array(
            'Autoriser de nouvelles inscriptions', 'allow_user_registration', 1),
        array(
            'L\'inscription d\'un nouvel utilisateur doit �tre valid�e', 'reg_requires_valid_email', 1),
        array(
            'Autoriser deux utilisateurs � avoir le m�me e-mail', 'allow_duplicate_emails_addr', 1),
        array(
            'Les utilisateurs peuvent avoir un album personnel', 'allow_private_albums', 1), 
        array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',
        'Champs libres pour les descriptions d\'images (� laisser tel quel si vous n\'utilisez pas cette fonction)',
        array(
            'Nom du champ 1', 'user_field1_name', 0),
        array(
            'Nom du champ 2', 'user_field2_name', 0),
        array(
            'Nom du champ 3', 'user_field3_name', 0),
        array(
            'Nom du champ 4', 'user_field4_name', 0), 
        // 'Pictures and thumbnails advanced settings',
        'Param�tres avanc�s des images et vignettes',
        array(
            'Afficher l\'ic�ne des albums priv�s aux utilisateurs non indentifi�s', 'show_private', 1),
        array(
            'Carat�res interdits dans les noms de fichiers', 'forbiden_fname_char', 0),
        array(
            'Extensions de fichiers accept�es pour les images � uploader', 'allowed_file_extensions', 0),
        array(
            'M�thode utilis�e pour redimensionner les images', 'thumb_method', 2),
        array(
            'Chemin vers l\'utilitaire de conversion ImageMagick (exemple : /usr/bin/X11/)', 'impath', 0),
        array(
            'Type d\'images autoris�es (valide seulement pour ImageMagick)', 'allowed_img_types', 0),
        array(
            'Options de ligne de commande pour ImageMagick', 'im_options', 0),
        array(
            'Lire les informations EXIF dans les fichiers JPEG', 'read_exif_data', 1),
        array(
            'Read IPTC data in JPEG files', 'read_iptc_data', 1), // new in cpg1.2.0nuke
        array(
            'R�pertoire de stockage de l\'album <strong>*</strong>', 'fullpath', 0),
        array(
            'R�pertoire pour les images des utilisateurs <strong>*</strong>', 'userpics', 0),
        array(
            'Pr�fixe des images interm�diares <strong>*</strong>', 'normal_pfx', 0),
        array(
            'Pr�fixe pour les vignettes <strong>*</strong>', 'thumb_pfx', 0),
        array(
            'Mode par d�faut des r�pertoires', 'default_dir_mode', 0),
        array(
            'Mode par d�faut des images', 'default_file_mode', 0),
        array(
            'Picinfo display filename', 'picinfo_display_filename', '1'), // new in cpg1.2.0nuke
        array(
            'Picinfo display album name', 'picinfo_display_album_name', '1'), // new in cpg1.2.0nuke
        array(
            'Picinfo display_file_size', 'picinfo_display_file_size', '1'), // new in cpg1.2.0nuke
        array(
            'Picinfo display_dimensions', 'picinfo_display_dimensions', '1'), // new in cpg1.2.0nuke
        array(
            'Picinfo display_count_displayed', 'picinfo_display_count_displayed', '1'), // new in cpg1.2.0nuke
        array(
            'Picinfo display_URL', 'picinfo_display_URL', '1'), // new in cpg1.2.0nuke
        array(
            'Picinfo display URL as bookmark link', 'picinfo_display_URL_bookmark', '1'), // new in cpg1.2.0nuke
        array(
            'Picinfo display fav album link', 'picinfo_display_favorites', '1'), // new in cpg1.2.0nuke
        // 'Cookies &amp; Charset settings',
        'Cookies &amp; param�tres d\'encodage des caract�res',
        array(
            'Nom du cookie utilis� par le script', 'cookie_name', 0),
        array(
            'Chemin du cookie utilis� par le script', 'cookie_path', 0),
        array(
            'Encodage des caract�res', 'charset', 4), 
        // 'Miscellaneous settings',
        'Divers',
        array(
            'Activer le mode debug', 'debug_mode', 1),
        array(
'Enable advanced debug mode', 'advanced_debug_mode', 1), // new in cpg1.2.0nuke
array(
'Show Coppermine Update Alert to Admin', 'showupdate', 1), // new 1.2.2
        '<br /><div align="center">(*) Les champs marqu�s d\'un * ne doivent pas �tre modifi�s si des images existent d�j� !</div><br />'
        );
// end left side interpretation
// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //
if (defined('DB_INPUT_PHP')) $lang_db_input_php = array('empty_name_or_com' => 'Vous devez taper votre nom et un commentaire',
        'com_added' => 'Votre commentaire a �t� ajout�',
        'alb_need_title' => 'Vous devez donner un titre � l\'album !',
        'no_udp_needed' => 'Aucune mise � jour n\'est n�cessaire.',
        'alb_updated' => 'L\'album a �t� mis � jour',
        'unknown_album' => 'L\'album s�lectionn� n\'existe pas ou bien vous n\'avez pas la permission d\'uploader dans cet album',
        'no_pic_uploaded' => 'Aucune image n\'a �t� upload�e !<br /><br />Si vous avez vraiment s�lectionn� une image � uploader, v�rifier que le serveur autorise l\'upload de fichiers...',
        'err_mkdir' => 'Impossible de cr�er le r�pertoire %s !',
        'dest_dir_ro' => 'Le r�pertoire de destination (%s) ne dispose pas des droits d\'�criture n�cessaires pour le script!',
        'err_move' => 'Impossible de d�placer %s vers %s !',
        'err_fsize_too_large' => 'La taille de l\'image que vous avez upload� est trop grande (le maximum autoris� est de %s x %s) !',
        'err_imgsize_too_large' => 'Le poids du fichier que vous avez upload� est trop important (le maximum autoris� est de %s Ko) !',
        'err_invalid_img' => 'Le fichier que vous avez upload� n\'est pas une image valide!',
        'allowed_img_types' => 'Vous ne pouvez uploader que %s images.',
        'err_insert_pic' => 'Les images \'%s\' ne peuvent pas �tre ins�r�es dans l\'album ',
        'upload_success' => 'Votre image a �t� correctement upload�e<br /><br />Elle sera visible apr�s validation de l\'administrateur.',
        'info' => 'Information',
        'com_added' => 'Commentaire ajout�',
        'alb_updated' => 'Album mis � jour',
        'err_comment_empty' => 'Votre commentaire est vide!',
        'err_invalid_fext' => 'Seuls les fichiers avec les extensions suivantes sont autoris�s : <br /><br />%s.',
        'no_flood' => 'Nous sommes d�sol�s, mais vous �tes d�j� l\'auteur du dernier commentaire post� au sujet de cette image.<br /><br />Vous pouvez tout simplement �diter votre message pr�c�dent si vous souhaitez le modifier ou bien ajouter des informations.',
        'redirect_msg' => 'Redirection en cours.<br /><br /><br />Cliquez sur \'CONTINUER\' si la page ne se recharge pas automatiquement',
        'upl_success' => 'Votre image a �t� correctement ajout�e',
        );
// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //
if (defined('DELETE_PHP')) $lang_delete_php = array('caption' => 'L�gende',
        'fs_pic' => 'image en taille r�elle',
        'del_success' => 'suppression r�ussie',
        'ns_pic' => 'image en taille normale',
        'err_del' => 'ne peut pas �tre supprim�',
        'thumb_pic' => 'vignette',
        'comment' => 'commentaire',
        'im_in_alb' => 'image dans l\'album',
        'alb_del_success' => 'Album \'%s\' supprim�s',
        'alb_mgr' => 'Gestionnaire d\'album',
        'err_invalid_data' => 'Donn�es non valides re�ues dans \'%s\'',
        'create_alb' => 'Cr�ation de l\'album \'%s\'',
        'update_alb' => 'Mise � jour de l\'album \'%s\' avec le titre \'%s\' et index \'%s\'',
        'del_pic' => 'Supprimer l\'image',
        'del_alb' => 'Supprimer l\'album',
        'del_user' => 'Supprimer l\'utilisateur',
        'err_unknown_user' => 'L\'utilisateur s�lectionn� n\'existe pas !',
        'comment_deleted' => 'Le commentaire a �t� supprim� avec succ�s',
        );
// ------------------------------------------------------------------------- //
// File displayecard.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File displayimage.php
// ------------------------------------------------------------------------- //
if (defined('DISPLAYIMAGE_PHP')) {
    $lang_display_image_php = array('confirm_del' => 'Voulez vous vraiment SUPPRIMER cette image?\\nLes commentaires seront �galement supprim�s.',
        'del_pic' => 'SUPPRIMER CETTE IMAGE',
        'size' => '%s x %s pixels',
        'views' => '%s fois',
        'slideshow' => 'Diaporama',
        'stop_slideshow' => 'ARRETER LE DIAPORAMA',
        'view_fs' => 'Cliquez pour voir l\'image en taille r�elle',
        'edit_pic' => 'EDIT PICTURE INFO', // new in cpg1.2.0nuke
        );
    $lang_picinfo = array('title' => 'Informations sur l\'image',
        'Filename' => 'Nom du fichier',
        'Album name' => 'Nom de l\'album',
        'Rating' => 'Note (%s votes)',
        'Keywords' => 'Mots clefs',
        'File Size' => 'Taille du fichier',
        'Dimensions' => 'Dimensions',
        'Displayed' => 'Affich�es',
        'Camera' => 'Appareil photos',
        'Date taken' => 'Date de la prise de vue',
        'Aperture' => 'Ouverture',
        'Exposure time' => 'Temps d\'exposition',
        'Focal length' => 'Focale',
        'Comment' => 'Commentaires',
        'addFav' => 'Ajouter aux favoris',
        'addFavPhrase' => 'Favoris',
        'remFav' => 'Supprimer des favoris',
        'iptcTitle' => 'IPTC Title', // new in cpg1.2.0nuke
        'iptcCopyright' => 'IPTC Copyright', // new in cpg1.2.0nuke
        'iptcKeywords' => 'IPTC Keywords', // new in cpg1.2.0nuke
        'iptcCategory' => 'IPTC Category', // new in cpg1.2.0nuke
        'iptcSubCategories' => 'IPTC Sub Categories', // new in cpg1.2.0nuke
        'bookmark_page' => 'Bookmark Image', // new in cpg1.2.0nuke
        );

    $lang_display_comments = array('OK' => 'OK',
        'edit_title' => 'Modifier ce commentaire',
        'confirm_delete' => 'Voulez vous vraiment supprimer ce commentaire?',
        'add_your_comment' => 'Ajoutez votre commentaire',
        'name' => 'Nom',
        'comment' => 'Commentaire',
        'your_name' => 'Anonyme',
        );

    $lang_fullsize_popup = array('click_to_close' => 'Cliquez sur l\'image pour fermer la fen�tre',
        );
} 
// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //
if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php = array('title' => 'Envoyer en tant que e-card',
        'invalid_email' => '<strong>Attention</strong> : cette adresse e-mail n\'est pas valide !',
        'ecard_title' => 'Une e-card pour vous, de la part de %s',
        'view_ecard' => 'Si votre e-card ne s\'affiche pas correctement, cliquez ici',
        'view_more_pics' => 'Suivez ce lien pour d�couvrir davantage de photos !',
        'send_success' => 'Votre ecard a �t� envoy�e',
        'send_failed' => 'Nous sommes d�sol�s, mais le serveur n\'a pu envoyer votre e-card...',
        'from' => 'De la part de',
        'your_name' => 'Votre nom',
        'your_email' => 'Votre adresse e-mail',
        'to' => 'A',
        'rcpt_name' => 'Nom du destinataire',
        'rcpt_email' => 'Adresse e-mail du destinataire',
        'greetings' => 'Introduction',
        'message' => 'Message',
        );
// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //
if (defined('EDITPICS_PHP')) $lang_editpics_php = array('pic_info' => 'Informations sur l\'image',
        'album' => 'Album',
        'title' => 'Titre',
        'desc' => 'Description',
        'keywords' => 'Mots clefs',
        'pic_info_str' => '%sx%s - %sKo - %s affichages - %s votes',
        'approve' => 'Approuver',
        'postpone_app' => 'Approuver plus tard',
        'del_pic' => 'Supprimer l\'image',
        'read_exif' => 'Read EXIF info again', // new in cpg1.2.0nuke
        'reset_view_count' => 'Remettre le compteur des t�l�chargements � z�ro',
        'reset_votes' => 'Remettre le compteur de votes � z�ro',
        'del_comm' => 'Supprimer les commentaires',
        'upl_approval' => 'Autorisation d\'upload',
        'edit_pics' => 'Modifier les images',
        'see_next' => 'Voir les images suivantes',
        'see_prev' => 'Voir les images pr�c�dentes',
        'n_pic' => '%s images',
        'n_of_pic_to_disp' => 'Num�ro de l\'image � afficher',
        'apply' => 'Appliquer les modifications'
        );
// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //
if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array('group_name' => 'Nom du groupe',
        'disk_quota' => 'Quota disque',
        'can_rate' => 'Peut noter les images',
        'can_send_ecards' => 'Peut envoyer des ecards',
        'can_post_com' => 'Peut �crire des commentaires',
        'can_upload' => 'Peut mettre des photos en ligne',
        'can_have_gallery' => 'Peut avoir une galerie perso',
        'apply' => 'Appliquer les modifications',
        'create_new_group' => 'Cr�er un nouveau groupe',
        'del_groups' => 'Supprimer le(s) groupe(s) s�lectionn�(s)',
        'confirm_del' => 'Attention, lorsque vous supprimez un groupe, les utilisateurs de ce groupe seront transf�r�s dans le groupe d\'utilisateurs \'Enregistr�\'!\n\nSouhaitez-vous continuer?',
        'title' => 'G�rer les groupes d\'utilisateurs',
        'approval_1' => 'Autorisation d\'upload pub. (1)',
        'approval_2' => 'Autorisation d\'upload priv. (2)',
        'note1' => '<strong>(1)</strong> Les uploads dans un album public doivent �tre approuv�s par un administrateur',
        'note2' => '<strong>(2)</strong> Les uploads dans un album qui appartient � l\'utilisateur doivent �tre approuv�s par un admin',
        'notes' => 'Remarques'
        );
// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //
if (defined('INDEX_PHP')) {
    $lang_index_php = array('welcome' => 'Bienvenue !'
        );

    $lang_album_admin_menu = array('confirm_delete' => 'Voulez-vous VRAIMENT supprimer cet album ? \\nToutes les photos et tous les commentaires seront perdus.',
        'delete' => 'SUPPRIMER',
        'modify' => 'PROPRIETES',
        'edit_pics' => 'MODIFIER LES PHOTOS',
        );

    $lang_list_categories = array('home' => 'Accueil',
        'stat1' => '<strong>[pictures]</strong> photos dans <strong>[albums]</strong> albums et <strong>[cat]</strong> cat�gories avec <strong>[comments]</strong> commentaires affich�es <strong>[views]</strong> fois',
        'stat2' => '<strong>[pictures]</strong> photos dans <strong>[albums]</strong> albums affich�es <strong>[views]</strong> times',
        'xx_s_gallery' => '%s\'s Galerie',
        'stat3' => '<strong>[pictures]</strong> photos dans <strong>[albums]</strong> albums avec <strong>[comments]</strong> commentaires affich�es <strong>[views]</strong> fois'
        );

    $lang_list_users = array('user_list' => 'Liste d\'utilisateurs',
        'no_user_gal' => 'Il n\'y a pas de nouvelle galerie d\'utilisateurs',
        'n_albums' => '%s album(s)',
        'n_pics' => '%s photo(s)'
        );

    $lang_list_albums = array('n_pictures' => '%s photos',
        'last_added' => ', la derni�re a �t� ajout�e le %s'
        );
} 
// ------------------------------------------------------------------------- //
// File login.php
// ------------------------------------------------------------------------- //
// NULL
// ------------------------------------------------------------------------- //
// File logout.php
// ------------------------------------------------------------------------- //
// NULL
// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //
if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array('upd_alb_n' => 'Mettre � jour l\'album %s',
        'general_settings' => 'Param�tres g�n�raux',
        'alb_title' => 'Titre de l\'album',
        'alb_cat' => 'Cat�gorie de l\'album',
        'alb_desc' => 'Description de l\'album',
        'alb_thumb' => 'vignette de l\'album',
        'alb_perm' => 'Permissions pour cet album',
        'can_view' => 'Cet album peut �tre consult� par',
        'can_upload' => 'Les visiteurs peuvent mettre des photos en ligne',
        'can_post_comments' => 'Les visiteurs peuvent poster des commentaires',
        'can_rate' => 'Les visiteurs peuvent noter les photos',
        'user_gal' => 'Galerie de l\'utilisateur',
        'no_cat' => '* Pas de cat�gorie *',
        'alb_empty' => 'L\'album est vide',
        'last_uploaded' => 'Dernier upload',
        'public_alb' => 'Tout le monde (album public)',
        'me_only' => 'Moi seulement',
        'owner_only' => 'Le propri�taire de l\'album (%s) seulement',
        'groupp_only' => 'Membres du groupe \'%s\'',
        'err_no_alb_to_modify' => 'Il n\'y a pas d\'album modifiable dans la base.',
        'update' => 'Mettre l\'album � jour'
        );
// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //
if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array('already_rated' => 'Vous aviez d�j� not� cette photo',
        'rate_ok' => 'Votre vote a �t� pris en compte',
        );
// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //
if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {
    $lang_register_disclamer = <<<EOT
Bien que les administrateurs de {SITE_NAME} fassent en sortent de supprimer ou modifier toute donn�e � caract�re r�pr�hensible le plus rapidement possible, il est impossible de scruter syst�matiquement l\'int�gralit� des posts. Vous �tes par cons�quent conscient que tous les posts effectu�s sur ce site expriment les points de vue et opinions de leur auteur et non ceux des administrateurs ou du webmaster (sauf, �videmment dans le cas des posts effectu�s par ces derniers), qui ne pourront par cons�quent pas �tre consid�r�s comme responsables.
<br />
<br />
Vous acceptez de ne poster aucune donn�e � caract�re injurieux, obsc�ne, vulgaire, diffamatoire, mena�ant, sexuels ou tout autre contenu susceptible de violer la loi. Vous acceptez que le webmaster et les mod�rateurs de {SITE_NAME} aient le droit de supprimer ou modifier n\'importe quel contenu, si cela leur semble opportun. En tant qu\'utilisateur, vous acceptez que toutes les informations entr�es plus haut soient stock�es dans une base de donn�es. Bien que ces informations ne soient pas communiqu�es � des tiers sans votre consentement, le webmaster et les administrateurs ne peuvent pas �tre tenus pour responsables dans le cas de tentatives de hack qui pourraient compromettre les donn�es.<br />
<br />
Ce site utilise des cookies pour stocker des informations sur votre ordinateur. Ces cookies ne servent qu\'� am�liorer votre navigation sur ce site. Votre adresse e-mail ne sera utilis�e que pour confirmer les donn�es de votre inscription ainsi que votre mot de passe.<br />
<br />
En cliquant sur 'J\'accepte' ci-dessous, vous acceptez de vous soumettre � ces conditions.
EOT;

    $lang_register_php = array('page_title' => 'inscription d\'utilisateur',
        'term_cond' => 'Conditions g�n�rales d\'inscription',
        'i_agree' => 'J\'accepte',
        'submit' => 'S\'inscrire',
        'err_user_exists' => 'Le nom d\'utilisateur que vous avez entr� existe d�j�, merci de bien vouloir en choisir un autre',
        'err_password_mismatch' => 'Les deux mots de passe ne correspondent pas, merci de les entrer � nouveau',
        'err_uname_short' => 'Le nom d\'utilisateur doit comprendre au moins 2 caract�res',
        'err_password_short' => 'Le mot de passe doit comprendre au moins 2 caract�res',
        'err_uname_pass_diff' => 'Le nom d\'utilisateur et le mot de passe doivent �tre diff�rents',
        'err_invalid_email' => 'L\'adresse e-mail n\'est pas valide',
        'err_duplicate_email' => 'Un autre utilisateur s\'est d�j� enregist� avec l\'adresse e-mail que vous avez entr�e',
        'enter_info' => 'Entrez les informations relatives � votre inscription',
        'required_info' => 'Informations requises',
        'optional_info' => 'Informations optionnelles',
        'username' => 'Nom d\'utilisateur / login',
        'password' => 'Mot de passe',
        'password_again' => 'Entrez � nouveau le mot de passe',
        'email' => 'Email',
        'location' => 'Localisation',
        'interests' => 'Int�r�ts',
        'website' => 'Site web',
        'occupation' => 'Activit�',
        'error' => 'ERREUR',
        'confirm_email_subject' => '%s - Confirmation d\'inscription',
        'information' => 'Informations',
        'failed_sending_email' => 'L\'e-mail de confirmation d\'inscription n\'a pu �tre envoy�!',
        'thank_you' => 'Merci pour votre inscription.<br /><br />Un e-mail contenant les informations sur l\'activation de votre compte vous a �t� envoy� � l\'adresse e-mail que vous nous avez communiqu�e.',
        'acct_created' => 'Votre compte a bien �t� cr�e. Vous pouvez maintenant vous identifier avec votre login et votre mot de passe',
        'acct_active' => 'Votre compte a bien �t� activ�. Vous pouvez maintenant vous identifier avec votre login et votre mot de passe',
        'acct_already_act' => 'Votre compte est d�j� actif!',
        'acct_act_failed' => 'Ce compte ne peut pas �tre activ�!',
        'err_unk_user' => 'L\'utilisateur s�lectionn� n\'existe pas!',
        'x_s_profile' => 'Profil de %s',
        'group' => 'Groupe',
        'reg_date' => 'Date d\'inscription',
        'disk_usage' => 'Utilisation du disque',
        'change_pass' => 'Modifier le mot de passe',
        'current_pass' => 'Mot de passe actuel',
        'new_pass' => 'Nouveau mot de passe',
        'new_pass_again' => 'Nouveau mot de passe (� nouveau)',
        'err_curr_pass' => 'Le mot de passe actuel n\'est pas correct',
        'apply_modif' => 'Appliquer les modifications',
        'change_pass' => 'Changer mon mot de passe',
        'update_success' => 'Votre profil a �t� mis � jour',
        'pass_chg_success' => 'Votre mot de passe a �t� modifi�',
        'pass_chg_error' => 'Votre mot de passe n\'a pas �t� modifi�',
        );

    $lang_register_confirm_email = <<<EOT
Merci pour votre inscription sur {SITE_NAME}

Votre nom d\'utilisateur/login est : "{USER_NAME}"
Votre mot de passe est : "{PASSWORD}"

Afin d\'activer votre compte, vous devez cliquer sur le lien suivant, ou bien en faire un copier/coller dans la barre d\'adresse de votre navigateur.

{ACT_LINK}

Cordialement,

L'equipe de {SITE_NAME}

EOT;
} 
// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //
if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array('title' => 'V�rifier les commentaires',
        'no_comment' => 'Il n\'y a pas de commentaire � v�rifier',
        'n_comm_del' => '%s commentaire(s) supprim�(s)',
        'n_comm_disp' => 'Nombre de commentaires � afficher',
        'see_prev' => 'Voir pr�c�dent(s)',
        'see_next' => 'Voir suivant(s)',
        'del_comm' => 'Supprimer les commentaires s�lectionn�s',
        );
// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //
// if (defined('SEARCH_PHP'))
    $lang_search_php = array(0 => 'Rechercher une image dans la galerie',
        );
// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //
if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array('page_title' => 'Rechercher les nouvelles photos',
        'select_dir' => 'Selectionnez le r�pertoire',
        'select_dir_msg' => 'Cette fonction vous permet d\'ajouter un groupe de photos que vous avez upload� sur votre serveur FTP.<br /><br />S�lectionnez le r�pertoire o� vous avez upload� vos photos',
        'no_pic_to_add' => 'Il n\'y a pas de photo � ajouter',
        'need_one_album' => 'Vous avez besoin d\'au moins un album pour effectuer cette op�ration',
        'warning' => 'Avertissement',
        'change_perm' => 'le script ne peut pas �crire dans ce r�pertoire, vous devez changer ses permissions � 755 ou 777 avant d\'essayer d\'ajouter les photos !',
        'target_album' => '<strong>Mettre les photos de &quot;</strong>%s<strong>&quot; dans </strong>%s',
        'folder' => 'R�pertoire',
        'image' => 'Image',
        'album' => 'Album',
        'result' => 'R�sultat',
        'dir_ro' => 'Non inscriptible. ',
        'dir_cant_read' => 'Illisible. ',
        'insert' => 'Ajouter de nouvelles images � la galerie',
        'list_new_pic' => 'Liste des nouvelles images',
        'insert_selected' => 'Ins�rer les photos s�lectionn�es',
        'no_pic_found' => 'Aucune image n\'a �t� trouv�e',
        'be_patient' => 'Soyez patient. Le script a besoin de temps pour mettre les photos en ligne',
        'notes' => '<ul>' . '<li><strong>OK</strong> : signifie que l\'image a bien �t� mise en ligne' . '<li><strong>DP</strong> : signifie que la photo existe d�j� dans la base de donn�es' . '<li><strong>PB</strong> : signifie que la photo n\'a pas pu �tre ajout�e, v�rifiez votre configuration et les permissions des r�pertoires dans lesquels les images se trouvent' . '<li>Si les signes OK, DP, PB n\'apparaissent pas, cliquez sur l\'image cass�e afin de voir le message d\'erreur g�n�r� par PHP' . '<li>Si votre browser cesse d\'effectuer la t�che (timeout), cliquez sur le bouton actualiser' . '</ul>',
        'select_album' => 'Select album', // new in nuke
        'no_album' => 'No album name was selected, click back and select an album to put your pictures in',
        );
// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File banning.php  not used in cpg1.2.0-nuke   //
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //
if (defined('UPLOAD_PHP')) $lang_upload_php = array('title' => 'Mettre une photo en ligne',
        'max_fsize' => 'Le poids maximal autoris� pour une image est de %s Ko',
        'album' => 'Album',
        'picture' => 'Photo',
        'pic_title' => 'Titre de la photo',
        'description' => 'Description de la photo',
        'keywords' => 'Mots clefs (s�par�s par des espaces)',
        'err_no_alb_uploadables' => 'Nous sommes d�sol�s, mais il n\'existe pas d\'album dans lequel vous ayiez le droit d\'uploader des photos',
        );
// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //
if (defined('USERMGR_PHP')) $lang_usermgr_php = array('title' => 'G�rer les utilisateurs',
        'name_a' => 'Nom ascendant',
        'name_d' => 'Nom descendant',
        'group_a' => 'Groupe ascendant',
        'group_d' => 'Groupe descendant',
        'reg_a' => 'Date d\'inscription ascendante',
        'reg_d' => 'Date d\'inscription descendante',
        'pic_a' => 'Nombre de photos ascendant',
        'pic_d' => 'Nombre de photos descendant',
        'disku_a' => 'Utilisation espace disque ascendant',
        'disku_d' => 'Utilisatation espace disque descendant',
        'sort_by' => 'Classer les utilisateurs par',
        'err_no_users' => 'La table d\'utilisateurs est vide!',
        'err_edit_self' => 'Vous ne pouvez pas modifier votre propre profil, utilisez le lien \'Mon profil\' pour effectuer cette op�ration',
        'edit' => 'EDITER',
        'delete' => 'SUPPRIMER',
        'name' => 'Nom d\'utilisateur',
        'group' => 'Groupe',
        'inactive' => 'Inactif',
        'operations' => 'Op�rations',
        'pictures' => 'Photos',
        'disk_space' => 'Espace utilis� / quota',
        'registered_on' => 'Enregistr� le',
        'u_user_on_p_pages' => '%d utilisateur(s) sur %d page(s)',
        'confirm_del' => 'Voulez vous vraiment SUPPRIMER cet utilisateur?\\nToutes ses photos et albums seront �galement supprim�s',
        'mail' => 'E-MAIL',
        'err_unknown_user' => 'L\'utilisateur s�lectionn� n\'existe pas!',
        'modify_user' => 'Modifier l\'utilisateur',
        'notes' => 'Commentaires',
        'note_list' => '<li>Si vous ne souhaitez pas modifier le mot de passe actuel, laisse le champs "mot de passe" vide.',
        'password' => 'Mot de Passe',
        'user_active_cp' => 'L\'utilisateur est actif',
        'user_group_cp' => 'Groupe de l\'utilisateur',
        'user_email' => 'e-mail de l\'utilisateur',
        'user_web_site' => 'Site web de l\'utilisateur',
        'create_new_user' => 'Cr�er un nouvel utilisateur',
        'user_from' => 'Localisation de l\'utilisateur',
        'user_interests' => 'Centres d\'int�r�t de l\'utilisateur',
        'user_occ' => 'Activit� de l\'utilisateur',
        );
// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //
if (defined('UTIL_PHP')) $lang_util_php = array('title' => 'Redimensionner les photos',
        'what_it_does' => 'Fonctionnalit�s',
        'what_update_titles' => 'Met � jour les titres � partir des noms de fichier',
        'what_delete_title' => 'Supprime les titres',
        'what_rebuild' => 'Reg�n�re les vignettes et les photos redimensionn�es',
        'what_delete_originals' => 'Supprime les photos originales et les remplace par leur version redimensionn�e',
        'file' => 'Fichier',
        'title_set_to' => 'titre chang� en',
        'submit_form' => 'valider',
        'updated_succesfully' => 'modifi� avec succ�s',
        'error_create' => 'ERREUR lors de la cr�ation',
        'continue' => 'Continuer avec plus d\'images',
        'main_success' => 'Le fichier %s est maintenant utilis� comme image principale',
        'error_rename' => 'Erreur lors du changement du nom de %s � %s',
        'error_not_found' => 'Le fichier %s n\'a pas �t� trouv�',
        'back' => 'retour � la page principale',
        'thumbs_wait' => 'Mise � jour des vignettes et/ou images redimensionn�es, merci de patienter...',
        'thumbs_continue_wait' => 'Continuer la mise � jour des vignettes et/ou des images redimensionn�es...',
        'titles_wait' => 'Mise � jour des titres, merci de patienter...',
        'delete_wait' => 'Suppression des titres, merci de patienter...',
        'replace_wait' => 'Suppression des originaux et remplacement de ces derniers par les images redimensionn�es, merci de patienter...',
        'instruction' => 'Instructions rapides',
        'instruction_action' => 'Selectionnez une action',
        'instruction_parameter' => 'D�finissez les param�tres',
        'instruction_album' => 'S�lectionnez un album',
        'instruction_press' => 'Appuyez sur %s',
        'update' => 'Mettre � jour les vignettes et/ou les photos redimensionn�es',
        'update_what' => 'Ce qui doit �tre mis � jour',
        'update_thumb' => 'Seulement les vignettes',
        'update_pic' => 'Seulement les photos redimensionn�es',
        'update_both' => 'Les vignettes et les images redimensionn�es',
        'update_number' => 'Nombre d\'images trait�es par clic',
        'update_option' => '(essayez de r�duire cette valeur si vous avez des probl�mes de timeout)',
        'filename_title' => 'Nom du fichier / Titre de l\'image',
        'filename_how' => 'Comment le nom du fichier doit-il �tre modifi� ?',
        'filename_remove' => 'Supprimer la fin .jpg et remplacer _ (underscore) par des espaces',
        'filename_euro' => 'Changer 2003_11_23_13_20_20.jpg en 23/11/2003 13:20',
        'filename_us' => 'Changer 2003_11_23_13_20_20.jpg en 11/23/2003 13:20',
        'filename_time' => 'Changer 2003_11_23_13_20_20.jpg en 13:20',
        'delete' => 'Supprimer le titre des photos ou les photos dans leur taille d\'origine',
        'delete_title' => 'Supprimer le titre des photos',
        'delete_original' => 'Supprimer les photos dans leur taille d\'origine',
        'delete_replace' => 'Supprime les images originales en les rempla�ant par les versions redimensionn�es',
        'select_album' => 'Selectionner un album',
        );
// ------------------------------------------------------------------------- //
// File pagetitle.inc.php
// ------------------------------------------------------------------------- //
$lang_pagetitle_php = array(
'divider' => '>',
    'viewing' => 'Viewing Photo',
    'usr' => "'s Photo Gallery",
    'photogallery' => 'Photo Gallery',
    );

?>