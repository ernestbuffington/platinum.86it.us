<?php 
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.2.2   nuke - Language Pack 0.93                //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002,2003  Gregory DEMAR <gdemar@wanadoo.fr>               //
// http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                        //
// (http://coppermine.sf.net/team/)                                          //
// see /docs/credits.html for details                                        //
// ------------------------------------------------------------------------- //
// New Port by CPG-nuke Dev Team                                                 //
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
// info about translators and translated language
define('PIC_VIEWS', 'Veces vista');
define('PIC_VOTES', 'Votos');
define('PIC_COMMENTS', 'Commentarios');

$lang_translation_info = array(
    'lang_name_english' => 'Spanish', // the name of your language in English, e.g. 'Greek' or 'Spanish'
    'lang_name_native' => 'Espa&ntilde;ol', // the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol'
    'lang_country_code' => 'es', // the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
    'trans_name' => 'Daniel Villoldo (Grumpywolf)', // the name of the translator - can be a nickname
    'trans_email' => 'dvp@arrakis.es', // translator's email address (optional)
    'trans_website' => 'http://grumpywolf.net/', // translator's website (optional)
    'trans_date' => '2003-10-03', // the date the translation was created / last modified
    );

$lang_charset = 'iso-8859-1';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');
// Day of weeks and months
$lang_day_of_week = array('Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab');
$lang_month = array('Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic');
// Some common strings
$lang_yes = 'Si';
$lang_no = 'No';
$lang_back = 'ATRAS';
$lang_continue = 'CONTINUAR';
$lang_info = 'Informaci�n';
$lang_error = 'Error';
// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt = '%d de %B de %Y';
$lastcom_date_fmt = '%d/%m/%y a las %H:%M';
$lastup_date_fmt = '%d de %B de %Y';
$register_date_fmt = '%d de %B de %Y';
$lasthit_date_fmt = '%d de %B de %Y a las %I:%M %p';
$comment_date_fmt = '%d de %B de %Y a las %I:%M %p';
// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array('random' => 'Fotos al azar',
    'lastup' => '�ltimas fotos',
    'lastupby' => 'My Last Additions', // new 1.2.2
    'lastalb' => '�ltimos albums modificados',
    'lastcom' => '�ltimos comentarios',
    'lastcomby' => 'My Last comments', // new 1.2.2
    'topn' => 'M�s vistas',
    'toprated' => 'M�s valoradas',
    'lasthits' => '�ltimas vistas',
    'search' => 'Resultado de la b�squeda',
    'favpics' => 'Fotos favoritas'
    );

$lang_errors = array('access_denied' => 'No tienes permisos para acceder a esta p�gina.',
    'perm_denied' => 'No tienes permisos para realizar esta operaci�n.',
    'param_missing' => 'Llamada a Script sin los par�metros requeridos.',
    'non_exist_ap' => '�El album/foto seleccionado no existe!',
    'quota_exceeded' => 'Cuota de disco excedida<br /><br />Tienes una cuota de disco de [quota]K, tus fotos actualmente ocupan [space]K, y a�adiendo esta foto exceder�as la cuota.',
    'gd_file_type_err' => 'Cuando se usa la librer�a de imagen GD solamente est�n permitidos los tipos JPEG y PNG.',
    'invalid_image' => 'La imagen que has a�adido est� corrupta o no puede ser tratada por la librer�a GD.',
    'resize_failed' => 'Incapaz de crear thumbnail o imagen de tama�o reducido.',
    'no_img_to_display' => 'Ninguna imagen que ense�ar.',
    'non_exist_cat' => 'La categor�a seleccionada no existe.',
    'orphan_cat' => 'Una categor�a no tiene padre, ejecuta la utilidad de categor�as para corregir el problema.',
    'directory_ro' => 'El directorio \'%s\' no tiene permisos de escritura, las fotos no pueden ser borradas.',
    'non_exist_comment' => 'El comentario seleccionado no existe.',
    'pic_in_invalid_album' => '��La foto est� en un album que no existe (%s)!?',
    'banned' => 'Actualmente est�s expulsado respecto al uso de esta web.',
    'not_with_udb' => 'Esta funci�n est� desactivada en Coppermine porque est� integrada con un software de foros. Lo que fuese que est�s intentando hacer no est� soportado en esta configuraci�n, o la funci�n debe ser manejada por el software de foros.',
    'members_only' => 'This function is for members only, please join.', // changed in cpg1.2.0nuke
    'mustbe_god' => 'This function is only for the site admin. You must be logged in as superadmin, god account to access this function'
    );
// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //
$lang_main_menu = array('alb_list_title' => 'Ir a la lista de albums',
    'alb_list_lnk' => 'Lista de Albums',
    'my_gal_title' => 'Ir a mi galer�a personal',
    'my_gal_lnk' => 'Mi galer�a',
    'my_prof_lnk' => 'Mi perfil de usuario',
    'adm_mode_title' => 'Ir a modo administrador',
    'adm_mode_lnk' => 'Modo Admininstrador',
    'usr_mode_title' => 'Ir a modo usuario',
    'usr_mode_lnk' => 'Modo Usuario',
    'upload_pic_title' => 'Insertar foto en un album',
    'upload_pic_lnk' => 'Insertar foto',
    'register_title' => 'Crear un usuario',
    'register_lnk' => 'Registrarse',
    'login_lnk' => 'Login',
    'logout_lnk' => 'Logout',
    'lastup_lnk' => '�ltimas fotos',
    'lastcom_lnk' => '�ltimos comentarios',
    'topn_lnk' => 'M�s vistas',
    'toprated_lnk' => 'M�s valoradas',
    'search_lnk' => 'Buscar',
    'fav_lnk' => 'Mis Favoritos',
    'ban_lnk' => 'Ban usuarios',

    );

