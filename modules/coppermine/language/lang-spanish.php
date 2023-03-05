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
/*   $Id: lang-spanish.php,v 1.7 2004/05/13 10:46:25 gtroll Exp $              */
/*****************************************************************************/
// lang_translation_info
define('LANG_NAME_ENGLISH', 'Spanish');
define('LANG_NAME_NATIVE', 'Espa&ntilde;ol');
define('LANG_COUNTRY_CODE', 'es');
define('TRANS_NAME', 'Daniel Villoldo (Grumpywolf)');
define('TRANS_EMAIL', 'dvp@arrakis.es');
define('TRANS_WEBSITE', 'http://grumpywolf.net/');
define('TRANS_DATE', '2003-10-03');
define('CHARSET', 'UTF-8');
define('TEXT_DIR', 'ltr');
define('YES', 'Si');
define('NO', 'No');
define('BACK', 'ATRAS');
define('CONTINUE', 'CONTINUAR');
define('INFO', 'Información');
define('ERROR', 'Error');
define('ALBUM_DATE_FMT', '%d de %B de %Y');
define('LASTCOM_DATE_FMT', '%d/%m/%y a las %H:%M');
define('LASTUP_DATE_FMT', '%d de %B de %Y');
define('REGISTER_DATE_FMT', '%d de %B de %Y');
define('LASTHIT_DATE_FMT', '%d de %B de %Y a las %I:%M %p');
define('COMMENT_DATE_FMT', '%d de %B de %Y a las %I:%M %p');
// lang_meta_album_names
define('RANDOM', 'Fotos al azar');
define('LASTUP', 'Últimas fotos');
define('LASTUPBY', 'My Last Additions');
define('LASTALB', 'Últimos albums modificados');
define('LASTCOM', 'Últimos comentarios');
define('LASTCOMBY', 'My Last comments');
define('TOPN', 'Más vistas');
define('TOPRATED', 'Más valoradas');
define('LASTHITS', 'Últimas vistas');
define('SEARCH', 'Resultado de la búsqueda');
define('FAVPICS', 'Fotos favoritas');

// lang_errors
define('ACCESS_DENIED', 'No tienes permisos para acceder a esta página.');
define('PERM_DENIED', 'No tienes permisos para realizar esta operación.');
define('PARAM_MISSING', 'Llamada a Script sin los parámetros requeridos.');
define('NON_EXIST_AP', '¡El album/foto seleccionado no existe!');
define('QUOTA_EXCEEDED', 'Cuota de disco excedida<br /><br />Tienes una cuota de disco de [quota]K, tus fotos actualmente ocupan [space]K, y añadiendo esta foto excederías la cuota.');
define('GD_FILE_TYPE_ERR', 'Cuando se usa la librería de imagen GD solamente están permitidos los tipos JPEG y PNG.');
define('INVALID_IMAGE', 'La imagen que has añadido está corrupta o no puede ser tratada por la librería GD.');
define('RESIZE_FAILED', 'Incapaz de crear thumbnail o imagen de tamaño reducido.');
define('NO_IMG_TO_DISPLAY', 'Ninguna imagen que enseñar.');
define('NON_EXIST_CAT', 'La categoría seleccionada no existe.');
define('ORPHAN_CAT', 'Una categoría no tiene padre, ejecuta la utilidad de categorías para corregir el problema.');
define('DIRECTORY_RO', 'El directorio \'%s\' no tiene permisos de escritura, las fotos no pueden ser borradas.');
define('NON_EXIST_COMMENT', 'El comentario seleccionado no existe.');
define('PIC_IN_INVALID_ALBUM', '¿¡La foto está en un album que no existe (%s)!?');
define('BANNED', 'Actualmente estás expulsado respecto al uso de esta web.');
define('NOT_WITH_UDB', 'Esta función está desactivada en Coppermine porque está integrada con un software de foros. Lo que fuese que estás intentando hacer no está soportado en esta configuración, o la función debe ser manejada por el software de foros.');
define('MEMBERS_ONLY', 'This function is for members only, please join.');
define('MUSTBE_GOD', 'This function is only for the site admin. You must be logged in as superadmin, god account to access this function');

// lang_main_menu
define('ALB_LIST_TITLE', 'Ir a la lista de albums');
define('ALB_LIST_LNK', 'Lista de Albums');
define('MY_GAL_TITLE', 'Ir a mi galería personal');
define('MY_GAL_LNK', 'Mi galería');
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
define('LASTUP_LNK', 'Últimas fotos');
define('LASTUP_TITLE', 'Recently uploaded pictures');
define('LASTCOM_TITLE',  'Pictures in order of last commented on');
define('LASTCOM_LNK',  'Últimos comentarios');
define('TOPN_TITLE', 'Pictures that have been seen most');
define('TOPN_LNK', 'Más vistas');
define('TOPRATED_TITLE', 'Top rated pictures');
define('TOPRATED_LNK',  'Más valoradas');
define('SEARCH_LNK', 'Buscar');
define('FAV_LNK', 'Mis Favoritos');
define('BAN_LNK', 'Ban usuarios');
define('HELP_LNK', "<img src=\"$CPG_M_DIR/images/help.gif\"  vspace=\"2\" height=\"20\" width=\"20\" align=\"middle\" alt=\"HELP\"  border=\"0\" />");

// lang_gallery_admin_menu

