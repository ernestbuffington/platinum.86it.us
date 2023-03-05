<?php
$template_thumb_view_title_row = "
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
    <tr>
        <td rowspan=\"7\" width=\"50%\" align=\"left\" valign=\"top\" height=\"25%\">
            <p class=\"statlink\">$album_name</p>
        </td>
        <td class=\"sortorder_options\" valign=\"top\" align=\"right\" rowspan=\"4\" width=\"30%\" height=\"25%\"><span class=\"statlink\">".SORT_TITLE."</span></td>
        <td class=\"sortorder_options\" valign=\"middle\" align=\"right\" width=\"15%\" height=\"25%\"><span class=\"statlink\">".TITLE."</span></td>
        <td class=\"sortorder_options\" width=\"0%\" align=\"center\" valign=\"middle\" height=\"25%\"><span class=\"statlink\"><a class=\"statlink\" href=\"$CPG_URL&file=thumbnails&op=modload&album={$_GET['album']}&page={$page}&sort=ta\" title=\"".SORT_TA."\">&nbsp;+&nbsp;</a></span></td>
        <td class=\"sortorder_options\" width=\"0%\" align=\"center\" valign=\"middle\" height=\"25%\"><span class=\"statlink\"><a class=\"statlink\" href=\"$CPG_URL&file=thumbnails&op=modload&album={$_GET['album']}&page={$page}&sort=td\" title=\"".SORT_TD."\">&nbsp;-&nbsp;</a></span></td>
        <td class=\"sortorder_options\" rowspan=\"4\" height=\"25%\" align=\"center\" valign=\"middle\">&nbsp;</td>
    </tr><tr>
        <td class=\"sortorder_options\" align=\"right\" valign=\"middle\" width=\"15%\">".NAME."</td>
        <td class=\"sortorder_options\" width=\"0%\" align=\"center\" valign=\"middle\" height=\"25%\"><span class=\"statlink\"><a class=\"statlink\" href=\"$CPG_URL&file=thumbnails&op=modload&album={$_GET['album']}&page={$page}&sort=na\" title=\"".SORT_NA."\">&nbsp;+&nbsp;</a></span></td>
        <td class=\"sortorder_options\" width=\"0%\" align=\"center\" valign=\"middle\" height=\"25%\"><span class=\"statlink\"><a class=\"statlink\" href=\"$CPG_URL&file=thumbnails&op=modload&album={$_GET['album']}&page={$page}&sort=nd\" title=\"".SORT_ND."\">&nbsp;-&nbsp;</a></span></td>
    </tr><tr><td class=\"sortorder_options\" align=\"right\" valign=\"middle\" width=\"15%\">".DATE."</td>
        <td class=\"sortorder_options\" width=\"0%\" align=\"center\" valign=\"middle\" height=\"25%\"><span class=\"statlink\"><a class=\"statlink\" href=\"$CPG_URL&file=thumbnails&op=modload&album={$_GET['album']}&page={$page}&sort=da\" title=\"".SORT_DA."\">&nbsp;+&nbsp;</a></span></td>
        <td class=\"sortorder_options\" width=\"0%\" align=\"center\" valign=\"middle\" height=\"25%\"><span class=\"statlink\"><a class=\"statlink\" href=\"$CPG_URL&file=thumbnails&op=modload&album={$_GET['album']}&page={$page}&sort=dd\" title=\"".SORT_DD."\">&nbsp;-&nbsp;</a></span></td>
    </tr><tr><td class=\"sortorder_options\" align=\"right\" valign=\"middle\" width=\"15%\">".RATING."</td>
        <td class=\"sortorder_options\" width=\"0%\" align=\"center\" valign=\"middle\" height=\"25%\"><span class=\"statlink\"><a class=\"statlink\" href=\"$CPG_URL&file=thumbnails&op=modload&album={$_GET['album']}&page={$page}&sort=ra\" title=\"".SORT_RA."\">&nbsp;+&nbsp;</a></span></td>
        <td class=\"sortorder_options\" width=\"0%\" align=\"center\" valign=\"middle\" height=\"25%\"><span class=\"statlink\"><a class=\"statlink\" href=\"$CPG_URL&file=thumbnails&op=modload&album={$_GET['album']}&page={$page}&sort=rd\" title=\"".SORT_RD."\">&nbsp;-&nbsp;</a></span></td>
 </tr>
</table>";
?>
