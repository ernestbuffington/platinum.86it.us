function allonloads(){
SBpopulate();




}
// Insert Smiles to message box
function x(){
    return;
}
function DoSmilie(addSmilie, messageDef){
    var addSmilie, messageDef, revisedMessage;
    var currentMessage = document.shoutform1.ShoutComment.value;
    if(currentMessage==messageDef){currentMessage='';}
    revisedMessage = currentMessage+addSmilie;
    document.shoutform1.ShoutComment.value=revisedMessage;
    document.shoutform1.ShoutComment.focus();
    return;
}
//Drop-Down smilies
function MM_findObj(n, d){
    var p,i,x;
    if(!d) d=document;
    if((p=n.indexOf("?"))>0&&parent.frames.length){
        d=parent.frames[n.substring(p+1)].document;
        n=n.substring(0,p);
    }
    if(!(x=d[n])&&d.all){
        x=d.all[n];
    }
    for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
    for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
    if(!x && d.getElementById) {
        x=d.getElementById(n);
    }
    return x;
}
//end Drop-Down smilies
/*
Original Javascript code by dynamic drive, modified by SuperCat http://www.ourscripts.net
Cross browser Marquee II-  Dynamic Drive (www.dynamicdrive.com)
For full source code, 100's more DHTML scripts, and TOS, visit http://www.dynamicdrive.com
Credit MUST stay intact
*/
var SBspeed=1;
var SBiedom=document.all||document.getElementById;
var SBactualheight='';
var SBcross_marquee, SBns_marquee;
if(SBiedom){
	SBtxt='<div style="position:relative;width:100%;height:'+SBheight+'px;overflow:hidden" onmouseover="SBspeed=0" onmouseout="SBspeed=1"><div id="SBiemarquee" style="position:absolute;left:0px;top:0px;width:100%;"></div></div>'; //dochavoc
}else{
    SBtxt='<ilayer width=100% height='+SBheight+' name="SBns_marquee"><layer name="SBns_marquee2" width=100% height='+SBheight+' left=0 top=0 onmouseover="SBspeed=0" onmouseout="SBspeed=1"></layer></ilayer>';
}
function SBscroll(){
    if(SBiedom){
        if(parseInt(SBcross_marquee.style.top)>(SBactualheight*(-1)+2)){
            SBcross_marquee.style.top=parseInt(SBcross_marquee.style.top)-SBspeed+"px";
        }else{
            SBcross_marquee.style.top=parseInt(SBheight)+2+"px";
        }
    }
    else{
        if(SBns_marquee.top>(SBactualheight*(-1)+2)){
            SBns_marquee.top-=SBspeed;
        }else{
            SBns_marquee.top=parseInt(SBheight)+2;
        }
    }
}
function changeBoxSize(showhide) {
document.getElementById('smilies_hide').style.display='none';
document.getElementById('smilies_show').style.display='none';
document.getElementById('smilies_'+showhide).style.display='block';
}
function SBpopulate(){
    if(SBiedom){
        SBcross_marquee=document.getElementById? document.getElementById("SBiemarquee") : document.all.SBiemarquee;
        SBcross_marquee.style.top=parseInt(SBheight)+8+"px";
        SBcross_marquee.innerHTML=SBcontent;
        SBactualheight=SBcross_marquee.offsetHeight;
    }else{
        SBns_marquee=document.SBns_marquee.document.SBns_marquee2;
        SBns_marquee.top=parseInt(SBheight)+8;
        SBns_marquee.document.write(SBcontent);
        SBns_marquee.document.close();
        SBactualheight=SBns_marquee.document.height;
    }
    this.setInterval("SBscroll()",50);
}
if(window.addEventListener)
    window.addEventListener("load",allonloads,false);
else if (window.attachEvent)
    window.attachEvent("onload", allonloads);
else if (document.getElementById)
    womAdd('allonloads()');