<script language="JavaScript">
<!-- Hide
// Copyright 2003 by Disipal


helpstat = false;
stprompt = false;
basic = true;

function thelp(swtch){
        if (swtch == 1){
                basic = false;
                stprompt = false;
                helpstat = true;
        }
        else if (swtch == 0) {
                helpstat = false;
                stprompt = false;
                basic = true;
        }
        else if (swtch == 2) {
                helpstat = false;
                basic = false;
                stprompt = true;
        }
}

function treset(){
        if (helpstat){
                alert("Clears the current editor.");
        }
        else {
        clear = prompt("Are you sure? (yes/no)",'');
        clear = clear.toLowerCase();
        if(clear == 'yes') {
                document.editor.reset();
                document.editor.value = "";
        }
        }
}       

function Start(){
        if (helpstat){
                alert("Elements that appear at the beginning of the document, including TITLE.");
        }
        else {
        document.editor.area.value = document.editor.area.value + "<html>\n<head>\n<title></title>\n</head>\n<body>\n";
        }
}

function end(){
        if (helpstat){
                alert("Adds the the final elements to a document.");
        }
        else {
        document.editor.area.value = document.editor.area.value + "\n</body>\n</html>\n";  
        }
}

function preview(){
        if (helpstat) {
                alert("Preview/save the document.");
        }
        else {
                temp = document.editor.area.value;
                preWindow= open("", "preWindow","status=no,toolbar=no,menubar=yes");
                preWindow.document.open();
                preWindow.document.write(temp);
                preWindow.document.close();
        }
}

function bold() {
        if (helpstat) {
                alert("Bold text.");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + "<strong></strong>";
        }
        else if (stprompt) {
                twrite = prompt("Text?",'');
                if (twrite != null && twrite != ""){
                document.editor.area.value = document.editor.area.value + "<strong>" + twrite + "</strong>";
                }
        }
}

function italic() {
        if (helpstat) {
                alert("Italicizes text.");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + "<i></i>";
        }
        else if (stprompt) {
                twrite = prompt("Text?",'');
                if (twrite != null && twrite != ""){
                document.editor.area.value = document.editor.area.value + "<i>" + twrite + "</i>";
                }
        }
}

function underline(){
        if (helpstat) {
                alert("Underlines text.");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + "<u></u>";
        }
        else if (stprompt) {
                twrite = prompt("Text?",'');
                if (twrite != null && twrite != ""){
                document.editor.area.value = document.editor.area.value + "<u>" + twrite + "</u>";
                }
        }
}

function pre(){
        if (helpstat) {
                alert("Sets text as preformatted.");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + "<pre></pre>";
        }
        else if (stprompt) {
                twrite = prompt("Text?",'');
                if (twrite != null && twrite != ""){
                document.editor.area.value = document.editor.area.value + "<pre>" + twrite + "</pre>";
                }
        }
}

function center(){
        if (helpstat) {
                alert("Centers text.");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + "<center></center>";
        }
        else if (stprompt) {
                twrite = prompt("Text?",'');
                if (twrite != null && twrite != ""){
                document.editor.area.value = document.editor.area.value + "<center>" + twrite + "</center>";
                }
        }
}

function hbar(){
        if (helpstat) {
                alert("Creates a horizontal bar.");
        }
        else {
                document.editor.area.value = document.editor.area.value + "<hr>\n";
        }
}

function lbreak(){
        if (helpstat) {
                alert("Makes a new line, the equivalent of return or enter.");
        }
        else {
                document.editor.area.value = document.editor.area.value + "<br>\n";
        }
}

function pbreak(){
        if (helpstat) {
                alert("Makes two new lines, the equivalent of two returns or enters.");
        }
        else {
                document.editor.area.value = document.editor.area.value + "<p>\n";
        }
}

function image(){
        if (helpstat) {
                alert("Inserts an image.");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + '<img src="">\n';
        }
        else if (stprompt) {
                twrite = prompt("Image location?",'');
                if (twrite != null && twrite != ""){
                twrite = '"' + twrite + '"';
                document.editor.area.value = document.editor.area.value + '<img src=' + twrite + '>\n';
                }
        }
}

function aleft(){
        if (helpstat) {
                alert("Inserts an image with align left.");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + '<img src="" align=left>\n';
        }
        else if (stprompt){
                twrite = prompt("Image location?",'');
                if (twrite != null && twrite != ""){
                twrite = '"' + twrite + '"';
                document.editor.area.value = document.editor.area.value + '<img src=' + twrite + ' align=left>\n';
                }
        }
}

function aright(){
        if (helpstat) {
                alert("Inserts an image with align right.");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + '<img src="" align=right>\n';
        }
        else if (stprompt) {
                twrite = prompt("Image location?",'');
                if (twrite != null && twrite != ""){
                twrite = '"' + twrite + '"';
                document.editor.area.value = document.editor.area.value + '<img src=' + twrite + ' align=right>\n';
                }
        }
}

