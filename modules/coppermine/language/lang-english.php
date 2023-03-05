<?php 
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.2.3 nuke                                       //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002,2003 Gregory DEMAR <gdemar@wanadoo.fr>                 //
// http://www.chezgreg.net/coppermine/                                       //
// ------------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                        //
// (http://coppermine.sf.net/team/)                                          //
// see /docs/credits.html for details                                        //
// ------------------------------------------------------------------------- //
// New Port by CPG-nuke Dev Team                                             //
// http://coppermine.findhere.org/                                           //
// Based on coppermine 1.1d by Surf  http://www.surf4all.net/                //
// ------------------------------------------------------------------------- //
// This program is free software; you can redistribute it and/or modify      //
// it under the terms of the GNU General Public License as published by      //
// the Free Software Foundation; either version 2 of the License, or         //
// (at your option) any later version.                                       //
// ------------------------------------------------------------------------- //
// error_reporting(E_ALL);

// lang_translation_info
define('LANG_NAME_ENGLISH', 'English');
define('LANG_NAME_NATIVE', 'English');
define('LANG_COUNTRY_CODE', 'en');
define('TRANS_NAME', 'pcnuke');
define('TRANS_EMAIL', 'pcnuke@pcnuke.com');
define('TRANS_WEBSITE', 'http://pcnuke.com/');
define('TRANS_DATE', '2005-04-20');
define('CHARSET', 'iso-8859-1');
define('TEXT_DIR', 'ltr');
define('YES', 'Yes');
define('NO', 'No');
define('BACK', 'BACK');
define('CONTINUE', 'CONTINUE');
define('INFO', 'Information');
define('ERROR', 'Error');
define('ALBUM_DATE_FMT', '%B %d, %Y');
define('LASTCOM_DATE_FMT', '%m/%d/%y @ %H:%M');
define('LASTUP_DATE_FMT', '%B %d, %Y');
define('REGISTER_DATE_FMT', '%B %d, %Y');
define('LASTHIT_DATE_FMT', '%B %d, %Y @ %I:%M %p');
define('COMMENT_DATE_FMT', '%B %d, %Y @ %I:%M %p');

// lang_meta_album_names
define('RANDOM', 'Random pictures');
define('LASTUP', 'Last additions');
define('LASTALB', 'Last updated albums');
define('LASTCOM', 'Last comments');
define('TOPN', 'Most viewed');
define('TOPRATED', 'Top rated');
define('LASTHITS', 'Last viewed');
define('SEARCH', 'Search results');
define('FAVPICS', 'Favorite Pictures');

// lang_errors
define('ACCESS_DENIED', 'You don\'t have permission to access this page.');
define('PERM_DENIED', 'You don\'t have permission to perform this operation.');
define('PARAM_MISSING', 'Script called without the required parameter(s).');
define('NON_EXIST_AP', 'The selected album/picture does not exist !');
define('QUOTA_EXCEEDED', 'Disk quota exceeded<br /><br />You have a space quota of [quota]K, your pictures currently use [space]K, adding this picture would make you exceed your quota.');
define('GD_FILE_TYPE_ERR', 'When using the GD image library allowed image types are only JPEG and PNG.');
define('INVALID_IMAGE', 'The image you have uploaded is corrupted or can\'t be handled by the GD library');
define('RESIZE_FAILED', 'Unable to create thumbnail or reduced size image.');
define('NO_IMG_TO_DISPLAY', 'No image to display');
define('NON_EXIST_CAT', 'The selected category does not exist');
define('ORPHAN_CAT', 'A category has a non-existing parent, runs the category manager to correct the problem.');
define('DIRECTORY_RO', 'Directory \'%s\' is not writable, pictures can\'t be deleted');
define('NON_EXIST_COMMENT', 'The selected comment does not exist.');
define('PIC_IN_INVALID_ALBUM', 'Picture is in a non existant album (%s)!?');
define('BANNED', 'You are currently banned from using this site.');
define('NOT_WITH_UDB', 'This function is disabled in Coppermine because it is integrated with forum software. Either what you are trying to do is not supported in this configuration, or the function should be handled by the forum software.');
define('MEMBERS_ONLY', 'This function is for members only, please join.');
define('MUSTBE_GOD', 'This function is only for the site admin. You must be logged in as superadmin, god account to access this function');

// lang_main_menu
define('ALB_LIST_TITLE', 'Go to the album list');
define('ALB_LIST_LNK', 'Album list');
define('MY_GAL_TITLE', 'Go to my personal gallery');
define('MY_GAL_LNK', 'My gallery');
define('MY_PROF_LNK', 'My profile');
define('MY_PROF_TITLE','Check your disk quota and groups');
define('ADM_MODE_TITLE', 'Switch to admin mode');
define('ADM_MODE_LNK', 'Admin mode');
define('USR_MODE_TITLE', 'Switch to user mode');
define('USR_MODE_LNK', 'User mode');
define('UPLOAD_PIC_TITLE', 'Upload a picture into an album');
define('UPLOAD_PIC_LNK', 'Upload picture');
define('REGISTER_TITLE', 'Create an account');
define('REGISTER_LNK', 'Register');
define('LOGIN_LNK', 'Login');
define('LOGOUT_LNK', 'Logout');
define('LASTUP_LNK', 'Last uploads');
define('LASTUP_TITLE', 'Recently uploaded pictures');
define('LASTCOM_TITLE',  'Pictures in order of last commented on');
define('LASTCOM_LNK',  'Last comments');
define('TOPN_TITLE', 'Pictures that have been seen most');
define('TOPN_LNK', 'Most viewed');
define('TOPRATED_TITLE', 'Top rated pictures');
define('TOPRATED_LNK',  'Top rated');
define('SEARCH_LNK', 'Search');
define('FAV_LNK', 'My Favorites');
define('HELP_LNK', "<img src=\"$CPG_M_DIR/images/help.gif\"  vspace=\"2\" height=\"20\" width=\"20\" align=\"middle\" alt=\"HELP\"  border=\"0\" />");

