<?php
/****************************************************************************/
/* Coppermine Photo Gallery 1.2.3 for CMS                                   */
/****************************************************************************/
/****************************************************************************/
/* Port Copyright (C) 2004 Coppermine for CMS Dev Team  		              */
/* http://coppermine.findhere.org/                                          */
/****************************************************************************/
/* Updated by the Coppermine Dev Team  2003                                 */
/* (http://coppermine.sf.net/team/)                                         */
/* see /docs/credits.html for details                                       */
/****************************************************************************/
/* Copyright (C) 2002,2003  Gregory DEMAR <gdemar@wanadoo.fr>               */
/* http://www.chezgreg.net/coppermine/                                      */
/* This program is free software; you can redistribute it and/or modify     */
/* it under the terms of the GNU General Public License as published by     */
/* the Free Software Foundation; either version 2 of the License, or        */
/* (at your option) any later version.                                      */
/*****************************************************************************/
/*   $Id: lang-spanish-utf-8.php,v 1.5 2004/05/07 01:09:42 djmaze Exp $              */
/*****************************************************************************/
// lang_translation_info
define('LANG_NAME_ENGLISH', 'Spanish');
define('LANG_NAME_NATIVE', 'Espa&ntilde;ol');
define('LANG_COUNTRY_CODE', 'es');
define('TRANS_NAME', 'Daniel Villoldo (Grumpywolf)');
define('TRANS_EMAIL', 'dvp@arrakis.es');
define('TRANS_WEBSITE', 'http://grumpywolf.net/');
define('TRANS_DATE', '2003-10-03');
define('CHARSET', 'iso-8859-1');
define('TEXT_DIR', 'ltr');
define('YES', 'Si');
define('NO', 'No');
define('BACK', 'ATRAS');
define('CONTINUE', 'CONTINUAR');
define('INFO', 'InformaciÃ³n');
define('ERROR', 'Error');
define('ALBUM_DATE_FMT', '%d de %B de %Y');
define('LASTCOM_DATE_FMT', '%d/%m/%y a las %H:%M');
define('LASTUP_DATE_FMT', '%d de %B de %Y');
define('REGISTER_DATE_FMT', '%d de %B de %Y');
define('LASTHIT_DATE_FMT', '%d de %B de %Y a las %I:%M %p');
define('COMMENT_DATE_FMT', '%d de %B de %Y a las %I:%M %p');
$lang_day_of_week = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat',);
// Day of the month
$lang_month = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec',);
// For the word censor
$lang_bad_words = array('*fuck*','asshole','assramer','bitch*','c0ck','clits','Cock','cum','cunt*','dago','daygo','dego','dick*','dildo','fanculo','feces','foreskin','Fu\(*','fuk*','honkey','hore','injun','kike','lesbo','masturbat*','motherfucker','nazis','nigger*','nutsack','penis','phuck','poop','pussy','scrotum','shit','slut','titties','titty','twaty','wank*','whore','wop*',);
// lang_meta_album_names
define('RANDOM', 'Fotos al azar');
define('LASTUP', 'Ultimas fotos');
define('LASTUPBY', 'My Last Additions');
define('LASTALB', 'Ultimos albums modificados');
define('LASTCOM', 'Ãšltimos comentarios');
define('LASTCOMBY', 'My Last comments');
define('TOPN', 'MÃ¡s vistas');
define('TOPRATED', 'MÃ¡s valoradas');
define('LASTHITS', 'Ãšltimas vistas');
define('SEARCH', 'Resultado de la bÃºsqueda');
define('FAVPICS', 'Fotos favoritas');

// lang_errors
define('ACCESS_DENIED', 'No tienes permisos para acceder a esta pÃ¡gina.');
define('PERM_DENIED', 'No tienes permisos para realizar esta operaciÃ³n.');
define('PARAM_MISSING', 'Llamada a Script sin los parÃ¡metros requeridos.');
define('NON_EXIST_AP', 'Â¡El album/foto seleccionado no existe!');
define('QUOTA_EXCEEDED', 'Cuota de disco excedida<br /><br />Tienes una cuota de disco de [quota]K, tus fotos actualmente ocupan [space]K, y aÃ±adiendo esta foto excederÃ­as la cuota.');
define('GD_FILE_TYPE_ERR', 'Cuando se usa la librerÃ­a de imagen GD solamente estÃ¡n permitidos los tipos JPEG y PNG.');
define('INVALID_IMAGE', 'La imagen que has aÃ±adido estÃ¡ corrupta o no puede ser tratada por la librerÃ­a GD.');
define('RESIZE_FAILED', 'Incapaz de crear thumbnail o imagen de tamaÃ±o reducido.');
define('NO_IMG_TO_DISPLAY', 'Ninguna imagen que enseÃ±ar.');
define('NON_EXIST_CAT', 'La categorÃ­a seleccionada no existe.');
define('ORPHAN_CAT', 'Una categorÃ­a no tiene padre, ejecuta la utilidad de categorÃ­as para corregir el problema.');
define('DIRECTORY_RO', 'El directorio \'%s\' no tiene permisos de escritura, las fotos no pueden ser borradas.');
define('NON_EXIST_COMMENT', 'El comentario seleccionado no existe.');
define('PIC_IN_INVALID_ALBUM', 'Â¿Â¡La foto estÃ¡ en un album que no existe (%s)!?');
define('BANNED', 'Actualmente estÃ¡s expulsado respecto al uso de esta web.');
define('NOT_WITH_UDB', 'Esta funciÃ³n estÃ¡ desactivada en Coppermine porque estÃ¡ integrada con un software de foros. Lo que fuese que estÃ¡s intentando hacer no estÃ¡ soportado en esta configuraciÃ³n, o la funciÃ³n debe ser manejada por el software de foros.');
define('MEMBERS_ONLY', 'This function is for members only, please join.');
define('MUSTBE_GOD', 'This function is only for the site admin. You must be logged in as superadmin, god account to access this function');

// lang_main_menu
define('ALB_LIST_TITLE', 'Ir a la lista de albums');
define('ALB_LIST_LNK', 'Lista de Albums');
define('MY_GAL_TITLE', 'Ir a mi galerÃ­a personal');
define('MY_GAL_LNK', 'Mi galerÃ­a');
define('MY_PROF_LNK', 'Mi perfil de usuario');
define('MY_PROF_TITLE','Check your disk quota and groups');
define('ADM_MODE_TITLE', 'Ir a modo administrador');
define('ADM_MODE_LNK', 'Modo Admininstrador');
define('USR_MODE_TITLE', 'Ir a modo usuario');
define('USR_MODE_LNK', 'Modo Usuario');
define('UPLOAD_PIC_TITLE', 'Insertar foto en un album');
define('UPLOAD_PIC_LNK', 'Insertar foto');
define('REGISTER_TITLE', 'Crear un usuario');
define('REGISTER_LNK', 'Registrarse');
define('LOGIN_LNK', 'Login');
define('LOGOUT_LNK', 'Logout');
define('LASTUP_LNK', 'Ãšltimas fotos');
define('LASTUP_TITLE', 'Recently uploaded pictures');
define('LASTCOM_TITLE',  'Pictures in order of last commented on');
define('LASTCOM_LNK',  'Ãšltimos comentarios');
define('TOPN_TITLE', 'Pictures that have been seen most');
define('TOPN_LNK', 'MÃ¡s vistas');
define('TOPRATED_TITLE', 'Top rated pictures');
define('TOPRATED_LNK',  'MÃ¡s valoradas');
define('SEARCH_LNK', 'Buscar');
define('FAV_LNK', 'Mis Favoritos');
define('BAN_LNK', 'Ban usuarios');
define('HELP_LNK', "<img src=\"$CPG_M_DIR/images/help.gif\"  vspace=\"2\" height=\"20\" width=\"20\" align=\"middle\" alt=\"HELP\"  border=\"0\" />");

