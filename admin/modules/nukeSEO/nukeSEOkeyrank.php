<?php
#########################################################################
# nukeSEO Copyright (c) 2005 Kevin Guske              http://nukeSEO.com
# Meta Tag function developed by Jens Hauge           http://visayas.dk
# Sitemap object approach from mSearch by David Karn  http://webdever.net
# Submit Sitemap from phpSitemapNG by Tobias Kluge    http://enarion.net
# Results originally developed by Curve2 Design       http://curve2.com
#########################################################################
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License.
#########################################################################

if(!defined('ADMIN_FILE')) { header("Location: ../../../index.php");  die(); }

$pagetitle = _SEO_NUKESEO.": "._SEO_MENU;
include_once("header.php");
title($pagetitle);
OpenTable();
//OpenMenu();
nukeSEOmenu();
//CloseMenu();
global $nukeurl;

require_once("admin/modules/nukeSEO/nukeSEOfunctions.php");

if($_POST[submit] or (isset($terms) and isset($target))) {
	$data = array();
	
	$terms = urlencode(trim($terms));
	$target = trim($target);
	
	$target = preg_replace('#http://#', '', $target);
	$target = preg_replace('#www.#', '', $target);
	
	// Google
	$source = 'http://www.google.com/search?q='.$terms.'&num=100';
	$data['Google'] = SERPfetch($source, $target, '<p class=g>', 11, '</a>', '<div><p class=g>', '<br clear=all>');
	$data['Google'][2] = $source;
	
	// Yahoo!
	$source = 'http://search.yahoo.com/search?p='.$terms.'&n=100';
	$data['Yahoo!'] = SERPfetch($source, $target, 'class=yschttl', 13, '</a>', 'WEB RESULTS', '</ol>');
	$data['Yahoo!'][2] = $source;
	
	// MSN Search Beta
	$source = 'http://beta.search.msn.com/results.aspx?q='.$terms.'&first=1&count=100';
	$data['MSN Search'] = SERPfetch($source, $target, '<h3>', 4, '</h3>', '<div id="results"', '<div id="ads_rightC"');
	$data['MSN Search'][2] = $source;
	
	// AltaVista
	$source = 'http://www.altavista.com/web/results?q='.$terms.'&nbq=100';
	$data['AltaVista'] = SERPfetch($source, $target, "class='res'", 11, '</a>', 'AltaVista found', 'Result Pages');
	$data['AltaVista'][2] = $source;
} else {
	$target = $nukeurl;
}
?>

<div>
	<form action='<?php echo $_SERVER[PHP_SELF]; ?>' method='post'>
	<table width='400' border='0' cellpadding='3' cellspacing='0' align="center">
		<tr><td align='center' colspan='2'><strong><?php echo ""._SEO_KEYRANKHDR.""; ?></strong></td></tr>
		<tr><td colspan='2'><?php echo ""._SEO_KEYRANKINST.""; ?></td></tr>
		<tr>
			<td><label for='terms'><?php echo ""._SEO_SEARCHTERMS.""; ?></label></td>
			<td>
				<input type='text' name='terms' id='terms' value='<?php echo $terms; ?>' style='width:200px;'/>
			</td>
		</tr>
		<tr>
			<td><label for='target'><?php echo ""._SEO_WEBURL.""; ?></label></td>
			<td>
				<input type='text' name='target' id='target' value='<?php echo $target; ?>' style='width:200px;'/>
			</td>
		</tr>
		<tr>
			<td></td>
			<td><input type='submit' value='Submit'/></td>
		</tr>
	</table>
	<?php
	// display data summary
	if($data) {
		echo "<br/><table width='400' border='0' cellpadding='3' cellspacing='0' align=\"center\">";
		echo "<tr><td><strong>Search Engine</strong></td><td align='right'><strong>Position</strong></td></tr>";
		foreach($data as $engine => $result) {
			echo "<tr><td><a href='$result[2]' target='_blank'>$engine</a></td><td align='right'>";
			if($result[0])
				echo $result[1];
			elseif($result[0] == '0')
				echo 'Not Found';
			else
				echo 'Not Available';
			echo '</td></tr>';
		}
		echo '</table>';
	}
	?>
	<input type='hidden' name='submit' value='true'/>
	<input type='hidden' name='op' value='<?php echo $op; ?>'/>
	</form>
	<br/>
	<div align="center">Enhanced for nukeSEO from <a href='http://www.curve2.com'>SERP Position Plus by Curve2 Design</a></div>
</div>
<?php
CloseTable();
include_once("footer.php");
?>