// lang_gallery_admin_menu
define('UPL_APP_LNK', 'Upload approval');
define('CONFIG_LNK', 'Config');
define('ALBUMS_LNK', 'Albums');
define('CATEGORIES_LNK', 'Categories');
define('USERS_LNK', 'Users');
define('GROUPS_LNK', 'Groups');
define('COMMENTS_LNK', 'Review Comments');
define('SEARCHNEW_LNK', 'Batch add pictures');
define('UTIL_LNK', 'Resize pictures');
define('BAN_LNK', 'Ban Users');

// lang_user_admin_menu
define('ALBMGR_LNK', 'Create / order my albums');
define('MODIFYALB_LNK', 'Modify my albums');
define('MY_PROF_LNK', 'My profile');

// lang_cat_list
define('CATEGORY', 'Category');
define('ALBUMS', 'Albums');
define('PICTURES', 'Pictures');

// lang_album_list
define('ALBUM_ON_PAGE', '%d albums on %d page(s)');

// lang_thumb_view
define('DATE', 'DATE');
define('NAME', 'FILE NAME');
define('TITLE', 'TITLE');
define('SORT_DA', 'Sort by date ascending');
define('SORT_DD', 'Sort by date descending');
define('SORT_NA', 'Sort by name ascending');
define('SORT_ND', 'Sort by name descending');
define('SORT_TA', 'Sort by title ascending');
define('SORT_TD', 'Sort by title descending');
define('PIC_ON_PAGE', '%d pictures on %d page(s)');
define('USER_ON_PAGE', '%d users on %d page(s)');
define('SORT_RA', 'Sort by rating ascending');
define('SORT_RD', 'Sort by rating descending');
define('RATING', 'RATING');
define('SORT_TITLE', 'Sort pictures by:');

// lang_img_nav_bar
define('THUMB_TITLE', 'Return to the thumbnail page');
define('PIC_INFO_TITLE', 'Display/hide picture information');
define('SLIDESHOW_TITLE', 'Slideshow');
define('SLIDESHOW_DISABLED', 'e-cards are disabled');
define('SLIDESHOW_DISABLED_MSG', 'This function is for members only, please join.');
define('ECARD_TITLE', 'Send this picture as an e-card');
define('ECARD_DISABLED', 'e-cards are disabled');
define('ECARD_DISABLED_MSG', 'You don\'t have permission to send ecards');
define('PREV_TITLE', 'See previous picture');
define('NEXT_TITLE', 'See next picture');
define('PIC_POS', 'PICTURE %s/%s');
define('NO_MORE_IMAGES', 'There are no more images in this galley');
define('NO_LESS_IMAGES', 'This is the first image in the gallery');

// lang_rate_pic
define('RATE_THIS_PIC', 'Rate this picture ');
define('NO_VOTES', '(No vote yet)');
define('RATING', '(current rating : %s / 5 with %s votes)');
define('RUBBISH', 'Rubbish');
define('POOR', 'Poor');
define('FAIR', 'Fair');
define('GOOD', 'Good');
define('EXCELLENT', 'Excellent');
define('GREAT', 'Great');

// lang_cpg_die
define('INFORMATION', 'Information');
define('ERROR', 'Error');
define('CRITICAL_ERROR', 'Critical error');
define('FILE', 'File: ');
define('LINE', 'Line: ');

// lang_display_thumbnails
define('FILENAME', 'Filename : ');
define('FILESIZE', 'Filesize : ');
define('DIMENSIONS', 'Dimensions : ');
define('DATE_ADDED', 'Date added : ');

// lang_get_pic_data
define('N_COMMENTS', '%s comments');
define('N_VIEWS', '%s views');
define('N_VOTES', '(%s votes)');



// lang_admin_php
define('LV_ADMIN', 'Leaving admin mode...');
define('ENT_ADMIN', 'Entering admin mode...');
// lang_albmgr_php
define('ALB_NEED_NAME', 'Albums need to have a name !');
define('CONFIRM_MODIFS', 'Are you sure you want to make these modifications ?');
define('NO_CHANGE', 'You did not make any change !');
define('NEW_ALBUM', 'New album');
define('CONFIRM_DELETE1', 'Are you sure you want to delete this album ?');
define('CONFIRM_DELETE2', '\\nAll pictures and comments it contains will be lost !');
define('SELECT_FIRST', 'Select an album first');
define('ALB_MRG', 'Album Manager');
define('MY_GALLERY', '* My gallery *');
define('NO_CATEGORY', '* No category *');
define('DELETE', 'Delete');
define('NEW', 'New');
define('APPLY_MODIFS', 'Apply modifications');
define('SELECT_CATEGORY', 'Select category');

