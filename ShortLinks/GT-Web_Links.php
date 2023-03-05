<?php
/************************************************************************
* Script:     TegoNuke(tm) ShortLinks
* Version:    1.0.1
* Author:     Rob Herder (aka: montego) of http://montegoscripts.com
* Contact:    montego@montegoscripts.com
* Copyright:  Copyright © 2006-2007 by Montego Scripts
* License:    GNU/GPL (see provided LICENSE.txt file)
* Comments:   1.0.1 - ttitle was removed from RN2.10.01.
************************************************************************/
//GT-NExtGEn 0.4/0.5 by Bill Murrin (Audioslaved) http://gt.audioslaved.com (c) 2004
//Original Nukecops GoogleTap done by NukeCops (http://www.nukecops.com)

$urlin = array(
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=viewlinkcomments&amp;lid=([0-9]+)&amp;ttitle=([/:\-\'(){}.+&amp;=_a-zA-Z0-9 ]*)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=viewlinkcomments&amp;lid=([0-9]+)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=viewlinkdetails&amp;lid=([0-9]+)&amp;ttitle=([/:\-\'(){}.&amp;=_a-zA-Z0-9 ]*)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=viewlinkdetails&amp;lid=([0-9]+)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=viewlinkeditorial&amp;lid=([0-9]+)&amp;ttitle=([/:\-\'(){}.&amp;=_a-zA-Z0-9 ]*)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=viewlinkeditorial&amp;lid=([0-9]+)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=modifylinkrequest&amp;lid=([0-9]+)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=brokenlink&amp;lid=([0-9]+)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=outsidelinksetup&amp;lid=([0-9]+)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=(MostPopular|TopRated)&amp;ratenum=([0-9]+)&amp;ratetype=(num|percent)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=NewLinks&amp;newlinkshowdays=([0-9]+)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=NewLinksDate&amp;selectdate=([0-9]+)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=(AddLink|MostPopular|NewLinks|RandomLink|TopRated)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=ratelink&amp;lid=([0-9]*)&amp;ttitle=([/:\-\'\,(){}.&amp;=_a-zA-Z0-9 ]*)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=ratelink&amp;lid=([0-9]*)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=visit&amp;lid=([0-9]*)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=viewlink&amp;cid=([0-9]*)&amp;orderby=([a-zA-Z0-9]*)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=viewlink&amp;cid=([0-9]*)&amp;min=([0-9]*)&amp;orderby=([a-zA-Z0-9]*)&amp;show=([0-9]*)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=viewlink&amp;cid=([0-9]*)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=search&amp;query=([a-zA-Z0-9]*)&amp;min=([0-9]*)&amp;orderby=([a-zA-Z]*)&amp;show=([0-9]*)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=search&amp;query=([a-zA-Z0-9]*)&amp;orderby=([a-zA-Z]*)"',
'"(?<!/)modules.php\?name=Web_Links&amp;l_op=search&amp;query=([a-zA-Z0-9]*)"',
'"(?<!/)modules.php\?name=Web_Links"'
);

$urlout = array(
'viewlinkcomments-\\1-\\2.html',
'viewlinkcomments-\\1.html',
'viewlinkdetails-\\1-\\2.html',
'viewlinkdetails-\\1.html',
'vieweditorial-\\1-\\2.html',
'vieweditorial-\\1.html',
'modifylink-\\1.html',
'brokenlink-\\1.html',
'outsidelink-\\1.html',
'linkop-\\1-\\2-\\3.html',
'newlinks-\\1.html',
'linksnew-\\1.html',
'linkop-\\1.html',
'ratelink-\\1-\\2.html',
'ratelink-\\1.html',
'viewlink-\\1.html',
'links-\\1-\\2.html',
'links-\\1-\\2-\\3-\\4.html',
'link-\\1.html',
'links-search-\\1-\\2-orderby-\\3-\\4.html',
'links-search-\\1-orderby-\\2.html',
'links-search-\\1.html',
'links.html'
);

?>