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
'"(?<!/)modules.php\?name=News&amp;file=article&amp;sid=([0-9]*)"',
'"(?<!/)modules.php\?name=News&amp;file=categories&amp;op=newindex&amp;catid=([0-9]*)"',
'"(?<!/)modules.php\?name=Sections&amp;op=viewarticle&amp;artid=([0-9]*)"',
'"(?<!/)modules.php\?name=Your_Account&amp;op=userinfo&amp;username=([a-zA-Z0-9_-]*)"',
'"(?<!/)modules.php\?name=Surveys&amp;pollID=([0-9]*)"',
'"(?<!/)modules.php\?name=Search&amp;query=([a-zA-Z0-9_-]*)&amp;author=([a-zA-Z0-9_-]*)"',
'"(?<!/)modules.php\?name=Reviews&amp;rop=showcontent&amp;id=([0-9]*)"',
'"(?<!/)modules.php\?name=Downloads&amp;d_op=viewdownloaddetails&amp;lid=([0-9]*)&amp;ttitle=([/:\-\'{}()._&amp;a-zA-Z0-9+= ]*)"',
'"(?<!/)modules.php\?name=Content&amp;pa=showpage&amp;pid=([0-9]*)"',
'"(?<!/)modules.php\?name=Top&amp;zx=([a-zA-Z0-9+]*)"',
'"(?<!/)modules.php\?name=Top"'
);

$urlout = array(
'article\\1.html',
'article-category-\\1.html',
'sections-viewarticle-\\1.html',
'userinfo-\\1.html',
'survey-\\1.html',
'search-\\1-\\2.html',
'reviews-\\1.html',
'downloadview-details-\\1-\\2.html',
'content-\\1.html',
'top-\\1.html',
'top.html'
);

?>