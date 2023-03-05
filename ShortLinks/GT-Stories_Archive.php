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
'"(?<!/)modules.php\?name=News&amp;file=article&amp;sid=([0-9]*)&amp;mode=([a-z]*)&amp;order=([0-9]*)&amp;thold=([0-9]*)"',
'"(?<!/)modules.php\?name=News&amp;file=categories&amp;op=newindex&amp;catid=([0-9]*)"',
'"(?<!/)modules.php\?name=News&amp;file=article&amp;op=newindex&amp;catid=([0-9]*)"',
'"(?<!/)modules.php\?name=News&amp;file=article&amp;sid=([0-9]*)"',
'"(?<!/)modules.php\?name=News&amp;file=print&amp;sid=([0-9]*)"',
'"(?<!/)modules.php\?name=News&amp;file=friend&amp;op=FriendSend&amp;sid=([0-9]*)"',
'"(?<!/)modules.php\?name=Stories_Archive&amp;sa=show_all"',
'"(?<!/)modules.php\?name=Stories_Archive&amp;sa=show_month&amp;year=([0-9]*)&amp;month=([0-9]*)&amp;month_l=([a-zA-Z]*)"',
'"(?<!/)modules.php\?name=Stories_Archive"'
);

$urlout = array(
'article-\\1-\\2-\\3-\\4.html',
'article-category-\\1.html',
'article-cat-\\1.html',
'article\\1.html',
'article-print-\\1.html',
'article-friend-\\1.html',
'archive-showall.html',
'archive-\\1-\\2-\\3.html',
'archive.html'
);

?>