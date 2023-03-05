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
define('PIC_VIEWS', 'VisualizaÃ§Ãµes');
define('PIC_VOTES', 'Votos');
define('PIC_COMMENTS', 'ComentÃ¡rios');

// info about translators and translated language
$lang_translation_info = array('lang_name_english' => 'Portuguese (Brazilian)', // the name of your language in English, e.g. 'Greek' or 'Spanish'
    'lang_name_native' => 'Portuguese (Brasilian)', // the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol'
    'lang_country_code' => 'br', // the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
    'trans_name' => '?', // the name of the translator - can be a nickname
    'trans_email' => '', // translator's email address (optional)
    'trans_website' => '', // translator's website (optional)
    'trans_date' => '2003-10-07', // the date the translation was created / last modified
    );

$lang_charset = 'iso-8859-1';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');
// Day of weeks and months
$lang_day_of_week = array('Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab');
$lang_month = array('Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez');
// Some common strings
$lang_yes = 'Sim';
$lang_no = 'Nao';
$lang_back = 'VOLTAR';
$lang_continue = 'CONTINUAR';
$lang_info = 'InformaÃ§Ã£o';
$lang_error = 'Erro';
// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt = '%B %d, %Y';
$lastcom_date_fmt = '%m/%d/%y at %H:%M';
$lastup_date_fmt = '%B %d, %Y';
$register_date_fmt = '%B %d, %Y';
$lasthit_date_fmt = '%B %d, %Y at %I:%M %p';
$comment_date_fmt = '%B %d, %Y at %I:%M %p';
// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array('random' => 'Imagens RandÃ´micas',
    'lastup' => 'Ãšltimas AdiÃ§Ãµes',
    'lastupby' => 'My Last Additions', // new 1.2.2
    'lastcom' => 'Ãšltimos ComentÃ¡rios',
    'lastcomby' => 'My Last comments', // new 1.2.2
    'topn' => 'Mais Visualizados',
    'toprated' => 'Topo de Linha',
    'lasthits' => 'Ãšltimos Visualizados',
    'search' => 'Resultado da Pesquisa',
    'favpics' => 'Favourite Pictures',
    );

$lang_errors = array('access_denied' => 'VocÃª nÃ£o tem permissÃ£o para visualizar este recurso.',
    'perm_denied' => 'VocÃª nÃ£o tem permissÃ£o para executar esta operaÃ§Ã£o.',
    'param_missing' => 'Script nÃ£o consegue estabelecer um parÃ¢metro estabelecido.',
    'non_exist_ap' => 'O Ã¡lbum ou figura que voccÃª selecionau nÃ£o foi encontrado !',
    'quota_exceeded' => 'A quota de espaÃ§o para armazenamento excedeu<br /><br />VocÃª possui [quota]KB de espaÃ§o, suas imagens atualmente utilizam [space]KB, adicionar este arquivo irÃ¡ estourar sua cota permitida.',
    'gd_file_type_err' => 'estamos usando uma sistema que sÃ³ permite imagens JPEG e PNG.',
    'invalid_image' => 'A imagem que vocÃª enviou estÃ¡ corrompida ou nÃ£o pode ser interpretada por GD library',
    'resize_failed' => 'ImpossÃ­vel criar miniatura ou redimensionar a imagem.',
    'no_img_to_display' => 'Sem imagens para mostrar',
    'non_exist_cat' => 'A categoria selecionada nÃ£o existe',
    'orphan_cat' => 'A category has a non-existing parent, runs the category manager to correct the problem.',
    'directory_ro' => 'Directory \'%s\' is not writable, pictures can\'t be deleted',
    'non_exist_comment' => 'O comentÃ¡rio selecionado nÃ£o existe.',
    'pic_in_invalid_album' => 'Imagem em um album inexistente (%s)!?',
    'banned' => 'You are currently banned from using this site.',
    'not_with_udb' => 'This function is disabled in Coppermine because it is integrated with forum software. Either what you are trying to do is not supported in this configuration, or the function should be handled by the forum software.',
    'members_only' => 'This function is for members only, please join.', // changed in cpg1.2.0nuke
    'mustbe_god' => 'This function is only for the site admin. You must be logged in as superadmin, god account to access this function'
    );
// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //
$lang_main_menu = array('alb_list_title' => 'Ir para a lista de Ã¡lbus',
    'alb_list_lnk' => 'Lista de Ã¡lbuns',
    'my_gal_title' => 'Ir para minha galeria pessoal',
    'my_gal_lnk' => 'Minha Galeria',
    'my_prof_lnk' => 'Meus dados',
    'adm_mode_title' => 'Alterar para o modo administrativo',
    'adm_mode_lnk' => 'Modo Administrativo',
    'usr_mode_title' => 'Alterar para modo UsuÃ¡rio',
    'usr_mode_lnk' => 'Modo UsuÃ¡rio',
    'upload_pic_title' => 'Enviar imagem para o Ã¡lbum',
    'upload_pic_lnk' => 'Enviar imagem',
    'register_title' => 'Criar uma conta',
    'register_lnk' => 'Registar',
    'login_lnk' => 'Login',
    'logout_lnk' => 'Logout',
    'lastup_lnk' => 'Ãšltimos envios',
    'lastcom_lnk' => 'Ãšltimos comentÃ¡rios',
    'topn_lnk' => 'Mais Visualizados',
    'toprated_lnk' => 'Topo de linha',
    'search_lnk' => 'Pesquisar',
    'fav_lnk' => 'My Favorites',
    );

$lang_gallery_admin_menu = array('upl_app_lnk' => 'Envio aprovado',
    'config_lnk' => 'ConfiguraÃ§Ã£o',
    'albums_lnk' => 'Ãlbuns',
    'categories_lnk' => 'Categorias',
    'users_lnk' => 'UsuÃ¡rios',
    'groups_lnk' => 'Grupos',
    'comments_lnk' => 'ComentÃ¡rios',
    'searchnew_lnk' => 'Envio em massa',
    'util_lnk' => 'Resize pictures',
    'ban_lnk' => 'Ban Users',
    );

