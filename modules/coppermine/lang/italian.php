<?php 
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.2.2   nuke - Language Pack 0.93                //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002,2003  Gr�gory DEMAR <gdemar@wanadoo.fr>               //
// http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
// Based on PHPhotoalbum by Henning St�verud <henning@stoverud.com>         //
// http://www.stoverud.com/PHPhotoalbum/                                    //
// ------------------------------------------------------------------------- //
// Hacked by Tarique Sani <tarique@sanisoft.com> and Girsh Nair             //
// <girish@sanisoft.com> see http://www.sanisoft.com/cpg/README.txt for     //
// details                                                                  //
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
define('PIC_VIEWS', 'Views');
define('PIC_VOTES', 'Votes');
define('PIC_COMMENTS', 'Comments');

// info about translators and translated language
$lang_translation_info = array(
    'lang_name_english' => 'Italian', // the name of your language in English, e.g. 'Greek' or 'Spanish'
    'lang_name_native' => 'Italiano', // the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol'
    'lang_country_code' => 'it', // the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
    'trans_name' => 'ralf57', // the name of the translator - can be a nickname
    'trans_email' => '(CPG 1.1) greatkingrat@katamail.com', // translator's email address (optional)
    'trans_website' => 'http://www.madeinbanzi.it/', // translator's website (optional)
    'trans_name2' => '(CPG 1.2) Sesto Avolio', // the name of the translator - can be a nickname
    'trans_email2' => 'webmaster@eolica.net', // translator's email address (optional)
    'trans_website2' => 'http://www.eolica.net/', // translator's website (optional)
    'trans_date' => '2003-11-05', // the date the translation was created / last modified
    );

$lang_charset = 'iso-8859-1';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');
// Day of weeks and months
$lang_day_of_week = array('Dom', 'Lun', 'Mar', 'Mer', 'Gio', 'Ven', 'Sab');
$lang_month = array('Gen', 'Feb', 'Mar', 'Apr', 'Mag', 'Giu', 'Lug', 'Ago', 'Set', 'Ott', 'Nov', 'Dic');
// Some common strings
$lang_yes = 'Si';
$lang_no = 'No';
$lang_back = 'INDIETRO';
$lang_continue = 'CONTINUA';
$lang_info = 'Informazione';
$lang_error = 'Errore';
// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt = '%d %B %Y';
$lastcom_date_fmt = '%d/%m/%y alle %H:%M';
$lastup_date_fmt = '%d %B %Y';
$register_date_fmt = '%d %B %Y';
$lasthit_date_fmt = '%d %B %Y alle %I:%M %p';
$comment_date_fmt = '%d %B %Y alle %I:%M %p';
// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array('random' => 'Immagini...a casaccio',
    'lastup' => 'Ultimi arrivi',
    'lastupby' => 'My Last Additions', // new 1.2.2
    'lastalb' => 'Ultimi aggiornamenti albums',
    'lastcom' => 'Ultimi commenti',
    'lastcomby' => 'My Last comments', // new 1.2.2
    'topn' => 'Le pi� viste',
    'toprated' => 'Le pi� votate',
    'lasthits' => 'Viste di recente',
    'search' => 'Risultati della ricerca',
    'favpics' => 'Immagini Preferite'
    );

$lang_errors = array('access_denied' => 'Non puoi accedere a questa pagina.',
    'perm_denied' => 'Non puoi effettuare questa operazione.',
    'param_missing' => 'Script eseguito senza i parametri richiesti.',
    'non_exist_ap' => 'Immagine/album selezionato non presente nel database !',
    'quota_exceeded' => 'Quota disco superata<br /><br />Hai a disposizione [quota]K, attualmente utilizzi [space]K, una ulteriore immagine farebbe superare la quota.',
    'gd_file_type_err' => 'Le librerie GD supportano solo i formati JPEG and PNG.',
    'invalid_image' => 'Immagine corrotta o non supportata dalla libreria GD',
    'resize_failed' => 'Non posso creare le miniature e le immagini intermedie.',
    'no_img_to_display' => 'Nessuna immagine disponibile',
    'non_exist_cat' => 'La categoria selezionata non esiste',
    'orphan_cat' => 'Una categoria non � legata, correggi il problema col Manager Categorie.',
    'directory_ro' => 'La directory \'%s\' � protetta in scrittura, le immagini non possono essere cancellate',
    'non_exist_comment' => 'Il commento selezionato non esiste.',
    'pic_in_invalid_album' => 'Immagine appartenente ad un album inesistente (%s)!?',
    'banned' => 'Sei stato bannato e non puoi usare questo sito.',
    'not_with_udb' => 'Questa funzione � disabilitata in Coppermine perch� � integrata con il software del forum. Ci� che stai cercando di fare non � supportato in questa configurazione, oppure questa funzione dovrebbe essere gestita dal software del forum.',
    'members_only' => 'Questa funzione � solo per utenti registrati, registrati.', // changed in cpg1.2.0nuke
    'mustbe_god' => 'Questa funzione � solo per per l\'Amministratore. Devi entrar come superadmin, account god per accedere a questa funzione'
    );
// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //
$lang_main_menu = array('alb_list_title' => 'Vai alla lista degli album',
    'alb_list_lnk' => 'Lista album',
    'my_gal_title' => 'Vai alla galleria personale',
    'my_gal_lnk' => 'Galleria personale',
    'my_prof_lnk' => 'Il mio profilo',
    'adm_mode_title' => 'Passa in modalit� admin',
    'adm_mode_lnk' => 'Modalit� admin',
    'usr_mode_title' => 'Passa in modalit� utente',
    'usr_mode_lnk' => 'Modalit� utente',
    'upload_pic_title' => 'Aggiungi una immagine',
    'upload_pic_lnk' => 'Aggiungi immagine',
    'register_title' => 'Crea un account',
    'register_lnk' => 'Registrati',
    'login_lnk' => 'Login',
    'logout_lnk' => 'Logout',
    'lastup_lnk' => 'Ultimi arrivi',
    'lastcom_lnk' => 'Ultimi commenti',
    'topn_lnk' => 'Le pi� viste',
    'toprated_lnk' => 'Le pi� votate',
    'search_lnk' => 'Cerca',
    'fav_lnk' => 'I miei Preferiti',

    );

