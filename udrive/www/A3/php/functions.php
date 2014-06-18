<?php

	//error_reporting(-1);
	/*******************************
	****						****
	****		Initial 		****
	****						****
	*******************************/
	
	//start_session();
	
	// GET THE PAGE NAME from uri
  //makes and array of the url
  $current_page = explode('/', $_SERVER['REQUEST_URI']);
  //print_r($current_page);
  $current_page = explode('.', array_pop($current_page));
  //print_r($current_page);
  $current_page = $current_page[0];
  //echo($current_page);

	   
	
  // GET THE PAGE NAME from uri
  //makes and array of the url
  $current_page = explode('/', $_SERVER['REQUEST_URI']);
  //print_r($current_page);
  $current_page = explode('.', array_pop($current_page));
  //print_r($current_page);
  $current_page = $current_page[0];
  //echo($current_page);
  
  // Set home page if not on index
  if ($current_page == '') $current_page = 'index';

  
  /* CALLS THE PAGE BUILDER FUNCTION 
  	This is a general function to build every singal page */
  page_builder(/*this will define the current page's name... index, about, what ever */$current_page, /* calls the specific page function */$current_page());
  
  
  
  
  
function pageTitle($current_page)
{
  if ($current_page == "index")
  {
	  return "Home";
  }
  
  if ($current_page == "genres")
  {
	  return "Genres";
  }
  
  if ($current_page == "artists")
  {
	  return "Artists";
  }
  
  if ($current_page == "about")
  {
	  return "About Us";
  }
  
  if ($current_page == "all_paintings")
  {
	  return "Browse Paintings";
  }
  
  if ($current_page == "single_artist")
  {
	  return "Artist";
  }
  
  if ($current_page == "single_painting")
  {
	  return "Painting";
  }
  
  if ($current_page == "single_genre")
  {
	  return "Genre";
  }
  if ($current_page == "login")
  {
	  return "Login";
  }
  if($current_page == "searchresults")
  {
	  return "Search Results";
  }
}
//	NEED TO ADD IN SEARCH AND LOG IN AND LOG OUT TITLES



  /*

	/*******************************
	****						****
	****	HTML Functions 		****
	****						****
	*******************************/

   function headerDisplay($current_page)
   {
	  if (isset($_SESSION['name']))
	  {
		 $login_logout = '<a href="logout.php">Logout '.$_SESSION['name'].'</a>'; 
	  } 
	  
	  else 
	  {
	  	$login_logout = '<a href="login.php">Login</a>';
	  }
	  
	  $header = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				 <html xmlns="http://www.w3.org/1999/xhtml">
			     <head>
				 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

				 <title>Fresh Paint | '. pageTitle($current_page) .'</title>




				 <link href="css/960.css" rel="stylesheet" type="text/css">

					<link href="css/Comp1511 - A3 - Styles.css" rel="stylesheet" type="text/css" />
					
					
					<link href="css/reset.css" rel="stylesheet" type="text/css" />
					</head>
					
					<body id="headerStyles2">
					
					<!--Total Container Div Start -->
					<div class="container_12" id="headerStyles">
						  
						  
						  <!--Total Container Div Start -->
							<div class="container_12" id="headerStyles">
					
						<!--Header Div Start-->
						<div class="grid_12">
							
						  <a href="index.php"><img src="brush icons/paint-brush-logo-small.gif" width="130" height="131" alt="Paint Brush Logo" longdesc="http://index.php" /></a>
						  
						  <a href="index.php"><img src="brush icons/FreshPaint2.gif" width="500" height="130" alt="Fresh Paint - Historical Painters Information " longdesc="http://index.php" /></a>  
						  
						  <!--Header Div End-->
						</div>
						
						
						
						<!--Main Menu div start-->
					    <div class="grid_12" id="mainNav">
						
							<ul>
								<li><a href="index.php">Home</a></li>
								
								<li><a href="all_paintings.php">Browse Paintings</a></li>
								
								<li><a href="about.php">About Us</a></li>
								
								<li>'.$login_logout.'</li>
								
								</ul>
								   
								<form method="post" action="searchresults.php" class="searchForm">Search &nbsp;<input name="globalSearch" type="text" size="25" maxlength="25" class="globalSearch"/>
								
								
								<INPUT TYPE="image" src="metroIcons/searchIcon4.png" width="25" height="25" alt="Search Icon" id="searchIcon">
								
								</form>
							  
						
						
						<!--Main Menu div end-->
						</div>';
	
	return $header;
   }
   
   function leftMenuDisplay()
   {
	    $leftMenu = '<!--Left Menu div start-->
    <div class="grid_2"  id="leftMenuFinal">
    	
        <ul>
        	<li><a href="artists.php">Artists</a><img src="metroIcons/rightArrow.png" width="25" height="25" alt="Right Arrow" class="rightArrow" /></li>
            
			<li><a href="genres.php">Genres</a><img src="metroIcons/rightArrow.png" width="25" height="25" alt="Right Arrow" class="rightArrow" /></li>
        </ul>
    
    
    <!--Left Menu div end-->
    </div>';
	
	return $leftMenu;
   }
   
	
