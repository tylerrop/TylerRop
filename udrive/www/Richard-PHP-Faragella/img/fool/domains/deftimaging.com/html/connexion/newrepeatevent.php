<?php require_once("php/connection.php"); ?>
<?php 	/*set user id var*/ $idc = 1;//!!	?>
<?php
if (is_numeric($_GET['edid'])) {// check if editing.
	$edid = (int)$_GET['edid'];
	if (is_int($edid)) {//check if edid is valid iteger and set var
		if (!isset($_POST['cnre'])) {	
			$query = "SELECT idc, nme, loca, dsc, patern, sdte, edte, stme, etme, ctgry ";
			$query .= "FROM rpe ";
			$query .= "WHERE id = " . $edid . " ";
			$query .= "LIMIT 0 , 1 ";
			
			$result = mysql_query($query, $connection);
			if (isset($result)) {
	//			echo $query;
				$row = mysql_fetch_array($result);
				
				foreach($row as $key => $value) {// get db variables
					$$key = $value; 
	//				echo $key . "=>" . $value . "<br />";
				}// get db vars
				//interprit
				
				// interprit ctgry
				$ctgry = substr($ctgry, 2, (strlen($ctgry)-4));				
				
				//interprit time
				$stme = str_split($stme, 2);
				$etme = str_split($etme, 2);
				$stm = $stme[1];
				$etm = $etme[1];
				if ($stme[0] > 12) {$sth = ($stme[0] - 12); $stp = "pm";} else {$sth = ($stme[0]); $stp = "am";}
				if ($etme[0] > 12) {$eth = ($etme[0] - 12); $etp = "pm";} else {$eth = ($etme[0]); $etp = "am";}
				//interprit date
				$sdte = str_split($sdte, 2);
				$sdy = $sdte[0]; $sdm = $sdte[1]; $sdd = $sdte[2]; 
				$edte = str_split($edte, 2);
				$edy = $edte[0]; $edm = $edte[1]; $edd = $edte[2];
				//interprit patern
				$patern = explode(":", $patern);
//				print_r($patern);
				if ($patern[0] == "e") {
					$edaysofweek = explode(",", $patern[1]);
//					print_r($edaysofweek);
					foreach ($edaysofweek as $var) {$var = "e" . $var; $$var = 1;}
				} elseif ($patern[0] == "d") {
					$date = $patern[1];
				} else {$every = $patern[0]; $day = $patern[1];}
			} else {
				$msg = "The event id \"" . $edid . "\" was not found.";
				$edid = "not editing";
			}
		} else {//if post's subit is set
			
			// get form variables
			foreach($_POST as $key => $value) {
				$$key = $value; 
//				echo $key . "=>" . $value . "<br />";
			}	
			
			//encode paterns
			$pnum = array();
			//patern 1
			if ($emo != NULL || $etu != NULL || $ewe != NULL || $etr != NULL || $efr != NULL || $esa != NULL || $esu != NULL) {
				$dotws = array($emo, $etu, $ewe, $etr, $efr, $esa, $esu);
		//		print_r($dotws);
				foreach($dotws as $key => $value) { 
					if($value == "") { 
					unset($dotws[$key]); 
					} 
				} 
		//		print_r($dotws);
				$patern = "e:";
				foreach($dotws as $value) { 
					$patern .= $value . ",";
				}
				$patern = substr_replace($patern ,"",-1);
				$pnum[1] = 1; 
			//patern 2
			}
			if ($every != NULL && $day != NULL) {
				if ($patern != NULL) {
					$e_patern = 1;
				} else {
					$patern = $every . ":" . $day;
				}
				$pnum[2] = 2; 
			}
			//patern 3
			if ($date != NULL) {
				if ($patern != NULL) {
					$e_patern = 1;
				} else {
					$patern = "d:" . $date;
				}
				$pnum[3] = 3; 
			}
			
			//find missing values
			if ($nme == NULL) {$errs["nme"] = 1;}
			if ($loca == NULL) {$errs["loca"] = 1;}
			if ($dsc == NULL) {$errs["dsc"] = 1;}
			if ($patern == NULL && ($every == NULL XOR $day == NULL)) {$errs["patern2"] = 1;} // means one element from patern 2 is missing and no other pater is set.
			if ($errs["patern2"] == 1 && $every != NULL) {$errs["patern2"] = "b";}
			if ($errs["patern2"] == 1 && $day != NULL) {$errs["patern2"] = "a";}
			if ($patern == NULL && !isset($errs["patern2"]) ) {$errs["patern"] = 1;}
			//check for multiple paterns
			if ($e_patern != NULL) {$errs["patenrep"] = array(1, $pnum);}
			
			//reset every and date vars if need be
			if ($patern != NULL && ($every == NULL XOR $day == NULL)) { $every = NULL; $day = NULL;}
			//check end date 
			if (!(($edd == 0 && $edm == 0 && $edy == 0) || ($edd != 0 && $edm != 0 && $edy != 0))) {$errs["edte"] = 1;}
		
		//	print_r($errs);
		
		
			if (!isset($errs)) {
			
				// make ctgry safe for db
				$ctrydb = ", " . $ctgry . ", ";

				//assemble end date vars
				if (isset($edd, $edm, $edy)) {
					$edte = str_pad($edy, 2, 0, STR_PAD_LEFT) . str_pad($edm, 2, 0, STR_PAD_LEFT) . str_pad($edd, 2, 0, STR_PAD_LEFT);
				} else {
					$edte = NULL;
				}
				// assemble start date
				$sdte = str_pad($sdy, 2, 0, STR_PAD_LEFT) . str_pad($sdm, 2, 0, STR_PAD_LEFT) . str_pad($sdd, 2, 0, STR_PAD_LEFT);

				//Prosess houres (12h > 24h)
				if (($stp == "pm" && $sth != 12) || ($stp == "am" && $sth == 12)) {
					$sthn = $sth + 12;
				} else {$sthn = $sth;}
				if (($etp == "pm" && $eth != 12) || ($etp == "am" && $eth == 12)) {
					$ethn = $eth + 12;
				} else {$ethn = $eth;}
		
				//set time vars
				$stme = str_pad($sthn, 2, 0, STR_PAD_LEFT) . str_pad($stm, 2, 0, STR_PAD_LEFT);
				$etme = str_pad($ethn, 2, 0, STR_PAD_LEFT) . str_pad($etm, 2, 0, STR_PAD_LEFT);

				// Send to server.
				$query =	"UPDATE  `rpe` SET `nme` =  '{$nme}',
							`loca` =  '{$loca}',
							`dsc` =  '{$dsc}',
							`patern` =  '{$patern}',
							`sdte` =  '{$sdte}',
							`edte` =  '{$edte}',
							`stme` =  '{$stme}',
							`etme` =  '{$etme}',
							`ctgry` =  '{$ctgry}' WHERE  `rpe`.`id` ='{$edid}'";
//				echo $query;
				
				$result = mysql_query($query, $connection);
				if ($result) {
					$msg .= "<h3 class=\"goodHead\">The event: \"$nme\" has been updated. </h3><h3>You are now editing \"$nme\".</h3><h3> If you wish to create a new singaly occuring event, Click <a href=\"". $PHP_SELF ."?edid=not editing\">here</a>.</h3>";		
				} else {// what hapens if it fails to get to the db
				
				}
			} else {// if is errs is set
				$msg .= "<h3>You are now editing \"$nme\".</h3><h3 class=\"problemHead\"> Please check form for mistakes. </h3>";
			}
			
		}// kill if $_POST's submit is set
	}
} elseif (isset($_POST['cnre'])) {
	
	// get form variables
	foreach($_POST as $key => $value) {
		$$key = $value; 
//		echo $key . "=>" . $value . "<br />";
	}	
	
	
	//encode paterns
	$pnum = array();
	//patern 1
	if ($emo != NULL || $etu != NULL || $ewe != NULL || $etr != NULL || $efr != NULL || $esa != NULL || $esu != NULL) {
		$dotws = array($emo, $etu, $ewe, $etr, $efr, $esa, $esu);
//		print_r($dotws);
		foreach($dotws as $key => $value) { 
			if($value == "") { 
			unset($dotws[$key]); 
  			} 
		} 
//		print_r($dotws);
		$patern = "e:";
		foreach($dotws as $value) { 
			$patern .= $value . ",";
		}
		$patern = substr_replace($patern ,"",-1);
		$pnum[1] = 1; 
	//patern 2
	}
	if ($every != NULL && $day != NULL) {
		if ($patern != NULL) {
			$e_patern = 1;
		} else {
			$patern = $every . ":" . $day;
		}
		$pnum[2] = 2; 
	}
	//patern 3
	if ($date != NULL) {
		if ($patern != NULL) {
			$e_patern = 1;
		} else {
			$patern = "d:" . $date;
		}
		$pnum[3] = 3; 
	}
	//find missing values
	if ($nme == NULL) {$errs["nme"] = 1;}
	if ($loca == NULL) {$errs["loca"] = 1;}
	if ($dsc == NULL) {$errs["dsc"] = 1;}
	if ($patern == NULL && ($every == NULL XOR $day == NULL)) {$errs["patern2"] = 1;} // means one element from patern 2 is missing and no other pater is set.
	if ($errs["patern2"] == 1 && $every != NULL) {$errs["patern2"] = "b";}
	if ($errs["patern2"] == 1 && $day != NULL) {$errs["patern2"] = "a";}
	if ($patern == NULL && !isset($errs["patern2"]) ) {$errs["patern"] = 1;}
	//check for multiple paterns
	if ($e_patern != NULL) {$errs["patenrep"] = array(1, $pnum);}
	
	//reset every and date vars if need be
	if ($patern != NULL && ($every == NULL XOR $day == NULL)) { $every = NULL; $day = NULL;}
	//check end date 
	if (!(($edd == 0 && $edm == 0 && $edy == 0) || ($edd != 0 && $edm != 0 && $edy != 0))) {$errs["edte"] = 1;}

//	print_r($errs);


	if (!isset($errs)) {
	
		// make ctgry safe for db
		$ctrydb = ", " . $ctgry . ", ";

		//assemble end date vars
		if (isset($edd, $edm, $edy)) {
			$edte = str_pad($edy, 2, 0, STR_PAD_LEFT) . str_pad($edm, 2, 0, STR_PAD_LEFT) . str_pad($edd, 2, 0, STR_PAD_LEFT);
		} else {
			$edte = NULL;
		}
		// assemble start date
		$sdte = str_pad($sdy, 2, 0, STR_PAD_LEFT) . str_pad($sdm, 2, 0, STR_PAD_LEFT) . str_pad($sdd, 2, 0, STR_PAD_LEFT);

		//Prosess houres (12h > 24h)
		if (($stp == "pm" && $sth != 12) || ($stp == "am" && $sth == 12)) {
			$sthn = $sth + 12;
		} else {$sthn = $sth;}
		if (($etp == "pm" && $eth != 12) || ($etp == "am" && $eth == 12)) {
			$ethn = $eth + 12;
		} else {$ethn = $eth;}

		//set time vars
		$stme = str_pad($sthn, 2, 0, STR_PAD_LEFT) . str_pad($stm, 2, 0, STR_PAD_LEFT);
		$etme = str_pad($ethn, 2, 0, STR_PAD_LEFT) . str_pad($etm, 2, 0, STR_PAD_LEFT);

		// Send to server.
		$query = 	"INSERT INTO rpe ";
		$query .=	"(nme, loca, dsc, patern, sdte, edte, stme, etme, ctgry, idc) ";
		$query .=	"VALUES ('{$nme}', '{$loca}', '{$dsc}', '{$patern}', '{$sdte}', '{$edte}', '{$stme}', '{$etme}', '{$ctgry}', '{$idc}') ";
		
		$result = mysql_query($query, $connection);
		if ($result) {
			$edid = mysql_insert_id();
			$msg .= "<h3 class=\"goodHead\"> The event: \"$nme\" has been created. </h3><h3>You are now editing \"$nme\".</h3><h3> If you wish to create a new singaly occuring event, Click <a href=\"". $PHP_SELF ."?edid=not editing\">here</a>.</h3>";		
		} else {// what hapens if it fails to get to the db
			$msg .= "<h3 class=\"problemHead\"> Please check form for mistakes. </h3>";
		}
	} else {// if is errs is set
		$msg .= "<h3 class=\"problemHead\"> The Server is experiencing an error. Please try again later. </h3>";
	}
}


