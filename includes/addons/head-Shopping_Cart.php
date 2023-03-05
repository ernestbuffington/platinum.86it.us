<?php

if (stristr(htmlentities($_SERVER['PHP_SELF']), 'head-Shopping_Cart.php')) {
	Header('Location: ../../index.php');
	die();
}
global $name;

$PreferredTagsStyle = 'sc.css';
$ThemeSel = get_theme();
$SCCssFile = INCLUDE_PATH . 'themes/' . $ThemeSel . '/style/' . $PreferredTagsStyle;
$DefaultSCStyle = 'modules/Shopping_Cart/templates/' . $PreferredTagsStyle;

if ($name == 'Shopping_Cart') {
if (file_exists($SCCssFile)) {
	addCSSToHead($SCCssFile, 'file');
	}else{
	addCSSToHead($DefaultSCStyle, 'file');

}

$inlinesearchjs='<script type="text/javascript">
function make_blank()
{
document.searchquery.query.value ="";
}
</script>';
addJSToHead($inlinesearchjs, 'inline');
}
?>