// lang_catmgr_php
define('MISS_PARAM', 'Parameters required for \'%s\'operation not supplied !');
define('UNKNOWN_CAT', 'Selected category does not exist in database');
define('USERGAL_CAT_RO', 'User galleries category can\'t be deleted !');
define('MANAGE_CAT', 'Manage categories');
define('CONFIRM_DELETE', 'Are you sure you want to DELETE this category');
define('CATEGORY', 'Category');
define('OPERATIONS', 'Operations');
define('MOVE_INTO', 'Move into');
define('UPDATE_CREATE', 'Update/Create category');
define('PARENT_CAT', 'Parent category');
define('CAT_TITLE', 'Category title');
define('CAT_DESC', 'Category description');

// lang_config_php
define('TITLE', 'Configuration');
define('RESTORE_CFG', 'Restore factory defaults');
define('SAVE_CFG', 'Save new configuration');
define('NOTES', 'Notes');
define('INFO', 'Information');
define('UPD_SUCCESS', 'Coppermine configuration was updated');
define('RESTORE_SUCCESS', 'Coppermine default configuration restored');
define('NAME_A', 'Name ascending');
define('NAME_D', 'Name descending');
define('TITLE_A', 'Title ascending');
define('TITLE_D', 'Title descending');
define('DATE_A', 'Date ascending');
define('DATE_D', 'Date descending');
define('RATING_A', 'Rating ascending');
define('RATING_D', 'Rating descending');
define('TH_ANY', 'Max Aspect');
define('TH_HT', 'Height');
define('TH_WD', 'Width');

// lang_config_data
define('CONFIG_GENSET', 'General settings');
define('GALLERY_NAME', 'Gallery name');
define('GALLERY_DESCRIPTION', 'Gallery description');
define('GALLERY_ADMIN_EMAIL', 'Gallery administrator email');
define('ECARDS_MORE_PIC_TARGET', 'Address to nuke folder ie http://www.mysite.tld/html/');
define('LANG', 'Language');
define('CPGTHEME', 'Theme');
define('NICE_TITLES', 'Page Specific Titles instead of >Coppermine');
define('RIGHT_BLOCKS', 'Show blocks on the right');
define('ALB_LIST_VIEW_TITLE', 'Album list view');
define('MAIN_TABLE_WIDTH', 'Width of the main table (pixels or %)');
define('SUBCAT_LEVEL', 'Number of levels of categories to display');
define('ALBUMS_PER_PAGE', 'Number of albums to display');
define('ALBUM_LIST_COLS', 'Number of columns for the album list');
define('ALB_LIST_THUMB_SIZE', 'Size of thumbnails in pixels');
define('MAIN_PAGE_LAYOUT', 'The content of the main page');
define('FIRST_LEVEL', 'Show first level album thumbnails in categories');
define('THUMB_VIEW_TITLE', 'Thumbnail view');
define('THUMBCOLS', 'Number of columns on thumbnail page');
define('THUMBROWS', 'Number of rows on thumbnail page');
define('MAX_TABS', 'Maximum number of tabs to display');
define('CAPTION_IN_THUMBVIEW', 'Display picture caption (in addition to title) below the thumbnail');
define('DISPLAY_COMMENT_COUNT', 'Display number of comments below the thumbnail');
define('DEFAULT_SORT_ORDER', 'Default sort order for pictures');
define('MIN_VOTES_FOR_RATING', 'Minimum number of votes for a picture to appear in the \'top-rated\' list');
define('SEO_ALTS', 'Alts and title tags of thumbnail show title and keyword instead of picinfo');
define('IMAGE_COMMENT_VIEW_TITLE', 'Image view &amp; Comment settings');
define('PICTURE_TABLE_WIDTH', 'Width of the table for picture display (pixels or %)');
define('DISPLAY_PIC_INFO', 'Picture information are visible by default');
define('FILTER_BAD_WORDS', 'Filter bad words in comments');
define('ENABLE_SMILIES', 'Allow smiles in comments');
define('DISABLE_FLOOD_PROTECTION', 'Allow several consecutive comments on one pic from the same user');
define('COMMENT_EMAIL_NOTIFICATION', 'Email site admin upon comment submission');
define('MAX_IMG_DESC_LENGTH', 'Max length for an image description');
define('MAX_COM_WLENGTH', 'Max number of characters in a word');
define('MAX_COM_LINES', 'Max number of lines in a comment');
define('MAX_COM_SIZE', 'Maximum length of a comment');
define('DISPLAY_FILM_STRIP', 'Show film strip');
define('MAX_FILM_STRIP_ITEMS', 'Number of items in film strip');
define('ALLOW_ANON_FULLSIZE', 'Allow viewing of full size pic by anonymous');
define('PIC_THUMB_SETTING_TITLE',  'Pictures and thumbnails settings');
define('JPEG_QUAL', 'Quality for JPEG files');
define('THUMB_WIDTH', 'Max dimension of a thumbnail <strong>*</strong>');
define('THUMB_USE', 'Use dimension ( width or height or Max aspect for thumbnail )<strong>*</strong>');
define('MAKE_INTERMEDIATE', 'Create intermediate pictures');
define('PICTURE_WIDTH', 'Max width or height of an intermediate picture <strong>*</strong>');
define('MAX_UPL_SIZE', 'Max size for uploaded pictures (KB)');
define('MAX_UPL_WIDTH_HEIGHT', 'Max width or height for uploaded pictures (pixels)');
define('USER_SETTING_TITLE',   'User settings');
define('ALLOW_USER_REGISTRATION', 'Allow new user registrations');
define('REG_REQUIRES_VALID_EMAIL', 'User registration requires email verification');
define('ALLOW_DUPLICATE_EMAILS_ADDR', 'Allow two users to have the same email address');
define('ALLOW_PRIVATE_ALBUMS', 'Users can can have private albums');
define('CUSTOM_FIELDS_TITLE', 'Custom fields for image description (leave blank if unused)');
define('USER_FIELD1_NAME', 'Field 1 name');
define('USER_FIELD2_NAME', 'Field 2 name');
define('USER_FIELD3_NAME', 'Field 3 name');
define('USER_FIELD4_NAME', 'Field 4 name');
define('PIC_THUMB_SETTING_TITLE', 'Pictures and thumbnails advanced settings');
define('SHOW_PRIVATE', 'Show private album Icon to unlogged user');
define('FORBIDEN_FNAME_CHAR', 'Characters forbidden in filenames');
define('ALLOWED_FILE_EXTENSIONS', 'Accepted file extensions for uploaded pictures');
define('THUMB_METHOD', 'Method for resizing images');
define('IMPATH', 'Path to ImageMagick/Netpbm \'convert\' utility (example /usr/bin/X11/)');
define('ALLOWED_IMG_TYPES', 'Allowed image types (only valid for ImageMagick)');
define('IM_OPTIONS', 'Command line options for ImageMagick');
define('READ_EXIF_DATA', 'Read EXIF data in JPEG files');
define('READ_IPTC_DATA', 'Read IPTC data in JPEG files');
define('FULLPATH', 'The album directory <strong>*</strong>');
define('USERPICS', 'The directory for user pictures <strong>*</strong>');
define('NORMAL_PFX', 'The prefix for intermediate pictures <strong>*</strong>');
define('THUMB_PFX', 'The prefix for thumbnails <strong>*</strong>');
define('DEFAULT_DIR_MODE', 'Default mode for directories');
define('DEFAULT_FILE_MODE', 'Default mode for pictures');
define('PICINFO_DISPLAY_FILENAME', 'Picinfo display filename');
define('PICINFO_DISPLAY_ALBUM_NAME', 'Picinfo display album name');
define('PICINFO_DISPLAY_FILE_SIZE', 'Picinfo display_file_size');
define('PICINFO_DISPLAY_DIMENSIONS', 'Picinfo display_dimensions');
define('PICINFO_DISPLAY_COUNT_DISPLAYED', 'Picinfo display_count_displayed');
define('PICINFO_DISPLAY_URL', 'Picinfo display_URL');
define('PICINFO_DISPLAY_URL_BOOKMARK', 'Picinfo display URL as bookmark link');
define('PICINFO_DISPLAY_FAVORITES', 'Picinfo display fav album link');
define('COOKIE_SETTING_TITLE', 'Cookies &amp; Charset settings');
define('COOKIE_NAME', 'Name of the cookie used by the script');
define('COOKIE_PATH', 'Path of the cookie used by the script');
define('CHAR_SET', 'Character encoding');
define('MISC_SETTING_TITLE', 'Miscellaneous settings');
define('DEBUG_MODE', 'Enable debug mode');
define('ADVANCED_DEBUG_MODE', 'Enable advanced debug mode');
define('SHOWUPDATE', 'Show Coppermine Update Alert to Admin');
define('NOCHANGE_FOOTER_TITLE', '<br /><div align="center">(*) Fields marked with * must not be changed if you already have pictures in your gallery</div><br />');

