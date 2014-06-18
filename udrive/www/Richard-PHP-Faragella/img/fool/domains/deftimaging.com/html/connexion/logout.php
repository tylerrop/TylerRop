<?php $page = "logout";

session_start();
session_destroy();
if (isset($_GET['page']) && $_GET['page'] != "home") {
	$page = $_GET['page'];
} else {
	$page = "index";
}
header("Location: ". $page .".php");


?>