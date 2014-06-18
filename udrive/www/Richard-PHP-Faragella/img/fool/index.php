<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="Shortcut Icon" href="/favicon.ico">
<title>DI | ET Logo</title>

<script language="JavaScript">

function changeColor(obj,color){
	obj.style.backgroundColor = color;
}


</script>

</head>

<body>

<?php 

$handle = opendir ('./');
	while (false !== ($file = readdir($handle))) {
		$file_name = explode('.', $file);
		if ($file_name[1] == 'jpg' || $file_name[1] == 'jpeg' || $file_name[1] == 'png' || $file_name[1] == 'bmp') {
			echo '<img src="'.$file.'"/><br />'.$file_name[0].'<br />';
		}
		
	}
closedir($handle);

?>





</body>