// lang_db_input_php
define('EMPTY_NAME_OR_COM', 'You need to type your name and a comment');
define('COM_ADDED', 'Comment added');
define('ALB_NEED_TITLE', 'You have to provide a title for the album !');
define('NO_UDP_NEEDED', 'No update needed.');
define('ALB_UPDATED', 'Album updated');
define('UNKNOWN_ALBUM', 'Selected album does not exist or you don\'t have permission to upload in this album');
define('NO_PIC_UPLOADED', 'No picture was uploaded !<br /><br />If you have really selected a picture to upload, check that the server allows file uploads...');
define('ERR_MKDIR', 'Failed to create directory %s !');
define('DEST_DIR_RO', 'Destination directory %s is not writable by the script !');
define('ERR_MOVE', 'Impossible to move %s to %s !');
define('ERR_FSIZE_TOO_LARGE', 'The size of picture you have uploaded is too large (maximum allowed is %s x %s) !');
define('ERR_IMGSIZE_TOO_LARGE', 'The size of the file you have uploaded is too large (maximum allowed is %s KB) !');
define('ERR_INVALID_IMG', 'The file you have uploaded is not a valid image !');
define('ALLOWED_IMG_TYPES', 'You can only upload %s images.');
define('ERR_INSERT_PIC', 'The picture \'%s\' can\'t be inserted in the album ');
define('UPLOAD_SUCCESS', 'Your picture was uploaded successfully<br /><br />It will be visible after admin approval.');
define('INFO', 'Information');
define('ERR_COMMENT_EMPTY', 'Your comment is empty !');
define('ERR_INVALID_FEXT', 'Only files with the following extensions are accepted : <br /><br />%s.');
define('NO_FLOOD', 'Sorry but you are already the author of the last comment posted for this picture<br /><br />Edit the comment you have posted if you want to modify it');
define('REDIRECT_MSG', 'You are being redirected.<br /><br /><br />Click \'CONTINUE\' if the page does not refresh automatically');
define('UPL_SUCCESS', 'Your picture was successfully added');

