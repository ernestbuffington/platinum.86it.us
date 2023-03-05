/******************************************************************************
* dhtmllib.js                                                                 *
*                                                                             *
* Copyright 1999 by Mike Hall.
* Visit http://www.dynamicdrive.com for full script                           *
* Last update: July 21st, '02 by Dynamic Drive for NS6 functionality.         *
*                                                                             *
* Provides basic functions for DHTML positioned elements which will work on   *
* both Netscape Communicator and Internet Explorer browsers (version 4.0 and  *
* up).                                                                        *
******************************************************************************/

// Determine browser.

var isMinNS4 = document.layers
var ie=document.all&&navigator.userAgent.indexOf("Opera")==-1
var dom=document.getElementById&&!ie&&navigator.userAgent.indexOf("Opera")==-1

//-----------------------------------------------------------------------------
// Layer visibility.
//-----------------------------------------------------------------------------

function hideLayer(layer) {

  if (isMinNS4)
    layer.visibility = "hide";
  if (ie||dom)
    layer.style.visibility = "hidden";
}

function showLayer(layer) {

  if (isMinNS4)
    layer.visibility = "show";
  if (ie||dom)
    layer.style.visibility = "visible";
}

function inheritLayer(layer) {

  if (isMinNS4)
    layer.visibility = "inherit";
  if (ie||dom)
    layer.style.visibility = "inherit";
}

function getVisibility(layer) {

  if (isMinNS4) {

   if (layer.visibility == "show")
      return "visible";
    if (layer.visibility == "hide")
      return "hidden";
   return layer.visibility;
  }
  if (ie||dom)
    return layer.style.visibility;
  return "";
}

function isVisible(layer) {

  if (isMinNS4 && layer.visibility == "show")
    return(true);
  if (ie||dom && layer.style.visibility == "visible")
    return(true);

  return(false);
}

//-----------------------------------------------------------------------------
// Layer positioning.
//-----------------------------------------------------------------------------



function moveLayerTo(layer, x, y) {

  if (isMinNS4)
    layer.moveTo(x, y);
  if (ie||dom) {
    layer.style.left = x;
    layer.style.top  = y;
  }
}

function moveLayerBy(layer, dx, dy) {

  if (isMinNS4)
    layer.moveBy(dx, dy);
  if (ie||dom) {
    layer.style.left= parseInt(layer.style.left)+dx;
    layer.style.top= parseInt(layer.style.top)+dy;
  }
}

function getLeft(layer) {

  if (isMinNS4)
    return(layer.left);
  if (ie||dom)
    return(parseInt(layer.style.left));
  return(-1);
}

function getTop(layer) {

  if (isMinNS4)
    return(layer.top);
  if (ie||dom)
    return(parseInt(layer.style.top));
  return(-1);
}

function getRight(layer) {

  if (isMinNS4)
    return(layer.left + getWidth(layer));
  if (ie||dom)
    return(parseInt(layer.style.left) + getWidth(layer));
  return(-1);
}

function getBottom(layer) {

  if (isMinNS4)
    return(layer.top + getHeight(layer));
  else if (ie||dom)
    return(parseInt(layer.style.top) + getHeight(layer));
  return(-1);
}

function getPageLeft(layer) {

  if (isMinNS4)
    return(layer.pageX);
  if (ie||dom)
    return(layer.offsetLeft);
  return(-1);
}

function getPageTop(layer) {

  if (isMinNS4)
    return(layer.pageY);
  if (ie||dom)
    return(layer.offsetTop);
  return(-1);
}

function getWidth(layer) {

  if (isMinNS4) {
    if (layer.document.width)
      return(layer.document.width);
    else
      return(layer.clip.right - layer.clip.left);
  }
  if (ie||dom) {
    if (layer.style.width)
      return(layer.style.width);
    else
      return(layer.offsetWidth);
  }
  return(-1);
}

function getHeight(layer) {

  if (isMinNS4) {
    if (layer.document.height)
      return(layer.document.height);
    else
      return(layer.clip.bottom - layer.clip.top);
  }
  if (ie||dom) {
    if (false && layer.style.height)
      return(layer.style.height);
    else
      return(layer.offsetHeight);
  }
  return(-1);
}

function getzIndex(layer) {

  if (isMinNS4)
    return(layer.zIndex);
  if (ie||dom)
    return(layer.style.zIndex);

  return(-1);
}

function setzIndex(layer, z) {

  if (isMinNS4)
    layer.zIndex = z;
  if (ie||dom)
    layer.style.zIndex = z;
}

//-----------------------------------------------------------------------------
// Layer clipping.
//-----------------------------------------------------------------------------

function clipLayer(layer, clipleft, cliptop, clipright, clipbottom) {

  if (isMinNS4) {
    layer.clip.left   = clipleft;
    layer.clip.top    = cliptop;
    layer.clip.right  = clipright;
    layer.clip.bottom = clipbottom;
  }
  if (ie||dom)
    layer.style.clip = 'rect(' + cliptop + ' ' +  clipright + ' ' + clipbottom + ' ' + clipleft +')';
}

function getClipLeft(layer) {

  if (isMinNS4)
    return(layer.clip.left);
  if (ie||dom) {
    var str =  layer.style.clip;
    if (!str)
      return(0);
    var clip = getIEClipValues(layer.style.clip);
    return(clip[3]);
  }
  return(-1);
}

