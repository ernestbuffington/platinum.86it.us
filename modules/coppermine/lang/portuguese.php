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
define('PIC_VIEWS', 'Views');
define('PIC_VOTES', 'Votes');
define('PIC_COMMENTS', 'Comments');

// info about translators and translated language
$lang_translation_info = array(
    'lang_name_english' => 'Portuguese', // the name of your language in English, e.g. 'Greek' or 'Spanish'
    'lang_name_native' => 'Portugu&ecirc;s', // the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol'
    'lang_country_code' => 'pt', // the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
    'trans_name' => 'Luis Rebelo (lineartube)', // the name of the translator - can be a nickname
    'trans_email' => 'coppermine@luisrebelo.net', // translator's email address (optional)
    'trans_website' => 'http://www.luisrebelo.net/', // translator's website (optional)
    'trans_date' => '2003-10-21', // the date the translation was created / last modified
    );

$lang_charset = 'ISO-8859-1';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');
// Day of weeks and months
$lang_day_of_week = array('Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab');
$lang_month = array('Jan', 'Feb', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez');
// Some common strings
$lang_yes = 'Sim';
$lang_no = 'N�o';
$lang_back = 'ATR�S';
$lang_continue = 'CONTINUAR';
$lang_info = 'Informa��o';
$lang_error = 'Erro';
// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt = '%d de %B de %Y';
$lastcom_date_fmt = '%d/%m/%y �s %H:%M';
$lastup_date_fmt = '%d de %B de %Y';
$register_date_fmt = '%d de %B de %Y';
$lasthit_date_fmt = '%d de %B de %Y �s %I:%M %p';
$comment_date_fmt = '%d de %B de %Y �s %I:%M %p';
// For the word censor
$lang_bad_words = array('foda-se', 'cara de cu', 'paneleiro', 'puta', 'caralho', 'cona', 'picha', 'merda', 'penis', 'mamas');

$lang_meta_album_names = array('random' => 'Fotos aleat�rias',
    'lastup' => '�ltimas fotos',
    'lastupby' => 'My Last Additions', // new 1.2.2
    'lastalb' => 'Last updated albums',
    'lastcom' => '�ltimos coment�rios',
    'lastcomby' => 'My Last comments', // new 1.2.2
    'topn' => 'Mais vistas',
    'toprated' => 'Melhor Classificadas',
    'lasthits' => '�ltimas vistas',
    'search' => 'Resultado da procura',
    'favpics' => 'Fotos favoritas',

    );

$lang_errors = array('access_denied' => 'N�o tem permiss�o para aceder a esta p�gina.',
    'perm_denied' => 'N�o tem permiss�o para efectuar esta opera��o.',
    'param_missing' => 'Chamada do Script sem os parametros requeridos.',
    'non_exist_ap' => 'O(A) album/foto seleccionado(a) n�o existe!',
    'quota_exceeded' => 'Quota de disco excedida<br /><br />Tem uma quota de disco de [quota]K, as suas fotos actualmente ocupam [space]K, e atendendo a esta foto exceder�as a quota.',
    'gd_file_type_err' => 'Quando se usa a biblioteca de imagem GD s�o permitidos somente os tipos JPEG e PNG.',
    'invalid_image' => 'A imagem que enviou est� corrompida ou n�o pode ser tratada pela biblioteca GD.',
    'resize_failed' => 'Incapaz de criar thumbnail ou imagem de tamanho reduzido.',
    'no_img_to_display' => 'Nenhuma imagem para mostrar.',
    'non_exist_cat' => 'A categoria seleccionada n�o existe.',
    'orphan_cat' => 'Uma categoria n�o tem parente. Execute a op��o "Categorias" para corrigir este problema.',
    'directory_ro' => 'O direct�rio \'%s\' n�o tem permiss�es de escrita, e por isso as fotos n�o podem ser apagadas.',
    'non_exist_comment' => 'O coment�rio seleccionado n�o existe.',
    'pic_in_invalid_album' => '¿¡A foto est� num album que n�o existe (%s)!?',
    'banned' => 'Voc� encontra-se banido de utilizar este website.',

    'not_with_udb' => 'esta fun��o est� desactivada no Coppermine porque est� integrada no software do forum. Ou o que est� a tentar fazer n�o � suportado nesta configura��o ou a fun��o deveria ser lidada pelo o software do forum.',

    'members_only' => 'This function is for members only, please join.', // changed in cpg1.2.0nuke
    'mustbe_god' => 'This function is only for the site admin. You must be logged in as superadmin, god account to access this function'
    );
// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //
$lang_main_menu = array('alb_list_title' => 'Ir para a lista de albuns',
    'alb_list_lnk' => 'Lista de albuns',
    'my_gal_title' => 'Ir para galeria pessoal',
    'my_gal_lnk' => 'A minha galeria',
    'my_prof_lnk' => 'O meu perfil de utilizador',
    'adm_mode_title' => 'Ir para modo administrador',
    'adm_mode_lnk' => 'Modo administrador',
    'usr_mode_title' => 'Ir para modo utilizador',
    'usr_mode_lnk' => 'Modo utilizador',
    'upload_pic_title' => 'Inserir foto num album',
    'upload_pic_lnk' => 'Inserir foto',
    'register_title' => 'Criar um utilizador',
    'register_lnk' => 'Registar-se',
    'login_lnk' => 'Login',
    'logout_lnk' => 'Logout',
    'lastup_lnk' => '�ltimas fotos',
    'lastcom_lnk' => '�ltimos coment�rios',
    'topn_lnk' => 'Mais vistas',
    'toprated_lnk' => 'Melhor Classificadas',
    'search_lnk' => 'Procurar',
    'fav_lnk' => 'Favoritas',

    );

$lang_gallery_admin_menu = array('upl_app_lnk' => 'Aprovar Uploads',
    'config_lnk' => 'Configura��o',
    'albums_lnk' => '�lbuns',
    'categories_lnk' => 'Categorias',
    'users_lnk' => 'Utilizadores',
    'groups_lnk' => 'Grupos',
    'comments_lnk' => 'Coment�rios',
    'searchnew_lnk' => 'Adicionar fotos (em s�rie)',
    'util_lnk' => 'Redimensionar imagens',

    'ban_lnk' => 'Banir utilizadores',

    );

$lang_user_admin_menu = array('albmgr_lnk' => 'Criar / ordenar �lbuns',
    'modifyalb_lnk' => 'Modificar meus �lbuns',
    'my_prof_lnk' => 'O meu perfil de utilizador',
    );

$lang_cat_list = array('category' => 'Categoria',
    'albums' => '�lbuns',
    'pictures' => 'Fotos',
    );

$lang_album_list = array('album_on_page' => '%d �lbuns na(s) %d p�gina(s)'
    );

$lang_thumb_view = array('date' => 'DATA',
    'name' => 'NOME',

    'title' => 'T�TULO',

    'sort_da' => 'Ordenado por data ascendente',
    'sort_dd' => 'Ordenado por data descendente',
    'sort_na' => 'Ordenado por nome ascendente',
    'sort_nd' => 'Ordenado por nome descendente',
    'sort_ta' => 'Ordenado por t�tulo ascendente',

    'sort_td' => 'Ordenado por t�tulo descendente',

    'pic_on_page' => '%d foto(s) na(s) %d p�gina(s)',
    'user_on_page' => '%d utilizadore(s) na(s) %d p�gina(s)',
    'sort_ra' => 'Sort by rating ascending', // new in cpg1.2.0nuke
    'sort_rd' => 'Sort by rating descending', // new in cpg1.2.0nuke
    'rating' => 'RATING', // new in cpg1.2.0nuke
    'sort_title' => 'Sort pictures by:', // new in cpg1.2.0nuke
    );

$lang_img_nav_bar = array('thumb_title' => 'Voltar ao �ndice do �lbum',
    'pic_info_title' => 'Mostrar/ocultar informa��o da foto',
    'slideshow_title' => 'Slideshow',
    'slideshow_disabled' => 'e-cards are disabled', // new in cpg1.2.0nuke
    'slideshow_disabled_msg' => $lang_errors['members_only'], // new in cpg1.2.0nuke
    'ecard_title' => 'Enviar esta foto a um amigo',
    'ecard_disabled' => 'Envio de fotos desativado',
    'ecard_disabled_msg' => 'N�o tem permiss�o para enviar fotos',
    'prev_title' => 'Ver foto anterior',
    'next_title' => 'Ver foto siguinte',
    'pic_pos' => 'FOTO %s/%s',
    'no_more_images' => 'There are no more images in this galley', // new in cpg1.2.0nuke
    'no_less_images' => 'This is the first image in the gallery', // new in cpg1.2.0nuke
    );

$lang_rate_pic = array('rate_this_pic' => 'Classificar esta foto ',
    'no_votes' => '(N�o h� votos)',
    'rating' => '(Nota actual : %s / 5 com %s votos)',
    'rubbish' => 'Muito Fraca',
    'poor' => 'Fraca',
    'fair' => 'Normal',
    'good' => 'Boa',
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
    'file' => 'Ficheiro: ',
    'line' => 'Linha: ',
    );

$lang_display_thumbnails = array('filename' => 'Ficheiro: ',
    'filesize' => 'Tamanho: ',
    'dimensions' => 'Dimens�es: ',
    'date_added' => 'Adicionado em: '
    );

$lang_get_pic_data = array('n_comments' => '%s coment�rios',
    'n_views' => '%s vezes vista',
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
if (defined('SMILIES_PHP')) $lang_smilies_inc_php = array('Exclamation' => 'Exclama��o',
        'Question' => 'Quest�o',
        'Very Happy' => 'Muito Contente',
        'Smile' => 'Sorriso',
        'Sad' => 'Triste',
        'Surprised' => 'Surpreendido',
        'Shocked' => 'Chocado',
        'Confused' => 'Confuso',
        'Cool' => 'Cool',
        'Laughing' => 'A rir',
        'Mad' => 'Louco',
        'Razz' => 'Razz',
        'Embarassed' => 'Embara�ado',
        'Crying or Very sad' => 'Muito triste',
        'Evil or Very Mad' => 'Mau',
        'Twisted Evil' => 'Muito Mau',
        'Rolling Eyes' => 'Enojado',
        'Wink' => 'Piscar o olho',
        'Idea' => 'Ideia',
        'Arrow' => 'Seta',
        'Neutral' => 'Neutro',
        'Mr. Green' => 'Sr. Verde',
        );
// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //
// void
// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //
if (defined('ADMIN_PHP')) $lang_admin_php = array(0 => 'A sair do modo administrador...',
        1 => 'A entrar no modo administrador...',
        );
// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //
if (defined('ALBMGR_PHP')) $lang_albmgr_php = array('alb_need_name' => 'Os �lbuns deven ter um nome!',
        'confirm_modifs' => 'Tem a certeza que quer efectuar estas altera��es?',
        'no_change' => 'N�o foi efectuada nenhuma altera��o!',
        'new_album' => 'Novo �lbum',
        'confirm_delete1' => 'Tem a certeza que quer apagar este �lbum?',
        'confirm_delete2' => 'Todas as fotos e coment�rios ir�o perder-se!',
        'select_first' => 'Selecione primeiro um �lbum',
        'alb_mrg' => 'Administrador de Albuns',
        'my_gallery' => '* Minha galeria *',
        'no_category' => '* Sem categoria *',
        'delete' => 'Apagar',
        'new' => 'Novo',
        'apply_modifs' => 'Aplicar modifica��es',
        'select_category' => 'Seleccionar categoria',
        );
// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) $lang_catmgr_php = array('miss_param' => 'Os par�metros requeridos para a opera��o : \'%s\' n�o foram fornecidos!',
        'unknown_cat' => 'A categoria seleccionada n�o existe na base de dados',
        'usergal_cat_ro' => 'As categorias de galerias de utilizador n�o podem ser apagadas!',
        'manage_cat' => 'Gestor de categorias',
        'confirm_delete' => 'Tem a certeza que quer apagar esta categoria',
        'category' => 'Categoria',
        'operations' => 'Opera��es',
        'move_into' => 'Mover para',
        'update_create' => 'Modificar/Criar categoria',
        'parent_cat' => 'Categoria parente',
        'cat_title' => 'T�tulo da categoria',
        'cat_desc' => 'Descri��o da categoria'
        );
// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //
if (defined('CONFIG_PHP')) $lang_config_php = array('title' => 'Configura��o',
        'restore_cfg' => 'Restaurar valores por defeito',
        'save_cfg' => 'Guardar a nova configura��o',
        'notes' => 'Notas',
        'info' => 'Informa��o',
        'upd_success' => 'A configura��o da Coppermine foi actualizada',
        'restore_success' => 'Valores por defeito da Coppermine restaurados',
        'name_a' => 'Ascendente por nome',
        'name_d' => 'Descendente por nome',
        'title_a' => 'Ascendente por t�tulo',

        'title_d' => 'Descendente por t�tulo',

        'date_a' => 'Ascendente por data',
        'date_d' => 'Descendente por data',
        'rating_a' => 'Rating ascending', // new in cpg1.2.0nuke
        'rating_d' => 'Rating descending', // new in cpg1.2.0nuke
        'th_any' => 'Max Aspect',
        'th_ht' => 'Height',
        'th_wd' => 'Width',
        );
// start left side interpretation
if (defined('CONFIG_PHP'))
    $lang_config_data = array(
        // General settings
        'Par�metros Gerais',
        array(
            'Nome da galeria', 'gallery_name', 0),
        array(
            'Descri��o da galeria', 'gallery_description', 0),
        array(
            'Correio electr�nico do administrador', 'gallery_admin_email', 0),
        array(
            'Address to nuke folder ie http://www.mysite.tld/html/', 'ecards_more_pic_target', 0), // new in cpg1.2.0nuke
        array(
            'Linguagem', 'lang', 5),
// for postnuke change
        array('Tema (aspecto)', 'cpgtheme', 6),
        array(
            'Page Specific Titles instead of >Coppermine', 'nice_titles', 1), 
        array('Show blocks on the right', 'right_blocks', 1), // new 1.2.2
        // 'Album list view',
        'Aspecto da lista de �lbuns',
        array(
            'Largura da tabela principal (pixels o %)', 'main_table_width', 0),
        array(
            'N�mero de n�veis de categorias a mostrar', 'subcat_level', 0),
        array(
            'N�mero de �lbuns a mostrar', 'albums_per_page', 0),
        array(
            'N�mero de colunas na lista de �lbuns', 'album_list_cols', 0),
        array(
            'Tamanho dos thumbnails em pixeis', 'alb_list_thumb_size', 0),
        array(
            'Conte�do da p�gina principal', 'main_page_layout', 0),
        array(
            'Mostrar thumbnails de primeiro n�vel nas categorias', 'first_level', 1), 
        // 'Thumbnail view',
        'Aspecto da vista de Thumbnails',
        array(
            'N�mero de colunas na p�gina de thumbnails', 'thumbcols', 0),
        array(
            'N�mero de linha na p�gina de thumbnails', 'thumbrows', 0),
        array(
            'M�ximo n�mero de tabs a mostrar', 'max_tabs', 0),
        array(
            'Mostrar captura de imagem (al�m do t�tulo) debaixo do thumbnail', 'caption_in_thumbview', 1),
        array(
            'Mostrar o n�mero de coment�rios por debaixo do thumbnail', 'display_comment_count', 1),
        array(
            'Ordem por defeito das fotos', 'default_sort_order', 3),
        array(
            'M�nimo n�mero de votos para que uma foto apare�a na lista das mais votadas', 'min_votes_for_rating', 0),
        array(
            'Alts and title tags of thumbnail show title and keyword instead of picinfo', 'seo_alts', 1), // new in cpg1.2.0nuke
        // 'Image view &amp; Comment settings',
        'Vista da foto e Configura��o de coment�rios',
        array(
            'Largura da tabela onde mostra a foto (pixels ou %)', 'picture_table_width', 0),
        array(
            'Informa��o da foto vis�vel por defeito', 'display_pic_info', 1),
        array(
            'Filtrar palavras impr�prias nos coment�rios', 'filter_bad_words', 1),
        array(
            'Permitir Emoticons nos coment�rios', 'enable_smilies', 1),
        array(
            'Allow several consecutive comments on one pic from the same user', 'disable_flood_protection', 1), // new in cpg1.2.0nuke
        array(
            'Email site admin upon comment submission' , 'comment_email_notification', 1), // new in cpg1.2.0nuke
        array(
            'Tamanho m�ximo da descri��o de uma foto', 'max_img_desc_length', 0),
        array(
            'N�mero m�ximo de caracteres numa palavra', 'max_com_wlength', 0),
        array(
            'N�mero m�ximo de linhas num coment�rio', 'max_com_lines', 0),
        array(
            'Tamanho m�ximo de um coment�rio', 'max_com_size', 0),
        array(
            'Mostrar pel�cula de filme', 'display_film_strip', 1),

        array(
            'n�mero de items na pel�cula de filme', 'max_film_strip_items', 0),
        array(
            'Allow viewing of full size pic by anonymous', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke
        array('Number of days between being able to vote on the same image','keep_votes_time',0), // new in cpg1.2.2c nuke
//'Pictures and thumbnails settings',
        'Configura��o das fotos e thumbnails',
        array(
            'Qualidade dos ficheros JPEG <strong>*</strong>', 'jpeg_qual', 0),
        array(
            'Dimens�o m�xima de um thumbnail <strong>*</strong>', 'thumb_width', 0),

        array(
            'Usar dimens�o ( largura, altura ou aspecto m�ximo para o thumbnail )', 'thumb_use', 7),

        array(
            'Criar fotos de tamanho interm�dio', 'make_intermediate', 1),
        array(
            'Largura m�xima das fotos de tamanho interm�dio <strong>*</strong>', 'picture_width', 0),
        array(
            'Tamanho m�ximo das fotos de utilizadores por upload (KB)', 'max_upl_size', 0),
        array(
            'Dimens�es m�ximas das fotos de utilizadores por upload (pixeis)', 'max_upl_width_height', 0), 
        // 'User settings',
        'Configura��o de utilizadores',
        array(
            'Permitir o registo de novos utilizadores', 'allow_user_registration', 1),
        array(
            'Registo de utilizadores requer verifica��o de e-mail', 'reg_requires_valid_email', 1),
        array(
            'Permitir a dois utilizadores terem o mesmo e-mail', 'allow_duplicate_emails_addr', 1),
        array(
            'Os utilizadores poden ter �lbuns privados', 'allow_private_albums', 1), 
        array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',
        'Campos extra para descri��o de fotos (dejar en blanco si no los usas)',
        array(
            'Nome do campo 1', 'user_field1_name', 0),
        array(
            'Nome do campo 2', 'user_field2_name', 0),
        array(
            'Nome do campo 3', 'user_field3_name', 0),
        array(
            'Nome do campo 4', 'user_field4_name', 0), 
        // 'Pictures and thumbnails advanced settings',
        'Configura��o avan�ada de fotos e thumbnails',
        array(
            'Mostrar icon de album privado ao utilzador n�o-registado', 'show_private', 1),

        array(
            'Caracteres pro�bidos nos nomes das fotos', 'forbiden_fname_char', 0),
        array(
            'Exten��es de ficheiros admitidas nos uploads', 'allowed_file_extensions', 0),
        array(
            'M�todo para organiza��o das fotos', 'thumb_method', 2),
        array(
            'caminho da ferramenta ImageMagick (por exemplo /usr/bin/X11/)', 'impath', 0),
        array(
            'Tipos de ficheiros admitidos (v�lidos somente com a ImageMagick)', 'allowed_img_types', 0),
        array(
            'Comandos de linha para a ImageMagick', 'im_options', 0),
        array(
            'Ler dados EXIF em ficheiros do tipo JPEG', 'read_exif_data', 1),
        array(
            'Read IPTC data in JPEG files', 'read_iptc_data', 1), // new in cpg1.2.0nuke
        array(
            'Direct�rio base dos �lbuns <strong>*</strong>', 'fullpath', 0),
        array(
            'Direct�rio para as fotos submetidas pelos usu�rios <strong>*</strong>', 'userpics', 0),
        array(
            'Prefixo para as fotos de tamanho interm�dio <strong>*</strong>', 'normal_pfx', 0),
        array(
            'Prefixo para os thumbnails <strong>*</strong>', 'thumb_pfx', 0),
        array(
            'Permiss�es por defeito dos direct�rios', 'default_dir_mode', 0),
        array(
            'Permiss�es por defeito para as fotos', 'default_file_mode', 0),
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
        'Configura��o de cookies e Conjunto de Caracteres',
        array(
            'Nome dos cookies usados pelo script', 'cookie_name', 0),
        array(
            'Caminho dos cookies usados pelo script', 'cookie_path', 0),
        array(
            'Conjunto de caracteres', 'charset', 4), 
        // 'Miscellaneous settings',
        'Outras Configura��es',
        array(
            'Activar modo debug', 'debug_mode', 1),
        array(
'Enable advanced debug mode', 'advanced_debug_mode', 1), // new in cpg1.2.0nuke
array(
'Show Coppermine Update Alert to Admin', 'showupdate', 1), // new 1.2.2
        '<br /><div align="center">(*) Os campos marcados com * n�o devem ser substitu�dos se j� existem fotos nas galeri�as</div><br />'
        );
// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //
if (defined('DB_INPUT_PHP')) $lang_db_input_php = array('empty_name_or_com' => 'Tem de inserir o seu nome e um coment�rio',
        'com_added' => 'O seu coment�rio foi adicionado',
        'alb_need_title' => 'Tem de introduzir um t�tulo para o album!',
        'no_udp_needed' => 'N�o � necess�ria nenhuma altera��o',
        'alb_updated' => 'O album foi actualizado',
        'unknown_album' => 'O album seleccionado n�o existe ou n�o tem permiss�o para adicionar fotos neste album',
        'no_pic_uploaded' => 'Nenhuma foto foi adicionada!<br /><br />Se seleccionou uma foto para adicionar, verifique se o servidor admite o upload de ficheiros...',
        'err_mkdir' => 'Erro ao criar o(s) direct�rio(s)!',
        'dest_dir_ro' => 'O(s) direct�rio(s) destino n�o tem permiss�es de escrita!',
        'err_move' => 'Imposs�vel mover %s a %s !',
        'err_fsize_too_large' => 'O tamanho da foto que quer inserir � demasiado grande (o m�ximo permitido � de %s x %s)',
        'err_imgsize_too_large' => 'O tamanho do ficheiro da foto que quer inserir � demasiado grande (o m�ximo permitido � de %s KB)',
        'err_invalid_img' => 'O ficheiro que quer inserir n�o � uma imagem v�lida',
        'allowed_img_types' => 'Pode inserir somente %s fotos.',
        'err_insert_pic' => 'A foto \'%s\' n�o pode ser inserida no album ',
        'upload_success' => 'A foto foi inserida correctamente<br /><br />Ser� vis�vel logo que aprovada pelos administradores.',
        'info' => 'Informa��o',
        'com_added' => 'Coment�rio adicionado',
        'alb_updated' => 'Album actualizado',
        'err_comment_empty' => 'O coment�rio est� vazio!',
        'err_invalid_fext' => 'Somente s�o admitidas fotos com as seguintes extens�es : <br /><br />%s.',
        'no_flood' => 'Desculpe mas � o autor/a do �ltimo coment�rio introduzido para esta foto<br /><br />Pode editar o coment�rio para modific�-lo',
        'redirect_msg' => 'Est� a ser redireccionado.<br /><br /><br />Prima \'CONTINUAR\' se a p�gina n�o se actualizar autom�ticamente',
        'upl_success' => 'A foto foi adicionada correctamente',
        );
// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //
if (defined('DELETE_PHP')) $lang_delete_php = array('caption' => 'Descri��o',
        'fs_pic' => 'Foto em tamanho completo',
        'del_success' => 'Apagada',
        'ns_pic' => 'Foto em tamanho normal',
        'err_del' => 'N�o pode ser apagado',
        'thumb_pic' => 'Thumbnail',
        'comment' => 'Coment�rio',
        'im_in_alb' => 'Fotos no album',
        'alb_del_success' => 'Album \'%s\' apagado',
        'alb_mgr' => 'Gestor de albums',
        'err_invalid_data' => 'Dados inv�lidos recebidos em \'%s\'',
        'create_alb' => 'Criando o album \'%s\'',
        'update_alb' => 'Actualizando album \'%s\' com o t�tulo \'%s\' e o ind�ce \'%s\'',
        'del_pic' => 'Apagar foto',
        'del_alb' => 'Apagar album',
        'del_user' => 'Apagar utilizador',
        'err_unknown_user' => 'O utilizador seleccionado n�o existe!',
        'comment_deleted' => 'O coment�rio foi apagado',
        );
// ------------------------------------------------------------------------- //
// File displayecard.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File displayimage.php
// ------------------------------------------------------------------------- //
if (defined('DISPLAYIMAGE_PHP')) {
    $lang_display_image_php = array('confirm_del' => 'Tem a certeza que quer apagar esta foto? \\n Os coment�rios ser�o tamb�m apagados.',
        'del_pic' => 'APAGAR ESTA FOTO',
        'size' => '%s x %s pixeis',
        'views' => '%s visualiza��es',
        'slideshow' => 'Slideshow',
        'stop_slideshow' => 'PARAR SLIDESHOW',
        'view_fs' => 'Clique aqui para ver a imagem em tamanho completo',
        'edit_pic' => 'EDIT PICTURE INFO', // new in cpg1.2.0nuke
        );

    $lang_picinfo = array('title' => 'Informa��o da foto',
        'Filename' => 'Nome do ficheiro',
        'Album name' => 'Nome do album',
        'Rating' => 'Nota (%s votos)',
        'Keywords' => 'Palavras chave',
        'File Size' => 'Tamanho do ficheiro',
        'Dimensions' => 'Dimens�es',
        'Displayed' => 'Visualizado',
        'Camera' => 'Camera',
        'Date taken' => 'Data da foto',
        'Aperture' => 'Abertura',
        'Exposure time' => 'Tempo de exposi��o',
        'Focal length' => 'Dist�ncia Focal ',
        'Comment' => 'Coment�rio',
        'addFav' => 'Adicionar aos favoritos',

        'addFavPhrase' => 'Favoritos',

        'remFav' => 'Remover dos favoritos',

        'iptcTitle' => 'IPTC Title', // new in cpg1.2.0nuke
        'iptcCopyright' => 'IPTC Copyright', // new in cpg1.2.0nuke
        'iptcKeywords' => 'IPTC Keywords', // new in cpg1.2.0nuke
        'iptcCategory' => 'IPTC Category', // new in cpg1.2.0nuke
        'iptcSubCategories' => 'IPTC Sub Categories', // new in cpg1.2.0nuke
        'bookmark_page' => 'Bookmark Image', // new in cpg1.2.0nuke
        );

    $lang_display_comments = array('OK' => 'OK',
        'edit_title' => 'Editar o coment�rio',
        'confirm_delete' => 'Tem a certeza que quer apagar o coment�rio?',
        'add_your_comment' => 'Adicionar um coment�rio',
        'name' => 'Nome',

        'comment' => 'Coment�rio',

        'your_name' => 'Nome',
        );

    $lang_fullsize_popup = array('click_to_close' => 'Clique na imagem para fechar a janela',

        );
} 
// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //
if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php = array('title' => 'Enviar foto a um amigo',
        'invalid_email' => '<strong>Aten��o</strong> : Endere�o e-mail incorrecto!',
        'ecard_title' => 'Uma foto de %s para si',
        'view_ecard' => 'Se a foto n�o for vis�vel, click neste link',
        'view_more_pics' => 'Clique aqui para ver mais fotos!',
        'send_success' => 'A foto foi enviada',
        'send_failed' => 'O servidor n�o conseguiu enviar esta foto...',
        'from' => 'De',
        'your_name' => 'Nome',
        'your_email' => 'Endere�o de e-mail',
        'to' => 'Para',
        'rcpt_name' => 'Nome da pessoa de destino',
        'rcpt_email' => 'Endere�o de e-mail de destino',
        'greetings' => 'T�tulo da mensagem',
        'message' => 'Mensagem',
        );
// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //
if (defined('EDITPICS_PHP')) $lang_editpics_php = array('pic_info' => 'Informa��o',
        'album' => 'Album',
        'title' => 'T�tulo',
        'desc' => 'Descri��o',
        'keywords' => 'Palavras chave',
        'pic_info_str' => '%sx%s - %sKB - %s vezes visualizada - %s votos',
        'approve' => 'Aprovar a foto',
        'postpone_app' => 'Enviar aprova��o da foto',
        'del_pic' => 'Apagar foto',
        'reset_view_count' => 'P�r a zero o contador de vizualiza��es',
        'reset_votes' => 'P�r a zero os votos',
        'del_comm' => 'Apagar coment�rios',
        'upl_approval' => 'Aprovar uploads',
        'edit_pics' => 'Editar fotos',
        'see_next' => 'Ir para as fotos seguintes',
        'see_prev' => 'If para as fotos anteriores',
        'n_pic' => '%s foto/s',
        'n_of_pic_to_disp' => 'N�mero de fotos a mostrar',
        'apply' => 'Validar as altera��es'
        );
// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //
if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array('group_name' => 'Nome do grupo',
        'disk_quota' => 'Quota de disco',
        'can_rate' => 'Podem classificar fotos',
        'can_send_ecards' => 'Podem enviar e-cards',
        'can_post_com' => 'Podem colocar coment�rios',
        'can_upload' => 'Podem enviar fotos',
        'can_have_gallery' => 'Podem ter galerias pessoais',
        'apply' => 'Validar as altera��es',
        'create_new_group' => 'Criar um grupo novo',
        'del_groups' => 'Apagar o/os grupo(s) seleccionados',
        'confirm_del' => 'Aten��o, quando apaga um grupo, os utilizadores que pertemcem a esse grupo ser�o transferidos ao grupo \'Registered\'!\n\n Deseja continuar?',
        'title' => 'Configurar grupos de utilizadores',
        'approval_1' => 'Aprova��o album p�blico (1)',
        'approval_2' => 'Aprova��o album privado (2)',
        'note1' => '<strong>(1)</strong> Adicionar fotos a um album p�blico requer aprova��o dos administradores',
        'note2' => '<strong>(2)</strong> Adicionar fotos a um album que pertence ao utilizador requer aprova��o dos administradores',
        'notes' => 'Notas'
        );
// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //
if (defined('INDEX_PHP')) {
    $lang_index_php = array('welcome' => 'Bem vindo!'
        );

    $lang_album_admin_menu = array('confirm_delete' => 'Tem a certeza que quer apagar este album \\nTodas as fotos e coment�rios ser�o tamb�m apagados.',
        'delete' => 'APAGAR',
        'modify' => 'MODIFICAR',
        'edit_pics' => 'EDITAR FOTOS',
        );

    $lang_list_categories = array('home' => 'P�gina Inicial',
        'stat1' => '<strong>[pictures]</strong> fotos em <strong>[albums]</strong> albuns e <strong>[cat]</strong> categorias com <strong>[comments]</strong> coment�rios, visualizadas <strong>[views]</strong> vezes',
        'stat2' => '<strong>[pictures]</strong> fotos em <strong>[albums]</strong> albuns, visualizadas <strong>[views]</strong> vezes',
        'xx_s_gallery' => 'Galeria de %s',
        'stat3' => '<strong>[pictures]</strong> fotos em <strong>[albums]</strong> albuns com <strong>[comments]</strong> coment�rios, visualizadas <strong>[views]</strong> vezes'
        );

    $lang_list_users = array('user_list' => 'Lista de utilizadores',
        'no_user_gal' => 'N�oo existem utilizadores com permiss�es para ter albums',
        'n_albums' => '%s album(s)',
        'n_pics' => '%s foto(s)'
        );

    $lang_list_albums = array('n_pictures' => '%s fotos',
        'last_added' => ', �ltima adicionada em %s'
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
        'general_settings' => 'Configura��es gerais',
        'alb_title' => 'T�tulo do album',
        'alb_cat' => 'Categoria do album',
        'alb_desc' => 'Descri��o do album',
        'alb_thumb' => 'Thumbnail do album',
        'alb_perm' => 'Permiss�es para este album',
        'can_view' => 'Este album pode ser visto por',
        'can_upload' => 'Os visitantes podem adicionar fotos',
        'can_post_comments' => 'Os visitantes poden adicionar coment�rios',
        'can_rate' => 'Os visitantes podem classificar as fotos',
        'user_gal' => 'Galeria de utilizador',
        'no_cat' => '* Sem categoria *',
        'alb_empty' => 'O album est� vazio',
        'last_uploaded' => '�ltima foto adicionada',
        'public_alb' => 'Todo o mundo (album p�blico)',
        'me_only' => 'Somente eu (album privado)',
        'owner_only' => 'Somente o dono do album (%s)',
        'groupp_only' => 'Membros do grupo \'%s\'',
        'err_no_alb_to_modify' => 'N�o pode modificar nenhum album na base de dados.',
        'update' => 'Modificar album'
        );
// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //
if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array('already_rated' => 'desculpe mas j� votou nesta foto',
        'rate_ok' => 'O seu voto foi contabilizado',
        );
// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //
if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {
    $lang_register_disclamer = <<<EOT
Muito embora os administradores do {SITE_NAME} tentarem eliminar ou editar qualquer material desagrad�vel t�o rapidamente quanto poss�vel, � impossivel verificar todos os envios que se realizam. Por isso deve ter em conta que todos o material afixado neste website expressa os pontos de vista e opini�es dos seus autores e n�o os dos administradores ou webmasters (excepto os adicionados por eles pr�prios).<br />
<br />
Concorda n�o adicionar nenhum material abusivo, obsceno, vulgar, escandaloso, odioso, amea�ador, de orienta��o sexual, ou algum outro que possa violar qualquer lei aplic�vel.  Concorda que o webmaster, o administrador e os acessores de { SITE_NAME } tenham o direito de eliminar ou de corrigir qualquer conte�do em qualquer momento que considerarem necess�rio. Como utilizador, concorda que  qualquer informa��o enviada seja armazenada nuna base de dados.  Garantindo que esta informa��o, n�o ser� divulgada a terceiros sem o seu consentimento. O webmaster e o administrador n�o podem ser considerados respons�veis por alguma tentativa de destrui��o da base de dados que possa conduzir � perda da mesma.<br />
<br />
Este site utiliza cookies para armazenar a informa��o no seu processador. Estes cookies servem para melhorar a navega��o neste site.  O endere�o de e-mail  � utilizado somente para confirmar os seus dados e a password de registo.<br />
<br />
Premindo 'Concordo' expressa o seu acordo com estas condi��es.
EOT;

    $lang_register_php = array('page_title' => 'Registo de novo utilizador',
        'term_cond' => 'Termos e condi��es',
        'i_agree' => 'Estou de acordo',
        'submit' => 'Enviar pedido de registo',
        'err_user_exists' => 'O nome de utilizador escolhido j� existe, por favor escolha outro diferente',
        'err_password_mismatch' => 'As duas palavras-passe n�o s�o iguais, por favor volte a introduzi-las',
        'err_uname_short' => 'O nome do utilizador deve ter pelo menos 2 carecteres',
        'err_password_short' => 'A palavra-passe deve ter pelo menos 2 caracteres',
        'err_uname_pass_diff' => 'O nome de utilizador e a palavra-passe devem ser diferentes',
        'err_invalid_email' => 'O endere�o de e-mail n�o � v�lido',
        'err_duplicate_email' => 'Outro utilizador j� se encontra registado com o endere�o de e-amil que forneceu',
        'enter_info' => 'Introduza a informa��o de registo',
        'required_info' => 'Informa��o requerida',
        'optional_info' => 'Informa��o opcional',
        'username' => 'Nome de utilizador',
        'password' => 'Palavra-passe',
        'password_again' => 'Reescrever palavra-passe',
        'email' => 'E-mail',
        'location' => 'Local',
        'interests' => 'Interesses',
        'website' => 'P�gina web',
        'occupation' => 'Ocupa��o',
        'error' => 'ERRO',
        'confirm_email_subject' => '%s - Confirma��o de registo',
        'information' => 'Informa��o',
        'failed_sending_email' => 'O e-mail de confirma��o de registo n�o pode ser enviado!',
        'thank_you' => 'Obrigado por se registar.<br /><br />Enviamos um e-mail com informa��o sobre a activa��o da sua conta para o endere�o de e-mail fornecido.',
        'acct_created' => 'A sua conta de utilizador foi criada e j� pode aceder ao sistema com o seu nome de utilizador e palavra-passe',
        'acct_active' => 'A sua conta de utilizador est� activa e j� pode aceder ao sistema com o seu nome de utilizador e palavra-passe',
        'acct_already_act' => 'A sua conta j� estava activa!',
        'acct_act_failed' => 'Esta conta n�o pode ser activada!',
        'err_unk_user' => 'O utilizador seleccionado n�o existe!',
        'x_s_profile' => 'Perfil de %s',
        'group' => 'Grupo',
        'reg_date' => 'Data de registo',
        'disk_usage' => 'Uso de disco',
        'change_pass' => 'Alterar palavra passe',
        'current_pass' => 'Palavra-passe actual',
        'new_pass' => 'Nova palavra-passe',
        'new_pass_again' => 'Reescrever nova palavra passe',
        'err_curr_pass' => 'A palavra passe actual � incorrecta',
        'apply_modif' => 'Guardar as altera��es',
        'change_pass' => 'Alterar palavra-passe',
        'update_success' => 'O seu perfil foi actualizado',
        'pass_chg_success' => 'A tua palavra passe foi alterada ',
        'pass_chg_error' => 'A sua palavra passe n�o foi alterada',
        );

    $lang_register_confirm_email = <<<EOT
Obrigado por se registar em {SITE_NAME}

O seu nome de utilizador �: "{USER_NAME}"
A sua palavra passe �: "{PASSWORD}"

Para terminar de activar a sua conta, deve clicar sobre o link que
aparece em baixo ou copi�-lo e col�-lo no seu browser de Internet.

{ACT_LINK}

Comprimentos.

Os administradores do {SITE_NAME}

EOT;
} 
// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //
if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array('title' => 'Rever coment�rios',
        'no_comment' => 'N�o existem coment�rios para mostrar',
        'n_comm_del' => '%s coment�rio(s) apagado(s)',
        'n_comm_disp' => 'N�mero de coment�rios a mostrar',
        'see_prev' => 'Ver o anterior',
        'see_next' => 'Ver o seguinte',
        'del_comm' => 'Apagar coment�rios seleccionados',
        );
// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //
// if (defined('SEARCH_PHP'))
    $lang_search_php = array(0 => 'Procurar em todas as fotos',
        );
// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //
if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array('page_title' => 'Procurar novas fotos',
        'select_dir' => 'Seleccionar direct�rio',
        'select_dir_msg' => 'Esta fun��o permite adicionar de forma autom�tica as fotos que carregou para o seu servidoratrav�s de FTP.<br /><br />Seleccione o direct�rio para onde carregou as suas fotos',
        'no_pic_to_add' => 'N�o h� nenhuma foto para adicionar',
        'need_one_album' => 'Necessita de pelo menos um album para utilizar esta func�o',
        'warning' => 'Aten��o',
        'change_perm' => 'O script n�o pode escrever neste direct�rio, por isso necessita de alterar as suas permiss�es para o modo 755 ou 777 antes de tentar de novo!',
        'target_album' => '<strong>Colocar as fotos do direct�rio &quot;</strong>%s<strong>&quot; no album </strong>%s',
        'folder' => 'Pasta',
        'image' => 'Foto',
        'album' => 'Album',
        'result' => 'Resultado',
        'dir_ro' => 'N�o � poss�vel escrever. ',
        'dir_cant_read' => 'N�o � poss�vel ler. ',
        'insert' => 'Adicionar novas fotos � galeria',
        'list_new_pic' => 'Lista de novas fotos',
        'insert_selected' => 'Adicionar as fotos seleccionadas',
        'no_pic_found' => 'N�o se encontrou nenhuma foto nova',
        'be_patient' => 'Por favor, s� paciente, o script necessita de tempo para adicionar as fotos',
        'notes' => '<ul>' . '<li><strong>OK</strong> : significa que a foto foi adicionada sem problemas' . '<li><strong>DP</strong> : significa que a foto � um duplicado e j� existe na base de dados' . '<li><strong>PB</strong> : significa que a foto n�o pode ser adicionada, por favor verifica a configura��o e as permiss�es dos direct�rios onde est�o as fotos' . '<li>Se os icones OK, DP, PB n�o aparecerem, prime sobre o icone de imagem n�o carregada para ver o erro produzido pelo PHP' . '<li>Se o browser faz um timeout, prime o �cone Actualizar' . '</ul>',
        'select_album' => 'Select album', // new in nuke
        'no_album' => 'No album name was selected, click back and select an album to put your pictures in',
        );
// ------------------------------------------------------------------------- //
// File thumbnails.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File banning.php
// ------------------------------------------------------------------------- //
// NULL 
// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //
if (defined('UPLOAD_PHP')) $lang_upload_php = array('title' => 'Inserir nova foto',
        'max_fsize' => 'O tamanho m�ximo de fichero admitido � de %s KB',
        'album' => 'Album',
        'picture' => 'Foto',
        'pic_title' => 'T�tulo da foto',
        'description' => 'Descri��o da foto',
        'keywords' => 'Palavras chave (separadas por espa�os)',
        'err_no_alb_uploadables' => 'Desculpe, mas n�o h� nenhum album onde seja permitido inserir novas fotos',
        );
// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //
if (defined('USERMGR_PHP')) $lang_usermgr_php = array('title' => 'Administrar utilizadores',
        'name_a' => 'Ascendente por nome',
        'name_d' => 'Descendente por nome',
        'group_a' => 'Ascendente por grupo',
        'group_d' => 'Descendente por grupo',
        'reg_a' => 'Ascendente por data de registo',
        'reg_d' => 'Descendente por data de registo',
        'pic_a' => 'Ascendente por total de fotos',
        'pic_d' => 'Descendente por total de fotos',
        'disku_a' => 'Ascendente por uso de disco',
        'disku_d' => 'Descendente por uso de disco',
        'sort_by' => 'Ordenar utilizadores por',
        'err_no_users' => 'A tabela de utilizadores est� vazia!',
        'err_edit_self' => 'N�o pode editar o seu pr�prio perfil, use a op��on \'Meu perfil de utilizador\' para isso',
        'edit' => 'EDITAR',
        'delete' => 'APAGAR',
        'name' => 'Nome de utilizador',
        'group' => 'Grupo',
        'inactive' => 'Inactivo',
        'operations' => 'Opera��es',
        'pictures' => 'Fotos',
        'disk_space' => 'Espa�o usado / Quota',
        'registered_on' => 'Registado no dia',
        'u_user_on_p_pages' => '%d utilizadores na %d p�gina(s)',
        'confirm_del' => 'Tem a certeza que quer apagar esta utilizador? \\nTodas as suas fotos e albuns ser�o tambem apagados.',
        'mail' => 'Enviar',
        'err_unknown_user' => 'O utilizador selecionado n�o existe!',
        'modify_user' => 'Modificar utilizador',
        'notes' => 'Notas',
        'note_list' => '<li>Se n�o quiser alterar a palavra-passe actual, deixe o campo "palavra-passe" vazio',
        'password' => 'Palavra-passe',
        'user_active' => 'O utilizador activo',
        'user_group' => 'Grupo de utilizadores',
        'user_email' => 'E-mail do utilizador',
        'user_web_site' => 'P�gina web do utilizador',
        'create_new_user' => 'Criar novo utilizador',
        'user_from' => 'Local do utilizador',
        'user_interests' => 'Interesses do utilizador',
        'user_oc' => 'Ocupa��o do utilizador',
        );
// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //
if (defined('UTIL_PHP')) $lang_util_php = array('title' => 'Redimensionar imagens',
        'what_it_does' => 'O que isto faz',
        'what_update_titles' => 'Actualizar t�tulos a partir de nome de ficheiro',
        'what_delete_title' => 'Apagar t�tulos',
        'what_rebuild' => 'Reconstruir thumbnails e redimensionar as fotos',
        'what_delete_originals' => 'Apaga as fotos com o tamanho original e substitui-as com as novas vers�es',
        'file' => 'Ficheiro',
        'title_set_to' => 'T�tulo mudado para',
        'submit_form' => 'Enviar',
        'updated_succesfully' => 'Actualizado com sucesso',
        'error_create' => 'Erro na tentativa de cria��o',
        'continue' => 'Processar mais imagens',
        'main_success' => 'O ficheiro %s foi usado com sucesso para imagem principal',
        'error_rename' => 'erro na renomea��o de %s para %s',
        'error_not_found' => 'O ficheiro %s n�o foi encontrado',
        'back' => 'Voltar atr�s',
        'thumbs_wait' => 'A actualizar thumbnails e/ou a redimensionar imagens. Por favor, aguarde...',
        'thumbs_continue_wait' => 'A actualiza��o ainda est� a ser processada...',
        'titles_wait' => 'A actualizar t�tulos...',
        'delete_wait' => 'A apagar t�tulos...',
        'replace_wait' => 'A apagar originais e a substitu�-los com as imagens redimensionadas...',
        'instruction' => 'Instru��es r�pidas',
        'instruction_action' => 'selecionar ac��o',
        'instruction_parameter' => 'Seleccionar parametros',
        'instruction_album' => 'Seleccionar album',
        'instruction_press' => 'Click %s',
        'update' => 'Actualizar thumbnails e/ou  redimensionar fotos',
        'update_what' => 'O que deve ser actualizado',
        'update_thumb' => 'S� os thumbnails',
        'update_pic' => 'S� redimensionar imagens',
        'update_both' => 'Ambos os thumbnails e imagens redimensionadas',
        'update_number' => 'N�mero de imagens processadas por click',
        'update_option' => '(Tente p�r esta op��o com valores mais baixos se tiverem a acontecer timeouts)',
        'filename_title' => 'Ficheiro ? T�tulo da imagem',
        'filename_how' => 'Como deve ser o nome do ficheiro modificado',
        'filename_remove' => 'Remova a extens�o .jpg e substitua os _ (underscore) com espa�os',
        'filename_euro' => 'Modificar 2003_11_23_13_20_20.jpg para 23/11/2003 13:20',
        'filename_us' => 'Modificar 2003_11_23_13_20_20.jpg para 11/23/2003 13:20',
        'filename_time' => 'Modificar 2003_11_23_13_20_20.jpg para 13:20',
        'delete' => 'Apagar t�tulos das imagens ou as fotos em tamanho original',
        'delete_title' => 'Apagar t�tulos das imagens',
        'delete_original' => 'Apagar fotos em tamanho original',
        'delete_replace' => 'Apaga as imagens originais e substituias pelas novas imagens redimensionadas',
        'select_album' => 'Selecionar album',
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