// lang_delete_php
define('CAPTION', 'Caption');
define('FS_PIC', 'full size image');
define('DEL_SUCCESS', 'successfully deleted');
define('NS_PIC', 'normal size image');
define('ERR_DEL', 'can\'t be deleted');
define('THUMB_PIC', 'thumbnail');
define('COMMENT', 'comment');
define('IM_IN_ALB', 'image in album');
define('ALB_DEL_SUCCESS', 'Album \'%s\' deleted');
define('ALB_MGR', 'Album Manager');
define('ERR_INVALID_DATA', 'Invalid data received in \'%s\'');
define('CREATE_ALB', 'Creating album \'%s\'');
define('UPDATE_ALB', 'Updating album \'%s\' with title \'%s\' and index \'%s\'');
define('DEL_PIC', 'Delete picture');
define('DEL_ALB', 'Delete album');
define('DEL_USER', 'Delete user');
define('ERR_UNKNOWN_USER', 'The selected user does not exist !');
define('COMMENT_DELETED', 'Comment was succesfully deleted');

// lang_display_image_php
define('CONFIRM_DEL', 'Are you sure you want to DELETE this picture ? \\nComments will also be deleted.');
define('DEL_PIC', 'DELETE THIS PICTURE');
define('SIZE', '%s x %s pixels');
define('VIEWS', '%s times');
define('SLIDESHOW', 'Slideshow');
define('STOP_SLIDESHOW', 'STOP SLIDESHOW');
define('VIEW_FS', 'Click to view full size image');
define('EDIT_PIC', 'EDIT PICTURE INFO');

// lang_picinfo
define('TITLE', 'Picture information');
define('FILENAME', 'Filename');
define('ALBUM NAME', 'Album name');
define('RATING', 'Rating (%s votes)');
define('KEYWORDS', 'Keywords');
define('FILE SIZE', 'File Size');
define('DIMENSIONS', 'Dimensions');
define('DISPLAYED', 'Displayed');
define('CAMERA', 'Camera');
define('DATE TAKEN', 'Date taken');
define('APERTURE', 'Aperture');
define('EXPOSURE TIME', 'Exposure time');
define('FOCAL LENGTH', 'Focal length');
define('COMMENT', 'Comment');
define('ADDFAV', 'Add to Favorites Album');
define('ADDFAVPHRASE', 'Favorites');
define('REMFAV', 'Remove from Favorites Album');
define('IPTCTITLE', 'IPTC Title');
define('IPTCCOPYRIGHT', 'IPTC Copyright');
define('IPTCKEYWORDS', 'IPTC Keywords');
define('IPTCCATEGORY', 'IPTC Category');
define('IPTCSUBCATEGORIES', 'IPTC Sub Categories');
define('BOOKMARK_PAGE', 'Bookmark Image');

// lang_display_comments
define('OK', 'OK');
define('EDIT_TITLE', 'Edit this comment');
define('CONFIRM_DELETE', 'Are you sure you want to delete this comment ?');
define('ADD_YOUR_COMMENT', 'Add your comment');
define('NAME', 'Name');
define('COMMENT', 'Comment');
define('YOUR_NAME', 'Anon');

// lang_fullsize_popup
define('CLICK_TO_CLOSE', 'Click image to close this window');

// lang_ecard_php
define('TITLE', 'Send an e-card');
define('INVALID_EMAIL', '<strong>Warning</strong> : invalid email address !');
define('ECARD_TITLE', 'An e-card from %s for you');
define('VIEW_ECARD', 'If the e-card does not display correctly, click this link');
define('VIEW_MORE_PICS', 'Click this link to view more pictures !');
define('SEND_SUCCESS', 'Your ecard was sent');
define('SEND_FAILED', 'Sorry but the server can\'t send your e-card...');
define('FROM', 'From');
define('YOUR_NAME', 'Your name');
define('YOUR_EMAIL', 'Your email address');
define('TO', 'To');
define('RCPT_NAME', 'Recipient name');
define('RCPT_EMAIL', 'Recipient email address');
define('GREETINGS', 'Greetings');
define('MESSAGE', 'Message');

// lang_editpics_php
define('PIC_INFO', 'Picture&nbsp;info');
define('ALBUM', 'Album');
define('TITLE', 'Title');
define('DESC', 'Description');
define('KEYWORDS', 'Keywords');
define('PIC_INFO_STR', '%sx%s - %sKB - %s views - %s votes');
define('APPROVE', 'Approve picture');
define('POSTPONE_APP', 'Postpone approval');
define('DEL_PIC', 'Delete picture');
define('READ_EXIF', 'Read EXIF info again');
define('RESET_VIEW_COUNT', 'Reset view counter');
define('RESET_VOTES', 'Reset votes');
define('DEL_COMM', 'Delete comments');
define('UPL_APPROVAL', 'Upload approval');
define('EDIT_PICS', 'Edit pictures');
define('SEE_NEXT', 'See next pictures');
define('SEE_PREV', 'See previous pictures');
define('N_PIC', '%s pictures');
define('N_OF_PIC_TO_DISP', 'Number of picture to display');
define('APPLY', 'Apply modifications');

