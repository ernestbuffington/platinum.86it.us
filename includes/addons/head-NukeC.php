<?php
// Start NukeC javascript
function getThumbName($ximageads) {
	$ImgName = explode(".",$ximageads);
	return $ImgName[0]."_thumb.".$ImgName[1];
}
	echo "<script type=\"text/javascript\">\n"
		."<!--\n";
	echo "function showNukeCCatgimage() {\n";
    echo "if (!document.images)\n";
    echo "return\n";
    echo "document.images.imagecatg.src=\n";
    echo "'".$nukeurl."/modules/NukeC/imagecatg/' + document.NukeCCatgForm.catgimage.options[document.NukeCCatgForm.catgimage.selectedIndex].value\n";
	echo "}\n";
	echo "//-->\n";
	echo "</script>\n";

	echo "<script type=\"text/javascript\">\n"
		."<!--\n";
	echo "function showNukeCCatgimage2() {\n";
    echo "if (!document.images)\n";
    echo "return\n";
    echo "document.images.imagecatg2.src=\n";
    echo "'".$nukeurl."/modules/NukeC/imagecatg/' + document.NukeCCatgForm2.catgimage.options[document.NukeCCatgForm2.catgimage.selectedIndex].value\n";
	echo "}\n";
	echo "//-->\n";
	echo "</script>\n";
// End NukeC javascript
?>