// lang_gallery_admin_menu

define('UPL_APP_LNK', 'Aprobar Uploads');
define('CONFIG_LNK', 'Configuracion');
define('ALBUMS_LNK', 'Albums');
define('CATEGORIES_LNK', 'CategorÃ­as');
define('USERS_LNK', 'Usuarios');
define('GROUPS_LNK', 'Grupos');
define('COMMENTS_LNK', 'Comentarios');
define('SEARCHNEW_LNK', 'A𠣩r Fotos  (Batch)');
define('UTIL_LNK', 'Cambiar tamaÃ±o de las fotos');
define('BAN_LNK', 'Expulsar a Usuarios');

// lang_user_admin_menu
define('ALBMGR_LNK', 'Crear / ordenar albums');
define('MODIFYALB_LNK', 'Modificar mis albums');
define('MY_PROF_LNK', 'Mi perfil de usuario');

// lang_cat_list
define('CATEGORY', 'CategorÃ­a');
define('ALBUMS', 'Albums');
define('PICTURES', 'Fotos');

// lang_album_list
define('ALBUM_ON_PAGE', '%d albums en %d pÃ¡gina(s)');

// lang_thumb_view
define('DATE', 'FECHA');
define('NAME', 'NOMBRE');
define('TITLE', 'TITULO');
define('SORT_DA', 'Ordenado por fecha ascendente');
define('SORT_DD', 'Ordenado por fecha descendente');
define('SORT_NA', 'Ordenado por nombre ascendente');
define('SORT_ND', 'Ordenado por nombre descendente');
define('SORT_TA', 'Ordenado por tÃ­tulo ascendente');
define('SORT_TD', 'Ordenado por tÃ­tulo descendente');
define('PIC_ON_PAGE', '%d fotos en %d pÃ¡gina(s)');
define('USER_ON_PAGE', '%d usuarios en %d pÃ¡gina(s)');
define('SORT_RA', 'Sort by rating ascending');
define('SORT_RD', 'Sort by rating descending');
define('RATING', 'RATING');
define('SORT_TITLE', 'Sort pictures by:');

// lang_img_nav_bar
define('THUMB_TITLE', 'Volver al Ã­ndice del album');
define('PIC_INFO_TITLE', 'Mostrar/ocultar informaciÃ³n de la foto');
define('SLIDESHOW_TITLE', 'Slideshow');
define('SLIDESHOW_DISABLED', 'e-cards are disabled');
define('SLIDESHOW_DISABLED_MSG', 'This function is for members only, please join.');
define('ECARD_TITLE', 'Enviar esta foto a un amigo');
define('ECARD_DISABLED', 'Envio de fotos deshabilitado');
define('ECARD_DISABLED_MSG', 'No tienes permisos para enviar fotos');
define('PREV_TITLE', 'Ver foto anterior');
define('NEXT_TITLE', 'Ver foto siguiente');
define('PIC_POS', 'FOTO %s/%s');
define('NO_MORE_IMAGES', 'There are no more images in this galley');
define('NO_LESS_IMAGES', 'This is the first image in the gallery');

// lang_rate_pic
define('RATE_THIS_PIC', 'Valorar esta foto ');
define('NO_VOTES', '(No hay votos)');
define('RATING', '(valoraciÃ³n actual : %s / 5 con %s votos)');
define('RUBBISH', 'Mala');
define('POOR', 'Regular');
define('FAIR', 'Normal');
define('GOOD', 'Buena');
define('EXCELLENT', 'Excelente');
define('GREAT', 'Genial');

// lang_cpg_die
define('INFORMATION', 'InformaciÃ³n');
define('ERROR', 'Error');
define('CRITICAL_ERROR', 'Error crÃ­tico');
define('FILE', 'Fichero: ');
define('LINE', 'Linea: ');

// lang_display_thumbnails
define('FILENAME', 'Fichero: ');
define('FILESIZE', 'TamaÃ±o: ');
define('DIMENSIONS', 'Dimensiones: ');
define('DATE_ADDED', 'Fecha de alta: ');

// lang_get_pic_data
define('N_COMMENTS', '%s comentarios');
define('N_VIEWS', '%s veces vista');
define('N_VOTES', '(%s votos)');

// lang_smilies_inc_php
define('EXCLAMATION', 'Exclamation');
define('QUESTION', 'Question');
define('VERY HAPPY', 'Very Happy');
define('SMILE', 'Smile');
define('SAD', 'Sad');
define('SURPRISED', 'Surprised');
define('SHOCKED', 'Shocked');
define('CONFUSED', 'Confused');
define('COOL', 'Cool');
define('LAUGHING', 'Laughing');
define('MAD', 'Mad');
define('RAZZ', 'Razz');
define('EMBARASSED', 'Embarassed');
define('CRYING OR VERY SAD', 'Crying or Very sad');
define('EVIL OR VERY MAD', 'Evil or Very Mad');
define('TWISTED EVIL', 'Twisted Evil');
define('ROLLING EYES', 'Rolling Eyes');
define('WINK', 'Wink');
define('IDEA', 'Idea');
define('ARROW', 'Arrow');
define('NEUTRAL', 'Neutral');
define('MR. GREEN', 'Mr. Green');

// lang_admin_php
define('LV_ADMIN', 'Saliendo de modo administrador...');
define('ENT_ADMIN', 'Entrando en modo administrador...');

// lang_albmgr_php
define('ALB_NEED_NAME', 'Â¡Los albums deben tener un nombre!');
define('CONFIRM_MODIFS', 'Â¿EstÃ¡s seguro de aplicar estas modificaciones?');
define('NO_CHANGE', 'Â¡No se hizo ningÃºn cambio!');
define('NEW_ALBUM', 'Nuevo album');
define('CONFIRM_DELETE1', 'Â¿EstÃ¡s seguro de querer borrar este album?');
define('CONFIRM_DELETE2', '\\nTodas las fotos y comentarios que contiene se perderÃ¡n!');
define('SELECT_FIRST', 'Selecciona un album primero');
define('ALB_MRG', 'Administrador de Albums');
define('MY_GALLERY', '* Mi galerÃ­a *');
define('NO_CATEGORY', '* Sin categorÃ­a *');
define('DELETE', 'Borrar');
define('NEW', 'Nuevo');
define('APPLY_MODIFS', 'Aplicar modificaciones');
define('SELECT_CATEGORY', 'Seleccionar categorÃ­a');

