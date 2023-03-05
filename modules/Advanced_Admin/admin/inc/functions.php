<?php
function aa_yesno_option($name, $value=0) {
    $value = ($value>0) ? 1 : 0;
    $sel[$value] = ' checked="checked"';
    return '<input type="radio" name="'.$name.'" id="'.$name.'" value="1"'.$sel[1].' /><label for="'.$name.'">'._YES.'</label><input type="radio" name="'.$name.'" id="'.$name.'" value="0" '.$sel[0].' /><label for="'.$name.'">'._NO.'</label> ';
}
?>