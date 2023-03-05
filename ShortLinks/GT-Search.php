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
'"(?<!/)modules.php\?name=Search&amp;author=([a-zA-Z0-9]*)&amp;topic=([0-9]*)&amp;min=([0-9]*)&amp;query=([a-zA-Z0-9]*)&amp;type=([a-zA-Z]*)&amp;category=([0-9]*)"',
'"(?<!/)modules.php\?name=Search&amp;author=([a-zA-Z0-9]*)&amp;topic=([0-9]*)&amp;min=([0-9]*)&amp;query=([a-zA-Z0-9]*)&amp;type=([a-zA-Z]*)"',
'"(?<!/)modules.php\?name=Search&amp;query=([a-zA-Z0-9]*)&amp;author=([a-zA-Z0-9]*)"',
'"(?<!/)modules.php\?name=Search&amp;query=&amp;topic=([0-9]*)"',
'"(?<!/)modules.php\?name=Search&amp;type=users"',
'"(?<!/)modules.php\?name=Search&amp;type=comments&amp;sid=([0-9]*)"',
'"(?<!/)modules.php\?name=Search"',
'"(?<!/)modules.php\?name=Downloads&amp;d_op=search&amp;query=([a-zA-Z0-9_-]*)"',
'"(?<!/)modules.php\?name=Encyclopedia&amp;file=search&amp;query=([a-zA-Z0-9_-]*)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=search&amp;query=([a-zA-Z0-9_-]*)"',
'"(?<!/)modules.php\?name=News&amp;file=article&amp;sid=([0-9-]*)"',
'"(?<!/)modules.php\?name=News&amp;file=article&amp;thold=([0-9-]*)&amp;mode=([a-z]*)&amp;order=([0-9]*)&amp;sid=([0-9]*)([0-9#]*)"',
'"(?<!/)modules.php\?name=Your_Account&amp;op=userinfo&amp;username=([a-zA-Z0-9]*)"',
'"(?<!/)modules.php\?name=Reviews&amp;op=showcontent&amp;id=([0-9]*)"',
'"(?<!/)modules.php\?name=Reviews&amp;op=mod_review&amp;id=([0-9]*)"',
'"(?<!/)modules.php\?name=Reviews.php&amp;op=del_review&amp;id_del=([0-9]*)"'
);

$urlout = array(
'search-\\1-\\2-\\3-\\4-\\5-\\6.html',
'search-\\1-\\2-\\3-\\4-\\5.html',
'search-\\1-\\2.html',
'search-\\1.html',
'search-users.html',
'search-comments-\\1.html',
'search.html',
'download-search-\\1.html',
'encyclopedia-search-\\1.html',
'links-search-\\1.html',
'article\\1.html',
'article-\\1-\\2-\\3-\\4.html\\5',
'userinfo-\\1.html',
'reviews-\\1.html',
'reviews-\\1-edit.html',
'reviews-\\1-delete.html'
);

?>