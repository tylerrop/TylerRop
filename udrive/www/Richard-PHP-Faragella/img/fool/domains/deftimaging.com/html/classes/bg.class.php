<?php

class Standard {	
	
	public $bg_code;
	public $html_header;
	public $page_name;
	
	function html_Header($this->page_name = "Deft Imaging") {
	
		if ($page_name == 'Deft Imaging')) {$page_title = $page_name;} else {$page_title = 'DI | ' . $page_name; }
		return $this->header;
			"<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
			<html xmlns=\"http://www.w3.org/1999/xhtml\">
			<head>
				<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
				<link rel=\"Shortcut Icon\" href=\"/favicon.ico\">
				<title>".$page_title."</title>
			
				<script language=\"JavaScript\">
		
					function changeColor(obj,color){
					obj.style.backgroundColor = color;
					}

				</script>

			</head>";
			
			return $this->header;
		
	}

	function background () {
		// Background Color
		$bg_colors = array("#0099FF", "#9966CC", "#66FF66", "#FF9900");
		// Counter for loop
		$i = 0;
		// Number of square
		$num_of_squairs = rand(15,75);
		while ($i < $num_of_squairs) {
			// Size of square
			$square_size = rand(15, 150);
			$square_color_mouse_over = rand(0, 3);
			$square_color = rand(0, 3);
			//make sure mouse over color is not the same as regular color
			while ($squair_color == $squair_color_mouse_over) {
				$squair_color = rand(0, 3);
			}

			$this->bg_code .= "<div style=\"

			height:" . $square_size . "px;
	    width:" . $square_size . "px;

			margin-top:-" . $square_size/2 . "px;
			margin-left:-" . $square_size/2 . "px;

	    background:" . $bg_colors[$square_color] . ";
	
	    position:fixed;
	    left:" . rand(0, 100) . "%;
	    top:" . rand(0, 100) . "%;

			filter:alpha(opacity=50);
			-moz-opacity:0.5;
			-khtml-opacity: 0.5;
			opacity: 0.5;

			z-index:1;
			\"

			onMouseOver=\"changeColor(this,'". $bg[$square_color_mouse_over] . "')\"
			onMouseOut=\"changeColor(this,'". $bg[$square_color] . "')\"
	
			>
			</div>";

			$i ++;
		}
		
		
		return $this->bg_code;
	}
	

}



	
$page = new Standard;
echo $page->html_Header("Troll Girl");
echo $page->background();





?>