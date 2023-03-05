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
// Greek language by lykman, Ελληνική μετάφραση από Λυκούργο Μ., ver. 1.0   //
// You can mail me for errors or suggestions about GReek, lykman@freemail.gr //
// Για τυχόν λάθη ή προτάσεις στα Ελληνικά, στείλτε mail, lykman@freemail.gr //
// ------------------------------------------------------------------------- //
define('PIC_VIEWS', 'Views');
define('PIC_VOTES', 'Votes');
define('PIC_COMMENTS', 'Comments');

// info about translators and translated language
$lang_translation_info = array(
    'lang_name_english' => 'Greek', // the name of your language in English, e.g. 'Greek' or 'Spanish'
    'lang_name_native' => '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;', // the name of your language in your mother tongue (for non-latin alphabets, use unicode), e.g. '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;' or 'Espaρol'
    'lang_country_code' => 'GR', // the two-letter code for the country your language is most-often spoken (refer to http://www.iana.org/cctld/cctld-whois.htm), e.g. 'gr' or 'es'
    'trans_name' => 'lykman', // the name of the translator - can be a nickname
    'trans_email' => 'lykman@freemail.gr', // translator's email address (optional)
    'trans_website' => 'http://www.lykman.com', // translator's website (optional)
    'trans_date' => '03-10-2003', // the date the translation was created / last modified
    );

$lang_charset = 'iso-8859-7';
$lang_text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)

// shortcuts for Byte, Kilo, Mega
$lang_byte_units = array('Bytes', 'KB', 'MB');
// Day of weeks and months
$lang_day_of_week = array('Κυρ', 'Δευ', 'Tρι', 'Τετ', 'Πεμ', 'Παρ', 'Σαβ');
$lang_month = array('Ιαν', 'Φεβ', 'Mαρ', 'Aπρ', 'Mαι', 'Ιουν', 'Ιουλ', 'Aυγ', 'Σεπ', 'Οκτ', 'Noε', 'Δεκ');
// Some common strings
$lang_yes = 'Ναι';
$lang_no = 'Οχι';
$lang_back = 'ΠΙΣΩ';
$lang_continue = 'ΣΥΝΕΧΕΙΑ';
$lang_info = 'Πληροφορίες';
$lang_error = 'Λάθος';
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

$lang_meta_album_names = array('random' => 'Τυχαίες φωτογραφίες',
    'lastup' => 'Τελευταίες προσθήκες',
    'lastupby' => 'My Last Additions', // new 1.2.2
    'lastalb' => 'Πρόσφατα ενημερωμένα άλμπουμ',
    'lastcom' => 'Τελευταία σχόλια',
    'lastcomby' => 'My Last comments', // new 1.2.2
    'topn' => 'Περισσότερες εμφανίσεις',
    'toprated' => 'Υψηλότερη βαθμολογία',
    'lasthits' => 'Τελευταίες εμφανίσεις',
    'search' => 'Αποτελέσματα αναζήτησης',
    'favpics' => 'Αγαπημένες φωτογραφίες'
    );

$lang_errors = array('access_denied' => 'Δεν επιτρέπετε η πρόσβαση σε αυτήν την σελίδα.',
    'perm_denied' => 'Δεν επιτρέπετε να εκτελέσετε αυτήν την λειτουργία.',
    'param_missing' => 'Ελειπείς παράμετροι για την εκτέλεση.',
    'non_exist_ap' => 'Το επιλεγμένο άλμπουμ/φωτογραφία δεν υπάρχει!',
    'quota_exceeded' => 'Ο χώρος σας γέμισε<br /><br />Σας αναλογεί χώρος [quota]K, οι φωτογραφίες σας αυτή την στιγμή χρησιμοποιούν [space]K, προσθέτοντας αυτήν την φωτογραφία θα υπερβείτε το όριο.',
    'gd_file_type_err' => 'Χρησιμοποιώντας το GD image library, επιτρεπόμενα φορμά είναι μόνο τα JPEG και PNG.',
    'invalid_image' => 'Η φωτογραφία που ανεβάσατε είναι προβληματική ή ελειπής.',
    'resize_failed' => 'Δεν ήταν δυνατόν να δημιουργηθεί thumbnail ή εικόνα μειωμένου μεγέθους.',
    'no_img_to_display' => 'Καμμία εικόνα προς εμφάνιση',
    'non_exist_cat' => 'Η επιλεγμένη κατηγορία δεν υπάρχει',
    'orphan_cat' => 'Η κατηγορία δεν έχει δημιουργό, εκτελεί τον category manager για να διορθώσει το πρόβλημα.',
    'directory_ro' => 'Ο κατάλογος \'%s\' δεν είναι διαθέσιμος για τροποποίηση, οι φωτογραφίες δεν μπορούν να διαγραφούν',
    'non_exist_comment' => 'Το επιλεγμένο σχόλιο δεν υπάρχει.',
    'pic_in_invalid_album' => 'Η φωτογραφία είναι σε ανύπαρκτο άλμπουμ (%s)!?',
    'banned' => 'Εχετε αποκλειστεί από αυτό το site.',
    'not_with_udb' => 'Αυτή η λειτουργία είναι απενεργοποιημένη στο Coppermine γιατί είναι αλληλεπιδραστική με το software του φόρουμ. Η αυτό που προσπαθείτε να κάνετε δεν υποστηρίζεται στην παρούσα διαμόρφωση, ή την λειτουργία θα πρέπει να την χειρίζεται το ίδιο το φόρουμ.',
    'members_only' => 'This function is for members only, please join.', // changed in cpg1.2.0nuke
    'mustbe_god' => 'This function is only for the site admin. You must be logged in as superadmin, god account to access this function'
    );
// ------------------------------------------------------------------------- //
// File theme.php
// ------------------------------------------------------------------------- //
$lang_main_menu = array('alb_list_title' => 'Μετακίνηση στην λίστα των άλμπουμ',
    'alb_list_lnk' => 'Λίστα των άλμπουμ',
    'my_gal_title' => 'Μετακίνηση στo προσωπικό φώτο άλμπουμ',
    'my_gal_lnk' => 'Το φώτο άλμπουμ μου',
    'my_prof_lnk' => 'Το προφίλ μου',
    'adm_mode_title' => 'Λειτουργίες διαχείρησης',
    'adm_mode_lnk' => 'Κατάσταση διαχείρησης',
    'usr_mode_title' => 'Λειτουργίες χρήστη',
    'usr_mode_lnk' => 'Κατάσταση χρήστη',
    'upload_pic_title' => 'Προσθήκη φωτογραφίας σε άλμπουμ',
    'upload_pic_lnk' => 'Προσθήκη φωτογραφίας',
    'register_title' => 'Δημιουργία λογαριασμού',
    'register_lnk' => 'Εγγραφή',
    'login_lnk' => 'Είσοδος',
    'logout_lnk' => 'Εξοδος',
    'lastup_lnk' => 'Τελευταίες προσθήκες',
    'lastcom_lnk' => 'Τελευταία σχόλια',
    'topn_lnk' => 'Περισσότερες εμφανίσεις',
    'toprated_lnk' => 'Υψηλότερη βαθμολογία',
    'search_lnk' => 'Αναζήτηση',
    'fav_lnk' => 'Τα αγαπημένα μου',
    );

$lang_gallery_admin_menu = array('upl_app_lnk' => 'Εγκριση προσθήκης',
    'config_lnk' => 'Ρυθμίσεις',
    'albums_lnk' => 'Αλμπουμ',
    'categories_lnk' => 'Κατηγορίες',
    'users_lnk' => 'Χρήστες',
    'groups_lnk' => 'Ομάδες',
    'comments_lnk' => 'Σχόλια',
    'searchnew_lnk' => 'Προσθήκη πλήθους φωτογραφιών',
    'util_lnk' => 'Αλλαγή μεγέθους φωτογραφιών',
    'ban_lnk' => 'Αποκλεισμός χρηστών',
    );

$lang_user_admin_menu = array('albmgr_lnk' => 'Δημιουργία / ταξινόμηση άλμπουμ',
    'modifyalb_lnk' => 'Τροποποίηση των άλμπουμ',
    'my_prof_lnk' => 'Το προφίλ μου',
    );