// lang_catmgr_php
define('MISS_PARAM', 'Â¡Los parÃ¡metros requeridos para la operaciÃ³n: \'%s\' no han sido suministrados!');
define('UNKNOWN_CAT', 'La categorÃ­a seleccionada no existe en la base da datos');
define('USERGAL_CAT_RO', 'Â¡Las categorÃ­as de galerÃ­as de usuario no pueden ser borradas!');
define('MANAGE_CAT', 'Organizador de categorÃ­as');
define('CONFIRM_DELETE', 'EstÃ¡s seguro de querer BORRAR esta catagorÃ­a');
define('CATEGORY', 'CategorÃ­a');
define('OPERATIONS', 'Operaciones');
define('MOVE_INTO', 'Mover hacia');
define('UPDATE_CREATE', 'Modificar/Crear categorÃ­a');
define('PARENT_CAT', 'CategorÃ­a padre');
define('CAT_TITLE', 'TÃ­tulo de la categorÃ­a');
define('CAT_DESC', 'DescripciÃ³n de la categorÃ­a');

// lang_config_php
define('TITLE', 'ConfiguraciÃ³n');
define('RESTORE_CFG', 'Restaurar valores por defecto');
define('SAVE_CFG', 'Guardar la nueva configuraciÃ³n');
define('NOTES', 'Notas');
define('INFO', 'InformaciÃ³n');
define('UPD_SUCCESS', 'La configuraciÃ³n de Coppermine ha sido actualizada');
define('RESTORE_SUCCESS', 'Valores por defecto de Coppermine restaurados');
define('NAME_A', 'Ascendente por nombre');
define('NAME_D', 'Descendente por nombre');
define('TITLE_A', 'Ascendente por tÃ­tulo');
define('TITLE_D', 'Descendente por tÃ­tulo');
define('DATE_A', 'Ascendente por fecha');
define('DATE_D', 'Descendente por fecha');
define('RATING_A', 'Rating ascending');
define('RATING_D', 'Rating descending');
define('TH_ANY', 'Max Aspect');
define('TH_HT', 'Height');
define('TH_WD', 'Width');

