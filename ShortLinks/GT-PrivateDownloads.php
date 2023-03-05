<?php
/******************************************************************************
* Script:     TegoNuke(tm) ShortLinks "Tap" for NSN GR Downloads v1.0.3pl1
*             from http://www.nukescripts.net.
* Version:    1.0
* Author:     Rob Herder (aka: montego) of http://montegoscripts.com
* Contact:    montego@montegoscripts.com
* Copyright:  Copyright © 2006 by Montego Scripts
* License:    GNU/GPL (see provided LICENSE.txt file)
******************************************************************************/

$urlin = array(
'"(?<!/)modules.php\?name=PrivateDownloads&amp;op=modifydownloadrequest&amp;lid=([0-9]*)"',
'"(?<!/)modules.php\?name=PrivateDownloads&amp;op=NewDownloads&amp;newdownloadshowdays=([0-9]*)"',
'"(?<!/)modules.php\?name=PrivateDownloads&amp;op=NewDownloadsDate&amp;selectdate=([a-zA-Z0-9+]*)"',
'"(?<!/)modules.php\?name=PrivateDownloads&amp;op=getit&amp;lid=([0-9]*)"',
'"(?<!/)modules.php\?name=PrivateDownloads&amp;op=(MostPopular)&amp;ratenum=([0-9]*)&amp;ratetype=(num|percent)"',
'"(?<!/)modules.php\?name=PrivateDownloads&amp;op=(NewDownloads|MostPopular)"',
'"(?<!/)modules.php\?name=PrivateDownloads&amp;cid=([0-9]*)&amp;orderby=([a-zA-Z0-9+]*)"',
'"(?<!/)modules.php\?name=PrivateDownloads&amp;min=([0-9]*)&amp;cid=([0-9]*))"',   //Must make code chg to work!
'"(?<!/)modules.php\?name=PrivateDownloads&amp;op=search&amp;query=([/:\-\'{}()\,\._&amp;a-zA-Z0-9+=]*)&amp;min=([0-9]*)&amp;orderby=([a-zA-Z0-9+]*)&amp;show=([0-9]*)"',  //Must make code chg to work!
'"(?<!/)modules.php\?name=PrivateDownloads&amp;op=search&amp;query=([/:\-\'{}()\,\._&amp;a-zA-Z0-9+= ]*)&amp;orderby=([a-zA-Z0-9+]*)"',    //Must make code chg to work!
'"(?<!/)modules.php\?name=PrivateDownloads&amp;op=search"',    //Must make code chg to work!
'"(?<!/)modules.php\?name=PrivateDownloads&amp;op=gfx&amp;random_num=([0-9]*)"',
'"(?<!/)modules.php\?name=PrivateDownloads&amp;cid=([0-9]*)"',
'"(?<!/)modules.php\?name=PrivateDownloads"'
);

$urlout = array(
'privatedownload-mod-\\1.html',
'privatedownload-shownew-\\1.html',
'privatedownload-seldate-\\1.html',
'privatedownload-file-\\1.html',
'privatedownload-\\1-\\2-\\3.html',
'privatedownloads-\\1.html',
'privatedownload-sort-\\1-orderby-\\2.html',
'privatedownload-paging-\\1-\\2.html', //Must make code chg to work!
'privatedownload-search-\\1-\\2-\\3-\\4.html', //Must make code chg to work!
'privatedownload-search-\\1-\\2.html', //Must make code chg to work!
'privatedownload-search.html', //Must make code chg to work!
'privatedownload-gfx-\\1.html',
'privatedownloads-cat\\1.html',
'privatedownloads.html'
);

?>
