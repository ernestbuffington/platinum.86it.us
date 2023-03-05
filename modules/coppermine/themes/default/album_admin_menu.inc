<?php
$template_album_admin_menu = '<table border="0" cellpadding="0" cellspacing="1">
                <tr>
                        <td align="center" valign="middle">
                                <div class="admin_menu">
                                <a class="adm_menu" href="'.$CPG_URL.'&file=delete&id={ALBUM_ID}&what=album" onclick="return confirm(\''.CONFIRM_DELETE.'\');">'.DELETE.'</a></div>
                        </td>
                        <td align="center" valign="middle">
                                <div class="admin_menu">
                                        <a class="adm_menu" href="'.$CPG_URL.'&file=modifyalb&album={ALBUM_ID}">'.MODIFY.'</a>
                                </div>
                        </td>
                        <td align="center" valign="middle">
                                <div class="admin_menu">
                                        <a class="adm_menu" href="'.$CPG_URL.'&file=editpics&album={ALBUM_ID}">'.EDIT_PICS.'</a>
                                </div>
                        </td>
                </tr>
        </table>';
?>