$lang_gallery_admin_menu = array('upl_app_lnk' => 'Aprobar Uploads',
    'config_lnk' => 'Configuraci�n',
    'albums_lnk' => 'Albums',
    'categories_lnk' => 'Categor�as',
    'users_lnk' => 'Usuarios',
    'groups_lnk' => 'Grupos',
    'comments_lnk' => 'Comentarios',
    'searchnew_lnk' => 'A�adir fotos (Batch)',
    'util_lnk' => 'Cambiar tama�o de las fotos',
    'ban_lnk' => 'Expulsar a Usuarios',

    );

$lang_user_admin_menu = array('albmgr_lnk' => 'Crear / ordenar albums',
    'modifyalb_lnk' => 'Modificar mis albums',
    'my_prof_lnk' => 'Mi perfil de usuario',
    );

$lang_cat_list = array('category' => 'Categor�a',
    'albums' => 'Albums',
    'pictures' => 'Fotos',
    );

$lang_album_list = array('album_on_page' => '%d albums en %d p�gina(s)'
    );

$lang_thumb_view = array('date' => 'FECHA',
    'name' => 'NOMBRE',
    'title' => 'TITULO',
    'sort_da' => 'Ordenado por fecha ascendente',
    'sort_dd' => 'Ordenado por fecha descendente',
    'sort_na' => 'Ordenado por nombre ascendente',
    'sort_nd' => 'Ordenado por nombre descendente',
    'sort_ta' => 'Ordenado por t�tulo ascendente',
    'sort_td' => 'Ordenado por t�tulo descendente',
    'pic_on_page' => '%d fotos en %d p�gina(s)',
    'user_on_page' => '%d usuarios en %d p�gina(s)',
    'sort_ra' => 'Sort by rating ascending', // new in cpg1.2.0nuke
    'sort_rd' => 'Sort by rating descending', // new in cpg1.2.0nuke
    'rating' => 'RATING', // new in cpg1.2.0nuke
    'sort_title' => 'Sort pictures by:', // new in cpg1.2.0nuke
    );

$lang_img_nav_bar = array('thumb_title' => 'Volver al �ndice del album',
    'pic_info_title' => 'Mostrar/ocultar informaci�n de la foto',
    'slideshow_title' => 'Slideshow',
    'slideshow_disabled' => 'e-cards are disabled', // new in cpg1.2.0nuke
    'slideshow_disabled_msg' => $lang_errors['members_only'], // new in cpg1.2.0nuke
    'ecard_title' => 'Enviar esta foto a un amigo',
    'ecard_disabled' => 'Envio de fotos deshabilitado',
    'ecard_disabled_msg' => 'No tienes permisos para enviar fotos',
    'prev_title' => 'Ver foto anterior',
    'next_title' => 'Ver foto siguiente',
    'pic_pos' => 'FOTO %s/%s',
    'no_more_images' => 'There are no more images in this galley', // new in cpg1.2.0nuke
    'no_less_images' => 'This is the first image in the gallery', // new in cpg1.2.0nuke
    );

$lang_rate_pic = array('rate_this_pic' => 'Valorar esta foto ',
    'no_votes' => '(No hay votos)',
    'rating' => '(valoraci�n actual : %s / 5 con %s votos)',
    'rubbish' => 'Mala',
    'poor' => 'Regular',
    'fair' => 'Normal',
    'good' => 'Buena',
    'excellent' => 'Excelente',
    'great' => 'Genial',
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
    CRITICAL_ERROR => 'Error cr�tico',
    'file' => 'Fichero: ',
    'line' => 'Linea: ',
    );

$lang_display_thumbnails = array('filename' => 'Fichero: ',
    'filesize' => 'Tama�o: ',
    'dimensions' => 'Dimensiones: ',
    'date_added' => 'Fecha de alta: '
    );

$lang_get_pic_data = array('n_comments' => '%s comentarios',
    'n_views' => '%s veces vista',
    'n_votes' => '(%s votos)'
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
        'Very Happy' => 'Very Happy',
        'Smile' => 'Smile',
        'Sad' => 'Sad',
        'Surprised' => 'Surprised',
        'Shocked' => 'Shocked',
        'Confused' => 'Confused',
        'Cool' => 'Cool',
        'Laughing' => 'Laughing',
        'Mad' => 'Mad',
        'Razz' => 'Razz',
        'Embarassed' => 'Embarassed',
        'Crying or Very sad' => 'Crying or Very sad',
        'Evil or Very Mad' => 'Evil or Very Mad',
        'Twisted Evil' => 'Twisted Evil',
        'Rolling Eyes' => 'Rolling Eyes',
        'Wink' => 'Wink',
        'Idea' => 'Idea',
        'Arrow' => 'Arrow',
        'Neutral' => 'Neutral',
        'Mr. Green' => 'Mr. Green',
        );
// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //
// void
// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //
if (defined('ADMIN_PHP')) $lang_admin_php = array(0 => 'Saliendo de modo administrador...',
        1 => 'Entrando en modo administrador...',
        );
// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //
if (defined('ALBMGR_PHP')) $lang_albmgr_php = array('alb_need_name' => '�Los albums deben tener un nombre!',
        'confirm_modifs' => '�Est�s seguro de aplicar estas modificaciones?',
        'no_change' => '�No se hizo ning�n cambio!',
        'new_album' => 'Nuevo album',
        'confirm_delete1' => '�Est�s seguro de querer borrar este album?',
        'confirm_delete2' => '\nTodas las fotos y comentarios que contiene se perder�n!',
        'select_first' => 'Selecciona un album primero',
        'alb_mrg' => 'Administrador de Albums',
        'my_gallery' => '* Mi galer�a *',
        'no_category' => '* Sin categor�a *',
        'delete' => 'Borrar',
        'new' => 'Nuevo',
        'apply_modifs' => 'Aplicar modificaciones',
        'select_category' => 'Seleccionar categor�a',
        );
// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) $lang_catmgr_php = array('miss_param' => '�Los par�metros requeridos para la operaci�n: \'%s\' no han sido suministrados!',
        'unknown_cat' => 'La categor�a seleccionada no existe en la base da datos',
        'usergal_cat_ro' => '�Las categor�as de galer�as de usuario no pueden ser borradas!',
        'manage_cat' => 'Organizador de categor�as',
        'confirm_delete' => 'Est�s seguro de querer BORRAR esta catagor�a',
        'category' => 'Categor�a',
        'operations' => 'Operaciones',
        'move_into' => 'Mover hacia',
        'update_create' => 'Modificar/Crear categor�a',
        'parent_cat' => 'Categor�a padre',
        'cat_title' => 'T�tulo de la categor�a',
        'cat_desc' => 'Descripci�n de la categor�a'
        );
// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //
if (defined('CONFIG_PHP')) $lang_config_php = array('title' => 'Configuraci�n',
        'restore_cfg' => 'Restaurar valores por defecto',
        'save_cfg' => 'Guardar la nueva configuraci�n',
        'notes' => 'Notas',
        'info' => 'Informaci�n',
        'upd_success' => 'La configuraci�n de Coppermine ha sido actualizada',
        'restore_success' => 'Valores por defecto de Coppermine restaurados',
        'name_a' => 'Ascendente por nombre',
        'name_d' => 'Descendente por nombre',
        'title_a' => 'Ascendente por t�tulo',
        'title_d' => 'Descendente por t�tulo',
        'date_a' => 'Ascendente por fecha',
        'date_d' => 'Descendente por fecha',
        'rating_a' => 'Rating ascending', // new in cpg1.2.0nuke
        'rating_d' => 'Rating descending', // new in cpg1.2.0nuke
        'th_any' => 'Max Aspect',
        'th_ht' => 'Height',
        'th_wd' => 'Width',
        );

