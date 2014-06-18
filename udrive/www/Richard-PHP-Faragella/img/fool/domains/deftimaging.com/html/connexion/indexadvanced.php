<?php $page = "home" ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Connexion Christian Fellowship | Home</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/pkgs/animator.js"></script>
<script type="text/javascript">


// Needed for animator.js
function $(id) {
	return document.getElementById(id);
}
function toggleSample(name, reEvaluate, methodName) {
	var el = $(name);
	if (!window[name] || reEvaluate) {
		eval(el.originalText || el.innerText || el.innerHTML.unescapeHTML());
	}
	if (methodName === false) return;
	methodName = methodName || 'toggle';
	return window[name][methodName]();
}
function toggleSource(el) {
	el = $(el);
	el.style.display = (el.style.display == 'none') ? '' : 'none'; 
}
	
	</script>
    


</head>

<body>

<div class="container"> 

<div class="logo"> <img src="img/use/logo.png" alt="Connexion Logo" /> </div>

<div class="mu">
 
<ul> 
      <li style="padding-right:0px; border-right:none;"><?php if ($page != "contact") {echo "<a href=\"contact.php\">";} ?>Contact<?php if ($page != "contact") {echo "</a>";} ?></li>
      <li><?php if ($page != "messageboard") {echo "<a href=\"messageboard.php\">";} ?>Message Board <?php if ($page != "messageboard") {echo "</a>";} ?></li> 
	  <li><?php if ($page != "locations") {echo "<a href=\"locations.php\">";} ?>Locations<?php if ($page != "locations") {echo "</a>";} ?></li> 
	  <li><?php if ($page != "meetingtimes") {echo "<a href=\"meetingtimes.php\">";} ?>Meeting Times<?php if ($page != "meetingtimes") {echo "</a>";} ?></li> 
	  <li><?php if ($page != "ministries") {echo "<a href=\"ministries.php\">";} ?>Ministries<?php if ($page != "ministries") {echo "</a>";} ?></li>       
	  <li><?php if ($page != "mission") {echo "<a href=\"mission.php\">";} ?>Mission<?php if ($page != "mission") {echo "</a>";} ?></li>
	  <li><?php if ($page != "home") {echo "<a href=\"index.php\">";} ?>Home<?php if ($page != "home") {echo "</a>";} ?></li> 
</ul>

<!-- Kill MU -->
</div>


<div class="main"> <div id="main2"> </div> <div id="main3"> </div> <div id="main4"> </div> <div id="main5"> </div> <div id="main1"> </div> </div>

<div class="slideContainer"> 

<a href="javascript:changeClass()"><div class="slide" id="slideOne"> <div class="slideTop" ><img src="img/use/homeSlides/small/1.png" /></div> <div class="slideBtm"><p><a href="javascript:changeClass()">Steve and Candy</a></p> </div></div></a>

<a href="javascript:changeClass()"><div class="slide" id="slideTwo"> <div class="slideTop"><img src="img/use/homeSlides/small/2.png" /></div> <div class="slideBtm"><p><a href="javascript:changeClass()">Peace!</a></p> </div></div></a>

<a href="javascript:changeClass()"><div class="slide" id="slideThree"> <div class="slideTop"><img src="img/use/homeSlides/small/3.png" /></div> <div class="slideBtm"><p><a href="javascript:changeClass()">Text Messages</a></p> </div></div></a>

<a href="javascript:changeClass()"><div class="slide" id="slideFour"> <div class="slideTop"><img src="img/use/homeSlides/small/4.png" /></div> <div class="slideBtm"><p><a href="javascript:changeClass()">The Road</a></p> </div></div></a>

<a href="javascript:changeClass()"><div class="slide" id="slideFive"> <div class="slideTop"><img src="img/use/homeSlides/small/5.png" width="155" /></div> <div class="slideBtm"><p id"lbl5"><a href="javascript:changeClass()">Mountain Worship</a></p> </div></div></a>

</div>


<div class="boxContainer"> 

<div class="box1 boxMargin"> </div>
<div class="box2 boxMargin"> </div>
<div class="box3 "> </div>
<div class="boxBigR"> </div>
<div class="boxBigL"> 

<div class="box4">  </div>

<div class="box5 boxMargin"> </div>
<div class="box5 boxMargin"> </div>
<div class="box5"> </div>
<div class="box9"> </div>



<!-- KILL boxBigL -->
</div>



<!-- KILL boxContainer -->
</div>





<!-- KILL container -->
</div>


</body>

</html>



		<script type="text/javascript">
		
		//slide
			var sld1 = Animator.apply($('slideOne'), "margin-top: 72px", {duration: 300});
			$('slideOne').onmouseover = function(){sld1.seekTo(1)};
			$('slideOne').onmouseout = function(){sld1.seekTo(0)};
			
			var sld2 = Animator.apply($('slideTwo'), "margin-top: 72px", {duration: 300});
			$('slideTwo').onmouseover = function(){sld2.seekTo(1)};
			$('slideTwo').onmouseout = function(){sld2.seekTo(0)};

			var sld3 = Animator.apply($('slideThree'), "margin-top: 72px", {duration: 300});
			$('slideThree').onmouseover = function(){sld3.seekTo(1)};
			$('slideThree').onmouseout = function(){sld3.seekTo(0)};

			var sld4 = Animator.apply($('slideFour'), "margin-top: 72px", {duration: 300});
			$('slideFour').onmouseover = function(){sld4.seekTo(1)};
			$('slideFour').onmouseout = function(){sld4.seekTo(0)};
			
			var sld5 = Animator.apply($('slideFive'), "margin-top: 72px", {duration: 300});
			$('slideFive').onmouseover = function(){sld5.seekTo(1)};
			$('slideFive').onmouseout = function(){sld5.seekTo(0)};
			
		//change main pic

			var ch1 = Animator.apply($('main1'), "opacity: 0", {duration: 700});
			var ch2 = Animator.apply($('main2'), "opacity: 0", {duration: 700});			
			var ch3 = Animator.apply($('main3'), "opacity: 0", {duration: 700});
			var ch4 = Animator.apply($('main4'), "opacity: 0", {duration: 700});			
			var ch5 = Animator.apply($('main5'), "opacity: 0", {duration: 700});			
			
			$('slideOne').onclick = function(){ch1.seekTo(0), ch2.seekTo(1), ch3.seekTo(1), ch4.seekTo(1), ch5.seekTo(1)};
			$('slideTwo').onclick = function(){ch1.seekTo(1), ch2.seekTo(0), ch3.seekTo(1), ch4.seekTo(1), ch5.seekTo(1)};
			$('slideThree').onclick = function(){ch1.seekTo(1), ch2.seekTo(1), ch3.seekTo(0), ch4.seekTo(1), ch5.seekTo(1)};
			$('slideFour').onclick = function(){ch1.seekTo(1), ch2.seekTo(1), ch3.seekTo(1), ch4.seekTo(0), ch5.seekTo(1)};
			$('slideFive').onclick = function(){ch1.seekTo(1), ch2.seekTo(1), ch3.seekTo(1), ch4.seekTo(1), ch5.seekTo(0)};
			
		</script>

<script language="javascript">
function changeClass(){
document.getElementById("idElement").setAttribute("class", "myClass");
}
</script>
