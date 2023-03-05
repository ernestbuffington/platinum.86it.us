<?php
define('_rnSTEP3a','Step 1');
define('_rnSTEP3b','Step 2');
define('_rnSTEP3c','Step 3');
define('_rnSTEP3d','Step 4');
define('_rnSTEP3e','Step 5');
define('_rnSTEP3f','Step 6');
define('_rnSTEP3g','Step 7');
define('_rnSTEP3h','Step 8');
define('_rnSUBMIT','submit');
define('_rnLOAD_CORE_TABLES','Load Core Tables');
define('_rnLOAD_NUKESENTINEL_TABLES','Load NukeSentinel&trade; Tables');
define('_rnLOAD_IP2COUNTRY_DATA','Load IP2COUNTRY Data');
define('_rnLOAD_IP2COUNTRY_DATA1_8' ,'Load IP2COUNTRY Data Part 1/8');
define('_rnLOAD_IP2COUNTRY_DATA2_8' ,'Load IP2COUNTRY Data Part 2/8');
define('_rnLOAD_IP2COUNTRY_DATA3_8' ,'Load IP2COUNTRY Data Part 3/8');
define('_rnLOAD_IP2COUNTRY_DATA4_8' ,'Load IP2COUNTRY Data Part 4/8');
define('_rnLOAD_IP2COUNTRY_DATA5_8' ,'Load IP2COUNTRY Data Part 5/8');
define('_rnLOAD_IP2COUNTRY_DATA6_8' ,'Load IP2COUNTRY Data Part 6/8');
define('_rnLOAD_IP2COUNTRY_DATA7_8' ,'Load IP2COUNTRY Data Part 7/8');
define('_rnLOAD_IP2COUNTRY_DATA8_8' ,'Load IP2COUNTRY Data Part 8/8');
define('_rnIP2COUNTRY_NOTE','The NukeSentinel&trade; IP2Country table is very large so it is divided into STEPS 1-8.');
define('_rnALL_RIGHTS','All Rights Reserved');
define('_rnNO_PORTION','No portion of this document/code may be copied, changed, redistributed, nor reproduced without the written permission of');
define('_rnCOPYRIGHT','Copyright');
define('_rnLOADED','Loaded!');
define('_rnPROCESSED_IN','Instructions processed in');
define('_rnS','s');
define('_rnNOT_LOADED','Not Loaded');


