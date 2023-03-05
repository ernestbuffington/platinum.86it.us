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
'"(?<!/)modules.php\?name=Your_Account&amp;op=userinfo&amp;username=([a-zA-Z0-9_-]*)"',
'"(?<!/)modules.php\?name=Your_Account&amp;op=avatarsave&amp;category=([a-z]*)&amp;avatar=([\.0-9a-z]*)"',
'"(?<!/)modules.php\?name=Your_Account&amp;op=([a-z_]*)"',
'"(?<!/)\?gfx=gfx&amp;random_num=([0-9]*)"',
'"(?<!/)modules.php\?name=Your_Account"',
'"(?<!/)modules.php\?name=Journal&amp;file=search&amp;bywhat=([0-9]*)&amp;forwhat=([a-zA-Z0-9_-]*)"',
'"(?<!/)modules.php\?name=Journal&amp;file=edit"',
'"(?<!/)modules.php\?name=Members_List"',
'"(?<!/)modules.php\?name=News&amp;file=article&amp;sid=([0-9]*)"',
'"(?<!/)modules.php\?name=News&amp;file=article&amp;thold=([0-9-]*)&amp;mode=([a-z]*)&amp;order=([0-9]*)&amp;sid=([0-9]*)([0-9#]*)"',
'"(?<!/)modules.php\?name=Private_Messages&amp;mode=post&amp;u=([0-9]*)"',
'"(?<!/)modules.php\?name=Private_Messages"',
'"(?<!/)modules.php\?name=Search&amp;type=users"',
'"(?<!/)modules.php\?name=WebMail"'
);

$urlout = array(
'userinfo-\\1.html',
'account-avatarsave-\\1-\\2.html',
'account-\\1.html',
'account-gfx-\\1.html',
'account.html',
'journal-search-\\1-\\2.html',
'journal-edit.html',
'members.html',
'article\\1.html',
'article-\\1-\\2-\\3-\\4.html\\5',
'messages-post-\\1.html',
'messages.html',
'search-users.html',
'webmail.html'
);

?>