function footerDisplay()
	{
		   
    $footer = '<!--Content div end-->
   			 </div>
    
    
  <br clear="all"/>
    
				<!--Footer div start-->
				<div id="footer">
					<ul>
						<li><a href="index.php">Home</a></li>
						
						<li><a href="all_paintings.php">Browse Paintings</a></li>
						
						<li><a href="about.php">About Us</a></li>
						
						<li>&copy; Copyright Tyler Rop</li>
				   </ul>
				
				<!--Footer div end-->
				</div>



		<!--Total Container Div End -->
		</div>

		</body>

		</html>';
		
		return $footer;
	}
	
	
	/*******************************
	****						****
	****	 Page Builders  	****
	****						****
	*******************************/
	
function page_builder($current_page, $content) 
{
	
	session_start();
	
	areTheyLoggedIn();
	  
	echo headerDisplay($current_page);

	echo leftMenuDisplay();
	
	echo mainContent($content);
	
	echo footerDisplay();
	
}

  
function login()
{
	$loginForm = '<table>
	
	<form method="post" action="login.php">
		<tr>
			<td>Name</td> 
			<td><input type="text" name="name" id="nameEntry"/><br clear="all"/></td>
		</tr>
		
		<tr>
			<td>Password&nbsp;</td> 
			<td><input type="password" name="password" id="passwordEntry"/></td>
		</tr>
	
		<tr>
			<td><input name="Submit" type="submit" value="Login" /></td>
		</tr>
	
	</form>
	
	</table>';
	
	return $loginForm;
	
	
}

function areTheyLoggedIn()
{
	$name = $_POST['name'];
	
	$password = $_POST['password'];
	
	$user_list = my_read_file('text/users.txt');
	
	foreach($user_list as $line)
	{
			if($line[0] == $name && trim($line[1]) == $password)
			{
				$_SESSION['name'] = $name;
			
				header('Location: index.php');
				
			}
			
	}
	
	
}

function mainContent($content)
{
		 $mainContent = '<!--Content Div start-->
    					<div class="grid_10" id="contentArea">
						
							'.$content.'
						<!--Content div end-->
    					</div>';
						
		 return $mainContent;
}
	