define('UPL_APP_LNK', 'Aprobar Uploads');
define('CONFIG_LNK', 'Configuración');
define('ALBUMS_LNK', 'Albums');
define('CATEGORIES_LNK', 'Categorías');
define('USERS_LNK', 'Usuarios');
define('GROUPS_LNK', 'Grupos');
define('COMMENTS_LNK', 'Comentarios');
define('SEARCHNEW_LNK', 'Añadir fotos (Batch)');
define('UTIL_LNK', 'Cambiar tamaño de las fotos');
define('BAN_LNK', 'Expulsar a Usuarios');

// lang_user_admin_menu
define('ALBMGR_LNK', 'Crear / ordenar albums');
define('MODIFYALB_LNK', 'Modificar mis albums');
define('MY_PROF_LNK', 'Mi perfil de usuario');

// lang_cat_list
define('CATEGORY', 'Categoría');
define('ALBUMS', 'Albums');
define('PICTURES', 'Fotos');

// lang_album_list
define('ALBUM_ON_PAGE', '%d albums en %d página(s)');

// lang_thumb_view
define('DATE', 'FECHA');
define('NAME', 'NOMBRE');
define('TITLE', 'TITULO');
define('SORT_DA', 'Ordenado por fecha ascendente');
define('SORT_DD', 'Ordenado por fecha descendente');
define('SORT_NA', 'Ordenado por nombre ascendente');
define('SORT_ND', 'Ordenado por nombre descendente');
define('SORT_TA', 'Ordenado por título ascendente');
define('SORT_TD', 'Ordenado por título descendente');
define('PIC_ON_PAGE', '%d fotos en %d página(s)');
define('USER_ON_PAGE', '%d usuarios en %d página(s)');
define('SORT_RA', 'Sort by rating ascending');
define('SORT_RD', 'Sort by rating descending');
define('RATING', 'RATING');
define('SORT_TITLE', 'Sort pictures by:');

// lang_img_nav_bar
define('THUMB_TITLE', 'Volver al índice del album');
define('PIC_INFO_TITLE', 'Mostrar/ocultar información de la foto');
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
define('RATING', '(valoración actual : %s / 5 con %s votos)');
define('RUBBISH', 'Mala');
define('POOR', 'Regular');
define('FAIR', 'Normal');
define('GOOD', 'Buena');
define('EXCELLENT', 'Excelente');
define('GREAT', 'Genial');

// lang_cpg_die
define('INFORMATION', 'Información');
define('ERROR', 'Error');
define('CRITICAL_ERROR', 'Error crítico');
define('FILE', 'Fichero: ');
define('LINE', 'Linea: ');

// lang_display_thumbnails
define('FILENAME', 'Fichero: ');
define('FILESIZE', 'Tamaño: ');
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
define('ALB_NEED_NAME', '¡Los albums deben tener un nombre!');
define('CONFIRM_MODIFS', '¿Estás seguro de aplicar estas modificaciones?');
define('NO_CHANGE', '¡No se hizo ningún cambio!');
define('NEW_ALBUM', 'Nuevo album');
define('CONFIRM_DELETE1', '¿Estás seguro de querer borrar este album?');
define('CONFIRM_DELETE2', '\\nTodas las fotos y comentarios que contiene se perderán!');
define('SELECT_FIRST', 'Selecciona un album primero');
define('ALB_MRG', 'Administrador de Albums');
define('MY_GALLERY', '* Mi galería *');
define('NO_CATEGORY', '* Sin categoría *');
define('DELETE', 'Borrar');
define('NEW', 'Nuevo');
define('APPLY_MODIFS', 'Aplicar modificaciones');
define('SELECT_CATEGORY', 'Seleccionar categoría');

// lang_catmgr_php
define('MISS_PARAM', '¡Los parámetros requeridos para la operación: \'%s\' no han sido suministrados!');
define('UNKNOWN_CAT', 'La categoría seleccionada no existe en la base da datos');
define('USERGAL_CAT_RO', '¡Las categorías de galerías de usuario no pueden ser borradas!');
define('MANAGE_CAT', 'Organizador de categorías');
define('CONFIRM_DELETE', 'Estás seguro de querer BORRAR esta catagoría');
define('CATEGORY', 'Categoría');
define('OPERATIONS', 'Operaciones');
define('MOVE_INTO', 'Mover hacia');
define('UPDATE_CREATE', 'Modificar/Crear categoría');
define('PARENT_CAT', 'Categoría padre');
define('CAT_TITLE', 'Título de la categoría');
define('CAT_DESC', 'Descripción de la categoría');

// lang_config_php
define('TITLE', 'Configuración');
define('RESTORE_CFG', 'Restaurar valores por defecto');
define('SAVE_CFG', 'Guardar la nueva configuración');
define('NOTES', 'Notas');
define('INFO', 'Información');
define('UPD_SUCCESS', 'La configuración de Coppermine ha sido actualizada');
define('RESTORE_SUCCESS', 'Valores por defecto de Coppermine restaurados');
define('NAME_A', 'Ascendente por nombre');
define('NAME_D', 'Descendente por nombre');
define('TITLE_A', 'Ascendente por título');
define('TITLE_D', 'Descendente por título');
define('DATE_A', 'Ascendente por fecha');
define('DATE_D', 'Descendente por fecha');
define('RATING_A', 'Rating ascending');
define('RATING_D', 'Rating descending');
define('TH_ANY', 'Max Aspect');
define('TH_HT', 'Height');
define('TH_WD', 'Width');