$lang_cat_list = array('category' => 'Κατηγορία',
    'albums' => 'Aλμπουμ',
    'pictures' => 'Φωτογραφίες',
    );

$lang_album_list = array('album_on_page' => '%d άλμπουμ σε %d σελίδα(ες)'
    );

$lang_thumb_view = array('date' => 'ΗΜ/ΝΙΑ',
    'name' => 'ΟΝΟΜΑ ΑΡΧΕΙΟΥ',
    'title' => 'ΤΙΤΛΟΣ',
    'sort_da' => 'Στοίχιση από παλαιότερη προς νεότερη ημερομηνία',
    'sort_dd' => 'Στοίχιση από νεότερη προς παλαιότερη ημερομηνία',
    'sort_na' => 'Στοίχιση αλφαβητικά αύξουσα',
    'sort_nd' => 'Στοίχιση αλφαβητικά φθίνουσα',
    'sort_ta' => 'Στοίχιση με τίτλο αύξουσα',
    'sort_td' => 'Στοίχιση με τίτλο φθίνουσα',
    'pic_on_page' => '%d φωτογραφία(ες) σε %d σελίδα(ες)',
    'user_on_page' => '%d χρήστης(ες) σε %d σελίδα(ες)',
    'sort_ra' => 'Sort by rating ascending', // new in cpg1.2.0nuke
    'sort_rd' => 'Sort by rating descending', // new in cpg1.2.0nuke
    'rating' => 'RATING', // new in cpg1.2.0nuke
    'sort_title' => 'Sort pictures by:', // new in cpg1.2.0nuke
    );

$lang_img_nav_bar = array('thumb_title' => 'Επιστροφή στην σελίδα με τα thumbnail',
    'pic_info_title' => 'Εμφάνιση/απόκρυψη πληροφοριών φωτογραφίας',
    'slideshow_title' => 'Slideshow',
    'slideshow_disabled' => 'e-cards are disabled', // new in cpg1.2.0nuke
    'slideshow_disabled_msg' => $lang_errors['members_only'], // new in cpg1.2.0nuke
    'ecard_title' => 'Αποστολή αυτής της εικόνας σαν ηλεκτρονική κάρτα',
    'ecard_disabled' => 'Οι ηλεκτρονικές κάρτες έχουν απενεργοποιηθεί',
    'ecard_disabled_msg' => 'Δεν σας επιτρέπετε να στείλετε ηλεκτρονικές κάρτες',
    'prev_title' => 'Εμφάνιση προηγούμενης φωτογραφίας',
    'next_title' => 'Εμφάνιση επόμενης φωτογραφίας',
    'pic_pos' => 'ΦΩΤΟΓΡΑΦΙΑ %s/%s',
    'no_more_images' => 'There are no more images in this galley', // new in cpg1.2.0nuke
    'no_less_images' => 'This is the first image in the gallery', // new in cpg1.2.0nuke
    );

$lang_rate_pic = array('rate_this_pic' => 'Βαθμολογήστε αυτήν την φωτογραφία ',
    'no_votes' => '(Χωρίς ψήφο ακόμα)',
    'rating' => '(τωρινή βαθμολογία : %s / 5 με %s ψήφους)',
    'rubbish' => 'Χάλια',
    'poor' => 'Κακή',
    'fair' => 'Μέτρια',
    'good' => 'Καλή',
    'excellent' => 'Αψογη',
    'great' => 'Καταπληκτική',
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
    'file' => 'Αρχείο: ',
    'line' => 'Γραμμή: ',
    );

$lang_display_thumbnails = array('filename' => 'Ονομα αρχείου : ',
    'filesize' => 'Μέγεθος αρχείου : ',
    'dimensions' => 'Διαστάσεις : ',
    'date_added' => 'Ημερομηνία προσθήκης : '
    );