// lang_config_data
define('CONFIG_GENSET', 'ParÃ¡metros Generales');
define('GALLERY_NAME', 'Nombre de la galerÃ­a');
define('GALLERY_DESCRIPTION', 'DescripciÃ³n de la galerÃ­a');
define('GALLERY_ADMIN_EMAIL', 'Correo electrÃ³nico del administrador');
define('ECARDS_MORE_PIC_TARGET', 'Address to nuke folder ie http://www.mysite.tld/html/');
define('LANG', 'Lenguaje');
define('CPGTHEME', 'Tema (aspecto)');
define('NICE_TITLES', 'Page Specific Titles instead of >Coppermine');
define('RIGHT_BLOCKS', 'Show blocks on the right');
define('ALB_LIST_VIEW_TITLE', 'Aspecto de la lista de albums');
define('MAIN_TABLE_WIDTH', 'Anchura de la tabla principal (pixels o %)');
define('SUBCAT_LEVEL', 'NÃºmero de niveles de categorÃ­as a mostrar');
define('ALBUMS_PER_PAGE', 'NÃºmero de albums a mostrar');
define('ALBUM_LIST_COLS', 'NÃºmero de columnas en la lista de albums');
define('ALB_LIST_THUMB_SIZE', 'TamaÃ±o de los thumbnails en pixels');
define('MAIN_PAGE_LAYOUT', 'Contenido de la pÃ¡gina principal');
define('FIRST_LEVEL', 'Mostrar thumbnails de albums de primer nivel en categorÃ­as');
define('THUMB_VIEW_TITLE', 'Aspecto de la vista de Thumbnails');
define('THUMBCOLS', 'NÃºmero de columnas en la pÃ¡gina de thumbnails');
define('THUMBROWS', 'NÃºmero de filas en la pÃ¡gina de thumbnails');
define('MAX_TABS', 'MÃ¡ximo nÃºmero de tabs a mostrar');
define('CAPTION_IN_THUMBVIEW', 'Mostrar picture caption (ademÃ¡s del tÃ­tulo) debajo del thumbnail');
define('DISPLAY_COMMENT_COUNT', 'Mostrar el nÃºmero de comentarios debajo del thumbnail');
define('DEFAULT_SORT_ORDER', 'Orden por defecto de las fotos');
define('MIN_VOTES_FOR_RATING', 'Minimo nÃºmero de votos para que una foto aparezca el la lista de \'MÃ¡s Valoradas\' list');
define('SEO_ALTS', 'Alts and title tags of thumbnail show title and keyword instead of picinfo');
define('IMAGE_COMMENT_VIEW_TITLE', 'Vista de foto y ConfiguraciÃ³n de comentarios');
define('PICTURE_TABLE_WIDTH', 'Anchura de la tabla donde mostrar la foto (pixels o %)');
define('DISPLAY_PIC_INFO', 'InformaciÃ³n de la foto visible por defecto');
define('FILTER_BAD_WORDS', 'Filtrar palabras malsonantes en los comentarios');
define('ENABLE_SMILIES', 'Permitir Emoticons en los comentarios');
define('DISABLE_FLOOD_PROTECTION', 'Allow several consecutive comments on one pic from the same user');
define('COMMENT_EMAIL_NOTIFICATION', 'Email site admin upon comment submission');
define('MAX_IMG_DESC_LENGTH', 'MÃ¡xima longitud para la descripciÃ³n de una foto');
define('MAX_COM_WLENGTH', 'MÃ¡ximo nÃºmero de caracteres en una palabra');
define('MAX_COM_LINES', 'MÃ¡ximo nÃºmero de lineas en un comentario');
define('MAX_COM_SIZE', 'MÃ¡xima longitud de un comentario');
define('DISPLAY_FILM_STRIP', 'Mostrar tira de pelÃ­cula');
define('MAX_FILM_STRIP_ITEMS', 'NÃºmero de objetos en tira de pelÃ­cula');
define('ALLOW_ANON_FULLSIZE', 'Allow viewing of full size pic by anonymous');
define('KEEP_VOTES_TIME', 'Number of days between being able to vote on the same image');
define('PIC_THUMB_SETTING_TITLE', 'ConfiguraciÃ³n de las fotos y thumbnails');
define('JPEG_QUAL', 'Calidad para los ficheros JPEG');
define('THUMB_WIDTH', 'MÃ¡xima anchura o altura de los thumbnail <strong>*</strong>');
define('THUMB_USE', 'Usar dimensiÃ³n ( anchura o altura o MÃ¡ximo para los thumbnail )<strong>*</strong>');
define('MAKE_INTERMEDIATE', 'Crear fotos de tamaÃ±o intermedio');
define('PICTURE_WIDTH', 'MÃ¡xima anchura o altura de las fotos de tamaÃ±o intermedio <strong>*</strong>');
define('MAX_UPL_SIZE', 'MÃ¡ximo tamaÃ±o de los fotos de usuarios por upload (KB)');
define('MAX_UPL_WIDTH_HEIGHT', 'MÃ¡xima anchura o altura de las fotos de usuarios por upload (pixels)');
define('USER_SETTING_TITLE', 'ConfiguraciÃ³n de usuarios');
define('ALLOW_USER_REGISTRATION', 'Permitir el registro de nuevos usuarios');
define('REG_REQUIRES_VALID_EMAIL', 'Registro de usuarios requiere verificaciÃ³n de email');
define('ALLOW_DUPLICATE_EMAILS_ADDR', 'Permitir a dos usuarios tener el mismo email');
define('ALLOW_PRIVATE_ALBUMS', 'Los usuarios pueden tener albums privados');
define('CUSTOM_FIELDS_TITLE', 'Campos extra para descripciÃ³n de fotos (dejar en blanco si no los usas)');
define('USER_FIELD1_NAME', 'Nombre del campo 1');
define('USER_FIELD2_NAME', 'Nombre del campo 2');
define('USER_FIELD3_NAME', 'Nombre del campo 3');
define('USER_FIELD4_NAME', 'Nombre del campo 4');
define('PIC_ADV_SETTING_TITLE', 'ConfiguraciÃ³n avanzada de fotos y thumbnails');
define('SHOW_PRIVATE', 'Mostrar icono de album privado a usuarios no registrados');
define('FORBIDEN_FNAME_CHAR', 'Caracteres prohibidos en los nombres de las fotos');
define('ALLOWED_FILE_EXTENSIONS', 'Extensiones de fichero admitidos en los uploads');
define('THUMB_METHOD', 'MÃ©todo para el reescalado de fotos');
define('IMPATH', 'Path de la utilidad ImageMagick/Netpbm (por ejemplo /usr/bin/X11/)');
define('ALLOWED_IMG_TYPES', 'Tipos de ficheros admitidos (solo vÃ¡lidos con ImageMagick)');
define('IM_OPTIONS', 'Comandos de linea para ImageMagick');
define('READ_EXIF_DATA', 'Leer datos EXIF en ficheros de tipo JPEG');
define('READ_IPTC_DATA', 'Read IPTC data in JPEG files');
define('FULLPATH', 'Directorio base de los albums <strong>*</strong>');
define('USERPICS', 'Dierctorio para las fotos subidas por los usuarios <strong>*</strong>');
define('NORMAL_PFX', 'Prefijo para las fotos de tamaÃ±o intermedio <strong>*</strong>');
define('THUMB_PFX', 'Prefijo para los thumbnails <strong>*</strong>');
define('DEFAULT_DIR_MODE', 'Modo por defecto de los directorios');
define('DEFAULT_FILE_MODE', 'Modo por defecto para las fotos');
define('PICINFO_DISPLAY_FILENAME', 'Picinfo display filename');
define('PICINFO_DISPLAY_ALBUM_NAME', 'Picinfo display album name');
define('PICINFO_DISPLAY_FILE_SIZE', 'Picinfo display_file_size');
define('PICINFO_DISPLAY_DIMENSIONS', 'Picinfo display_dimensions');
define('PICINFO_DISPLAY_COUNT_DISPLAYED', 'Picinfo display_count_displayed');
define('PICINFO_DISPLAY_URL', 'Picinfo display_URL');
define('PICINFO_DISPLAY_URL_BOOKMARK', 'Picinfo display URL as bookmark link');
define('PICINFO_DISPLAY_FAVORITES', 'Picinfo display fav album link');
define('COOKIE_SETTING_TITLE', 'ConfiguraciÃ³n de cookies y Juego de Caracteres');
define('COOKIE_NAME', 'Nombre de la cookie usada por el script');
define('COOKIE_PATH', 'Path de la cookie usada por el script');
define('CHARSET', 'Juego de caracteres');
define('MISC_SETTING_TITLE', 'Configuraciones de otros aspectos');
define('DEBUG_MODE', 'Activar modo debug');
define('ADVANCED_DEBUG_MODE', 'Enable advanced debug mode');
define('SHOWUPDATE', 'Show Coppermine Update Alert to Admin');
define('NOCHANGE_FOOTER_TITLE', '<br /><div align="center">(*) Los campos marcados con * no deben ser cambiados si ya se tienen fotos en las galerÃ­as</div><br />');

// lang_db_input_php
define('EMPTY_NAME_OR_COM', 'Debes introducir tu nombre y un comentario');
define('COM_ADDED', 'Comentario aÃ±adido');
define('ALB_NEED_TITLE', 'Â¡Debes de introducir un tÃ­tulo para el album!');
define('NO_UDP_NEEDED', 'No se requiere ningÃºn cambio');
define('ALB_UPDATED', 'Album actualizado');
define('UNKNOWN_ALBUM', 'El album seleccionado no existe o no tienes permisos para aÃ±adir fotos en este album');
define('NO_PIC_UPLOADED', 'Â¡Ninguna foto fue aÃ±adida!<br /><br />Si habÃ­as seleccionado una foto para aÃ±adir, comprueba que el servidor admite subir ficheros...');
define('ERR_MKDIR', 'Â¡Fallo al crear el directorio %s!');
define('DEST_DIR_RO', 'Â¡El directorio destino %s no tiene permisos de escritura!');
define('ERR_MOVE', 'Â¡Imposible mover %s a %s !');
define('ERR_FSIZE_TOO_LARGE', 'El tamaÃ±o de la foto que quieres insertar es demasiago grande (el mÃ¡ximo permitido es de %s x %s)');
define('ERR_IMGSIZE_TOO_LARGE', 'El tamaÃ±o del fichero de la foto que quieres insertar es demasiado grande (el mÃ¡ximo permitido es de %s KB)');
define('ERR_INVALID_IMG', 'El fichero que quieres insertar no es una imagen vÃ¡lida');
define('ALLOWED_IMG_TYPES', 'Puedes insertar solamente %s fotos.');
define('ERR_INSERT_PIC', 'La foto \'%s\' no puede ser dada de alta en el album ');
define('UPLOAD_SUCCESS', 'La foto ha sido insertada correctamente<br /><br />SerÃ¡ visible tras la aprobaciÃ³n de los administradores.');
define('INFO', 'InformaciÃ³n');
define('ERR_COMMENT_EMPTY', 'Â¡El comentario estÃ¡ vacio!');
define('ERR_INVALID_FEXT', 'Solamente estÃ¡n admitidas fotos con las siguientes extensiones : <br /><br />%s.');
define('NO_FLOOD', 'Perdona pero eres el autor/a del Ãºltimo comentario introducido para esta foto<br /><br />Puedes editar el comentario que has puesto si es que quieres modificarlo');
define('REDIRECT_MSG', 'EstÃ¡s siendo redirigido.<br /><br /><br />Pulsa \'CONTINUAR\' si la pÃ¡gina no se refresca automÃ¡ticamente');
define('UPL_SUCCESS', 'La foto se ha aÃ±adido correctamente');