// lang_config_data
define('CONFIG_GENSET', 'Parámetros Generales');
define('GALLERY_NAME', 'Nombre de la galería');
define('GALLERY_DESCRIPTION', 'Descripción de la galería');
define('GALLERY_ADMIN_EMAIL', 'Correo electrónico del administrador');
define('ECARDS_MORE_PIC_TARGET', 'Address to nuke folder ie http://www.mysite.tld/html/');
define('LANG', 'Lenguaje');
define('CPGTHEME', 'Tema (aspecto)');
define('NICE_TITLES', 'Page Specific Titles instead of >Coppermine');
define('RIGHT_BLOCKS', 'Show blocks on the right');
define('ALB_LIST_VIEW_TITLE', 'Aspecto de la lista de albums');
define('MAIN_TABLE_WIDTH', 'Anchura de la tabla principal (pixels o %)');
define('SUBCAT_LEVEL', 'Número de niveles de categorías a mostrar');
define('ALBUMS_PER_PAGE', 'Número de albums a mostrar');
define('ALBUM_LIST_COLS', 'Número de columnas en la lista de albums');
define('ALB_LIST_THUMB_SIZE', 'Tamaño de los thumbnails en pixels');
define('MAIN_PAGE_LAYOUT', 'Contenido de la página principal');
define('FIRST_LEVEL', 'Mostrar thumbnails de albums de primer nivel en categorías');
define('THUMB_VIEW_TITLE', 'Aspecto de la vista de Thumbnails');
define('THUMBCOLS', 'Número de columnas en la página de thumbnails');
define('THUMBROWS', 'Número de filas en la página de thumbnails');
define('MAX_TABS', 'Máximo número de tabs a mostrar');
define('CAPTION_IN_THUMBVIEW', 'Mostrar picture caption (además del título) debajo del thumbnail');
define('DISPLAY_COMMENT_COUNT', 'Mostrar el número de comentarios debajo del thumbnail');
define('DEFAULT_SORT_ORDER', 'Orden por defecto de las fotos');
define('MIN_VOTES_FOR_RATING', 'Minimo número de votos para que una foto aparezca el la lista de \'Más Valoradas\' list');
define('SEO_ALTS', 'Alts and title tags of thumbnail show title and keyword instead of picinfo');
define('IMAGE_COMMENT_VIEW_TITLE', 'Vista de foto y Configuración de comentarios');
define('PICTURE_TABLE_WIDTH', 'Anchura de la tabla donde mostrar la foto (pixels o %)');
define('DISPLAY_PIC_INFO', 'Información de la foto visible por defecto');
define('FILTER_BAD_WORDS', 'Filtrar palabras malsonantes en los comentarios');
define('ENABLE_SMILIES', 'Permitir Emoticons en los comentarios');
define('DISABLE_FLOOD_PROTECTION', 'Allow several consecutive comments on one pic from the same user');
define('COMMENT_EMAIL_NOTIFICATION', 'Email site admin upon comment submission');
define('MAX_IMG_DESC_LENGTH', 'Máxima longitud para la descripción de una foto');
define('MAX_COM_WLENGTH', 'Máximo número de caracteres en una palabra');
define('MAX_COM_LINES', 'Máximo número de lineas en un comentario');
define('MAX_COM_SIZE', 'Máxima longitud de un comentario');
define('DISPLAY_FILM_STRIP', 'Mostrar tira de película');
define('MAX_FILM_STRIP_ITEMS', 'Número de objetos en tira de película');
define('ALLOW_ANON_FULLSIZE', 'Allow viewing of full size pic by anonymous');
define('KEEP_VOTES_TIME', 'Number of days between being able to vote on the same image');
define('PIC_THUMB_SETTING_TITLE', 'Configuración de las fotos y thumbnails');
define('JPEG_QUAL', 'Calidad para los ficheros JPEG');
define('THUMB_WIDTH', 'Máxima anchura o altura de los thumbnail <strong>*</strong>');
define('THUMB_USE', 'Usar dimensión ( anchura o altura o Máximo para los thumbnail )<strong>*</strong>');
define('MAKE_INTERMEDIATE', 'Crear fotos de tamaño intermedio');
define('PICTURE_WIDTH', 'Máxima anchura o altura de las fotos de tamaño intermedio <strong>*</strong>');
define('MAX_UPL_SIZE', 'Máximo tamaño de los fotos de usuarios por upload (KB)');
define('MAX_UPL_WIDTH_HEIGHT', 'Máxima anchura o altura de las fotos de usuarios por upload (pixels)');
define('USER_SETTING_TITLE', 'Configuración de usuarios');
define('ALLOW_USER_REGISTRATION', 'Permitir el registro de nuevos usuarios');
define('REG_REQUIRES_VALID_EMAIL', 'Registro de usuarios requiere verificación de email');
define('ALLOW_DUPLICATE_EMAILS_ADDR', 'Permitir a dos usuarios tener el mismo email');
define('ALLOW_PRIVATE_ALBUMS', 'Los usuarios pueden tener albums privados');
define('CUSTOM_FIELDS_TITLE', 'Campos extra para descripción de fotos (dejar en blanco si no los usas)');
define('USER_FIELD1_NAME', 'Nombre del campo 1');
define('USER_FIELD2_NAME', 'Nombre del campo 2');
define('USER_FIELD3_NAME', 'Nombre del campo 3');
define('USER_FIELD4_NAME', 'Nombre del campo 4');
define('PIC_ADV_SETTING_TITLE', 'Configuración avanzada de fotos y thumbnails');
define('SHOW_PRIVATE', 'Mostrar icono de album privado a usuarios no registrados');
define('FORBIDEN_FNAME_CHAR', 'Caracteres prohibidos en los nombres de las fotos');
define('ALLOWED_FILE_EXTENSIONS', 'Extensiones de fichero admitidos en los uploads');
define('THUMB_METHOD', 'Método para el reescalado de fotos');
define('IMPATH', 'Path de la utilidad ImageMagick (por ejemplo /usr/bin/X11/)');
define('ALLOWED_IMG_TYPES', 'Tipos de ficheros admitidos (solo válidos con ImageMagick)');
define('IM_OPTIONS', 'Comandos de linea para ImageMagick');
define('READ_EXIF_DATA', 'Leer datos EXIF en ficheros de tipo JPEG');
define('READ_IPTC_DATA', 'Read IPTC data in JPEG files');
define('FULLPATH', 'Directorio base de los albums <strong>*</strong>');
define('USERPICS', 'Dierctorio para las fotos subidas por los usuarios <strong>*</strong>');
define('NORMAL_PFX', 'Prefijo para las fotos de tamaño intermedio <strong>*</strong>');
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
define('COOKIE_SETTING_TITLE', 'Configuración de cookies y Juego de Caracteres');
define('COOKIE_NAME', 'Nombre de la cookie usada por el script');
define('COOKIE_PATH', 'Path de la cookie usada por el script');
define('CHAR_SET', 'Juego de caracteres');
define('MISC_SETTING_TITLE', 'Configuraciones de otros aspectos');
define('DEBUG_MODE', 'Activar modo debug');
define('ADVANCED_DEBUG_MODE', 'Enable advanced debug mode');
define('SHOWUPDATE', 'Show Coppermine Update Alert to Admin');
define('NOCHANGE_FOOTER_TITLE', '<br /><div align="center">(*) Los campos marcados con * no deben ser cambiados si ya se tienen fotos en las galerías</div><br />');

