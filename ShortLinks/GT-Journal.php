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
'"(?<!/)modules.php\?name=Journal&amp;file=search&amp;bywhat=aid&amp;exact=1&amp;forwhat=([a-zA-Z0-9]*)"',
'"(?<!/)modules.php\?name=Journal&amp;file=(search|delete|commentkill)&amp;(bywhat|jid|onwhat)=([a-zA-Z0-9]*)&amp;(forwhat|ref)=([a-zA-Z0-9]*)"',
'"(?<!/)modules.php\?name=Journal&amp;file=([a-zA-Z0-9+]*)&amp;(jid|onwhat|disp|op|disp)=([a-zA-Z0-9+]*)"',
'"(?<!/)modules.php\?name=Journal&amp;(file|op)=([a-zA-Z0-9]*)"',
'"(?<!/)modules.php\?name=Journal"',
'"(?<!/)modules.php\?name=Your_Account&amp;op=userinfo&amp;username=([a-zA-Z0-9_-]*)"',
'"(?<!/)modules.php\?name=Your_Account&amp;op=([a-z]*)"',
'"(?<!/)modules.php\?name=Your_Account"'
);

$urlout = array(
'journal-search-\\1.html',
'journal\\1-\\2\\3-\\4\\5.html',
'journal-\\1-\\2-\\3.html',
'journal\\1-\\2.html',
'journal.html',
'userinfo-\\1.html',
'account-\\1.html',
'account.html'
);

?>