// lang_groupmgr_php
define('GROUP_NAME', 'Group name');
define('DISK_QUOTA', 'Disk quota');
define('CAN_RATE', 'Can rate pictures');
define('CAN_SEND_ECARDS', 'Can send ecards');
define('CAN_POST_COM', 'Can post comments');
define('CAN_UPLOAD', 'Can upload pictures');
define('CAN_HAVE_GALLERY', 'Can have a personal gallery');
define('APPLY', 'Apply modifications');
define('CREATE_NEW_GROUP', 'Create new group');
define('DEL_GROUPS', 'Delete selected group(s)');
define('CONFIRM_DEL', 'Warning, when you delete a group, users that belong to this group will be transfered to the \'Registered\' group !\\n\\nDo you want to proceed ?');
define('TITLE', 'Manage user groups');
define('APPROVAL_1', 'Pub. Upl. approval (1)');
define('APPROVAL_2', 'Priv. Upl. approval (2)');
define('NOTE1', '<strong>(1)</strong> Uploads in a public album need admin approval');
define('NOTE2', '<strong>(2)</strong> Uploads in an album that belong to the user need admin approval');
define('NOTES', 'Notes');

// lang_index_php
define('WELCOME', 'Welcome !');

// lang_album_admin_menu
define('CONFIRM_DELETE', 'Are you sure you want to DELETE this album ? \\nAll pictures and comments will also be deleted.');
define('DELETE', 'DELETE');
define('MODIFY', 'PROPERTIES');
define('EDIT_PICS', 'EDIT PICS');

// lang_list_categories
define('HOME', 'Home');
define('STAT1', '<strong>[pictures]</strong> pictures in <strong>[albums]</strong> albums and <strong>[cat]</strong> categories with <strong>[comments]</strong> comments viewed <strong>[views]</strong> times');
define('STAT2', '<strong>[pictures]</strong> pictures in <strong>[albums]</strong> albums viewed <strong>[views]</strong> times');
define('XX_S_GALLERY', '%s\'s Gallery');
define('STAT3', '<strong>[pictures]</strong> pictures in <strong>[albums]</strong> albums with <strong>[comments]</strong> comments viewed <strong>[views]</strong> times');

// lang_list_users
define('USER_LIST', 'User list');
define('NO_USER_GAL', 'There are no user galleries');
define('N_ALBUMS', '%s album(s)');
define('N_PICS', '%s picture(s)');

// lang_list_albums
define('N_PICTURES', '%s pictures');
define('LAST_ADDED', ', last one added on %s');

// lang_modifyalb_php
define('UPD_ALB_N', 'Update album %s');
define('GENERAL_SETTINGS', 'General settings');
define('ALB_TITLE', 'Album title');
define('ALB_CAT', 'Album category');
define('ALB_DESC', 'Album description');
define('ALB_THUMB', 'Album thumbnail');
define('ALB_PERM', 'Permissions for this album');
define('CAN_VIEW', 'Album can be viewed by');
define('CAN_UPLOAD', 'Visitors can upload pictures');
define('CAN_POST_COMMENTS', 'Visitors can post comments');
define('CAN_RATE', 'Visitors can rate pictures');
define('USER_GAL', 'User Gallery');
define('NO_CAT', '* No category *');
define('ALB_EMPTY', 'Album is empty');
define('LAST_UPLOADED', 'Last uploaded');
define('PUBLIC_ALB', 'Everybody (public album)');
define('ME_ONLY', 'Me only');
define('OWNER_ONLY', 'Album owner (%s) only');
define('GROUPP_ONLY', 'Members of the \'%s\' group');
define('ERR_NO_ALB_TO_MODIFY', 'There is no album you may modify.');
define('UPDATE', 'Update album');

// lang_rate_pic_php
define('ALREADY_RATED', 'Sorry but you have already rated this picture');
define('RATE_OK', 'Your vote was accepted');

// lang_register_disclamer
define('REGISTER_DISCLAMER', 'While the administrators of {SITE_NAME} will attempt to remove or edit any generally objectionable material as quickly as possible, it is impossible to review every post. Therefore you acknowledge that all posts made to this site express the views and opinions of the author and not the administrators or webmaster (except for posts by these people) and hence will not be held liable.<br />
<br />
You agree not to post any abusive, obscene, vulgar, slanderous, hateful, threatening, sexually-orientated or any other material that may violate any applicable laws. You agree that the webmaster, administrator and moderators of {SITE_NAME} have the right to remove or edit any content at any time should they see fit. As a user you agree to any information you have entered above being stored in a database. While this information will not be disclosed to any third party without your consent the webmaster and administrator cannot be held responsible for any hacking attempt that may lead to the data being compromised.<br />
<br />
This site uses cookies to store information on your local computer. These cookies serve only to improve your viewing pleasure. The email address is used only for confirming your registration details and password.<br />
<br />
By clicking \'I agree\' below you agree to be bound by these conditions.');

