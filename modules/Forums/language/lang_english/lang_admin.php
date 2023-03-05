<?php
$lang['General'] = 'General Admin';
$lang['Users'] = 'User Admin';
$lang['Groups'] = 'Group Admin';
$lang['Forums'] = 'Forum Admin';
$lang['Styles'] = 'Styles Admin';
$lang['Configuration'] = 'Configuration';
$lang['Permissions'] = 'Permissions';
$lang['Manage'] = 'Management';
$lang['Disallow'] = 'Disallow names';
$lang['Prune'] = 'Pruning';
$lang['Mass_Email'] = 'Mass Email';
$lang['Ranks'] = 'Ranks';
$lang['Smilies'] = 'Smilies';
$lang['Ban_Management'] = 'Ban Control';
$lang['Word_Censor'] = 'Word Censors';
$lang['Export'] = 'Export';
$lang['Create_new'] = 'Create';
$lang['Add_new'] = 'Add';
$lang['Backup_DB'] = 'Backup Template';
$lang['Restore_DB'] = 'Restore Template';
//
// Index
//
$lang['Admin'] = 'Administration';
$lang['Not_admin'] = 'You are not authorised to administer this board';
$lang['Welcome_phpBB'] = 'Welcome to The Platinum Nuke Pro Forum Administration Panel';
$lang['Admin_intro'] = 'Thank you for choosing Platinum Nuke Pro as your CMS solution. This screen will give you a quick overview of all the various statistics of your board. You can get back to this page by clicking on the <u>Admin Index</u> link in the left pane. To return to the index of your board, click the PlatinumNuke logo also in the left pane. The other links on the left hand side of this screen will allow you to control every aspect of your forum experience. Each screen will have instructions on how to use the tools.';
$lang['Main_index'] = 'Forum Index';
$lang['Forum_stats'] = 'Forum Statistics';
$lang['Admin_Index'] = 'Admin [Forums]';
$lang['Preview_forum'] = 'Preview Forum';
$lang['Click_return_admin_index'] = 'Click %sHere%s to return to the Admin Index';
$lang['Statistic'] = 'Statistic';
$lang['Value'] = 'Value';
$lang['Number_posts'] = 'Number of posts';
$lang['Posts_per_day'] = 'Posts per day';
$lang['Number_topics'] = 'Number of topics';
$lang['Topics_per_day'] = 'Topics per day';
$lang['Number_users'] = 'Number of users';
$lang['Users_per_day'] = 'Users per day';
$lang['Board_started'] = 'Board started';
$lang['Avatar_dir_size'] = 'Avatar directory size';
$lang['Database_size'] = 'Database size';
$lang['Gzip_compression'] ='Gzip compression';
$lang['Not_available'] = 'Not available';
$lang['ON'] = 'ON'; // This is for GZip compression
$lang['OFF'] = 'OFF'; 
//
// DB Utils
//
$lang['Database_Utilities'] = 'Database Utilities';
$lang['Restore'] = 'Restore';
$lang['Backup'] = 'Backup';
$lang['Restore_explain'] = 'This will perform a full restore of your forum template settings from a saved file. If your server supports it, you may upload a gzip-compressed text file and it will automatically be decompressed. <strong>WARNING</strong>: This will overwrite any existing data. The restore may take a long time to process, so please do not move from this page until it is complete.';
$lang['Backup_explain'] = 'Here you can back up all your forum template setting data. If you have any additional custom tables in the same database with phpBB that you would like to back up as well, please enter their names, separated by commas, in the Additional Tables textbox below. If your server supports it you may also gzip-compress the file to reduce its size before download.';
$lang['Backup_options'] = 'Backup options';
$lang['Start_backup'] = 'Start Backup';
$lang['Full_backup'] = 'Full backup';
$lang['Structure_backup'] = 'Structure-Only backup';
$lang['Data_backup'] = 'Data only backup';
$lang['Additional_tables'] = 'Additional tables';
$lang['Gzip_compress'] = 'Gzip compress file';
$lang['Select_file'] = 'Select a file';
$lang['Start_Restore'] = 'Start Restore';
$lang['Restore_success'] = 'The Database has been successfully restored.<br /><br />Your board should be back to the state it was when the backup was made.';
$lang['Backup_download'] = 'Your download will start shortly; please wait until it begins.';
$lang['Backups_not_supported'] = 'Sorry, but database backups are not currently supported for your database system.';
$lang['Restore_Error_uploading'] = 'Error in uploading the backup file';
$lang['Restore_Error_filename'] = 'Filename problem; please try an alternative file';
$lang['Restore_Error_decompress'] = 'Cannot decompress a gzip file; please upload a plain text version';
$lang['Restore_Error_no_file'] = 'No file was uploaded';
//
// Auth pages
//
$lang['Select_a_User'] = 'Select a User';
$lang['Select_a_Group'] = 'Select a Group';
$lang['Select_a_Forum'] = 'Select a Forum';
$lang['Auth_Control_User'] = 'User Permissions Control'; 
$lang['Auth_Control_Group'] = 'Group Permissions Control'; 
$lang['Auth_Control_Forum'] = 'Forum Permissions Control'; 
$lang['Look_up_User'] = 'Look up User'; 
$lang['Look_up_Group'] = 'Look up Group'; 
$lang['Look_up_Forum'] = 'Look up Forum'; 
$lang['Group_auth_explain'] = 'Here you can alter the permissions and moderator status assigned to each user group. Do not forget when changing group permissions that individual user permissions may still allow the user entry to forums, etc. You will be warned if this is the case.';
$lang['User_auth_explain'] = 'Here you can alter the permissions and moderator status assigned to each individual user. Do not forget when changing user permissions that group permissions may still allow the user entry to forums, etc. You will be warned if this is the case.';
$lang['Forum_auth_explain'] = 'Here you can alter the authorisation levels of each forum. You will have both a simple and advanced method for doing this, where advanced offers greater control of each forum operation. Remember that changing the permission level of forums will affect which users can carry out the various operations within them.';
$lang['Simple_mode'] = 'Simple Mode';
$lang['Advanced_mode'] = 'Advanced Mode';
$lang['Moderator_status'] = 'Moderator status';
$lang['Allowed_Access'] = 'Allowed Access';
$lang['Disallowed_Access'] = 'Disallowed Access';
$lang['Is_Moderator'] = 'Is Moderator';
$lang['Not_Moderator'] = 'Not Moderator';
$lang['Conflict_warning'] = 'Authorisation Conflict Warning';
$lang['Conflict_access_userauth'] = 'This user still has access rights to this forum via group membership. You may want to alter the group permissions or remove this user the group to fully prevent them having access rights. The groups granting rights (and the forums involved) are noted below.';
$lang['Conflict_mod_userauth'] = 'This user still has moderator rights to this forum via group membership. You may want to alter the group permissions or remove this user the group to fully prevent them having moderator rights. The groups granting rights (and the forums involved) are noted below.';
$lang['Conflict_access_groupauth'] = 'The following user (or users) still have access rights to this forum via their user permission settings. You may want to alter the user permissions to fully prevent them having access rights. The users granted rights (and the forums involved) are noted below.';
$lang['Conflict_mod_groupauth'] = 'The following user (or users) still have moderator rights to this forum via their user permissions settings. You may want to alter the user permissions to fully prevent them having moderator rights. The users granted rights (and the forums involved) are noted below.';
$lang['Public'] = 'Public';
$lang['Private'] = 'Private';
$lang['Registered'] = 'Registered';
$lang['Administrators'] = 'Administrators';
$lang['Hidden'] = 'Hidden';
// These are displayed in the drop down boxes for advanced
// mode forum auth, try and keep them short!
$lang['Forum_ALL'] = 'ALL';
$lang['Forum_REG'] = 'REG';
$lang['Forum_PRIVATE'] = 'PRIVATE';
$lang['Forum_MOD'] = 'MOD';
$lang['Forum_ADMIN'] = 'ADMIN';
$lang['View'] = 'View';
$lang['Read'] = 'Read';
$lang['Post'] = 'Post';
$lang['Reply'] = 'Reply';
$lang['Edit'] = 'Edit';
$lang['Delete'] = 'Delete';
$lang['Sticky'] = 'Sticky';
$lang['Announce'] = 'Announce'; 
$lang['Vote'] = 'Vote';
$lang['Pollcreate'] = 'Poll create';
$lang['Permissions'] = 'Permissions';
$lang['Simple_Permission'] = 'Simple Permissions';
$lang['User_Level'] = 'User Level'; 
$lang['Auth_User'] = 'User';
$lang['Auth_Admin'] = 'Administrator';
$lang['Group_memberships'] = 'Usergroup memberships';
$lang['Usergroup_members'] = 'This group has the following members';
$lang['Forum_auth_updated'] = 'Forum permissions updated';
$lang['User_auth_updated'] = 'User permissions updated';
$lang['Group_auth_updated'] = 'Group permissions updated';
$lang['Auth_updated'] = 'Permissions have been updated';
$lang['Click_return_userauth'] = 'Click %sHere%s to return to User Permissions';
$lang['Click_return_groupauth'] = 'Click %sHere%s to return to Group Permissions';
$lang['Click_return_forumauth'] = 'Click %sHere%s to return to Forum Permissions';
//
// Banning
//
$lang['Ban_control'] = 'Ban Control';
$lang['Ban_explain'] = 'Here you can control the banning of users. You can achieve this by banning either or both of a specific user or an individual or range of IP addresses or hostnames. These methods prevent a user from even reaching the index page of your board. To prevent a user from registering under a different username you can also specify a banned email address. Please note that banning an email address alone will not prevent that user from being able to log on or post to your board. You should use one of the first two methods to achieve this.';
$lang['Ban_explain_warn'] = 'Please note that entering a range of IP addresses results in all the addresses between the start and end being added to the banlist. Attempts will be made to minimise the number of addresses added to the database by introducing wildcards automatically where appropriate. If you really must enter a range, try to keep it small or better yet state specific addresses.';
$lang['Select_username'] = 'Select a Username';
$lang['Select_ip'] = 'Select an IP address';
$lang['Select_email'] = 'Select an Email address';
$lang['Ban_username'] = 'Ban one or more specific users';
$lang['Ban_username_explain'] = 'You can ban multiple users in one go using the appropriate combination of mouse and keyboard for your computer and browser';
$lang['Ban_IP'] = 'Ban one or more IP addresses or hostnames';
$lang['IP_hostname'] = 'IP addresses or hostnames';
$lang['Ban_IP_explain'] = 'To specify several different IP addresses or hostnames separate them with commas. To specify a range of IP addresses, separate the start and end with a hyphen (-); to specify a wildcard, use an asterisk (*).';
$lang['Ban_email'] = 'Ban one or more email addresses';
$lang['Ban_email_explain'] = 'To specify more than one email address, separate them with commas. To specify a wildcard username, use * like *@hotmail.com';
$lang['Unban_username'] = 'Un-ban one more specific users';
$lang['Unban_username_explain'] = 'You can unban multiple users in one go using the appropriate combination of mouse and keyboard for your computer and browser';
$lang['Unban_IP'] = 'Un-ban one or more IP addresses';
$lang['Unban_IP_explain'] = 'You can unban multiple IP addresses in one go using the appropriate combination of mouse and keyboard for your computer and browser';
$lang['Unban_email'] = 'Un-ban one or more email addresses';
$lang['Unban_email_explain'] = 'You can unban multiple email addresses in one go using the appropriate combination of mouse and keyboard for your computer and browser';
$lang['No_banned_users'] = 'No banned usernames';
$lang['No_banned_ip'] = 'No banned IP addresses';
$lang['No_banned_email'] = 'No banned email addresses';
$lang['Ban_update_sucessful'] = 'The banlist has been updated successfully';
$lang['Click_return_banadmin'] = 'Click %sHere%s to return to Ban Control';
//
// Configuration
//
$lang['General_Config'] = 'General Configuration';
$lang['Config_explain'] = 'The form below will allow you to customize all the general board options. For User and Forum configurations use the related links on the left hand side.';
$lang['Click_return_config'] = 'Click %sHere%s to return to General Configuration';
$lang['General_settings'] = 'General Board Settings';
$lang['Server_name'] = 'Domain Name';
$lang['Server_name_explain'] = 'The domain name from which this board runs';
$lang['Script_path'] = 'Script path';
$lang['Script_path_explain'] = 'The path where phpBB2 is located relative to the domain name';
$lang['Server_port'] = 'Server Port';
$lang['Server_port_explain'] = 'The port your server is running on, usually 80. Only change if different';
$lang['Site_name'] = 'Site name';
$lang['Site_desc'] = 'Site description';
$lang['Board_disable'] = 'Disable board';
$lang['Board_disable_explain'] = 'This will make the board unavailable to users. Administrators are able to access the Administration Panel while the board is disabled.';
$lang['Acct_activation'] = 'Enable account activation';
$lang['Acc_None'] = 'None'; // These three entries are the type of activation
$lang['Acc_User'] = 'User';
$lang['Acc_Admin'] = 'Admin';
$lang['Abilities_settings'] = 'User and Forum Basic Settings';
$lang['Max_poll_options'] = 'Max number of poll options';
/*****************************************************/
/* Forum - Who is Online Time v.1.0.2          START */
/*****************************************************/
$lang['who_is_online_time'] = 'How many minutes who is online should show';
/*****************************************************/
/* Forum - Who is Online Time v.1.0.2            END */
/*****************************************************/
$lang['Flood_Interval'] = 'Flood Interval';
$lang['Flood_Interval_explain'] = 'Number of seconds a user must wait between posts'; 
$lang['Board_email_form'] = 'User email via board';
$lang['Board_email_form_explain'] = 'Users send email to each other via this board';
$lang['Topics_per_page'] = 'Topics Per Page';
$lang['Posts_per_page'] = 'Posts Per Page';
$lang['Hot_threshold'] = 'Posts for Popular Threshold';
$lang['Default_style'] = 'Default Style';
$lang['Override_style'] = 'Override user style';
$lang['Override_style_explain'] = 'Replaces users style with the default';
$lang['Default_language'] = 'Default Language';
$lang['Date_format'] = 'Date Format';
$lang['System_timezone'] = 'System Timezone';
$lang['Enable_gzip'] = 'Enable GZip Compression';
$lang['Enable_prune'] = 'Enable Forum Pruning';
$lang['Allow_HTML'] = 'Allow HTML';
$lang['Allow_BBCode'] = 'Allow BBCode';
$lang['Allowed_tags'] = 'Allowed HTML tags';
$lang['Allowed_tags_explain'] = 'Separate tags with commas';
$lang['Allow_smilies'] = 'Allow Smilies';
$lang['Smilies_path'] = 'Smilies Storage Path';
$lang['Smilies_path_explain'] = 'Path under your phpBB root dir, e.g. images/smiles';
$lang['Allow_sig'] = 'Allow Signatures';
/*****************************************************/
/* Forum - Signature Once Per Page v.1.0.0     START */
/*****************************************************/
$lang['Sig_perpage'] = 'Limit Signatures';
$lang['Sig_perpage_explain'] = 'Signatures are limited to one per page';
/*****************************************************/
/* Forum - Signature Once Per Page v.1.0.0       END */
/*****************************************************/
$lang['Max_sig_length'] = 'Maximum signature length';
$lang['Max_sig_length_explain'] = 'Maximum number of characters in user signatures';
$lang['Allow_name_change'] = 'Allow Username changes';
/*****************************************************/
/* Forum - QUICK REPLY 1.0.2                   START */
/*****************************************************/
$lang['Allow_quick_reply'] = 'Allow Quick Reply';
/*****************************************************/
/* Forum - QUICK REPLY 1.0.2                   END   */
/*****************************************************/
$lang['Avatar_settings'] = 'Avatar Settings';
$lang['Allow_local'] = 'Enable gallery avatars';
$lang['Allow_remote'] = 'Enable remote avatars';
$lang['Allow_remote_explain'] = 'Avatars linked to from another website. For security reasons I would advise leaving 
this OFF.';
$lang['Allow_upload'] = 'Enable avatar uploading';
$lang['Max_filesize'] = 'Maximum Avatar File Size';
$lang['Max_filesize_explain'] = 'For uploaded avatar files';
$lang['Max_avatar_size'] = 'Maximum Avatar Dimensions';
$lang['Max_avatar_size_explain'] = '(Height x Width in pixels)';
$lang['Avatar_storage_path'] = 'Avatar Storage Path';
$lang['Avatar_storage_path_explain'] = 'Path under your phpBB root dir, e.g. images/avatars';
$lang['Avatar_gallery_path'] = 'Avatar Gallery Path';
$lang['Avatar_gallery_path_explain'] = 'Path under your phpBB root dir for pre-loaded images, e.g. images/avatars/gallery';
$lang['COPPA_settings'] = 'COPPA Settings';
$lang['COPPA_fax'] = 'COPPA Fax Number';
$lang['COPPA_mail'] = 'COPPA Mailing Address';
$lang['COPPA_mail_explain'] = 'This is the mailing address to which parents will send COPPA registration forms';
$lang['Email_settings'] = 'Email Settings';
$lang['Admin_email'] = 'Admin Email Address';
$lang['Email_sig'] = 'Email Signature';
$lang['Email_sig_explain'] = 'This text will be attached to all emails the board sends';
$lang['Use_SMTP'] = 'Use SMTP Server for email';
$lang['Use_SMTP_explain'] = 'Say yes if you want or have to send email via a named server instead of the local mail function';
$lang['SMTP_server'] = 'SMTP Server Address';
$lang['SMTP_username'] = 'SMTP Username';
$lang['SMTP_username_explain'] = 'Only enter a username if your SMTP server requires it';
$lang['SMTP_password'] = 'SMTP Password';
$lang['SMTP_password_explain'] = 'Only enter a password if your SMTP server requires it';
$lang['Disable_privmsg'] = 'Private Messaging';
$lang['Inbox_limits'] = 'Max posts in Inbox';
$lang['Sentbox_limits'] = 'Max posts in Sentbox';
$lang['Savebox_limits'] = 'Max posts in Savebox';
$lang['Cookie_settings'] = 'Cookie settings'; 
$lang['Cookie_settings_explain'] = 'These details define how cookies are sent to your users\' browsers. In most cases the default values for the cookie settings should be sufficient, but if you need to change them do so with care -- incorrect settings can prevent users from logging in';
$lang['Cookie_domain'] = 'Cookie domain';
$lang['Cookie_name'] = 'Cookie name';
$lang['Cookie_path'] = 'Cookie path';
$lang['Cookie_secure'] = 'Cookie secure';
$lang['Cookie_secure_explain'] = 'If your server is running via SSL, set this to enabled, else leave as disabled';
$lang['Session_length'] = 'Session length [ seconds ]';
// Visual Confirmation
$lang['Visual_confirm'] = 'Enable Visual Confirmation';
$lang['Visual_confirm_explain'] = 'Requires users enter a code defined by an image when registering.';
// Autologin Keys - added 2.0.18
$lang['Allow_autologin'] = 'Allow automatic logins';
$lang['Allow_autologin_explain'] = 'Determines whether users are allowed to select to be automatically logged in when visiting the forum';
$lang['Autologin_time'] = 'Automatic login key expiry';
$lang['Autologin_time_explain'] = 'How long a autologin key is valid for in days if the user does not visit the board. Set to zero to disable expiry.';
//
// Forum Management
//
$lang['Forum_admin'] = 'Forum Administration';
$lang['Forum_admin_explain'] = 'From this panel you can add, delete, edit, re-order and re-synchronise categories and forums';
$lang['Edit_forum'] = 'Edit forum';
$lang['Create_forum'] = 'Create new forum';
$lang['Create_category'] = 'Create new category';
$lang['Remove'] = 'Remove';
$lang['Action'] = 'Action';
$lang['Update_order'] = 'Update Order';
$lang['Config_updated'] = 'Forum Configuration Updated Successfully';
$lang['Edit'] = 'Edit';
$lang['Delete'] = 'Delete';
$lang['Move_up'] = 'Move up';
$lang['Move_down'] = 'Move down';
$lang['Resync'] = 'Resync';
$lang['No_mode'] = 'No mode was set';
$lang['Forum_edit_delete_explain'] = 'The form below will allow you to customize all the general board options. For User and Forum configurations use the related links on the left hand side';
$lang['Move_contents'] = 'Move all contents';
$lang['Forum_delete'] = 'Delete Forum';
$lang['Forum_delete_explain'] = 'The form below will allow you to delete a forum (or category) and decide where you want to put all topics (or forums) it contained.';
$lang['Status_locked'] = 'Locked';
$lang['Status_unlocked'] = 'Unlocked';
$lang['Forum_settings'] = 'General Forum Settings';
$lang['Forum_name'] = 'Forum name';
$lang['Forum_desc'] = 'Description';
$lang['Forum_status'] = 'Forum status';
//Forum Notify
$lang['Forum_notify'] = 'Allow forum notification';
$lang['Forum_notify_enabled'] = 'Allow';
$lang['Forum_notify_disabled'] = 'Do not allow';
$lang['Forum_pruning'] = 'Auto-pruning';
$lang['prune_freq'] = 'Check for topic age every';
$lang['prune_days'] = 'Remove topics that have not been posted to in';
$lang['Set_prune_data'] = 'You have turned on auto-prune for this forum but did not set a frequency or number of days to prune. Please go back and do so.';
$lang['Move_and_Delete'] = 'Move and Delete';
$lang['Delete_all_posts'] = 'Delete all posts';
$lang['Nowhere_to_move'] = 'Nowhere to move to';
$lang['Edit_Category'] = 'Edit Category';
$lang['Edit_Category_explain'] = 'Use this form to modify a category\'s name.';
$lang['Forums_updated'] = 'Forum and Category information updated successfully';
$lang['Must_delete_forums'] = 'You need to delete all forums before you can delete this category';
$lang['Click_return_forumadmin'] = 'Click %sHere%s to return to Forum Administration';
//
// Smiley Management
//
$lang['smiley_title'] = 'Smiles Editing Utility';
$lang['smile_desc'] = 'From this page you can add, remove and edit the emoticons or smileys that your users can use in their posts and private messages.';
$lang['smiley_config'] = 'Smiley Configuration';
$lang['smiley_code'] = 'Smiley Code';
$lang['smiley_url'] = 'Smiley Image File';
$lang['smiley_emot'] = 'Smiley Emotion';
$lang['smile_add'] = 'Add a new Smiley';
$lang['Smile'] = 'Smile';
$lang['Emotion'] = 'Emotion';
$lang['Select_pak'] = 'Select Pack (.pak) File';
$lang['replace_existing'] = 'Replace Existing Smiley';
$lang['keep_existing'] = 'Keep Existing Smiley';
$lang['smiley_import_inst'] = 'You should unzip the smiley package and upload all files to the appropriate Smiley directory for your installation. Then select the correct information in this form to import the smiley pack.';
$lang['smiley_import'] = 'Smiley Pack Import';
$lang['choose_smile_pak'] = 'Choose a Smile Pack .pak file';
$lang['import'] = 'Import Smileys';
$lang['smile_conflicts'] = 'What should be done in case of conflicts';
$lang['del_existing_smileys'] = 'Delete existing smileys before import';
$lang['import_smile_pack'] = 'Import Smiley Pack';
$lang['export_smile_pack'] = 'Create Smiley Pack';
$lang['export_smiles'] = 'To create a smiley pack from your currently installed smileys, click %sHere%s to download the smiles.pak file. Name this file appropriately making sure to keep the .pak file extension.  Then create a zip file containing all of your smiley images plus this .pak configuration file.';
$lang['smiley_add_success'] = 'The Smiley was successfully added';
$lang['smiley_edit_success'] = 'The Smiley was successfully updated';
$lang['smiley_import_success'] = 'The Smiley Pack was imported successfully!';
$lang['smiley_del_success'] = 'The Smiley was successfully removed';
$lang['Click_return_smileadmin'] = 'Click %sHere%s to return to Smiley Administration';
//
// User Management
//
$lang['User_admin'] = 'User Administration';
$lang['User_admin_explain'] = 'Here you can change your users\' information and certain options. To modify the users\' permissions, please use the user and group permissions system.';
$lang['Look_up_user'] = 'Look up user';
$lang['Admin_user_fail'] = 'Couldn\'t update the user\'s profile.';
$lang['Admin_user_updated'] = 'The user\'s profile was successfully updated.';
$lang['Click_return_useradmin'] = 'Click %sHere%s to return to User Administration';
$lang['User_delete'] = 'Delete this user';
$lang['User_delete_explain'] = 'Click here to delete this user; this cannot be undone.';
$lang['User_deleted'] = 'User was successfully deleted.';
$lang['User_status'] = 'User is active';
$lang['User_allowpm'] = 'Can send Private Messages';
$lang['User_allowavatar'] = 'Can display avatar';
$lang['Admin_avatar_explain'] = 'Here you can see and delete the user\'s current avatar.';
$lang['User_special'] = 'Special admin-only fields';
$lang['User_special_explain'] = 'These fields are not able to be modified by the users.  Here you can set their status and other options that are not given to users.';
/*****************************************************/
/* Forum - Edit User Post Count v.1.0.1        START */
/*****************************************************/
$lang['Set_posts'] = "User Posts"; 
/*****************************************************/
/* Forum - Edit User Post Count v.1.0.1          END */
/*****************************************************/
//
// Group Management
//
$lang['Group_administration'] = 'Group Administration';
$lang['Group_admin_explain'] = 'From this panel you can administer all your usergroups. You can delete, create and edit existing groups. You may choose moderators, toggle open/closed group status and set the group name and description';
$lang['Error_updating_groups'] = 'There was an error while updating the groups';
$lang['Updated_group'] = 'The group was successfully updated';
$lang['Added_new_group'] = 'The new group was successfully created';
$lang['Deleted_group'] = 'The group was successfully deleted';
$lang['New_group'] = 'Create new group';
$lang['Edit_group'] = 'Edit group';
$lang['group_name'] = 'Group name';
$lang['group_description'] = 'Group description';
$lang['group_moderator'] = 'Group moderator';
$lang['group_status'] = 'Group status';
$lang['group_open'] = 'Open group';
$lang['group_closed'] = 'Closed group';
$lang['group_hidden'] = 'Hidden group';
$lang['group_delete'] = 'Delete group';
$lang['group_delete_check'] = 'Delete this group';
$lang['submit_group_changes'] = 'Submit Changes';
$lang['reset_group_changes'] = 'Reset Changes';
$lang['No_group_name'] = 'You must specify a name for this group';
$lang['No_group_moderator'] = 'You must specify a moderator for this group';
$lang['No_group_mode'] = 'You must specify a mode for this group, open or closed';
$lang['No_group_action'] = 'No action was specified';
$lang['delete_group_moderator'] = 'Delete the old group moderator?';
$lang['delete_moderator_explain'] = 'If you\'re changing the group moderator, check this box to remove the old moderator from the group.  Otherwise, do not check it, and the user will become a regular member of the group.';
$lang['Click_return_groupsadmin'] = 'Click %sHere%s to return to Group Administration.';
$lang['Select_group'] = 'Select a group';
$lang['Look_up_group'] = 'Look up group';
//
// Prune Administration
//
$lang['Forum_Prune'] = 'Forum Prune';
$lang['Forum_Prune_explain'] = 'This will delete any topic which has not been posted to within the number of days you select. If you do not enter a number then all topics will be deleted. It will not remove topics in which polls are still running nor will it remove announcements. You will need to remove those topics manually.';
$lang['Do_Prune'] = 'Do Prune';
$lang['All_Forums'] = 'All Forums';
$lang['Prune_topics_not_posted'] = 'Prune topics with no replies in this many days';
$lang['Topics_pruned'] = 'Topics pruned';
$lang['Posts_pruned'] = 'Posts pruned';
$lang['Prune_success'] = 'Pruning of forums was successful';
//
// Word censor
//
$lang['Words_title'] = 'Word Censoring';
$lang['Words_explain'] = 'From this control panel you can add, edit, and remove words that will be automatically censored on your forums. In addition people will not be allowed to register with usernames containing these words. Wildcards (*) are accepted in the word field. For example, *test* will match detestable, test* would match testing, *test would match detest.';
$lang['Word'] = 'Word';
$lang['Edit_word_censor'] = 'Edit word censor';
$lang['Replacement'] = 'Replacement';
$lang['Add_new_word'] = 'Add new word';
$lang['Update_word'] = 'Update word censor';
$lang['Must_enter_word'] = 'You must enter a word and its replacement';
$lang['No_word_selected'] = 'No word selected for editing';
$lang['Word_updated'] = 'The selected word censor has been successfully updated';
$lang['Word_added'] = 'The word censor has been successfully added';
$lang['Word_removed'] = 'The selected word censor has been successfully removed';
$lang['Click_return_wordadmin'] = 'Click %sHere%s to return to Word Censor Administration';
/*****************************************************/
/* Forum - Acronym v.0.9.5                     START */
/*****************************************************/
$lang['Acronyms_title'] = 'Acronyms Administration';
$lang['Acronyms_explain'] = 'From this control panel you can add, edit, and remove acronyms that will be automatically added to posts on your forums.';
$lang['Acronym'] = 'Acronym';
$lang['Acronyms'] = 'Acronyms';
$lang['Edit_acronym'] = 'Edit Acronym';
$lang['Description'] = 'Description';
$lang['Add_new_acronym'] = 'Add new acronym';
$lang['Update_acronym'] = 'Update acronym';
$lang['Must_enter_acronym'] = 'You must enter a acronym and its description';
$lang['No_acronym_selected'] = 'No acronym selected for editing';
$lang['Acronym_updated'] = 'The selected acronym has been successfully updated';
$lang['Acronym_added'] = 'The acronym has been successfully added';
$lang['Acronym_removed'] = 'The selected acronym has been successfully removed';
$lang['Click_return_acronymadmin'] = 'Click %sHere%s to return to Acronym Administration';
/*****************************************************/
/* Forum - Acronym v.0.9.5                       END */
/*****************************************************/
//
// Mass Email
//
$lang['Mass_email_explain'] = 'Here you can email a message to either all of your users or all users of a specific group.  To do this, an email will be sent out to the administrative email address supplied, with a blind carbon copy sent to all recipients. If you are emailing a large group of people please be patient after submitting and do not stop the page halfway through. It is normal for a mass emailing to take a long time and you will be notified when the script has completed';
$lang['Compose'] = 'Compose'; 
$lang['Recipients'] = 'Recipients'; 
$lang['All_users'] = 'All Users';
$lang['Email_successfull'] = 'Your message has been sent';
$lang['Click_return_massemail'] = 'Click %sHere%s to return to the Mass Email form';
//
// Ranks admin
//
$lang['Ranks_title'] = 'Rank Administration';
$lang['Ranks_explain'] = 'Using this form you can add, edit, view and delete ranks. You can also create custom ranks which can be applied to a user via the user management facility';
$lang['Add_new_rank'] = 'Add new rank';
$lang['Rank_title'] = 'Rank Title';
$lang['Rank_special'] = 'Set as Special Rank';
$lang['Rank_minimum'] = 'Minimum Posts';
$lang['Rank_maximum'] = 'Maximum Posts';
$lang['Rank_image'] = 'Rank Image (Relative to phpBB2 root path)';
$lang['Rank_image_explain'] = 'Use this to define a small image associated with the rank';
$lang['Must_select_rank'] = 'You must select a rank';
$lang['No_assigned_rank'] = 'No special rank assigned';
$lang['Rank_updated'] = 'The rank was successfully updated';
$lang['Rank_added'] = 'The rank was successfully added';
$lang['Rank_removed'] = 'The rank was successfully deleted';
$lang['No_update_ranks'] = 'The rank was successfully deleted. However, user accounts using this rank were not updated.  You will need to manually reset the rank on these accounts';
$lang['Click_return_rankadmin'] = 'Click %sHere%s to return to Rank Administration';
//
// Disallow Username Admin
//
$lang['Disallow_control'] = 'Username Disallow Control';
$lang['Disallow_explain'] = 'Here you can control usernames which will not be allowed to be used.  Disallowed usernames are allowed to contain a wildcard character of *.  Please note that you will not be allowed to specify any username that has already been registered. You must first delete that name then disallow it.';
$lang['Delete_disallow'] = 'Delete';
$lang['Delete_disallow_title'] = 'Remove a Disallowed Username';
$lang['Delete_disallow_explain'] = 'You can remove a disallowed username by selecting the username from this list and clicking submit';
$lang['Add_disallow'] = 'Add';
$lang['Add_disallow_title'] = 'Add a disallowed username';
$lang['Add_disallow_explain'] = 'You can disallow a username using the wildcard character * to match any character';
$lang['No_disallowed'] = 'No Disallowed Usernames';
$lang['Disallowed_deleted'] = 'The disallowed username has been successfully removed';
$lang['Disallow_successful'] = 'The disallowed username has been successfully added';
$lang['Disallowed_already'] = 'The name you entered could not be disallowed. It either already exists in the list, exists in the word censor list, or a matching username is present.';
$lang['Click_return_disallowadmin'] = 'Click %sHere%s to return to Disallow Username Administration';
//
// Styles Admin
//
$lang['Styles_admin'] = 'Styles Administration';
$lang['Styles_explain'] = 'Using this facility you can add, remove and manage styles (templates and themes) available to your users';
$lang['Styles_addnew_explain'] = 'The following list contains all the themes that are available for the templates you currently have. The items on this list have not yet been installed into the phpBB database. To install a theme, simply click the install link beside an entry.';
$lang['Select_template'] = 'Select a Template';
$lang['Style'] = 'Style';
$lang['Template'] = 'Template';
$lang['Install'] = 'Install';
$lang['Download'] = 'Download';
$lang['Edit_theme'] = 'Edit Theme';
$lang['Edit_theme_explain'] = 'In the form below you can edit the settings for the selected theme';
$lang['Create_theme'] = 'Create Theme';
$lang['Create_theme_explain'] = 'Use the form below to create a new theme for a selected template. When entering colours (for which you should use hexadecimal notation) you must not include the initial #, i.e.. CCCCCC is valid, #CCCCCC is not';
$lang['Export_themes'] = 'Export Themes';
$lang['Export_explain'] = 'In this panel you will be able to export the theme data for a selected template. Select the template from the list below and the script will create the theme configuration file and attempt to save it to the selected template directory. If it cannot save the file itself it will give you the option to download it. In order for the script to save the file you must give write access to the webserver for the selected template dir. For more information on this see the phpBB 2 users guide.';
$lang['Theme_installed'] = 'The selected theme has been installed successfully';
$lang['Style_removed'] = 'The selected style has been removed from the database. To fully remove this style from your system you must delete the appropriate style from your templates directory.';
$lang['Theme_info_saved'] = 'The theme information for the selected template has been saved. You should now return the permissions on the theme_info.cfg (and if applicable the selected template directory) to read-only';
$lang['Theme_updated'] = 'The selected theme has been updated. You should now export the new theme settings';
$lang['Theme_created'] = 'Theme created. You should now export the theme to the theme configuration file for safe keeping or use elsewhere';
$lang['Confirm_delete_style'] = 'Are you sure you want to delete this style?';
$lang['Download_theme_cfg'] = 'The exporter could not write the theme information file. Click the button below to download this file with your browser. Once you have downloaded it you can transfer it to the directory containing the template files. You can then package the files for distribution or use elsewhere if you desire';
$lang['No_themes'] = 'The template you selected has no themes attached to it. To create a new theme click the Create New link on the left hand panel';
$lang['No_template_dir'] = 'Could not open the template directory. It may be unreadable by the webserver or may not exist';
$lang['Cannot_remove_style'] = 'You cannot remove the style selected since it is currently the forum default. Please change the default style and try again.';
$lang['Style_exists'] = 'The style name to selected already exists, please go back and choose a different name.';
$lang['Click_return_styleadmin'] = 'Click %sHere%s to return to Style Administration';
$lang['Theme_settings'] = 'Theme Settings';
$lang['Theme_element'] = 'Theme Element';
$lang['Simple_name'] = 'Simple Name';
$lang['Value'] = 'Value';
$lang['Save_Settings'] = 'Save Settings';
$lang['Stylesheet'] = 'CSS Stylesheet';
$lang['Stylesheet_explain'] = 'Filename for CSS stylesheet to use for this theme.';
$lang['Background_image'] = 'Background Image';
$lang['Background_color'] = 'Background Colour';
$lang['Theme_name'] = 'Theme Name';
$lang['Link_color'] = 'Link Colour';
$lang['Text_color'] = 'Text Colour';
$lang['VLink_color'] = 'Visited Link Colour';
$lang['ALink_color'] = 'Active Link Colour';
$lang['HLink_color'] = 'Hover Link Colour';
$lang['Tr_color1'] = 'Table Row Colour 1';
$lang['Tr_color2'] = 'Table Row Colour 2';
$lang['Tr_color3'] = 'Table Row Colour 3';
$lang['Tr_class1'] = 'Table Row Class 1';
$lang['Tr_class2'] = 'Table Row Class 2';
$lang['Tr_class3'] = 'Table Row Class 3';
$lang['Th_color1'] = 'Table Header Colour 1';
$lang['Th_color2'] = 'Table Header Colour 2';
$lang['Th_color3'] = 'Table Header Colour 3';
$lang['Th_class1'] = 'Table Header Class 1';
$lang['Th_class2'] = 'Table Header Class 2';
$lang['Th_class3'] = 'Table Header Class 3';
$lang['Td_color1'] = 'Table Cell Colour 1';
$lang['Td_color2'] = 'Table Cell Colour 2';
$lang['Td_color3'] = 'Table Cell Colour 3';
$lang['Td_class1'] = 'Table Cell Class 1';
$lang['Td_class2'] = 'Table Cell Class 2';
$lang['Td_class3'] = 'Table Cell Class 3';
$lang['fontface1'] = 'Font Face 1';
$lang['fontface2'] = 'Font Face 2';
$lang['fontface3'] = 'Font Face 3';
$lang['fontsize1'] = 'Font Size 1';
$lang['fontsize2'] = 'Font Size 2';
$lang['fontsize3'] = 'Font Size 3';
$lang['fontcolor1'] = 'Font Colour 1';
$lang['fontcolor2'] = 'Font Colour 2';
$lang['fontcolor3'] = 'Font Colour 3';
$lang['span_class1'] = 'Span Class 1';
$lang['span_class2'] = 'Span Class 2';
$lang['span_class3'] = 'Span Class 3';
$lang['img_poll_size'] = 'Polling Image Size [px]';
$lang['img_pm_size'] = 'Private Message Status size [px]';
//
// Install Process
//
$lang['Welcome_install'] = 'Welcome to phpBB 2 Installation';
$lang['Initial_config'] = 'Basic Configuration';
$lang['DB_config'] = 'Database Configuration';
$lang['Admin_config'] = 'Admin Configuration';
$lang['continue_upgrade'] = 'Once you have downloaded your config file to your local machine you may\'Continue Upgrade\' button below to move forward with the upgrade process.  Please wait to upload the config file until the upgrade process is complete.';
$lang['upgrade_submit'] = 'Continue Upgrade';
$lang['Installer_Error'] = 'An error has occurred during installation';
$lang['Previous_Install'] = 'A previous installation has been detected';
$lang['Install_db_error'] = 'An error occurred trying to update the database';
$lang['Re_install'] = 'Your previous installation is still active.<br /><br />If you would like to re-install phpBB 2 you should click the Yes button below. Please be aware that doing so will destroy all existing data and no backups will be made! The administrator username and password you have used to login in to the board will be re-created after the re-installation and no other settings will be retained.<br /><br />Think carefully before pressing Yes!';
$lang['Inst_Step_0'] = 'Thank you for choosing phpBB 2. In order to complete this install please fill out the details requested below. Please note that the database you install into should already exist. If you are installing to a database that uses ODBC, e.g. MS Access you should first create a DSN for it before proceeding.';
$lang['Start_Install'] = 'Start Install';
$lang['Finish_Install'] = 'Finish Installation';
$lang['Default_lang'] = 'Default board language';
$lang['DB_Host'] = 'Database Server Hostname / DSN';
$lang['DB_Name'] = 'Your Database Name';
$lang['DB_Username'] = 'Database Username';
$lang['DB_Password'] = 'Database Password';
$lang['Database'] = 'Your Database';
$lang['Install_lang'] = 'Choose Language for Installation';
$lang['dbms'] = 'Database Type';
$lang['Table_Prefix'] = 'Prefix for tables in database';
$lang['Admin_Username'] = 'Administrator Username';
$lang['Admin_Password'] = 'Administrator Password';
$lang['Admin_Password_confirm'] = 'Administrator Password [ Confirm ]';
$lang['Inst_Step_2'] = 'Your admin username has been created.  At this point your basic installation is complete. You will now be taken to a screen which will allow you to administer your new installation. Please be sure to check the General Configuration details and make any required changes. Thank you for choosing phpBB 2.';
$lang['Unwriteable_config'] = 'Your config file is un-writeable at present. A copy of the config file will be downloaded to your computer when you click the button below. You should upload this file to the same directory as phpBB 2. Once this is done you should log in using the administrator name and password you provided on the previous form and visit the admin control center (a link will appear at the bottom of each screen once logged in) to check the general configuration. Thank you for choosing phpBB 2.';
$lang['Download_config'] = 'Download Config';
$lang['ftp_choose'] = 'Choose Download Method';
$lang['ftp_option'] = '<br />Since FTP extensions are enabled in this version of PHP you may also be given the option of first trying to automatically FTP the config file into place.';
$lang['ftp_instructs'] = 'You have chosen to FTP the file to the account containing phpBB 2 automatically.  Please enter the information below to facilitate this process. Note that the FTP path should be the exact path via FTP to your phpBB2 installation as if you were FTPing to it using any normal client.';
$lang['ftp_info'] = 'Enter Your FTP Information';
$lang['Attempt_ftp'] = 'Attempt to FTP config file into place';
$lang['Send_file'] = 'Just send the file to me and I\'ll FTP it manually';
$lang['ftp_path'] = 'FTP path to phpBB 2';
$lang['ftp_username'] = 'Your FTP Username';
$lang['ftp_password'] = 'Your FTP Password';
$lang['Transfer_config'] = 'Start Transfer';
$lang['NoFTP_config'] = 'The attempt to FTP the config file into place failed.  Please download the config file and FTP it into place manually.';
$lang['Install'] = 'Install';
$lang['Upgrade'] = 'Upgrade';
$lang['Install_Method'] = 'Choose your installation method';
$lang['Install_No_Ext'] = 'The PHP configuration on your server doesn\'t support the database type that you chose';
$lang['Install_No_PCRE'] = 'phpBB2 Requires the Perl-Compatible Regular Expressions Module for PHP which your PHP configuration doesn\'t appear to support!';
$lang['proxy_title'] = 'Block Open Proxy Registrants';
$lang['proxy_desc'] = 'This page will allow you to customize Block Open Proxy Registrants, to check individual IP addresses, and to view recently used proxies.';
$lang['proxy_test'] = 'Check IP Address';
$lang['proxy_test_desc'] = 'Checks whether or not an IP address of your chosing is a proxy using the current settings.  Can conduct checks even when Block Open Proxy Registrants has been disabled.';
$lang['proxy_ip'] = 'IP Address';
$lang['proxy_enable'] = 'Block Open Proxy Registrants';
$lang['proxy_ban'] = 'Ban Open Proxies';
$lang['proxy_ban_explain'] = 'Bans IP addresses revealed to be open proxies.';
$lang['proxy_timeout'] = 'Connection Timeout';
$lang['proxy_timeout_explain'] = 'The larger the value, the more accurate proxy detection will be, but the longer the users attempting to register will have to wait.';
$lang['proxy_seconds'] = 'seconds';
$lang['proxy_minutes'] = 'minutes';
$lang['proxy_hours'] = 'hours';
$lang['proxy_days'] = 'days';
$lang['proxy_weeks'] = 'weeks';
$lang['proxy_months'] = 'months';
$lang['proxy_years'] = 'years';
$lang['proxy_type'] = 'Type';
$lang['proxy_last_checked'] = 'Last Checked';
$lang['proxy_port'] = 'Port';
$lang['proxy_ports'] = 'Ports to scan';
$lang['proxy_ports_explain'] = 'In theory, up to 64 ports can be simultaneously scanned, but in practice, the total number should be kept to a bare minimum.';
$lang['proxy_cache_time'] = 'Cache Time';
$lang['proxy_cache_time_explain'] = 'Determines how frequently the same IP address will be checked. Entering 0 will result in IP addresses never being checked twice.';
$lang['proxy_user_agent'] = 'User Agent String';
$lang['proxy_user_agent_explain'] = 'Determines how HTTP requests ought to identify themselves when attempting to connect to a proxy.';
$lang['proxy_debug'] = 'Debug Information';
$lang['proxy_settings'] = 'MOD Configuration';
$lang['proxy_list_desc'] = 'Lists the three most recently confirmed proxies.';
$lang['proxy_sample_http_1'] = 'Sample HTTP Request 1';
$lang['proxy_sample_http_2'] = 'Sample HTTP Request 2';
$lang['proxy_sample_sql'] = 'Sample SQL Query';
$lang['proxy_exec_time'] = 'Execution Time';
$lang['proxy_none'] = 'No Proxy Severs Detected.';
$lang['proxy_connect_error'] = 'Unable to connect to %s to spawn processes<br /><strong>Error %d</strong>: %s';
$lang['proxy_testing'] = 'Checking <strong>%s</strong>...';
$lang['proxy_hostname'] = 'Hostname <strong>%s</strong>';
$lang['proxy_check'] = 'Check';
$lang['proxy_view_list'] = 'View Complete List';
$lang['proxy_deleted'] = '%s has been deleted.';
$lang['proxy_download'] = 'Download As Text';
$lang['proxy_return'] = 'Click %sHere%s to return to the previous page';
$lang['proxy_name'] = 'Block Open Proxies';
/*****************************************************/
/* Forum - Move Topics Locked v.1.1.2          START */
/*****************************************************/
$lang['MT_header'] = 'Locked topics move configuration.';
$lang['MT_move'] = 'Move topics when locked?';
$lang['MT_move_to'] = 'Move topics to:';
$lang['MT_move_to_desc'] = 'Here you need to fill in ONE id. To get the id hover above a link and get the value behind "f=".';
$lang['MT_special'] = 'Leave sticky and accouncements?';
$lang['MT_special_desc'] = 'Leaves sticky and announcements in place when locked.';
$lang['MT_only_anno'] = 'Only Announcements';
/*****************************************************/
/* Forum - Move Topics Locked v.1.1.2            END */
/*****************************************************/
/*****************************************************/
/* Forum - Admin Userlist v.2.0.2              START */
/*****************************************************/
$lang['Userlist'] = 'Account List';
$lang['Userlist_description'] = 'View a complete list of accounts on this board and perform various actions on them';
$lang['Add_group'] = 'Add to a Group';
$lang['Add_group_explain'] = 'Select which group to add the selected users to';
$lang['Open_close'] = 'Open/Close';
$lang['Active'] = 'Active';
$lang['Group'] = 'Group(s)';
$lang['Rank'] = 'Rank';
$lang['Last_activity'] = 'Last Activity';
$lang['Never'] = 'Never';
$lang['User_manage'] = 'Manage';
$lang['Find_all_posts'] = 'Find All Posts';
$lang['Select_one'] = 'Select One';
$lang['Ban'] = 'Ban';
$lang['Activate_deactivate'] = 'Activate/De-activate';
$lang['User_id'] = 'User id';
$lang['User_level'] = 'User Level';
$lang['Ascending'] = 'Ascending';
$lang['Descending'] = 'Descending';
$lang['Show'] = 'Show';
$lang['All'] = 'All';
$lang['Member'] = 'Member';
$lang['Pending'] = 'Pending';
$lang['Confirm_user_ban'] = 'Are you sure you want to ban the selected user(s)?';
$lang['Confirm_user_deleted'] = 'Are you sure you want to delete the selected user(s)?';
$lang['User_status_updated'] = 'User(s) status updated successfully!';
$lang['User_banned_successfully'] = 'User(s) banned successfully!';
$lang['User_deleted_successfully'] = 'User(s) deleted successfully!';
$lang['User_add_group_successfully'] = 'User(s) added to group successfully!';
$lang['Cancel'] = 'Cancel';
$lang['Click_return_userlist'] = 'Click %shere%s to return to the User List';
/*****************************************************/
/* Forum - Admin Userlist v.2.0.2                END */
/*****************************************************/
/*****************************************************/
/* Forum - Global Announce v.1.2.3             START */
/*****************************************************/
$lang['Globalannounce'] ='Global Announce'; 
/*****************************************************/
/* Forum - Global Announce v.1.2.3               END */
/*****************************************************/
/*****************************************************/
/* Forum - Split Topic Type v.1.0.3            START */
/*****************************************************/
$lang['Announce_settings'] = 'Announcements Settings';
$lang['split_announce'] = 'Split announcement from other topic types';
$lang['split_sticky'] = 'Split sticky topics too';
$lang['split_global_announce'] = 'Split also global announcement';
/*****************************************************/
/* Forum - Split Topic Type v.1.0.3              END */
/*****************************************************/
/*****************************************************/
/* Forum - Advanced Report Hack v.1.0.0        START */
/*****************************************************/
$lang['Reports'] = 'Reports';
$lang['List'] = 'List';
$lang['Report_Admin_title'] = 'Reports Administration';
$lang['Report_Admin_explain'] = 'On this page you can create, edit or delete report categories. You can also change a few settings concerning reports.';
$lang['Report_count'] = 'Report Count';
$lang['Type'] = 'Type';
$lang['Report_Type_normal'] = 'normal';
$lang['Report_Type_extension'] = 'extension';
$lang['Authorisation'] = 'Authorisation';
$lang['Description'] = 'Description';
$lang['Standard_categories'] = 'Standard categories';
$lang['No_standard_categories'] = 'there are no standard categories.';
$lang['Extension_categories'] = 'Extensions';
$lang['No_extension_categories'] = 'there are no extensions.';
$lang['Administrators_moderators'] = 'Administrators and Moderators';
$lang['Only_administrators'] = 'only Administrators';
$lang['Report_color_not_cleared'] = 'Color for reports that haven\'t been cleared';
$lang['Report_color_in_process'] = 'Color for reports that are in process';
$lang['Report_color_cleared'] = 'Color for reports that are cleared';
$lang['Reportlist_type'] = 'Report list type';
$lang['Reportlist_type_admin'] = 'Admin-Panel';
$lang['Reportlist_type_external'] = 'Admin-Panel and external list';
$lang['Report_notify'] = 'Email-notification';
$lang['No_name_entered'] = 'You have to enter a valid name.';
$lang['Category_deleted'] = 'The category was deleted successfully.';
$lang['Confirm_delete_category'] = 'Are you sure you want to delete this category?';
$lang['Confirm_delete_category_reportdel'] = ' All reports in this category will be deleted, too.';
$lang['Reports_delete'] = 'Delete reports';
$lang['Reports_move'] = 'Move reports to: %s';
$lang['Category_created'] = 'The category was created successfully.';
$lang['Category_edited'] = 'The category was edited successfully.';
$lang['Click_return_catadmin'] = 'Click %shere%s to return to the category administration.';
/*****************************************************/
/* Forum - Advanced Report Hack v.1.0.0          END */
/*****************************************************/
/*****************************************************/
/* Forum - List Smilies Per Post v.1.0.2       START */
/*****************************************************/
$lang['Max_smilies'] = 'Maximum smilies limit per post';
/*****************************************************/
/* Forum - List Smilies Per Post v.1.0.2         END */
/*****************************************************/
/*****************************************************/
/* Forum - Restrict Signatures v.0.1.1         START */
/*****************************************************/
$lang['Max_sig_images_limit'] = 'Maximum Images Per Signatures';
$lang['Max_sig_images_size'] = 'Maximum Image Dimensions In Signatures';
$lang['Max_sig_images_size_explain'] = '(Height x Width in pixels)';
/*****************************************************/
/* Forum - Restrict Signatures v.0.1.1           END */
/*****************************************************/
/*****************************************************/
/* Forum - Advanced Signature Divider v.1.0.1  START */
/*****************************************************/
$lang['sig_title']   = 'Advanced Signature Divider Control';
$lang['sig_divider'] = 'Current Signature Divider';
$lang['sig_explain'] = "This is where you control what divides the user's signature from their post";
/*****************************************************/
/* Forum - Advanced Signature Divider v.1.0.1    END */
/*****************************************************/
/*****************************************************/
/* Forum - User Online Status v.1.0.5          START */
/*****************************************************/
$lang['Online_setting'] = 'Online Status Setting';
$lang['Online_color'] = 'Online text color';
$lang['Offline_color'] = 'Offline text color';
$lang['Hidden_color'] = 'Hidden text color';
/*****************************************************/
/* Forum - User Online Status v.1.0.5            END */
/*****************************************************/
/*****************************************************/
/* Forum - PM Quick Reply v.1.3.5              START */
/*****************************************************/
$lang['ropm_quick_reply'] = 'PM Quick Reply';
$lang['enable_ropm_quick_reply'] = "Enable PM Quick Reply";
$lang['ropm_quick_reply_bbc'] = "Enable BBCode-Buttons";
$lang['ropm_quick_reply_smilies'] = "Number of smilies";
$lang['ropm_quick_reply_smilies_info'] = "You have to enter 0 here, if you don't want any smilies to be displayed.";
/*****************************************************/
/* Forum - PM Quick Reply v.1.3.5                END */
/*****************************************************/
/*****************************************************/
/* Forum - Guest Username Requirement v.1.2.0  START */
/*****************************************************/
$lang['guests_need_name'] = "Force guests to fill in their username in every posting"; 
/*****************************************************/
/* Forum - Guest Username Requirement v.1.2.0    END */
/*****************************************************/
/*****************************************************/
/* Forum - Limit Image Width v.1.0.6           START */
/*****************************************************/
$lang['Max_img_width'] = 'Maximum image width';
$lang['Max_img_width_explain'] = 'Specify the maximum width of an image posted using the [img] tags here. The value should be in pixels.<br>Entering 0 will disable the Limit Image Width MOD';
/*****************************************************/
/* Forum - Limit Image Width v.1.0.6             END */
/*****************************************************/
/*****************************************************/
/* Forum - Configure Smilies Table v.1.0.0     START */
/*****************************************************/
$lang['Smilie_table_columns'] = 'Smilie table columns';
$lang['Smilie_table_rows'] = 'Smilie table rows';
$lang['Smilie_window_columns'] = 'Smilie window columns';
/*****************************************************/
/* Forum - Configure Smilies Table v.1.0.0       END */
/*****************************************************/
/*****************************************************/
/* Forum - Log Actions v.1.1.6                 START */
/*****************************************************/
$lang['File_not_deleted'] = 'You have not yet delete the file install_tables.php : do it before trying to see this page.';
$lang['Log_action_title'] = 'Logs Actions';
$lang['Log_action_explain'] = 'Here you can see your moderators/administrators actions';
$lang['Choose_sort_method'] = 'Choose sorting method';
$lang['Order'] = 'Order';
$lang['Go'] = 'Go';
$lang['Id_log'] = 'Log Id';
$lang['Choose_log'] = 'Select Log';
$lang['Delete'] = 'Delete';
$lang['Action'] = 'Action';
$lang['Topic'] = 'Topic';
$lang['Done_by'] = 'Done By';
$lang['User_ip'] = 'User IP';
$lang['Select_all'] = 'Select All';
$lang['Unselect_all'] = 'Unselect All';
$lang['Date'] = 'Date';
$lang['See_topic'] = 'See the post';
$lang['Log_delete'] = 'Log deleted successfully.';
$lang['Click_return_admin_log'] = 'Click %sHere%s to return to the Log Actions';
$lang['Log_Config_updated'] = 'Configuration of Log Actions MOD successfull';
$lang['Click_return_admin_log_config'] = 'Click %sHere%s to return to the Log Actions MOD Configuration';
$lang['Log_Config'] = 'Configuration of the Log';
$lang['Log_Config_explain'] = 'Here, you will be able to configure some options of the Log Actions MOD.';
$lang['General_Config_Log'] = 'General Configuration of Log Actions MOD';
$lang['Allow_all_admin'] = 'Allow other Admins to see the Log Actions ?';
$lang['Allow_all_admin_explain'] = 'This option will allow you to choose if only the first admin of the board will be able to see the Log';
$lang['Admin_not_authorized'] = 'Sorry, you\'re not allowed to view this page. Only the main Admin has permission.';
$lang['Add_username_admin_explain'] = 'Choose the name of another Admin that you want to allow to see the logged actions';
$lang['Delete_username_admin_explain'] = 'Choose the name of another Admin that you don\'t want to allow to see the logged actions';
$lang['No_other_admins'] = 'No other Admins to choose';
$lang['No_admins_authorized'] = 'No other Admins authorized';
$lang['Add_Admin_Username'] = 'Choose an username to add';
$lang['Delete_Admin_Username'] = 'Choose an username to delete';
$lang['No_admins_allow'] = 'There are no admins to allow to view the logs';
$lang['No_admins_disallow'] = 'There are no admins to disallow to view the logs';
$lang['Admins_add_success'] = 'Admin have been added to the list successfully';
$lang['Admins_del_success'] = 'Admin(s) have been deleted from the list successfully';
$lang['Prune_success'] = 'Prune of the Logs successfull';
$lang['Prune_of_logs'] = 'Prune of the Logs';
$lang['Prune'] = 'Prune Logs';
$lang['Prune_!'] = 'Prune !';
$lang['Prune_explain'] = 'Enter the number of days that you want to prune the logs. 0 = all the logs';
/*****************************************************/
/* Forum - Log Actions v.1.1.6                   END */
/*****************************************************/
//
// Version Check
//
$lang['Version_up_to_date'] = 'Your installation is up to date, no updates are available for your version of Platinum.';
$lang['Version_not_up_to_date'] = 'Your installation does <strong>not</strong> seem to be up to date. Updates are available for your version of Platinum, please visit <a href="http://www.platinumnukepro.com" target="_new">http://www.platinumnukepro.com</a> to obtain the latest version.';
$lang['Latest_version_info'] = 'The latest available version is <strong>Platinum %s</strong>.';
$lang['Current_version_info'] = 'You are running <strong>PLatinum %s</strong>.';
$lang['Connect_socket_error'] = 'Unable to open connection to PlatinumNuke Server, reported error is:<br />%s';
$lang['Socket_functions_disabled'] = 'Unable to use socket functions.';
$lang['Mailing_list_subscribe_reminder'] = 'For the latest information on updates to PlatinumNuke, why not <a href="http://www.platinumnukepro.com/" target="_new">subscribe to our mailing list</a>.';
$lang['Version_information'] = 'Version Information';
//
// Login attempts configuration
//
$lang['Max_login_attempts'] = 'Allowed login attempts';
$lang['Max_login_attempts_explain'] = 'The number of allowed board login attempts.';
$lang['Login_reset_time'] = 'Login lock time';
$lang['Login_reset_time_explain'] = 'Time in minutes the user have to wait until he is allowed to login again after exceeding the number of allowed login attempts.';
   // Added by Attached Forums MOD
   $lang['Attached_Field_Title'] = 'Attached to forum';
   $lang['Attached_Description'] = "This field has been added by sub-forums mod.
   It will display all attachable forums (if available) in this category";
   $lang['Detach_Description'] = "Detach all forums";
   $lang['Has_attachments'] = 'This forum has other forums attached to it. If you assign new category to this forum it will move all it\'s subforums to new category unless you select detach checkbox';
   $lang['No_attach_forums'] = 'No attachable forums in this category';
   // End Added by Attached Forums MOD
