<?php 
// Include config file
require_once 'config.php';

session_start();

// Define variables and initialize with empty values
$username = $password = "default";
$username_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$mobile = $_POST['mobile'];
	$email = $_POST['email'];
	$profession = $_POST['profession'];
	$country = $_POST['country'];
	$house_type = $_POST['house_type'];

	$bolcony = 'false';
	if(isset($_POST['bolcony']))
	{
		$bolcony = $_POST['bolcony'];
	}

	$storeroom = 'false';
	if(isset($_POST['storeroom']))
  {
     $storeroom = $_POST['storeroom'];
  }

  $twowheeler = 'false';
  if(isset($_POST['twowheeler']))
  {
    $twowheeler = $_POST['twowheeler'];
  }

  $fourwheeler = 'false';
  if(isset($_POST['$fourwheeler']))
  {
     $fourwheeler = $_POST['fourwheeler'];
  }

  $discription = $_POST['discription'];


  $bachelor = 'false';
  if(isset($_POST['bachelor']))
  {
    $bachelor = $_POST['bachelor'];
  }

  $married = 'married';
  if(isset($_POST['married']))
  {
    $married = $_POST['married'];
  }

  $family = 'false';
  if(isset($_POST['family']))
  {
    $family = $_POST['family'];
  }

  $unmarried = 'false';
  if(isset($_POST['unmarried']))
  {
    $unmarried = $_POST['unmarried'];
  }

  $boys = 'false';
  if(isset($_POST['boys']))
  {
    $boys = $_POST['boys'];
  }

    $girls = 'false';
    if(isset($_POST['girls']))
    {
      $girls = $_POST['girls'];
    }

    $smoking = 'false';
    if(isset($_POST['smoking']))
    {
      $smoking = $_POST['smoking'];
  }
  $alcohol = 'false';
  if(isset($_POST['alcohol']))
  {
    $alcohol = $_POST['alcohol'];
  }
  $nonveg = 'false';
  if(isset($_POST['nonveg']))
  {
    $nonveg = $_POST['nonveg'];
  }
  $furnished = 'false';
  if(isset($_POST['furnished']))
  {
    $furnished = $_POST['furnished'];
  }

  $imgContent1 = null;
  $imgContent2 = null;
  $imgContent3 = null;
  $imgContent4 = null;  

  //var_dump($_FILES);
  //var_dump($_POST);

  if(isset($_FILES["image1"]) && $_FILES["image1"] && $_FILES["image1"]["tmp_name"]){
    $check1 = getimagesize($_FILES["image1"]["tmp_name"]);
  }else{
    $check1 = false;
  }
  if($check1 !== false){
        $image1 = $_FILES['image1']['tmp_name'];
        $imgContent1 = addslashes(file_get_contents($image1));
  }else{
    $imgContent1 = null;
  }

 if(isset($_FILES["image2"]) && $_FILES["image2"] && $_FILES["image2"]["tmp_name"]){
    $check2 = getimagesize($_FILES["image2"]["tmp_name"]);
  }else{
    $check2 = false;
  }
  if($check2 !== false){
        $image2 = $_FILES['image2']['tmp_name'];
        $imgContent2 = addslashes(file_get_contents($image2));
  }else{
    $imgContent2 = null;
  }

if(isset($_FILES["image3"]) && $_FILES["image3"] && $_FILES["image3"]["tmp_name"]){
    $check3 = getimagesize($_FILES["image3"]["tmp_name"]);
  }else{
    $check3 = false;
  }
  if($check3 !== false){
        $image3 = $_FILES['image3']['tmp_name'];
        $imgContent3 = addslashes(file_get_contents($image3));
  }else{
    $imgContent3 = null;
  }

