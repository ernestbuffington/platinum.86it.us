
      <SCRIPT language=JavaScript>
<!--












var i=0;
var ie=(document.all)?1:0;
var ns=(document.layers)?1:0;

function initStyleElements() /* Styles for Buttons Init */
	{
		var c = document.pad;
		if (ie)
			{
				//c.text.style.backgroundColor="#c0c0c0";
				c.compileIt.style.backgroundColor="#999999";
				c.compileIt.style.cursor="hand";
				c.select.style.backgroundColor="#000000";
				c.select.style.cursor="hand";
				c.view.style.backgroundColor="#000000";
				c.view.style.cursor="hand";
				c.retur.style.backgroundColor="#000000";
				c.retur.style.cursor="hand";
				c.clear.style.backgroundColor="#000000";
				c.clear.style.cursor="hand";
			}
		else return;
	}

/* Buttons Enlightment of "Compilation" panel */
function LightOn(what)
	{
		if (ie) what.style.backgroundColor = '#999999';
		else return;
	}
function FocusOn(what)
	{
		if (ie) what.style.backgroundColor = '#999999';
		else return;
	}
function LightOut(what)
	{
		if (ie) what.style.backgroundColor = '#999999';
		else return;
	}
function FocusOff(what)
	{
		if (ie) what.style.backgroundColor = '#999999';
		else return;
	}
/* Buttons Enlightment of "Compilation" panel */

function generate() /* Generation of "Compilation" */
	{
		code = document.pad.text.value;
		if (code)
			{
				document.pad.text.value='Compiling...Please wait!';
				setTimeout("compile()",1000);
			}
		else alert('First enter something to compile and then press CompileIt')
	}
function compile() /* The "Compilation" */
	{
		document.pad.text.value='';
		compilation=escape(code);
		document.pad.text.value="<script>\n<!--\ndocument.write(unescape(\""+compilation+"\"));\n//-->\n<\/script>";

	}
function selectCode() /* Selecting "Compilation" for Copying */
	{
		if(document.pad.text.value.length>0)
			{
				document.pad.text.focus();
				document.pad.text.select();
			}
		else alert('Nothing for be selected!')
	}
function preview() /* Preview for the "Compilation" */
	{
		if(document.pad.text.value.length>0)
			{
				pr=window.open("","Preview","scrollbars=1,menubar=1,status=1,width=700,height=320,left=50,top=110");
				pr.document.write(document.pad.text.value);
			}
		else alert('Nothing for be previewed!')
	}
function uncompile() /* Decompiling a "Compilation" */
	{
		if (document.pad.text.value.length>0)
			{
				source=unescape(document.pad.text.value);
				document.pad.text.value=""+source+"";
			}
		else alert('You need compiled code to uncompile it!')
	}
// -->
      </SCRIPT>