//
// That's all Folks!
// -------------------------------------------------
//
// google bot detector
//
$lang['Detector'] = 'Google Bot Detector';
$lang['Detector_Explain'] = '';
$lang['Detector_ID'] = '#';
$lang['Detector_Time'] = 'Time';
$lang['Detector_Url'] = 'Url';
$lang['Detector_Clear'] = 'Clear All';
$lang['Detector_No_Bot'] = 'No Bot Detected';
$lang['Detector_Cleared'] = 'Detect Information Cleared Successfully';
$lang['Click_Return_Detector'] = 'Click %sHere%s to return to Detector';
   // Added by Attached Forums MOD
   $lang['Attached_Field_Title'] = 'Attached to forum';
   $lang['Attached_Description'] = "This field has been added by sub-forums mod.
   It will display all attachable forums (if available) in this category";
   $lang['Detach_Description'] = "Detach all forums";
   $lang['Has_attachments'] = 'This forum has other forums attached to it. If you assign new category to this forum it will move all it\'s subforums to new category unless you select detach checkbox';
   $lang['No_attach_forums'] = 'No attachable forums in this category';
   // End Added by Attached Forums MOD
//
// google bot detector
//
$lang['Detector'] = 'Google Bot Detector';
$lang['Detector_Explain'] = '';
$lang['Detector_ID'] = '#';
$lang['Detector_Time'] = 'Time';
$lang['Detector_Url'] = 'Url';
$lang['Detector_Clear'] = 'Clear All';
$lang['Detector_No_Bot'] = 'No Bot Detected';
$lang['Detector_Cleared'] = 'Detect Information Cleared Successfully';
$lang['Click_Return_Detector'] = 'Click %sHere%s to return to Detector';
$lang['Initial_user_group'] = 'Initial User Group';
$lang['Initial_user_group_explain'] = 'Sets the Inital usergroup users are put in on signup';
$lang['successfull_popup']	= 'Forums Successfully Changed.';			
$lang['close_popup'] 		= 'Close Window';
//
$lang['aacp_mod1'] = 'AACP Index';
$lang['aacp_class'] = 'Classic ACP';
$lang['aacp_who'] = 'Who is online?';
$lang['aacp_stat'] = 'Board-Statistics';
$lang['aacp_phpinfo'] = 'PHP Info';
//
$lang['aacp_header1'] = '<center><img src = "../images/genadmin.gif"></img>';
$lang['aacp_header2'] = 'Classical ACP';
$lang['aacp_header3'] = 'Who is online?';
$lang['aacp_header4'] = 'Board Statistics';
$lang['aacp_header5'] = 'PHP Info';
//
$lang['aacp_body1'] = 'Welcome into the new Advanced ACP! <br>Here you can see the new Admin-Index which provides a better management of very important Forum-Functions..';
$lang['aacp_body2'] = 'This is the classical ACP';
$lang['aacp_body3'] = 'In this page you can see who is online now. You can trace the IPs and you can view and configure the profile of a registered User, showed in this list.';
$lang['aacp_body4'] = 'Here you can see the statistic of your forum. How many memory is used, how many registered users, etc.';
$lang['aacp_body5'] = 'Here you can see infos about your WebServer Configuration. This is important for example if you ask for Support in a phpBB Support Forum.';
// Navigation
$lang['aacp_kat1'] = 'User-Management';
$lang['aacp_kat2'] = 'Configuration and Board Utilities';
$lang['aacp_kat3'] = 'Layout, Posting, and Security';
$lang['aacp_kat4'] = 'Advanced ACP';
// AACP Link
$lang['aacp_kat1_n1'] = 'Ban Control';
$lang['aacp_kat1_n2'] = 'Permissions';
$lang['aacp_kat1_n3'] = 'Edit Profiles';
$lang['aacp_kat1_n4'] = 'Manage Forum Groups';
$lang['aacp_kat1_n5'] = 'Forum Group Permissions';
$lang['aacp_kat1_n6'] = 'Advanced UserList Admin';
$lang['aacp_kat1_n7'] = 'Create Color Groups';
$lang['aacp_kat1_n8'] = 'Add Users to Color Groups';
$lang['aacp_kat2_n1'] = 'General Configuration';
$lang['aacp_kat2_n2'] = 'Manage Forums';
$lang['aacp_kat2_n3'] = 'Configure Forum Permissions';
$lang['aacp_kat2_n4'] = 'Attachment Configuration';
$lang['aacp_kat2_n5'] = 'Arcade Configuration';
$lang['aacp_kat2_n6'] = 'Set All Users Theme settings to Default';
$lang['aacp_kat2_n7'] = 'Clear all Sessions in Database';
$lang['aacp_kat3_n1'] = 'Manage Ranks';
$lang['aacp_kat3_n2'] = 'Manage Smilies';
$lang['aacp_kat3_n3'] = 'Block Proxies';
$lang['aacp_kat3_n4'] = 'Review Private Messages';
$lang['aacp_kat4_n1'] = 'Platinum MyAdmin';
$lang['aacp_kat4_n2'] = 'Who is online?';
$lang['aacp_kat4_n3'] = 'Board-Statistics';
$lang['aacp_kat4_n4'] = 'PHP Info';
$lang['aacp_kat4_n5'] = 'Download Database Backup';
//
// End: Advanced ACP
//
// Start add - Birthday MOD
$lang['Birthday_required'] = 'Force users to submit a birthday';
$lang['Enable_birthday_greeting'] = 'Enable birthday greetings';
$lang['Birthday_greeting_expain'] = 'Users who have submitted a birthday can have a birthday greeting, when thy visit the board';
$lang['Next_birthday_greeting'] = 'Next birthday popup year';
$lang['Next_birthday_greeting_expain'] = 'This field keeps track of the next year the user shall have a birthday greeting';
$lang['Wrong_next_birthday_greeting'] = 'The supplied, next birthday popup year, was not valid, please try again';
$lang['Max_user_age'] = 'Maximum user age';
$lang['Min_user_age'] = 'Minimum user age';
$lang['Birthday_lookforward'] = 'Birthday look forward';
$lang['Birthday_lookforward_explain'] = 'Number of days the script shall look forward for users with a birthday';
// End add - Birthday MOD
// Country/Location Flags
$lang['Flags'] = 'Flags';
$lang['Flags_title'] = 'Flag Administration';
$lang['Flags_explain'] = 'Using this form you can add, edit, view and delete flags. You can also create custom flags which can be applied to a user via the user management facility';
$lang['Add_new_flag'] = 'Add new flag';
$lang['Flag_name'] = 'Flag Name';
$lang['Flag_pic'] = 'Image';
$lang['Flag_image'] = 'Flag Image (in the images/flags/ directory)';
$lang['Flag_image_explain'] = 'Use this to define a small image associated with the flag';
$lang['Must_select_flag'] = 'You must select a flag';
$lang['Flag_updated'] = 'The flag was successfully updated';
$lang['Flag_added'] = 'The flag was successfully added';
$lang['Flag_removed'] = 'The flag was successfully deleted';
$lang['No_update_flags'] = 'The flag was successfully deleted. However, user accounts using this flag were not updated.  You will need to manually reset the flag on these accounts';
$lang['Flag_confirm'] = 'Delete Flag';
$lang['Confirm_delete_flag'] = 'Are you sure you want to remove the selected flag?';
$lang['Click_return_flagadmin'] = 'Click %sHere%s to return to Flag Administration';
?>