// lang_db_input_php
define('EMPTY_NAME_OR_COM', 'Debes introducir tu nombre y un comentario');
define('COM_ADDED', 'Comentario añadido');
define('ALB_NEED_TITLE', '¡Debes de introducir un título para el album!');
define('NO_UDP_NEEDED', 'No se requiere ningún cambio');
define('ALB_UPDATED', 'Album actualizado');
define('UNKNOWN_ALBUM', 'El album seleccionado no existe o no tienes permisos para añadir fotos en este album');
define('NO_PIC_UPLOADED', '¡Ninguna foto fue añadida!<br /><br />Si habías seleccionado una foto para añadir, comprueba que el servidor admite subir ficheros...');
define('ERR_MKDIR', '¡Fallo al crear el directorio %s!');
define('DEST_DIR_RO', '¡El directorio destino %s no tiene permisos de escritura!');
define('ERR_MOVE', '¡Imposible mover %s a %s !');
define('ERR_FSIZE_TOO_LARGE', 'El tamaño de la foto que quieres insertar es demasiago grande (el máximo permitido es de %s x %s)');
define('ERR_IMGSIZE_TOO_LARGE', 'El tamaño del fichero de la foto que quieres insertar es demasiado grande (el máximo permitido es de %s KB)');
define('ERR_INVALID_IMG', 'El fichero que quieres insertar no es una imagen válida');
define('ALLOWED_IMG_TYPES', 'Puedes insertar solamente %s fotos.');
define('ERR_INSERT_PIC', 'La foto \'%s\' no puede ser dada de alta en el album ');
define('UPLOAD_SUCCESS', 'La foto ha sido insertada correctamente<br /><br />Será visible tras la aprobación de los administradores.');
define('INFO', 'Información');
define('ERR_COMMENT_EMPTY', '¡El comentario está vacio!');
define('ERR_INVALID_FEXT', 'Solamente están admitidas fotos con las siguientes extensiones : <br /><br />%s.');
define('NO_FLOOD', 'Perdona pero eres el autor/a del último comentario introducido para esta foto<br /><br />Puedes editar el comentario que has puesto si es que quieres modificarlo');
define('REDIRECT_MSG', 'Estás siendo redirigido.<br /><br /><br />Pulsa \'CONTINUAR\' si la página no se refresca automáticamente');
define('UPL_SUCCESS', 'La foto se ha añadido correctamente');

// lang_delete_php
define('CAPTION', 'Caption');
define('FS_PIC', 'imagen tamaño completo');
define('DEL_SUCCESS', 'borrado correctamente');
define('NS_PIC', 'imagen tamaño normal');
define('ERR_DEL', 'no puede ser borrado');
define('THUMB_PIC', 'thumbnail');
define('COMMENT', 'comentario');
define('IM_IN_ALB', 'fotos en el album');
define('ALB_DEL_SUCCESS', 'Album \'%s\' borrado');
define('ALB_MGR', 'Organizador de albums');
define('ERR_INVALID_DATA', 'Datos inválidos recibidos en \'%s\'');
define('CREATE_ALB', 'Creando el album \'%s\'');
define('UPDATE_ALB', 'Actualizando album \'%s\' con el título \'%s\' y el índice \'%s\'');
define('DEL_PIC', 'Borrar foto');
define('DEL_ALB', 'Borrar album');
define('DEL_USER', 'Borrar usuario');
define('ERR_UNKNOWN_USER', '¡El usuario seleccionado no existe!');
define('COMMENT_DELETED', 'El comentario ha sido borrado');

