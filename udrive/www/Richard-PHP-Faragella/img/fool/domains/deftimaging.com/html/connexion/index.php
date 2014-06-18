<?php $page = "home"; 

session_start();

$switchdoc = "switches/". $page .".txt";
$fh = fopen($switchdoc, 'r');
$switch = fread($fh, 1);
fclose($fh);
 
if (isset($_POST['login'])) {
	if ($_POST['user'] == "admin" && $_POST['pass'] == "connexion366") {$_SESSION['user'] = "admin"; $_SESSION['lvl'] = 4;}  
}

$lvl = $_SESSION['lvl'];
$user = $_SESSION['user'];


if ($lvl == 4 || $switch == "1") {
	require_once("php/page.php");
} else {
	require_once("soon.php");
}
?>