function index()
{ 
 	$mainStuff = '<h1><span class="greenText1">Welcome to Fresh Paint</h1>
	
	<p class="mainText">Fresh Paint is your go-to website for information about historically famous painters and their paintings.</p> 
	<p class="mainText">We hope that you enjoy viewing the paintings and learning about them!</p>
	</br>
	<p class="mainText">Here are a few of our favorite historical paintings that you might like too!</p>
	
	<p class="mainText">To find more paintings, just click <a href="all_paintings.php" class="paintingWikiLink">here</a> or on the option in the main menu.</p>
	
	</br>

	
	<a href="http://ins.mtroyal.ca/~trop315/comp1511-A3-TylerRop/single_painting.php?paintID=19070"><img src="paintings/square-medium/19070.jpg" width="132" height="132" alt="Starry Night" class="mainPics" /></a>
	
	<a href="http://ins.mtroyal.ca/~trop315/comp1511-A3-TylerRop/single_painting.php?paintID=13030"><img src="paintings/square-medium/13030.jpg" width="132" height="132" alt="Arrangement in Grey and Black: Portrait of the Painters Mother" class="mainPics" /></a>
    
    <a href="http://ins.mtroyal.ca/~trop315/comp1511-A3-TylerRop/single_painting.php?paintID=19030"><img src="paintings/square-medium/19030.jpg" width="132" height="132" alt="Sidewalk Café at Night" class="mainPics"/></a>
	
	<a href="http://ins.mtroyal.ca/~trop315/comp1511-A3-TylerRop/single_painting.php?paintID=17010"><img src="paintings/square-medium/17010.jpg" width="132" height="132" alt="Impression Sunrise" class="mainPics" /></a>
	
	<a href="http://ins.mtroyal.ca/~trop315/comp1511-A3-TylerRop/single_painting.php?paintID=19100"><img src="paintings/square-medium/19100.jpg" width="132" height="132" alt="The Night Café" class="mainPics" /></a>
	</br>
	</br>
	</br>

	<p class="mainText">We also have a few of our favorite artists for you too.</p>
	
	<p class="mainText">To find more artists, just click <a href="artists.php" class="paintingWikiLink">here</a> or on the option in the left menu.</p>
	
	</br>

	<a href="http://ins.mtroyal.ca/~trop315/comp1511-A3-TylerRop/single_artist.php?painter=Picasso"><img src="artists/square-medium/1.jpg" width="132" height="132" alt="Picasso" class="mainPics" /></a>
	
	<a href="http://ins.mtroyal.ca/~trop315/comp1511-A3-TylerRop/single_artist.php?painter=David"><img src="artists/square-medium/5.jpg" width="132" height="132" alt="David" class="mainPics" /></a>
	
	<a href="http://ins.mtroyal.ca/~trop315/comp1511-A3-TylerRop/single_artist.php?painter=Van%20Gogh"><img src="artists/square-medium/19.jpg" width="132" height="132" alt="Van Gough" class="mainPics" /></a>
	
	<a href="http://ins.mtroyal.ca/~trop315/comp1511-A3-TylerRop/single_artist.php?painter=Monet"><img src="artists/square-medium/17.jpg" width="132" height="132" alt="Monet" class="mainPics" /></a>
	
	<a href="http://ins.mtroyal.ca/~trop315/comp1511-A3-TylerRop/single_artist.php?painter=Whistler"><img src="artists/square-medium/13.jpg" width="132" height="132" alt="Whistler" class="mainPics" /></a>
	';
	
	return $mainStuff;
}
  
  
function about()
{ 
	
	
	$hypothetical = '<p class="aboutParagraph">This site was made by Tyler Rop for an assignment in the course <a href="http://www.mtroyal.ca/ProgramsCourses/FacultiesSchoolsCentres/ScienceTechnology/Programs/BachelorofComputerInformationSystems/CurriculumCourses/comp1511.htm" class="paintingWikiLink">COMP 1511</a> at <a href="http://www.mtroyal.ca/index.htm" class="paintingWikiLink">Mount Royal University</a> in <a href="http://maps.google.ca/maps?hl=en&sugexp=frgbld&gs_nf=1&cp=10&gs_id=5&xhr=t&rlz=1C1CHFX_enCA448CA448&bav=on.2,or.r_gc.r_pw.r_cp.r_qf.,cf.osb&biw=1920&bih=979&ion=1&q=calgary+alberta&um=1&ie=UTF-8&hq=&hnear=0x537170039f843fd5:0x266d3bb1b652b63a,Calgary,+AB&gl=ca&ei=vPZ4T5bKIOrLsQLryeShBA&sa=X&oi=geocode_result&ct=title&resnum=2&sqi=2&ved=0CEEQ8gEwAQ" class="paintingWikiLink">Calgary, Alberta, Canada</a>.</p> 
	
	<p class="aboutParagraph">The teachers of this course in the Winter Semester of 2012 were <a href="http://www.mtroyal.ca/ProgramsCourses/FacultiesSchoolsCentres/ScienceTechnology/Departments/ComputerScienceInformationSystems/Faculty/rconnolly.htm" class="paintingWikiLink">Randy Connolly</a> and <a href="http://ca.linkedin.com/pub/arne-grimstrup/7/546/772" class="paintingWikiLink">Arne Grimstrup</a>.</p>
	

		<p class="aboutParagraph">The goal of this assignment was to make a website with PHP that allowed people to access information about famous paintings and painters.<p>		
		
		<p class="aboutParagraph">Tyler Rop created everything for this websites layout and functionality, but inspiration for the design came from Microsofts <a href="http://www.zune.net/en-US/" class="paintingWikiLink">Zune</a>, <a href="http://www.microsoft.com/windowsphone/en-us/features/default.aspx" class="paintingWikiLink">Windows Phone 7</a>, and <a href="http://windows.microsoft.com/en-US/windows-8/consumer-preview?ocid=O_MSC_W8P_OandO_Consumer_EN-US" class="paintingWikiLink">Windows 8 Consumer Preview</a> </p>
		
		<p class="aboutParagraph">The paint brush logo comes from <a href="http://mrchuckles2006.blogspot.ca/2010/10/chuckle-2480.html" class="paintingWikiLink">Mr. Chuckles Blogspot</a> but was altered to fit the design of this website.</p>
		
		<p class="aboutParagraph">The search and arrow icons were modified by Tyler Rop for this website, but the <a href="http://browse.deviantart.com/?q=metro%20icons&order=9&offset=144#/d4mq7lv" class="paintingWikiLink"> original icons </a>were made by <a href="http://happy-icon-studio.deviantart.com/" class="paintingWikiLink">happy-icon-studio</a> from <a href="http://www.deviantart.com/" class="paintingWikiLink">DeviantArt.com</a> </br> </br> </br> </br>
	
	<a href="http://www.mtroyal.ca/"><img src="brush icons/mru_logo3gif.gif" alt="Mount Royal University Logo"/></a>';
	
	return $hypothetical;

}


