<?php 

/************************
	set page 
*************************/


$page = explode('/', $_SERVER['REQUEST_URI']); $page = explode('.', $page[2]); $page = $page[0];
if ($page == "") {
	$page = "index";
}
//echo $page;

/************************
	Create Muneu Items 
*************************/
if ($handle = opendir('img/use/main/menu')) {
	$i = "0";
	while (false !== ($file = readdir($handle))) {
		//echo "$file\n";
		$file_array = explode('-', $file);
		if ($file_array[2] != $link_name[$i-1]){
			$link_name[$file_array[0]] = $file_array[2];
		}
		$i ++;		
	}
	foreach ($link_name as  $value => $name) {
		$menu_items .= '<li>
				<a href="' . $name . '.php" target="_self" onmouseover="document.getElementById(\'' . $name . '\').src = \'img/use/main/menu/' . $value . '-link-' . $name . '-active.jpg\';" onmouseout="document.getElementById(\'' . $name . '\').src = \'img/use/main/menu/' . $value . '-link-' . $name . '-up.jpg\';">
					<img id="' . $name . '" src="img/use/main/menu/' . $value . '-link-' . $name . '-up.jpg" />
				</a>
			</li>
			';
	}
} 
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Calgary Diploma Prep | Math 30 Diploma Exam Prep Course</title>
<link href="css/contact.css" rel="stylesheet" type="text/css" />
</head>

<body>

<!--Main-->
<div id="main"> 

	<!--Header-->
	<div class="header">
    
    	<div class="logo_div"><a href="index.php"><img id="logo" src="img/use/main/logo.jpeg" height="149" width="141"  /></a> </div>
        

        <ul id="main_menu">

			<li>
				<a href="about.php" target="_self" onmouseover="document.getElementById('about').src = 'img/use/main/menu/Link-aboutus-aqua.jpg';" onmouseout="document.getElementById('about').src = 'img/use/main/menu/Link-AboutUs-White.jpg';">
					<img id="about" src="img/use/main/menu/Link-AboutUs-White.jpg">
				</a>
			</li>
			<li>
				<a href="prep_course.php" target="_self" onmouseover="document.getElementById('prep_course').src = 'img/use/main/menu/link-diploma-aqua.jpg';" onmouseout="document.getElementById('prep_course').src = 'img/use/main/menu/link-diploma-white.jpg';">
					<img id="prep_course" src="img/use/main/menu/link-diploma-white.jpg">
				</a>
			</li>
			<li>
				<a href="contact.php" target="_self" onmouseover="document.getElementById('contact').src = 'img/use/main/menu/Link-ContactUs-Aqua.jpg';" onmouseout="document.getElementById('contact').src = 'img/use/main/menu/Link-ContactUs-White.jpg';">
					<img id="contact" src="img/use/main/menu/Link-ContactUs-White.jpg">
				</a>
			</li>
            
            <li>
				<a href="services.php" target="_self" onmouseover="document.getElementById('services').src = 'img/use/main/menu/link-1on1-aqua.jpg';" onmouseout="document.getElementById('services').src = 'img/use/main/menu/link-1on1-white.jpg';">
					<img id="services" src="img/use/main/menu/link-1on1-white.jpg">
				</a>
			</li>
            
            
        
        <!--Kill Main Mune-->
    	</ul>
        
    <!-- Kill Header -->
    </div>

	<!-- Ad -->
	<div class="ad" style="background:url(img/use/ad/bg-1.jpeg);"> 
        <img id="ad_text" src="img/use/ad/quote-1-If_you're_looking_for_the_best_you've_found_it!.png" />
        <img id="ad_link" src="img/use/ad/button-1-Click_here_to_learn_more.png" />
    <!-- Kill Ad -->
    </div>
    
    <!-- Content -->
    <div class="page_body" style="width:845px; background-color:#FFF; padding:30px;" >
    	
<div class="left" style="position:relative; float:left; width:100%; padding:0px; padding-right:30px;  font-family:Geneva, sans-serif; font-size:12px; font-weight:100; color:#959595;">
        	<img src="img/use/title/prepcourse.jpg" alt="Services" />
            <br />
      <p><h3>Calgry Diploma Prep<br/><br/>Finally a comprehensive Diploma prep course where students can feel comfortable asking questions and getting the answers they need!</h3><br/> ELITE Tutoring offers a Math 30 diploma exam prep course here in Calgary that is unlike any other in the city. We’ve taken the comprehensive element that has made Renert successful and applied it to a smaller more interactive classroom environment. Hence students get the best of both worlds in this more interactive setting because there is an opportunity for students to ask questions and have them answered which can obviously be much more challenging in a lecture hall with hundreds of other students.<br/>Here are some of the benefits that make ELITE Tutoring’s Math 30 Diploma Exam Prep Course the unbeatable option when it comes to your son or daughter’s success on their Math 30 Diploma exam.<br/> 1. Small class sizes to ensure your son or daughter has the opportunity to participate in the learning experience.<br/>
2. 38 hours of comprehensive curriculum review in which sample questions are broken down and explained in more than one way to ensure understanding.<br/>
3. A review booklet students get to keep and review on their own which provides a great supplementary study tool.<br/>
4. Personal interactive instruction from Calgary’s premiere 1-on-1 tutor.<br/> 


</p>
            
        <table width="100%" height="313">
              <tr style="color:#000;">
                <th width="38%" scope="col" bgcolor="#61CABE">TUTORING SERVICE</th>
                <th width="14%" scope="col" bgcolor="#61CABE">PRICE</th>
                <th width="13%" scope="col" bgcolor="#61CABE">SIZE</th>
                <th width="19%" scope="col" bgcolor="#61CABE">HOURS IN CLASS</th>
                <th width="16%" scope="col" bgcolor="#61CABE">COMPREHENSIVE</th>
              </tr>
              <tr>
                <td>Elite</td>
                <td>$330</td>
                <td>30-40</td>
                <td>38</td>
                <td>Yes</td>
              </tr>
              <tr>
                <td>Renert</td>
                <td>$315</td>
                <td>450+**</td>
                <td>38-42*</td>
                <td>Yes</td>
              </tr>
              <tr>
                <td>Rock the Diploma</td>
                <td>$135</td>
                <td>40-50</td>
                <td>16-26.5</td>
                <td>No</td>
              </tr>
              <tr>
                <td>Abacus</td>
                <td>$50</td>
                <td>150-200</td>
                <td>12</td>
                <td>No</td>
              </tr>
              <tr>
                <td>Alberta Diploma Prep</td>
                <td>$50</td>
                <td>150+</td>
                <td>12</td>
                <td>No</td>
              </tr>
      </table>
        <p><br clear="all" />
      </p>
      </div>
        
        
        <br clear="all" />
    
    <!-- KILLL CONTENT -->
    </div>
    
     <div id="footerInfo">
        	<h3>ELITE Tutoring</h3>
            <h3>Tel:   1 (403) 830 8146</h3>
            <h3>Email: <a href="mailto:info@elitetutorials.ca">info@elitetutorials.ca</a></h3>
    </div>
    
<!-- KILL MAIN -->
</div>


</body>
</html>