// lang_register_php
define('PAGE_TITLE', 'User registration');
define('TERM_COND', 'Terms and conditions');
define('I_AGREE', 'I agree');
define('SUBMIT', 'Submit registration');
define('ERR_USER_EXISTS', 'The username you have entered already exist, please choose a different one');
define('ERR_PASSWORD_MISMATCH', 'The two passwords does not match, please input them again');
define('ERR_UNAME_SHORT', 'Username must be 2 characters long minimum');
define('ERR_PASSWORD_SHORT', 'Password must be 2 characters long minimum');
define('ERR_UNAME_PASS_DIFF', 'Username and password must be different');
define('ERR_INVALID_EMAIL', 'Email address is invalid');
define('ERR_DUPLICATE_EMAIL', 'Another user has already registered with the email address you entered');
define('ENTER_INFO', 'Input registration information');
define('REQUIRED_INFO', 'Required information');
define('OPTIONAL_INFO', 'Optional information');
define('USERNAME', 'Username');
define('PASSWORD', 'Password');
define('PASSWORD_AGAIN', 'Re-enter password');
define('EMAIL', 'Email');
define('LOCATION', 'Location');
define('INTERESTS', 'Interests');
define('WEBSITE', 'Home page');
define('OCCUPATION', 'Occupation');
define('ERROR', 'ERROR');
define('CONFIRM_EMAIL_SUBJECT', '%s - Registration confirmation');
define('INFORMATION', 'Information');
define('FAILED_SENDING_EMAIL', 'The registration confirmation email can\'t be send !');
define('THANK_YOU', 'Thank your for registering.<br /><br />An email with information on how to activate your account was sent to the email address your provided.');
define('ACCT_CREATED', 'Your account has been created and you can now login with your username and password');
define('ACCT_ACTIVE', 'Your account is now active and you can login with your username and password');
define('ACCT_ALREADY_ACT', 'Your account is already active !');
define('ACCT_ACT_FAILED', 'This account can\'t be activated !');
define('ERR_UNK_USER', 'Selected user does not exist !');
define('X_S_PROFILE', '%s\'s profile');
define('GROUP', 'Group');
define('REG_DATE', 'Joined');
define('DISK_USAGE', 'Disk usage');
define('CHANGE_PASS', 'Change my password');
define('CURRENT_PASS', 'Current password');
define('NEW_PASS', 'New password');
define('NEW_PASS_AGAIN', 'New password again');
define('ERR_CURR_PASS', 'Current password is incorrect');
define('APPLY_MODIF', 'Apply modifications');
define('UPDATE_SUCCESS', 'Your profile was updated');
define('PASS_CHG_SUCCESS', 'Your password was changed');
define('PASS_CHG_ERROR', 'Your password was not changed');

