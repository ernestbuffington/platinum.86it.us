<?php
/******************************************************************************
* Script:     TegoNuke(tm) ShortLinks "Block Tap" for the HTML Newsletter 
*             block version 1.3.x.
* Version:    1.0
* Author:     Rob Herder (aka: montego) of http://montegoscripts.com
* Contact:    montego@montegoscripts.com
* Copyright:  Copyright © 2006 by Montego Scripts
* License:    GNU/GPL (see provided LICENSE.txt file)
******************************************************************************/

$urlin = array(
'"(?<!/)modules.php\?name=HTML_Newsletter&amp;op=msnl_nls_view&amp;msnl_nid=([0-9]*)"',
'"(?<!/)modules.php\?name=HTML_Newsletter"'
);

$urlout = array(
'html_newsletter-\\1.html',
'html_newsletter.html'
);

?>