// lang_delete_php
define('CAPTION', 'Caption');
define('FS_PIC', 'imagen tamaÃ±o completo');
define('DEL_SUCCESS', 'borrado correctamente');
define('NS_PIC', 'imagen tamaÃ±o normal');
define('ERR_DEL', 'no puede ser borrado');
define('THUMB_PIC', 'thumbnail');
define('COMMENT', 'comentario');
define('IM_IN_ALB', 'fotos en el album');
define('ALB_DEL_SUCCESS', 'Album \'%s\' borrado');
define('ALB_MGR', 'Organizador de albums');
define('ERR_INVALID_DATA', 'Datos invÃ¡lidos recibidos en \'%s\'');
define('CREATE_ALB', 'Creando el album \'%s\'');
define('UPDATE_ALB', 'Actualizando album \'%s\' con el tÃ­tulo \'%s\' y el Ã­ndice \'%s\'');
define('DEL_PIC', 'Borrar foto');
define('DEL_ALB', 'Borrar album');
define('DEL_USER', 'Borrar usuario');
define('ERR_UNKNOWN_USER', 'Â¡El usuario seleccionado no existe!');
define('COMMENT_DELETED', 'El comentario ha sido borrado');

// lang_display_image_php
define('CONFIRM_DEL', 'Â¿EstÃ¡s seguro de querer BORRAR esta foto? \\nLos comentarios serÃ¡n tambiÃ©n borrados.');
define('DEL_PIC', 'BORRAR ESTA FOTO');
define('SIZE', '%s x %s pixels');
define('VIEWS', '%s veces');
define('SLIDESHOW', 'Slideshow');
define('STOP_SLIDESHOW', 'DETENER SLIDESHOW');
define('VIEW_FS', 'Pulsa aqui para ver la imagen a tamaÃ±o completo');
define('EDIT_PIC', 'EDIT PICTURE INFO');

// lang_picinfo
define('TITLE', 'InformaciÃ³n de la foto');
define('FILENAME', 'Nombre del fichero');
define('ALBUM NAME', 'Nombre del album');
define('RATING', 'ValoraciÃ³n (%s votos)');
define('KEYWORDS', 'Palabras clave');
define('FILE SIZE', 'TamaÃ±o del fichero');
define('DIMENSIONS', 'Dimensiones');
define('DISPLAYED', 'Se ha visto');
define('CAMERA', 'CÃ¡mara');
define('DATE TAKEN', 'Fecha de la foto');
define('APERTURE', 'Apertura');
define('EXPOSURE TIME', 'Tiempo de exposiciÃ³n');
define('FOCAL LENGTH', 'Longitud del foco');
define('COMMENT', 'Comentario');
define('ADDFAV', 'AÃ±adir a Favoritos');
define('ADDFAVPHRASE', 'Favoritos');
define('REMFAV', 'Quitar de Favoritos');
define('IPTCTITLE', 'IPTC Title');
define('IPTCCOPYRIGHT', 'IPTC Copyright');
define('IPTCKEYWORDS', 'IPTC Keywords');
define('IPTCCATEGORY', 'IPTC Category');
define('IPTCSUBCATEGORIES', 'IPTC Sub Categories');
define('BOOKMARK_PAGE', 'Bookmark Image');

// lang_display_comments
define('OK', 'OK');
define('EDIT_TITLE', 'Editar el comentario');
define('CONFIRM_DELETE', 'Â¿EstÃ¡s seguro de querer borrar el comentario?');
define('ADD_YOUR_COMMENT', 'AÃ±adir un comentario');
define('NAME', 'Nombre');
define('COMMENT', 'Comentario');
define('YOUR_NAME', 'AnÃ³nimo');

// lang_fullsize_popup
define('CLICK_TO_CLOSE', 'Pulsa en la imagen para cerrar esta ventana');

// lang_ecard_php
define('TITLE', 'Enviar foto a un amigo');
define('INVALID_EMAIL', '<strong>AtenciÃ³n</strong> : Â¡direcciÃ³n e-mail incorrecta!');
define('ECARD_TITLE', 'Una foto de %s para ti');
define('VIEW_ECARD', 'Si la foto no se ve correctamente, pulsa en este link');
define('VIEW_MORE_PICS', 'Â¡Pulsa aqui para ver mÃ¡s fotos!');
define('SEND_SUCCESS', 'La foto ha sido enviada');
define('SEND_FAILED', 'Disculpa, pero el servidor no puede enviar la foto...');
define('FROM', 'De');
define('YOUR_NAME', 'Tu nombre');
define('YOUR_EMAIL', 'Tu direcciÃ³n de e-mail');
define('TO', 'A');
define('RCPT_NAME', 'Nombre de tu amigo');
define('RCPT_EMAIL', 'DirecciÃ³n e-mail de tu amigo');
define('GREETINGS', 'TÃ­tulo del mensaje');
define('MESSAGE', 'Mensaje');

// lang_editpics_php
define('PIC_INFO', 'InformaciÃ³n');
define('ALBUM', 'Album');
define('TITLE', 'TÃ­tulo');
define('DESC', 'DescripciÃ³n');
define('KEYWORDS', 'Keywords');
define('PIC_INFO_STR', '%sx%s - %sKB - %s veces vista - %s votos');
define('APPROVE', 'Aprobar la foto');
define('POSTPONE_APP', 'Postponer aprobado de foto');
define('DEL_PIC', 'Borrar foto');
define('RESET_VIEW_COUNT', 'Poner a cero el contador de veces que se ha visto');
define('RESET_VOTES', 'Poner a cero los votos');
define('DEL_COMM', 'Borrar comentarios');
define('UPL_APPROVAL', 'Aprobar uploads');
define('EDIT_PICS', 'Editar fotos');
define('SEE_NEXT', 'Ir a las siguientes fotos');
define('SEE_PREV', 'If a las fotos anteriores');
define('N_PIC', '%s foto/s');
define('N_OF_PIC_TO_DISP', 'NÃºmero de fotos a mostrar');
define('APPLY', 'Validar los cambios');