$lang_get_pic_data = array('n_comments' => '%s σχόλια',
    'n_views' => '%s εμφανίσεις',
    'n_votes' => '(%s ψήφοι)'
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
if (defined('SMILIES_PHP')) $lang_smilies_inc_php = array('Exclamation' => 'Επεξήγηση',
        'Question' => 'Ερώτηση',
        'Very Happy' => 'Πολύ χαρούμενος',
        'Smile' => 'Χαμόγελο',
        'Sad' => 'Λυπημένος',
        'Surprised' => 'Εκπληκτος',
        'Shocked' => 'Σοκαρισμένος',
        'Confused' => 'Μπερδεμένος',
        'Cool' => 'Cool',
        'Laughing' => 'Γελαστός',
        'Mad' => 'Τρελός',
        'Razz' => 'Razz',
        'Embarassed' => 'Ντροπιασμένος',
        'Crying or Very sad' => 'Κλαμένος',
        'Evil or Very Mad' => 'Διαβολικός',
        'Twisted Evil' => 'Διαβολεμένος',
        'Rolling Eyes' => 'Γυριστά μάτια',
        'Wink' => 'Wink',
        'Idea' => 'Iδέα',
        'Arrow' => 'Βέλος',
        'Neutral' => 'Ουδέτερος',
        'Mr. Green' => 'Mr. Πράσινος',
        );
// ------------------------------------------------------------------------- //
// File addpic.php
// ------------------------------------------------------------------------- //
// void
// ------------------------------------------------------------------------- //
// File admin.php
// ------------------------------------------------------------------------- //
if (defined('ADMIN_PHP')) $lang_admin_php = array(0 => 'Εγκαταλείποντας τις λειτουργίες διαχείρησης...',
        1 => 'Εισοδος στις λειτουργίες διαχείρησης...',
        );
// ------------------------------------------------------------------------- //
// File albmgr.php
// ------------------------------------------------------------------------- //
if (defined('ALBMGR_PHP')) $lang_albmgr_php = array('alb_need_name' => 'Τα άλμπουμ πρέπει να έχουν όνομα !',
        'confirm_modifs' => 'Ειστε σίγουρος πως θέλετε να κάνετε αυτές τις αλλαγές ?',
        'no_change' => 'Δεν κάνατε καμία αλλαγή !',
        'new_album' => 'Nέο άλμπουμ',
        'confirm_delete1' => 'Ειστε σίγουρος πως θέλετε να διαγράψετε αυτό το άλμπουμ ?',
        'confirm_delete2' => '\nΟλες οι φωτογραφίες και τα σχόλια που περιέχονται θα χαθούν !',
        'select_first' => 'Επιλέξτε ένα αλμπουμ πρώτα',
        'alb_mrg' => 'Διαχείρηση Aλμπουμ',
        'my_gallery' => '* Το φώτο άλμπουμ μου *',
        'no_category' => '* Χωρίς κατηγορία *',
        'delete' => 'Διαγραφή',
        'new' => 'Nέο',
        'apply_modifs' => 'Εφαρμογή αλλαγών',
        'select_category' => 'Select category',
        );
// ------------------------------------------------------------------------- //
// File catmgr.php
// ------------------------------------------------------------------------- //
if (defined('CATMGR_PHP')) $lang_catmgr_php = array('miss_param' => 'Οι παράμετροι που απαιτούνται για \'%s\'λειτουργία δεν δόθηκαν !',
        'unknown_cat' => 'Η επιλεγμένη κατηγορία δεν υπάρχει στην database',
        'usergal_cat_ro' => 'Τα φώτο άλμπουμ των χρηστών δεν μπορούν να διαγραφούν !',
        'manage_cat' => 'Διαχείρηση κατηγοριών',
        'confirm_delete' => 'Είστε σίγουρος πως θέλετε να διαγράψετε αυτήν την κατηγορία',
        'category' => 'Κατηγορία',
        'operations' => 'Λειτουργίες',
        'move_into' => 'Mετακίνηση σε',
        'update_create' => 'Ανανέωση/Δημιουργία κατηγορίας',
        'parent_cat' => 'Δημιουργός κατηγορίας',
        'cat_title' => 'Τίτλος κατηγορίας',
        'cat_desc' => 'Περιγραφή κατηγορίας'
        );
// ------------------------------------------------------------------------- //
// File config.php
// ------------------------------------------------------------------------- //
if (defined('CONFIG_PHP')) $lang_config_php = array('title' => 'Ρυθμίσεις',
        'restore_cfg' => 'Επαναφορά αρχικών ρυθμίσεων',
        'save_cfg' => 'Αποθήκευση νέων ρυθμίσεων',
        'notes' => 'Σημειώσεις',
        'info' => 'Πληροφορίες',
        'upd_success' => 'Οι ρυθμίσεις του Coppermine ανανεώθηκαν',
        'restore_success' => 'Οι προεγκατεστημένες ρυθμίσεις του Coppermine επαναφέρθηκαν',
        'name_a' => 'Αυξων όνομα',
        'name_d' => 'Φθίνων όνομα',
        'title_a' => 'Αύξων τίτλος',
        'title_d' => 'Φθίνων τίτλος',
        'date_a' => 'Αυξουσα ημερομηνία',
        'date_d' => 'Φθίνουσα ημερομηνία',
        'rating_a' => 'Rating ascending', // new in cpg1.2.0nuke
        'rating_d' => 'Rating descending', // new in cpg1.2.0nuke
        'th_any' => 'Max Aspect',
        'th_ht' => 'Height',
        'th_wd' => 'Width',
        );
// start left side interpretation
if (defined('CONFIG_PHP')) $lang_config_data = array(
        // General settings
        'Γενικές επιλογές',
        array(
            'Ονομα γκάλερι', 'gallery_name', 0),
        array(
            'Περιγραφή φώτο άλμπουμ', 'gallery_description', 0),
        array(
            'Ε-mail διαχειριστή του φώτο άλμπουμ', 'gallery_admin_email', 0),
        array(
            'Διεύθυνση παραλήπτη για \'Δείτε περισσότερες φωτογραφίες\' διασύνδεση στις ηλεκτρονικές κάρτες', 'ecards_more_pic_target', 0),
        array(
            'Γλώσσα', 'lang', 5),
// for postnuke change
        array('Θέμα', 'cpgtheme', 6),
        array(
            'Page Specific Titles instead of >Coppermine', 'nice_titles', 1), 
        array('Show blocks on the right', 'right_blocks', 1), // new 1.2.2
        // 'Album list view',
        'Εμφάνιση Λίστας Αλμπουμ',
        array(
            'Πλάτος κυρίως πίνακα (πίξελ ή %)', 'main_table_width', 0),
        array(
            'Πλήθος υποκατηγοριών προς εμφάνιση', 'subcat_level', 0),
        array(
            'Πλήθος άλμπουμ προς εμφάνιση', 'albums_per_page', 0),
        array(
            'Πλήθος στηλών για την λίστα των άλμπουμ', 'album_list_cols', 0),
        array(
            'Μέγεθος των thumbnails σε πίξελ', 'alb_list_thumb_size', 0),
        array(
            'Περιεχόμενο της κεντρικής σελίδας', 'main_page_layout', 0),
        array(
            'Εμφάνιση πρώτου επιπέδου thumbnails του άλμπουμ στις κατηγορίες', 'first_level', 1), 
        // 'Thumbnail view',
        'Εμφάνιση Thumbnail',
        array(
            'Πλήθος στηλών στην σελίδα των thumbnail', 'thumbcols', 0),
        array(
            'Πλήθος γραμμών στην σελίδα των thumbnail', 'thumbrows', 0),
        array(
            'Μέγιστο πλήθος tabs για εμφάνιση', 'max_tabs', 0),
        array(
            'Εμφάνιση ενσωματωμένου σχόλιου (επιπρόσθετα του τίτλου) κάτω από το thumbnail', 'caption_in_thumbview', 1),
        array(
            'Εμφάνιση πλήθους σχόλιων κάτω από το thumbnail', 'display_comment_count', 1),
        array(
            'Προεπιλογή ρύθμισης στοίχησης για τις φωτογραφίες', 'default_sort_order', 3),
        array(
            'Ελάχιστο πλήθος ψήφων για μια φωτογραφία για να εμφανιστεί αυτή στην λίστα με την \'top-rated\' .', 'min_votes_for_rating', 0),
        array(
            'Alts and title tags of thumbnail show title and keyword instead of picinfo', 'seo_alts', 1), // new in cpg1.2.0nuke
        // 'Image view &amp; Comment settings',
        'Εμφάνιση εικόνων &amp; Ρυθμίσεις σχόλιων',
        array(
            'Πλάτος πίνακα για εμφάνιση φωτογραφιών (πίξελ ή %)', 'picture_table_width', 0),
        array(
            'Να εμφανίζονται οι πληροφορίες των φωτογραφιών πάντα?', 'display_pic_info', 1),
        array(
            'Φιλτράρισμα απαγορευμένων λέξεων στα σχόλια', 'filter_bad_words', 1),
        array(
            'Να επιτραπούν οι φατσούλες στα σχόλια', 'enable_smilies', 1),
        array(
            'Allow several consecutive comments on one pic from the same user', 'disable_flood_protection', 1), // new in cpg1.2.0nuke
        array(
            'Email site admin upon comment submission' , 'comment_email_notification', 1), // new in cpg1.2.0nuke
        array(
            'Mέγιστο μήκος για την περιγραφή μιας φωτογραφίας', 'max_img_desc_length', 0),
        array(
            'Mέγιστο πλήθος χαρακτήρων ανά λέξη', 'max_com_wlength', 0),
        array(
            'Mέγιστος αριθμός γραμμών ανά σχόλιο', 'max_com_lines', 0),
        array(
            'Mέγιστο μήκος σχολίου', 'max_com_size', 0),
        array(
            'Εμφάνιση film strip', 'display_film_strip', 1),
        array(
            'Αριθμός αντικειμένων μέσα στο film strip', 'max_film_strip_items', 0),
        array(
            'Allow viewing of full size pic by anonymous', 'allow_anon_fullsize', 1), // new in cpg1.2.0nuke
        array('Number of days between being able to vote on the same image','keep_votes_time',0), // new in cpg1.2.2c nuke
//'Pictures and thumbnails settings',
        'Pυθμίσεις φωτογραφιών και thumbnails',
        array(
            'Ποιότητα των JPEG αρχείων', 'jpeg_qual', 0),
        array(
            'Μέγιστη διάσταση του thumbnail <strong>*</strong>', 'thumb_width', 0),
        array(
            'Χρήση διάστασης ( πλάτος ή ύψος ή Μέγιστη αναλογία για το thumbnail )<strong>*</strong>', 'thumb_use', 7),
        array(
            'Δημιουργία ενδιάμεσων φωτογραφιών', 'make_intermediate', 1),
        array(
            'Mέγιστο πλάτος ή ύψος ενδιάμεσης φωτογραφίας <strong>*</strong>', 'picture_width', 0),
        array(
            'Mέγιστο μέγεθος για τις φωτογραφίες για προσθήκη (KB)', 'max_upl_size', 0),
        array(
            'Mέγιστο πλάτος ή ύψος για τις φωτογραφίες για προσθήκη (πίξελ)', 'max_upl_width_height', 0), 
        // 'User settings',
        'Ρυθμίσεις χρηστών',
        array(
            'Επιτρέπετε η εγγραφή νέου χρήστη', 'allow_user_registration', 1),
        array(
            'Η εγγραφή νέου χρήστη να απαιτεί επαλήθευση email', 'reg_requires_valid_email', 1),
        array(
            'Επιτρέπετε δύο χρήστες να έχουν κοινή διεύθυνση email', 'allow_duplicate_emails_addr', 1),
        array(
            'Οι χρήστες μπορούν να έχουν προσωπικά άλμπουμ', 'allow_private_albums', 1), 
        array('Show Users avatar instead of private album picture', 'avatar_private_album', 1),
//'Custom fields for image description (leave blank if unused)',
        'Custom πεδία για περιγραφή των φωτογραφιών (αφήστε κενό εαν δεν θα το χρησιμοποιήσετε)',
        array(
            'Ονομα 1ου πεδίου', 'user_field1_name', 0),
        array(
            'Ονομα 2ου πεδίου', 'user_field2_name', 0),
        array(
            'Ονομα 3ου πεδίου', 'user_field3_name', 0),
        array(
            'Ονομα 4ου πεδίου', 'user_field4_name', 0), 
        // 'Pictures and thumbnails advanced settings',
        'Εξιδεικευμένες ρυθμίσεις φωτογραφιών και thumbnails',
        array(
            'Εμφάνιση εικονιδίου ιδιωτικού άλμουμ στον επισκέπτη', 'show_private', 1),
        array(
            'Απαγορευμένοι χαρακτήρες σε όνομα αρχείου', 'forbiden_fname_char', 0),
        array(
            'Δεκτές επεκτάσεις αρχείων για τις προστιθέμενες φωτογραφίες', 'allowed_file_extensions', 0),
        array(
            'Mέθοδος για αλλαγή μεγέθους φωτογραφίας', 'thumb_method', 2),
        array(
            'Διαδρομή για την εφαρμογή ImageMagick / netpbm \'convert\' (παράδειγμα /usr/bin/X11/)', 'impath', 0),
        array(
            'Δεκτοί τύποι αρχείων (μόνο για το ImageMagick)', 'allowed_img_types', 0),
        array(
            'Επιλογές εντολών γραμμής για το ImageMagick', 'im_options', 0),
        array(
            'Ανάγνωση πληροφοριών EXIF στα JPEG αρχεία', 'read_exif_data', 1),
        array(
            'Read IPTC data in JPEG files', 'read_iptc_data', 1), // new in cpg1.2.0nuke
        array(
            'Κατάλογος άλμπουμ <strong>*</strong>', 'fullpath', 0),

        array(
            'Ο κατάλογος για τις φωτογραφίες των χρηστών <strong>*</strong>', 'userpics', 0),
        array(
            'Πρόθεμα των ενδιάμεσων φωτογραφιών <strong>*</strong>', 'normal_pfx', 0),
        array(
            'Πρόθεμα των thumbnails <strong>*</strong>', 'thumb_pfx', 0),
        array(
            'Προεγκαταστημένες ρυθμίσεις για καταλόγους', 'default_dir_mode', 0),
        array(
            'Προεγκαταστημένες ρυθμίσεις για φωτογραφίες', 'default_file_mode', 0),
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
        'Ρυθμίσεις για τα Cookies &amp; και τις κωδικοποιήσεις χαρακτήρων',
        array(
            'Ονομα του cookie που χρησιμοποιεί το πρόγραμμα', 'cookie_name', 0),
        array(
            'Διαδρομή για το cookie που χρησιμοποιεί το πρόγραμμα', 'cookie_path', 0),
        array(
            'Κωδικοποίηση χαρακτήρων', 'charset', 4), 
        // 'Miscellaneous settings',
        'Λοιπές ρυθμίσεις',
        array(
            'Eνεργοποίηση λειτουργίας εντοπισμού λαθών', 'debug_mode', 1),
        array(
'Enable advanced debug mode', 'advanced_debug_mode', 1), // new in cpg1.2.0nuke
array(
'Show Coppermine Update Alert to Admin', 'showupdate', 1), // new 1.2.2
        '<br /><div align="center">(*) Τα πεδία με * δεν πρέπει να αλλαχτούν εαν έχετε ήδη φωτογραφίες στα αλμπουμ σας.</div><br />'
        );
// end left side interpretation
// ------------------------------------------------------------------------- //
// File db_input.php
// ------------------------------------------------------------------------- //
if (defined('DB_INPUT_PHP')) $lang_db_input_php = array('empty_name_or_com' => 'Πρέπει να γράψετε το όνομα σας και κάποιο σχόλιο',
        'com_added' => 'Το σχόλιο σας προστέθηκε',
        'alb_need_title' => 'Πρέπει να δώσετε κάποιο τίτλο για το άλμπουμ !',
        'no_udp_needed' => 'Δεν χρειάζεται ενημέρωση.',
        'alb_updated' => 'Tο άλμπουμ ενημερώθηκε',
        'unknown_album' => 'Το επιλεγμένο άλμπουμ δεν υπάρχει, ή δεν σας επιτρέπετε να προσθέσετε φωτογραφίες σε αυτό',
        'no_pic_uploaded' => 'Δεν προστέθηκε φωτογραφία !<br /><br />Εαν είχατε επιλέξει κάποια να προσθέσετε, ελένξτε αν ο διακομιστής επιτρέπει προσθήκες...',
        'err_mkdir' => 'Αποτυχία να δημιουργήσει τον κατάλογο %s !',
        'dest_dir_ro' => 'Ο κατάλογος %s στον οποίο προσπαθήτε να γράψετε, δεν μπορεί να αλλαχτεί από το πρόγραμμα !',
        'err_move' => 'Δεν στάθηκε δυνατή η μετακίνηση από τον %s στον %s !',
        'err_fsize_too_large' => 'Tο μέγεθος της φωτογραφίας που ανεβάζετε είναι πολύ μεγάλο (μέγιστο επιτρεπόμενο είναι %s x %s) !',
        'err_imgsize_too_large' => 'Tο μέγεθος του αρχείου που ανεβάζετε είναι πολύ μεγάλο (μέγιστο επιτρεπόμενο είναι %s KB) !',
        'err_invalid_img' => 'Tο αρχείο που ανεβάζετε, δεν είναι εγκυρο σαν φωτογραφία!',
        'allowed_img_types' => 'Μπορείτε να ανεβάσετε μόνο %s φωτογραφίες.',
        'err_insert_pic' => 'Η φωτογραφία \'%s\' δεν μπορεί να προστεθεί στο άλμπουμ ',
        'upload_success' => 'Η φωτογραφία σας προστέθηκε επιτυχώς<br /><br />Θα είναι διαθέσιμη μετά την έγκριση του διαχειριστή.',
        'info' => 'Πληροφορίες',
        'com_added' => 'Το σχόλιο προστέθηκε',
        'alb_updated' => 'Το άλμπουμ ανανεώθηκε',
        'err_comment_empty' => 'Το σχόλιο σας δεν έχει περιεχόμενο !',
        'err_invalid_fext' => 'Μόνο τα αρχεία με τις ακόλουθες επεκτάσεις επιτρέπονται : <br /><br />%s.',
        'no_flood' => 'Συγνώμη αλλά είστε αυτός που έγραψε το τελευταίο σχόλιο για αυτήν την φωτογραφία<br /><br />Τροποποιήστε το σχόλιο που δημοσιεύσατε εαν θέλετε να το αλλάξετε',
        'redirect_msg' => 'Μεταφερόσαστε...<br /><br /><br />Πατήστε \'CONTINUE\' εάν η σελίδα δεν ανανεωθεί αυτόματα',
        'upl_success' => 'Η φωτογραφία σας προστέθηκε επιτυχώς',
        );
// ------------------------------------------------------------------------- //
// File delete.php
// ------------------------------------------------------------------------- //
if (defined('DELETE_PHP')) $lang_delete_php = array('caption' => 'Λεζάντα',
        'fs_pic' => 'εικόνα πλήρους μεγέθους',
        'del_success' => 'διαγράφη επιτυχώς',
        'ns_pic' => 'φωτογραφία κανονικού μεγέθους',
        'err_del' => 'δεν μπορεί να διαγραφεί',
        'thumb_pic' => 'thumbnail',
        'comment' => 'σχόλιο',
        'im_in_alb' => 'φωτογραφία σε άλμπουμ',
        'alb_del_success' => 'Aλμπουμ \'%s\' διεγράφει',
        'alb_mgr' => 'Διαχείρηση Aλμπουμ',
        'err_invalid_data' => 'Μη έγκυρα δεδομένα παρελήφθησαν στο \'%s\'',
        'create_alb' => 'Δημιουργία άλμπουμ \'%s\'',
        'update_alb' => 'Ανανέωση άλμπουμ \'%s\' με τίτλο \'%s\' και ευρετήριο \'%s\'',
        'del_pic' => 'Διαγραφή φωτογραφίας',
        'del_alb' => 'Διαγραφή άλμπουμ',
        'del_user' => 'Διαγραφή χρήστη',
        'err_unknown_user' => 'Ο επιλεγμένος χρήστης δεν υπάρχει !',
        'comment_deleted' => 'Το σχόλιο διεγράφει επιτυχώς',
        );
// ------------------------------------------------------------------------- //
// File displayecard.php
// ------------------------------------------------------------------------- //
// Void
// ------------------------------------------------------------------------- //
// File displayimage.php
// ------------------------------------------------------------------------- //
if (defined('DISPLAYIMAGE_PHP')) {
    $lang_display_image_php = array('confirm_del' => 'Είστε σίγουρος πως θέλετε να ΔΙΑΓΡΑΨΕΤΕ αυτή την φωτογραφία ? \\nΤα Σχόλια επίσης θα διαγραφούν.',
        'del_pic' => 'ΔΙΑΓΡΑΦΗ ΦΩΤΟΓΡΑΦΙΑΣ',
        'size' => '%s x %s πίξελ',
        'views' => '%s φορές',
        'slideshow' => 'Slideshow',
        'stop_slideshow' => 'ΤΕΛΟΣ SLIDESHOW',
        'view_fs' => 'Click to view full size image',
        'edit_pic' => 'EDIT PICTURE INFO', // new in cpg1.2.0nuke
        );
    $lang_picinfo = array('title' => 'Πληροφορίες φωτογραφίας',
        'Filename' => 'Ονομα αρχείου',
        'Album name' => 'Ονομα άλμπουμ',
        'Rating' => 'Βαθμολογία (%s ψήφοι)',
        'Keywords' => 'Λέξεις Κλειδιά',
        'File Size' => 'Μέγεθος αρχείου',
        'Dimensions' => 'Διαστάσεις',
        'Displayed' => 'Εμφανίσεις',
        'Camera' => 'Φωτογραφική Μηχανή',
        'Date taken' => 'Ημερομηνία λήψης',
        'Aperture' => 'Διάφραγμα',
        'Exposure time' => 'Χρόνος έκθεσης',
        'Focal length' => 'Εστιακή απόσταση',
        'Comment' => 'Σχόλιο',
        'addFav' => 'Προσθήκη στα Αγαπημένα',
        'addFavPhrase' => 'Αγαπημένα',
        'remFav' => 'Αφαίρεση από τα Αγαπημένα',
        'iptcTitle' => 'IPTC Title', // new in cpg1.2.0nuke
        'iptcCopyright' => 'IPTC Copyright', // new in cpg1.2.0nuke
        'iptcKeywords' => 'IPTC Keywords', // new in cpg1.2.0nuke
        'iptcCategory' => 'IPTC Category', // new in cpg1.2.0nuke
        'iptcSubCategories' => 'IPTC Sub Categories', // new in cpg1.2.0nuke
        'bookmark_page' => 'Bookmark Image', // new in cpg1.2.0nuke
        );

    $lang_display_comments = array('OK' => 'OK',
        'edit_title' => 'Μετατροπή σχόλιου',
        'confirm_delete' => 'Είστε σίγουρος πως θέλετε να διαγράψετε αυτό το σχόλιο ?',
        'add_your_comment' => 'Προσθήκη σχόλιου',
        'name' => 'Ονομα',
        'comment' => 'Σχόλιο',
        'your_name' => 'Ανώνυμος',
        );

    $lang_fullsize_popup = array('click_to_close' => 'Πατήστε στην εικόνα για να κλείσετε αυτό το παράθυρο',
        );
} 
// ------------------------------------------------------------------------- //
// File ecard.php
// ------------------------------------------------------------------------- //
if (defined('ECARDS_PHP') || defined('DISPLAYECARD_PHP')) $lang_ecard_php = array('title' => 'Στείλτε μια ηλεκτρονική κάρτα',
        'invalid_email' => '<strong>Προειδοποίηση</strong> : η διεύθυνση e-mail δεν είναι εγκυρη !',
        'ecard_title' => 'Μια ηλεκτρονική κάρτα από τον %s για εσάς',
        'view_ecard' => 'Εαν η ηλεκτρονική κάρτα δεν εμφανιστεί σωστά, πατήσατε αυτήν την διασύνδεση',
        'view_more_pics' => 'Πατήσατε αυτή την διασύνδεση για να δείτε περισσότερες φωτογραφίες !',
        'send_success' => 'Η ηλεκτρονική σας κάρτα αποστάλει',
        'send_failed' => 'Συγνώμη, αλλά ο διακομιστής δεν μπορεί να στείλει την ηλεκτρονική σας κάρτα...',
        'from' => 'Από',
        'your_name' => 'ΤΟ όνομα σας',
        'your_email' => 'Η διεύθυνση email σας',
        'to' => 'Προς',
        'rcpt_name' => 'Ονομα παραλήπτη',
        'rcpt_email' => 'Διεύθυνση email παραλήπτη',
        'greetings' => 'Με φιλικούς χαιρετισμούς',
        'message' => 'Μήνυμα',
        );
// ------------------------------------------------------------------------- //
// File editpics.php
// ------------------------------------------------------------------------- //
if (defined('EDITPICS_PHP')) $lang_editpics_php = array('pic_info' => 'Πληροφορίες&nbsp;φωτογραφίας',
        'album' => 'Aλμπουμ',
        'title' => 'Tίτλος',
        'desc' => 'Περιγραφή',
        'keywords' => 'Λέξεις κλειδιά',
        'pic_info_str' => '%sx%s - %sKB - %s εμφανίσεις - %s ψήφοι',
        'approve' => 'Εγκριση φωτογραφίας',
        'postpone_app' => 'Αρνηση έγκρισης',
        'del_pic' => 'Διαγραφή φωτογραφίας',
        'reset_view_count' => 'Μηδενισμός μετρητή εμφανίσεων',
        'reset_votes' => 'Μηδενισμός ψήφων',
        'del_comm' => 'Διαγραφή σχόλιων',
        'upl_approval' => 'Εγκριση προσθήκης',
        'edit_pics' => 'Μετατροπή φωτογραφίας',
        'see_next' => 'Εμφάνιση επόμενης φωτογραφίας',
        'see_prev' => 'Εμφάνιση προηγούμενης φωτογραφίας',
        'n_pic' => '%s φωτογραφίες',
        'n_of_pic_to_disp' => 'Αριθμός φωτογραφιών προς εμφάνιση',
        'apply' => 'Εφαρμογή τροποποιήσεων'
        );
// ------------------------------------------------------------------------- //
// File groupmgr.php
// ------------------------------------------------------------------------- //
if (defined('GROUPMGR_PHP')) $lang_groupmgr_php = array('group_name' => 'Ονομα ομάδας',
        'disk_quota' => 'Διαθέσιμος χώρος',
        'can_rate' => 'Μπορούν να βαθμολογήσουν φωτογραφίες',
        'can_send_ecards' => 'Μπορούν να στείλουν ηλεκτρονικές κάρτες',
        'can_post_com' => 'Μπορούν να δημοσιεύσουν σχόλια',
        'can_upload' => 'Μπορούν να προσθέσουν φωτογραφίες',
        'can_have_gallery' => 'Μπορούν να έχουν προσωπικό φώτο άλμπουμ',
        'apply' => 'Εφαρμογή τροποποιήσεων',
        'create_new_group' => 'Δημιουργία νέας ομάδας',
        'del_groups' => 'Διαγραφή επιλεγμένης ομάδας',
        'confirm_del' => 'Προσοχή, όταν διαγράφετε μια ομάδα, οι χρήστες που ανήκουν σε αυτήν την ομάδα θα μεταφερθουν στην ομάδα των \'Εγγεγραμένων\' !\n\nΘέλετε να συνεχίσετε ?',
        'title' => 'Διαχείρηση ομάδων χρηστών',
        'approval_1' => 'Δημοσ. Προσθ. δεκτή (1)',
        'approval_2' => 'Προσωπ. Προσθ. δεκτή (2)',
        'note1' => '<strong>(1)</strong> Προσθήκες σε ένα δημόσιο άλμπουμ απαιτεί την έγκριση του διαχειριστή',
        'note2' => '<strong>(2)</strong> Προσθήκες σε ένα προσωπικό άλμπουμ απαιτεί την έγκριση του διαχειριστή',
        'notes' => 'Σημειώσεις'
        );
// ------------------------------------------------------------------------- //
// File index.php
// ------------------------------------------------------------------------- //
if (defined('INDEX_PHP')) {
    $lang_index_php = array('welcome' => 'Καλωσήρθατε !'
        );

    $lang_album_admin_menu = array('confirm_delete' => 'Ειστε σίγουρος πως θέλετε να διαγράψετε αυτο το άλμπουμ ? \\nΟλες οι φωτογραφίες και τα σχόλια θα χαθούν.',
        'delete' => 'ΔΙΑΓΡΑΦΗ',
        'modify' => 'ΤΡΟΠΟΠΟΙΗΣΗ',
        'edit_pics' => 'ΕΠΕΞΕΡΓΑΣΙΑ ΦΩΤΟΓΡΑΦΙΩΝ',
        );

    $lang_list_categories = array('home' => 'Αρχική',
        'stat1' => '<strong>[pictures]</strong> φωτογραφίες σε <strong>[albums]</strong> άλμπουμ και <strong>[cat]</strong> κατηγορίες με <strong>[comments]</strong> σχόλια, οι οποίες έχουν εμφανιστεί <strong>[views]</strong> φορές',
        'stat2' => '<strong>[pictures]</strong> φωτογραφίες σε <strong>[albums]</strong> αλμπουμ, οι οποίες έχουν εμφανιστεί <strong>[views]</strong> φορές',
        'xx_s_gallery' => '%s\'s Φώτο άλμπουμ',
        'stat3' => '<strong>[pictures]</strong> φωτογραφίες σε <strong>[albums]</strong> άλμπουμ με <strong>[comments]</strong> σχόλια, οι οποίες έχουν εμφανιστεί <strong>[views]</strong> φορές'
        );

    $lang_list_users = array('user_list' => 'Κατάλογος Χρηστών',
        'no_user_gal' => 'Δεν υπάρχουν χρήστες που να τους επιτρέπετε να έχουν άλμπουμ',
        'n_albums' => '%s άλμπουμ',
        'n_pics' => '%s φωτογραφία(ες)'
        );

    $lang_list_albums = array('n_pictures' => '%s φωτογραφίες',
        'last_added' => ', η τελευταία προστέθηκε στις %s'
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
if (defined('MODIFYALB_PHP')) $lang_modifyalb_php = array('upd_alb_n' => 'Ενημέρωση άλμπουμ %s',
        'general_settings' => 'Γενικές ρυθμίσεις',
        'alb_title' => 'Τίτλος άλμπουμ',
        'alb_cat' => 'Κατηγορία άλμπουμ',
        'alb_desc' => 'Περιγραφή άλμπουμ',
        'alb_thumb' => 'Aλμπουμ thumbnail',
        'alb_perm' => 'Διακαιώματα για αυτό το άλμπουμ',
        'can_view' => 'Το άλμπουμ μπορεί να εμφανιστεί στους',
        'can_upload' => 'Οι επισκέπτες μπορούν να προσθέσουν φωτογραφίες',
        'can_post_comments' => 'Οι επισκέπτες μπορούν να δημοσιεύσουν σχόλια',
        'can_rate' => 'Οι επισκέπτες μπορούν να βαθμολογήσουν τις φωτογραφίες',
        'user_gal' => 'Φώτο άλμπουμ χρηστών',
        'no_cat' => '* Μη κατηγοριοποιημένο *',
        'alb_empty' => 'Το άλμπουμ είναι άδειο',
        'last_uploaded' => 'Τελευταία προσθήκη',
        'public_alb' => 'Ολοι (δημόσιο άλμπουμ)',
        'me_only' => 'Mόνο εγώ',
        'owner_only' => 'Ο (%s) , ιδιοκτήτης του άλμπουμ',
        'groupp_only' => 'Τα μέλη της ομάδας \'%s\' ',
        'err_no_alb_to_modify' => 'Κανένα άλμπουμ για τροποποίηση στην βάση δεδομένων.',
        'update' => 'Ενημέρωση άλμπουμ'
        );
// ------------------------------------------------------------------------- //
// File ratepic.php
// ------------------------------------------------------------------------- //
if (defined('RATEPIC_PHP')) $lang_rate_pic_php = array('already_rated' => 'Συγνώμη αλλά έχετε ήδη βαθμολογήσει αυτή την φωτογραφία',
        'rate_ok' => 'Η ψήφος σας έγινε δεκτή',
        );
// ------------------------------------------------------------------------- //
// File register.php & profile.php
// ------------------------------------------------------------------------- //
if (defined('REGISTER_PHP') || defined('PROFILE_PHP')) {
    $lang_register_disclamer = <<<EOT
Παρόλο που οι διαχειριστές του {SITE_NAME} θα προσπαθήσουν να αφαιρέσουν ή να τροποποιήσουν κάθε προσπάθεια προσβολής το συντομότερο δυνατό, είναι αδύνατο να επιβλέπουν κάθε δημοσιευμένο σχόλιο. Για αυτό αποδέχεστε ότι κάθε σχόλιο που δημοσιεύεται σε αυτό το site εκφράζει μόνο την άποψη και την γνώμη του συντάκτη του και κανενός άλλου.<br />
<br />
Με το παρόν, συμφωνείτε να μην δημοσιεύσετε ειρωνικά, μειωτικά, υβριστικά, κακοήθη, σεξουαλικά ή άλλου είδους προσβλητικά σχόλια που εναντιώνονται στους τρέχοντες νόμους και ήθη. Αποδέχεστε ότι οι διαχειριστές του {SITE_NAME} έχουν το δικαίωμα να αφαιρέσουν ή να τροποποιήσουν κάθε τι κατά την κρίση τους. Σαν χρήστης αποδέχεστε ότι κάθε πληροφορία που έχετε εισάγει θα καταχωρηθεί στην βάση δεδομένων. Παρόλο που κάθε πληροφορία σας θεωρείτε εμπιστευτική, και δεν θα δοθεί πουθενά χωρίς την άδεια σας οι διαχειριστές δεν μπορούν να σας διασφαλίσουν σε περίπτωση προσπάθειας hacking που μπορεί να οδηγήσει σε κλοπή πληροφοριών.<br />
<br />
Αυτό το site χρησιμοποιεί cookies για να αποθηκεύσει πληροφορίες τοπικά στον υπολογιστή σας. Αυτά τα cookies εξυπηρετούν μόνο την δικιά σας ικανοποίηση κατά την περιήγηση στις σελίδες. Η διεύθυνση email που σας ζητείτε είναι μόνο για να πιστοποιήσει για την εγγραφή σας τις πληροφορίες και τον Κωδικό σας.<br />
<br />
Επιλέγοντας 'Συμφωνώ' παρακάτω, αποδέχεστε αυτούς τους όρους.
EOT;

    $lang_register_php = array('page_title' => 'Εγγραφή χρήστη',
        'term_cond' => 'Οροι χρήσης',
        'i_agree' => 'Συμφωνώ',
        'submit' => 'Αποστολή εγγραφής',
        'err_user_exists' => 'Το Ονομα Χρήστη που εισάγατε υπάρχει ήδη, παρακαλώ διαλέξτε κάποιο άλλο',
        'err_password_mismatch' => 'Οι δύο Κωδικοί δεν είναι ίδιοι, παρακαλώ εισάγετέ τους ξανά',
        'err_uname_short' => 'Το Ονομα Χρήστη πρέπει να είναι τουλάχιστον 2 χαρακτήρες',
        'err_password_short' => 'Ο Κωδικός πρέπει να είναι τουλάχιστο 2 χαρακτήρες',
        'err_uname_pass_diff' => 'Το Ονομα Χρήστη και ο Κωδικός πρέπει να είναι διαφορετικά',
        'err_invalid_email' => 'Η διεύθυνση email δεν είναι έγκυρη',
        'err_duplicate_email' => 'Κάποιος άλλος χρήστης έχει ήδη εγγραφεί με την διεύθυνση email που δώσατε',
        'enter_info' => 'Καταχώρηση πληροφοριών εγγραφής',
        'required_info' => 'Υποχρεωτικές πληροφορίες',
        'optional_info' => 'Προαιρετικές πληροφορίες',
        'username' => 'Ονομα Χρήστη',
        'password' => 'Κωδικός',
        'password_again' => 'Ξαναδώστε τον Κωδικό',
        'email' => 'Email',
        'location' => 'Τοποθεσία',
        'interests' => 'Ενδιαφέροντα',
        'website' => 'Προσωπική σελίδα',
        'occupation' => 'Επάγγελμα',
        'error' => 'ΛΑΘΟΣ',
        'confirm_email_subject' => '%s - Πιστοποιηση εγγραφής',
        'information' => 'Πληροφορίες',
        'failed_sending_email' => 'Το email για την πιστοποίηση εγγραφής δεν μπορεί να αποσταλεί !',
        'thank_you' => 'Ευχαριστούμε για την εγγραφή σας.<br /><br />Ενα email με πληροφορίες για το πως θα ενεργοποιήσετε τον λογαριασμό σας απεστάλει στην διεύθυνση email που δώσατε.',
        'acct_created' => 'Ο λογαριασμός σας πλέον υπάρχει και μπορείτε να εισέρθετε χρησιμοποιώντας το Ονομα Χρήστη και τον Κωδικό σας',
        'acct_active' => 'Ο λογαριασμός σας είναι πλέον ενεργός και μπορείτε να εισέρθετε με το Ονομα Χρήστη και τον Κωδικό σας',
        'acct_already_act' => 'Ο λογαριασμός σας είναι ήδη ενεργός !',
        'acct_act_failed' => 'Αυτός ο λογαριασμός δεν μπορεί να ενεργοποιηθεί !',
        'err_unk_user' => 'Ο επιλεγμένος χρήστης δεν υπάρχει !',
        'x_s_profile' => 'Το προφίλ του %s',
        'group' => 'Ομάδα',
        'reg_date' => 'Προσήλθε',
        'disk_usage' => 'Χρήση χώρου',
        'change_pass' => 'Αλλαγή Κωδικού',
        'current_pass' => 'Παρών Κωδικός',
        'new_pass' => 'Nέος Κωδικός',
        'new_pass_again' => 'Δώστε πάλι τον Νέο Κωδικό',
        'err_curr_pass' => 'Ο παρών Κωδικός είναι λαθασμένος',
        'apply_modif' => 'Εφαρμογή τροποποιήσεων',
        'change_pass' => 'Αλαγή του Κωδικού μου',
        'update_success' => 'Το προφίλ ανανεώθηκε',
        'pass_chg_success' => 'Ο Κωδικός σας άλλαξε',
        'pass_chg_error' => 'Ο Κωδικός σας δεν άλλαξε',
        );

    $lang_register_confirm_email = <<<EOT
Ευχαριστούμε που εγγραφήκατε στο {SITE_NAME}

Το Ονομα Χρήστη σας είναι : "{USER_NAME}"
Ο Κωδικός σας είναι : "{PASSWORD}"

Για να ενεργοποιήσετε τον λογαριασμό σας, πρέπει να πατήσετε την παρακάτω διασύνδεση
ή να την αντιγράψετε στον web browser σας.

{ACT_LINK}

Με φιλικούς χαιρετισμούς,

Οι διαχειριστές του {SITE_NAME}

EOT;
} 
// ------------------------------------------------------------------------- //
// File reviewcom.php
// ------------------------------------------------------------------------- //
if (defined('REVIEWCOM_PHP')) $lang_reviewcom_php = array('title' => 'Επισκόπηση σχολιων',
        'no_comment' => 'Δεν υπάρχουν σχόλια για επισκόπηση',
        'n_comm_del' => '%s σχόλιο(α) διαγράφηκε(αν)',
        'n_comm_disp' => 'Αριθμός σχόλιων προς εμφάνιση',
        'see_prev' => 'Εμφάνιση προηγούμενου',
        'see_next' => 'Εμφάνιση επόμενου',
        'del_comm' => 'Διαγραφή επιλεγμένων σχολιων',
        );
// ------------------------------------------------------------------------- //
// File search.php - OK
// ------------------------------------------------------------------------- //
// if (defined('SEARCH_PHP'))
    $lang_search_php = array(0 => 'Αναζήτηση στην συλλογή φωτογραφιών',
        );
// ------------------------------------------------------------------------- //
// File searchnew.php
// ------------------------------------------------------------------------- //
if (defined('SEARCHNEW_PHP')) $lang_search_new_php = array('page_title' => 'Αναζήτηση νέων φωτογραφιών',
        'select_dir' => 'Επιλογή καταλόγου',
        'select_dir_msg' => 'Αυτή η λειτουργία σας επιτρέπει να προσθέσετε πλήθος φωτογραφιών που έχετε ανεβάσει στον διακομιστή σας μέσω FTP.<br /><br />Επιλέξτε τον κατάλογο οπου ανεβάσατε τις φωτογραφίες σας',
        'no_pic_to_add' => 'Δεν υπάρχει φωτογραφία για προσθήκη',
        'need_one_album' => 'Χρειάζεστε τουλάχιστο ένα άλμπουμ για να χρησιμοποιήσετε αυτή την λειτουργία',
        'warning' => 'Προειδοποίηση',
        'change_perm' => 'το πρόγραμμα δεν μπορεί να γράψει σε αυτό τον κατάλογο, πρέπει να αλλάξετε την κατάσταση του καταλόγου (CHMOD) σε 755 ή 777 πριν προσπαθήσετε να προσθέσετε φωτογραφίες !',
        'target_album' => '<strong>Εισαγωγή φωτογραφιών &quot;</strong>%s<strong>&quot; στο </strong>%s',
        'folder' => 'Κατάλογος',
        'image' => 'Εικόνα',
        'album' => 'Aλμπουμ',
        'result' => 'Αποτέλεσμα',
        'dir_ro' => 'Δεν μπορεί να εγγραφεί. ',
        'dir_cant_read' => 'Δεν μπορεί να διαβαστεί. ',
        'insert' => 'Προσθέτοντας νέες φωτογραφίες στο φώτο άλμπουμ',
        'list_new_pic' => 'Λίστα φωτογραφιών',
        'insert_selected' => 'Εισαγωγή επιλεγμένων φωτογραφιών',
        'no_pic_found' => 'Δεν βρέθηκαν νέες φωτογραφίες',
        'be_patient' => 'Παρακαλώ να είστε υπομονετικοί, το πρόγραμμα χρειάζετε λίγη ώρα για να προσθέσει τις φωτογραφίες...',
        'notes' => '<ul>' . '<li><strong>OK</strong> : σημαίνει πως η φωτογραφία εισήχθει επιτυχώς' . '<li><strong>DP</strong> : σημαίνει πως η φωτογραφία υπάρχει ήδη στην βάση δεδομένων' . '<li><strong>PB</strong> : σημαίνει πως η φωτογραφία δεν μπορεί να προστεθεί, ελένξτε τις ρυθμίσεις σας και αν έχετε άδεια να χρησιμοποιήσετε τους καταλόγους που βρίσκονται οι φωτογραφίες' . '<li>Εαν τα OK, DP, PB \'signs\' δεν εμφανίζονται, επιλέξτε πάνω στην μη εμφανιθείσα εικόνα τους να δείτε τι πρόβλημα παρουσιάστηκε από την γλώσσα PHP' . '<li>Εαν εμφανίσει ο browser σας timeout, ξαναφορτώστε την σελίδα με reload' . '</ul>',
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
// Void
// ------------------------------------------------------------------------- //
// File upload.php
// ------------------------------------------------------------------------- //
if (defined('UPLOAD_PHP')) $lang_upload_php = array('title' => 'Προσθήκη φωτογραφίας',
        'max_fsize' => 'Το μέγιστο επιτρεπόμενο μέγεθος αρχείου είναι %s KB',
        'album' => 'Aλμπουμ',
        'picture' => 'Φωτογραφία',
        'pic_title' => 'Τίτλος φωτογραφίας',
        'description' => 'Περιγραφή φωτογραφίας',
        'keywords' => 'Λέξεις Κλειδιά (διαχωρισμένες με κενά)',
        'err_no_alb_uploadables' => 'Συγνώμη, δεν υπάρχει άλμπουμ που να σας επιτρέπετε η προσθήκη φωτογραφιών',
        );
// ------------------------------------------------------------------------- //
// File usermgr.php
// ------------------------------------------------------------------------- //
if (defined('USERMGR_PHP')) $lang_usermgr_php = array('title' => 'Διαχείρηση χρηστών',
        'name_a' => 'όνομα, αύξουσα σειρά',
        'name_d' => 'όνομα, φθίνουσα σειρά',
        'group_a' => 'ομάδα, αύξουσα σειρά',
        'group_d' => 'ομάδα, φθίνουσα σειρά',
        'reg_a' => 'ημερομηνία εγγραφής, αύξουσα σειρά',
        'reg_d' => 'ημερομηνία εγγραφής, φθίνουσα σειρά',
        'pic_a' => 'αρίθμηση φωτογραφιών, άυξουσα σειρά',
        'pic_d' => 'αρίθμηση φωτογραφιών, φθίνουσα σειρά',
        'disku_a' => 'χρήση χώρου, αύξουσα σειρά',
        'disku_d' => 'χρήση χώρου, φθίνουσα σειρά',
        'sort_by' => 'Στοίχηση χρηστών σύμφωνα με',
        'err_no_users' => 'Ο πίνακας χρηστών είναι άδειος !',
        'err_edit_self' => 'Δεν μπορείτε να τροποποιήσετε το προφίλ σας, χρησιμοποιήστε την διασύνδεση \'My profile\' για αυτό',
        'edit' => 'ΤΡΟΠΟΠΟΙΗΣΗ',
        'delete' => 'ΔΙΑΓΡΑΦΗ',
        'name' => 'Ονομα Χρήστη',
        'group' => 'Ομάδα',
        'inactive' => 'Ανενεργός',
        'operations' => 'Λειτουργίες',
        'pictures' => 'Φωτογραφίες',
        'disk_space' => 'Χώρος σε χρήση / Διαθέσιμος',
        'registered_on' => 'Εγγράφηκε στις',
        'u_user_on_p_pages' => '%d χρήστες σε %d σελίδα(ες)',
        'confirm_del' => 'Είστε σίγουρος πως θέλετε να ΔΙΑΓΡΑΨΕΤΕ αυτόν τον χρήστη ? \\nΟλες οι φωτογραφίες και τα άλμπουμ του θα διαγραφούν επίσης.',
        'mail' => 'MAIL',
        'err_unknown_user' => 'Ο επιλεγμένος χρήστης δεν υπάρχει !',
        'modify_user' => 'Τροποποίηση χρήστη',
        'notes' => 'Σημειώσεις',
        'note_list' => '<li>Εαν δεν θέλετε να αλλάξετε το παρών Κωδικό σας, αφήστε το πεδίο "Κωδικός" κενό',
        'password' => 'Κωδικός',
        'user_active_cp' => 'Ο χρήστης είναι ενεργός',
        'user_group_cp' => 'Ομάδα χρηστών',
        'user_email' => 'Εmail χρήστη',
        'user_web_site' => 'Προσωπική σελίδα χρήστη',
        'create_new_user' => 'Δημιουργία νέου χρήστη',
        'user_from' => 'Τοποθεσία χρήστη',
        'user_interests' => 'Ενδιαφέροντα χρήστη',
        'user_occ' => 'Επάγγελμα χρήστη',
        );
// ------------------------------------------------------------------------- //
// File util.php
// ------------------------------------------------------------------------- //
if (defined('UTIL_PHP')) $lang_util_php = array('title' => 'Αλλαγή μεγέθους φωτογραφιών',
        'what_it_does' => 'Τι κάνει...',
        'what_update_titles' => 'Ενημερώνει τίτλους από όνομα αρχείου',
        'what_delete_title' => 'Διαγράφει τίτλους',
        'what_rebuild' => 'Ξαναφτιάχνει τα thumbnails και τις φωτογραφίες αλλαγμένου μεγέθους',
        'what_delete_originals' => 'Διαγράφει τις φωτογραφίες με το αρχικό μέγεθος, αντικαθιστώντας τις με τις άλλες αλλαγμένου μεγέθους',
        'file' => 'Αρχείο',
        'title_set_to' => 'ο τίτλος να γίνει',
        'submit_form' => 'υποβολή',
        'updated_succesfully' => 'ενημερώθηκε επιτυχώς',
        'error_create' => 'ΛΑΘΟ‘κατα την δημιουργία',
        'continue' => 'Συνέχεια με επόμενες φωτό',
        'main_success' => 'Το αρχείο %s χρησιμοποιήθηκε επιτυχώς σαν η κυρίως φωτογραφία',
        'error_rename' => 'Λάθος κατά την μετονομασία από %s σε %s',
        'error_not_found' => 'Το αρχείο %s δεν βρέθηκε',
        'back' => 'πίσω στην κεντρική',
        'thumbs_wait' => 'Ενημέρωση των thumbnails ή/και των φωτογραφιών αλλαγμένου μεγέθους, παρακαλώ περιμένετε...',
        'thumbs_continue_wait' => 'Συνέχεια με την ενημέρωση των thumbnails ή/και των φωτογραφιών αλλαγμένου μεγέθους...',
        'titles_wait' => 'Ενημέρωση τίτλων, παρακαλώ περιμένετε...',
        'delete_wait' => 'Διαγραφή τιτλων, παρακαλώ περιμένετε...',
        'replace_wait' => 'Διαγραφή προτοτύπων και αντικατάσταση με τις φωτογραφίες αλλαγμένου μεγέθους, παρακαλώ περιμένετε...',
        'instruction' => 'Γρήγορες οδηγίες',
        'instruction_action' => 'Επιλογή λειτουργίας',
        'instruction_parameter' => 'Επιλογή παραμέτρων',
        'instruction_album' => 'Επιλογή αλμπουμ',
        'instruction_press' => 'Πατήστε %s',
        'update' => 'Ενημέρωση thumbs ή/και φωτογραφιών αλλαγμένου μεγέθους',
        'update_what' => 'Τι θα πρέπει να ενημερωθεί',
        'update_thumb' => 'Μόνο τα thumbnails',
        'update_pic' => 'Μόνο οι φωτογραφίες αλλαγμένου μεγέθους',
        'update_both' => 'Και τα thumbnails και οι φωτογραφίες αλλαγμένου μεγέθους',
        'update_number' => 'Πλήθος φωτογραφιών που επεξεργάστηκαν ανά κλικ',
        'update_option' => '(Δηλώστε αυτήν την επιλογή με αριθμό χαμηλότερο αν σας εμφανίζει timeout )',
        'filename_title' => 'Ονομα αρχείου ? Τίτλος Φωτογραφίας',
        'filename_how' => 'Πως θα πρεπει να μεταβληθεί ο τίτλος του αρχείου',
        'filename_remove' => 'Αφαίρεση της επέκτασης .jpg και αντικατάσταση με _ (κάτω παύλα) και κενά',
        'filename_euro' => 'Αλλαγή 2003_11_23_13_20_20.jpg σε 23/11/2003 13:20',
        'filename_us' => 'Αλλαγή 2003_11_23_13_20_20.jpg σε 11/23/2003 13:20',
        'filename_time' => 'Αλλαγή 2003_11_23_13_20_20.jpg σε 13:20',
        'delete' => 'Διαγραφή τίτλων φωτογραφιών ή φωτογραφιών αρχικού μεγέθους',
        'delete_title' => 'Διαγραφή τίτλων φωτογραφιών',
        'delete_original' => 'Διαγραφή φωτογραφιών αρχικού μεγέθους',
        'delete_replace' => 'Διαγραφή πρωτότυπων φωτογραφιών με αντικατάσταση τους από τις φωτογραφίες αλλαγμένου μεγέθους',
        'select_album' => 'Επιλογή άλμπουμ',
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