function my_read_file($textFile)
{
	$file = fopen($textFile,'r');
	
	$i = 0;
	
	while(!feof($file))
	{
		$painting_list[$i] = fgets($file);
		$painting_list[$i] = explode('~', $painting_list[$i]);
		$i++;
	}
	
	return $painting_list;
	
}

function controlPage($var_name, $file, $spot, $forwardpage, $error_message)
{
	if(isset($_GET[$var_name]))
	{
		$lines = my_read_file('text/'.$file.'.txt');
		foreach($lines as $var)
		{
			 $collumn_to_test[] = trim($var[$spot]);
		}
		if (array_search($_GET[$var_name], $collumn_to_test) === false) 
		{
			header('Location: '.$forwardpage.'?err_msg='.$error_message);
		}
	} 
	
	else 
	{
		header('Location: '.$forwardpage.'?err_msg=Invalid GET');
	}

}

  
function all_paintings()
{
	
	$painting_list = my_read_file('text/paintings.txt');

						
			foreach ($painting_list as $key => $value) 
			{
				
				$output .= displayPainting($value[0], $value[1], $value[2]);
				
			}

			return $output;

}



function displayPainting($paintID, $painter, $paintTitle)
{
		$output = '<div class="allPaintings">';
		$output .= '<a href="single_painting.php?paintID='.$paintID.'"><img src="paintings/square-medium/'.$paintID.'.jpg" alt="'.$paintTitle.'" /></a>';
		
		$output .= '<h4><a href="single_painting.php?paintID='. str_replace(array('&lt;','&gt'),array('<','>'), htmlentities($paintID)).'" class="browseAllPaintingsLinks">'. htmlentities($paintTitle).'</a></h4><br/>';
		
		$output .= '<h5><a href="single_artist.php?painter='. str_replace(array('&lt;','&gt'),array('<','>'), htmlentities($painter)).'" class="browseAllPaintingsLinks">'. htmlentities($painter).'</a></h5>';
		
		$output .= '</div>';
		
		return $output;		
}

