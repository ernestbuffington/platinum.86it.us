<?php
$template_main_menu = '
                <span class="topmenu">
                
                
<!-- BEGIN album_list -->
                        <a href="'.$CPG_M_URL.'" title="'.ALB_LIST_TITLE.'">Main Page</a> :: 
<!-- END album_list -->


              <a href="modules.php?name=coppermine&file=displayimage&meta=topn&cat=0&pid=1&slideshow=5000">Slideshow </a> :: 

<!-- BEGIN my_gallery -->
                        <a href="'.$CPG_M_URL.'&cat='.$my_gallery_id.'" title="'.MY_GAL_TITLE.'">'.MY_GAL_LNK.'</a> ::
<!-- END my_gallery -->
<!-- BEGIN my_profile -->
                        <a href="'.USERPROF_URL.'">'.MY_PROF_LNK.'</a> ::
<!-- END my_profile -->
<!-- BEGIN upload_pic -->
                        <a href="'.$CPG_URL.'&file=upload" title="'.UPLOAD_PIC_TITLE.'">'.UPLOAD_PIC_LNK.'</a> ::
<!-- END upload_pic -->
<!-- BEGIN register -->
                        <a href="'.NEWUSER_URL.'" title="'.REGISTER_TITLE.'">'.REGISTER_LNK.'</a> ::
<!-- END register -->
<!-- BEGIN login -->
                        <a href="'.LOGIN_URL.'">'.LOGIN_LNK.'</a>
<!-- END login -->
<!-- BEGIN logout -->
                        <a href="'.LOGOUT_URL.'">'.LOGOUT_LNK.'</a>
<!-- END logout -->
                        <br />
                        <a href="'.$CPG_URL.'&file=thumbnails&amp;meta=topn'.META_LNK.'">'.TOPN_LNK.'</a> ::
                        <a href="'.$CPG_URL.'&file=thumbnails&amp;meta=lastup'.META_LNK.'">'.LASTUP_LNK.'</a> ::
                        <a href="'.$CPG_URL.'&file=thumbnails&amp;meta=toprated'.META_LNK.'">'.TOPRATED_LNK.'</a> ::
                        <a href="'.$CPG_URL.'&file=thumbnails&amp;meta=lastcom'.META_LNK.'">'.LASTCOM_LNK.'</a> ::
                        <a href="'.$CPG_URL.'&file=thumbnails&amp;meta=favpics">'.FAV_LNK.'</a><br> 
                        <a href="modules.php?name=coppermine&file=video">Videos</a> ::
                        <a href="'.$CPG_URL.'&file=search">'.SEARCH_LNK.'</a> ::
                        <a href="'.$CPG_URL.'&file=help" title="'.HELP_TITLE.'" class="helplink">Help</a> ::
                        <a href="modules.php?name=coppermine&file=paypal"> I need more Space!</a><br> 
                </span>';
?>