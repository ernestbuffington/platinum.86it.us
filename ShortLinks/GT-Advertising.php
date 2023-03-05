<?php
/************************************************************************
* Script:     TegoNuke(tm) ShortLinks
* Version:    1.0.2
* Author:     Rob Herder (aka: montego) of http://montegoscripts.com
* Contact:    montego@montegoscripts.com
* Copyright:  Copyright © 2006 by Montego Scripts
* License:    GNU/GPL (see provided LICENSE.txt file)
************************************************************************/

$urlin = array(
'"(?<!/)modules.php\?name=Advertising&amp;op=(client_report|view_banner)&amp;cid=([0-9]*)&amp;bid=([0-9]*)"',
'"(?<!/)modules.php\?name=Advertising&amp;op=(sitestats|terms|plans|client_home|client_logout|client|logout)"',
'"(?<!/)modules.php\?name=Advertising"'
);

$urlout = array(
'advertising-\\1-\\2-\\3.html',
'advertising-\\1.html',
'advertising.html'
);

?>