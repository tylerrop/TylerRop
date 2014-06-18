<?php 
header("Location: http://elitetutorials.ca/contact.php");

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
<title>Calgary Tutors, Calgary Tutoring | Calgary Math and Science Tutor</title>
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
    	
    	<div class="left" style="position:relative; float:left; width:391px; padding:0px; padding-right:30px; border-right:thin #CCC solid; font-family:Geneva, sans-serif; font-size:12px; font-weight:100; color:#959595;">
        	<img src="img/use/title/contact.jpeg" width="177" height="31" align="About Me" />
            <br />
            <h1>Michael Fragalla</h1>
            <h2>B.Sc. E.E., B.Sc. Psyc.</h2>
            <br />
            <h3>Tel: 1 (403) 830 8146</h3>
            <h3>Email: <a href="mailto:info@elitetutorials.ca">info@elitetutorials.ca</a></h3>
            <br />
            <h3>Opperating Hours:</h3>
            <h2>Sunday - Thursday: 11:00am - 11:00pm</h2>
            <h2>Friday: 11:00am - 6:00pm</h2>
            <h2>Saturday: Closed</h2>
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br clear="all" />

        </div>
        
        <div class="blog_pane" style="position:relative; float:right; width:391px; padding-left:30px;">
        	<img src="img/use/title/blog.jpeg" />
            <!-- BLOG APP -->
            <div class="blog_pane_app" style="width:100%; margin-top:5px;"> 
            
            
            	<div class="blog_pane_app_entrie">
                <p>ELITE Tutoring is a Calgary based individual, 1-on-1 tutoring service that provides students with the support they need to improve their academic skills and performance.  We provide the highest level of individual support in a variety of subjects including Math tutoring, Science tutoring (Biology, Chemistry and Physics), and English tutoring. Whether your son or daughter is doing well and is looking for that individual support to excel, or whether they are looking for a more rigorous amount of educational assistance to improve their mathematics or science foundation, there is no better choice than ELITE Tutoring. Our tutors provide you with the help your son or daughter needs to succeed and develop their academic confidence. </p>
                </div>
                
                
            	<div class="blog_pane_app_entrie"> 
                	<h1>Science</h1>
                    <h2>Posted on September 20, 2011 - 12:52pm</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius, felis et molestie vestibulum, augue magna vehicula quam, a adipiscing arcu velit eget dui. Praesent interdum tortor a turpis pretium malesuada.</p>
                </div>
            	<div class="blog_pane_app_entrie"> 
                	<h1>Science</h1>
                    <h2>Posted on September 20, 2011 - 12:52pm</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius, felis et molestie vestibulum, augue magna vehicula quam, a adipiscing arcu velit eget dui. Praesent interdum tortor a turpis pretium malesuada.</p>
                </div>
            	<div class="blog_pane_app_entrie"> 
                	<h1>Science</h1>
                    <h2>Posted on September 20, 2011 - 12:52pm</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius, felis et molestie vestibulum, augue magna vehicula quam, a adipiscing arcu velit eget dui. Praesent interdum tortor a turpis pretium malesuada.</p>
                </div>
            	<div class="blog_pane_app_entrie"> 
                	<h1>Science</h1>
                    <h2>Posted on September 20, 2011 - 12:52pm</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius, felis et molestie vestibulum, augue magna vehicula quam, a adipiscing arcu velit eget dui. Praesent interdum tortor a turpis pretium malesuada.</p>
                </div>
            	<div class="blog_pane_app_entrie"> 
                	<h1>Science</h1>
                    <h2>Posted on September 20, 2011 - 12:52pm</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius, felis et molestie vestibulum, augue magna vehicula quam, a adipiscing arcu velit eget dui. Praesent interdum tortor a turpis pretium malesuada.</p>
                </div>
            <!-- KILL BLOG APP -->
            </div>
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