// lang_register_confirm_email
define('REGISTER_CONFIRM_EMAIL', 'Thank you for registering at {SITE_NAME}

Your username is : "{USER_NAME}"
Your password is : "{PASSWORD}"

In order to activate your account, you need to click on the link below
or copy and paste it in your web browser.

{ACT_LINK}

Regards,

The management of {SITE_NAME}
');

// lang_reviewcom_php
define('TITLE', 'Review comments');
define('NO_COMMENT', 'There is no comment to review');
define('N_COMM_DEL', '%s comment(s) deleted');
define('N_COMM_DISP', 'Number of comments to display');
define('SEE_PREV', 'See previous');
define('SEE_NEXT', 'See next');
define('DEL_COMM', 'Delete selected comments');

// lang_search_php
define('SEARCH', 'Search the image collection');

// lang_search_new_php
define('PAGE_TITLE', 'Search new pictures');
define('SELECT_DIR', 'Select directory');
define('SELECT_DIR_MSG', 'This function allows you to add a batch of picture that your have uploaded on your server by FTP.<br /><br />Select the directory where you have uploaded your pictures');
define('NO_PIC_TO_ADD', 'There is no picture to add');
define('NEED_ONE_ALBUM', 'You need at least one album to use this function');
define('WARNING', 'Warning');
define('CHANGE_PERM', 'the script can\'t write in this directory, you need to change its mode to 755 or 777 before trying to add the pictures !');
define('TARGET_ALBUM', '<strong>Put pictures of &quot;</strong>%s<strong>&quot; into </strong>%s');
define('FOLDER', 'Folder');
define('IMAGE', 'Image');
define('ALBUM', 'Album');
define('RESULT', 'Result');
define('DIR_RO', 'Not writable. ');
define('DIR_CANT_READ', 'Not readable. ');
define('INSERT', 'Adding new pictures to the gallery');
define('LIST_NEW_PIC', 'List of new pictures');
define('INSERT_SELECTED', 'Insert selected pictures');
define('NO_PIC_FOUND', 'No new picture was found');
define('BE_PATIENT', 'Please be patient, the script needs time to add the pictures');
define('NOTES', '<ul><li><strong>OK</strong> : means that the picture was succesfully added<li><strong>DP</strong> : means that the picture is a duplicate and is already in the database<li><strong>PB</strong> : means that the picture could not be added, check your configuration and the permission of directories where the pictures are located<li>If the OK, DP, PB \'signs\' does not appear click on the broken picture to see any error message produced by PHP<li>If your browser timeout, hit the reload button</ul>');
define('SELECT_ALBUM', 'Select album');
define('NO_ALBUM', 'No album name was selected, click back and select an album to put your pictures in');

// lang_upload_php
define('TITLE', 'Upload picture');
define('MAX_FSIZE', 'Maximum allowed file size is %s KB');
define('ALBUM', 'Album');
define('PICTURE', 'Picture');
define('PIC_TITLE', 'Picture title');
define('DESCRIPTION', 'Picture description');
define('KEYWORDS', 'Keywords (separate with spaces)');
define('ERR_NO_ALB_UPLOADABLES', 'Sorry there is no album where you are allowed to upload pictures');

// lang_usermgr_php
define('TITLE', 'Manage users');
define('NAME_A', 'Name ascending');
define('NAME_D', 'Name descending');
define('GROUP_A', 'Group ascending');
define('GROUP_D', 'Group descending');
define('REG_A', 'Reg date ascending');
define('REG_D', 'Reg date descending');
define('PIC_A', 'Pic count ascending');
define('PIC_D', 'Pic count descending');
define('DISKU_A', 'Disk usage ascending');
define('DISKU_D', 'Disk usage descending');
define('SORT_BY', 'Sort users by');
define('ERR_NO_USERS', 'User table is empty !');
define('ERR_EDIT_SELF', 'You can\'t edit your own profile, use the \'My profile\' link for that');
define('EDIT', 'EDIT');
define('DELETE', 'DELETE');
define('NAME', 'User name');
define('GROUP', 'Group');
define('INACTIVE', 'Inactive');
define('OPERATIONS', 'Operations');
define('PICTURES', 'Pictures');
define('DISK_SPACE', 'Space used / Quota');
define('REGISTERED_ON', 'Registered on');
define('U_USER_ON_P_PAGES', '%d users on %d page(s)');
define('CONFIRM_DEL', 'Are you sure you want to DELETE this user ? \\nAll his pictures and albums will also be deleted.');
define('MAIL', 'MAIL');
define('ERR_UNKNOWN_USER', 'Selected user does not exist !');
define('MODIFY_USER', 'Modify user');
define('NOTES', 'Notes');
define('NOTE_LIST', '<li>If you don\'t want to change the current password, leave the \"password\" field blank');
define('PASSWORD', 'Password');
define('USER_ACTIVE_CP', 'User is active');
define('USER_GROUP_CP', 'User group');
define('USER_EMAIL', 'User email');
define('USER_WEB_SITE', 'User web site');
define('CREATE_NEW_USER', 'Create new user');
define('USER_FROM', 'User location');
define('USER_INTERESTS', 'User interests');
define('USER_OCC', 'User occupation');

// lang_util_php
define('TITLE', 'Resize pictures');
define('WHAT_IT_DOES', 'What it does');
define('WHAT_UPDATE_TITLES', 'Updates titles from filename');
define('WHAT_DELETE_TITLE', 'Deletes titles');
define('WHAT_REBUILD', 'Rebuilds thumbnails and resized photos');
define('WHAT_DELETE_ORIGINALS', 'Deletes original sized photos replacing them with the resized version');
define('FILE', 'File');
define('TITLE_SET_TO', 'title set to');
define('SUBMIT_FORM', 'submit');
define('UPDATED_SUCCESFULLY', 'updated succesfully');
define('ERROR_CREATE', 'ERROR creating');
define('CONTINUE', 'Process more images');
define('MAIN_SUCCESS', 'The file %s was successfully used as main picture');
define('ERROR_RENAME', 'Error renaming %s to %s');
define('ERROR_NOT_FOUND', 'The file %s was not found');
define('BACK', 'back to main');
define('THUMBS_WAIT', 'Updating thumbnails and/or resized images, please wait...');
define('THUMBS_CONTINUE_WAIT', 'Continuing to update thumbnails and/or resized images...');
define('TITLES_WAIT', 'Updating titles, please wait...');
define('DELETE_WAIT', 'Deleting titles, please wait...');
define('REPLACE_WAIT', 'Deleting originals and replacing them with resized images, please wait..');
define('INSTRUCTION', 'Quick instructions');
define('INSTRUCTION_ACTION', 'Select action');
define('INSTRUCTION_PARAMETER', 'Set parameters');
define('INSTRUCTION_ALBUM', 'Select album');
define('INSTRUCTION_PRESS', 'Press %s');
define('UPDATE', 'Update thumbs and/or resized photos');
define('UPDATE_WHAT', 'What should be updated');
define('UPDATE_THUMB', 'Only thumbnails');
define('UPDATE_PIC', 'Only resized pictures');
define('UPDATE_BOTH', 'Both thumbnails and resized pictures');
define('UPDATE_NUMBER', 'Number of processed images per click');
define('UPDATE_OPTION', '(Try setting this option lower if you experience timeout problems)');
define('FILENAME_TITLE', 'Filename &rArr; Picture title');
define('FILENAME_HOW', 'How should the filename be modified');
define('FILENAME_REMOVE', 'Remove the .jpg ending and replace _ (underscore) with spaces');
define('FILENAME_EURO', 'Change 2003_11_23_13_20_20.jpg to 23/11/2003 13:20');
define('FILENAME_US', 'Change 2003_11_23_13_20_20.jpg to 11/23/2003 13:20');
define('FILENAME_TIME', 'Change 2003_11_23_13_20_20.jpg to 13:20');
define('DELETE', 'Delete picture titles or original size photos');
define('DELETE_TITLE', 'Delete picture titles');
define('DELETE_ORIGINAL', 'Delete original size photos');
define('DELETE_REPLACE', 'Deletes the original images replacing them with the sized versions');
define('SELECT_ALBUM', 'Select album');

// lang_pagetitle_php
define('VIEWING', 'Viewing Photo');
define('USR', '\'s Photo Gallery');
define('PHOTOGALLERY', 'Photo Gallery');
?>
