<?php
global $name;
$template_thumb_view_title_row = "
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
    <tr>
        <form action=\"\" method=\"get\">
        <input type=\"hidden\" name=\"name\" value=\"$name\">
        <input type=\"hidden\" name=\"file\" value=\"thumbnails\">
        <input type=\"hidden\" name=\"album\" value=\"$_GET[album]\">
        <input type=\"hidden\" name=\"page\" value=\"$page\">
        <input type=\"hidden\" name=\"op\" value=\"modload\">
        <td>
            <h2 class=\"statlink\">$album_name</h2>
        </td>
        <td align=\"right\">
             <select name=\"sort\" class=\"sortorder_options\" onChange=\"submit();\">
                 <option value=\"ta\"".(($_GET['sort']=='ta')?' selected>':'>').SORT_TA."</option>
                 <option value=\"td\"".(($_GET['sort']=='td')?' selected>':'>').SORT_TD."</option>
                 <option value=\"na\"".(($_GET['sort']=='na')?' selected>':'>').SORT_NA."</option>
                 <option value=\"nd\"".(($_GET['sort']=='nd')?' selected>':'>').SORT_ND."</option>
                 <option value=\"da\"".(($_GET['sort']=='da')?' selected>':'>').SORT_DA."</option>
                 <option value=\"dd\"".(($_GET['sort']=='dd')?' selected>':'>').SORT_DD."</option>
                 <option value=\"ra\"".(($_GET['sort']=='ra')?' selected>':'>').SORT_RA."</option>
                 <option value=\"rd\"".(($_GET['sort']=='rd')?' selected>':'>').SORT_RD."</option>
             </select><noscript>
             <input type=\"submit\" value=\"Go\"></noscript>
        </td>
        </form>
 </tr>
</table>";
?>