?>
<?php

$page = "events";
$css = "eventform";

include("php/headedit.php");

?>



<div class="main"> <div id="pageImage" style="background-image:url(page/big/<?php echo $page; ?>.jpg);"> <div class="sectionTitle"><h1><?php echo "Events"; ?></h1> </div> </div> 

<div class="textAria"> 


<h2><?php if (isset($edid) && $edid != "not editing") {echo "Edit Repeating Event Called: \"$nme\"";} else {echo "Create New Repeating Event";} ?></h2>

<?php if (isset($msg)) {echo $msg;} ?>

<form action="<?php echo $PHP_SELF; if (isset($edid) && $edid != "not editing") {echo "?edid=$edid";} ?>" method="post">

<fieldset>

<legend>Basic Information</legend>
<label for="nme">Event Title</label> <br />
<input type="text" name="nme" id="nme" class="ititle<?php if ($errs["nme"] == 1) {echo " fieldErr";} echo"\" value=\"$nme\""  ?> /> <br />
<label for="loca">Location</label> <br />
<input type="text" name="loca" id="loca" class="itext<?php if ($errs["loca"] == 1) {echo " fieldErr";} echo"\" value=\"$loca\""  ?> /> <br />
<label for="dsc">Description</label> <br />
<textarea id="dsc" name="dsc" class="textarea <?php if ($errs["dsc"] == 1) {echo " fieldErr";} ?>" style="width:100%; height:15em;"><?php echo $dsc;  ?></textarea>


