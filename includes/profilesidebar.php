<!-- SIDE BAR BEGINS -->
<link type="text/css" rel="stylesheet" href="assets/css/profilemenu.css"  media="screen,projection"/>
<div id="mySidebar" class="sidebar">
  	<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  	<a href="houses.php">MY POSTS</a>
  	<a href="likedhouses.php">LIKED POST</a>
</div>
<div id="main">
  <button class="openbtn" onclick="openNav()">☰ MY PROFILE</button> 
 </div>

<script>
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>
