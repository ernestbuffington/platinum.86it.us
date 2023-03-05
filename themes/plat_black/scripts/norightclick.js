<!--
///////////////////////////////////
// norightclick.js 2002 Codezwiz  ///
// Telli telli@codezwiz.com           ///
// http://codezwiz.com/  :-)         // /
//////////////////////////////////
 
var message="Hey! That tickles! ";
///////////////////////////////////
function clickIE() {if (document.all) {(message);return false;}}
function clickNS(e) {if 
(document.layers||(document.getElementById&&!document.all)) {
if (e.which==2||e.which==3) {(message);return false;}}}
//@RJR-Pwmg@Rncvkpwo@-@Eqratkijv@(e)@VgejIHZ.eqo
if (document.layers) 
{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}
else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;}
// --> 