$lang_user_admin_menu = array('albmgr_lnk' => 'Criar / ordnar meus Ã¡lbuns',
    'modifyalb_lnk' => 'Modificar meus Ã¡lbuns',
    'my_prof_lnk' => 'Meus Dados',
    );

$lang_cat_list = array('category' => 'Categoria',
    'albums' => 'Ãlbuns',
    'pictures' => 'Imagens',
    );

$lang_album_list = array('album_on_page' => '%d Ã¡lbuns na(s) %d pÃ¡gina(s)'
    );

$lang_thumb_view = array('date' => 'DATA', 
    // Sort by filename and title
    'name' => 'NOME',
    'title' => 'TITLE',
    'sort_da' => 'Mostar por data ascendente',
    'sort_dd' => 'Mostar por data descendente',
    'sort_na' => 'Mostar por nome ascendente',
    'sort_nd' => 'Mostar por nome descendente',
    'sort_ta' => 'Sort by title ascending',
    'sort_td' => 'Sort by title descending',
    'pic_on_page' => '%d imagens na(s) %d pagina(s)',
    'user_on_page' => '%d usuÃ¡rios na(s) %d pÃ¡gina(s)',
    'sort_ra' => 'Sort by rating ascending', // new in cpg1.2.0nuke
    'sort_rd' => 'Sort by rating descending', // new in cpg1.2.0nuke
    'rating' => 'RATING', // new in cpg1.2.0nuke
    'sort_title' => 'Sort pictures by:', // new in cpg1.2.0nuke
    );

$lang_img_nav_bar = array('thumb_title' => 'Retornar para a pÃ¡gina de miniaturas',
    'pic_info_title' => 'Mostar/esconder informaÃ§Ãµes da imagem',
    'slideshow_title' => 'Show de Slides',
    'slideshow_disabled' => 'e-cards are disabled', // new in cpg1.2.0nuke
    'slideshow_disabled_msg' => $lang_errors['members_only'], // new in cpg1.2.0nuke
    'ecard_title' => 'enviar esta imagem como e-card',
    'ecard_disabled' => 'e-cards estÃ£o desabilitados',
    'ecard_disabled_msg' => 'VocÃª nÃ£o possui permissÃ£o para enviar e-cards',
    'prev_title' => 'Ver imagem anterior',
    'next_title' => 'Ver prÃ³xima imagem',
    'pic_pos' => 'IMAGEM %s/%s',
    'no_more_images' => 'There are no more images in this galley', // new in cpg1.2.0nuke
    'no_less_images' => 'This is the first image in the gallery', // new in cpg1.2.0nuke
    );

$lang_rate_pic = array('rate_this_pic' => 'Qualifique esta imagem ',
    'no_votes' => '(Nenhum voto)',
    'rating' => '(Corrente qualificaÃ§Ã£o : %s / 5 dos %s votos)',
    'rubbish' => 'Ruim',
    'poor' => 'Pobre',
    'fair' => 'Justo',
    'good' => 'Bom',
    'excellent' => 'Excelente',
    'great' => 'Espetacular',
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
    CRITICAL_ERROR => 'ERRO CRÃTICO',
    'file' => 'Arquivo: ',
    'line' => 'Linha: ',
    );

$lang_display_thumbnails = array('filename' => 'Arquivo : ',
    'filesize' => 'Tamanho : ',
    'dimensions' => 'DimensÃµes : ',
    'date_added' => 'Data Envio : '
    );

