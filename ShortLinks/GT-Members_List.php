<?php
/************************************************************************
* Script:     TegoNuke(tm) ShortLinks
* Version:    1.0.1
* Author:     Rob Herder (aka: montego) of http://montegoscripts.com
* Contact:    montego@montegoscripts.com
* Copyright:  Copyright © 2006-2007 by Montego Scripts
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
'"(?<!/)modules.php\?name=Members_List&amp;file=index((\")|(&amp;sid=[a-zA-Z0-9]*))"',
'"(?<!/)modules.php\?name=Private_Messages&amp;file=index&amp;folder=(savebox|inbox|outbox|sentbox)((\")|(&amp;sid=[a-zA-Z0-9]*))"',
'"(?<!/)modules.php\?name=Private_Messages&amp;file=index&amp;mode=newpm&amp;popup=1"',
'"(?<!/)modules.php\?name=Private_Messages&amp;file=index&amp;mode=post&amp;u=([0-9]*)"',
);

$urlout = array(
'forum-editprofile.html',
'forum-userprofile-\\1.html',
'forums-\\1.html\\2',
'forums.html\\1',
'forums.html',
'members.html\\1',
'messages-\\1.html\\2',
'messages-popup.html',
'messages-post-\\1.html',
);

?>