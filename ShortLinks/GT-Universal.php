<?php

$request = $_SERVER['REQUEST_URI'];

$requestin = array(
"'modules.php\?name=Universal&op=ViewItems&vid=([0-9]*)&viewed=1'",
"'modules.php\?name=Universal&op=ViewItems&vid=([0-9]*)'",
"'modules.php\?name=Universal$'"
);

$requestout = array(
"universal-viewed-id\\1.html",
"universal-viewid\\1.html",
"universal.html"
);
     if (! eregi("\.html", $request)) {
     $newrequest = preg_replace($requestin, $requestout, $request);
          if (eregi("\.html", $newrequest)) {
          Header("Location: $newrequest");
          }
     }

$urlin = array(
"'(?<!/)modules.php\?name=Universal&amp;op=CatIndex&amp;cid=([0-9]*)&amp;sortletter=([A-Z0-9]*)&amp;orderby=([a-zA-Z]*)&amp;page=([0-9]*)'",
"'(?<!/)modules.php\?name=Universal&amp;op=CatIndex&amp;cid=([0-9]*)&amp;orderby=([a-zA-Z]*)&amp;sortletter=([A-Z0-9]*)'",
"'(?<!/)modules.php\?name=Universal&amp;op=CatIndex&amp;cid=([0-9]*)&amp;orderby=([a-zA-Z]*)&amp;page=([0-9]*)'",
"'(?<!/)modules.php\?name=Universal&amp;op=CatIndex&amp;cid=([0-9]*)&amp;orderby=([a-zA-Z]*)'",
"'(?<!/)modules.php\?name=Universal&amp;op=CatIndex&amp;cid=([0-9]*)'",
"'(?<!/)modules.php\?name=Universal&amp;op=ViewItems&amp;vid=([0-9]*)&amp;viewed=1&amp;page=([0-9]*)'",
"'(?<!/)modules.php\?name=Universal&amp;op=ViewItems&amp;vid=([0-9]*)&amp;viewed=1'",
"'(?<!/)modules.php\?name=Universal&amp;op=ViewItems&amp;vid=([0-9]*)'",
"'(?<!/)modules.php\?name=Universal&amp;file=friend&amp;op=mailsent&amp;fname=([a-zA-Z0-9_]*)&amp;femail=([a-zA-Z0-9_\@\.\-]*)'",
"'(?<!/)modules.php\?name=Universal&amp;file=friend&amp;op=FriendSend&amp;sid=([0-9]*)'",
"'(?<!/)modules.php\?name=Universal&amp;op=MostWanted&amp;amp=page=([0-9]*)'",
"'(?<!/)modules.php\?name=Universal&amp;file=add&amp;op=request'",
"'(?<!/)modules.php\?name=Universal&amp;file=print&amp;sid=([0-9]*)'",
"'(?<!/)modules.php\?name=Universal&amp;file=modify&amp;id=([0-9]*)'",
"'(?<!/)modules.php\?name=Universal&amp;(op|file)=(search|TopRated|Random|MostWanted|add|friend|comments|modify)'",
"'(?<!/)(\"|\')modules.php\?name=Universal\\1'",
"'(?<!/)modules.php\?name=Your_Account&amp;op=userinfo&amp;username=([a-zA-Z0-9_]*)'",
"'(?<!/)modules.php\?name=Your_Account'",
);

$urlout = array(
"universal-id\\1-sort-\\2-\\3-page\\4.html",
"universal-id\\1-order-\\2-\\3.html",
"universal-id\\1-order-\\2-page-\\3.html",
"universal-id\\1-order-\\2.html",
"universal-id\\1.html",
"universal-viewid\\1-page\\2.html",
"universal-viewed-\\1.html",
"universal-viewid\\1.html",
"universal-friend-\\1-\\2.html",
"universal-friend-\\1.html",
"universal-MostWanted-\\1.html",
"universal-add.html",
"universal-print-id\\1.html",
"universal-modify-id\\1.html",
"universal-\\1-\\2.html",
"\\1universal.html\\1",
"userinfo-\\1.html",
"account.html",
);

?>