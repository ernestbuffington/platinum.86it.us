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
'"(?<!/)modules.php\?name=Reviews&amp;rop=write_review"',
'"(?<!/)modules.php\?name=Reviews&amp;rop=preview_review"',
'"(?<!/)modules.php\?name=Reviews&amp;rop=showcontent&amp;id=([0-9]*)&amp;page=([0-9]*)"',
'"(?<!/)modules.php\?name=Reviews&amp;rop=showcontent&amp;id=([0-9]*)"',
'"(?<!/)modules.php\?name=Reviews&amp;rop=postcomment&amp;id=([0-9]*)&amp;title=([/:\-\'{}()\._&amp;a-zA-Z0-9+=\?\% ]*)"',
'"(?<!/)modules.php\?name=Reviews&amp;rop=del_review&amp;id_del=([0-9]*)"',
'"(?<!/)modules.php\?name=Reviews&amp;rop=mod_review&amp;id=([0-9]*)"',
'"(?<!/)modules.php\?name=Reviews&amp;rop=del_comment&amp;cid=([0-9]*)&amp;id=([0-9]*)"',
'"(?<!/)modules.php\?name=Reviews&amp;rop=([a-zA-Z0-9]*)&amp;field=([a-z]*)&amp;order=([a-zA-Z]*)"',
'"(?<!/)modules.php\?name=Reviews&amp;rop=([a-zA-Z0-9]*)"',
'"(?<!/)modules.php\?name=Reviews"'
);

$urlout = array(
'reviews-new.html',
'reviews-preview.html',
'reviews-\\1-page\\2.html',
'reviews-\\1.html',
'reviews-comment-\\1-\\2.html',
'reviews-\\1-delete.html',
'reviews-\\1-edit.html',
'reviews-\\1-delcomment-\\2.html',
'reviews-\\1-orderby-\\2-\\3.html',
'reviews-sortby-\\1.html',
'reviews.html'
);

?>