if(isset($_FILES["image4"]) && $_FILES["image4"] && $_FILES["image4"]["tmp_name"]){
    $check4 = getimagesize($_FILES["image4"]["tmp_name"]);
  }else{
    $check4 = false;
  }
  if($check4 !== false){
        $image4 = $_FILES['image4']['tmp_name'];
        $imgContent4 = addslashes(file_get_contents($image4));
  }else{
    $imgContent4 = null;
  }


  $other_restrictions = $_POST['other_restrictions'];

  $flat = $_POST['flat'];
  $colony = $_POST['colony'];
  $landmark = $_POST['landmark'];
  $location = $_POST['location'];
  $state = $_POST['state'];
  $mobile_contact = $_POST['mobile_contact'];
  $current_address = $_POST['current_address'];
  $rent = $_POST['rent'];
  $date = $_POST['date'];

  $link = mysqli_connect("localhost", "root", "", "rentalapp");
  if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }

  $user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:null;

  $sql = "INSERT INTO houses VALUES (NULL,'$first_name', '$last_name', '$mobile','$email','$profession','$current_address','$country','$house_type','$bolcony','$storeroom','$furnished','$twowheeler','$fourwheeler','$discription','$bachelor','$family','$married','$boys','$girls','$smoking','$alcohol','$nonveg','$other_restrictions','$flat','$colony','$landmark','$location','$state', '$mobile_contact','$rent','$date','$imgContent1','$imgContent2','$imgContent3','$imgContent4','$user_id',NULL)";

  if(mysqli_query($link, $sql)){
    // echo "Records inserted successfully.";
    ?>

    <script type="text/javascript">
    	alert("Records inserted successfully.");
    </script>

    <?php
  } else{
    // echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
  	?>

  	<script type="text/javascript">
    	alert("Something went wrong.Try Again");
    </script>

  	<?php
  }

  mysqli_close($link);

}