// lang_display_image_php
define('CONFIRM_DEL', '¿Estás seguro de querer BORRAR esta foto? \\nLos comentarios serán también borrados.');
define('DEL_PIC', 'BORRAR ESTA FOTO');
define('SIZE', '%s x %s pixels');
define('VIEWS', '%s veces');
define('SLIDESHOW', 'Slideshow');
define('STOP_SLIDESHOW', 'DETENER SLIDESHOW');
define('VIEW_FS', 'Pulsa aqui para ver la imagen a tamaño completo');
define('EDIT_PIC', 'EDIT PICTURE INFO');

// lang_picinfo
define('TITLE', 'Información de la foto');
define('FILENAME', 'Nombre del fichero');
define('ALBUM NAME', 'Nombre del album');
define('RATING', 'Valoración (%s votos)');
define('KEYWORDS', 'Palabras clave');
define('FILE SIZE', 'Tamaño del fichero');
define('DIMENSIONS', 'Dimensiones');
define('DISPLAYED', 'Se ha visto');
define('CAMERA', 'Cámara');
define('DATE TAKEN', 'Fecha de la foto');
define('APERTURE', 'Apertura');
define('EXPOSURE TIME', 'Tiempo de exposición');
define('FOCAL LENGTH', 'Longitud del foco');
define('COMMENT', 'Comentario');
define('ADDFAV', 'Añadir a Favoritos');
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
define('CONFIRM_DELETE', '¿Estás seguro de querer borrar el comentario?');
define('ADD_YOUR_COMMENT', 'Añadir un comentario');
define('NAME', 'Nombre');
define('COMMENT', 'Comentario');
define('YOUR_NAME', 'Anónimo');

// lang_fullsize_popup
define('CLICK_TO_CLOSE', 'Pulsa en la imagen para cerrar esta ventana');

// lang_ecard_php
define('TITLE', 'Enviar foto a un amigo');
define('INVALID_EMAIL', '<strong>Atención</strong> : ¡dirección e-mail incorrecta!');
define('ECARD_TITLE', 'Una foto de %s para ti');
define('VIEW_ECARD', 'Si la foto no se ve correctamente, pulsa en este link');
define('VIEW_MORE_PICS', '¡Pulsa aqui para ver más fotos!');
define('SEND_SUCCESS', 'La foto ha sido enviada');
define('SEND_FAILED', 'Disculpa, pero el servidor no puede enviar la foto...');
define('FROM', 'De');
define('YOUR_NAME', 'Tu nombre');
define('YOUR_EMAIL', 'Tu dirección de e-mail');
define('TO', 'A');
define('RCPT_NAME', 'Nombre de tu amigo');
define('RCPT_EMAIL', 'Dirección e-mail de tu amigo');
define('GREETINGS', 'Título del mensaje');
define('MESSAGE', 'Mensaje');

// lang_editpics_php
define('PIC_INFO', 'Información');
define('ALBUM', 'Album');
define('TITLE', 'Título');
define('DESC', 'Descripción');
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
define('N_OF_PIC_TO_DISP', 'Número de fotos a mostrar');
define('APPLY', 'Validar los cambios');

// lang_groupmgr_php
define('GROUP_NAME', 'Nombre del grupo');
define('DISK_QUOTA', 'Cuota de disco');
define('CAN_RATE', 'Pueden valorar fotos');
define('CAN_SEND_ECARDS', 'Pueden enviar ecards');
define('CAN_POST_COM', 'Pueden añadir comentarios');
define('CAN_UPLOAD', 'Pueden añadir fotos');
define('CAN_HAVE_GALLERY', 'Pueden tener galerías personales');
define('APPLY', 'Validar los cambios');
define('CREATE_NEW_GROUP', 'Crear nuevo grupo');
define('DEL_GROUPS', 'Borrar el/los grupo(s) seleccionados');
define('CONFIRM_DEL', '¡Atención, cuando borras un grupo, los usuarios que pertenecen a ese grupo serán transferidos al grupo \'Registered\'!\\n\\n¿Deseas continuar?');
define('TITLE', 'Configurar grupos de usuarios');
define('APPROVAL_1', 'Aprobación album público (1)');
define('APPROVAL_2', 'Aprobación album privado (2)');
define('NOTE1', '<strong>(1)</strong> Añadir fotos en un album público requerirá aprobación de los administradores');
define('NOTE2', '<strong>(2)</strong> Añadir fotos en un album que pertenece al asuario requerirá aprobación de los administradores');
define('NOTES', 'Notas');

// lang_index_php
define('WELCOME', '¡Bienvenido!');

// lang_album_admin_menu
define('CONFIRM_DELETE', '¿Estás seguro de querer BORRAR este album ? \\nTodas las fotos y comentarios serán también borrados.');
define('DELETE', 'BORRAR');
define('MODIFY', 'MODIFICAR');
define('EDIT_PICS', 'EDITAR FOTOS');