include_once('header.php');
OpenTable();
?>
		<table>
      <tr>
        <td>
		<table><tr><td>
          <form name="lip1" method="post" action="<?php $_SERVER['PHP_SELF'];?>">
			<hr />
			<p id="ip2cnote">&nbsp;:&nbsp;&nbsp;<?php echo _rnLOAD_IP2COUNTRY_DATA;?>
            :&nbsp;<?php echo _rnIP2COUNTRY_NOTE;?>
			</p>
			<hr />
            <input class="button" type="submit" name="<?php echo _rnSUBMIT;?>" value="<?php echo _rnSTEP3a;?>&nbsp;:&nbsp;&nbsp;<?php echo _rnLOAD_IP2COUNTRY_DATA1_8;?>" />
            &nbsp;&nbsp;<span class="c3"><input class="inputbox" name="session" value="<?php echo $_SESSION['lip1'];?>" readonly="readonly" size="75" onfocus="blur()" /></span>
            <input type="hidden" name="op" value="lip1" />
          </form>
		</td></tr></table>
		</td>
	</tr>
      <tr>
        <td>
		<table><tr><td>
          <form name="lip2" method="post" action="<?php $_SERVER['PHP_SELF'];?>">
            <input class="button" type="submit" name="<?php echo _rnSUBMIT;?>" value="<?php echo _rnSTEP3b;?>&nbsp;:&nbsp;&nbsp;<?php echo _rnLOAD_IP2COUNTRY_DATA2_8;?>" />
            &nbsp;&nbsp;<span class="c3"><input class="inputbox" name="session" value="<?php echo $_SESSION['lip2'];?>" readonly="readonly" size="75" onfocus="blur()" /></span>
            <input type="hidden" name="op" value="lip2" />
          </form>
		</td></tr></table>
		</td>
	</tr>
      <tr>
        <td>
		<table><tr><td>
          <form name="lip3" method="post" action="<?php $_SERVER['PHP_SELF'];?>">
            <input class="button" type="submit" name="<?php echo _rnSUBMIT;?>" value="<?php echo _rnSTEP3c;?>&nbsp;:&nbsp;&nbsp;<?php echo _rnLOAD_IP2COUNTRY_DATA3_8;?>" />
            &nbsp;&nbsp;<span class="c3"><input class="inputbox" name="session" value="<?php echo $_SESSION['lip3'];?>" readonly="readonly" size="75" onfocus="blur()" /></span>
            <input type="hidden" name="op" value="lip3" />
          </form>
		</td></tr></table>
		</td>
	</tr>
	<tr>
		<td>
		<table><tr><td>
          <form name="lip4" method="post" action="<?php $_SERVER['PHP_SELF'];?>">
            <input class="button" type="submit" name="<?php echo _rnSUBMIT;?>" value="<?php echo _rnSTEP3d;?>&nbsp;:&nbsp;&nbsp;<?php echo _rnLOAD_IP2COUNTRY_DATA4_8;?>" />
            &nbsp;&nbsp;<span class="c3"><input class="inputbox" name="session" value="<?php echo $_SESSION['lip4'];?>" readonly="readonly" size="75" onfocus="blur()" /></span>
            <input type="hidden" name="op" value="lip4" />
          </form>
		  </td></tr></table>
		 </td>
	</tr>
	<tr>
		<td>
		<table><tr><td>
          <form name="lip5" method="post" action="<?php $_SERVER['PHP_SELF'];?>">
            <input class="button" type="submit" name="<?php echo _rnSUBMIT;?>" value="<?php echo _rnSTEP3e;?>&nbsp;:&nbsp;&nbsp;<?php echo _rnLOAD_IP2COUNTRY_DATA5_8;?>" />
            &nbsp;&nbsp;<span class="c3"><input class="inputbox" name="session" value="<?php echo $_SESSION['lip5'];?>" readonly="readonly" size="75" onfocus="blur()" /></span>
            <input type="hidden" name="op" value="lip5" />
          </form>
		  </td></tr></table>
		 </td>
	</tr>
	<tr>
		<td>
		<table><tr><td>
          <form name="lip6" method="post" action="<?php $_SERVER['PHP_SELF'];?>">
            <input class="button" type="submit" name="<?php echo _rnSUBMIT;?>" value="<?php echo _rnSTEP3f;?>&nbsp;:&nbsp;&nbsp;<?php echo _rnLOAD_IP2COUNTRY_DATA6_8;?>" />
            &nbsp;&nbsp;<span class="c3"><input class="inputbox" name="session" value="<?php echo $_SESSION['lip6'];?>" readonly="readonly" size="75" onfocus="blur()" /></span>
            <input type="hidden" name="op" value="lip6" />
          </form>
		  </td></tr></table>
		 </td>
	</tr>
	<tr>
		<td>
		<table><tr><td>
          <form name="lip7" method="post" action="<?php $_SERVER['PHP_SELF'];?>">
            <input class="button" type="submit" name="<?php echo _rnSUBMIT;?>" value="<?php echo _rnSTEP3g;?>&nbsp;:&nbsp;&nbsp;<?php echo _rnLOAD_IP2COUNTRY_DATA7_8;?>" />
            &nbsp;&nbsp;<span class="c3"><input class="inputbox" name="session" value="<?php echo $_SESSION['lip7'];?>" readonly="readonly" size="75" onfocus="blur()" /></span>
            <input type="hidden" name="op" value="lip7" />
          </form>
		  </td></tr></table>
		 </td>
	</tr>
	<tr>
		<td>
		<table><tr><td>
          <form name="lip8" method="post" action="<?php $_SERVER['PHP_SELF'];?>">
            <input class="button" type="submit" name="<?php echo _rnSUBMIT;?>" value="<?php echo _rnSTEP3h;?>&nbsp;:&nbsp;&nbsp;<?php echo _rnLOAD_IP2COUNTRY_DATA8_8;?>" />
            &nbsp;&nbsp;<span class="c3"><input class="inputbox" name="session" value="<?php echo $_SESSION['lip8'];?>" readonly="readonly" size="75" onfocus="blur()" /></span>
            <input type="hidden" name="op" value="lip8" />
          </form>
		  </td></tr></table>
        </td>
      </tr>

    </table>
<?php if ($_GET['setup']) {echo '<div class="c1"><p id="proceed">'._rnREADY_TO_PROCEED.'</p></div>'; session_destroy(); $_GET['setup']='';} ?>
    <hr />

