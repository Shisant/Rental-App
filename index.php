<?php
require_once 'config.php';

session_start();

include 'signup.php';

if(isset($_SESSION['username']))
{
	$username = $_SESSION['username'];
	$sql = "SELECT * FROM user_details WHERE username = '".$username."'";

	$result = mysqli_query($link, $sql);
	$row = mysqli_fetch_assoc($result); 

	$first_name = $row['first_name'];
	$last_name = $row['last_name'];
  $user_id = $row['id'];
  $_SESSION['user_id'] = $user_id;
}
?>

<!DOCTYPE html>
<html>
<body>
  <!-- HEADER BEGINS -->
  <?php include 'includes/header.php'; ?>
  <!--MOBILE HEADER & SIDE-NAV-->
  <?php include 'includes/navbar.php'; ?>
  <div id="accomodate" class="modal tagline">
   <div class="modal-content m-container">
       <div class="avl-heading">
           <h4>Accomodate</h4>
           <div></div>
       </div>
       <div class="row">
            <p class="mb-4">Upload free advertisement and find a suitable tenant.<br>
            Please, <span>Login</span> to continue.</p>
            <a href="#login" id="lgn" class="btn modal-button">Login</a>
            <p class="mb-4">New? Create a <span>new account</span>.</p>
            <a href="#signup" id="sgnup" class="btn modal-button">Sign Up</a>
       </div>
    </div>
  </div>
  <div id="login" class="modal tagline lgn">
   <form method="POST" action="index.php">
    <div class="modal-content m-container">
       <div class="avl-heading">
         <h4>Login</h4>
         <div></div>
       </div>
       <div class="row">
        <div class="input-field col s12">
          <input id="Email_id" type="email" name="login_username" class="validate" required>
          <label for="Email_id">Email ID</label>
        </div>
        <div class="input-field col s12">
          <input id="password" type="password" name="login_password" minlength="8" required>
          <label for="password">Password</label>
        </div>
      </div>
      <button class="btn left modal-button" type="submit" >Login</button>
    </div>
   </form>
  </div>
  <div id="signup" class="modal tagline">
    <form method="POST" action="index.php">
      <div class="modal-content m-container">
          <div class="avl-heading">
            <h4>Sign Up</h4>
            <div></div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <input id="first_name" type="text" name="first_name" class="validate" required>
              <label for="first_name">First Name</label>
            </div>
            <div class="input-field col s12 m6 l6">
              <input id="last_name" type="text" name="last_name" class="validate" required>
              <label for="last_name">Last Name</label>
            </div>
            <div class="input-field col s12 m12 l12">
              <input id="email" type="email" name="register_username" class="validate" required>
              <label for="email">E-mail</label>
            </div>
            <div class="input-field col s12 m6 l6">
              <input id="password" type="password" data-error="Minimum 8 charracters required." minlength="8" name="register_password" required>
              <label for="password">Password</label>
            </div>
            <div class="input-field col s12 m6 l6">
              <input id="mobno" type="tel" name="mobile_number" data-error="Enter a valid 10 digit number." data-length="10" class="validate" required>
              <label for="mobno">Mobile Number</label>
            </div>
            <div class="input-field col s12 m6 l6">
              <input id="city" type="text" name="city" class="validate" required>
              <label for="city">City</label>
            </div>
            <div class="input-field col s12 m6 l6">
              <input id="state" type="text" name="state" class="validate" required>
              <label for="state">State</label>
            </div>
          </div>
          <button class="btn left modal-button" type="submit">Sign Up</button>
      </div>
    </form>
  </div>
  <!-- HEADER ENDS -->
  <div class="avl-container">
	<div class="tagline hide-on-small-only">
		<h4>Welcome to <span>your</span> humble abode</h4>
		<h3>Choose from a large number of accomodations</h3>
		<h3>to <span>feel at home away from home</span>.</h3>
	</div>
    <div class="tagline show-on-small hide-on-med-only hide-on-large-only">
        <h4>Welcome to <span>your</span> humble abode</h4>
        <h3>Choose from a large number of accomodations to <span>feel at home away from home</span>.</h3>
    </div>
	<div class="row">
    	<form action="filter.php" method="GET" class="col s12 m10 l9" style="padding:0px">
    		<div class="search-bar"> 
    		  <div class="row">
    			<div class="col s5 m6 l5" style="border-right:1px solid #eee">
    			  <label><h6>LOCATION</h6></label>
    			  <input type="text" name="location" placeholder="Enter Location" id="location" required>
    			</div>
    			<div class="col s5 m5 l5" style="padding: 0 0.75rem 0 1.45rem;">
    			  <label><h6>DATE</h6></label>
    			  <input id="moveInDate" name="date" placeholder="Check in date" required>
    			</div>
    			<div class="col s2 m3 l2" style="text-align:center">
    			  <button type="submit">
                    <span class="hide-on-small-only">Search</span>
                    <span class="show-on-small hide-on-med-only hide-on-large-only">Go</span>
                  </button> 	      
    		    </div> 
    		  </div>
    		</div>
    	</form>
	</div>
	
	<!--TOP CITIES-->
	
	  <script>
      $('.top-cities').slick({
        infinite:true,
        responsive: [
            {
              breakpoint: 2000,
              settings: {
                slidesToShow: 6,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 770,
              settings: {
                slidesToShow: 5,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 4,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 310,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1
              }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
      });
      </script>

<?php include 'about.php';?>

<?php include 'includes/footer.php';?>
  
<script>
$(document).ready(function(){
   $(".button-collapse").sideNav({
    closeOnClick: true,
    draggable: true,
   });
   $('#moveInDate').dcalendarpicker();
   $('#login').modal();
   $('#accomodate').modal();
   $('#contact').modal();
   $('#signup').modal({
      endingTop: '30', // Ending top style attribute
   });
   $('#lgn').click(function(){
        $('#accomodate').modal('close');
        $('#contact').modal('close');
        $('#login').modal('open');
   });
   $('#sgnup').click(function(){
        $('#accomodate').modal('close');
        $('#contact').modal('close');
        $('#signup').modal('open');
   });
});
  </script>
</body>
</html>