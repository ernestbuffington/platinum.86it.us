<SCRIPT language=javascript><!--
function encode(code){
if(document.form1.text1.value.length>0){
new_text = KeyCode(code);
document.form1.text1.value = new_text;
}else alert('Enter the URL to be Encoded!')}
function KeyCode(mystring){
newstring = '';
for (i=0; i<mystring.length; i++){
if (mystring.charCodeAt(i) == 32){newstring = newstring +"%20";}
else if (mystring.charCodeAt(i) == 35){newstring = newstring +"%23";}
else if (mystring.charCodeAt(i) == 36){newstring = newstring +"%24";}
else if (mystring.charCodeAt(i) == 37){newstring = newstring +"%25";}
else if (mystring.charCodeAt(i) == 38){newstring = newstring +"%26";}
else if (mystring.charCodeAt(i) == 43){newstring = newstring +"%2B";}
else if (mystring.charCodeAt(i) == 46){newstring = newstring +"%2E";}
else if (mystring.charCodeAt(i) == 47){newstring = newstring +"%2F";}
else if (mystring.charCodeAt(i) == 58){newstring = newstring +"%3A";}
else if (mystring.charCodeAt(i) == 59){newstring = newstring +"%3B";}
else if (mystring.charCodeAt(i) == 60){newstring = newstring +"%3C;";}
else if (mystring.charCodeAt(i) == 61){newstring = newstring +"%3D";}
else if (mystring.charCodeAt(i) == 62){newstring = newstring +"%3E;";}
else if (mystring.charCodeAt(i) == 63){newstring = newstring +"%3F";}
else if (mystring.charCodeAt(i) == 64){newstring = newstring +"%40";}
else if (mystring.charCodeAt(i) == 91){newstring = newstring +"%5B;";}
else if (mystring.charCodeAt(i) == 92){newstring = newstring +"%5C";}
else if (mystring.charCodeAt(i) == 93){newstring = newstring +"%5D;";}
else if (mystring.charCodeAt(i) == 94){newstring = newstring +"%5E";}
else if (mystring.charCodeAt(i) == 96){newstring = newstring +"%60";}
else if (mystring.charCodeAt(i) == 123){newstring = newstring +"%7B";}
else if (mystring.charCodeAt(i) == 124){newstring = newstring +"%7C";}
else if (mystring.charCodeAt(i) == 125){newstring = newstring +"%7D";}
else if (mystring.charCodeAt(i) == 126){newstring = newstring +"%7E";}
else {newstring = newstring + mystring.charAt(i)}
}return newstring; 
}
function decode(code){
if(document.form1.text1.value.length>0){
new_text = unescape(document.form1.text1.value);
document.form1.text1.value = new_text;
}else alert('Enter the URL to be Decoded!')}
//--></SCRIPT>