if(isset($_SESSION['username']))
{
	$username = $_SESSION['username'];
	$link = mysqli_connect("localhost", "root", "", "rentalapp");
	$sql = "SELECT * FROM user_details WHERE username = '".$username."' ";

	$result = mysqli_query($link, $sql);
	$row = mysqli_fetch_assoc($result); 

	$first_name = $row['first_name'];
	$last_name = $row['last_name'];
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>MERO GHAR</title>
  <meta charset="utf-8"/>
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
  <link href="assets/css/dcalendar.picker.css" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="assets/css/normalize.css"  media="screen,projection"/>  
  <link type="text/css" rel="stylesheet" href="assets/css/set2.css"  media="screen,projection"/>  
  <link type="text/css" rel="stylesheet" href="assets/css/materialize.css"  media="screen,projection"/>  
  <link type="text/css" rel="stylesheet" href="assets/css/header.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="assets/css/footer.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="assets/css/accomodate.css"  media="screen,projection"/>
  <link rel="stylesheet" href="assets/css/validin.css" type="text/css" media="all"/>
  <script src="https://use.fontawesome.com/4ef4ce7ce4.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
  <!-- HEADER BEGINS -->
<?php include 'includes/header.php'; ?>
<!--HEADER ENDS-->

  <div class="avl-container">
  	<div class="tagline">
  	  <h4>Looking for a <span>Tenant</span></h4>
  	  <h3>Join our large family of happy landlords.</h3>
  	</div>
  </div>
<!--Page 1-->
  <form method="POST" action="accomodate.php" onsubmit="" enctype="multipart/form-data">
  <div class="avl-container row">
  <div class="form-border col s12 m10 l9">
    <h4>Personal Details</h4>
    <div class="header-underline"></div>
      <div class="row">
        <div class="input-field col s12 m6 l6">
          <p>First Name</p>
          <input id="name" name="first_name" type="text" class="validate" placeholder="John Doe" validate="name" required>
        </div>
		    <div class="input-field col s12 m6 l6">
          <p>Last Name</p>
          <input id="lname" name="last_name" type="text" placeholder="Name" class="validate" validate="name" required>
        </div>
      </div>
      <div class="row">
        <div class="col s12">  
          <p>Phone Number</p>
        </div>  
        <div class="input-field col s12 m6 l6">
          <input id="num1" name="mobile" type="text" placeholder="Mobile number" class="validate" validate="phone" required>
        </div>
      </div>
      <div class="row">
	    <div class="input-field col s12 m6 l6">
          <p>E-mail</p>
          <input id="email" name="email" type="email" placeholder="abc@example.com" class="validate" validate="email" required>
        </div>
        <div class="input-field col s12 m6 l6">
          <p>Profession</p>
          <input id="profession" name="profession" type="text" class="validate" placeholder="Your profession" validate="alpha">
        </div>
      </div>
      <div class="row">
        <div class="col s12">  
          <p>Current Address</p>
        </div>
        <div class="input-field col s12 m6 l6">
          <input id="city" name="current_address" type="text" placeholder="City" class="validate" validate="state_city" required>
        </div>
         <div class="col s12">  
          <p>Country </p>
        </div>
        <div class="input-field col s12 m6 l6">
          <input id="state" name="country" type="text" placeholder="State" class="validate" validate="state_city" required>
        </div>        
      </div>  
  </div>  
  </div> 
<!--Page 2-->
  <div class="avl-container hide-pop row" id="pg2">
  <div class="form-border col s12 m10 l9"> 
    <h4>Property Details</h4>
    <div class="header-underline"></div>      
    <div class="row option-margin">
        <p class="col s12"><b>House Type:</b></p> 
        <p class="col s6 m6 l6">
          <input class="with-gap" name="house_type" value="3BHK" type="radio" id="test1" checked/>
          <label for="test1">3 BHK</label>
        </p>
        <p class="col s6 m6 l6">
          <input class="with-gap" name="house_type" value="2BHK" type="radio" id="test2" />
          <label for="test2">2 BHK</label>
        </p>
        <p class="col s6 m6 l6">
          <input class="with-gap" name="house_type" value="1BHK" type="radio" id="test3" />
          <label for="test3">1 BHK</label>
        </p>
        <p class="col s6 m6 l6">
          <input class="with-gap" name="house_type" value="Single Room" type="radio" id="test4" />
          <label for="test4">Single Room</label>
        </p>
        <p class="col s6 m6 l6">
          <input class="with-gap" name="house_type" value="Shared Room" type="radio" id="test5" />
          <label for="test5">Shared Room</label>
        </p>
        <p class="col s6 m6 l6">
          <input class="with-gap" name="house_type" value="Paying Guest" type="radio" id="test6" />
          <label for="test6">Paying Guest</label>
        </p> 
    </div> 
	<div class="row option-margin">
		  <p class="col s12"><b>Others:</b></p>                                                       
	    <p class="col s6 m4 l3">
	      <input type="checkbox" name="storeroom" value="true" class="filled-in" id="storeroom"/>
	      <label class="check-pos" for="storeroom"></label>
	      Store Room
	    </p>         
	    <p class="col s6 m4 l3">
	      <input type="checkbox" name="bolcony" value="true" class="filled-in" id="bolcony"/>
	      <label class="check-pos" for="bolcony"></label>
	      Balcony
	    </p>
		<p class="col s6 m4 l3">
		  <input type="checkbox" name="furnished" value="true" class="filled-in" id="furnished"/>
          <label class="check-pos" for="furnished"></label>
		  Furnished
		</p>
    </div>
    <div class="row option-margin">    
      <p class="col s12"><b>Parking:</b></p>                                       
      <p class="col s12 m4 l3">
        <input type="checkbox" class="filled-in" id="no-w" onclick="change(this)"/>
        <label for="no-w">None</label>
      </p> 
      <p class="col s12 m4 l3">
        <input type="checkbox" class="filled-in prefnot" name="twowheeler" value="true" id="2-w" onclick="deselect(this)"/>
        <label for="2-w">Two-Wheeler</label>
      </p>
      <p class="col s12 m4 l3">
        <input type="checkbox" class="filled-in prefnot" name="fourwheeler" value="true" id="4-w" onclick="deselect(this)"/>
        <label for="4-w">Four-Wheeler</label>
      </p>                      
    </div>
    <div class="row option-margin">
	  <p class="col s4 m2 l2"><b>Description:</b></p>
	  <div class="input-field col s8 m9 l9">
		<textarea name="discription" id="textarea1" class="materialize-textarea"></textarea>
	  </div>
	</div>    
  </div>  
  </div>   
<!--PAGE 3-->
  <div class="avl-container hide-pop row" id="pg3">
    <div class="form-border col s12 m10 l9">
    <h4>Tenant Preferences</h4>
    <div class="header-underline"></div>
	<div class="option-margin">
    <div class="row pref-padding">
		<p class="col s12"><b>Type of Tenant you Prefer:</b></p>
		<p class="col s6 m5 l5">
	      <input type="checkbox" class="filled-in" id="check8" onclick="toggle(this)"/>
	      <label for="check8">All</label>
	    </p>
        <p class="col s6 m7 l7">
	      <input type="checkbox" name="bachelor" value="true" class="filled-in pref"  id="check2" />
	      <label for="check2">Bachelor</label>
	    </p> 
    </div>
    <div class="row pref-padding">   
	    <p class="col s6 m5 l5">
	      <input type="checkbox" name="married" value="true" class="filled-in pref"  id="check3" />
	      <label for="check3">Married couples</label>
	    </p> 
	    <p class="col s6 m7 l7">
	      <input type="checkbox" name="family" value="true" class="filled-in pref" id="check4" />
	      <label for="check4">Family</label>
	    </p>
    </div> 
    <div class="row pref-padding">     
	    <p class="col s6 m5 l5">
	      <input type="checkbox" class="filled-in pref" name="unmarried" value="true" id="check5" />
	      <label for="check5">Unmarried couples</label>
	    </p>
	    <p class="col s6 m7 l7">
	      <input type="checkbox" class="filled-in pref" name="boys" value="true" id="check6" />
	      <label for="check6">Boys Only</label>
	    </p>
    </div> 
    <div class="row pref-padding">     
	    <p class="col s6 m5 l5">
	      <input type="checkbox" class="filled-in pref" name="girls" value="true" id="check7" />
	      <label for="check7">Girls Only</label>
	    </p>
    </div>
	</div>
      <div class="row option-margin">
		<p class="col s12"><b>Imposed Restrictions:</b></p>
        <p class="col s9">
	      <input type="checkbox" class="filled-in" name="smoking" value="true" id="check9" />
	      <label for="check9">Smoking</label>
	    </p> 
	    <p class="col s9">
	      <input type="checkbox" class="filled-in" name="alcohol" value="true" id="check10" />
	      <label for="check10">Alcohol</label>
	    </p> 
	  </div>
	  <div class="row">
	    <p class="col s12 m4 l3"><b>Any Others Restriction: </b></p>
        <div class="input-field col s12 m5 l6">
          <textarea id="textarea2" name="other_restrictions" class="materialize-textarea"  placeholder="Mention any other restrictions"></textarea>
        </div>  
      </div>
    </div>
  </div>
<!--PAGE 4-->
  <div class="avl-container hide-pop row" id="pg4">
    <div class="form-border col s12 m10 l9">
    <h4>House Details</h4>
    <div class="header-underline"></div>    
      <div class="row">
		<p class="col s12"><b>House Address:</b></p>
        <div class="input-field col s3 m2 l2">
          <p>Address</p>
        </div>      
        <div class="input-field col s8">
          <input id="name" name="flat" type="text" placeholder="Flat No./House No./House Name" class="validate" validate="address" required>
        </div>
        <div class="input-field col s8 offset-s3 m8 offset-m2">
          <input id="name" name="colony" id="colony" type="text" placeholder="Colony/Street/Locality" class="validate" required>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s3 m2 l2">
          <p>Landmark</p>
        </div>
        <div class="input-field col s8">
          <input id="name" name="landmark" type="text" placeholder="Opposite to some school" class="validate" validate="address">
        </div>        
      </div>
        <div class="row">
	      <div class="input-field col s3 m2 l2">
	        <p>City</p>
	      </div>
	      <div class="input-field col s8 m4 l4">
	        <input id="name" name="location" type="text" placeholder="Eg. Lalitpur" class="validate" validate="state_city" required>
	      </div>
	      <div class="input-field col s3 m2 l2">
	        <p>Pardesh</p>
	      </div>      
	      <div class="input-field col s8 m4 l4">
	        <input id="name" name="state" type="text" placeholder="Eg. Pardesh No. 1" class="validate" validate="state_city" required>
	      </div>         
	    </div> 	 
        <div class="row">    
	      <div class="input-field col s3 m2 l2">
	        <p>Contact No.</p>
	      </div>      
	      <div class="input-field col s8 m4 l4">
	        <input id="name" name="mobile_contact" type="text" placeholder="+977" class="validate" validate="phone" required>
	      </div> 	         
	    </div>
      <div class="row option-margin" id="avlimages">
	     	<p class="col s12"><b>House Images:</b></p>
        <div class="file-field input-field col s12 m6 l6">
          <div class="btn">
            <span>File</span>
            <input type="file" name="image1">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
          </div>
        </div>
        <div class="file-field input-field col s12 m6 l6">
          <div class="btn">
            <span>File</span>
            <input type="file" name="image2">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
          </div>
        </div>
        <div id="img-three" class="file-field input-field col s12 m6 l6">
          <div class="btn">
            <span>File</span>
            <input type="file" name="image3">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
          </div>
        </div>
        <div id="img-four" class="file-field input-field col s12 m6 l6">
          <div class="btn">
            <span>File</span>
            <input type="file" name="image4">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
          </div>
        </div>
        <a id="add_img" style="left: 0.7rem; position: relative;" class="btn"><i class="material-icons right">add</i>Add more</a>
      </div>
      <div class="row option-margin">
		    <p class="col s7 m4 l3"><b>Rent per Month:</b></p>
  		  <div class="input-field col s12 m8 l5 m-0">
  	        <p class="m-0"><input name="rent" class="materialize-textarea" placeholder="" validate="alpha_num_dash" required>NPR</p>
  	    </div>
	    </div>
	  <div class="row option-margin">
		<p class="col s12 m4 l3"><b>House Available from Date:</b></p>
		<div class="input-field col s11 m2 l5">
            <input name="date" id="moveInDate" class="materialize-textarea" type="date" required>
    </div>
	  </div>
    </div>
   </div>
	<a href="#" class="waves-effect waves-light next button-center" onclick="popup(this)"><i class="fa fa-angle-double-down right" aria-hidden="true"></i>NEXT</a>     
	<div class="button-message"></div>
	<button type="submit" class="button-center hide-pop" id="bt">SUBMIT<i class="material-icons right sub-icon">send</i></button>  
  </form>
 <?php include 'includes/footer.php';?>

  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/materialize.min.js"></script>
  <script src="assets/js/dcalendar.picker.js"></script>
  <script src="assets/js/validin.js"></script>  
<script>
var i=1;
$(document).ready(function(){
  $(".button-collapse").sideNav();
  $('#add_img').click(function(){
    if(i==1){
      $("#img-three").css('display','block');
      $("#img-four").css('visibility','hidden');
      $("#img-four").css('display','block');
    } else if(i==2) {
      $('#img-four').css('visibility','visible');
    } else if(i>2) {
      $('#avlimages').append('<p style="margin-top:10px;left: 0.7rem; position: relative;"><span style="color:#49baff">Sorry, maximum fours images can be added!</span><p>')
    }
    i=i+1;
  });
});
$('#moveInDate').dcalendarpicker();
$('#login').modal();
$('#signup').modal({
  endingTop: '0', // Ending top style attribute
});
   
$('form').validin();

function toggle(source) {
  checkboxes = document.getElementsByClassName('pref');
  for(var i=0, n=checkboxes.length; i<n; i++) {
	checkboxes[i].checked = source.checked;
  }
}
function change(source) {
  checkboxes = document.getElementsByClassName('prefnot');

  if(source.checked==true){ 
  for(var i=0, n=checkboxes.length; i<n; i++) {
    checkboxes[i].checked = false;
  } }
} 

function deselect(source){
  x = document.getElementById("no-w");
  if(source.checked==true){
    x.checked = false;
  }
}


var flag = 0;
function popup(source){
  var w = document.getElementById("pg1");
  var x = document.getElementById("pg2");
  var y = document.getElementById("pg3");
  var z = document.getElementById("pg4");
  var btn = document.getElementById("bt");
  if(flag == 0){
  x.style.display = "block";
  source.href = "#pg2";
  flag++;
  }
  else if(flag == 1){
    y.style.display = "block";
    y.style.height = "100%";
    flag++;
    source.href = "#pg3";
  }
  else if(flag == 2){
    z.style.display = "block";
    z.style.height = "100%";
    flag++;
    source.style.display = "none";
    btn.style.display = "block";
    btn.style.height = "100%";
    source.href = "#pg4";
  }
}

  $(document).ready(function(){  
  $("a").on('click', function(event) {

    if (this.hash !== "") {
      event.preventDefault();

      var hash = this.hash;

      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 1000, function(){
   
        window.location.hash = hash;
      });
    } 
  });

  });

</script> 

</body>
</html>