// lang_list_categories
define('HOME', 'Home');
define('STAT1', '<strong>[pictures]</strong> fotos en <strong>[albums]</strong> albums y <strong>[cat]</strong> categorías con <strong>[comments]</strong> comentarios, vistas <strong>[views]</strong> veces');
define('STAT2', '<strong>[pictures]</strong> fotos en <strong>[albums]</strong> albums, vistas <strong>[views]</strong> veces');
define('XX_S_GALLERY', 'Galería de %s');
define('STAT3', '<strong>[pictures]</strong> fotos en <strong>[albums]</strong> albums con <strong>[comments]</strong> comentarios, vistas <strong>[views]</strong> veces');

// lang_list_users
define('USER_LIST', 'Lista de usuarios');
define('NO_USER_GAL', 'No existen usuarios con permisos para tener albums');
define('N_ALBUMS', '%s album(s)');
define('N_PICS', '%s foto(s)');

// lang_list_albums
define('N_PICTURES', '%s fotos');
define('LAST_ADDED', ', última añadida el %s');

// lang_modifyalb_php
define('UPD_ALB_N', 'Modificar album %s');
define('GENERAL_SETTINGS', 'Configuración general');
define('ALB_TITLE', 'Título del album');
define('ALB_CAT', 'Categoría del album');
define('ALB_DESC', 'Descripción del album');
define('ALB_THUMB', 'Thumbnail del album');
define('ALB_PERM', 'Permisos para este album');
define('CAN_VIEW', 'Este album puede ser visto por');
define('CAN_UPLOAD', 'Los visitantes pueden añadir fotos');
define('CAN_POST_COMMENTS', 'Los visitantes pueden añadir comentarios');
define('CAN_RATE', 'Los visitantes pueden valorar las fotos');
define('USER_GAL', 'Galería de usuario');
define('NO_CAT', '* Sin categoría *');
define('ALB_EMPTY', 'El album está vacío');
define('LAST_UPLOADED', 'Ultima foto añadida');
define('PUBLIC_ALB', 'Todo el mundo (album público)');
define('ME_ONLY', 'Solamente yo');
define('OWNER_ONLY', 'Solamente el dueño del album (%s)');
define('GROUPP_ONLY', 'Miembros del grupo \'%s\'');
define('ERR_NO_ALB_TO_MODIFY', 'No puedes modificar ningún album en la base de datos.');
define('UPDATE', 'Modificar album');

// lang_rate_pic_php
define('ALREADY_RATED', 'Perdona pero ya has votado anteriormente a esta foto');
define('RATE_OK', 'Tu voto ha sido contabilizado');

// lang_register_disclamer
define('REGISTER_DISCLAMER', 'A pesar de que los administradores de {SITE_NAME} intentarán eliminar o editar cualquier material desagradable tan pronto como puedan, resulta imposible revisar todos los envíos que se realizan. Por lo tanto debes tener en cuenta que todos los envíos hechos hacia esta web expresan el punto de vista y opiniones de sus autores y no los de los administradores o webmasters (excepto los añadidos por ellos mismos).<br />
<br />
Usted acuerda no añadir ningún material abusivo, obsceno, vulgar, escandaloso, odioso, amenazador, de orientación sexual, o ningún otro que pueda violar cualquier ley aplicable. Usted está de acuerdo con que el webmaster, el administrador y los asesores de { SITE_NAME } tienen el derecho de quitar o de corregir cualquier contenido en cualquier momento si lo consideran necesario. Como usuario, accede a que cualquier información añadida será almacenada en una base de datos. Asi mismo, esta información no será divulgada a terceros sin su consentimiento. El webmaster y el administrador no se pueden hacer responsables de ningún intento de destrucción de la base de datos que pueda conducir a la pérdida de la misma.<br />
<br />
Este sitio utiliza cookies para almacenar la información en su ordenador. Estas cookies sirven para mejorar la navegación en este sitio. La dirección de email se utiliza solamente para confirmar sus detalles y contraseña del registro.<br />
<br />
Pulsando \'estoy de acuerdo\' expresas tu conformidad con estas condiciones.');

