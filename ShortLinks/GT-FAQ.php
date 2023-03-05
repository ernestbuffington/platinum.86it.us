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
'"(?<!/)modules.php\?name=FAQ&amp;myfaq=yes&amp;id_cat=([0-9]*)&amp;categories=([a-zA-Z0-9\.\+\&\-\/\;% ]*)"',
'"(?<!/)modules.php\?name=FAQ"'
);

$urlout = array(
'faq-\\1-\\2.html',
'faq.html'
);

?>