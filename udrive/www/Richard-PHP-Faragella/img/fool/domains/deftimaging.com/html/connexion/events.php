<?php 
// requires
require_once("php/connection.php"); 
require_once("php/eventsextras.php"); 


/************************
*						*
*		   Gets			*
*						*
************************/

// get stuff from the browser
$uri = $_SERVER['PHP_SELF'] . "?";


foreach($_GET as $key => $value) {
	//get array
	$get[$key] = $value; 
//	print_r($get); echo "<br />";
	//old get string
	$oldgets .= "&" . $key . "=" . $value;
}
//echo $oldgets;


/************************
*						*
*	Date Calculations	*
*						*
************************/

$i = 0;//the offset from today
if (isset($get['doff'])) {$i = (int)$get['doff'];} else {$get['doff'] == 0;}//the offset from today in days from get
$ii = 0;//the start day... should always be 0
$iii = $i+7;//the amount of days in comparison to the start day

$daysraw = array();//to hold the raw date
$days = array();//to hols events on that day

while ($i < $iii) {
	$varname = "day" . $ii;
	$varnameraw = "day" . $ii . "raw";
	
	$$varnameraw = mktime(0, 0, 0, date("m")  , date("d")+$i, date("Y"));
	$$varname  = array();
	
	$daysraw[] = $$varnameraw;
	$days[] = $$varname;
	
	//echo $varname . "->" . $$varname . "<br />";
	//print_r($daysraw);
	//print_r($days);
	
	$i++;
	$ii++;
}

// month nav
if (date("d", $daysraw[0]) == 1) {// previouse month if today current date is 1
	$prevmo = ($get['doff'] - date("d", mktime(0, 0, 0, date("m", $daysraw[0])  , date("d", $daysraw[0])-1, date("Y", $daysraw[0])) ));
} else {// previouse month if today current date is not 1
	$prevmo = ($get['doff'] - date("d", $daysraw[0])) + 1;
}

//echo ($get['doff'] + (date("d", mktime(0, 0, 0, date("m", $daysraw[0])+1, 0, date("Y", $daysraw[0])) - date("d", $daysraw[0]) )+1 ));
$nextmo = ($get['doff'] + date("d", mktime(0, 0, 0, date("m", $daysraw[0])+1, 0, date("Y", $daysraw[0])))) - date("d", $daysraw[0]) +1;


/************************
*						*
*	CTGRY filter stuff	*
*						*
************************/

$ctgrya = explode(",", $get['ctgry']);//!!

$i = 0;
if (isset($get['ctgry']) && $get['ctgry'] != NULL) {
	$ctgryRestriction = "AND (";
	foreach ($ctgrya as $var) {
		if ($var != NULL && $i > 0) {
			$ctgryRestriction .= " OR ctgry LIKE '%, " . $var . ", %'";
		} elseif ($var != NULL && $i == 0) {
			$ctgryRestriction .= "ctgry LIKE '%, " . $var . ", %'";
		}
		$i++;
	}
	$ctgryRestriction .= ") ";
}

/************************
*						*
*	 Retrieve Events	*
*						*
************************/

$events = array();// create events array

// get from ote
$query = "SELECT id, nme, loca, dsc, sdte, edte, stme, etme, ctgry ";
$query .= "FROM ote ";
$query .= "WHERE sdte <= " . date(ymd, end($daysraw)) . " ";
$query .= "AND (edte >= " . date(ymd, $daysraw[0]) . " OR edte = 000000) ";
$query .= $ctgryRestriction;

//echo $query . "<br />";

$result = mysql_query($query, $connection);
while ($row = mysql_fetch_array($result)) {
	$events[] = $row;
}
//print_r($events); echo "<br />";

// get from rpe
$query = "SELECT id, nme, loca, dsc, sdte, edte, stme, etme, ctgry, patern ";
$query .= "FROM rpe ";
$query .= "WHERE sdte <= " . date(ymd, end($daysraw)) . " ";
$query .= "AND (edte >= " . date(ymd, $daysraw[0]) . " OR edte = 000000) ";
$query .= $ctgryRestriction;

//echo $query . "<br />";

$result = mysql_query($query, $connection);
while ($row = mysql_fetch_array($result)) {
	$events[] = $row;
}
//print_r($events);

/************************
*						*
*	   Sort Events		*
*						*
************************/

foreach ($events as &$var) {// add date and time togather
//	echo "what?";
	$var["dtetme"] = $var["stme"];// what is to be compared
//	echo $var["dtetme"] . "<br />";
}

usort($events, 'compare');// sorts events user function compare

/************************
*						*
* Match Events to Days	*
*						*
************************/