</fieldset>

<fieldset <?php if ($errs["patern"] == 1) {echo "class=\"fieldErr\"";} ?>>

<legend <?php if ($errs["patern"] == 1) {echo "class=\"fieldErr\"";} ?>>Repitition Patern</legend>
<h4 <?php if ($errs["patenrep"][0] == 1) { echo "class=\"problemHead\"";} ?>>Please choose only one patern type</h4>

<fieldset <?php if ($errs["patenrep"][1][1] == 1) {echo "class=\"fieldErr\"";} ?>>
<legend <?php if ($errs["patenrep"][1][1] == 1) {echo "class=\"fieldErr\"";} ?>>Patern 1</legend>
The event is schedualed to hapen every: <br />
<label for="emo">Monday</label> <input type="checkbox" name="emo" id="emo" class="check" value="mo" <? if (isset($emo)) { echo"checked=\"checked\"";} ?> />
<label for="etu">Tuesday</label> <input type="checkbox" name="etu" id="etu" class="check" value="tu" <? if (isset($etu)) { echo"checked=\"checked\"";} ?> />
<label for="ewe">Wednesday</label> <input type="checkbox" name="ewe" id="ewe" class="check" value="we" <? if (isset($ewe)) { echo"checked=\"checked\"";} ?> />
<label for="etr">Thursday</label> <input type="checkbox" name="etr" id="etr" class="check" value="tr" <? if (isset($etr)) { echo"checked=\"checked\"";} ?> />
<label for="efr">Friday</label> <input type="checkbox" name="efr" id="efr" class="check" value="fr" <? if (isset($efr)) { echo"checked=\"checked\"";} ?> />
<label for="esa">Saturday</label> <input type="checkbox" name="esa" id="esa" class="check" value="sa" <? if (isset($esa)) { echo"checked=\"checked\"";} ?> />
<label for="esu">Sunday</label> <input type="checkbox" name="esu" id="esu" class="check" value="su" <? if (isset($esu)) { echo"checked=\"checked\"";} ?> />