function single_painting()
{
	controlPage('paintID', 'paintings', 0, 'all_paintings.php', "Painting not found!");
	
	$single_painting = my_read_file('text/paintings.txt');
			
	$thePainting = $_GET['paintID'];
	$line = 0;
	foreach($single_painting as $line)
	{
			
			if($line[0] == $thePainting)
			{
				
				$paintingID = $line[0];
				
				$painter = $line[1];
				
				$paintTitle = $line[2];
				
				$paintYear = $line[3];
				
				$width = $line[4];
				
				$height = $line[5];
				
				$price = $line[6];
				
				$description = $line[7];
				
				$wikipedia = $line[8];
				
				$genre = $line[9];
				
				
			$pictureHTML = '<img src = "paintings/large/'.$paintingID .'.jpg" class="singlePainting"/>';
			
			$paintingInfo = '<p class="singlePaintingText">Title: <span class="singlePantingTextWhite">'. htmlentities($paintTitle).'</span></p>
			
							 <p class="singlePaintingText">Painted by: <span class="singlePantingTextWhite">'. htmlentities($painter).'</span></p>
							 
							 <p class="singlePaintingText">Genre: <span class="singlePantingTextWhite">'. htmlentities($genre).'</span></p>
							 
							 <p class="singlePaintingText">Year: <span class="singlePantingTextWhite">'. htmlentities($paintYear).'</span></p>
							 
							 <p class="singlePaintingText">About: <span class="singlePantingTextWhite">'. str_replace(array('&lt;','&gt;'),array('<','>'), htmlentities($description)).'</span></p>
							 
							 <p class="singlePaintingText"><a href="'. htmlentities($wikipedia).'" class="paintingWikiLink">See '. htmlentities($paintTitle).' on Wikipedia</a></p>';
							 
			$output = $pictureHTML . $paintingInfo;
			
			return $output;
	
			
			}
	}

}


function displayArtist($artistID, $artistName)
{
		$output = '<div class="allArtists">';
		
		$output .= '<a href="single_artist.php?painter='. htmlentities($artistName).'"><img src="artists/square-medium/'.$artistID.'.jpg" alt="'. htmlentities($artistName).'" /></a>';
		
		$output .= '<h4><a href="single_artist.php?painter='. str_replace(array('&lt;','&gt'),array('<','>'), htmlentities($artistName)).'" class="browseAllPaintingsLinks">'. htmlentities($artistName).'</a></h4>';
		
		$output .= '</div>';
		
		return $output;		
}
	

function artists()
{
	
	$artist_list = my_read_file('text/artists.txt');

						
			foreach ($artist_list as $key => $value) 
			{
				
				$output .= displayArtist($value[0], $value[1], $value[2]);
				
			}

return $output;

}



