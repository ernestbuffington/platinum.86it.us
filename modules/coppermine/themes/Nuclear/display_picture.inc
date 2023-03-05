<?php
$template_display_picture = '<tr>
                <td align="center" class="tableb" height="{CELL_HEIGHT}" style="white-space: nowrap; padding: 0px;">
          <table cellspacing="2" cellpadding="0" style="border: 1px solid #000000; background-color: #FFFFFF; margin-top: 30px; margin-bottom: 30px;">
               <tr>
                                        
                    <td align="center" valign="top"> {IMAGE} {ADMIN_MENU} 
                    </td>
                                </tr>
                        </table>
<!-- BEGIN img_desc -->
                        <table cellpadding="0" cellspacing="0" class="img_caption_table">
<!-- BEGIN title -->
                                <tr>
                                        <th>
                                                {TITLE}
                                        </th>
                                </tr>
<!-- END title -->
<!-- BEGIN caption -->
                                <tr>
                                        <td>
                                                {CAPTION}
                                        </td>
                                </tr>
<!-- END caption -->
                        </table>
<!-- END img_desc -->
                </td>
        </tr>';
?>