</fieldset>
<h4 <?php if ($errs["patenrep"][0] == 1) { echo "class=\"problemHead\"";} ?>>-OR-</h4>
<fieldset <?php if ($errs["patenrep"][1][2] == 2) {echo "class=\"fieldErr\"";} ?>>
<legend <?php if ($errs["patenrep"][1][2] == 2) {echo "class=\"fieldErr\"";} ?>>Patern 2</legend>
The event is schedualed to hapen every: <br />

<select name="every" <?php if ($errs["patern2"] == "a") {echo "class=\"fieldErr\"";} ?>>
  <option value="">Occurence</option>
  <option value="f" <?php if ($every == "f") {echo "selected";} ?>>Every First</option>
  <option value="s" <?php if ($every == "s") {echo "selected";} ?>>Every Seccond</option>
  <option value="t" <?php if ($every == "t") {echo "selected";} ?>>Every Third</option>
  <option value="o" <?php if ($every == "o") {echo "selected";} ?>>Every Fourth</option>
  <option value="l" <?php if ($every == "l") {echo "selected";} ?>>Every Last</option>
</select>

<select name="day" <?php if ($errs["patern2"] == "b") {echo "class=\"fieldErr\"";} ?>>
  <option value="">What Day</option>
  <option value="mo" <?php if ($day == "mo") {echo "selected";} ?>>Monday</option>
  <option value="tu" <?php if ($day == "tu") {echo "selected";} ?>>Tuesday</option>
  <option value="we" <?php if ($day == "we") {echo "selected";} ?>>Wednesday</option>
  <option value="tr" <?php if ($day == "tr") {echo "selected";} ?>>Thursday</option>
  <option value="fr" <?php if ($day == "fr") {echo "selected";} ?>>Friday</option>
  <option value="sa" <?php if ($day == "sa") {echo "selected";} ?>>Saturday</option>
  <option value="su" <?php if ($day == "su") {echo "selected";} ?>>Sunday</option>