foreach ($events as $key => $event) {
	if (isset($event["patern"])) {//if the event is reoccuring
		$paternparts = explode(":", $event["patern"]);
		if ($paternparts[0] === "e") {//for day of week
			foreach ($daysraw as $key => $day) {
				if (date(w, $day) == 1 && preg_match("/mo/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
				elseif (date(w, $day) == 2 && preg_match("/tu/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
				elseif (date(w, $day) == 3 && preg_match("/we/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
				elseif (date(w, $day) == 4 && preg_match("/tr/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
				elseif (date(w, $day) == 5 && preg_match("/fr/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
				elseif (date(w, $day) == 6 && preg_match("/sa/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
				elseif (date(w, $day) == 0 && preg_match("/su/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
			}
		} elseif ($patenparts[0] === "d") {// specific day ex the 21st of each month
			foreach ($daysraw as $key => $day) {
				if (date(d, $day) == $paternparts[1]) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
			}
		} else {
			foreach ($daysraw as $key => $day) {//if it reocurrs on the xst yday of each month. ex: last friday of each month
				if (date(d, $day) >= 1 && date(d, $day) <= 7 && $paternparts[0] === "f") {
					if (date(w, $day) == 1 && preg_match("/mo/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
					elseif (date(w, $day) == 2 && preg_match("/tu/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
					elseif (date(w, $day) == 3 && preg_match("/we/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
					elseif (date(w, $day) == 4 && preg_match("/tr/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
					elseif (date(w, $day) == 5 && preg_match("/fr/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
					elseif (date(w, $day) == 6 && preg_match("/sa/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
					elseif (date(w, $day) == 0 && preg_match("/su/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}

				} elseif (date(d, $day) >= 8 && date(d, $day) <= 14 && $paternparts[0] === "s") {
					if (date(w, $day) == 1 && preg_match("/mo/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
					elseif (date(w, $day) == 2 && preg_match("/tu/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
					elseif (date(w, $day) == 3 && preg_match("/we/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
					elseif (date(w, $day) == 4 && preg_match("/tr/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
					elseif (date(w, $day) == 5 && preg_match("/fr/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
					elseif (date(w, $day) == 6 && preg_match("/sa/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
					elseif (date(w, $day) == 0 && preg_match("/su/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}

				} elseif (date(d, $day) >= 15 && date(d, $day) <= 21 && $paternparts[0] === "t") {
					if (date(w, $day) == 1 && preg_match("/mo/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
					elseif (date(w, $day) == 2 && preg_match("/tu/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
					elseif (date(w, $day) == 3 && preg_match("/we/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
					elseif (date(w, $day) == 4 && preg_match("/tr/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
					elseif (date(w, $day) == 5 && preg_match("/fr/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
					elseif (date(w, $day) == 6 && preg_match("/sa/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
					elseif (date(w, $day) == 0 && preg_match("/su/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}

				} elseif (date(d, $day) >= 22 && date(d, $day) <= 28 && $paternparts[0] === "o") {
					if (date(w, $day) == 1 && preg_match("/mo/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
					elseif (date(w, $day) == 2 && preg_match("/tu/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
					elseif (date(w, $day) == 3 && preg_match("/we/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
					elseif (date(w, $day) == 4 && preg_match("/tr/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
					elseif (date(w, $day) == 5 && preg_match("/fr/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
					elseif (date(w, $day) == 6 && preg_match("/sa/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
					elseif (date(w, $day) == 0 && preg_match("/su/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}

				}  elseif (date(d, $day) >= date(t, $day)-7 && date(d, $day) <= date(t, $day) && $paternparts[0] === "l") {
					if (date(w, $day) == 1 && preg_match("/mo/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
					elseif (date(w, $day) == 2 && preg_match("/tu/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
					elseif (date(w, $day) == 3 && preg_match("/we/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
					elseif (date(w, $day) == 4 && preg_match("/tr/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
					elseif (date(w, $day) == 5 && preg_match("/fr/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
					elseif (date(w, $day) == 6 && preg_match("/sa/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
					elseif (date(w, $day) == 0 && preg_match("/su/", $paternparts[1])) {$days[$key][] = displayEvent($event,$uri,$oldgets);}

				}
			}
		}
	} else {// if it is a singlely occuring event
		foreach ($daysraw as $key => $day) {
			if (date(ymd, $day) == $event["sdte"]) {$days[$key][] = displayEvent($event,$uri,$oldgets);}
		}
	}	
}

//print_r($days);

/************************
*						*
* Build Head and Style	*
*						*
************************/

$page = "events";

include("php/headedit.php");

echo "<div class=\"main\"> <div id=\"pageImage\" style=\"background-image:url(page/big/" . $page . ".jpg);\"> <div class=\"sectionTitle\"><h1>Events</h1> </div> </div> 
<div class=\"textAria\">";


echo 
"<ul class=\"timetrav back\">
	<li class=\"m\"><a href=\"" . $uri . $oldgets . "&doff=" . $prevmo . "\"></a></li>
	<li class=\"w\"><a href=\"" . ($uri . $oldgets . "&doff=" .  ($get['doff'] - 7)) . "\"></a></li>
</ul>
<a href=\"" . $uri . $oldgets . "&doff=0" . "\">Jump to Today</a>
Filtered by Category: <a href=\"" . $uri . $oldgets . "&ctgry=" . "\">" . $get['ctgry'] . "</a>
<ul class=\"timetrav forth\">
	<li class=\"m\"><a href=\"" . $uri . $oldgets . "&doff=" . $nextmo . "\"></a></li>
	<li class=\"w\"><a href=\"" . ($uri . $oldgets . "&doff=" .  ($get['doff'] + 7)) . "\"></a></li>
</ul>
<br />
<br />
<br />";




/************************
*						*
* 	Print Out Events	*
*						*
************************/

foreach ($daysraw as $key => $day) {
	echo "<div class=\"day\">";
	if ($day == mktime(0, 0, 0, date("m")  , date("d"), date("Y"))) {
		echo "<h1 style=\"color:#3c2b23;\"> Today </h1>";
	} else {
		echo "<h1 style=\"color:#3c2b23;\">" . date("l, j M o", $day) . "</h1>";
	}
	
	if (isset($days[$key][0])) {
		foreach ($days[$key] as $event) {
			echo $event;
		}
	} else {
		echo $nottoday;
	}
	
	echo "</div>";
}

/************************
*						*
* 		Foot Stuff		*
*						*
************************/

echo "</div>


<div class=\"btm\"></div>





<!-- KILL main -->
</div>







<!-- KILL container -->
</div>


</body>

</html>";
?>