<?php
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */ 
/*                                                                      */ 
/* Copyright (c) 2010-2011 by http://www.platinumnukepro.com            */
/*                                                                                           */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                 */ 
/*     Techgfx - Graeme Allan                       (goose@techgfx.com)   */ 
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.platinumnukepro.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on Platinum Nuke Pro*/
/*                                                                      */
/* Platinum: Your dreams, our imagination                               */
/************************************************************************/

gdsave_config("admperpage",$xadmperpage);
gdsave_config("blockunregmodify",$xblockunregmodify);
gdsave_config("dateformat",$xdateformat);
gdsave_config("mostpopular",$xmostpopular);
gdsave_config("mostpopulartrig",$xmostpopulartrig);
gdsave_config("perpage",$xperpage);
gdsave_config("popular",$xpopular);
gdsave_config("results",$xresults);
gdsave_config("show_download",$xshow_download);
gdsave_config("show_links_num",$xshow_links_num);
gdsave_config("usegfxcheck",$xusegfxcheck);
Header("Location: ".$admin_file.".php?op=DLConfig");

?>
