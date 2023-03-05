            <SCRIPT language=JavaScript>


 hexstr = '0123456789ABCDEF'

 function doParse(s) {
         x = parseInt(s)
         if ((x<0) || (x>255)) {
                 alert('Numbers must be within 0 and 255')
                 return -1
         }
         return x
 }//doParse()

 function doConvert(x) {
         s = ''
         x1 = hexstr.charAt(Math.floor(x/16))
         x2 = hexstr.charAt(x % 16)
         s = s + x1 + x2
         return s
 }//doConvert()
 function doChange() {
         t = document.form1
         var r, g, b
         r = doParse(t.RI.value)
         g = doParse(t.GI.value)
         b = doParse(t.BI.value)
         if (r==-1) { t.RI.value=0 ; return true }
         if (g==-1) { t.GI.value=0 ; return true }
         if (b==-1) { t.BI.value=0 ; return true }
         s = '#' + doConvert(r) + doConvert(g) + doConvert(b)
         document.bgColor = s
         t.out.value = s
         return true
 } //doChange()
 function doAlter(dst,val) {
         var x = doParse(dst.value)
         if ( x != -1 )
                 dst.value = ((x+val<0)||(x+val>255)) ? ((x+val+255)%255) : (x + val)
         doChange()
         return false
 }


              </SCRIPT>