$lang_gallery_admin_menu = array('upl_app_lnk' => 'Approva uploads',
    'config_lnk' => 'Configura',
    'albums_lnk' => 'Albums',
    'categories_lnk' => 'Categorie',
    'users_lnk' => 'Utenti',
    'groups_lnk' => 'Gruppi',
    'comments_lnk' => 'Commenti',
    'searchnew_lnk' => 'Aggiungi immagini',
    'util_lnk' => 'Utilit�',
    'ban_lnk' => 'Banna Utenti',
    );

$lang_user_admin_menu = array('albmgr_lnk' => 'Crea / ordina albums personali',
    'modifyalb_lnk' => 'Modifica albums personali',
    'my_prof_lnk' => 'Il mio profilo',
    );

$lang_cat_list = array('category' => 'Gallerie',
    'albums' => 'Albums',
    'pictures' => 'Immagini',
    );

$lang_album_list = array('album_on_page' => '%d albums in %d pagine'
    );

$lang_thumb_view = array('date' => 'DATA', 
    // Sort by filename and title
    'name' => 'NOME FILE',
    'title' => 'TITOLO',
    'sort_da' => 'Ordina per data ascendente',
    'sort_dd' => 'Ordina per data discendente',
    'sort_na' => 'Ordina per nome ascendente',
    'sort_nd' => 'Ordina per nome discendente',
    'sort_ta' => 'Ordina per titolo ascendente',
    'sort_td' => 'Ordina per titolo discendente',
    'pic_on_page' => '%d immagini in %d pagine',
    'user_on_page' => '%d utenti in %d pagine',
    'sort_ra' => 'Ordina per punteggio ascendente', // new in cpg1.2.0nuke
    'sort_rd' => 'Ordina per punteggio discendente', // new in cpg1.2.0nuke
    'rating' => 'PUNTEGGIO', // new in cpg1.2.0nuke
    'sort_title' => 'Ordina immagini per:', // new in cpg1.2.0nuke
    );

$lang_img_nav_bar = array('thumb_title' => 'Torna alle miniature',
    'pic_info_title' => 'Mostra/Nascondi info immagine',
    'slideshow_title' => 'Slideshow',
    'slideshow_disabled' => 'le e-cards sono disabilitate', // new in cpg1.2.0nuke
    'slideshow_disabled_msg' => $lang_errors['members_only'], // new in cpg1.2.0nuke
    'ecard_title' => 'Invia questa immagine come e-card',
    'ecard_disabled' => 'e-cards disabilitate',
    'ecard_disabled_msg' => 'Non puoi inviare ecards',
    'prev_title' => 'Immagine precedente',
    'next_title' => 'Immagine successiva',
    'pic_pos' => 'IMMAGINE %s/%s',
    'no_more_images' => 'Non ci sono altre immagini in questa galleria', // new in cpg1.2.0nuke
    'no_less_images' => 'Questa � la prima immagine della galleria', // new in cpg1.2.0nuke
    );

$lang_rate_pic = array('rate_this_pic' => 'Vota questa immagine',
    'no_votes' => '(Ancora nessun voto)',
    'rating' => '(media attuale : %s / 5 con %s voti)',
    'rubbish' => 'Scadente',
    'poor' => 'Mediocre',
    'fair' => 'Sufficiente',
    'good' => 'Buona',
    'excellent' => 'Eccellente',
    'great' => 'Grande',
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
    CRITICAL_ERROR => 'Errore critico',
    'file' => 'File: ',
    'line' => 'Linea: ',
    );

$lang_display_thumbnails = array('filename' => 'Nome del file : ',
    'filesize' => 'Dimensione file : ',
    'dimensions' => 'Dimensioni : ',
    'date_added' => 'Aggiunta il : '
    );