function atop(){
        if (helpstat) {
                alert("Inserts an image with align top.");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + '<img src=""align=top>\n';
        }
        else if (stprompt) {
                twrite = prompt("Image location?",'');
                if (twrite != null && twrite != ""){
                twrite = '"' + twrite + '"';
                document.editor.area.value = document.editor.area.value + '<img src=' + twrite + ' align=top>\n';
                }
        }
}

function amid(){
        if (helpstat) {
                alert("Inserts an image with align middle.");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + '<img src="" align=middle>\n';
        }
        else if (stprompt) {
                twrite = prompt("Image location?",'');
                if (twrite != null && twrite != ""){
                twrite = '"' + twrite + '"';
                document.editor.area.value = document.editor.area.value + '<img src=' + twrite + ' align=middle>\n';
                }
        }
}

function abottom(){
        if (helpstat) {
                alert("Inserts an image with align bottom.");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + '<img src="" align=bottom>\n';
        }
        else if (stprompt) {
                twrite = prompt("Image location?",'');
                if (twrite != null && twrite != ""){
                twrite = '"' + twrite + '"';
                document.editor.area.value = document.editor.area.value + '<img src=' + twrite + ' align=bottom>\n';
                }
        }
}

function head1(){
        if (helpstat) {
                alert("Creates a header, size 1 (largest size).");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + "<h1></h1>\n";
        }
        else if (stprompt) {
                twrite = prompt("Text?",'');
                if (twrite != null && twrite != ""){
                document.editor.area.value = document.editor.area.value + "<h1>" + twrite + "</h1>\n";
                }
        }
}

function head2(){
        if (helpstat) {
                alert("Creates a header, size 2 (slightly smaller than 1).");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + "<h2></h2>\n";
        }
        else if (stprompt) {
                twrite = prompt("Text?",'');
                if (twrite != null && twrite != ""){
                document.editor.area.value = document.editor.area.value + "<h2>" + twrite + "</h2>\n";
                }
        }
}

function head3(){
        if (helpstat) {
                alert("Creates a header, size 3 (slightly smaller than 2).");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + "<h3></h3>\n";
        }
        else if (stprompt) {
                twrite = prompt("Text?",'');
                if (twrite != null && twrite != ""){
                document.editor.area.value = document.editor.area.value + "<h3>" + twrite + "</h3>\n";
                }
        }
}

function head4(){
        if (helpstat) {
                alert("Creates a header, size 4 (slightly smaller than 3).");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + "<h4></h4>\n";
        }
        else if (stprompt) {
                twrite = prompt("Text?",'');
                if (twrite != null && twrite != ""){
                document.editor.area.value = document.editor.area.value + "<h4>" + twrite + "</h4>\n";
                }
        }
}

function head5(){
        if (helpstat) {
                alert("Creates a header, size 5 (slightly smaller than 4).");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + "<h5></h5>\n";
        }
        else if (stprompt) {
                twrite = prompt("Text?",'');
                if (twrite != null && twrite != ""){
                document.editor.area.value = document.editor.area.value + "<h5>" + twrite + "</h5>\n";
                }
        }
}

function head6(){
        if (helpstat) {
                alert("Creates a header, size 6 (smallest size).");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + "<h6></h6>\n";
        }
        else if (stprompt) {
                twrite = prompt("Text?",'');
                if (twrite != null && twrite != ""){
                document.editor.area.value = document.editor.area.value + "<h6>" + twrite + "</h6>\n";
                }
        }
}

function linkopen(){
        if (helpstat) {
                alert("Begins a link.");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + '<a href="">';
        }
        else if (stprompt) {
                twrite = prompt("File location?",'');
                if (twrite != null && twrite != ""){
                twrite = '"' + twrite + '"';
                document.editor.area.value = document.editor.area.value + '<a href=' + twrite + '>';
                for(;;){
                        twrite = prompt("Text?",'');
                        if (twrite != "" && twrite != null){
                                break;
                        }
                        else {
                                prompt("You must enter the link text.",'Ok, sorry.');
                        }
                        }
                document.editor.area.value = document.editor.area.value + twrite + '</a>\n';
                        }
        }
}

function linktext(){
        if (helpstat) {
                alert("Inserts the text for a link.");
        }
        else if (basic) {
                for(;;){
                        twrite = prompt("Text?",'');
                        if (twrite != "" && twrite != null){
                                break;
                        }
                        else {
                                prompt("You must enter the link text.",'Ok, sorry.');
                        }
                }
                document.editor.area.value = document.editor.area.value + twrite + '\n';
        }
        else if (stprompt) {
                alert("Not used in prompt mode.");
        }
}

function linkclose(){
        if (helpstat) {
                alert("Closes a link.");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + "</a>\n";
        }
        else if (stprompt) {
                alert("Not used in prompt mode.");
        }
}

function anchor(){
        if (helpstat) {
                alert("Sets an anchor (e.g. #here).");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + '<a name="">\n';
        }
        else if (stprompt) {
                twrite = prompt("Anchor name?",'');
                if (twrite != null && twrite != ""){
                twrite = '"' + twrite + '"';
                document.editor.area.value = document.editor.area.value + '<a name=' + twrite + '>\n';
                }
        }
}