if (defined('CONFIG_PHP'))
    $lang_config_data = array(
        // General settings
        'Par�metros Generales',
        array(
            'Nombre de la galer�a', 'gallery_name', 0),
        array(
            'Descripci�n de la galer�a', 'gallery_description', 0),
        array(
            'Correo electr�nico del administrador', 'gallery_admin_email', 0),
        array(
            'Address to nuke folder ie http://www.mysite.tld/html/', 'ecards_more_pic_target', 0), // new in cpg1.2.0nuke
        array(
            'Lenguaje', 'lang', 5),
// for postnuke change
        array('Tema (aspecto)', 'cpgtheme', 6),
        array(
            'Page Specific Titles instead of >Coppermine', 'nice_titles', 1), 
        array('Show blocks on the right', 'right_blocks', 1), // new 1.2.2
        // 'Album list view',
        'Aspecto de la lista de albums',
        array(
            'Anchura de la tabla principal (pixels o %)', 'main_table_width', 0),
        array(
            'N�mero de niveles de categor�as a mostrar', 'subcat_level', 0),
        array(
            'N�mero de albums a mostrar', 'albums_per_page', 0),
        array(
            'N�mero de columnas en la lista de albums', 'album_list_cols', 0),
        array(
            'Tama�o de los thumbnails en pixels', 'alb_list_thumb_size', 0),
        array(
            'Contenido de la p�gina principal', 'main_page_layout', 0),
        array(
            'Mostrar thumbnails de albums de primer nivel en categor�as', 'first_level', 1), 
        // 'Thumbnail view',
        'Aspecto de la vista de Thumbnails',
        array(
            'N�mero de columnas en la p�gina de thumbnails', 'thumbcols', 0),
        array(
            'N�mero de filas en la p�gina de thumbnails', 'thumbrows', 0),
        array(
            'M�ximo n�mero de tabs a mostrar', 'max_tabs', 0),
        array(
            'Mostrar picture caption (adem�s del t�tulo) debajo del thumbnail', 'caption_in_thumbview', 1),
        array(
            'Mostrar el n�mero de comentarios debajo del thumbnail', 'display_comment_count', 1),
        array(
            'Orden por defecto de las fotos', 'default_sort_order', 3),
        array(
            'Minimo n�mero de votos para que una foto aparezca el la lista de \'M�s Valoradas\' list', 'min_votes_for_rating', 0),
        array(
            'Alts and title tags of thumbnail show title and keyword instead of picinfo', 'seo_alts', 1), // new in cpg1.2.0nuke
        // 'Image view &amp; Comment settings',
        'Vista de foto y Configuraci�n de comentarios',
        array(
            'Anchura de la tabla donde mostrar la foto (pixels o %)', 'picture_table_width', 0),
        array(
            'Informaci�n de la foto visible por defecto', 'display_pic_info', 1),
        array(
            'Filtrar palabras malsonantes en los comentarios', 'filter_bad_words', 1),
        array(
            'Permitir Emoticons en los comentarios', 'enable_smilies', 1),
        array(
            'Allow several consecutive comments on one pic from the same user', 'disable_flood_protection', 1), // new in cpg1.2.0nuke
        array(
            'Email site admin upon comment submission' , 'comment_email_notification', 1), // new in cpg1.2.0nuke
        array(
            'M�xima longitud para la descripci�n de una foto', 'max_img_desc_length', 0),
        array(
            'M�ximo n�mero de caracteres en una palabra', 'max_com_wlength', 0),
        array(
            'M�ximo n�mero de lineas en un comentario', 'max_com_lines', 0),
        array(
            'M�xima longitud de un comentario', 'max_com_size', 0),
        array(
            'Mostrar tira de pel�cula', 'display_film_strip', 1),
        array(
            'N�mero de objetos en tira de pel�cula', 'max_film_strip_items', 0),
        array(
            'Allow viewing of full size pic by anonymous', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke
        array('Number of days between being able to vote on the same image','keep_votes_time',0), // new in cpg1.2.2c nuke
//'Pictures and thumbnails settings',
        'Configuraci�n de las fotos y thumbnails',
        array(
            'Calidad para los ficheros JPEG', 'jpeg_qual', 0),
        array(
            'M�xima anchura o altura de los thumbnail <strong>*</strong>', 'thumb_width', 0),
        array(
            'Usar dimensi�n ( anchura o altura o M�ximo para los thumbnail )<strong>*</strong>', 'thumb_use', 7),
        array(
            'Crear fotos de tama�o intermedio', 'make_intermediate', 1),
        array(
            'M�xima anchura o altura de las fotos de tama�o intermedio <strong>*</strong>', 'picture_width', 0),
        array(
            'M�ximo tama�o de los fotos de usuarios por upload (KB)', 'max_upl_size', 0),
        array(
            'M�xima anchura o altura de las fotos de usuarios por upload (pixels)', 'max_upl_width_height', 0), 
        // 'User settings',
        'Configuraci�n de usuarios',
        array(
            'Permitir el registro de nuevos usuarios', 'allow_user_registration', 1),
        array(
            'Registro de usuarios requiere verificaci�n de email', 'reg_requires_valid_email', 1),
        array(
            'Permitir a dos usuarios tener el mismo email', 'allow_duplicate_emails_addr', 1),
        array(
            'Los usuarios pueden tener albums privados', 'allow_private_albums', 1), 
        array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',
        'Campos extra para descripci�n de fotos (dejar en blanco si no los usas)',
        array(
            'Nombre del campo 1', 'user_field1_name', 0),
        array(
            'Nombre del campo 2', 'user_field2_name', 0),
        array(
            'Nombre del campo 3', 'user_field3_name', 0),
        array(
            'Nombre del campo 4', 'user_field4_name', 0), 
        // 'Pictures and thumbnails advanced settings',
        'Configuraci�n avanzada de fotos y thumbnails',
        array(
            'Mostrar icono de album privado a usuarios no registrados', 'show_private', 1),
        array(
            'Caracteres prohibidos en los nombres de las fotos', 'forbiden_fname_char', 0),
        array(
            'Extensiones de fichero admitidos en los uploads', 'allowed_file_extensions', 0),
        array(
            'M�todo para el reescalado de fotos', 'thumb_method', 2),
        array(
            'Path de la utilidad ImageMagick (por ejemplo /usr/bin/X11/)', 'impath', 0),
        array(
            'Tipos de ficheros admitidos (solo v�lidos con ImageMagick)', 'allowed_img_types', 0),
        array(
            'Comandos de linea para ImageMagick', 'im_options', 0),
        array(
            'Leer datos EXIF en ficheros de tipo JPEG', 'read_exif_data', 1),
        array(
            'Read IPTC data in JPEG files', 'read_iptc_data', 1), // new in cpg1.2.0nuke
        array(
            'Directorio base de los albums <strong>*</strong>', 'fullpath', 0),
        array(
            'Dierctorio para las fotos subidas por los usuarios <strong>*</strong>', 'userpics', 0),
        array(
            'Prefijo para las fotos de tama�o intermedio <strong>*</strong>', 'normal_pfx', 0),
        array(
            'Prefijo para los thumbnails <strong>*</strong>', 'thumb_pfx', 0),
        array(
            'Modo por defecto de los directorios', 'default_dir_mode', 0),
        array(
            'Modo por defecto para las fotos', 'default_file_mode', 0),
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
        'Configuraci�n de cookies y Juego de Caracteres',
        array(
            'Nombre de la cookie usada por el script', 'cookie_name', 0),
        array(
            'Path de la cookie usada por el script', 'cookie_path', 0),
        array(
            'Juego de caracteres', 'charset', 4), 
        // 'Miscellaneous settings',
        'Configuraciones de otros aspectos',
        array(
            'Activar modo debug', 'debug_mode', 1),
        array(
'Enable advanced debug mode', 'advanced_debug_mode', 1), // new in cpg1.2.0nuke
array(
'Show Coppermine Update Alert to Admin', 'showupdate', 1), // new 1.2.2
        '<br /><div align="center">(*) Los campos marcados con * no deben ser cambiados si ya se tienen fotos en las galer�as</div><br />'
        );
// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //
if (defined('DB_INPUT_PHP')) $lang_db_input_php = array('empty_name_or_com' => 'Debes introducir tu nombre y un comentario',
        'com_added' => 'Tu comentario ha sido a�adido',
        'alb_need_title' => '�Debes de introducir un t�tulo para el album!',
        'no_udp_needed' => 'No se requiere ning�n cambio',
        'alb_updated' => 'El album ha sido actualizado',
        'unknown_album' => 'El album seleccionado no existe o no tienes permisos para a�adir fotos en este album',
        'no_pic_uploaded' => '�Ninguna foto fue a�adida!<br /><br />Si hab�as seleccionado una foto para a�adir, comprueba que el servidor admite subir ficheros...',
        'err_mkdir' => '�Fallo al crear el directorio %s!',
        'dest_dir_ro' => '�El directorio destino %s no tiene permisos de escritura!',
        'err_move' => '�Imposible mover %s a %s !',
        'err_fsize_too_large' => 'El tama�o de la foto que quieres insertar es demasiago grande (el m�ximo permitido es de %s x %s)',
        'err_imgsize_too_large' => 'El tama�o del fichero de la foto que quieres insertar es demasiado grande (el m�ximo permitido es de %s KB)',
        'err_invalid_img' => 'El fichero que quieres insertar no es una imagen v�lida',
        'allowed_img_types' => 'Puedes insertar solamente %s fotos.',
        'err_insert_pic' => 'La foto \'%s\' no puede ser dada de alta en el album ',
        'upload_success' => 'La foto ha sido insertada correctamente<br /><br />Ser� visible tras la aprobaci�n de los administradores.',
        'info' => 'Informaci�n',
        'com_added' => 'Comentario a�adido',
        'alb_updated' => 'Album actualizado',
        'err_comment_empty' => '�El comentario est� vacio!',
        'err_invalid_fext' => 'Solamente est�n admitidas fotos con las siguientes extensiones : <br /><br />%s.',
        'no_flood' => 'Perdona pero eres el autor/a del �ltimo comentario introducido para esta foto<br /><br />Puedes editar el comentario que has puesto si es que quieres modificarlo',
        'redirect_msg' => 'Est�s siendo redirigido.<br /><br /><br />Pulsa \'CONTINUAR\' si la p�gina no se refresca autom�ticamente',
        'upl_success' => 'La foto se ha a�adido correctamente',
        );
// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //
if (defined('DELETE_PHP')) $lang_delete_php = array('caption' => 'Caption',
        'fs_pic' => 'imagen tama�o completo',
        'del_success' => 'borrado correctamente',
        'ns_pic' => 'imagen tama�o normal',
        'err_del' => 'no puede ser borrado',
        'thumb_pic' => 'thumbnail',
        'comment' => 'comentario',
        'im_in_alb' => 'fotos en el album',
        'alb_del_success' => 'Album \'%s\' borrado',
        'alb_mgr' => 'Organizador de albums',
        'err_invalid_data' => 'Datos inv�lidos recibidos en \'%s\'',
        'create_alb' => 'Creando el album \'%s\'',
        'update_alb' => 'Actualizando album \'%s\' con el t�tulo \'%s\' y el �ndice \'%s\'',
        'del_pic' => 'Borrar foto',
        'del_alb' => 'Borrar album',
        'del_user' => 'Borrar usuario',
        'err_unknown_user' => '�El usuario seleccionado no existe!',
        'comment_deleted' => 'El comentario ha sido borrado',
        );
// ------------------------------------------------------------------------- //
// File displayecard.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File displayimage.php
// ------------------------------------------------------------------------- //
if (defined('DISPLAYIMAGE_PHP')) {
    $lang_display_image_php = array('confirm_del' => '�Est�s seguro de querer BORRAR esta foto? \\nLos comentarios ser�n tambi�n borrados.',
        'del_pic' => 'BORRAR ESTA FOTO',
        'size' => '%s x %s pixels',
        'views' => '%s veces',
        'slideshow' => 'Slideshow',
        'stop_slideshow' => 'DETENER SLIDESHOW',
        'view_fs' => 'Pulsa aqui para ver la imagen a tama�o completo',
        'edit_pic' => 'EDIT PICTURE INFO', // new in cpg1.2.0nuke
        );

    $lang_picinfo = array('title' => 'Informaci�n de la foto',
        'Filename' => 'Nombre del fichero',
        'Album name' => 'Nombre del album',
        'Rating' => 'Valoraci�n (%s votos)',
        'Keywords' => 'Palabras clave',
        'File Size' => 'Tama�o del fichero',
        'Dimensions' => 'Dimensiones',
        'Displayed' => 'Se ha visto',
        'Camera' => 'C�mara',
        'Date taken' => 'Fecha de la foto',
        'Aperture' => 'Apertura',
        'Exposure time' => 'Tiempo de exposici�n',
        'Focal length' => 'Longitud del foco',
        'Comment' => 'Comentario',
        'addFav' => 'A�adir a Favoritos',
        'addFavPhrase' => 'Favoritos',
        'remFav' => 'Quitar de Favoritos',
        'iptcTitle' => 'IPTC Title', // new in cpg1.2.0nuke
        'iptcCopyright' => 'IPTC Copyright', // new in cpg1.2.0nuke
        'iptcKeywords' => 'IPTC Keywords', // new in cpg1.2.0nuke
        'iptcCategory' => 'IPTC Category', // new in cpg1.2.0nuke
        'iptcSubCategories' => 'IPTC Sub Categories', // new in cpg1.2.0nuke
        'bookmark_page' => 'Bookmark Image', // new in cpg1.2.0nuke
        );

    $lang_display_comments = array('OK' => 'OK',
        'edit_title' => 'Editar el comentario',
        'confirm_delete' => '�Est�s seguro de querer borrar el comentario?',
        'add_your_comment' => 'A�adir un comentario',
        'name' => 'Nombre',
        'comment' => 'Comentario',
        'your_name' => 'An�nimo',
        );

    $lang_fullsize_popup = array('click_to_close' => 'Pulsa en la imagen para cerrar esta ventana',
        );
} 
// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //
if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php = array('title' => 'Enviar foto a un amigo',
        'invalid_email' => '<strong>Atenci�n</strong> : �direcci�n e-mail incorrecta!',
        'ecard_title' => 'Una foto de %s para ti',
        'view_ecard' => 'Si la foto no se ve correctamente, pulsa en este link',
        'view_more_pics' => '�Pulsa aqui para ver m�s fotos!',
        'send_success' => 'La foto ha sido enviada',
        'send_failed' => 'Disculpa, pero el servidor no puede enviar la foto...',
        'from' => 'De',
        'your_name' => 'Tu nombre',
        'your_email' => 'Tu direcci�n de e-mail',
        'to' => 'A',
        'rcpt_name' => 'Nombre de tu amigo',
        'rcpt_email' => 'Direcci�n e-mail de tu amigo',
        'greetings' => 'T�tulo del mensaje',
        'message' => 'Mensaje',
        );
// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //
if (defined('EDITPICS_PHP')) $lang_editpics_php = array('pic_info' => 'Informaci�n',
        'album' => 'Album',
        'title' => 'T�tulo',
        'desc' => 'Descripci�n',
        'keywords' => 'Keywords',
        'pic_info_str' => '%sx%s - %sKB - %s veces vista - %s votos',
        'approve' => 'Aprobar la foto',
        'postpone_app' => 'Postponer aprobado de foto',
        'del_pic' => 'Borrar foto',
        'reset_view_count' => 'Poner a cero el contador de veces que se ha visto',
        'reset_votes' => 'Poner a cero los votos',
        'del_comm' => 'Borrar comentarios',
        'upl_approval' => 'Aprobar uploads',
        'edit_pics' => 'Editar fotos',
        'see_next' => 'Ir a las siguientes fotos',
        'see_prev' => 'If a las fotos anteriores',
        'n_pic' => '%s foto/s',
        'n_of_pic_to_disp' => 'N�mero de fotos a mostrar',
        'apply' => 'Validar los cambios'
        );
// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //
if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array('group_name' => 'Nombre del grupo',
        'disk_quota' => 'Cuota de disco',
        'can_rate' => 'Pueden valorar fotos',
        'can_send_ecards' => 'Pueden enviar ecards',
        'can_post_com' => 'Pueden a�adir comentarios',
        'can_upload' => 'Pueden a�adir fotos',
        'can_have_gallery' => 'Pueden tener galer�as personales',
        'apply' => 'Validar los cambios',
        'create_new_group' => 'Crear nuevo grupo',
        'del_groups' => 'Borrar el/los grupo(s) seleccionados',
        'confirm_del' => '�Atenci�n, cuando borras un grupo, los usuarios que pertenecen a ese grupo ser�n transferidos al grupo \'Registered\'!\n\n�Deseas continuar?',
        'title' => 'Configurar grupos de usuarios',
        'approval_1' => 'Aprobaci�n album p�blico (1)',
        'approval_2' => 'Aprobaci�n album privado (2)',
        'note1' => '<strong>(1)</strong> A�adir fotos en un album p�blico requerir� aprobaci�n de los administradores',
        'note2' => '<strong>(2)</strong> A�adir fotos en un album que pertenece al asuario requerir� aprobaci�n de los administradores',
        'notes' => 'Notas'
        );
// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //
if (defined('INDEX_PHP')) {
    $lang_index_php = array('welcome' => '�Bienvenido!'
        );

    $lang_album_admin_menu = array('confirm_delete' => '�Est�s seguro de querer BORRAR este album ? \\nTodas las fotos y comentarios ser�n tambi�n borrados.',
        'delete' => 'BORRAR',
        'modify' => 'MODIFICAR',
        'edit_pics' => 'EDITAR FOTOS',
        );

    $lang_list_categories = array('home' => 'Home',
        'stat1' => '<strong>[pictures]</strong> fotos en <strong>[albums]</strong> albums y <strong>[cat]</strong> categor�as con <strong>[comments]</strong> comentarios, vistas <strong>[views]</strong> veces',
        'stat2' => '<strong>[pictures]</strong> fotos en <strong>[albums]</strong> albums, vistas <strong>[views]</strong> veces',
        'xx_s_gallery' => 'Galer�a de %s',
        'stat3' => '<strong>[pictures]</strong> fotos en <strong>[albums]</strong> albums con <strong>[comments]</strong> comentarios, vistas <strong>[views]</strong> veces'
        );

    $lang_list_users = array('user_list' => 'Lista de usuarios',
        'no_user_gal' => 'No existen usuarios con permisos para tener albums',
        'n_albums' => '%s album(s)',
        'n_pics' => '%s foto(s)'
        );

    $lang_list_albums = array('n_pictures' => '%s fotos',
        'last_added' => ', �ltima a�adida el %s'
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
if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array('upd_alb_n' => 'Modificar album %s',
        'general_settings' => 'Configuraci�n general',
        'alb_title' => 'T�tulo del album',
        'alb_cat' => 'Categor�a del album',
        'alb_desc' => 'Descripci�n del album',
        'alb_thumb' => 'Thumbnail del album',
        'alb_perm' => 'Permisos para este album',
        'can_view' => 'Este album puede ser visto por',
        'can_upload' => 'Los visitantes pueden a�adir fotos',
        'can_post_comments' => 'Los visitantes pueden a�adir comentarios',
        'can_rate' => 'Los visitantes pueden valorar las fotos',
        'user_gal' => 'Galer�a de usuario',
        'no_cat' => '* Sin categor�a *',
        'alb_empty' => 'El album est� vac�o',
        'last_uploaded' => 'Ultima foto a�adida',
        'public_alb' => 'Todo el mundo (album p�blico)',
        'me_only' => 'Solamente yo',
        'owner_only' => 'Solamente el due�o del album (%s)',
        'groupp_only' => 'Miembros del grupo \'%s\'',
        'err_no_alb_to_modify' => 'No puedes modificar ning�n album en la base de datos.',
        'update' => 'Modificar album'
        );
// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //
if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array('already_rated' => 'Perdona pero ya has votado anteriormente a esta foto',
        'rate_ok' => 'Tu voto ha sido contabilizado',
        );
// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //
if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {
    $lang_register_disclamer = <<<EOT
A pesar de que los administradores de {SITE_NAME} intentar�n eliminar o editar cualquier material desagradable tan pronto como puedan, resulta imposible revisar todos los env�os que se realizan. Por lo tanto debes tener en cuenta que todos los env�os hechos hacia esta web expresan el punto de vista y opiniones de sus autores y no los de los administradores o webmasters (excepto los a�adidos por ellos mismos).<br />
<br />
Usted acuerda no a�adir ning�n material abusivo, obsceno, vulgar, escandaloso, odioso, amenazador, de orientaci�n sexual, o ning�n otro que pueda violar cualquier ley aplicable. Usted est� de acuerdo con que el webmaster, el administrador y los asesores de { SITE_NAME } tienen el derecho de quitar o de corregir cualquier contenido en cualquier momento si lo consideran necesario. Como usuario, accede a que cualquier informaci�n a�adida ser� almacenada en una base de datos. Asi mismo, esta informaci�n no ser� divulgada a terceros sin su consentimiento. El webmaster y el administrador no se pueden hacer responsables de ning�n intento de destrucci�n de la base de datos que pueda conducir a la p�rdida de la misma.<br />
<br />
Este sitio utiliza cookies para almacenar la informaci�n en su ordenador. Estas cookies sirven para mejorar la navegaci�n en este sitio. La direcci�n de email se utiliza solamente para confirmar sus detalles y contrase�a del registro.<br />
<br />
Pulsando 'estoy de acuerdo' expresas tu conformidad con estas condiciones.
EOT;

    $lang_register_php = array('page_title' => 'Registro de nuevo usuario',
        'term_cond' => 'T�rminos y condiciones',
        'i_agree' => 'Estoy de acuerdo',
        'submit' => 'Enviar solicitud de registro',
        'err_user_exists' => 'El nombre de usuario elegido ya existe, por favor elige otro diferente',
        'err_password_mismatch' => 'Las dos contrase�as no son iguales, por favor vuelve a introducirlas',
        'err_uname_short' => 'El nombre de usuario debe ser de 2 caracteres de longitud como m�nimo',
        'err_password_short' => 'La contrase�a debe ser de 2 caracteres de longitud como m�nimo',
        'err_uname_pass_diff' => 'El nombre de usuario y la contrase�a deben ser diferentes',
        'err_invalid_email' => 'La direcci�n de email no es v�lida',
        'err_duplicate_email' => 'Otro usuario se ha registrado anteriormente con la direcci�n de email suministrada',
        'enter_info' => 'Introduce la informaci�n de registro',
        'required_info' => 'Informaci�n requerida',
        'optional_info' => 'Informaci�n opcional',
        'username' => 'Nombre de usuario',
        'password' => 'Contrase�a',
        'password_again' => 'Reescribir contrase�a',
        'email' => 'Email',
        'location' => 'Localidad',
        'interests' => 'Intereses',
        'website' => 'P�gina web',
        'occupation' => 'Ocupaci�n',
        'error' => 'ERROR',
        'confirm_email_subject' => '%s - Confirmaci�n de registro',
        'information' => 'Informaci�n',
        'failed_sending_email' => '�El email de confirmaci�n de registro no ha podido ser enviado!',
        'thank_you' => 'Gracias por registrarte.<br /><br />Hemos enviado un email con informaci�n sobre la activaci�n de tu cuenta a la direcci�n de email que nos has facilitado.',
        'acct_created' => 'Tu cuenta de usuario ha sido creada y ahora puedes acceder al sistema con tu nombre de usuario y contrase�a',
        'acct_active' => 'Tu cuenta de usuario est� ya activa y ahora puedes acceder al sistema con tu nombre de usuario y contrase�a',
        'acct_already_act' => '�Tu cuenta ya estaba activa!',
        'acct_act_failed' => '�Esta cuenta no puede ser activada!',
        'err_unk_user' => '�El usuario seleccionado no existe!',
        'x_s_profile' => 'Perfil de %s',
        'group' => 'Grupo',
        'reg_date' => 'Fecha de alta',
        'disk_usage' => 'Uso de disco',
        'change_pass' => 'Cambiar contrase�a',
        'current_pass' => 'Contrase�a actual',
        'new_pass' => 'Nueva contrase�a',
        'new_pass_again' => 'Reescribir nueva contrase�a',
        'err_curr_pass' => 'La contrase�a actual es incorrecta',
        'apply_modif' => 'Guardar los cambios',
        'change_pass' => 'Cambiar mi contrase�a',
        'update_success' => 'Tu perfil ha sido actualizado',
        'pass_chg_success' => 'Tu contrase�a ha sido cambiada',
        'pass_chg_error' => 'Tu contrase�a no ha sido cambiada',
        );

    $lang_register_confirm_email = <<<EOT
Gracias por registrarte en {SITE_NAME}

Tu nombre de usuario es: "{USER_NAME}"
Tu contrase�a es: "{PASSWORD}"

Para terminar de activar tu cuenta, debes pulsar sobre el enlace que
aparece debajo o copiarlo y pegarlo en tu navegador de InterNet.

{ACT_LINK}

Saludos.

Los administradores de {SITE_NAME}

EOT;
} 
// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //
if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array('title' => 'Revisar comentarios',
        'no_comment' => 'No existen comentarios que mostrar',
        'n_comm_del' => '%s comentario(s) borrado(s)',
        'n_comm_disp' => 'N�mero de comentarios a mostrar',
        'see_prev' => 'Ver el anterior',
        'see_next' => 'Ver el siguiente',
        'del_comm' => 'Borrar comentarios seleccionados',
        );
// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //
// if (defined('SEARCH_PHP'))
    $lang_search_php = array(0 => 'Buscar entre todas las fotos',
        );
// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //
if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array('page_title' => 'Buscar nuevas fotos',
        'select_dir' => 'Selecciona directorio',
        'select_dir_msg' => 'Esta funci�n te permite a�adir de forma autom�tica las fotos que hayas subido a tu servidor mediante FTP.<br /><br />Selecciona el directorio donde has subido tus fotos',
        'no_pic_to_add' => 'No hay ninguna foto para a�adir',
        'need_one_album' => 'Necesitas al menos un album para utilizar esta funci�n',
        'warning' => 'Atenci�n',
        'change_perm' => '�El script no puede escribir en este directorio, necesitas cambiar sus permisos a modo 755 o 777 antes de intentarlo de nuevo!',
        'target_album' => '<strong>Colocar las fotos del dierctorio &quot;</strong>%s<strong>&quot; en el album </strong>%s',
        'folder' => 'Carpeta',
        'image' => 'Foto',
        'album' => 'Album',
        'result' => 'Resultado',
        'dir_ro' => 'No se puede escribir. ',
        'dir_cant_read' => 'No se puede leer. ',
        'insert' => 'A�adiendo nuevas fotos a la galer�a',
        'list_new_pic' => 'Listado de nuevas fotos',
        'insert_selected' => 'A�adir las fotos seleccionadas',
        'no_pic_found' => 'No se encontr� ninguna foto nueva',
        'be_patient' => 'Por favor, se paciente, el script necesita tiempo para a�adir las fotos',
        'notes' => '<ul>' . '<li><strong>OK</strong> : significa que la foto fue a�adida sin problemas' . '<li><strong>DP</strong> : significa que la foto es un duplicado y ya existe en la base de datos' . '<li><strong>PB</strong> : significa que la foto no puede ser a�adida, por favor comprueba la configaraci�n y los permisos de los directorios donde est�n las fotos' . '<li>Si los iconos OK, DP, PB no aparecen, pulsa sobre el icono de imagen no cargada para ver el error producido por PHP' . '<li>Si el navegador produce un timeout, pulsa el icono de Actualizar' . '</ul>',
        'select_album' => 'Select album', // new in nuke
        'no_album' => 'No album name was selected, click back and select an album to put your pictures in',
        );
// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File banning.php  //not in cpg1.2.0-nuke
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //
if (defined('UPLOAD_PHP')) $lang_upload_php = array('title' => 'Insertar nueva foto',
        'max_fsize' => 'El tama�o m�ximo de fichero admitido es de %s KB',
        'album' => 'Album',
        'picture' => 'Foto',
        'pic_title' => 'T�tulo de la foto',
        'description' => 'Descripci�n de la foto',
        'keywords' => 'Palabras clave (separadas por espacios)',
        'err_no_alb_uploadables' => 'Perdona pero no hay ning�n album donde est� permitido insertar nuevas fotos',
        );
// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //
if (defined('USERMGR_PHP')) $lang_usermgr_php = array('title' => 'Administrar usuarios',
        'name_a' => 'Ascendente por nombre',
        'name_d' => 'Descendente por nombre',
        'group_a' => 'Ascendente por grupo',
        'group_d' => 'Descendente por grupo',
        'reg_a' => 'Ascendente por fecha de alta',
        'reg_d' => 'Descendente por fecha de alta',
        'pic_a' => 'Ascendente por total de fotos',
        'pic_d' => 'Descendente por total de fotos',
        'disku_a' => 'Ascendente por uso de disco',
        'disku_d' => 'Descendente por uso de disco',
        'sort_by' => 'Ordenar usuarios por',
        'err_no_users' => '�La tabla de usuarios est� vac�a!',
        'err_edit_self' => 'No puedes editar tu propio perfil, usa la opci�n \'Mi perfil de usuario\' para eso',
        'edit' => 'EDITAR',
        'delete' => 'BORRAR',
        'name' => 'Nombre de usuario',
        'group' => 'Grupo',
        'inactive' => 'Inactivo',
        'operations' => 'Operaciones',
        'pictures' => 'Fotos',
        'disk_space' => 'Espacio usado / Cuota',
        'registered_on' => 'Registrado el d�a',
        'u_user_on_p_pages' => '%d usuarios en %d p�gina(s)',
        'confirm_del' => '�Est�s seguro de querer BORRAR este usuario? \\nTodas sus fotos y albums ser�n tambi�n borrados.',
        'mail' => 'MAIL',
        'err_unknown_user' => '�El usuario seleccionado no existe!',
        'modify_user' => 'Modificar usuario',
        'notes' => 'Notas',
        'note_list' => '<li>Si no quieres cambiar la contrase�a actual, deja el campo "contrase�a" vac�o',
        'password' => 'Contrase�a',
        'user_active' => 'El usuario est� activo',
        'user_group' => 'Grupo de usuarios',
        'user_email' => 'Email del usuario',
        'user_web_site' => 'P�gina web del usuario',
        'create_new_user' => 'Crear nuevo usuario',
        'user_from' => 'Localidad del usuario',
        'user_interests' => 'Intereses del usuario',
        'user_occ' => 'Ocupaci�n del usuario',
        );
// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //
if (defined('UTIL_PHP')) $lang_util_php = array('title' => 'Cambiar tama�o a las fotos',
        'what_it_does' => 'Qu� hace',
        'what_update_titles' => 'Actualiza los nombres de fichero',
        'what_delete_title' => 'Borra los t�tulos',
        'what_rebuild' => 'Vuelve a crear los thumbnails y otros tama�os de las fotos',
        'what_delete_originals' => 'Borra las fotos originales reemplaz�ndolas con versiones de nuevo tama�o',
        'file' => 'Fichero',
        'title_set_to' => 't�tulo a poner',
        'submit_form' => 'enviar',
        'updated_succesfully' => 'actualizado con �xito',
        'error_create' => 'ERROR al crear',
        'continue' => 'Procesar m�s im�gnes',
        'main_success' => 'El fichero %s ha sido usado como foto principal con �xito',
        'error_rename' => 'Error renombrando %s a %s',
        'error_not_found' => 'No se encuentra el fichero %s',
        'back' => 'volver al inicio',
        'thumbs_wait' => 'Actualizando thumbnails y/o tama�os de fotos, por favor espere...',
        'thumbs_continue_wait' => 'Continuando la actualizaci�n de thumbnails y/o tama�os de fotos...',
        'titles_wait' => 'Actualizando t�tulos, por favor espere...',
        'delete_wait' => 'Borrando t�tulos, por favor espere...',
        'replace_wait' => 'Borrando originales y reemplaz�ndolos con las fotos de nuevo tama�o, por favor espere...',
        'instruction' => 'Instrucciones r�pidas',
        'instruction_action' => 'Selecionar acci�n',
        'instruction_parameter' => 'Poner par�metros',
        'instruction_album' => 'Seleccionar album',
        'instruction_press' => 'Pulsar %s',
        'update' => 'Actualizar thumbs y/o tama�os de fotos',
        'update_what' => 'Qu� debe ser actualizado',
        'update_thumb' => 'Solo thumbnails',
        'update_pic' => 'Solo tama�os de fotos',
        'update_both' => 'Thumbnails y tama�os de fotos (ambos)',
        'update_number' => 'N�mero de im�genes procesadas por cada click',
        'update_option' => '(Prueba a poner un n�mero menor si experimentas problemas de timeout)',
        'filename_title' => 'Fichero &rArr; T�tulo de la foto',
        'filename_how' => 'C�mo debe ser el fichero modificado',
        'filename_remove' => 'Quitar .jpg del final y reemplazar _ (underscore) con espacios',
        'filename_euro' => 'Cambiar 2003_11_23_13_20_20.jpg a 23/11/2003 13:20',
        'filename_us' => 'Cambiar 2003_11_23_13_20_20.jpg a 11/23/2003 13:20',
        'filename_time' => 'Cambiar 2003_11_23_13_20_20.jpg a 13:20',
        'delete' => 'Borrar t�tulos de fotos o fotos de tama�o original',
        'delete_title' => 'Borrar t�tulos de fotos',
        'delete_original' => 'Borrar fotos de tama�o original',
        'delete_replace' => 'Borra las im�genes originales, reemplaz�ndolas con otras de tama�o nuevo',
        'select_album' => 'Selecciona album',
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