$lang_get_pic_data = array('n_comments' => '%s commenti',
    'n_views' => '%s viste',
    'n_votes' => '(%s voti)'
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
if (defined('SMILIES_PHP')) $lang_smilies_inc_php = array('Exclamation' => 'Esclamazione',
        'Question' => 'Dubbio',
        'Very Happy' => 'Molto felice',
        'Smile' => 'Sorriso',
        'Sad' => 'Triste',
        'Surprised' => 'Sorpresa',
        'Shocked' => 'Shockato',
        'Confused' => 'Confuso',
        'Cool' => 'Figo',
        'Laughing' => 'Sorridente',
        'Mad' => 'Matto',
        'Razz' => 'Razz',
        'Embarassed' => 'Imbarazzato',
        'Crying or Very sad' => 'Molto triste',
        'Evil or Very Mad' => 'Cattivo',
        'Twisted Evil' => 'Molto cattivo',
        'Rolling Eyes' => 'Occhi fuori orbita',
        'Wink' => 'Wink',
        'Idea' => 'Idea',
        'Arrow' => 'Freccia',
        'Neutral' => 'Neutro',
        'Mr. Green' => 'Mr. Green',
        );
// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //
// void
// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //
if (defined('ADMIN_PHP')) $lang_admin_php = array(0 => 'Lascio la modalit� admin...',
        1 => 'Entro in modalit� admin...',
        );
// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //
if (defined('ALBMGR_PHP')) $lang_albmgr_php = array('alb_need_name' => 'Ogni album deve avere un nome !',
        'confirm_modifs' => 'Applico davvero le modifiche?',
        'no_change' => 'Non hai fatto alcuna modifica !',
        'new_album' => 'Nuovo album',
        'confirm_delete1' => 'Cancello davvero questo album ?',
        'confirm_delete2' => '\nTutte le immagini ed i commenti andranno persi !',
        'select_first' => 'Prima scegli un album',
        'alb_mrg' => 'Album Manager',
        'my_gallery' => '* Galleria personale *',
        'no_category' => '* Nessuna categoria *',
        'delete' => 'Cancella',
        'new' => 'Nuova',
        'apply_modifs' => 'Applica le modifiche',
        'select_category' => 'Seleziona categoria',
        );
// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) $lang_catmgr_php = array('miss_param' => 'Parametri necessari per \'%s\'operazione non forniti !',
        'unknown_cat' => 'La categoria scelta non � nel database',
        'usergal_cat_ro' => 'La categoria delle gallerie personali non pu� essere cancellata !',
        'manage_cat' => 'Gestisci categorie',
        'confirm_delete' => 'Vuoi davvero cancellare questa categoria?',
        'category' => 'Categoria',
        'operations' => 'Operazioni',
        'move_into' => 'Sposta in',
        'update_create' => 'Aggiorna/Crea categoria',
        'parent_cat' => 'Categoria superiore',
        'cat_title' => ' Titolo categoria',
        'cat_desc' => 'Descrizione categoria'
        );
// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //
if (defined('CONFIG_PHP')) $lang_config_php = array('title' => 'Configurazione',
        'restore_cfg' => 'Ripristina impostazioni di default',
        'save_cfg' => 'Salva la nuova configurazione',
        'notes' => 'Note',
        'info' => 'Informazione',
        'upd_success' => 'Configurazione aggiornata',
        'restore_success' => 'Configurazione di default ripristinata',
        'name_a' => 'Nome ascendente',
        'name_d' => 'Nome discendente',
        'title_a' => 'Titolo ascendente',
        'title_d' => 'Titolo discendente',
        'date_a' => 'Data ascendente',
        'date_d' => 'Data discendente',
        'rating_a' => 'Punteggio ascendente', // new in cpg1.2.0nuke
        'rating_d' => 'Punteggio discendente', // new in cpg1.2.0nuke
        'th_any' => 'Dimensione maggiore',
        'th_ht' => 'Altezza',
        'th_wd' => 'Larghezza'
        );