// lang_register_php
define('PAGE_TITLE', 'Registro de nuevo usuario');
define('TERM_COND', 'Términos y condiciones');
define('I_AGREE', 'Estoy de acuerdo');
define('SUBMIT', 'Enviar solicitud de registro');
define('ERR_USER_EXISTS', 'El nombre de usuario elegido ya existe, por favor elige otro diferente');
define('ERR_PASSWORD_MISMATCH', 'Las dos contraseñas no son iguales, por favor vuelve a introducirlas');
define('ERR_UNAME_SHORT', 'El nombre de usuario debe ser de 2 caracteres de longitud como mínimo');
define('ERR_PASSWORD_SHORT', 'La contraseña debe ser de 2 caracteres de longitud como mínimo');
define('ERR_UNAME_PASS_DIFF', 'El nombre de usuario y la contraseña deben ser diferentes');
define('ERR_INVALID_EMAIL', 'La dirección de email no es válida');
define('ERR_DUPLICATE_EMAIL', 'Otro usuario se ha registrado anteriormente con la dirección de email suministrada');
define('ENTER_INFO', 'Introduce la información de registro');
define('REQUIRED_INFO', 'Información requerida');
define('OPTIONAL_INFO', 'Información opcional');
define('USERNAME', 'Nombre de usuario');
define('PASSWORD', 'Contraseña');
define('PASSWORD_AGAIN', 'Reescribir contraseña');
define('EMAIL', 'Email');
define('LOCATION', 'Localidad');
define('INTERESTS', 'Intereses');
define('WEBSITE', 'Página web');
define('OCCUPATION', 'Ocupación');
define('ERROR', 'ERROR');
define('CONFIRM_EMAIL_SUBJECT', '%s - Confirmación de registro');
define('INFORMATION', 'Información');
define('FAILED_SENDING_EMAIL', '¡El email de confirmación de registro no ha podido ser enviado!');
define('THANK_YOU', 'Gracias por registrarte.<br /><br />Hemos enviado un email con información sobre la activación de tu cuenta a la dirección de email que nos has facilitado.');
define('ACCT_CREATED', 'Tu cuenta de usuario ha sido creada y ahora puedes acceder al sistema con tu nombre de usuario y contraseña');
define('ACCT_ACTIVE', 'Tu cuenta de usuario está ya activa y ahora puedes acceder al sistema con tu nombre de usuario y contraseña');
define('ACCT_ALREADY_ACT', '¡Tu cuenta ya estaba activa!');
define('ACCT_ACT_FAILED', '¡Esta cuenta no puede ser activada!');
define('ERR_UNK_USER', '¡El usuario seleccionado no existe!');
define('X_S_PROFILE', 'Perfil de %s');
define('GROUP', 'Grupo');
define('REG_DATE', 'Fecha de alta');
define('DISK_USAGE', 'Uso de disco');
define('CHANGE_PASS', 'Cambiar mi contraseña');
define('CURRENT_PASS', 'Contraseña actual');
define('NEW_PASS', 'Nueva contraseña');
define('NEW_PASS_AGAIN', 'Reescribir nueva contraseña');
define('ERR_CURR_PASS', 'La contraseña actual es incorrecta');
define('APPLY_MODIF', 'Guardar los cambios');
define('UPDATE_SUCCESS', 'Tu perfil ha sido actualizado');
define('PASS_CHG_SUCCESS', 'Tu contraseña ha sido cambiada');
define('PASS_CHG_ERROR', 'Tu contraseña no ha sido cambiada');