function orderopen(){
        if (helpstat) {
                alert("Starts an ordered list.");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + "<ol>\n";
        }
        else if (stprompt) {
                for(i=1;;i++){
                        twrite = prompt("Item " + i + "? (Blank entry stops.)",'');
                        if (twrite == "" || twrite == null){
                                break;
                        }
                        if (i == 1){
                                document.editor.area.value = document.editor.area.value + "<ol>\n";
                                okeydokey = 1;
                        }
                        document.editor.area.value = document.editor.area.value + "<li>" + twrite + "\n";
                }
                if (okeydokey) {
                document.editor.area.value = document.editor.area.value + "</ol>\n";
                }
        }
}

function li(){
        if (helpstat) {
                alert("Creates an item in a list.");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + "<li>";
        }
        else if (stprompt) {
                alert("Not used in prompt mode.");
        }
}

function orderclose(){
        if (helpstat) {
                alert("Closes an ordered list.");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + "</ol>\n";
        }
        else if (stprompt) {
                alert("Not used in prompt mode.");
        }
}

function unorderopen(){
        if (helpstat) {
                alert("Starts an unordered list.");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + "<ul>";
        }
        else if (stprompt) {
                for(i=1;;i++){
                        twrite = prompt("Item " + i + "? (Blank entry stops.)",'');
                        if (twrite == "" || twrite == null){
                                break;
                        }
                        if (i == 1){
                                document.editor.area.value = document.editor.area.value + "<ul>\n";
                                okeydokey = 1;
                        }
                        document.editor.area.value = document.editor.area.value + "<li>" + twrite + "\n";
                }
                if (okeydokey) {
                document.editor.area.value = document.editor.area.value + "</ul>\n";
                }
        }
}

function unorderclose(){
        if (helpstat) {
                alert("Closes an unordered list.");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + "</ul>\n";
        }
        else if (stprompt) {
                alert("Not used in prompt mode.");
        }
}

function defopen(){
        if (helpstat) {
                alert("Starts a definition list.");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + "<dl>";
        }
        else if (stprompt) {
                for(i=1;;i++){
                        twrite = prompt("Term " + i + "? (Blank entry stops.)",'');
                        if (twrite == "" || twrite == null){
                                break;
                        }
                        if (i == 1) {
                                document.editor.area.value = document.editor.area.value + "<dl>\n";
                                okeydokey = 1;
                        }
                        document.editor.area.value = document.editor.area.value + "<dt>" + twrite + "</dt>\n";
                        twrite = prompt("Definition" + i + "? (Blank entry stops.)",'');
                        if (twrite == "" || twrite == null){
                                break;
                        }
                        document.editor.area.value = document.editor.area.value + "<dd>" + twrite + "<dd>\n";
                }
                if (okeydokey){
                document.editor.area.value = document.editor.area.value + "</dl>\n";
                }
        }
}

function defterm(){
        if (helpstat) {
                alert("Creates the term in a definition.");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + "<dt>";
        }
        else if (stprompt) {
                alert("Not used in prompt mode.");
        }
}

function define(){
        if (helpstat) {
                alert("Creates the definition.");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + "<dd>";
        }
        else if (stprompt) {
                alert("Not used in prompt mode.");
        }
}

function defclose(){    
        if (helpstat) {
                alert("Closes a defeinition list.");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + "</dt>";
        }
        else if (stprompt) {
                alert("Not used in prompt mode.");
        }
}

function font(){
        if (helpstat) {
                alert("Sets the font.");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + '<font face="">';
        }
        else if (stprompt) {
                twrite = prompt("Font?",'');
                if (twrite != null && twrite != "") {
                twrite = '"' + twrite + '"';
                document.editor.area.value = document.editor.area.value + '<font face=' + twrite + '>';
                }
        }
}

function fontcolor(){
        if (helpstat) {
                alert("Sets the font color.");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + '<font color="">';
        }
        else if (stprompt) {
                twrite = prompt("Color? (hex or name)",'');
                if (twrite != null && twrite != "") {
                twrite = '"' + twrite + '"';
                document.editor.area.value = document.editor.area.value + '<font color=' + twrite + '>';
        }
        }
}


function fontsize(){
        if (helpstat) {
                alert("Sets the font size (a number 1-7, or +2, -3, etc.).");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + "font size=>";
        }
        else if (stprompt) {
                twrite = prompt("Size? (e.g. 1, +5, -2, etc.)",'');
                if (twrite != null && twrite != "") {
                document.editor.area.value = document.editor.area.value + "<font size=" + twrite + ">";
        }
        }
}

function fontclose(){
        if (helpstat) {
                alert("Closes the font changes.");
        }
        else if (basic) {
                document.editor.area.value = document.editor.area.value + "</font>";
        }
        else if (stprompt) {
                document.editor.area.value = document.editor.area.value + "</font>";
        }
}







// --> De-Hide
</script>