if (defined('CONFIG_PHP')) $lang_config_data = array('Impostazioni generali',
        array('Nome galleria', 'gallery_name', 0),
        array('Descrizione galleria', 'gallery_description', 0),
        array('Email amministratore', 'gallery_admin_email', 0),
        array('Indirizzo della directory nuke, cio� http://www.mysite.tld/html', 'ecards_more_pic_target', 0), // new in cpg1.2.0nuke
        // array('Target per il link \'Vedi altre immagini\' nelle e-cards', 'ecards_more_pic_target', 0),
        array('Lingua', 'lang', 5),
// for postnuke change
        array('Tema', 'cpgtheme', 6),
        array('Page Specific Titles instead of >Coppermine', 'nice_titles', 1),
        array('Show blocks on the right', 'right_blocks', 1), // new 1.2.2

        'Vista lista album',
        array('Larghezza tabella principale (pixels o %)', 'main_table_width', 0),
        array('Numero di livelli delle categorie da mostrare', 'subcat_level', 0),
        array('Numero di albums da mostrare', 'albums_per_page', 0),
        array('Numero di colonne della lista album', 'album_list_cols', 0),
        array('Dimensione miniature in pixels', 'alb_list_thumb_size', 0),
        array('Contenuto della pagina principale', 'main_page_layout', 0),
        array('Mostra miniature per primo livello album nelle categorie', 'first_level', 1),

        'Vista miniature',
        array('Numero di colonne nella pagina delle miniature', 'thumbcols', 0),
        array('Numero di righe nella pagina delle miniature', 'thumbrows', 0),
        array('Massimo numero di tabs da mostrare', 'max_tabs', 0),
        array('Mostra descrizione (in aggiunta al titolo) sotto la miniatura', 'caption_in_thumbview', 1),
        array('Mostra numero di commenti sotto la miniatura', 'display_comment_count', 1),
        array('Criterio di default per ordinare le immagini', 'default_sort_order', 3),
        array('Minimo numero di voti affinch� una immagine entri nella lista delle \'pi� votate\'', 'min_votes_for_rating', 0),
        array('Usa titolo e parole chiave anzich� picinfo come tag alt e title', 'seo_alts', 1), // new in cpg1.2.0nuke
        'Vista immagine &amp; Impostazioni commenti',
        array('Larghezza della tabella mostra immagine (pixels o %)', 'picture_table_width', 0),
        array('Info immagini visibili di default', 'display_pic_info', 1),
        array('Filtra parolacce nei commenti', 'filter_bad_words', 1),
        array('Consenti smiles nei commenti', 'enable_smilies', 1),
        array('Consenti pi� commenti consecutivi su un\'immagine dallo stesso utente', 'disable_flood_protection', 1), // new in cpg1.2.0nuke
        array('Invia una Email all\'amministratore quando vengono inseriti dei commenti' , 'comment_email_notification', 1), // new in cpg1.2.0nuke
        array('Lunghezza massima descrizione', 'max_img_desc_length', 0),
        array('Max numero di caratteri in una parola', 'max_com_wlength', 0),
        array('Max numero di linee in un commento', 'max_com_lines', 0),
        array('Lunghezza massima del commento', 'max_com_size', 0),
        array('Mostra film strip', 'display_film_strip', 1),
        array('Numero di miniature nella film strip', 'max_film_strip_items', 0),
        array('Consenti agli anonimi di vedere le immagini in dimensione originale', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke		
array('Number of days between being able to vote on the same image','keep_votes_time',0), // new in cpg1.2.2c nuke
// 'Pictures and thumbnails settings',
        'Impostazioni immagini e miniature',
        array('Qualit� files JPEG', 'jpeg_qual', 0),
        array('Max dimensione delle miniature <strong>*</strong>', 'thumb_width', 0),
        array('Usa dimensione ( larghezza o altezza o aspetto Max per miniature e immagini intermedie)<strong>*</strong>', 'thumb_use', 7),
        array('Crea immagini intermedie', 'make_intermediate', 1),
        array('Max larghezza o altezza delle immagini intermedie <strong>*</strong>', 'picture_width', 0),
        array('Peso massimo dei files (KB)', 'max_upl_size', 0),
        array('Max larghezza o altezza delle immagini caricate (pixels)', 'max_upl_width_height', 0),

        'Impostazioni utenti',
        array('Consenti nuove registrazioni', 'allow_user_registration', 1),
        array('Verifica tramite e-mail richiesta', 'reg_requires_valid_email', 1),
        array('Consenti due utenti con la stessa email', 'allow_duplicate_emails_addr', 1),
        array('Utenti possono avere album privati', 'allow_private_albums', 1),
array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',

        'Campi personalizzati per le descrizioni (lascia vuoti se inutilizzati)',
        array('Nome campo 1', 'user_field1_name', 0),
        array('Nome campo 2', 'user_field2_name', 0),
        array('Nome campo 3', 'user_field3_name', 0),
        array('Nome campo 4', 'user_field4_name', 0),

        'Impostazioni avanzate immagini e miniature',
        array('Mostra Icona album privati ad utenti non connessi', 'show_private', 1),
        array('Caratteri proibiti nei nomi dei files', 'forbiden_fname_char', 0),
        array('Estensioni consentite per le immagini ', 'allowed_file_extensions', 0),
        array('Metodo ridimensionamento immagini', 'thumb_method', 2),
        array('Percorso per ImageMagick (esempio /usr/bin/X11/)', 'impath', 0),
        array('Tipi di immagine consentiti (solo per ImageMagick)', 'allowed_img_types', 0),
        array('Opzioni per ImageMagick', 'im_options', 0),
        array('Leggi dati EXIF nei files JPEG', 'read_exif_data', 1),
        array('Leggi dati IPTC nei files JPEG', 'read_iptc_data', 1), // new in cpg1.2.0nuke
        array('Directory degli album <strong>*</strong>', 'fullpath', 0),
        array('Directory immagini utenti <strong>*</strong>', 'userpics', 0),
        array('Prefisso delle immagini intermedie <strong>*</strong>', 'normal_pfx', 0),
        array('Prefisso delle miniature <strong>*</strong>', 'thumb_pfx', 0),
        array('Chmod di default per le directories', 'default_dir_mode', 0),
        array('Chmod di default per le immagini', 'default_file_mode', 0),
        array('Picinfo mostra nome file', 'picinfo_display_filename', '1'), // new in cpg1.2.0nuke
        array('Picinfo mostra nome album', 'picinfo_display_album_name', '1'), // new in cpg1.2.0nuke
        array('Picinfo mostra dimensione file', 'picinfo_display_file_size', '1'), // new in cpg1.2.0nuke
        array('Picinfo mostra dimensioni immagine', 'picinfo_display_dimensions', '1'), // new in cpg1.2.0nuke
        array('Picinfo mostra contatore visualizzazioni', 'picinfo_display_count_displayed', '1'), // new in cpg1.2.0nuke
        array('Picinfo mostra URL', 'picinfo_display_URL', '1'), // new in cpg1.2.0nuke
        array('Picinfo mostra URL come memorizza collegamento', 'picinfo_display_URL_bookmark', '1'), // new in cpg1.2.0nuke
        array('Picinfo mostra collegamento a preferiti', 'picinfo_display_favorites', '1'), // new in cpg1.2.0nuke
        'Cookies &amp; Impostazioni caratteri',
        array('Nome del cookie usato dallo script', 'cookie_name', 0),
        array('Percorso del cookie usato dallo script', 'cookie_path', 0),
        array('Codifica carattere', 'charset', 4),

        'Impostazioni varie',
        array('Attiva modalit� debug', 'debug_mode', 1),
        array('Attiva modalit� debug avanzato', 'advanced_debug_mode', 1), // new in cpg1.2.0nuke
array(
'Show Coppermine Update Alert to Admin', 'showupdate', 1), // new 1.2.2
        '<br /><div align="center">(*) I campi con * non devono essere modificati se gi� vi sono immagini nella galleria</div><br />'
        );
// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //
if (defined('DB_INPUT_PHP')) $lang_db_input_php = array('empty_name_or_com' => 'Inserisci nome e commento',
        'com_added' => 'Il tuo commento � stato aggiunto',
        'alb_need_title' => 'Inserisci il titolo dell\'album !',
        'no_udp_needed' => 'Non necessita di aggiornamenti.',
        'alb_updated' => 'Album aggiornato',
        'unknown_album' => 'Album inesistente o upload non consentito in questo album',
        'no_pic_uploaded' => 'Nessuna immagine aggiunta !<br /><br />Controlla che il server permetta gli uploads...',
        'err_mkdir' => 'Impossibile creare la directory %s !',
        'dest_dir_ro' => 'La directory di destinazione %s non � scrivibile !',
        'err_move' => 'Impossible spostare %s in %s !',
        'err_fsize_too_large' => 'La dimensione della immagine caricata � eccessiva (il massimo consentito � %s x %s) !',
        'err_imgsize_too_large' => 'Il peso del file caricato � eccessivo (il massimo consentito � %s KB) !',
        'err_invalid_img' => 'Il file caricato non � una immagine supportata !',
        'allowed_img_types' => 'Puoi caricare %s immagini.',
        'err_insert_pic' => 'La immagine \'%s\' non pu� essere inserita',
        'upload_success' => 'Immagine caricata con successo<br /><br />Sar� visibile dopo il vaglio di un amministratore.',
        'info' => 'Informazione',
        'com_added' => 'Commento aggiunto',
        'alb_updated' => 'Album aggiornato',
        'err_comment_empty' => 'Il commento � vuoto !',
        'err_invalid_fext' => 'Solo i files con le seguenti estensioni sono ammessi : <br /><br />%s.',
        'no_flood' => 'Spiacenti, sei gi� autore del commento<br /><br />Edita il commento se vuoi',
        'redirect_msg' => 'Sei stato reindirizzato.<br /><br /><br />Clicca \'CONTINUA\' se la pagina non si ricarica automaticamente',
        'upl_success' => 'Immagine aggiunta con successo',
        );
// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //
if (defined('DELETE_PHP')) $lang_delete_php = array('caption' => 'Descrizione',
        'fs_pic' => 'immagine full size',
        'del_success' => 'cancellata con successo',
        'ns_pic' => 'immagine normale',
        'err_del' => 'non pu� essere cancellata',
        'thumb_pic' => 'miniatura',
        'comment' => 'commento',
        'im_in_alb' => 'immagine nell\'album',
        'alb_del_success' => 'Album \'%s\' cancellato',
        'alb_mgr' => 'Album Manager',
        'err_invalid_data' => 'Dati non validi ricevuti in \'%s\'',
        'create_alb' => 'Creazione album \'%s\'',
        'update_alb' => 'Aggiornamento album \'%s\' con titolo \'%s\' ed indice \'%s\'',
        'del_pic' => 'Cancella immagine',
        'del_alb' => 'Cancella album',
        'del_user' => 'Cancella utente',
        'err_unknown_user' => 'Utente inesistente !',
        'comment_deleted' => 'Commento cancellato con successo',
        );
// ------------------------------------------------------------------------- //
// File displayecard.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File displayimage.php
// ------------------------------------------------------------------------- //
if (defined('DISPLAYIMAGE_PHP')) {
    $lang_display_image_php = array('confirm_del' => 'Vuoi davvero cancellare questa immagine? \\nI commenti andranno persi.',
        'del_pic' => 'CANCELLA QUESTA IMMAGINE',
        'size' => '%s x %s pixels',
        'views' => '%s volte',
        'slideshow' => 'Slideshow',
        'stop_slideshow' => 'STOP SLIDESHOW',
        'view_fs' => 'Clicca per immagine full size',
        'edit_pic' => 'EDITA INFO IMMAGINE', // new in cpg1.2.0nuke
        );

    $lang_picinfo = array('title' => 'Info immagine',
        'Filename' => 'Nome file',
        'Album name' => 'Nome album',
        'Rating' => 'Punteggio (%s voti)',
        'Keywords' => 'Keywords',
        'File Size' => 'Peso file',
        'Dimensions' => 'Dimensioni',
        'Displayed' => 'Mostrato',
        'Camera' => 'Camera',
        'Date taken' => 'Data di scatto',
        'Aperture' => 'Apertura',
        'Exposure time' => 'Esposizione',
        'Focal length' => 'Focale',
        'Comment' => 'Commento',
        'addFav' => 'Aggiungi a "I miei Preferiti"',
        'addFavPhrase' => 'Preferiti',
        'remFav' => 'Rimuovi da "I miei Preferiti"',
        'iptcTitle' => 'IPTC - Titolo', // new in cpg1.2.0nuke
        'iptcCopyright' => 'IPTC - Copyright', // new in cpg1.2.0nuke
        'iptcKeywords' => 'IPTC - Parole chiave', // new in cpg1.2.0nuke
        'iptcCategory' => 'IPTC - Categoria', // new in cpg1.2.0nuke
        'iptcSubCategories' => 'IPTC - Sub Categorie', // new in cpg1.2.0nuke
        'bookmark_page' => 'Memorizza collegamento', // new in cpg1.2.0nuke
        );

    $lang_display_comments = array('OK' => 'OK',
        'edit_title' => 'Edita questo commento',
        'confirm_delete' => 'Vuoi davvero cancellare questo commento?',
        'add_your_comment' => 'Aggiungi il tuo commento',
        'name' => 'Nome',
        'comment' => 'Commento',
        'your_name' => 'Anon',
        );
    $lang_fullsize_popup = array('click_to_close' => 'Clicca l\'immagine per chiudere questa finestra',
        );
} 
// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //
if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php = array('title' => 'Invia una e-card',
        'invalid_email' => '<strong>Attento</strong> : email non valida !',
        'ecard_title' => 'Una e-card da %s per te',
        'view_ecard' => 'Se la e-card non � visualizzata correttamente, clicca su questo link',
        'view_more_pics' => 'Clicca su questo link per altre immagini !',
        'send_success' => 'E-card inviata con successo',
        'send_failed' => 'Spiacenti ma il server non pu� inviare la tua e-card...',
        'from' => 'Da',
        'your_name' => 'Il tuo nome',
        'your_email' => 'La tua email',
        'to' => 'Per ',
        'rcpt_name' => 'Nome destinatario',
        'rcpt_email' => 'Email destinatario',
        'greetings' => 'Saluti',
        'message' => 'Messaggio',
        );
// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //
if (defined('EDITPICS_PHP')) $lang_editpics_php = array('pic_info' => 'Info immagine',
        'album' => 'Album',
        'title' => 'Titolo',
        'desc' => 'Descrizione',
        'keywords' => 'Keywords',
        'pic_info_str' => '%sx%s - %sKB - %s viste - %s voti',
        'approve' => 'Approva immagine',
        'postpone_app' => 'Rinvia approvazione',
        'del_pic' => 'Cancella immagine',
        'read_exif' => 'Rileggi info EXIF', // new in cpg1.2.0nuke
        'reset_view_count' => 'Resetta contatore',
        'reset_votes' => 'Resetta voti',
        'del_comm' => 'Cancella commenti',
        'upl_approval' => 'Approvazione uploads',
        'edit_pics' => 'Edita immagini',
        'see_next' => 'Immagini successive',
        'see_prev' => 'Immagini precedenti',
        'n_pic' => '%s immagini',
        'n_of_pic_to_disp' => 'Numero di immagini da mostrare',
        'apply' => 'Applica modifiche'
        );
// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //
if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array('group_name' => 'Nome gruppo',
        'disk_quota' => 'Quota disco',
        'can_rate' => 'Pu� votare le immagini',
        'can_send_ecards' => 'Pu� inviare e-cards',
        'can_post_com' => 'Pu� scrivere commenti',
        'can_upload' => 'Pu� inserire immagini',
        'can_have_gallery' => 'Pu� avere galleria personale',
        'apply' => 'Applica modifiche',
        'create_new_group' => 'Crea nuovo gruppo',
        'del_groups' => 'Cancella grouppi selezionati',
        'confirm_del' => 'Attento, gli utenti saranno trasferiti nel gruppo degli Utenti registrati - Vuoi proseguire?',
        'title' => 'Gestisci gruppi utenti',
        'approval_1' => 'Approvazione Pub. Upl.  (1)',
        'approval_2' => 'Approvazione Priv. Upl.  (2)',
        'note1' => '<strong>(1)</strong> Gli uploads in un album pubblico necessitano della approvazione',
        'note2' => '<strong>(2)</strong> Gli uploads in un album di un utente necessitano della approvazione',
        'notes' => 'Note'
        );
// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //
if (defined('INDEX_PHP')) {
    $lang_index_php = array('welcome' => 'Benvenuto !'
        );

    $lang_album_admin_menu = array('confirm_delete' => 'Vuoi davvero cancellare quest\'album ? \\nTutte le immagini ed i commenti andranno persi.',
        'delete' => 'CANCELLA',
        'modify' => 'PROPRIETA\'',
        'edit_pics' => 'EDITA IMMAGINI',
        );

    $lang_list_categories = array('home' => 'Home',
        'stat1' => '<strong>[pictures]</strong> immagini :: <strong>[albums]</strong> albums :: <strong>[cat]</strong> categorie :: <strong>[comments]</strong> commenti :: viste <strong>[views]</strong> volte',
        'stat2' => '<strong>[pictures]</strong> immagini :: <strong>[albums]</strong> albums :: viste <strong>[views]</strong> volte',
        'xx_s_gallery' => '%s\'s Galleria',
        'stat3' => '<strong>[pictures]</strong> immagini :: <strong>[albums]</strong> albums :: <strong>[comments]</strong> commenti :: viste <strong>[views]</strong> volte'
        );

    $lang_list_users = array('user_list' => 'Lista utenti',
        'no_user_gal' => 'Non ci sono gallerie utenti',
        'n_albums' => '%s album',
        'n_pics' => '%s immagini'
        );

    $lang_list_albums = array('n_pictures' => '%s immagini',
        'last_added' => ', ultimo arrivo del %s'
        );
} 
// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //
if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array('upd_alb_n' => 'Aggiorna album %s',
        'general_settings' => 'Impostazioni generali',
        'alb_title' => 'Titolo album',
        'alb_cat' => 'Categoria album',
        'alb_desc' => 'Descrizione album',
        'alb_thumb' => 'Miniatura album',
        'alb_perm' => 'Permessi per questo album',
        'can_view' => 'Album visibile da',
        'can_upload' => 'I visitatori possono aggiungere immagini',
        'can_post_comments' => 'I visitatori possono inserire commenti',
        'can_rate' => 'I visitatori possono votare le immagini',
        'user_gal' => 'Galleria utente',
        'no_cat' => '* Nessuna categoria *',
        'alb_empty' => 'Album vuoto',
        'last_uploaded' => 'Ultimo arrivo',
        'public_alb' => 'Tutti (album pubblico)',
        'me_only' => 'Solo per me',
        'owner_only' => 'Solo per il titolare (%s)',
        'groupp_only' => 'Membri del gruppo \'%s\' ',
        'err_no_alb_to_modify' => 'Nessun album che tu possa modificare.',
        'update' => 'Aggiorna album'
        );
// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //
if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array('already_rated' => 'Spiacenti, hai gi� votato questa immagine',
        'rate_ok' => 'il tuo voto � stato accettato',
        );
// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //
if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {
    $lang_register_disclamer = <<<EOT
Gli amministratori di <strong>{SITE_NAME}</strong> rimuoveranno tutto quello che non sar� ritenuto compatibile con le finalit� ed il decoro del sito.Ti chiediamo di rispettare il lavoro degli altri utenti e del webmaster.<br />
<br />
Accetti di non pubblicare materiale osceno ed offensivo.<br />
<br />
Le informazioni relative al tuo account sono conservate in un cookie sul tuo computer per velocizzare l'utilizzo della galleria. Il tuo indirizzo email non sar� divulgato a nessuno per nessun motivo.<br />
<br />
Cliccando su 'Accetto' confermi queste condizioni.
EOT;

    $lang_register_php = array('page_title' => 'Registrazione utente',
        'term_cond' => 'Termini e condizioni',
        'i_agree' => 'Accetto',
        'submit' => 'Invia registrazione',
        'err_user_exists' => 'Lo username scelto � gi� utilizzato, scegline un altro',
        'err_password_mismatch' => 'Le password non coincidono, controlla e riprova',
        'err_uname_short' => 'Lo username deve essere almeno di 2 caratteri',
        'err_password_short' => 'La password deve essere almeno di 2 caratteri',
        'err_uname_pass_diff' => 'Username e password devono essere diversi',
        'err_invalid_email' => 'La email non � valida',
        'err_duplicate_email' => 'Email gi� utilizzata da un altro utente',
        'enter_info' => 'Inserisci info per la registrazione',
        'required_info' => 'Informazioni richieste',
        'optional_info' => 'Informazioni opzionali',
        'username' => 'Username',
        'password' => 'Password',
        'password_again' => 'Riscrivi password',
        'email' => 'Email',
        'location' => 'Dove vivi?',
        'interests' => 'Interessi',
        'website' => 'Sito web',
        'occupation' => 'Occupazione',
        'error' => 'ERRORE',
        'confirm_email_subject' => '%s - Conferma registrazione',
        'information' => 'Informazione',
        'failed_sending_email' => 'La email di conferma non pu� essere inviata !',
        'thank_you' => 'Grazie per esserti registrato.<br /><br />Una e-mail di conferma e di attivazione � stata inviata alla casella di posta indicata.',
        'acct_created' => 'Il tuo account � stato creato e puoi fare il login',
        'acct_active' => 'Il tuo account � stato attivato e puoi fare il login',
        'acct_already_act' => 'Il tuo account � gi� attivo !',
        'acct_act_failed' => 'Questo account non pu� essere attivato !',
        'err_unk_user' => 'Utente selezionato inesistente !',
        'x_s_profile' => 'Profilo di %s',
        'group' => 'Gruppo',
        'reg_date' => 'Iscritto il ',
        'disk_usage' => 'Utilizzo disco',
        'change_pass' => 'Cambia password',
        'current_pass' => 'Password corrente',
        'new_pass' => 'Nuova password',
        'new_pass_again' => 'Ripeti nuova password',
        'err_curr_pass' => 'La password attuale � errata',
        'apply_modif' => 'Applica modifiche',
        'change_pass' => 'Cambia la mia password',
        'update_success' => 'Profilo aggiornato',
        'pass_chg_success' => 'Password cambiata',
        'pass_chg_error' => 'La tua password non � stata cambiata',
        );

    $lang_register_confirm_email = <<<EOT
Grazie per esserti registrato su {SITE_NAME}

La tua username � : "{USER_NAME}"
La tua password � : "{PASSWORD}"

Per completare la attivazione clicca sul link qui sotto
o copia e incolla nel browser

{ACT_LINK}

Cordiali saluti,

Il webmaster di {SITE_NAME}

EOT;
} 
// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //
if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array('title' => 'Revisiona commenti',
        'no_comment' => 'Non ci sono commenti da revisionare',
        'n_comm_del' => '%s commenti cancellati',
        'n_comm_disp' => 'Numero di commenti da mostrare',
        'see_prev' => 'Vedi precedente',
        'see_next' => 'Vedi successivo',
        'del_comm' => 'Cancella i commenti selezionati',
        );
// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //
// if (defined('SEARCH_PHP'))
    $lang_search_php = array(0 => 'Cerca nella galleria',
        );
// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //
if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array('page_title' => 'Cerca nuove immagini',
        'select_dir' => 'Seleziona directory',
        'select_dir_msg' => 'Questa funzione consente di aggiungere immagini caricate via FTP sul tuo server<br /><br />Scegli la directory in cui hai caricato le immagini',
        'no_pic_to_add' => 'Non ci sono immagini da aggiungere',
        'need_one_album' => 'Hai bisogno almeno di un album per usare questa funzione',
        'warning' => 'Attento',
        'change_perm' => 'lo script non pu� scrivere in questa directory, fai il chmod a 755 o 777 e riprova!',
        'target_album' => '<strong>Metti le immagini di &quot;</strong>%s<strong>&quot; in </strong>%s',
        'folder' => 'Cartella',
        'image' => 'Immagine',
        'album' => 'Album',
        'result' => 'Risultato',
        'dir_ro' => 'Non scrivibile. ',
        'dir_cant_read' => 'Non leggibile. ',
        'insert' => 'Aggiungo le nuove immagini alla galleria',
        'list_new_pic' => 'Lista delle nuove immagini',
        'insert_selected' => 'Inserisci le immagini selezionate',
        'no_pic_found' => 'Nessuna nuova immagine � stata trovata',
        'be_patient' => 'Sii paziente, lo script necessita di tempo per aggiungere le immagini',
        'notes' => '<ul>' . '<li><strong>OK</strong> : immagine aggiunta con successo' . '<li><strong>DP</strong> : immagine gi� presente nel database' . '<li><strong>PB</strong> : immagine non aggiunta a causa della errata configurazione del server o del chmod delle cartelle' . '<li>Se OK, DP, PB non appaiono clicca sulla immagine per vedere quale errore � stato causato dal PHP' . '<li>Se il tuo browser va in timeout, premi il tasto Aggiorna' . '</ul>',
        'select_album' => 'Seleziona album', // new in nuke
        'no_album' => 'Non hai selezionato nessun album, torna indietro e seleziona l\'album in cui inserire le immagini',
        );
// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //
if (defined('UPLOAD_PHP')) $lang_upload_php = array('title' => 'Upload immagine',
        'max_fsize' => 'La dimensione massima del file � %s KB',
        'album' => 'Album',
        'picture' => 'Immagine',
        'pic_title' => 'Titolo immagine',
        'description' => 'Descrizione immagine',
        'keywords' => 'Keywords (separate da spazi)',
        'err_no_alb_uploadables' => 'Spiacenti, in nessun album � consentito caricare immagini',
        );
// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //
if (defined('USERMGR_PHP')) $lang_usermgr_php = array('title' => 'Gestione utenti',
        'name_a' => 'Nome ascendente',
        'name_d' => 'Nome discendente',
        'group_a' => 'Gruppo ascendente',
        'group_d' => 'Gruppo discendente',
        'reg_a' => 'Data iscrizione ascendente',
        'reg_d' => 'Data iscrizione discendente',
        'pic_a' => 'Numero immagini crescente',
        'pic_d' => 'Numero immagini decrescente',
        'disku_a' => 'Utilizzo disco crescente',
        'disku_d' => 'Utilizzo disco decrescente',
        'sort_by' => 'Ordina utenti per',
        'err_no_users' => 'La tabella utenti � vuota !',
        'err_edit_self' => 'Non puoi editare il tuo profilo da qui, usa invece "Il mio profilo"',
        'edit' => 'EDITA',
        'delete' => 'CANCELLA',
        'name' => 'Nome utente',
        'group' => 'Gruppo',
        'inactive' => 'Inattivo',
        'operations' => 'Operazioni',
        'pictures' => 'Immagini',
        'disk_space' => 'Spazio usato / Quota',
        'registered_on' => 'Registrato il',
        'u_user_on_p_pages' => '%d utenti in %d pagine',
        'confirm_del' => 'Vuoi davvero cancellare questo utente ? \\nTutte le sue immagini ed i suoi album andranno persi.',
        'mail' => 'MAIL',
        'err_unknown_user' => 'Utente selezionato inesistente !',
        'modify_user' => 'Modifica utente',
        'notes' => 'Note',
        'note_list' => '<li>Se non vuoi cambiare la password attuale, lascia vuoto il campo "password"',
        'password' => 'Password',
        'user_active_cp' => 'Utente attivo',
        'user_group_cp' => 'Gruppo utente',
        'user_email' => 'Email',
        'user_web_site' => 'Sito web',
        'create_new_user' => 'Crea nuovo utente',
        'user_from' => 'Dove vive',
        'user_interests' => 'Interessi',
        'user_occ' => 'Occupazione',
        );
// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //
if (defined('UTIL_PHP')) $lang_util_php = array('title' => 'Ridimensiona immagini',
        'what_it_does' => 'Cosa fa',
        'what_update_titles' => 'Aggiorna titoli da nome file',
        'what_delete_title' => 'Cancella titoli',
        'what_rebuild' => 'Ricostruisce miniature e immagini ridimensionate',
        'what_delete_originals' => 'Cancella immagini originali e sostituisce con versione ridimensionata',
        'file' => 'File',
        'title_set_to' => 'titolo impostato a',
        'submit_form' => 'esegui',
        'updated_succesfully' => 'aggiornamento riuscito',
        'error_create' => 'ERRORE creando',
        'continue' => 'Processa pi� immagini',
        'main_success' => 'Il file %s � stato impostato come immagine principale',
        'error_rename' => 'Errore rinominando %s in %s',
        'error_not_found' => 'Il file %s non � stato trovato',
        'back' => 'torna al menu principale',
        'thumbs_wait' => 'Aggiornamento miniature e/o immagini ridimensionate, attendi...',
        'thumbs_continue_wait' => 'Continua aggiornamento miniature e/o immagini ridimensionate...',
        'titles_wait' => 'Aggiornamento titoli, attendi...',
        'delete_wait' => 'Cancellazione titoli, attendi...',
        'replace_wait' => 'Cancellazione originali e sostituzione con immagini ridimensionate, attendi..',
        'instruction' => 'Istruzioni rapide',
        'instruction_action' => 'Scegli azione',
        'instruction_parameter' => 'Imposta parametri',
        'instruction_album' => 'Scegli album',
        'instruction_press' => 'Premi [submit]%s',
        'update' => 'Aggiorna miniature e/o immagini ridimensionate',
        'update_what' => 'Cosa aggiornare',
        'update_thumb' => 'Solo miniature',
        'update_pic' => 'Solo immagini ridimensionate',
        'update_both' => 'Sia le miniature che le immagini ridimensionate',
        'update_number' => 'Numero di immagini elaborate per click',
        'update_option' => '(Prova ad impostare questa opzione ad un valore basso se hai problemi di timeout)',
        'filename_title' => 'Nome File &rArr; Titolo Immagine',
        'filename_how' => 'Come modificare il nome file',
        'filename_remove' => 'Rimuovi il .jpg finale e sostituisci _ (underscore) con spazi',
        'filename_euro' => 'Cambia 2003_11_23_13_20_20.jpg in 23/11/2003 13:20',
        'filename_us' => 'Cambia 2003_11_23_13_20_20.jpg in 11/23/2003 13:20',
        'filename_time' => 'Cambia 2003_11_23_13_20_20.jpg in 13:20',
        'delete' => 'Cancella titoli immagini o immagini con dimensioni originali',
        'delete_title' => 'Cancella titoli immagini',
        'delete_original' => 'Cancella le immagini originali',
        'delete_replace' => 'Cancella le immagini originali sostituendole con la versione ridimensionata',
        'select_album' => 'Scegli album',
        );
// ------------------------------------------------------------------------- //
// File pagetitle.inc.php
// ------------------------------------------------------------------------- //
$lang_pagetitle_php = array(
'divider' => '>',
    'viewing' => 'Mostro Immagine',
    'usr' => "'s Galleria immagini",
    'photogallery' => 'Galleria immagini',
    );

?>