function single_artist()
{
	controlPage('painter', 'paintings', 1, 'artists.php', "Artist not found!");
	
	$single_artist = my_read_file('text/artists.txt');
			
	$theArtist = $_GET['painter'];
	
	$line = 0;
	
	foreach($single_artist as $line)
	{
			
			if($line[1] == $theArtist)
			{
			
				
				$artistID = $line[0];
				
				$artistName = $line[1];
				
				$nationality = $line[2];
				
				$birthYear = $line[3];
				
				$deathYear = $line[4];
				
				$description = $line[5];
				
				$wikipedia = $line[6];
				
				
			$pictureHTML =  '<img src = "artists/large/'.$artistID .'.jpg" class="singlePainting"/>';
			
			$artistInfo = 	'<p class="singlePaintingText">Name: <span class="singlePantingTextWhite">'. htmlentities($artistName).'</span></p>
			
							 <p class="singlePaintingText">From: <span class="singlePantingTextWhite">'. htmlentities($nationality).'</span></p>
							 
							 <p class="singlePaintingText">Born in: <span class="singlePantingTextWhite">'. htmlentities($birthYear).'</span></p>
							 
							 <p class="singlePaintingText">Died in: <span class="singlePantingTextWhite">'. htmlentities($deathYear).'</span></p>
							 
							 <p class="singlePaintingText">About: <span class="singlePantingTextWhite">'. htmlentities($description).'</span></p>
							 
							 <p class="singlePaintingText"><a href="'. htmlentities($wikipedia).'" class="paintingWikiLink">See '. htmlentities($artistName).' on Wikipedia</a></p>
							 
							 <div class="clear"></div>';
			

			
			$output = $pictureHTML . $artistInfo;
			
			$paintersPaintings = my_read_file("text/paintings.txt");
			
			foreach ($paintersPaintings as $var)
			{
			
				if($var[1] == $artistName)
				{
					$output.= displayPainting($var[0], $artistName, $var[2]);
			
				}
			}
			
			return $output;
	
			
			}
	}

}


//Genre functions
function displayGenre($genre)
{
		$output = '<div>';
		
		$output .= '<h4><a href="single_genre.php?genre='.$genre.'" class="genreLinks">'.$genre.'</a></h4>';
		
		$output .= '</div>';
		
		return $output;		
}

function genres()
{
	
	$genre_list = my_read_file('text/paintings.txt');

			//$genre_list as $key => $value
						
			foreach ($genre_list as $key => $value) 
			{
				
				$genre_array[] = $value[9];
				
			}
			
			//stores the values of the genre list array and only saves values that are unique so that there are no duplicate genres 
			$genre_array = array_unique($genre_array);
			
			foreach ($genre_array as $key => $value) 
			{
				$output .= displayGenre($value);
						
			}
			

return $output;
}



function single_genre()
{
	controlPage('genre', 'paintings', 9, 'genres.php', "Genre not found!");
	
	
	$single_genre = my_read_file('text/paintings.txt');
			
	$theGenre = $_GET['genre'];
	
	
		$output = $theGenre. " Paintings<br/>"; 
	
			
			foreach ($single_genre as $var)
			{
				
							
				if (trim($var[9]) == $theGenre)
				{
					
					$output .= displayPainting($var[0], $var[1], $var[2]);
					
				}
			}
			
			
			
			return $output;
}

function searchresults()
{
	$globalSearch = $_POST['globalSearch'];
	
	$painting_list = my_read_file('text/paintings.txt');
	
	foreach($painting_list as $var)
	{
		
		if(stristr($var[2] , $globalSearch) !== false)
		{
				$foundresult .= displayPainting($var[0], $var[1], $var[2]);
		}
	}
	
		if(!isset($foundresult))
		{
			$foundresult = '<p>Your search '.$globalSearch.' did not match up with any paintings.<br/>
							<br/>Consider:<br/>
							<br/>- Checking your spelling<br/>
							<br/>- Look for a new painting<br/>
							<br/>- Look for a portion of the painting\'s name instead of the entire name<br/>
							<br/>- Look in the <a href="all_paintings.php" class="paintingWikiLink">Browse Paintings</a> section<br/>
							</p>';
		}
	
			return $foundresult;
}





?>