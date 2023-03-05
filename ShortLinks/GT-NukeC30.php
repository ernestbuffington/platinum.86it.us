<?php

if (stristr($_SERVER['SCRIPT_NAME'], "GT-NukeC30.php")) {
    Header("Location: ../index.html");
    die();
}

$urlin = array(
"'(?<!/)modules.php\?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=([0-9]*)'",
"'(?<!/)modules.php\?name=Your_Account&amp;op=logout'",
"'(?<!/)modules.php\?name=Your_Account'",
"'(?<!/)modules.php\?name=Private_Messages&amp;file=index&amp;mode=post&amp;u=([0-9]*)'",
"'(?<!/)modules.php\?name=Private_Messages&amp;file=reply&amp;send=1&amp;uname=([a-zA-Z0-9]*)'",
"'(?<!/)modules.php\?name=Private_Messages\"'",
"'(?<!/)modules.php\?name=NukeC30&amp;file=friend&amp;id=([0-9]*)'",
"'(?<!/)modules.php\?name=NukeC30&amp;file=adsbox&amp;op=SaveAds&amp;id_ads=([0-9]*)'",
"'(?<!/)modules.php\?name=NukeC30&amp;file=adsbox&amp;op=editposted&amp;id=([0-9]*)'",
"'(?<!/)modules.php\?name=NukeC30&amp;file=adsbox&amp;op=deleteads&amp;id=([0-9]*)'",
"'(?<!/)modules.php\?name=NukeC30&amp;file=contact&amp;id=([0-9]*)'",
"'(?<!/)modules.php\?name=NukeC30&amp;op=Disclaimer&amp;no=([0-9]*)'",
"'(?<!/)modules.php\?name=NukeC30&amp;op=ViewAds&amp;id_catg=([0-9]*)'",
"'(?<!/)modules.php\?name=NukeC30&amp;op=ViewCatg&amp;id_catg=([0-9]*)'",
"'(?<!/)modules.php\?name=NukeC30&amp;op=ViewDetail&amp;id_ads=([0-9]*)'",
"'(?<!/)modules.php\?name=NukeC30&amp;op=SubmitComment'",
"'(?<!/)modules.php\?name=NukeC30&amp;op=viewads\"'",
"'(?<!/)modules.php\?name=NukeC30&amp;op=mostpop'",
"'(?<!/)modules.php\?name=NukeC30&amp;file=search'",
"'(?<!/)modules.php\?name=NukeC30&amp;file=adsbox'",
"'(?<!/)modules.php\?name=NukeC30&amp;file=postads'",
"'(?<!/)modules.php\?name=NukeC30'"
);

$urlout = array(
"forum-userprofile-\\1.html",
"account-logout.html",
"account.html",
"messages-post-\\1.html",
"messages-post-\\1.html",
"messages.html\"",
"send-ad-\\1.html",
"save-ad-\\1.html",
"edit-ad-\\1.html",
"delete-ad-\\1.html",
"email-member-ad-\\1.html",
"adverts-disclaimer-\\1.html",
"advert-view-ads-\\1.html",
"advert-view-category-\\1.html",
"advert-view-details-\\1.html",
"advert-comment.html",
"view-adverts.html\"",
"popular-adverts.html",
"search-adverts.html",
"adverts-box.html",
"post-advert.html",
"adverts.html"
);

?>