// lang_register_confirm_email
define('REGISTER_CONFIRM_EMAIL', 'Gracias por registrarte en {SITE_NAME}

Tu nombre de usuario es: "{USER_NAME}"
Tu contraseña es: "{PASSWORD}"

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
define('N_COMM_DISP', 'Número de comentarios a mostrar');
define('SEE_PREV', 'Ver el anterior');
define('SEE_NEXT', 'Ver el siguiente');
define('DEL_COMM', 'Borrar comentarios seleccionados');

// lang_search_php
define('SEARCH', 'Buscar entre todas las fotos');

// lang_search_new_php
define('PAGE_TITLE', 'Buscar nuevas fotos');
define('SELECT_DIR', 'Selecciona directorio');
define('SELECT_DIR_MSG', 'Esta función te permite añadir de forma automática las fotos que hayas subido a tu servidor mediante FTP.<br /><br />Selecciona el directorio donde has subido tus fotos');
define('NO_PIC_TO_ADD', 'No hay ninguna foto para añadir');
define('NEED_ONE_ALBUM', 'Necesitas al menos un album para utilizar esta función');
define('WARNING', 'Atención');
define('CHANGE_PERM', '¡El script no puede escribir en este directorio, necesitas cambiar sus permisos a modo 755 o 777 antes de intentarlo de nuevo!');
define('TARGET_ALBUM', '<strong>Colocar las fotos del dierctorio &quot;</strong>%s<strong>&quot; en el album </strong>%s');
define('FOLDER', 'Carpeta');
define('IMAGE', 'Foto');
define('ALBUM', 'Album');
define('RESULT', 'Resultado');
define('DIR_RO', 'No se puede escribir. ');
define('DIR_CANT_READ', 'No se puede leer. ');
define('INSERT', 'Añadiendo nuevas fotos a la galería');
define('LIST_NEW_PIC', 'Listado de nuevas fotos');
define('INSERT_SELECTED', 'Añadir las fotos seleccionadas');
define('NO_PIC_FOUND', 'No se encontró ninguna foto nueva');
define('BE_PATIENT', 'Por favor, se paciente, el script necesita tiempo para añadir las fotos');
define('NOTES', '<ul><li><strong>OK</strong> : significa que la foto fue añadida sin problemas<li><strong>DP</strong> : significa que la foto es un duplicado y ya existe en la base de datos<li><strong>PB</strong> : significa que la foto no puede ser añadida, por favor comprueba la configaración y los permisos de los directorios donde están las fotos<li>Si los iconos OK, DP, PB no aparecen, pulsa sobre el icono de imagen no cargada para ver el error producido por PHP<li>Si el navegador produce un timeout, pulsa el icono de Actualizar</ul>');
define('SELECT_ALBUM', 'Select album');
define('NO_ALBUM', 'No album name was selected, click back and select an album to put your pictures in');

// lang_upload_php
define('TITLE', 'Insertar nueva foto');
define('MAX_FSIZE', 'El tamaño máximo de fichero admitido es de %s KB');
define('ALBUM', 'Album');
define('PICTURE', 'Foto');
define('PIC_TITLE', 'Título de la foto');
define('DESCRIPTION', 'Descripción de la foto');
define('KEYWORDS', 'Palabras clave (separadas por espacios)');
define('ERR_NO_ALB_UPLOADABLES', 'Perdona pero no hay ningún album donde esté permitido insertar nuevas fotos');

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
define('ERR_NO_USERS', '¡La tabla de usuarios está vacía!');
define('ERR_EDIT_SELF', 'No puedes editar tu propio perfil, usa la opción \'Mi perfil de usuario\' para eso');
define('EDIT', 'EDITAR');
define('DELETE', 'BORRAR');
define('NAME', 'Nombre de usuario');
define('GROUP', 'Grupo');
define('INACTIVE', 'Inactivo');
define('OPERATIONS', 'Operaciones');
define('PICTURES', 'Fotos');
define('DISK_SPACE', 'Espacio usado / Cuota');
define('REGISTERED_ON', 'Registrado el día');
define('U_USER_ON_P_PAGES', '%d usuarios en %d página(s)');
define('CONFIRM_DEL', '¿Estás seguro de querer BORRAR este usuario? \\nTodas sus fotos y albums serán también borrados.');
define('MAIL', 'MAIL');
define('ERR_UNKNOWN_USER', '¡El usuario seleccionado no existe!');
define('MODIFY_USER', 'Modificar usuario');
define('NOTES', 'Notas');
define('NOTE_LIST', '<li>Si no quieres cambiar la contraseña actual, deja el campo \"contraseña\" vacío');
define('PASSWORD', 'Contraseña');
define('USER_ACTIVE', 'El usuario está activo');
define('USER_GROUP', 'Grupo de usuarios');
define('USER_EMAIL', 'Email del usuario');
define('USER_WEB_SITE', 'Página web del usuario');
define('CREATE_NEW_USER', 'Crear nuevo usuario');
define('USER_FROM', 'Localidad del usuario');
define('USER_INTERESTS', 'Intereses del usuario');
define('USER_OCC', 'Ocupación del usuario');

// lang_util_php
define('TITLE', 'Cambiar tamaño a las fotos');
define('WHAT_IT_DOES', 'Qué hace');
define('WHAT_UPDATE_TITLES', 'Actualiza los nombres de fichero');
define('WHAT_DELETE_TITLE', 'Borra los títulos');
define('WHAT_REBUILD', 'Vuelve a crear los thumbnails y otros tamaños de las fotos');
define('WHAT_DELETE_ORIGINALS', 'Borra las fotos originales reemplazándolas con versiones de nuevo tamaño');
define('FILE', 'Fichero');
define('TITLE_SET_TO', 'título a poner');
define('SUBMIT_FORM', 'enviar');
define('UPDATED_SUCCESFULLY', 'actualizado con éxito');
define('ERROR_CREATE', 'ERROR al crear');
define('CONTINUE', 'Procesar más imágnes');
define('MAIN_SUCCESS', 'El fichero %s ha sido usado como foto principal con éxito');
define('ERROR_RENAME', 'Error renombrando %s a %s');
define('ERROR_NOT_FOUND', 'No se encuentra el fichero %s');
define('BACK', 'volver al inicio');
define('THUMBS_WAIT', 'Actualizando thumbnails y/o tamaños de fotos, por favor espere...');
define('THUMBS_CONTINUE_WAIT', 'Continuando la actualización de thumbnails y/o tamaños de fotos...');
define('TITLES_WAIT', 'Actualizando títulos, por favor espere...');
define('DELETE_WAIT', 'Borrando títulos, por favor espere...');
define('REPLACE_WAIT', 'Borrando originales y reemplazándolos con las fotos de nuevo tamaño, por favor espere...');
define('INSTRUCTION', 'Instrucciones rápidas');
define('INSTRUCTION_ACTION', 'Selecionar acción');
define('INSTRUCTION_PARAMETER', 'Poner parámetros');
define('INSTRUCTION_ALBUM', 'Seleccionar album');
define('INSTRUCTION_PRESS', 'Pulsar %s');
define('UPDATE', 'Actualizar thumbs y/o tamaños de fotos');
define('UPDATE_WHAT', 'Qué debe ser actualizado');
define('UPDATE_THUMB', 'Solo thumbnails');
define('UPDATE_PIC', 'Solo tamaños de fotos');
define('UPDATE_BOTH', 'Thumbnails y tamaños de fotos (ambos)');
define('UPDATE_NUMBER', 'Número de imágenes procesadas por cada click');
define('UPDATE_OPTION', '(Prueba a poner un número menor si experimentas problemas de timeout)');
define('FILENAME_TITLE', 'Fichero &rArr; Título de la foto');
define('FILENAME_HOW', 'Cómo debe ser el fichero modificado');
define('FILENAME_REMOVE', 'Quitar .jpg del final y reemplazar _ (underscore) con espacios');
define('FILENAME_EURO', 'Cambiar 2003_11_23_13_20_20.jpg a 23/11/2003 13:20');
define('FILENAME_US', 'Cambiar 2003_11_23_13_20_20.jpg a 11/23/2003 13:20');
define('FILENAME_TIME', 'Cambiar 2003_11_23_13_20_20.jpg a 13:20');
define('DELETE', 'Borrar títulos de fotos o fotos de tamaño original');
define('DELETE_TITLE', 'Borrar títulos de fotos');
define('DELETE_ORIGINAL', 'Borrar fotos de tamaño original');
define('DELETE_REPLACE', 'Borra las imágenes originales, reemplazándolas con otras de tamaño nuevo');
define('SELECT_ALBUM', 'Selecciona album');

// lang_pagetitle_php
define('DIVIDER', '>');
define('VIEWING', 'Viewing Photo');
define('USR', '\'s Photo Gallery');
define('PHOTOGALLERY', 'Photo Gallery');
?>