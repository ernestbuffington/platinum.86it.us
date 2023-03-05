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

<?php

$urlin = array(
'"(?<!/)modules.php\?name=Sections&amp;op=viewarticle&amp;artid=([0-9]*)&amp;page=([0-9]*)"',
'"(?<!/)modules.php\?name=Sections&amp;op=(printpage|viewarticle)&amp;artid=([0-9]*)"',
'"(?<!/)modules.php\?name=Sections&amp;op=listarticles&amp;secid=([0-9]*)"',
'"(?<!/)modules.php\?name=Sections"'
);

$urlout = array(
'sections-viewarticle\\1-page\\2.html',
'sections-\\1-\\2.html',
'sections-listarticles-\\1.html',
'sections.html'
);

?>