</select>
of the month.
</fieldset>
<h4 <?php if ($errs["patenrep"][0] == 1) { echo "class=\"problemHead\"";} ?>>-OR-</h4>
<fieldset <?php if ($errs["patenrep"][1][3] == 3) {echo "class=\"fieldErr\"";} ?>>
<legend <?php if ($errs["patenrep"][1][3] == 3) {echo "class=\"fieldErr\"";} ?>>Patern 3</legend>
The event is schedualed to hapen every: <br />
<select name="date">
  <option value="">What Date</option>
<?php   

$i = 1;
while ($i <= 31) {

	if ($date == $i) { $modify = " value=\"$i\" selected>"; } else { $modify = " value=\"$i\">"; }

	switch (substr($i, -1)) {
		case 1:
			echo "<option $modify" . $i . "st </option>";
			break;
		case 2:
			echo "<option $modify" . $i . "nd </option>";
			break;
		case 3:
			echo "<option $modify" . $i . "rd </option>";
			break;
		default:
		   echo "<option $modify" . $i . "th </option>";
	}// kill switch

$i++;
	 
}

?>
</select>
of every month.

</fieldset>

</fieldset>

<fieldset>

<legend>Time</legend>
<label for="sth">Start Time</label> <br />
<select name="sth" id="sth">
<?php
$i = 01;
while ($i <= 12) {
	
	if ($sth == $i) { $modify = " value=\"$i\" selected>"; } else { $modify = " value=\"$i\">"; }

	echo "<option $modify" . $i . "</option>";
$i++; 
}
?>
</select>
<select name="stm">
<option value="00">00</option>
<option value="15">15</option>
<option value="30">30</option>
<option value="45">45</option>
<option value="00">--</option>
<?php
$i = 1;
while ($i <= 59) {
	$i = str_pad($i, 2, 0, STR_PAD_LEFT);
	if ($stm == $i) { $modify = " value=\"$i\" selected>"; } else { $modify = " value=\"$i\">"; }

	echo "<option $modify" . $i . "</option>";
$i++; 
}
?>
</select>
<select name="stp">
<option value="am">am</option>
<option value="pm"<?php if ($stp == "pm") { echo "selected"; } ?> >pm</option>
</select>
<br />

<label for="eth">End Time</label> <br />

<select name="eth" id="eth">
<?php
$i = 1;
while ($i <= 12) {
		
	if ($eth == $i) { $modify = " value=\"$i\" selected>"; } else { $modify = " value=\"$i\">"; }

	echo "<option $modify" . $i . "</option>";
$i++; 
}
?>
</select>
<select name="etm">
<option value="00">00</option>
<option value="15">15</option>
<option value="30">30</option>
<option value="45">45</option>
<option value="00">--</option>
<?php
$i = 1;
while ($i <= 59) {
	$i = str_pad($i, 2, 0, STR_PAD_LEFT);
	if ($etm == $i) { $modify = " value=\"$i\" selected>"; } else { $modify = " value=\"$i\">"; }

	echo "<option $modify" . $i . "</option>";
$i++; 
}
?>
</select>
<select name="etp">
<option value="am">am</option>
<option value="pm"<?php if ($etp == "pm") { echo "selected"; } ?> >pm</option>
</select>
<br />

</fieldset>

<fieldset>

<legend>Time Span</legend>

<label for="sdm">Start Date</label>
<br />
<select name="sdm" id="sdm">
<?php
$thecur = date(n);
$i = 1;
while ($i <= 12) {
	$i = str_pad($i, 2, 0, STR_PAD_LEFT);
	if ($sdm == $i || (!isset($sdm) && $i == $thecur)) { $modify = " value=\"$i\" selected>"; } else { $modify = " value=\"$i\">"; }

	switch ($i) {
		case 1:
			$m = "January";
			break;
		case 2:
			$m = "February";
			break;
		case 3:
			$m = "March";
			break;
		case 4:
			$m = "April";
			break;
		case 5:
			$m = "May";
			break;
		case 6:
			$m = "June";
			break;
		case 7:
			$m = "July";
			break;
		case 8:
			$m = "August";
			break;
		case 9:
			$m = "September";
			break;
		case 10:
			$m = "October";
			break;
		case 11:
			$m = "November";
			break;
		case 12:
			$m = "December";
			break;
	}// kill switch


	echo "<option $modify" . $m . "</option>";
	$i++; 
}

