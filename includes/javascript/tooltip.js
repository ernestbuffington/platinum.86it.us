/*

/********************************************************************

                  CZUser Info V5 Universal Block
				  
	(c) 2002 - 2004 by Codezwiz Network - http://www.codezwiz.com		 	
	(c) 2007 - 2008 by DarkForgeGFX - http://www.darkforgegfx.com
	  (c) 2007 - 2008 by FutureNuke - http://www.futurenuke.com
	  
	 Special Thanks To Technocrat - http://www.nuke-evolution.com
			
		Modified For Use With Platinum Genesis 7.6.b.5 ONLY!!
		
********************************************************************/

/********************************************************************
		
			           Modifications Include
		
 [ Advanced Member Image Control              Last updated 29/07/07]  			   
 [ Enhanced Security GFX Check                Last updated 29/07/07] 
 [ Ip Display                                 Last updated 29/07/07] 
 [ Post Count Display						  Last updated 29/07/07] 
 [ Page View/Hits Display					  Last updated 29/07/07] 
 [ Guest & Bots Display						  Last updated 05/08/07]
 [ Tooltip MouseOver Feature				  Last updated 04/08/07]
 [ Advanced Username Color					  Last updated 29/07/07]
 [ Audio Private Message Alert				  Last updated 29/07/07] 
 [ BBForum group Display					  Last updated 29/07/07]
 [ Chopped Usernames                          Last updated 29/07/07]
 
********************************************************************/

/*
======================================================================================================

 This script was tested with the following systems and browsers:

 - Windows XP: IE 6, NN 4, NN 7, Opera 7, Firefox 1
 - Mac OS X:   IE 5, Safari 1

 If you use another browser or system, this script may not work for you - sorry.

------------------------------------------------------------------------------------------------------

 USAGE:

 Use the toolTip-function with mouse-over and mouse-out events (see example below).

 - To show a tooltip, use this syntax: toolTip(text, width in pixels, opacity in percent)
   Note: width and opacity are optional

 - To hide a tooltip, use this syntax: toolTip()

------------------------------------------------------------------------------------------------------

 EXAMPLE:

 <a href="#" onMouseOver="toolTip('Just a test', 150)" onMouseOut="toolTip()">some text here</a>

======================================================================================================
*/
  function TOOLTIP() {
//----------------------------------------------------------------------------------------------------
// Configuration
//----------------------------------------------------------------------------------------------------
    this.width = 30;                      // width (pixels)
    this.bgColor = '#FFFFFF';             // background color
    this.textColor = '#000000';           // text color
    this.borderColor = 'red';             // border color
    this.opacity = 80;                    // opacity (percent) - doesn't work with all browsers
    this.cursorDistance = 20;             // distance from cursor (pixels)

    // don't change
    this.text = '';
    this.obj = 0;
    this.sobj = 0;
    this.active = false;

// -------------------------------------------------------------------------------------------------------
// Functions
// -------------------------------------------------------------------------------------------------------
    this.create = function() {
      if(!this.sobj) this.init();

      var t = '<table border=0 cellspacing=0 cellpadding=4 width=' + this.width + ' bgcolor=' + this.bgColor + '><tr>' +
              '<td><font color=' + this.textColor + '>' + this.text + '</font></td></tr></table>';

      if(document.layers) {
        t = '<table border=0 cellspacing=0 cellpadding=1><tr><td bgcolor=' + this.borderColor + '>' + t + '</td></tr></table>';
        this.sobj.document.write(t);
        this.sobj.document.close();
      }
      else {
        this.sobj.border = '1px solid ' + this.borderColor;
        this.setOpacity();
        if(document.getElementById) document.getElementById('ToolTip').innerHTML = t;
        else document.all.ToolTip.innerHTML = t;
      }
      this.show();
    }

    this.init = function() {
      if(document.getElementById) {
        this.obj = document.getElementById('ToolTip');
        this.sobj = this.obj.style;
      }
      else if(document.all) {
        this.obj = document.all.ToolTip;
        this.sobj = this.obj.style;
      }
      else if(document.layers) {
        this.obj = document.ToolTip;
        this.sobj = this.obj;
      }
    }

    this.show = function() {
      var ext = (document.layers ? '' : 'px');
      var left = mouseX;

      if(left + this.width + this.cursorDistance > winX) left -= this.width + this.cursorDistance;
      else left += this.cursorDistance;

      this.sobj.left = left + ext;
      this.sobj.top = mouseY + this.cursorDistance + ext;

      if(!this.active) {
        this.sobj.visibility = 'visible';
        this.active = true;
      }
    }

    this.hide = function() {
      if(this.sobj) this.sobj.visibility = 'hidden';
      this.active = false;
    }

    this.setOpacity = function() {
      this.sobj.filter = 'alpha(opacity=' + this.opacity + ')';
      this.sobj.mozOpacity = '.1';
      if(this.obj.filters) this.obj.filters.alpha.opacity = this.opacity;
      if(!document.all && this.sobj.setProperty) this.sobj.setProperty('-moz-opacity', this.opacity / 100, '');
    }
  }

//----------------------------------------------------------------------------------------------------
// Build layer, get mouse coordinates and window width, create tooltip-object
//----------------------------------------------------------------------------------------------------
  var tooltip = mouseX = mouseY = winX = 0;

  if(document.layers) {
    document.write('<layer id="ToolTip"></layer>');
    document.captureEvents(Event.MOUSEMOVE);
  }
  else document.write('<div id="ToolTip" style="position:absolute; top:-0 z-index:99"></div>');
  document.onmousemove = getMouseXY;

  function getMouseXY(e) {
    if(document.all) {
      mouseX = event.clientX + document.body.scrollLeft;
      mouseY = event.clientY + document.body.scrollTop;
    }
    else {
      mouseX = e.pageX;
      mouseY = e.pageY;
    }
    if(mouseX < 0) mouseX = 0;
    if(mouseY < 0) mouseY = 0;

    if(document.body && document.body.offsetWidth) winX = document.body.offsetWidth - 25;
    else if(window.innerWidth) winX = window.innerWidth - 25;
    else winX = screen.width - 25;

    if(tooltip && tooltip.active) tooltip.show();
  }

  function toolTip(text, width, opacity) {
    if(text) {
      tooltip = new TOOLTIP();
      tooltip.text = text;
      if(width) tooltip.width = width;
      if(opacity) tooltip.opacity = opacity;
      tooltip.create();
    }
    else if(tooltip) tooltip.hide();
  }

