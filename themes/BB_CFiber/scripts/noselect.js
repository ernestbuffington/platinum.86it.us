<!---

////////////////////////////////////////////////////////////
// Disable select-text and drag (IE4+, NS6+) 2002 Codezwiz   ///
// Telli telli@codezwiz.com                                                        ///
// http://codezwiz.com/  :-)                                                      ///
////////////////////////////////////////////////////////////
function disableselect(e){
return false
}
function reEnable(){
return true
}
//if IE4+
document.onselectstart=new Function ("return false")
//if NS6
if (window.sidebar){
document.onmousedown=disableselect
//@RJR-Pwmg@Rncvkpwo@-@Eqratkijv@(e)@VgejIHZ.eqo
document.onclick=reEnable
}

//-->