<?php
/*<![CDATA[*/
/*
Validate $_POST Data
*/
/*]]>*/
if (!isset($_POST['op'])) $_POST['op'] = '';
if (!isset($_POST[_rnSUBMIT])) $_POST[_rnSUBMIT] = '';
$isValidOp = FALSE;
$validOp = array('lsec','lct','lns','lip1','lip2','lip3','lip4','lip5','lip6','lip7','lip8');
if (strlen($_POST['op'])>0 AND (strlen($_POST['op'])==3 OR strlen($_POST['op'])==4)) {
    if (in_array($_POST['op'],$validOp)) {
        $isValidOp = TRUE;
    }
    else {
        rnInstallErr(90);
        die();
    }
}
reset($_POST);
if (strlen($_POST[_rnSUBMIT])>0 AND $isValidOp AND $_POST['op']!=='lsec') {
    if ($_POST['op']=='lct')
        $rnSql = '';
    elseif ($_POST['op']=='lns')
        $rnSql = '';
    elseif ($_POST['op']=='lip1')
        $rnSql = array(
            'rnIP2Country1Sql'=>'rn_ip2c1.sql.gz',
            'rnIP2Country2Sql'=>'rn_ip2c2.sql.gz');
    elseif ($_POST['op']=='lip2')
        $rnSql = array(
            'rnIP2Country3Sql'=>'rn_ip2c3.sql.gz',
            'rnIP2Country4Sql'=>'rn_ip2c4.sql.gz');
    elseif ($_POST['op']=='lip3')
        $rnSql = array(
            'rnIP2Country5Sql'=>'rn_ip2c5.sql.gz',
            'rnIP2Country6Sql'=>'rn_ip2c6.sql.gz');
    elseif ($_POST['op']=='lip4')
        $rnSql = array(
            'rnIP2Country7Sql'=>'rn_ip2c7.sql.gz',
            'rnIP2Country8Sql'=>'rn_ip2c8.sql.gz');
    elseif ($_POST['op']=='lip5')
        $rnSql = array(
            'rnIP2Country9Sql'=>'rn_ip2c9.sql.gz',
            'rnIP2Country10Sql'=>'rn_ip2c10.sql.gz');
    elseif ($_POST['op']=='lip6')
        $rnSql = array(
            'rnIP2Country11Sql'=>'rn_ip2c11.sql.gz',
            'rnIP2Country12Sql'=>'rn_ip2c12.sql.gz');
    elseif ($_POST['op']=='lip7')
        $rnSql = array(
            'rnIP2Country13Sql'=>'rn_ip2c13.sql.gz',
            'rnIP2Country14Sql'=>'rn_ip2c14.sql.gz');
    elseif ($_POST['op']=='lip8')
        $rnSql = array(
            'rnIP2Country15Sql'=>'rn_ip2c15.sql.gz',
            'rnIP2Country16Sql'=>'rn_ip2c16.sql.gz');
    else {rnInstallErr(91); die();}

/*<![CDATA[*/
/*MysQL dump comment types*/
/*]]>*/
$sqlFolder = 'ip2c/';
    $totalCnt = 0;
    $mtime = microtime();
    $mtime = explode(' ',$mtime);
    $mtime = $mtime[1] + $mtime[0];
    $start_time = $mtime;
    foreach ($rnSql as $key => $value) {
        if (strpos($value,'.gz')===false)
           $lines = file($sqlFolder.$value);
        else
           $lines = gzfile($sqlFolder.$value);
        $lines = str_replace('$prefix.`',"`$prefix",$lines);
        $lines = str_replace('$user_prefix.`',"`$user_prefix",$lines);
        $cnt=0;
        $lineNumberInFile=0;
        foreach ($lines as $line) {
            $lineNumberInFile++;
            if ($line=="\n"||$line=="\r\n") continue;
			if ($byPassTableLock===true && (strtoupper(substr($line,0,11))=='LOCK TABLES' || strtoupper(substr($line,0,13))=='UNLOCK TABLES')) continue;
            $cont=FALSE;
            for ($i=0;$i<count($comment);$i++) {
                if (substr($line,0,strlen($comment[$i]-1))==$comment[$i]) $cont=TRUE;;
            }
            if ($cont) continue;
            if (empty($line)||strlen($line)==0) continue;
            $cnt++;
            $rc = mysqli_query($db, $line);
            if (!$rc AND !in_array(mysqli_errno(),$byPassSqlErrors))  {rnInstallErr(4,$value,$lineNumberInFile,$line); die();}
        }
        $totalCnt+=$cnt;
    }
    $mtime = microtime();
    $mtime = explode(' ',$mtime);
    $mtime = $mtime[1] + $mtime[0];
    $endtime = $mtime;
    $total_time = round(($endtime - $start_time), 4);
    if ($isValidOp) {
        if ($_POST['op']=='lct') {
            $_SESSION['lct']=_rnLOADED.' '.$totalCnt.' '._rnPROCESSED_IN.' '. $total_time ._rnS;
            echo '<script>document.lct.session.value="'.$_SESSION['lct'].'";</script>';
            unset($_SESSION['lre']);
            unset($_SESSION['lgt']);
            unset($_SESSION['lhnl']);
            unset($_SESSION['lns']);
            unset($_SESSION['lgc']);
            unset($_SESSION['lip1']);
            unset($_SESSION['lip2']);
            unset($_SESSION['lip3']);
            unset($_SESSION['lip4']);
            unset($_SESSION['lip5']);
            unset($_SESSION['lip6']);
            unset($_SESSION['lip7']);
            unset($_SESSION['lip8']);
            unset($_SESSION['noip2c']);
        }
        if ($_POST['op']=='lns') {
            $_SESSION['lns']=_rnLOADED.' '.$totalCnt.' '._rnPROCESSED_IN.' '. $total_time ._rnS;
            echo '<script>document.lns.session.value="'.$_SESSION['lns'].'";</script>';
            unset($_SESSION['lgc']);
            unset($_SESSION['lip1']);
            unset($_SESSION['lip2']);
            unset($_SESSION['lip3']);
            unset($_SESSION['lip4']);
            unset($_SESSION['lip5']);
            unset($_SESSION['lip6']);
            unset($_SESSION['lip7']);
            unset($_SESSION['lip8']);
            unset($_SESSION['noip2c']);
        }
        $setup = false;
        $_SESSION['noip2c'] = false;
        if ($_POST['op']=='lip1') {
            $_SESSION['lip1']=_rnLOADED.' '.$totalCnt.' '._rnPROCESSED_IN.' '. $total_time ._rnS;
            echo '<script>document.lip1.session.value="'.$_SESSION['lip1'].'";</script>';
        }
        elseif ($_POST['op']=='lip2') {
            $_SESSION['lip2']=_rnLOADED.' '.$totalCnt.' '._rnPROCESSED_IN.' '. $total_time ._rnS;
            echo '<script>document.lip2.session.value="'.$_SESSION['lip2'].'";</script>';
        }
        elseif ($_POST['op']=='lip3') {
            $_SESSION['lip3']=_rnLOADED.' '.$totalCnt.' '._rnPROCESSED_IN.' '. $total_time ._rnS;
            echo '<script>document.lip3.session.value="'.$_SESSION['lip3'].'";</script>';
        }
        elseif ($_POST['op']=='lip4') {
            $_SESSION['lip4']=_rnLOADED.' '.$totalCnt.' '._rnPROCESSED_IN.' '. $total_time ._rnS;
            echo '<script>document.lip4.session.value="'.$_SESSION['lip4'].'";</script>';
        }
        elseif ($_POST['op']=='lip5') {
            $_SESSION['lip5']=_rnLOADED.' '.$totalCnt.' '._rnPROCESSED_IN.' '. $total_time ._rnS;
            echo '<script>document.lip5.session.value="'.$_SESSION['lip5'].'";</script>';
        }
        elseif ($_POST['op']=='lip6') {
            $_SESSION['lip6']=_rnLOADED.' '.$totalCnt.' '._rnPROCESSED_IN.' '. $total_time ._rnS;
            echo '<script>document.lip6.session.value="'.$_SESSION['lip6'].'";</script>';
        }
        elseif ($_POST['op']=='lip7') {
            $_SESSION['lip7']=_rnLOADED.' '.$totalCnt.' '._rnPROCESSED_IN.' '. $total_time ._rnS;
            echo '<script>document.lip7.session.value="'.$_SESSION['lip7'].'";</script>';
        }
        elseif ($_POST['op']=='lip8') {
            $_SESSION['lip8']=_rnLOADED.' '.$totalCnt.' '._rnPROCESSED_IN.' '. $total_time ._rnS;
            echo '<script>document.lip8.session.value="'.$_SESSION['lip8'].'";</script>';
            $setup = true; // Only use this with the last step as it triggers the Proceed to setup message
        }
    }
}
CloseTable();
include_once('footer.php');
?>