// lang_groupmgr_php
define('GROUP_NAME', 'Nombre del grupo');
define('DISK_QUOTA', 'Cuota de disco');
define('CAN_RATE', 'Pueden valorar fotos');
define('CAN_SEND_ECARDS', 'Pueden enviar ecards');
define('CAN_POST_COM', 'Pueden aÃ±adir comentarios');
define('CAN_UPLOAD', 'Pueden aÃ±adir fotos');
define('CAN_HAVE_GALLERY', 'Pueden tener galerÃ­as personales');
define('APPLY', 'Validar los cambios');
define('CREATE_NEW_GROUP', 'Crear nuevo grupo');
define('DEL_GROUPS', 'Borrar el/los grupo(s) seleccionados');
define('CONFIRM_DEL', 'Â¡AtenciÃ³n, cuando borras un grupo, los usuarios que pertenecen a ese grupo serÃ¡n transferidos al grupo \'Registered\'!\\n\\nÂ¿Deseas continuar?');
define('TITLE', 'Configurar grupos de usuarios');
define('APPROVAL_1', 'AprobaciÃ³n album pÃºblico (1)');
define('APPROVAL_2', 'AprobaciÃ³n album privado (2)');
define('NOTE1', '<strong>(1)</strong> AÃ±adir fotos en un album pÃºblico requerirÃ¡ aprobaciÃ³n de los administradores');
define('NOTE2', '<strong>(2)</strong> AÃ±adir fotos en un album que pertenece al asuario requerirÃ¡ aprobaciÃ³n de los administradores');
define('NOTES', 'Notas');

// lang_index_php
define('WELCOME', 'Â¡Bienvenido!');

// lang_album_admin_menu
define('CONFIRM_DELETE', 'Â¿EstÃ¡s seguro de querer BORRAR este album ? \\nTodas las fotos y comentarios serÃ¡n tambiÃ©n borrados.');
define('DELETE', 'BORRAR');
define('MODIFY', 'MODIFICAR');
define('EDIT_PICS', 'EDITAR FOTOS');

// lang_list_categories
define('HOME', 'Home');
define('STAT1', '<strong>[pictures]</strong> fotos en <strong>[albums]</strong> albums y <strong>[cat]</strong> categorÃ­as con <strong>[comments]</strong> comentarios, vistas <strong>[views]</strong> veces');
define('STAT2', '<strong>[pictures]</strong> fotos en <strong>[albums]</strong> albums, vistas <strong>[views]</strong> veces');
define('XX_S_GALLERY', 'GalerÃ­a de %s');
define('STAT3', '<strong>[pictures]</strong> fotos en <strong>[albums]</strong> albums con <strong>[comments]</strong> comentarios, vistas <strong>[views]</strong> veces');

// lang_list_users
define('USER_LIST', 'Lista de usuarios');
define('NO_USER_GAL', 'No existen usuarios con permisos para tener albums');
define('N_ALBUMS', '%s album(s)');
define('N_PICS', '%s foto(s)');

// lang_list_albums
define('N_PICTURES', '%s fotos');
define('LAST_ADDED', ', Ãºltima aÃ±adida el %s');

// lang_modifyalb_php
define('UPD_ALB_N', 'Modificar album %s');
define('GENERAL_SETTINGS', 'ConfiguraciÃ³n general');
define('ALB_TITLE', 'TÃ­tulo del album');
define('ALB_CAT', 'CategorÃ­a del album');
define('ALB_DESC', 'DescripciÃ³n del album');
define('ALB_THUMB', 'Thumbnail del album');
define('ALB_PERM', 'Permisos para este album');
define('CAN_VIEW', 'Este album puede ser visto por');
define('CAN_UPLOAD', 'Los visitantes pueden aÃ±adir fotos');
define('CAN_POST_COMMENTS', 'Los visitantes pueden aÃ±adir comentarios');
define('CAN_RATE', 'Los visitantes pueden valorar las fotos');
define('USER_GAL', 'GalerÃ­a de usuario');
define('NO_CAT', '* Sin categorÃ­a *');
define('ALB_EMPTY', 'El album estÃ¡ vacÃ­o');
define('LAST_UPLOADED', 'Ultima foto aÃ±adida');
define('PUBLIC_ALB', 'Todo el mundo (album pÃºblico)');
define('ME_ONLY', 'Solamente yo');
define('OWNER_ONLY', 'Solamente el dueÃ±o del album (%s)');
define('GROUPP_ONLY', 'Miembros del grupo \'%s\'');
define('ERR_NO_ALB_TO_MODIFY', 'No puedes modificar ningÃºn album en la base de datos.');
define('UPDATE', 'Modificar album');

// lang_rate_pic_php
define('ALREADY_RATED', 'Perdona pero ya has votado anteriormente a esta foto');
define('RATE_OK', 'Tu voto ha sido contabilizado');

// lang_register_disclamer
define('REGISTER_DISCLAMER', 'A pesar de que los administradores de {SITE_NAME} intentarÃ¡n eliminar o editar cualquier material desagradable tan pronto como puedan, resulta imposible revisar todos los envÃ­os que se realizan. Por lo tanto debes tener en cuenta que todos los envÃ­os hechos hacia esta web expresan el punto de vista y opiniones de sus autores y no los de los administradores o webmasters (excepto los aÃ±adidos por ellos mismos).<br />
<br />
Usted acuerda no aÃ±adir ningÃºn material abusivo, obsceno, vulgar, escandaloso, odioso, amenazador, de orientaciÃ³n sexual, o ningÃºn otro que pueda violar cualquier ley aplicable. Usted estÃ¡ de acuerdo con que el webmaster, el administrador y los asesores de { SITE_NAME } tienen el derecho de quitar o de corregir cualquier contenido en cualquier momento si lo consideran necesario. Como usuario, accede a que cualquier informaciÃ³n aÃ±adida serÃ¡ almacenada en una base de datos. Asi mismo, esta informaciÃ³n no serÃ¡ divulgada a terceros sin su consentimiento. El webmaster y el administrador no se pueden hacer responsables de ningÃºn intento de destrucciÃ³n de la base de datos que pueda conducir a la pÃ©rdida de la misma.<br />
<br />
Este sitio utiliza cookies para almacenar la informaciÃ³n en su ordenador. Estas cookies sirven para mejorar la navegaciÃ³n en este sitio. La direcciÃ³n de email se utiliza solamente para confirmar sus detalles y contraseÃ±a del registro.<br />
<br />
Pulsando \'estoy de acuerdo\' expresas tu conformidad con estas condiciones.');

