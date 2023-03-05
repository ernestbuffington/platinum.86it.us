<?php

if (stristr($_SERVER['SCRIPT_NAME'], "GT-Shopping_Cart.php")) {
    Header("Location: ../index.html");
    die();
}

$urlin = array(
//"'(?<!/)modules.php\?name=Shopping_Cart&amp;file=plugin&amp;plugin_file=random_product.php'",
"'(?<!/)modules.php\?name=Shopping_Cart&amp;file=(account|cart|checkout|search)'",
"'(?<!/)modules.php\?name=Shopping_Cart'"
);

$urlout = array(
//"shopping-randomproduct.html",
"shopping-\\1.html",
"shopping.html"
);

?>