echo "</select>";



echo "<select name=\"sdd\">";
$thecur = date(j);
$i = 1;
while ($i <= 31) {

if ($sdd == $i || (!isset($sdd) && $i == $thecur)) {$modify = "selected";} else {$modify = "";}

switch (substr($i, -1)) {
	case 1:
		echo "<option value=\"$i\" $modify >" . $i . "st </option>";
		break;
	case 2:
		echo "<option value=\"$i\" $modify >" . $i . "nd </option>";
		break;
	case 3:
		echo "<option value=\"$i\" $modify >" . $i . "rd </option>";
		break;
	default:
	   echo "<option value=\"$i\" $modify >" . $i . "th </option>";
}// kill switch


$i++;
	 
}

echo "</select>".

"<select name=\"sdy\">";

$thecuryear = date(y);
$i = ($thecuryear);
$finalyear = ($i + 6);

while ($i <= $finalyear) {

if ($sdy == $i || (!isset($sdy) && $i == $thecuryear)) {$modify = "selected"; $value = "20".$i;} else {$modify = ""; $value = "20".$i;}
echo "<option value=\"".$i."\" " . $modify . ">$value</option>";
$i++;
}

echo "</select>".
"<br  />";

if ($errs["edte"] == 1) {$reper = " class=\"fieldErr\"";}

echo "<label for=\"edy\">End Date</label>".
"<br />".
"<select name=\"edm\" id=\"edm\"$reper>";

$i = 0;
while ($i <= 12) {
	$i = str_pad($i, 2, 0, STR_PAD_LEFT);
	if ($edm == $i) { $modify = " value=\"$i\" selected>"; } else { $modify = " value=\"$i\">"; }
	switch ($i) {
		case 0:
			$m = "None";
			break;
		case 1:
			$m = "January";
			break;
		case 2:
			$m = "February";
			break;
		case 3:
			$m = "March";
			break;
		case 4:
			$m = "April";
			break;
		case 5:
			$m = "May";
			break;
		case 6:
			$m = "June";
			break;
		case 7:
			$m = "July";
			break;
		case 8:
			$m = "August";
			break;
		case 9:
			$m = "September";
			break;
		case 10:
			$m = "October";
			break;
		case 11:
			$m = "November";
			break;
		case 12:
			$m = "December";
			break;
	}// kill switch


	echo "<option $modify" . $m . "</option>";
	$i++; 
}

echo "</select>".



"<select name=\"edd\"$reper>";

$i = 0;
while ($i <= 31) {

if ($edd == $i) {$modify = "selected";} else {$modify = "";}

if ($i == 0) {echo "<option value=\"0\">None</option>";} else {
	switch (substr($i, -1)) {
		case 1:
			echo "<option value=\"$i\" $modify >" . $i . "st </option>";
			break;
		case 2:
			echo "<option value=\"$i\" $modify >" . $i . "nd </option>";
			break;
		case 3:
			echo "<option value=\"$i\" $modify >" . $i . "rd </option>";
			break;
		default:
		   echo "<option value=\"$i\" $modify >" . $i . "th </option>";
	}// kill switch
}

$i++;
	 
}

echo "</select>".

"<select name=\"edy\"$reper>";

$thecur = date(y);
$i = ($thecuryear - 1);
$finalyear = ($i + 6);

while ($i <= $finalyear) {

if ($i < $thecur) {$modify = ""; $value = "None"; echo "<option value=\"0\" " . $modify . ">$value</option>";} elseif ($edy == $i) {$modify = "selected"; $value = "20".$i; echo "<option value=\"".$i."\" " . $modify . ">$value</option>";} else {$modify = ""; $value = "20".$i; echo "<option value=\"".$i."\" " . $modify . ">$value</option>";}

$i++;
}

echo "</select>";
echo "<br  />";

echo "</fieldset>".

"<fieldset>".



"<legend>Category</legend>".
"<label for=\"ctgry\">Seperate Each Category with a Comma Followed by a Space (, )</label> <br />".
"<input type=\"text\" name=\"ctgry\" id=\"ctgry\" class=\"itext\" style=\"width:100%;\" value=\"$ctgry\" /> <br />";
?>

</fieldset>
<br />
<input type="submit" name="cnre" value="<?php if (isset($edid) && $edid != "not editing") {echo "Update Event";} else {echo "Create Event";}?>"/> <br />

</form>
            



</div>

<div class="btm"></div>





<!-- KILL main -->
</div>







<!-- KILL container -->
</div>


</body>

</html>