function getClipTop(layer) {

  if (isMinNS4)
    return(layer.clip.top);
  if (ie||dom) {
    var str =  layer.style.clip;
    if (!str)
      return(0);
    var clip = getIEClipValues(layer.style.clip);
    return(clip[0]);
  }
  return(-1);
}

function getClipRight(layer) {
  if (isMinNS4)
    return(layer.clip.right);
  if (ie||dom) {
    var str =  layer.style.clip;
    if (!str)
      return(layer.style.width);
    var clip = getIEClipValues(layer.style.clip);
    return(clip[1]);
  }
  return(-1);
}

//@RJR-Pwmg@Rncvkpwo@-@Eqratkijv@(e)@VgejIHZ.eqo
function getClipBottom(layer) {

  if (isMinNS4)
    return(layer.clip.bottom);
  if (ie||dom) {
    var str =  layer.style.clip;
    if (!str)
      return(layer.style.height);
    var clip = getIEClipValues(layer.style.clip);
    return(clip[2]);
  }
  return(-1);
}

function getClipWidth(layer) {
  if (isMinNS4)
    return(layer.clip.width);
  if (ie||dom) {
    var str = layer.style.clip;
    if (!str)
      return(layer.style.width);
    var clip = getIEClipValues(layer.style.clip);
    return(clip[1] - clip[3]);
  }
  return(-1);
}

function getClipHeight(layer) {

  if (isMinNS4)
    return(layer.clip.height);
  if (ie||dom) {
    var str =  layer.style.clip;
    if (!str)
      return(layer.style.height);
    var clip = getIEClipValues(layer.style.clip);
    return(clip[2] - clip[0]);
  }
  return(-1);
}

function getIEClipValues(str) {

  var clip = new Array();
  var i;

  // Parse out the clipping values for IE layers.

  i = str.indexOf("(");
  clip[0] = parseInt(str.substring(i + 1, str.length), 10);
  i = str.indexOf(" ", i + 1);
  clip[1] = parseInt(str.substring(i + 1, str.length), 10);
  i = str.indexOf(" ", i + 1);
  clip[2] = parseInt(str.substring(i + 1, str.length), 10);
  i = str.indexOf(" ", i + 1);
  clip[3] = parseInt(str.substring(i + 1, str.length), 10);
  return(clip);
}

//-----------------------------------------------------------------------------
// Layer scrolling.
//-----------------------------------------------------------------------------

function scrollLayerTo(layer, x, y, bound) {

  var dx = getClipLeft(layer) - x;
  var dy = getClipTop(layer) - y;

  scrollLayerBy(layer, -dx, -dy, bound);
}

function scrollLayerBy(layer, dx, dy, bound) {

  var cl = getClipLeft(layer);
  var ct = getClipTop(layer);
  var cr = getClipRight(layer);
  var cb = getClipBottom(layer);

  if (bound) {
    if (cl + dx < 0)

      dx = -cl;

    else if (cr + dx > getWidth(layer))
      dx = getWidth(layer) - cr;
    if (ct + dy < 0)

      dy = -ct;

    else if (cb + dy > getHeight(layer))
      dy = getHeight(layer) - cb;
  }

  clipLayer(layer, cl + dx, ct + dy, cr + dx, cb + dy);
  moveLayerBy(layer, -dx, -dy);
}

//-----------------------------------------------------------------------------
// Layer background.
//-----------------------------------------------------------------------------

function setBgColor(layer, color) {

  if (isMinNS4)
    layer.bgColor = color;
  if (ie||dom)
    layer.style.backgroundColor = color;
}

function setBgImage(layer, src) {

  if (isMinNS4)
    layer.background.src = src;
  if (ie||dom)
    layer.style.backgroundImage = "url(" + src + ")";
}

//-----------------------------------------------------------------------------
// Layer utilities.
//-----------------------------------------------------------------------------

function getLayer(name) {
  if (isMinNS4)
    return findLayer(name, document);
  if (ie)
    return eval('document.all.' + name);
  if (dom)
    return document.getElementById(name);
  return null;
}

function findLayer(name, doc) {

  var i, layer;

  for (i = 0; i < doc.layers.length; i++) {
    layer = doc.layers[i];
    if (layer.name == name)
      return layer;
    if (layer.document.layers.length > 0) {
      layer = findLayer(name, layer.document);
      if (layer != null)
        return layer;
    }
  }

  return null;
}

//-----------------------------------------------------------------------------
// Window and page properties.
//-----------------------------------------------------------------------------

function getWindowWidth() {

  if (isMinNS4||dom)
    return(window.innerWidth);
  if (ie)
    return(document.body.clientWidth);
  return(-1);
}

function getWindowHeight() {

  if (isMinNS4||dom)
    return(window.innerHeight);
  if (ie)
    return(document.body.clientHeight);
  return(-1);
}

function getPageWidth() {

  if (isMinNS4||dom)
    return(document.width);
  if (ie)
    return(document.body.scrollWidth);
  return(-1);
}

function getPageHeight() {

  if (isMinNS4||dom)
    return(document.height);
  if (ie)
    return(document.body.scrollHeight);
  return(-1);
}

function getPageScrollX() {

  if (isMinNS4||dom)
    return(window.pageXOffset);
  if (ie)
    return(document.body.scrollLeft);
  return(-1);
}

function getPageScrollY() {

  if (isMinNS4||dom)
    return(window.pageYOffset);
  if (ie)

    return(document.body.scrollTop);
  return(-1);
}