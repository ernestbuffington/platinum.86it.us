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
    'lang_name_english' => 'Indonesian', // the name of your language in English, e.g. 'Greek' or 'Spanish'
    'lang_name_native' => 'Bahasa Indonesia', // the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espa&ntilde;ol'
    'lang_country_code' => 'id', // the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
    'trans_name' => 'sengsara', // the name of the translator - can be a nickname
    'trans_email' => 'sengsara@batamweb.net', // translator's email address (optional)
    'trans_website' => 'http://batamweb.net/', // translator's website (optional)
    'trans_date' => '2003-10-07', // the date the translation was created / last modified
    );

$lang_charset = 'iso-8859-1';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Byte', 'KB', 'MB');
// Day of weeks and months
$lang_day_of_week = array('Ming', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab');
$lang_month = array('Jan', 'Peb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nop', 'Des');
// Some common strings
$lang_yes = 'Ya';
$lang_no = 'Tidak';
$lang_back = 'KEMBALI';
$lang_continue = 'LANJUT';
$lang_info = 'Informasi';
$lang_error = 'Error';
// The various date formats
// See http://www.php.net/manual/en/function.strftime.php to define the variable below
$album_date_fmt = '%d %B %Y';
$lastcom_date_fmt = '%d/%m/%y %H:%M';
$lastup_date_fmt = '%d %B %Y';
$register_date_fmt = '%d %B %Y';
$lasthit_date_fmt = '%d %B %Y %I:%M %p';
$comment_date_fmt = '%d %B %Y %I:%M %p';
// For the word censor
$lang_bad_words = array('*fuck*', 'asshole', 'assramer', 'bitch*', 'c0ck', 'clits', 'Cock', 'cum', 'cunt*', 'dago', 'daygo', 'dego', 'dick*', 'dildo', 'fanculo', 'feces', 'foreskin', 'Fu\(*', 'fuk*', 'honkey', 'hore', 'injun', 'kike', 'lesbo', 'masturbat*', 'motherfucker', 'nazis', 'nigger*', 'nutsack', 'penis', 'phuck', 'poop', 'pussy', 'scrotum', 'shit', 'slut', 'titties', 'titty', 'twaty', 'wank*', 'whore', 'wop*');

$lang_meta_album_names = array('random' => 'Foto Acak',
    'lastup' => 'Kiriman Terakhir',
    'lastupby' => 'My Last Additions', // new 1.2.2
    'lastalb' => 'Album Terakhir Diupdate ',

    'lastcom' => 'Komentar Terakhir',
    'lastcomby' => 'My Last comments', // new 1.2.2
    'topn' => 'Terbanyak Dilihat',
    'toprated' => 'Nilai Tertingi',
    'lasthits' => 'Terakhir Dilihat',
    'search' => 'Hasil Pencarian',

    'favpics' => 'Foto Favorit'

    );

$lang_errors = array('access_denied' => 'Anda tidak memiliki izin untuk mengakses halaman ini.',
    'perm_denied' => 'Anda tidak memiliki izin untuk melakukan ini.',
    'param_missing' => 'Skrip dijalankan dengan parameter yang tidak lengkap.',
    'non_exist_ap' => 'Foto/Album yang dimaksud tidak ditemukan !',
    'quota_exceeded' => 'Kuota disk terlampaui<br /><br />Anda memiliki kuota ruangan sebesar [quota]K, foto-foto anda telah menggunakan ruangan sebanyak [space]K, menambahkan foto ini akan menyebabkan anda melampaui kuota.',
    'gd_file_type_err' => 'Jika menggunakan GD library tipe image yang dibolehkan hanya JPEG dan PNG.',
    'invalid_image' => 'Image yang anda upload rusak atau tidak bisa ditangani oleh GD library',
    'resize_failed' => 'Gagal membuat thumbnail atau memperkecil image.',
    'no_img_to_display' => 'Tidak ada image untuk ditampilkan',
    'non_exist_cat' => 'Kategori yang dimaksud tidak ditemukan',
    'orphan_cat' => 'Kategori memiliki induk yang tidak ditemukan, jalankan pengaturan kategori untuk memperbaiki masalah ini.',
    'directory_ro' => 'Direktori \'%s\' tidak bissa ditulisi, foto tidak bisa dihapus',
    'non_exist_comment' => 'Komentar yang dinaksud tidak ditemukan.',
    'pic_in_invalid_album' => 'Foto berada dalam album yang tidak ditemukan (%s)!?',

    'banned' => 'Anda telah di-banned dari situs ini.',

    'not_with_udb' => 'Fungsi ini tidak digunakan lagi dalam Coppermine sebab telah terintegrasi kedalam forum. Mungkin hal yang ingin anda lakukan tidak disupport oleh konfigurasi ini, atau fungsi tersebut seharusnya ditangani oleh software forum.',

    'members_only' => 'Fungsi hanya untuk member, silahkan daftar dahulu.', // changed in cpg1.2.0nuke
    'mustbe_god' => 'Fungsi ini hanya untuk admin situs. Anda harus login sebagai superadmin (god), agar bisa mempergunakan fungsi ini'
    );
// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //
$lang_main_menu = array('alb_list_title' => 'Lihat daftar album',
    'alb_list_lnk' => 'Daftar Album',
    'my_gal_title' => 'Lihat galeri pribadi saya',
    'my_gal_lnk' => 'Galeriku',
    'my_prof_lnk' => 'Profilku',
    'adm_mode_title' => 'Pindah ke mode admin',
    'adm_mode_lnk' => 'Mode Admin',
    'usr_mode_title' => 'Pindah ke mode user',
    'usr_mode_lnk' => 'Mode user',
    'upload_pic_title' => 'Upload foto ke dalam album',
    'upload_pic_lnk' => 'Upload Foto',
    'register_title' => 'Buat acount baru',
    'register_lnk' => 'Register',
    'login_lnk' => 'Login',
    'logout_lnk' => 'Logout',
    'lastup_lnk' => 'Upload Terakhir',
    'lastcom_lnk' => 'Komentar Terakhir',
    'topn_lnk' => 'Terbanyak Dilihat',
    'toprated_lnk' => 'Nilai Tertinggi',
    'search_lnk' => 'Pencarian',
    'fav_lnk' => 'Favoritku',

    );

$lang_gallery_admin_menu = array('upl_app_lnk' => 'Persetujuan upload',
    'config_lnk' => 'Konfig.',
    'albums_lnk' => 'Album',
    'categories_lnk' => 'Kategori',
    'users_lnk' => 'User',
    'groups_lnk' => 'Grup',
    'comments_lnk' => 'Komentar',
    'searchnew_lnk' => 'Tambahkan foto (batch)',
    'util_lnk' => 'Ubah ukuran foto',

    'ban_lnk' => 'Ban User',

    );

$lang_user_admin_menu = array('albmgr_lnk' => 'Buat / urutkan album',
    'modifyalb_lnk' => 'Modifikasi album',
    'my_prof_lnk' => 'Profil',
    );

$lang_cat_list = array('category' => 'Kategori',
    'albums' => 'Album',
    'pictures' => 'Foto',
    );

$lang_album_list = array('album_on_page' => '%d album pada %d halaman'
    );

$lang_thumb_view = array('date' => 'TANGGAL', 
    // Sort by filename and title
    'name' => 'NAMA FILE',

    'title' => 'JUDUL',

    'sort_da' => 'Urutkan mendaki menurut tanggal',
    'sort_dd' => 'Urutkan menurun menurut tanggal',
    'sort_na' => 'Urutkan mendaki menurut nama',
    'sort_nd' => 'Urutkan menurun menurut nama',
    'sort_ta' => 'Urutkan mendaki menurut judul',

    'sort_td' => 'Urutkan menurun menurut judul',

    'pic_on_page' => '%d foto pada %d halaman',
    'user_on_page' => '%d user pada %d halaman',
    'sort_ra' => 'Urutkan mendaki menurut nilai', // new in cpg1.2.0nuke
    'sort_rd' => 'Urutkan menurun menurut nilai', // new in cpg1.2.0nuke
    'rating' => 'NILAI', // new in cpg1.2.0nuke
    'sort_title' => 'Urutkan foto menurut:', // new in cpg1.2.0nuke
    );

$lang_img_nav_bar = array('thumb_title' => 'Kembali ke halaman thumbnail',
    'pic_info_title' => 'Tampilkan/sembunyikan informasi foto',
    'slideshow_title' => 'Slideshow',
    'slideshow_disabled' => 'e-card non-aktif', // new in cpg1.2.0nuke
    'slideshow_disabled_msg' => $lang_errors['members_only'], // new in cpg1.2.0nuke
    'ecard_title' => 'Kirimkan foto ini sebagai e-card',
    'ecard_disabled' => 'e-card nonaktif',
    'ecard_disabled_msg' => 'Anda tidak memiliki izin untuk mengirim e-card',
    'prev_title' => 'Lihat foto sebelumnya',
    'next_title' => 'Lihat foto selanjutnya',
    'pic_pos' => 'Foto %s/%s',
    'no_more_images' => 'Tidak ada image selanjutnya dalam galeri ini', // new in cpg1.2.0nuke
    'no_less_images' => 'Ini adalah image pertama dalam galeri ini', // new in cpg1.2.0nuke
    );

$lang_rate_pic = array('rate_this_pic' => 'Beri nilai foto ini ',
    'no_votes' => '(Belum dinilai)',
    'rating' => '(nilai sekarang : %s / 5 dengan %s suara)',
    'rubbish' => 'Sampah',
    'poor' => 'Jelek',
    'fair' => 'Lumayan',
    'good' => 'Bagus',
    'excellent' => 'Bagus sekali',
    'great' => 'Hebat',
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
    CRITICAL_ERROR => 'Critical error',
    'file' => 'File: ',
    'line' => 'Baris: ',
    );

$lang_display_thumbnails = array('filename' => 'Nama file : ',
    'filesize' => 'Besar file : ',
    'dimensions' => 'Dimensi : ',
    'date_added' => 'Tanggal upload : '
    );

$lang_get_pic_data = array('n_comments' => '%s komentar',
    'n_views' => '%s dilihat',
    'n_votes' => '(%s dinilai)'
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
        'Embarassed' => 'Embarrassed',
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
if (defined('ADMIN_PHP')) $lang_admin_php = array(0 => 'Meninggalkan mode admin...',
        1 => 'Memasuki mode admin...',
        );
// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //
if (defined('ALBMGR_PHP')) $lang_albmgr_php = array('alb_need_name' => 'Album harus diberi nama !',
        'confirm_modifs' => 'Apa anda yakin mau membuat perubahan ini ?',
        'no_change' => 'Anda tidak melakukan perubahan !',
        'new_album' => 'Album baru',
        'confirm_delete1' => 'Anda yakin mau menghapus album ini ?',
        'confirm_delete2' => '\nSemua foto dan komentar didalamnya akan ikut terhapus !',
        'select_first' => 'Pilih album dulu',
        'alb_mrg' => 'Pengaturan Album',
        'my_gallery' => '* Galeriku *',
        'no_category' => '* Tanpa kategori *',
        'delete' => 'Hapus',
        'new' => 'Baru',
        'apply_modifs' => 'Lakukan perubahan',
        'select_category' => 'Pilih kategori',
        );
// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) $lang_catmgr_php = array('miss_param' => 'Parameter yang dibutuhkan untuk operasi \'%s\' tidak dimasukkan !',
        'unknown_cat' => 'Kategori yang dimasud tidak ditemukan !',
        'usergal_cat_ro' => 'Kategori Galeri User tidak boleh dihapus !',
        'manage_cat' => 'Pengaturan kategori',
        'confirm_delete' => 'Anda yakin mau meng-HAPUS kategori ini ?',
        'category' => 'Kategori',
        'operations' => 'Operasi',
        'move_into' => 'Pindahkan',
        'update_create' => 'Ubah/Buat kategori',
        'parent_cat' => 'Kategori induk',
        'cat_title' => 'Judul kategori',
        'cat_desc' => 'Keterangan'
        );
// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //
if (defined('CONFIG_PHP')) $lang_config_php = array('title' => 'Konfigurasi',
        'restore_cfg' => 'Kembalikan ke default',
        'save_cfg' => 'Simpan konfigurasi',
        'notes' => 'Catatan',
        'info' => 'Informasi',
        'upd_success' => 'Konfigurasi Coppermine telah diupdate',
        'restore_success' => 'Konfigurasi Coppermine telah dikembalikan ke default',
        'name_a' => 'Nama mendaki',
        'name_d' => 'Nama menurun',
        'title_a' => 'Judul mendaki',

        'title_d' => 'Judul menurun',

        'date_a' => 'Tanggal mendaki',
        'date_d' => 'Tanggal menurun',
        'rating_a' => 'Nilai mendaki', // new in cpg1.2.0nuke
        'rating_d' => 'Nilai menurun', // new in cpg1.2.0nuke
        'th_any' => 'Max Aspect',
        'th_ht' => 'Tinggi',
        'th_wd' => 'Lebar'
        );

if (defined('CONFIG_PHP')) $lang_config_data = array('Setting Umum',
        array('Nama Galeri', 'gallery_name', 0),
        array('Keterangan', 'gallery_description', 0),
        array('Email admin galeri', 'gallery_admin_email', 0),
        array(
            'Address to nuke folder ie http://www.mysite.tld/html/', 'ecards_more_pic_target', 0), // new in cpg1.2.0nuke
        array('Bahasa', 'lang', 5),
// for postnuke change
        array('Theme', 'cpgtheme', 6),
        array('Judul Halaman yang spesifik (bukan hanya >Coppermine)', 'nice_titles', 1),
        array('Show blocks on the right', 'right_blocks', 1), // new 1.2.2

        'Tampilan daftar album',
        array('Lebar tabel utama (piksel atau %)', 'main_table_width', 0),
        array('Jumlah level kategori yang ditampilkan', 'subcat_level', 0),
        array('Jumlah album yang ditampilkan', 'albums_per_page', 0),
        array('Jumlah kolom di daftar album', 'album_list_cols', 0),
        array('Ukuran thumbnail dalam piksel', 'alb_list_thumb_size', 0),
        array('Tampilan halaman utama', 'main_page_layout', 0),
        array('Tampilkan thumbnail album level pertama dalam kategori', 'first_level', 1),

        'Tampilan thumbnail',
        array('Jumlah kolom di halaman thumbnail', 'thumbcols', 0),
        array('Jumlah baris di halaman thumbnail', 'thumbrows', 0),
        array('Jumlah maksimum tampilan tab', 'max_tabs', 0),
        array('Tampilkan keterangan foto (sebagai tambahan judul) di bawah thumbnail', 'caption_in_thumbview', 1),
        array('Tampilkan jumlah komentar di bawah thumbnail', 'display_comment_count', 1),
        array('Urutan foto default', 'default_sort_order', 3),
        array('Jumlah suara minimal bagi foto untuk tampil di daftar \'nilai tertinggi\'', 'min_votes_for_rating', 0),

        'Tampilan foto &amp; setting komentar',
        array('Lebar table tampilan foto (piksel atau %)', 'picture_table_width', 0),
        array('Informasi foto secara default tampak', 'display_pic_info', 1),
        array('Saring kata-kata buruk dalam komentar', 'filter_bad_words', 1),
        array('Izinkan smilies dalam komentar', 'enable_smilies', 1),
        array('Panjang maksimum keterangan foto', 'max_img_desc_length', 0),
        array('Jumlah karakter makimum dalam kata', 'max_com_wlength', 0),
        array('Jumlah baris maksimum dalam komentar', 'max_com_lines', 0),
        array('Panjang maksimum komentar', 'max_com_size', 0),
        array('Tampilkan film strip', 'display_film_strip', 1),

        array('Jumlah item dalam film strip', 'max_film_strip_items', 0),

        array(
            'Izinkan tampilan foto fullsize untuk anonim', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke		
array('Number of days between being able to vote on the same image','keep_votes_time',0), // new in cpg1.2.2c nuke
// 'Pictures and thumbnails settings',
        'Setting foto dan thumbnail',
        array('Kualitas file JPEG', 'jpeg_qual', 0),
        array('Dimensi thumbnail maksimum <strong>*</strong>', 'thumb_width', 0),

        array('Gunakan dimensi ( lebar atau tinggi atau perbandingan maksimum untuk thumbnail )<strong>*</strong>', 'thumb_use', 7),

        array('Buat foto antara', 'make_intermediate', 1),
        array('Lebar atau tinggi maksimum foto antara <strong>*</strong>', 'picture_width', 0),
        array('Besar maksimum foto yang diupload (KB)', 'max_upl_size', 0),
        array('Lebar atau tinggi maksimum foto yang diupload (piksel)', 'max_upl_width_height', 0),

        'Setting user',
        array('Izinkan pendaftaran user baru', 'allow_user_registration', 1),
        array('Pendaftaran menggunakan pengesahan melalui email', 'reg_requires_valid_email', 1),
        array('Izinkan dua user untuk memiliki alamat email yang sama', 'allow_duplicate_emails_addr', 1),
        array('User bisa memiliki album pribadi', 'allow_private_albums', 1),
array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',

        'Field tambahan untuk keterangan image (kosongkan jika tidak digunakan)',
        array('Nama field 1', 'user_field1_name', 0),
        array('Nama field 2', 'user_field2_name', 0),
        array('Nama field 3', 'user_field3_name', 0),
        array('Nama field 4', 'user_field4_name', 0),

        'Setting tambahan foto dan thumbnail',
        array('Tampilkan ikon album pribadi untuk user yang tidak login', 'show_private', 1),

        array('Karakter yang tidak diizinkan dalam nama file', 'forbiden_fname_char', 0),
        array('Ekstensi file yang diizinkan untuk foto yang diupload', 'allowed_file_extensions', 0),
        array('Metode pengubah ukuran image', 'thumb_method', 2),
        array('Path utiliti \'konversi\' ImageMagick (mis. /usr/bin/X11/)', 'impath', 0),
        array('Tipe image yang diizinkan (hanya berlaku untuk ImageMagick)', 'allowed_img_types', 0),
        array('Opsi Command line untuk ImageMagick', 'im_options', 0),
        array('Baca data EXIF dalam file JPEG', 'read_exif_data', 1),
        array(
            'Baca data IPTC dalam file JPEG', 'read_iptc_data', 1), // new in cpg1.2.0nuke
        array('Direktori album <strong>*</strong>', 'fullpath', 0),
        array('Direktori foto user <strong>*</strong>', 'userpics', 0),
        array('Prefiks untuk foto antara <strong>*</strong>', 'normal_pfx', 0),
        array('Prefiks untuk thumbnail <strong>*</strong>', 'thumb_pfx', 0),
        array('Mode default untuk direktori', 'default_dir_mode', 0),
        array('Mode default untuk foto', 'default_file_mode', 0),

        array(
            'Tampilkan nama file dalam picinfo', 'picinfo_display_filename', '1'), // new in cpg1.2.0nuke
        array(
            'Tampilkan nama album dalam picinfo', 'picinfo_display_album_name', '1'), // new in cpg1.2.0nuke
        array(
            'Tampilkan ukuran file dalam picinfo', 'picinfo_display_file_size', '1'), // new in cpg1.2.0nuke
        array(
            'Tampilkan dimensi dalam picinfo', 'picinfo_display_dimensions', '1'), // new in cpg1.2.0nuke
        array(
            'Tampilkan count dalam picinfo', 'picinfo_display_count_displayed', '1'), // new in cpg1.2.0nuke
        array(
            'Tampilkan URL dalam picinfo', 'picinfo_display_URL', '1'), // new in cpg1.2.0nuke
        array(
            'Tampilkan URL sebagai link bookmark dalam picinfo', 'picinfo_display_URL_bookmark', '1'), // new in cpg1.2.0nuke
        array(
            'Tampilkan link album favorit dalam picinfo', 'picinfo_display_favorites', '1'), // new in cpg1.2.0nuke
        'Setting Cookie &amp; Karakter Set ',
        array('Nama cookie yang digunakan oleh skrip', 'cookie_name', 0),
        array('Path cookie yang digunakan oleh skrip', 'cookie_path', 0),
        array('Encoding Karakter', 'charset', 4),

        'Setting lain-lain',
        array('Aktifkan mode debug', 'debug_mode', 1),

        array(
            'Aktifkan mode debug canggih', 'advanced_debug_mode', 1), // new in cpg1.2.0nuke
array(
'Show Coppermine Update Alert to Admin', 'showupdate', 1), // new 1.2.2
        '<br /><div align="center">(*) Field yang ditandai dengan * tidak boleh diubah jika telah ada foto dalam galeri</div><br />'
        );
// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //
if (defined('DB_INPUT_PHP')) $lang_db_input_php = array('empty_name_or_com' => 'Anda harus mengisi nama dan komentar',
        'com_added' => 'Komentar anda telah dimasukkan',
        'alb_need_title' => 'Anda harus memberi Judul pada album !',
        'no_udp_needed' => 'Tidak perlu update.',
        'alb_updated' => 'Album telah diupdate',
        'unknown_album' => 'Album yang dimaksud tidak ditemukan atau anda tidak memiliki izin untuk mengupload ke dalam album ini',
        'no_pic_uploaded' => 'Tidak ada foto yang diupload !<br /><br />Jika anda yakin telah memilih foto untuk diupload, periksa lagi apakah server mengizinkan upload...',
        'err_mkdir' => 'Gagal membuat direktori %s !',
        'dest_dir_ro' => 'Direktori tujuan %s tidak bisa ditulisi oleh skrip !',
        'err_move' => 'Gagal memindahkan %s ke %s !',
        'err_fsize_too_large' => 'Dimensi foto yang diupload terlalu besar (maksimum yang diizinkan adalah %s x %s) !',
        'err_imgsize_too_large' => 'Ukuran file yang diupload terlalu besar (maksimum yang diizinkan adalah %s KB) !',
        'err_invalid_img' => 'File yang diupload bukan berupa image !',
        'allowed_img_types' => 'Anda hanya bisa mengupload image %s.',
        'err_insert_pic' => 'Foto \'%s\' tidak bisa dimasukkan kedalam album ',
        'upload_success' => 'Foto anda telah berhasil diupload<br /><br />Foto tersebut akan tampil setelah disetujui oleh admin.',
        'info' => 'Informasi',
        'com_added' => 'Komentar ditambahkan',
        'alb_updated' => 'Album diupdate',
        'err_comment_empty' => 'Komentar anda kosong !',
        'err_invalid_fext' => 'Hanya file dengan ekstensi berikut yang diterima : <br /><br />%s.',
        'no_flood' => 'Maaf, anda adalah pengirim komentar yang terkhir untuk foto ini<br /><br />Ubahlah komentar yang anda kirimkan jika anda menginginkannya',
        'redirect_msg' => 'Anda sedang diredireksi.<br /><br /><br />Klik \'LANJUT\' jika halam ini tidak refresh secara otomatis',
        'upl_success' => 'Foto anda telah berhasil dimasukkan',
        );
// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //
if (defined('DELETE_PHP')) $lang_delete_php = array('caption' => 'Keterangan',
        'fs_pic' => 'image ukuran penuh',
        'del_success' => 'berhasil dihapus',
        'ns_pic' => 'image ukuran normal',
        'err_del' => 'tidak bisa dihapus',
        'thumb_pic' => 'thumbnail',
        'comment' => 'komentar',
        'im_in_alb' => 'image dalam album',
        'alb_del_success' => 'Album \'%s\' dihapus',
        'alb_mgr' => 'Pengaturan Album',
        'err_invalid_data' => 'Data invalid diterima dalam \'%s\'',
        'create_alb' => 'Sedang membuat album \'%s\'',
        'update_alb' => 'Mengupdate album \'%s\' dengan judul \'%s\' dan indeks \'%s\'',
        'del_pic' => 'Hapus foto',
        'del_alb' => 'Hapus album',
        'del_user' => 'Hapus user',
        'err_unknown_user' => 'User yang dimaksud tidak ditemukan !',
        'comment_deleted' => 'Komentar berhasil dihapus',
        );
// ------------------------------------------------------------------------- //
// File displayecard.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File displayimage.php
// ------------------------------------------------------------------------- //
if (defined('DISPLAYIMAGE_PHP')) {
    $lang_display_image_php = array('confirm_del' => 'Anda yakin mau mengHAPUS foto ini ? \\nKomentar juga akan ikut dihapus.',
        'del_pic' => 'HAPUS FOTO INI',
        'size' => '%s x %s piksel',
        'views' => '%s kali dilihat',
        'slideshow' => 'Slideshow',
        'stop_slideshow' => 'HENTIKAN SLIDESHOW',
        'view_fs' => 'Klik untuk melihat image ukuran penuh',
        'edit_pic' => 'UBAH INFO FOTO', // new in cpg1.2.0nuke
        );

    $lang_picinfo = array('title' => 'Informasi foto',
        'Filename' => 'Filename',
        'Album name' => 'Nama Album',
        'Rating' => 'Nilai (%s suara)',
        'Keywords' => 'Kata Kunci',
        'File Size' => 'Ukuran File',
        'Dimensions' => 'Dimensi',
        'Displayed' => 'Ditampilkan',
        'Camera' => 'Kamera',
        'Date taken' => 'Tanggal pengambilan',
        'Aperture' => 'Bukaan',
        'Exposure time' => 'Waktu bukaan',
        'Focal length' => 'Panjang fokus',
        'Comment' => 'Komentar',
        'addFav' => 'Tambahkan ke Fav',

        'addFavPhrase' => 'Favorit',

        'remFav' => 'Hapus dari Fav',

        'iptcTitle' => 'Judul IPTC', // new in cpg1.2.0nuke
        'iptcCopyright' => 'Copyright IPTC', // new in cpg1.2.0nuke
        'iptcKeywords' => 'Katakunci IPTC', // new in cpg1.2.0nuke
        'iptcCategory' => 'Kategori IPTC', // new in cpg1.2.0nuke
        'iptcSubCategories' => 'Sub Kategori IPTC', // new in cpg1.2.0nuke
        'bookmark_page' => 'Bookmark Image', // new in cpg1.2.0nuke
        );

    $lang_display_comments = array('OK' => 'OK',
        'edit_title' => 'Ubah komentar ini',
        'confirm_delete' => 'Anda yakin mau menghapus komentar ini ?',
        'add_your_comment' => 'Tambah komentar',
        'name' => 'Nama',

        'comment' => 'Komentar',

        'your_name' => 'Anon',

        );

    $lang_fullsize_popup = array('click_to_close' => 'Klik image unuk menutup jendela ini',

        );
} 
// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //
if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php = array('title' => 'Kirim e-card',
        'invalid_email' => '<strong>Peringatan</strong> : alamat email invalid !',
        'ecard_title' => 'Sebuah e-card dari %s untuk anda',
        'view_ecard' => 'Jika e-card tampil dengan benar, klik disini',
        'view_more_pics' => 'Klik disini untuk melhat foto-foto lain !',
        'send_success' => 'E-card anda telah dikirimkan',
        'send_failed' => 'Maaf, server tidak bisa mengirim e-card anda...',
        'from' => 'Dari',
        'your_name' => 'Nama anda',
        'your_email' => 'Alamat email anda',
        'to' => 'Ke',
        'rcpt_name' => 'Nama penerima',
        'rcpt_email' => 'Alamat email penerima',
        'greetings' => 'Salam',
        'message' => 'Pesan',
        );
// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //
if (defined('EDITPICS_PHP')) $lang_editpics_php = array('pic_info' => 'Info&nbsp;foto',
        'album' => 'Album',
        'title' => 'Judul',
        'desc' => 'Keterangan',
        'keywords' => 'Kata Kunci',
        'pic_info_str' => '%sx%s - %sKB - %s kali dilihat - %s suara',
        'approve' => 'Setujui foto',
        'postpone_app' => 'Tunda persetujuan',
        'del_pic' => 'Hapus foto',
        'read_exif' => 'Baca lagi info EXIF', // new in cpg1.2.0nuke
        'reset_view_count' => 'Reset jumlah dilihat',
        'reset_votes' => 'Reset suara penilaian',
        'del_comm' => 'Hapus komentar',
        'upl_approval' => 'Persetujuan upload',
        'edit_pics' => 'Ubah foto',
        'see_next' => 'Lihat foto berikutnya',
        'see_prev' => 'Lihat foto sebelumnya',
        'n_pic' => '%s foto',
        'n_of_pic_to_disp' => 'Jumlah foto untuk ditampilkan',
        'apply' => 'Lakukan perubahan'
        );
// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //
if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array('group_name' => 'Nama grup',
        'disk_quota' => 'Kuota',
        'can_rate' => 'Bisa menilai foto',
        'can_send_ecards' => 'Bisa mengirim e-card',
        'can_post_com' => 'Bisa memberi komentar',
        'can_upload' => 'Bisa mengupload foto',
        'can_have_gallery' => 'Bisa mempunyai galeri pribadi',
        'apply' => 'Lakukan perubahan',
        'create_new_group' => 'Buat grup baru',
        'del_groups' => 'Hapus grup yang dipilih',
        'confirm_del' => 'Peringatan, jika anda menghapus grup, user yang merupakan anggota grup ini akan dipindahkan ke dalam grup \'Registered\' !\n\nAnda ingin melanjutkan ?',
        'title' => 'Pengaturan grup',
        'approval_1' => 'Setujui Upl. umum (1)',
        'approval_2' => ' Setujui Upl. pribadi (2)',
        'note1' => '<strong>(1)</strong> Upload ke dalam album publik memerlukan persetujuan admin',
        'note2' => '<strong>(2)</strong> Upload ke dalam album pribadi user memerlukan persetujuan admin',
        'notes' => 'Catatan'
        );
// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //
if (defined('INDEX_PHP')) {
    $lang_index_php = array('welcome' => 'Selamat datang !'
        );

    $lang_album_admin_menu = array('confirm_delete' => 'Anda yakin mau meng-HAPUS album ini ? \\nSeluruh foto dan komentar akan ikut terhapus.',
        'delete' => 'HAPUS',
        'modify' => 'PROPERTI',
        'edit_pics' => 'UBAH FOTO',
        );

    $lang_list_categories = array('home' => 'Home',
        'stat1' => '<strong>[pictures]</strong> foto dalam <strong>[albums]</strong> album dan <strong>[cat]</strong> kategori dengan <strong>[comments]</strong> komentar dilihat <strong>[views]</strong> kali',
        'stat2' => '<strong>[pictures]</strong> foto dalam <strong>[albums]</strong> album dilihat <strong>[views]</strong> kali',
        'xx_s_gallery' => 'Galeri %s',
        'stat3' => '<strong>[pictures]</strong> foto dalam <strong>[albums]</strong> album dengan <strong>[comments]</strong> komentar dilihat <strong>[views]</strong> kali'
        );

    $lang_list_users = array('user_list' => 'Daftar user',
        'no_user_gal' => 'Tidak ada galeri user',
        'n_albums' => '%s album',
        'n_pics' => '%s foto'
        );

    $lang_list_albums = array('n_pictures' => '%s foto',
        'last_added' => ', yang terakhir ditambahkan pada %s'
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
if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array('upd_alb_n' => 'Update album %s',
        'general_settings' => 'Setting umum',
        'alb_title' => 'Judul album',
        'alb_cat' => 'Kategori album',
        'alb_desc' => 'Keterangan album',
        'alb_thumb' => 'Thumbnail album',
        'alb_perm' => 'Izin akses untuk album ini',
        'can_view' => 'Album bisa dilihat oleh',
        'can_upload' => 'Pengunjung bisa mengupload foto',
        'can_post_comments' => 'Pengunjung bisa memberi komentar',
        'can_rate' => 'Pengunjung bisa memberi penilaian',
        'user_gal' => 'Galeri User',
        'no_cat' => '* Tanpa kategori *',
        'alb_empty' => 'Album ini kosong',
        'last_uploaded' => 'Terakhir diupload',
        'public_alb' => 'Semua (album publik)',
        'me_only' => 'Hanya saya saja',
        'owner_only' => 'Pemilik album (%s) saja',
        'groupp_only' => 'Anggota grup \'%s\'',
        'err_no_alb_to_modify' => 'Tak ada album yang bisa anda ubah dalam database.',
        'update' => 'Update album'
        );
// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //
if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array('already_rated' => 'Maaf, anda telah menilai foto ini',
        'rate_ok' => 'Penilaian anda telah diterima',
        );
// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //
if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {
    $lang_register_disclamer = <<<EOT
Meskipun para administrator dari {SITE_NAME} akan berusaha mengubah atau menghapus materi yang tidak pantas secepat mungkin, adalah mustahil untuk mereview semua kiriman. Karena itu anda paham bahwa seluruh komentar yang dikirim ke situs ini adalah merupakan pandangan dan pendapat pengirimnya dan bukan merupakan pandangan administrator dan webmaster (terkecuali yang dikirimkan oleh orang-orang tersebut) dan karenanya bukan merupakan tanggung jawab mereka.<br />
<br />
Anda setuju untuk tidak mengirimkan materi yang bersifat menghina, tidak patut, jorok, menghasut, mengancam, porno, atau materi apapun yang bisa melanggar hukum. Anda setuju bahwa webmaster, administrator dan moderator dari {SITE_NAME} memiliki hak untuk mangahapus atau merubah isi situs ini kapan saja jika dipandang perlu. Sebagai user anda setuju bahwa semua informasi yang anda masukkan disini akan disimpan dalam database kami. Walaupun informasi ini tidak akan diberikan pada pihak ketiga manapun tanpa persetujuan anda, webmaster dan administrator bertanggung jawab terhadap semua jenis upaya hacking yang bisa membuka data tersebut.<br />
<br />
Situs ini menggunakan cookie untuk menyimpan informasi di komputer anda. Informasi ini hanya berfungsi untuk memudahkan anda mengakses situs ini. Alamat email hanya digunakan untuk mengirimkan dan mengkonfirmasi pendaftaran serta password anda.<br />
<br />
Dengan mengklik link 'Saya setuju' Dibawah ini anda setuju untuk diikat dengan ketentuan tersebut diatas.
EOT;

    $lang_register_php = array('page_title' => 'Registrasi user',
        'term_cond' => 'Syarat penggunaan',
        'i_agree' => 'Saya setuju',
        'submit' => 'Kirim registrasi',
        'err_user_exists' => 'Username yang anda masukkan telah digunakan, silahkan pilih yang lain',
        'err_password_mismatch' => 'Kedua password tidak cocok, silahkan masukkan lagi',
        'err_uname_short' => 'Username harus terdiri dari 2 karakter minimum',
        'err_password_short' => 'Password harus terdiri dari 2 karakter minimum',
        'err_uname_pass_diff' => 'Username dan password harus berbeda',
        'err_invalid_email' => 'Alamat email tidak valid',
        'err_duplicate_email' => 'User lain telah terdaftar dengan alamat email yang anda masukkan',
        'enter_info' => 'Masukkan informasi registrasi',
        'required_info' => 'Informasi yang harus diisi',
        'optional_info' => 'Informasi opsional',
        'username' => 'Username',
        'password' => 'Password',
        'password_again' => 'Ketik ulang Password',
        'email' => 'Email',
        'location' => 'Lokasi',
        'interests' => 'Hobi / Interest',
        'website' => 'Website',
        'occupation' => 'Pekerjaan',
        'error' => 'ERROR',
        'confirm_email_subject' => 'Konfirmasi registrasi - %s',
        'information' => 'Informasi',
        'failed_sending_email' => 'Email konfirmasi registrasi tidak dapat dikirimkan !',
        'thank_you' => 'Terima kasih untuk registrasi.<br /><br />Sebuah email yang berisi informasi tentang cara mengaktifkan account anda telah dikirimkan ke alamat email yang anda sediakan.',
        'acct_created' => 'Account anda telah dibuat dan anda sekarang bisa login dengan username dan password anda',
        'acct_active' => 'Account anda sekarang telah aktif dan anda bisa login dengan username dan password anda',
        'acct_already_act' => 'Acoount anda sudah aktif !',
        'acct_act_failed' => 'Account ini tidak bisa diaktifkan !',
        'err_unk_user' => 'User yang dimaksud tidak ditemukan !',
        'x_s_profile' => 'Profil %s',
        'group' => 'Grup',
        'reg_date' => 'Bergabung',
        'disk_usage' => 'Ruang digunakan',
        'change_pass' => 'Ubah password',
        'current_pass' => 'Password kini',
        'new_pass' => 'Password baru',
        'new_pass_again' => 'Ketik lagi password baru',
        'err_curr_pass' => 'Password salah',
        'apply_modif' => 'Lakukan perubahan',
        'change_pass' => 'Ubah password',
        'update_success' => 'Profile anda telah diupdate',
        'pass_chg_success' => 'Password anda telah diubah',
        'pass_chg_error' => ' Password anda tidak diubah ',
        );

    $lang_register_confirm_email = <<<EOT
Terima kasih anda telah mendaftar di {SITE_NAME}

Username anda adalah : "{USER_NAME}"
Password anda adalah : "{PASSWORD}"

Untuk mengaktifkan account anda, anda harus mengklik link di bawah ini atau kopi dan paste pada web browser anda.

{ACT_LINK}

Hormat kami,

Manajemen {SITE_NAME}

EOT;
} 
// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //
if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array('title' => 'Review komentar',
        'no_comment' => 'Tidak ada komentar untuk direview',
        'n_comm_del' => '%s komentar dihapus',
        'n_comm_disp' => 'Jumlah komentar untuk ditampilkan',
        'see_prev' => 'Lihat sebelumnya',
        'see_next' => 'Lihat berikutnya',
        'del_comm' => 'Hapus komentar yang dipilih',
        );
// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //
// if (defined('SEARCH_PHP'))
    $lang_search_php = array(0 => 'Cari dalam database image',
        );
// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //
if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array('page_title' => 'Cari foto baru',
        'select_dir' => 'Pilih direktori',
        'select_dir_msg' => 'Fungsi ini membolehkan anda untuk menambahkan sekumpulan foto yang telah anda upload ke server anda melalui FTP.<br /><br />Pilih direktori di mana anda telah mengupload foto-foto anda',
        'no_pic_to_add' => 'Tak ada foto untuk ditambahkan',
        'need_one_album' => 'Anda perlu minimum satu buah album untuk menjalankan fungsi ini',
        'warning' => 'Peringatan',
        'change_perm' => 'skrip tidak bisa menulis pada direktori ini, anda perlu merubah modenya ke 755 atau 777 sebelum mencoba menambahkan foto !',
        'target_album' => '<strong>Masukkan foto &quot;</strong>%s<strong>&quot; kedalam </strong>%s',
        'folder' => 'Folder',
        'image' => 'Image',
        'album' => 'Album',
        'result' => 'Hasil',
        'dir_ro' => 'Tidak bisa ditulisi. ',
        'dir_cant_read' => 'Tidak bisa dibaca. ',
        'insert' => 'Menambahkan foto baru kedalam galeri',
        'list_new_pic' => 'Daftar foto baru',
        'insert_selected' => 'Masukkan foto yang dipilih',
        'no_pic_found' => 'Tidak ada foto baru yang ditemukan',
        'be_patient' => 'Sabar, skrip memerlukan waktu untuk menambahkan foto',
        'notes' => '<ul>' . '<li><strong>OK</strong> : berarti foto telah berhasil ditambahkan' . '<li><strong>DP</strong> : berarti foto merupakan duplikat dan telah berada dalam database' . '<li><strong>PB</strong> : berarti foto tidak bisa ditambahkan, periksa konfigurasi dan permission direktori dimana foto berada' . '<li>Jika \'tanda\' OK, DP, PB tidak tampil, klik pada tanda yang tidak tampil tersebut untuk melihat pesan error yang dihasilkan oleh PHP' . '<li>Jika browser anda timeout, klik tombol reload/refresh' . '</ul>',
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
if (defined('UPLOAD_PHP')) $lang_upload_php = array('title' => 'Upload foto',
        'max_fsize' => 'Ukuran file maksimum yang diizinkan adalah %s KB',
        'album' => 'Album',
        'picture' => 'Foto',
        'pic_title' => 'Judul Foto',
        'description' => 'Keterangan foto',
        'keywords' => 'Kata Kunci (pisahkan dengan spasi)',
        'err_no_alb_uploadables' => 'Maaf, tak ada album yang dizinkan bagi anda untuk mengupload foto',
        );
// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //
if (defined('USERMGR_PHP')) $lang_usermgr_php = array('title' => 'Pengaturan user',
        'name_a' => 'Nama mendaki',
        'name_d' => 'Nama menurun',
        'group_a' => 'Grup mendaki',
        'group_d' => 'Grup menurun',
        'reg_a' => 'Tanggal daftar mendaki',
        'reg_d' => ' Tanggal daftar menurun',
        'pic_a' => 'Jumlah foto mendaki',
        'pic_d' => ' Jumlah foto menurun',
        'disku_a' => 'Penggunaan ruang mendaki',
        'disku_d' => ' Penggunaan ruang menurun',
        'sort_by' => 'Urutkan user menurut',
        'err_no_users' => 'Tabel user kosong !',
        'err_edit_self' => 'Anda tidak bisa mengubaubah profil anda sendiri, gunakan link \'Profilku\' untuk itu',
        'edit' => 'UBAH',
        'delete' => 'HAPUS',
        'name' => 'User name',
        'group' => 'Grup',
        'inactive' => 'Nonaktif',
        'operations' => 'Operasi',
        'pictures' => 'Foto',
        'disk_space' => 'Ruang digunakan / Kuota',
        'registered_on' => 'Register pada',
        'u_user_on_p_pages' => '%d user pada %d halaman',
        'confirm_del' => 'Anda yakin mau mengHAPUS user ini ? \\nSemua foto dan album user ini akan ikut terhapus.',
        'mail' => 'MAIL',
        'err_unknown_user' => 'User yang dimaksud tidak ditemukan !',
        'modify_user' => 'Ubah user',
        'notes' => 'Catatan',
        'note_list' => '<li>Jika anda tidak ingin merubah password sekarang, biarkan field "password" kosong',
        'password' => 'Password',
        'user_active' => 'User aktif',
        'user_group' => 'Grup User',
        'user_email' => 'Email user',
        'user_web_site' => 'Situs web user',
        'create_new_user' => 'Buat user baru',
        'user_location' => 'Lokasi user',
        'user_interests' => 'Hobi/interest user',
        'user_occupation' => 'Pekerjaan user',
        );
// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //
if (defined('UTIL_PHP')) $lang_util_php = array('title' => 'Ubah dimensi foto',

        'what_it_does' => 'Kegunaannya',

        'what_update_titles' => 'Update judul dari nama file',

        'what_delete_title' => 'Hapus judul',

        'what_rebuild' => 'Buat kembali thumbnail dan ubah dimensi foto',

        'what_delete_originals' => 'Menghapus foto lama yang talah diubah dimansinya dan menggantinya dengan foto baru yang telah diubah dimensinya',

        'file' => 'File',

        'title_set_to' => 'judul ubah ke',

        'submit_form' => 'kirim',

        'updated_succesfully' => 'berhasil diupdate',

        'error_create' => 'ERROR membuat',

        'continue' => 'Proses image lain',

        'main_success' => 'File %s telah berhasil digunakan sebagai foto utama',

        'error_rename' => 'Error mengubah nama %s ke %s',

        'error_not_found' => 'File %s tidak ditemukan',

        'back' => 'kembali',

        'thumbs_wait' => 'Sedang mengupdate thumbnail dan/atau mengubah dimensi image, tunggu sejenak...',

        'thumbs_continue_wait' => 'Lanjutkan mengupdate thumbnail dan/atau mengubah dimensi image...',

        'titles_wait' => 'Sedang mengupdate judul, tunggu sejenak...',

        'delete_wait' => 'Sedang menghapus judul, tunggu sejenak...',

        'replace_wait' => 'Sedang menghapus yang original dan menggantinya dengan image yang telah diubah dimensinya, tunggu sejenak..',

        'instruction' => 'Instruksi cepat',

        'instruction_action' => 'Pilih fungsi',

        'instruction_parameter' => 'Set parameter',

        'instruction_album' => 'Pilih album',

        'instruction_press' => 'Tekan %s',

        'update' => 'Update thumbnail dan/atau ubah dimensi foto',

        'update_what' => 'Apa yang harus diupdate',

        'update_thumb' => 'Thumbnail saja',

        'update_pic' => 'Ubah dimensi fota saja',

        'update_both' => 'Thumbnail dan ubah ukuran foto',

        'update_number' => 'Jumlah image yang diproses per klik',

        'update_option' => '(Coba set dengan nilai yang lebih kecil jika anda mengalami masalah timeout browser)',

        'filename_title' => 'Nama File &rArr; Judul foto',

        'filename_how' => 'Bagaimana nama file akan diubah',

        'filename_remove' => 'Hapus akhiran .jpg dan ganti _ (underscore) dengan spasi',

        'filename_euro' => 'Ubah 2003_11_23_13_20_20.jpg ke 23/11/2003 13:20',

        'filename_us' => 'Ubah 2003_11_23_13_20_20.jpg ke 11/23/2003 13:20',

        'filename_time' => 'Ubah 2003_11_23_13_20_20.jpg ke 13:20',

        'delete' => 'Hapus judul foto atau image yang tela diubah dimensinya',

        'delete_title' => 'Hapus judul foto',

        'delete_original' => 'Hapus foto yang telah diubah dimensinya',

        'delete_replace' => 'Hapus image original ganti dengan image yang telah diubah dimensinya',

        'select_album' => 'Pilih album',

        );
// ------------------------------------------------------------------------- //
// File pagetitle.inc.php
// ------------------------------------------------------------------------- //
$lang_pagetitle_php = array(
'divider' => '&raquo;',
    'viewing' => 'Lihat Foto',
    'usr' => "- Galeri",
    'photogallery' => 'Galeri Foto',
    );

?>