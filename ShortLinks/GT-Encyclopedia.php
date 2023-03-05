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
'"(?<!/)modules.php\?name=Encyclopedia&amp;op=content&amp;tid=([0-9]*)&amp;page=([0-9]*)&amp;query=([a-zA-Z0-9_-]*)"',
'"(?<!/)modules.php\?name=Encyclopedia&amp;op=content&amp;tid=([0-9]*)&amp;page=([0-9]*)"',
'"(?<!/)modules.php\?name=Encyclopedia&amp;op=content&amp;tid=([0-9]*)&amp;query=([a-zA-Z0-9_-]*)"',
'"(?<!/)modules.php\?name=Encyclopedia&amp;op=content&amp;tid=([0-9]*)"',
'"(?<!/)modules.php\?name=Encyclopedia&amp;op=list_content&amp;eid=([0-9]*)"',
'"(?<!/)modules.php\?name=Encyclopedia&amp;op=terms&amp;eid=([0-9]*)&amp;ltr=([A-Z]*)"',
'"(?<!/)modules.php\?name=Encyclopedia&amp;file=search&amp;query=([a-zA-Z0-9_-]*)"',
'"(?<!/)modules.php\?name=Encyclopedia&amp;file=search"',
'"(?<!/)modules.php\?name=Encyclopedia"'
);

$urlout = array(
'encyclopedia-\\1-page\\2-\\3.html',
'encyclopedia-\\1-page\\2.html',
'encyclopedia-\\1-\\2.html',
'encyclopedia-\\1.html',
'encyclopedia-list-\\1.html',
'encyclopedia-terms\\1-\\2.html',
'encyclopedia-search-\\1.html',
'encyclopedia-search.html',
'encyclopedia.html'
);

?>