// lang_register_php
define('PAGE_TITLE', 'Registro de nuevo usuario');
define('TERM_COND', 'TÃ©rminos y condiciones');
define('I_AGREE', 'Estoy de acuerdo');
define('SUBMIT', 'Enviar solicitud de registro');
define('ERR_USER_EXISTS', 'El nombre de usuario elegido ya existe, por favor elige otro diferente');
define('ERR_PASSWORD_MISMATCH', 'Las dos contraseÃ±as no son iguales, por favor vuelve a introducirlas');
define('ERR_UNAME_SHORT', 'El nombre de usuario debe ser de 2 caracteres de longitud como mÃ­nimo');
define('ERR_PASSWORD_SHORT', 'La contraseÃ±a debe ser de 2 caracteres de longitud como mÃ­nimo');
define('ERR_UNAME_PASS_DIFF', 'El nombre de usuario y la contraseÃ±a deben ser diferentes');
define('ERR_INVALID_EMAIL', 'La direcciÃ³n de email no es vÃ¡lida');
define('ERR_DUPLICATE_EMAIL', 'Otro usuario se ha registrado anteriormente con la direcciÃ³n de email suministrada');
define('ENTER_INFO', 'Introduce la informaciÃ³n de registro');
define('REQUIRED_INFO', 'InformaciÃ³n requerida');
define('OPTIONAL_INFO', 'InformaciÃ³n opcional');
define('USERNAME', 'Nombre de usuario');
define('PASSWORD', 'ContraseÃ±a');
define('PASSWORD_AGAIN', 'Reescribir contraseÃ±a');
define('EMAIL', 'Email');
define('LOCATION', 'Localidad');
define('INTERESTS', 'Intereses');
define('WEBSITE', 'PÃ¡gina web');
define('OCCUPATION', 'OcupaciÃ³n');
define('ERROR', 'ERROR');
define('CONFIRM_EMAIL_SUBJECT', '%s - ConfirmaciÃ³n de registro');
define('INFORMATION', 'InformaciÃ³n');
define('FAILED_SENDING_EMAIL', 'Â¡El email de confirmaciÃ³n de registro no ha podido ser enviado!');
define('THANK_YOU', 'Gracias por registrarte.<br /><br />Hemos enviado un email con informaciÃ³n sobre la activaciÃ³n de tu cuenta a la direcciÃ³n de email que nos has facilitado.');
define('ACCT_CREATED', 'Tu cuenta de usuario ha sido creada y ahora puedes acceder al sistema con tu nombre de usuario y contraseÃ±a');
define('ACCT_ACTIVE', 'Tu cuenta de usuario estÃ¡ ya activa y ahora puedes acceder al sistema con tu nombre de usuario y contraseÃ±a');
define('ACCT_ALREADY_ACT', 'Â¡Tu cuenta ya estaba activa!');
define('ACCT_ACT_FAILED', 'Â¡Esta cuenta no puede ser activada!');
define('ERR_UNK_USER', 'Â¡El usuario seleccionado no existe!');
define('X_S_PROFILE', 'Perfil de %s');
define('GROUP', 'Grupo');
define('REG_DATE', 'Fecha de alta');
define('DISK_USAGE', 'Uso de disco');
define('CHANGE_PASS', 'Cambiar mi contraseÃ±a');
define('CURRENT_PASS', 'ContraseÃ±a actual');
define('NEW_PASS', 'Nueva contraseÃ±a');
define('NEW_PASS_AGAIN', 'Reescribir nueva contraseÃ±a');
define('ERR_CURR_PASS', 'La contraseÃ±a actual es incorrecta');
define('APPLY_MODIF', 'Guardar los cambios');
define('UPDATE_SUCCESS', 'Tu perfil ha sido actualizado');
define('PASS_CHG_SUCCESS', 'Tu contraseÃ±a ha sido cambiada');
define('PASS_CHG_ERROR', 'Tu contraseÃ±a no ha sido cambiada');

