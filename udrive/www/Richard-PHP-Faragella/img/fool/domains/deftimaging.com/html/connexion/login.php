<?php $page = "login";

session_start();
 
if (isset($_POST['login'])) {
	if ($_POST['user'] == "admin" && $_POST['pass'] == "connexion366") {
	$_SESSION['user'] = "admin";
	$_SESSION['lvl'] = 4;
	header('Location: index.php');
	}
}




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Connexion</title>
</head>

<body>

<form action="<?php echo $PHP_SELF; ?>" method="post">

User Name:<input type="text" name="user" />
Password:<input type="password" name="pass" />
<input type="submit" name="login" value="Log In" />

</form>

</body>
</html>
