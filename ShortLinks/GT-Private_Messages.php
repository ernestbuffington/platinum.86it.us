<?php
/************************************************************************
* Script:     TegoNuke(tm) ShortLinks
* Version:    1.0
* Author:     Rob Herder (aka: montego) of http://montegoscripts.com
* Contact:    montego@montegoscripts.com
* Copyright:  Copyright © 2006 by Montego Scripts
* License:    GNU/GPL (see provided LICENSE.txt file)
************************************************************************/
//GT-NExtGEn 0.4/0.5 by Bill Murrin (Audioslaved) http://gt.audioslaved.com (c) 2004
//Original Nukecops GoogleTap done by NukeCops (http://www.nukecops.com)

$urlin = array(
'"(?<!/)modules.php\?name=Forums&amp;file=profile&amp;mode=editprofile"',
'"(?<!/)modules.php\?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=([0-9]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=([^index][a-zA-Z0-9_-]*)((\")|(&amp;sid=[a-zA-Z0-9]*))"',
'"(?<!/)modules.php\?name=Forums&amp;file=index((\")|(&amp;sid=[a-zA-Z0-9]*))"',
'"(?<!/)modules.php\?name=Forums(?!&)"',
'"(?<!/)modules.php\?name=Private_Messages&amp;file=index&amp;folder=(savebox|inbox|outbox|sentbox)((\")|(&amp;sid=[a-zA-Z0-9]*))"',
'"(?<!/)modules.php\?name=Private_Messages&amp;file=index&amp;folder=(savebox|inbox|outbox|sentbox)&amp;mode=read&amp;p=([0-9]*)((\")|(&amp;sid=[a-zA-Z0-9]*))"',
'"(?<!/)modules.php\?name=Private_Messages&amp;file=index&amp;folder=(savebox|inbox|outbox|sentbox)&amp;start=([0-9]*)((\")|(&amp;sid=[a-zA-Z0-9]*))"',
'"(?<!/)modules.php\?name=Private_Messages&amp;file=index&amp;mode=(reply|quote)&amp;p=([0-9]*)((\")|(&amp;sid=[a-zA-Z0-9]*))"',
'"(?<!/)modules.php\?name=Private_Messages&amp;file=index&amp;mode=post&amp;u=([0-9]*)"',
'"(?<!/)modules.php\?name=Private_Messages&amp;file=index&amp;mode=post"',
'"(?<!/)modules.php\?name=Private_Messages&amp;mode=post&amp;u=([0-9]*)"',
'"(?<!/)modules.php\?name=Private_Messages((\")|(&amp;sid=[a-zA-Z0-9]*))"',
'"(?<!/)modules.php\?name=Members_List((\")|(&amp;sid=[a-zA-Z0-9]*))"',
'"(?<!/)modules.php\?name=Your_Account&amp;op=([a-z]*)"',
'"(?<!/)modules.php\?name=Your_Account"',
'"(?<!/)modules.php\?name=Journal&amp;file=edit"',
'"(?<!/)modules.php\?name=WebMail"',
'"(?<!/)modules.php?name=Forums&file=modules&name=Forums&file=report"'
);

$urlout = array(
'forum-editprofile.html',
'forum-userprofile-\\1.html',
'forums-\\1.html\\2',
'forums.html\\1',
'forums.html',
'messages-\\1.html\\2',
'messages-read-\\1-\\2.html\\3',
'messages-start-\\1-\\2.html\\3',
'messages-\\1-\\2.html\\3',
'messages-post-\\1.html',
'messages-new.html',
'messages-post-\\1.html',
'messages.html\\1',
'members.html\\1',
'account-\\1.html',
'account.html',
'journal-edit.html',
'webmail.html',
'reports.html',
);

?>
