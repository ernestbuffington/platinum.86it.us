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
'"(?<!/)modules.php\?name=Content&amp;pa=showpage&amp;pid=([0-9]*)&amp;page=([0-9]*)"',
'"(?<!/)modules.php\?name=Content&amp;pa=list_pages_categories&amp;cid=([0-9]*)"',
'"(?<!/)modules.php\?name=Content&amp;pa=showpage&amp;pid=([0-9]*)"',
'"(?<!/)modules.php\?name=Content"'
);

$urlout = array(
'content-\\1-page\\2.html',
'content-cat-\\1.html',
'content-\\1.html',
'content.html'
);

?>