// lang_register_confirm_email
define('REGISTER_CONFIRM_EMAIL', 'Gracias por registrarte en {SITE_NAME}

Tu nombre de usuario es: "{USER_NAME}"
Tu contraseÃ±a es: "{PASSWORD}"

Para terminar de activar tu cuenta, debes pulsar sobre el enlace que
aparece debajo o copiarlo y pegarlo en tu navegador de InterNet.

{ACT_LINK}

Saludos.

Los administradores de {SITE_NAME}
');

// lang_reviewcom_php
define('TITLE', 'Revisar comentarios');
define('NO_COMMENT', 'No existen comentarios que mostrar');
define('N_COMM_DEL', '%s comentario(s) borrado(s)');
define('N_COMM_DISP', 'NÃºmero de comentarios a mostrar');
define('SEE_PREV', 'Ver el anterior');
define('SEE_NEXT', 'Ver el siguiente');
define('DEL_COMM', 'Borrar comentarios seleccionados');

// lang_search_php
define('SEARCH', 'Buscar entre todas las fotos');

// lang_search_new_php
define('PAGE_TITLE', 'Buscar nuevas fotos');
define('SELECT_DIR', 'Selecciona directorio');
define('SELECT_DIR_MSG', 'Esta funciÃ³n te permite aÃ±adir de forma automÃ¡tica las fotos que hayas subido a tu servidor mediante FTP.<br /><br />Selecciona el directorio donde has subido tus fotos');
define('NO_PIC_TO_ADD', 'No hay ninguna foto para aÃ±adir');
define('NEED_ONE_ALBUM', 'Necesitas al menos un album para utilizar esta funciÃ³n');
define('WARNING', 'AtenciÃ³n');
define('CHANGE_PERM', 'Â¡El script no puede escribir en este directorio, necesitas cambiar sus permisos a modo 755 o 777 antes de intentarlo de nuevo!');
define('TARGET_ALBUM', '<strong>Colocar las fotos del dierctorio &quot;</strong>%s<strong>&quot; en el album </strong>%s');
define('FOLDER', 'Carpeta');
define('IMAGE', 'Foto');
define('ALBUM', 'Album');
define('RESULT', 'Resultado');
define('DIR_RO', 'No se puede escribir. ');
define('DIR_CANT_READ', 'No se puede leer. ');
define('INSERT', 'AÃ±adiendo nuevas fotos a la galerÃ­a');
define('LIST_NEW_PIC', 'Listado de nuevas fotos');
define('INSERT_SELECTED', 'AÃ±adir las fotos seleccionadas');
define('NO_PIC_FOUND', 'No se encontrÃ³ ninguna foto nueva');
define('BE_PATIENT', 'Por favor, se paciente, el script necesita tiempo para aÃ±adir las fotos');
define('NOTES', '<ul><li><strong>OK</strong> : significa que la foto fue aÃ±adida sin problemas<li><strong>DP</strong> : significa que la foto es un duplicado y ya existe en la base de datos<li><strong>PB</strong> : significa que la foto no puede ser aÃ±adida, por favor comprueba la configaraciÃ³n y los permisos de los directorios donde estÃ¡n las fotos<li>Si los iconos OK, DP, PB no aparecen, pulsa sobre el icono de imagen no cargada para ver el error producido por PHP<li>Si el navegador produce un timeout, pulsa el icono de Actualizar</ul>');
define('SELECT_ALBUM', 'Select album');
define('NO_ALBUM', 'No album name was selected, click back and select an album to put your pictures in');

// lang_upload_php
define('TITLE', 'Insertar nueva foto');
define('MAX_FSIZE', 'El tamaÃ±o mÃ¡ximo de fichero admitido es de %s KB');
define('ALBUM', 'Album');
define('PICTURE', 'Foto');
define('PIC_TITLE', 'TÃ­tulo de la foto');
define('DESCRIPTION', 'DescripciÃ³n de la foto');
define('KEYWORDS', 'Palabras clave (separadas por espacios)');
define('ERR_NO_ALB_UPLOADABLES', 'Perdona pero no hay ningÃºn album donde estÃ© permitido insertar nuevas fotos');

// lang_usermgr_php
define('TITLE', 'Administrar usuarios');
define('NAME_A', 'Ascendente por nombre');
define('NAME_D', 'Descendente por nombre');
define('GROUP_A', 'Ascendente por grupo');
define('GROUP_D', 'Descendente por grupo');
define('REG_A', 'Ascendente por fecha de alta');
define('REG_D', 'Descendente por fecha de alta');
define('PIC_A', 'Ascendente por total de fotos');
define('PIC_D', 'Descendente por total de fotos');
define('DISKU_A', 'Ascendente por uso de disco');
define('DISKU_D', 'Descendente por uso de disco');
define('SORT_BY', 'Ordenar usuarios por');
define('ERR_NO_USERS', 'Â¡La tabla de usuarios estÃ¡ vacÃ­a!');
define('ERR_EDIT_SELF', 'No puedes editar tu propio perfil, usa la opciÃ³n \'Mi perfil de usuario\' para eso');
define('EDIT', 'EDITAR');
define('DELETE', 'BORRAR');
define('NAME', 'Nombre de usuario');
define('GROUP', 'Grupo');
define('INACTIVE', 'Inactivo');
define('OPERATIONS', 'Operaciones');
define('PICTURES', 'Fotos');
define('DISK_SPACE', 'Espacio usado / Cuota');
define('REGISTERED_ON', 'Registrado el dÃ­a');
define('U_USER_ON_P_PAGES', '%d usuarios en %d pÃ¡gina(s)');
define('CONFIRM_DEL', 'Â¿EstÃ¡s seguro de querer BORRAR este usuario? \\nTodas sus fotos y albums serÃ¡n tambiÃ©n borrados.');
define('MAIL', 'MAIL');
define('ERR_UNKNOWN_USER', 'Â¡El usuario seleccionado no existe!');
define('MODIFY_USER', 'Modificar usuario');
define('NOTES', 'Notas');
define('NOTE_LIST', '<li>Si no quieres cambiar la contraseÃ±a actual, deja el campo \"contraseÃ±a\" vacÃ­o');
define('PASSWORD', 'ContraseÃ±a');
define('USER_ACTIVE', 'El usuario estÃ¡ activo');
define('USER_GROUP', 'Grupo de usuarios');
define('USER_EMAIL', 'Email del usuario');
define('USER_WEB_SITE', 'PÃ¡gina web del usuario');
define('CREATE_NEW_USER', 'Crear nuevo usuario');
define('USER_FROM', 'Localidad del usuario');
define('USER_INTERESTS', 'Intereses del usuario');
define('USER_OCC', 'OcupaciÃ³n del usuario');

// lang_util_php
define('TITLE', 'Cambiar tamaÃ±o a las fotos');
define('WHAT_IT_DOES', 'QuÃ© hace');
define('WHAT_UPDATE_TITLES', 'Actualiza los nombres de fichero');
define('WHAT_DELETE_TITLE', 'Borra los tÃ­tulos');
define('WHAT_REBUILD', 'Vuelve a crear los thumbnails y otros tamaÃ±os de las fotos');
define('WHAT_DELETE_ORIGINALS', 'Borra las fotos originales reemplazÃ¡ndolas con versiones de nuevo tamaÃ±o');
define('FILE', 'Fichero');
define('TITLE_SET_TO', 'tÃ­tulo a poner');
define('SUBMIT_FORM', 'enviar');
define('UPDATED_SUCCESFULLY', 'actualizado con Ã©xito');
define('ERROR_CREATE', 'ERROR al crear');
define('CONTINUE', 'Procesar mÃ¡s imÃ¡gnes');
define('MAIN_SUCCESS', 'El fichero %s ha sido usado como foto principal con Ã©xito');
define('ERROR_RENAME', 'Error renombrando %s a %s');
define('ERROR_NOT_FOUND', 'No se encuentra el fichero %s');
define('BACK', 'volver al inicio');
define('THUMBS_WAIT', 'Actualizando thumbnails y/o tamaÃ±os de fotos, por favor espere...');
define('THUMBS_CONTINUE_WAIT', 'Continuando la actualizaciÃ³n de thumbnails y/o tamaÃ±os de fotos...');
define('TITLES_WAIT', 'Actualizando tÃ­tulos, por favor espere...');
define('DELETE_WAIT', 'Borrando tÃ­tulos, por favor espere...');
define('REPLACE_WAIT', 'Borrando originales y reemplazÃ¡ndolos con las fotos de nuevo tamaÃ±o, por favor espere...');
define('INSTRUCTION', 'Instrucciones rÃ¡pidas');
define('INSTRUCTION_ACTION', 'Selecionar acciÃ³n');
define('INSTRUCTION_PARAMETER', 'Poner parÃ¡metros');
define('INSTRUCTION_ALBUM', 'Seleccionar album');
define('INSTRUCTION_PRESS', 'Pulsar %s');
define('UPDATE', 'Actualizar thumbs y/o tamaÃ±os de fotos');
define('UPDATE_WHAT', 'QuÃ© debe ser actualizado');
define('UPDATE_THUMB', 'Solo thumbnails');
define('UPDATE_PIC', 'Solo tamaÃ±os de fotos');
define('UPDATE_BOTH', 'Thumbnails y tamaÃ±os de fotos (ambos)');
define('UPDATE_NUMBER', 'NÃºmero de imÃ¡genes procesadas por cada click');
define('UPDATE_OPTION', '(Prueba a poner un nÃºmero menor si experimentas problemas de timeout)');
define('FILENAME_TITLE', 'Fichero &rArr; TÃ­tulo de la foto');
define('FILENAME_HOW', 'CÃ³mo debe ser el fichero modificado');
define('FILENAME_REMOVE', 'Quitar .jpg del final y reemplazar _ (underscore) con espacios');
define('FILENAME_EURO', 'Cambiar 2003_11_23_13_20_20.jpg a 23/11/2003 13:20');
define('FILENAME_US', 'Cambiar 2003_11_23_13_20_20.jpg a 11/23/2003 13:20');
define('FILENAME_TIME', 'Cambiar 2003_11_23_13_20_20.jpg a 13:20');
define('DELETE', 'Borrar tÃ­tulos de fotos o fotos de tamaÃ±o original');
define('DELETE_TITLE', 'Borrar tÃ­tulos de fotos');
define('DELETE_ORIGINAL', 'Borrar fotos de tamaÃ±o original');
define('DELETE_REPLACE', 'Borra las imÃ¡genes originales, reemplazÃ¡ndolas con otras de tamaÃ±o nuevo');
define('SELECT_ALBUM', 'Selecciona album');

// lang_pagetitle_php
define('DIVIDER', '>');
define('VIEWING', 'Viewing Photo');
define('USR', '\'s Photo Gallery');
define('PHOTOGALLERY', 'Photo Gallery');
?>