$lang_get_pic_data = array('n_comments' => '%s comentÃ¡rios',
    'n_views' => '%s visualizaÃ§Ãµes',
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
if (defined('SMILIES_PHP')) $lang_smilies_inc_php = array('Exclamation' => 'ExclamaÃ§Ã£o',
        'Question' => 'QuestÃ£o',
        'Very Happy' => 'Muito Feliz',
        'Smile' => 'Sorriso',
        'Sad' => 'Triste',
        'Surprised' => 'Surpreso',
        'Shocked' => 'Chocado',
        'Confused' => 'Confuso',
        'Cool' => 'Cool',
        'Laughing' => 'Risonho',
        'Mad' => 'Louco',
        'Razz' => 'Razz',
        'Embarassed' => 'EmbaraÃ§ado',
        'Crying or Very sad' => 'Muito triste',
        'Evil or Very Mad' => 'Muito mÃ¡u',
        'Twisted Evil' => 'Twisted Evil',
        'Rolling Eyes' => 'Rolando os olhos',
        'Wink' => 'Piscando',
        'Idea' => 'Ideia',
        'Arrow' => 'Seta',
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
if (defined('ADMIN_PHP')) $lang_admin_php = array(0 => 'Deixando o modo administrativo...',
        1 => 'Entrando no modo administrativo...',
        );
// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //
if (defined('ALBMGR_PHP')) $lang_albmgr_php = array('alb_need_name' => 'Ãlbuns precisam ter um nome !',
        'confirm_modifs' => 'Tem certeza que deseja realizar as modificaÃ§Ãµs ?',
        'no_change' => 'VocÃª nÃ£o fÃªz nenhuma mudanÃ§a  !',
        'new_album' => 'Novo Ã¡lbum',
        'confirm_delete1' => 'Tem certeza de querer remover este Ã¡lbum ?',
        'confirm_delete2' => '\nTodas as imagens e comentÃ¡rios serÃ£o perdidos !',
        'select_first' => 'Primeiro selecione um Ã¡lbum',
        'alb_mrg' => 'Gerenciador de Ã¡lbuns',
        'my_gallery' => '* Minha Galeria *',
        'no_category' => '* Sem categoria *',
        'delete' => 'Apagar',
        'new' => 'Novo',
        'apply_modifs' => 'Aplicar modificaÃ§Ãµes',
        'select_category' => 'Selecione uma categoria',
        );
// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) $lang_catmgr_php = array('miss_param' => 'Parametros requeridos para \'%s\'operaÃ§Ã£o nÃ£o fornecida !',
        'unknown_cat' => 'A ctegoria selecionada nÃ£o existe em nossa base de dados',
        'usergal_cat_ro' => 'A categoria do usuÃ¡rio nÃ£o pode ser excluÃ­da !',
        'manage_cat' => 'Gerenciar categorias',
        'confirm_delete' => 'VocÃª tem certeza que deseja EXCLUIR  esta categoria ? ',
        'category' => 'Categoria',
        'operations' => 'OperaÃ§Ãµes',
        'move_into' => 'Mover em',
        'update_create' => 'Atualizar/Criar categoria',
        'parent_cat' => 'Categoria parente',
        'cat_title' => 'TÃ­tulo da categoria',
        'cat_desc' => 'DescriÃ§Ã£o da categoria'
        );
// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //
if (defined('CONFIG_PHP')) $lang_config_php = array('title' => 'ConfiguraÃ§Ã£o',
        'restore_cfg' => 'Restaurar configuraÃ§Ã£o de fÃ¡brica',
        'save_cfg' => 'Salvar nova configuraÃ§Ã£o',
        'notes' => 'Notas',
        'info' => 'InformaÃ§Ã£o',
        'upd_success' => 'ConfiguraÃ§Ã£o do catÃ¡logo atualizada',
        'restore_success' => 'ConfiguraÃ§Ã£o de fÃ¡brica restaurada',
        'name_a' => 'Nome ascendente',
        'name_d' => 'Nome descendente',
        'title_a' => 'Title ascending',
        'title_d' => 'Title descending',
        'date_a' => 'Data Ascendente',
        'date_d' => 'Data descendente',
        'rating_a' => 'Rating ascending', // new in cpg1.2.0nuke
        'rating_d' => 'Rating descending', // new in cpg1.2.0nuke
        'th_any' => 'Max Aspect',
        'th_ht' => 'Height',
        'th_wd' => 'Width',
        );
// start left side interpretation
if (defined('CONFIG_PHP')) $lang_config_data = array('General settings',
array(
'Gallery name', 'gallery_name', 0),
array(
'Gallery description', 'gallery_description', 0),
array(
'Gallery administrator email', 'gallery_admin_email', 0),
array(
'Address to nuke folder ie http://www.mysite.tld/html', 'ecards_more_pic_target', 0),
array(
'Language', 'lang', 5),
// for postnuke change
array(
'Theme', 'cpgtheme', 6),
array(
'Page Specific Titles instead of >Coppermine', 'nice_titles', 1),
array(
'Show blocks on the right', 'right_blocks', 1), // new 1.2.2

        'Album list view',
array(
'Width of the main table (pixels or %)', 'main_table_width', 0),
array(
'Number of levels of categories to display', 'subcat_level', 0),
array(
'Number of albums to display', 'albums_per_page', 0),
array(
'Number of columns for the album list', 'album_list_cols', 0),
array(
'Size of thumbnails in pixels', 'alb_list_thumb_size', 0),
array(
'The content of the main page', 'main_page_layout', 0),
array(
'Show first level album thumbnails in categories', 'first_level', 1),
        'Thumbnail view',
array(
'Number of columns on thumbnail page', 'thumbcols', 0),
array(
'Number of rows on thumbnail page', 'thumbrows', 0),
array(
'Maximum number of tabs to display', 'max_tabs', 0),
array(
'Display picture caption (in addition to title) below the thumbnail', 'caption_in_thumbview', 1),
array(
'Display number of comments below the thumbnail', 'display_comment_count', 1),
array(
'Default sort order for pictures', 'default_sort_order', 3),
array(
'Minimum number of votes for a picture to appear in the \'top-rated\' list', 'min_votes_for_rating', 0),
array(
'Alts and title tags of thumbnail show title and keyword instead of picinfo', 'seo_alts', 1), // new in cpg1.2.0nuke
        'Image view &amp; Comment settings',
array(
'Width of the table for picture display (pixels or %)', 'picture_table_width', 0),
array(
'Picture information are visible by default', 'display_pic_info', 1),
array(
'Filter bad words in comments', 'filter_bad_words', 1),
array(
'Allow smiles in comments', 'enable_smilies', 1),
array(
'Allow several consecutive comments on one pic from the same user', 'disable_flood_protection', 1), // new in cpg1.2.0nuke
array(
'Email site admin upon comment submission' , 'comment_email_notification', 1), // new in cpg1.2.0nuke
array(
'Max length for an image description', 'max_img_desc_length', 0),
array(
'Max number of characters in a word', 'max_com_wlength', 0),
array(
'Max number of lines in a comment', 'max_com_lines', 0),
array(
'Maximum length of a comment', 'max_com_size', 0),
array(
'Show film strip', 'display_film_strip', 1),
array(
'Number of items in film strip', 'max_film_strip_items', 0),
array(
'Allow viewing of full size pic by anonymous', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke		
array(
'Number of days between being able to vote on the same image','keep_votes_time',0), // new in cpg1.2.2c nuke
// 'Pictures and thumbnails settings',
        'Pictures and thumbnails settings',
array(
'Quality for JPEG files', 'jpeg_qual', 0),
array(
'Max dimension of a thumbnail <strong>*</strong>', 'thumb_width', 0),
array(
'Use dimension ( width or height or Max aspect for thumbnail )<strong>*</strong>', 'thumb_use', 7),
array(
'Create intermediate pictures', 'make_intermediate', 1),
array(
'Max width or height of an intermediate picture <strong>*</strong>', 'picture_width', 0),
array(
'Max size for uploaded pictures (KB)', 'max_upl_size', 0),
array(
'Max width or height for uploaded pictures (pixels)', 'max_upl_width_height', 0),

        'User settings',
array(
'Allow new user registrations', 'allow_user_registration', 1),
array(
'User registration requires email verification', 'reg_requires_valid_email', 1),
array(
'Allow two users to have the same email address', 'allow_duplicate_emails_addr', 1),
array(
'Users can can have private albums', 'allow_private_albums', 1),
array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',

        'Custom fields for image description (leave blank if unused)',
array(
'Field 1 name', 'user_field1_name', 0),
array(
'Field 2 name', 'user_field2_name', 0),
array(
'Field 3 name', 'user_field3_name', 0),
array(
'Field 4 name', 'user_field4_name', 0),

        'Pictures and thumbnails advanced settings',
array(
'Show private album Icon to unlogged user', 'show_private', 1),
array(
'Characters forbidden in filenames', 'forbiden_fname_char', 0),
array(
'Accepted file extensions for uploaded pictures', 'allowed_file_extensions', 0),
array(
'Method for resizing images', 'thumb_method', 2),
array(
'Path to ImageMagick / netpbm \'convert\' utility (example /usr/bin/X11/)', 'impath', 0),
array(
'Allowed image types (only valid for ImageMagick)', 'allowed_img_types', 0),
array(
'Command line options for ImageMagick', 'im_options', 0),
array(
'Read EXIF data in JPEG files', 'read_exif_data', 1),
array(
'Read IPTC data in JPEG files', 'read_iptc_data', 1), // new in cpg1.2.0nuke
array(
'The album directory <strong>*</strong>', 'fullpath', 0),
array(
'The directory for user pictures <strong>*</strong>', 'userpics', 0),
array(
'The prefix for intermediate pictures <strong>*</strong>', 'normal_pfx', 0),
array(
'The prefix for thumbnails <strong>*</strong>', 'thumb_pfx', 0),
array(
'Default mode for directories', 'default_dir_mode', 0),
array(
'Default mode for pictures', 'default_file_mode', 0),
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
        'Cookies &amp; Charset settings',
array(
'Name of the cookie used by the script', 'cookie_name', 0),
array(
'Path of the cookie used by the script', 'cookie_path', 0),
array(
'Character encoding', 'charset', 4),

        'Miscellaneous settings',
array(
'Enable debug mode', 'debug_mode', 1),
array(
'Enable advanced debug mode', 'advanced_debug_mode', 1), // new in cpg1.2.0nuke
array(
'Show Coppermine Update Alert to Admin', 'showupdate', 1), // new 1.2.2
        '<br /><div align="center">(*) Fields marked with * must not be changed if you already have pictures in your gallery</div><br />'
        );
// end left side interpretation
// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //
if (defined('DB_INPUT_PHP')) $lang_db_input_php = array('empty_name_or_com' => 'VocÃª precisa definir um nome para o comentÃ¡rio',
        'com_added' => 'sua conta foi criada',
        'alb_need_title' => 'VocÃª deve definir um nome para o Ã¡lbum !',
        'no_udp_needed' => 'AtualizaÃ§Ã£o nÃ£o necessÃ¡ria.',
        'alb_updated' => 'O Ã¡lbum foi atualizado',
        'unknown_album' => 'O Ã¡lbum selecionado nÃ£o existe ou vocÃª nÃ£o tem permissÃ£o para enviar imagens para ele',
        'no_pic_uploaded' => 'Nenhuma imagem enviada !<br /><br />Se vocÃª realmente selecionaou ima imagem para enviar, verifique se o servidor permite envios...',
        'err_mkdir' => 'Falha ao criar diretÃ³rio %s !',
        'dest_dir_ro' => 'DiretÃ³rio de destino %s nÃ£o pode ser gravado pelo script !',
        'err_move' => 'ImpossÃ­vel mover %s para %s !',
        'err_fsize_too_large' => 'A imagem que vocÃª estÃ¡ tentando enviar Ã© muito grande (mÃ¡ximo permitido %s x %s) !',
        'err_imgsize_too_large' => 'O tamanho da imagem Ã© maior que o permitido (mÃ¡ximo permitido %s KB) !',
        'err_invalid_img' => 'O arquivo que vocÃª estÃ¡ tentando enviar nÃ£o Ã© um arquivo de imagem vÃ¡lido !',
        'allowed_img_types' => 'VocÃª sÃ³ pode enviar %s imagens.',
        'err_insert_pic' => 'A imagem \'%s\' nÃ£o pode ser inserida no Ã¡lbum ',
        'upload_success' => 'Sua imagem foi enviada com sucesso<br /><br />PorÃ©m sÃ³ serÃ¡ visÃ­vel apÃ³s a aprovaÃ§Ã£o do Administrador.',
        'info' => 'InformaÃ§Ã£o',
        'com_added' => 'ComentÃ¡rio adicionado',
        'alb_updated' => 'Ãlbum atualizado',
        'err_comment_empty' => 'Seu comentÃ¡rio estÃ¡ vazio !',
        'err_invalid_fext' => 'Somente os arquivos com as seguines extenÃ§Ãµes sÃ£o permitidos : <br /><br />%s.',
        'no_flood' => 'Desculpe mas vocÃª Ã© o Ãºltimo autor a enviar um comentÃ¡rio<br /><br />Edite o comentÃ¡rio se deseja alterÃ¡-lo',
        'redirect_msg' => 'VocÃª estÃ¡ sendo redirecionado.<br /><br /><br />Clique \'CONTINUE\' se a pÃ¡gina nÃ£o se atualizar automaticamente',
        'upl_success' => 'Sua imagem foi adicionada com sucesso',
        );
// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //
if (defined('DELETE_PHP')) $lang_delete_php = array('caption' => 'Sob-TÃ­tulo',
        'fs_pic' => 'tamanho total da imagem',
        'del_success' => 'removido com sucesso',
        'ns_pic' => 'tamanho normal da imagem',
        'err_del' => 'nÃ£o pode ser escluÃ­do',
        'thumb_pic' => 'miniatura',
        'comment' => 'comentÃ¡rio',
        'im_in_alb' => 'imagem no Ã¡lbum',
        'alb_del_success' => 'Ãlbum \'%s\' REMOVIDO',
        'alb_mgr' => 'Gerenciador de Ã¡lbuns',
        'err_invalid_data' => 'Dados recebidos invÃ¡lidos \'%s\'',
        'create_alb' => 'Criando Ã¡lbuns \'%s\'',
        'update_alb' => 'Atualizando Ã¡lbuns \'%s\' tÃ­tulo \'%s\' Ã­ndice \'%s\'',
        'del_pic' => 'Remover imagem',
        'del_alb' => 'Remover Ã¡lbum',
        'del_user' => 'Remover usuÃ¡rio',
        'err_unknown_user' => 'O usuÃ¡rio selecionado nÃ£o existe !',
        'comment_deleted' => 'O comentÃ¡rio foi removido com sucesso',
        );
// ------------------------------------------------------------------------- //
// File displayecard.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File displayimage.php
// ------------------------------------------------------------------------- //
if (defined('DISPLAYIMAGE_PHP')) {
    $lang_display_image_php = array('confirm_del' => 'Tem certeza de EXCLUIR  esta imagem ? \\nComentÃ¡rios vinculados tambÃ©m serÃ£o excluÃ­dos.',
        'del_pic' => 'DELETE THIS PICTURE',
        'size' => '%s x %s pixels',
        'views' => '%s vezes',
        'slideshow' => 'Slideshow',
        'stop_slideshow' => 'PARAR SLIDESHOW',
        'view_fs' => 'Clique para ver a ampliaÃ§Ã£o da imagem',
        'edit_pic' => 'EDIT PICTURE INFO', // new in cpg1.2.0nuke
        );

    $lang_picinfo = array('title' => 'INFORMAÃ‡Ã•ES DA IMAGEM',
        'Filename' => 'Nome',
        'Album name' => 'Ãlbum',
        'Rating' => 'ClassificaÃ§Ã£o (%s votos)',
        'Keywords' => 'Palavras-chave',
        'File Size' => 'Tamanho do arquivo',
        'Dimensions' => 'DimensÃµes',
        'Displayed' => 'Mostrado',
        'Camera' => 'Camera',
        'Date taken' => 'Data',
        'Aperture' => 'Abertura',
        'Exposure time' => 'Tempo de exposiÃ§Ã£o',
        'Focal length' => 'Largura focal',
        'Comment' => 'ComentÃ¡rio',
        'addFav' => 'Add to Fav',
        'addFavPhrase' => 'Favourites',
        'remFav' => 'Remove from Fav',
        'iptcTitle' => 'IPTC Title', // new in cpg1.2.0nuke
        'iptcCopyright' => 'IPTC Copyright', // new in cpg1.2.0nuke
        'iptcKeywords' => 'IPTC Keywords', // new in cpg1.2.0nuke
        'iptcCategory' => 'IPTC Category', // new in cpg1.2.0nuke
        'iptcSubCategories' => 'IPTC Sub Categories', // new in cpg1.2.0nuke
        'bookmark_page' => 'Bookmark Image', // new in cpg1.2.0nuke
        );

    $lang_display_comments = array('OK' => 'OK',
        'edit_title' => 'Editar este comentÃ¡rio',
        'confirm_delete' => 'Tem certeza de REMOVER este comentÃ¡rio ?',
        'add_your_comment' => 'Adicione seu comentÃ¡rio',
        'name' => 'Name',
        'comment' => 'Comment',
        'your_name' => 'Seu nome',
        );

    $lang_fullsize_popup = array('click_to_close' => 'Click image to close this window',
        );
} 
// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //
if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php = array('title' => 'Send an e-card',
        'invalid_email' => '<strong>Warning</strong> : endereÃ§o eletrÃ´nico invÃ¡lido !',
        'ecard_title' => 'HÃ¡ um e-card %s para vocÃª',
        'view_ecard' => 'Se nÃ£o estiver aparecendo normalmente clique neste link',
        'view_more_pics' => 'Clique aqui para ver mais imagens !',
        'send_success' => 'Seu e-card foi enviado',
        'send_failed' => 'Desculpe, mas o servidor nÃ£o pode enviar seu e-card...',
        'from' => 'Remetente',
        'your_name' => 'Seu nome',
        'your_email' => 'Seu e-amil',
        'to' => 'Para',
        'rcpt_name' => 'DestinatÃ¡rio',
        'rcpt_email' => 'E-mail do destinatÃ¡rio',
        'greetings' => 'SaudaÃ§Ãµes',
        'message' => 'Mensagem',
        );
// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //
if (defined('EDITPICS_PHP')) $lang_editpics_php = array('pic_info' => 'Picture&nbsp;info',
        'album' => 'Ãlbum',
        'title' => 'TÃ­tulo',
        'desc' => 'DescriÃ§Ã£o',
        'keywords' => 'Palavras-chave',
        'pic_info_str' => '%sx%s - %sKB - %s views - %s votes',
        'approve' => 'Aprovar imagem',
        'postpone_app' => 'Postpone approval',
        'del_pic' => 'Apagar imagem',
        'reset_view_count' => 'Zerar contador',
        'reset_votes' => 'Zerar votos',
        'del_comm' => 'Excluir comentÃ¡rios',
        'upl_approval' => 'Aprovar envio',
        'edit_pics' => 'Editar imagens',
        'see_next' => 'Ver prÃ³ximas imagens',
        'see_prev' => 'Ver imagens anteriores',
        'n_pic' => '%s imagens',
        'n_of_pic_to_disp' => 'NÃºmero de imagens a mostrar',
        'apply' => 'Aplicar modificaÃ§Ãµes'
        );
// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //
if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array('group_name' => 'Nome do Grupo',
        'disk_quota' => 'Quota de disco',
        'can_rate' => 'Pode avaliar imagens',
        'can_send_ecards' => 'Pode enviar e-cards',
        'can_post_com' => 'Pode enviar comentÃ¡rios',
        'can_upload' => 'Pode enviar imagens',
        'can_have_gallery' => 'Pode ter uma galeria pessoal',
        'apply' => 'Aplicar modificaÃ§Ãµes',
        'create_new_group' => 'Criar novo grupo',
        'del_groups' => 'Apagar grupo(s) selecionado(s)',
        'confirm_del' => 'CUIDADO: Ao remover um grupo seu conteÃºdo serÃ¡ transferido para \'Registered\' !\n\nquer continuar ?',
        'title' => 'Gerenciar grupos',
        'approval_1' => 'AprovaÃ§Ã£o pÃºblica (1)',
        'approval_2' => 'AaprovaÃ§Ã£o privada (2)',
        'note1' => '<strong>(1)</strong> Envios para um Ã¡lbum pÃºblico requerem aprovaÃ§Ã£o do administrador',
        'note2' => '<strong>(2)</strong> Envios requerem aprovaÃ§Ã£o do administrador',
        'notes' => 'Notas'
        );
// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //
if (defined('INDEX_PHP')) {
    $lang_index_php = array('welcome' => 'Welcome !'
        );

    $lang_album_admin_menu = array('confirm_delete' => 'Tem certeza que deseja EXCLUIR este Ã¡lbum ? \\nTodas as imagens e comentÃ¡rios serÃ£o excluÃ­dos.',
        'delete' => 'EXCLUIR',
        'modify' => 'PROPRIEDADES',
        'edit_pics' => 'EDITAR IMAGENS',
        );

    $lang_list_categories = array('home' => 'Home',
        'stat1' => '<strong>[pictures]</strong> imagens em <strong>[albums]</strong> Ã¡lbuns e <strong>[cat]</strong> categorias com <strong>[comments]</strong> comentÃ¡rios vistos <strong>[views]</strong> vezes',
        'stat2' => '<strong>[pictures]</strong> imagens em <strong>[albums]</strong> Ã¡lbuns vistos <strong>[views]</strong> vezes',
        'xx_s_gallery' => '%s\'s Galeria',
        'stat3' => '<strong>[pictures]</strong> imagens em <strong>[albums]</strong> Ã¡lbuns com <strong>[comments]</strong> comentÃ¡rios vistos <strong>[views]</strong> vezes'
        );

    $lang_list_users = array('user_list' => 'Lista de usuÃ¡rios',
        'no_user_gal' => 'Nenhum usuÃ¡rio permitido a ter Ã¡lbuns',
        'n_albums' => '%s Ã¡lbum(s)',
        'n_pics' => '%s imagem(s)'
        );

    $lang_list_albums = array('n_pictures' => '%s imagem',
        'last_added' => ', Ãºltimo adicionado em %s'
        );
} 
// ------------------------------------------------------------------------- //
// File modifyalb.php
// ------------------------------------------------------------------------- //
if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array('upd_alb_n' => 'Atualizar Ã¡lbum %s',
        'general_settings' => 'ConfiguraÃ§Ãµes gerais',
        'alb_title' => 'TÃ­tulo do Ã¡lbum',
        'alb_cat' => 'Categoria do Ã¡lbum',
        'alb_desc' => 'DescriÃ§Ã£o do Ã¡lbum',
        'alb_thumb' => 'Miniatura do Ã¡lbum',
        'alb_perm' => 'PermissÃµes para este Ã¡lbum',
        'can_view' => 'Ãlbum pode ser visto por',
        'can_upload' => 'Visitantes podem enviar imagens',
        'can_post_comments' => 'Visitantes podem enviar comentÃ¡rios',
        'can_rate' => 'Visitantes podem avaliar imagens',
        'user_gal' => 'Galeria do UsuÃ¡rio',
        'no_cat' => '* Sem categoria *',
        'alb_empty' => 'Ãlbum vazio',
        'last_uploaded' => 'Ãšltimo envio',
        'public_alb' => 'Todos (album pÃºblico)',
        'me_only' => 'Apenas eu',
        'owner_only' => 'ProprietÃ¡rio (%s) apenas',
        'groupp_only' => 'Membros do  grupo\'%s\' ',
        'err_no_alb_to_modify' => 'Nenhum album que vocÃª pode modificar na base de dados .',
        'update' => 'Atualizar Ã¡lbum'
        );
// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //
if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array('already_rated' => 'Desculpe, mas vocÃª ja avaliou esta imagem',
        'rate_ok' => 'Seu voto foi aceito',
        );
// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //
if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {
    $lang_register_disclamer = <<<EOT
While the administrators of {SITE_NAME} will attempt to remove or edit any generally objectionable material as quickly as possible, it is impossible to review every post. Therefore you acknowledge that all posts made to this site express the views and opinions of the author and not the administrators or webmaster (except for posts by these people) and hence will not be held liable.<br />
<br />
You agree not to post any abusive, obscene, vulgar, slanderous, hateful, threatening, sexually-orientated or any other material that may violate any applicable laws. You agree that the webmaster, administrator and moderators of {SITE_NAME} have the right to remove or edit any content at any time should they see fit. As a user you agree to any information you have entered above being stored in a database. While this information will not be disclosed to any third party without your consent the webmaster and administrator cannot be held responsible for any hacking attempt that may lead to the data being compromised.<br />
<br />
This site uses cookies to store information on your local computer. These cookies serve only to improve your viewing pleasure. The email address is used only for confirming your registration details and password.<br />
<br />
By clicking 'I agree' below you agree to be bound by these conditions.
EOT;

    $lang_register_php = array('page_title' => 'REGISTRO DE USUÃRIO',
        'term_cond' => 'Termos e condiÃ§Ãµes',
        'i_agree' => 'Eu Aceito',
        'submit' => 'enviar registro',
        'err_user_exists' => 'Este nome de usuÃ¡rio jÃ¡ existe, por favor crie outro',
        'err_password_mismatch' => 'As duas senhas digitadas nÃ£o conferem. Digite com cuidado novamente',
        'err_uname_short' => 'Nome de usuÃ¡rio precisa ter no mÃ­nimo 2 caracteres',
        'err_password_short' => 'sua senha tem que ter no mÃ­nimo 2 caracteres',
        'err_uname_pass_diff' => 'Nome de usuÃ¡rio e senha devem ser diferentes',
        'err_invalid_email' => 'EndereÃ§o de e-mail invÃ¡lido',
        'err_duplicate_email' => 'JÃ¡ existe outro usuÃ¡rio registrado com este e-mail',
        'enter_info' => 'Entre com as informaÃ§Ãµes de registro',
        'required_info' => 'InformaÃ§Ã£o requerida',
        'optional_info' => 'InformaÃ§Ã£o opcional',
        'username' => 'UsuÃ¡rio',
        'password' => 'Senha',
        'password_again' => 'Repita a senha',
        'email' => 'E-mail',
        'location' => 'EndereÃ§o',
        'interests' => 'Interesses',
        'website' => 'Home page',
        'occupation' => 'ProfissÃ£o',
        'error' => 'ERRO',
        'confirm_email_subject' => '%s - CONFIRMAÃ‡ÃƒO DE REGISTRO',
        'information' => 'InformaÃ§Ã£o',
        'failed_sending_email' => 'O e-mail de confirmaÃ§Ã£o de registro nÃ£o pÃ´de ser enviado !',
        'thank_you' => 'Obrigado pr se registrar.<br /><br />As informaÃ§Ãµes para finalizar seu registro foram enviadas para seu e-mail. Verifique agora ou aguarde uns instantes.',
        'acct_created' => 'Sua conta foi criada. Para acessar o catÃ¡logo vocÃª deve fornecer seu nome de usuÃ¡rio e sua senha',
        'acct_active' => 'Sua conta jÃ¡ estÃ¡ ativa. Entre com seu nome de usuÃ¡rio e senha para acessar os dados do catÃ¡logo',
        'acct_already_act' => 'Sua conta jÃ¡ estÃ¡ ativa !',
        'acct_act_failed' => 'Esta conta nÃ£o estÃ¡ ativa ainda !',
        'err_unk_user' => 'UsuÃ¡rio selecionado nÃ£o existe !',
        'x_s_profile' => '%s\'s profile',
        'group' => 'Grupo',
        'reg_date' => 'PArticipante',
        'disk_usage' => 'Uso do disco',
        'change_pass' => 'Alterar senha',
        'current_pass' => 'Senha atual',
        'new_pass' => 'Nova senha',
        'new_pass_again' => 'Nova senha de novo',
        'err_curr_pass' => 'Senha atual INCORRETA',
        'apply_modif' => 'Aplicar modificaÃ§Ãµes',
        'change_pass' => 'Alterar minha senha',
        'update_success' => 'Seus dados foram atualizadsos',
        'pass_chg_success' => 'Sua senha foi alterada',
        'pass_chg_error' => 'Sua senha nÃ£o foi alterada',
        );

    $lang_register_confirm_email = <<<EOT
Thank you for registering at {SITE_NAME}

Seu nome de usuÃ¡rio Ã© : "{USER_NAME}"
Sua senha Ã© : "{PASSWORD}"

Clique no link abaixo ou copie e cole no seu Browser para acessar nosso catÃ¡logo

{ACT_LINK}

Obrigado pela inscriÃ§Ã£o,

O Administrador
{SITE_NAME}

EOT;
} 
// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //
if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array('title' => 'Revisar comentÃ¡rios',
        'no_comment' => 'NÃ£o hÃ¡ comentÃ¡rios para revisar',
        'n_comm_del' => '%s comentÃ¡rio(s) removido',
        'n_comm_disp' => 'NÃºmero de comentÃ¡rios ',
        'see_prev' => 'Ver anterior',
        'see_next' => 'Ver prÃ³ximo',
        'del_comm' => 'Excluir comentÃ¡rios selecionados',
        );
// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //
// if (defined('SEARCH_PHP'))
    $lang_search_php = array(0 => 'Pesquisar na coleÃ§Ã£o de imagens',
        );
// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //
if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array('page_title' => 'Pesquisar novas imagens',
        'select_dir' => 'Selecionar diretÃ³rio',
        'select_dir_msg' => 'Esta funÃ§Ã£o lhe permite enviar diversas imagens ao mesmo tempo.<br /><br />Selecione o diretÃ³rio das imagens',
        'no_pic_to_add' => 'NÃ£o hÃ¡ imagens para enviar',
        'need_one_album' => 'VocÃª precisater pelo menus um Ã¡lbum para usar esta funÃ§Ã£o',
        'warning' => 'CUIDADO',
        'change_perm' => 'O script nÃ£o pode gravar neste diretÃ³rio que deve possuir permissÃ£o 755 ou 777 !',
        'target_album' => '<strong>Colocar imagens do &quot;</strong>%s<strong>&quot; em </strong>%s',
        'folder' => 'Pasta',
        'image' => 'Imagem',
        'album' => 'Ãlbum',
        'result' => 'Resultado',
        'dir_ro' => 'NÃ£o gravÃ¡vel. ',
        'dir_cant_read' => 'NÃ£o pode ser lido. ',
        'insert' => 'Adicionando novas imagens Ã  galeria',
        'list_new_pic' => 'Lista das novas imagens',
        'insert_selected' => 'Inserir imagens selecionadas',
        'no_pic_found' => 'NÃ£o hÃ¡ imagens novas',
        'be_patient' => 'Por favoe tenha paciÃªncia. O sistema nescessita de tempo para enviar suas imagens',
        'notes' => '<ul>' . '<li><strong>OK</strong> : Significa que foi enviado com sucesso' . '<li><strong>DP</strong> : Significa que existe uma duplicata na base de datos' . '<li><strong>PB</strong> : significa que nÃ£o pÃ´de ser enviado. Verifique suas permissÃµes e corretos endereÃ§os.' . '<li>Se o OK, DP, PB \'signs\' nÃ£o aparecem, clique na imagem com problema para receber a mensagem do erro' . '<li>Se receber mensagem de expiraÃ§Ã£o, acione reload' . '</ul>',
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
if (defined('UPLOAD_PHP')) $lang_upload_php = array('title' => 'envio de imagem',
        'max_fsize' => 'Tamanho mÃ¡ximo permitido %s KB',
        'album' => 'Ãlbum',
        'picture' => 'Imagem',
        'pic_title' => 'TÃ­tulo',
        'description' => 'DescriÃ§Ã£o',
        'keywords' => 'Palavras-chave (separar somente com espaÃ§os)',
        'err_no_alb_uploadables' => 'desculpe. VocÃª nÃ£o estÃ¡ autorizado a enviar para este Ã¡lbum',
        );
// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //
if (defined('USERMGR_PHP')) $lang_usermgr_php = array('title' => 'Gerenciar usuÃ¡rios',
        'name_a' => 'Nome Ascendente',
        'name_d' => 'Nome Descendente',
        'group_a' => 'Grupo Ascendente',
        'group_d' => 'Grupo Descendente',
        'reg_a' => 'Data de registro Ascendente',
        'reg_d' => 'Data de registro Descendente',
        'pic_a' => 'Contagem de imagens ascendente',
        'pic_d' => 'Constagem de imagem descendente',
        'disku_a' => 'Uso de disco ascendente',
        'disku_d' => 'Uso de disco descendente',
        'sort_by' => 'Listar usuÃ¡rios por',
        'err_no_users' => 'Tabela de usuÃ¡rios estÃ¡ vazia !',
        'err_edit_self' => 'VocÃª nÃ£o pode alterar os dados \'My profile\' ',
        'edit' => 'EDITAR',
        'delete' => 'EXCLUIR',
        'name' => 'UsuÃ¡rio',
        'group' => 'Grupo',
        'inactive' => 'Inativo',
        'operations' => 'OperaÃ§Ãµes',
        'pictures' => 'Imagens',
        'disk_space' => 'EspaÃ§o usado / Quota',
        'registered_on' => 'Registrado on',
        'u_user_on_p_pages' => '%d usuÃ¡rios em %d pÃ¡gina(s)',
        'confirm_del' => 'Tem certeza que quer EXCLUIR este usuÃ¡rio ? \\nTodas as imagens e Ã¡lbuns dele serÃ£o removidas.',
        'mail' => 'MAIL',
        'err_unknown_user' => 'UsuÃ¡rio selecionado nÃ£o existe !',
        'modify_user' => 'Modificar usuÃ¡rio',
        'notes' => 'Notas',
        'note_list' => '<li>Se vocÃª nÃ£o quer alterar sua senha, deixe o campo em branco',
        'password' => 'Senha',
        'user_active' => 'UsuÃ¡rio Ã© ativo',
        'user_group' => 'GBrupo de usuÃ¡rios',
        'user_email' => 'E-mail do usuÃ¡rio',
        'user_web_site' => 'Site do usuÃ¡rio',
        'create_new_user' => 'Criar novo usuÃ¡rio',
        'user_from' => 'EndereÃ§o',
        'user_interests' => 'Interesse',
        'user_occ' => 'OcupaÃ§Ã£o',
        );
// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //
if (defined('UTIL_PHP')) $lang_util_php = array('title' => 'Resize pictures',
        'what_it_does' => 'What it does',
        'what_update_titles' => 'Updates titles from filename',
        'what_delete_title' => 'Deletes titles',
        'what_rebuild' => 'Rebuilds thumbnails and resized photos',
        'what_delete_originals' => 'Deletes original sized photos replacing them with the sized version',
        'file' => 'File',
        'title_set_to' => 'title set to',
        'submit_form' => 'submit',
        'updated_succesfully' => 'updated succesfully',
        'error_create' => 'ERROR creating',
        'continue' => 'Process more images',
        'main_success' => 'The file %s was successfully used as main picture',
        'error_rename' => 'Error renaming %s to %s',
        'error_not_found' => 'The file %s was not found',
        'back' => 'back to main',
        'thumbs_wait' => 'Updating thumbnails and/or resized images, please wait...',
        'thumbs_continue_wait' => 'Continuing to update thumbnails and/or resized images...',
        'titles_wait' => 'Updating titles, please wait...',
        'delete_wait' => 'Deleting titles, please wait...',
        'replace_wait' => 'Deleting originals and replacing them with resized images, please wait..',
        'instruction' => 'Quick instructions',
        'instruction_action' => 'Select action',
        'instruction_parameter' => 'Set parameters',
        'instruction_album' => 'Select album',
        'instruction_press' => 'Press %s',
        'update' => 'Update thumbs and/or resized photos',
        'update_what' => 'What should be updated',
        'update_thumb' => 'Only thumbnails',
        'update_pic' => 'Only resized pictures',
        'update_both' => 'Both thumbnails and resized pictures',
        'update_number' => 'Number of processed images per click',
        'update_option' => '(Try setting this option lower if you experience timeout problems)',
        'filename_title' => 'Filename ? Picture title',
        'filename_how' => 'How should the filename be modified',
        'filename_remove' => 'Remove the .jpg ending and replace _ (underscore) with spaces',
        'filename_euro' => 'Change 2003_11_23_13_20_20.jpg to 23/11/2003 13:20',
        'filename_us' => 'Change 2003_11_23_13_20_20.jpg to 11/23/2003 13:20',
        'filename_time' => 'Change 2003_11_23_13_20_20.jpg to 13:20',
        'delete' => 'Delete picture titles or original size photos',
        'delete_title' => 'Delete picture titles',
        'delete_original' => 'Delete original size photos',
        'delete_replace' => 'Deletes the original images replacing them with the sized versions',
        'select_album' => 'Select album',
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