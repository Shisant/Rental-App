<?php
// Include config file
require_once 'config.php';

session_start();

// Define variables and initialize with empty values
$username = $password = "default";
$username_err = $password_err = "";

$link = mysqli_connect("localhost", "root", "", "rentalapp");
if($link === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}


if(isset($_SESSION['username']))
{
	$user_id = $_SESSION['user_id'];

	$username = $_SESSION['username'];
	$user_data_sql = "SELECT * FROM user_details WHERE username = '".$username."'";
	$user_id_sql = "SELECT * FROM users WHERE username = '".$username."'";
	$user_houses_sql = "SELECT current_address,country,house_type,rent FROM houses WHERE user_id = '".$user_id."'";
	$result = mysqli_query($link, $user_data_sql);
	$row = mysqli_fetch_assoc($result);

	$first_name = $row['first_name'];
	$last_name = $row['last_name'];
	$email= $row['username'];
	$mobile_number= $row['mobile'];
	$city= $row['address'];
	$state= $row['state'];
	$id = $row['id'];

	$result = mysqli_query($link, $user_id_sql);
	$row = mysqli_fetch_assoc($result);

	$houses_query = mysqli_query($link, $user_houses_sql);
	$houses_result = mysqli_fetch_all($houses_query);

	$user_id = $row['id'];

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		$first_name = $_POST['first_name'];
	    $last_name= $_POST['last_name'];
	    $email = $_POST['register_username'];
	    $city = $_POST['city'];
	    $state = $_POST['state'];
	    $mobile = $_POST['mobile_number'];


		$update_details_sql = "UPDATE user_details SET first_name='".$first_name."', last_name='".$last_name."', username='".$email."', mobile='".$mobile_number."', address='".$city."', state='".$state."' WHERE id='".$id."'";

		$abc = "UPDATE users SET username='".$email."' WHERE id='".$id."'";

		if(mysqli_query($link, $update_details_sql)){
		    // echo "Records inserted successfully.";
		    ?>

		    <script type="text/javascript">
		    	alert("Profile Updated.");
		    </script>

		    <?php
		  } else{
		  	//echo("Error description: " . mysqli_error($link));
		  	?>

		  	<script type="text/javascript">
		    	alert("Opps.Try Again");
		    </script>

		  	<?php
		  }

		  if(mysqli_query($link, $abc)){
		    ?>

		    <?php
		  } else{
		  	//echo("Error description: " . mysqli_error($link));
		  	?>

		  	<script type="text/javascript">
		    	alert("Opps.Try Again");
		    </script>

		  	<?php
		  }


	
	}
}
?>

<!DOCTYPE html>
<html>
<body>
  <!-- HEADER BEGINS -->
  
  <?php include 'includes/header.php'; ?>
  <?php include 'includes/profilesidebar.php'; ?>

  <!--MOBILE HEADER & SIDE-NAV-->
  <?php include 'includes/navbar.php'; ?>
  <div class="avl-container">
	<div class="tagline">
		<h4>Welcome <span><?php echo ($first_name)." ".($last_name) ?></span></h4>
		<p>You can change your account details here.</p>
	</div>
  </div>
	<div class="avl-container">
		<div class="row">
		    <form method="POST" action="profile.php" class="col s12 m10 l9 edit-form">
		      <div style="margin-bottom: 10px" class="row">
				<div class="input-field col s12 m6 l6">
				  <input value='<?php echo $first_name?>' disabled="true" id="first_name" type="text" class="validate" name="first_name">
				  <label for="first_name"><b>First Name</b></label>
				</div>
				<div class="input-field col s12 m6 l6">
				  <input value="<?php echo $last_name?>" disabled="true" id="last_name" type="text" class="validate" name="last_name">
				  <label for="last_name"><b>Last Name</b></label>
				</div>
			  </div>
			  <div style="margin-bottom: 10px" class="row">
				<div class="input-field col s12 m6 l6">
				  <input value="<?php echo $email?>" disabled="true" id="email" type="text" class="validate" name="register_username">
				  <label for="email"><b>E-mail</b></label>
				</div>
				<div class="input-field col s12 m6 l6">
				  <input value="<?php echo $mobile_number?>" disabled="true" id="mobno" type="text" class="validate" name="mobile_number">
				  <label for="mobno"><b>Mobile Number</b></label>
				</div>
			  </div>
			  <div style="margin-bottom: 0px" class="row">
				<div class="input-field col s12 m6 l6">
				  <input value="<?php echo $city?>" disabled="true" id="city" type="text" class="validate" name="city">
				  <label for="city"><b>City</b></label>
				</div>
				<div class="input-field col s12 m6 l6">
				  <input value="<?php echo $state?>" disabled="true" id="state" type="text" class="validate" name="state">
				  <label for="state"><b>State</b></label>
				</div>
			  </div>
			  <center style="margin-top: 15px">
				  <a class="btn" id="enable-edit"><i class="material-icons right">edit</i><b>Edit</b></a>
				  <button style="display: none;" class="btn" id="save-change" type="submit" name="action">Save Changes
				    <i class="material-icons right">send</i>
				  </button>
				  <a class="btn" style="display: none;" id="cancel-edit"><i class="material-icons right">close</i>Cancel</a>
			  </center>
		    </form>
	  	</div>
	</div>
	<!-- HEADER BEGINS -->
  <?php include 'includes/footer.php'; ?>
  <script>
  $(document).ready(function(){
   $(".button-collapse").sideNav({
    closeOnClick: true,
    draggable: true,
   });
   $('#enable-edit').click(function(){
   	 $(".edit-form input[type='text']").prop('disabled', false);
   	 $('#enable-edit').css('display', 'none');
   	 $('#save-change').css('display', 'inline-block');
   	 $('#cancel-edit').css('display', 'inline-block');
   	 $('input[type=text]:disabled,input[type=password]:disabled').css('border-bottom','1px solid #eee')
   })
   $('#cancel-edit').click(function(){
   	 $(".edit-form input[type='text']").prop('disabled', true);
   	 $('#enable-edit').css('display', 'inline-block');
   	 $('#save-change').css('display', 'none');
   	 $('#cancel-edit').css('display', 'none')
   	 $('input[type=text]:disabled,input[type=password]:disabled').css('border-bottom','1px dotted #e0')
   })
  });
  </script>
</body>
</html>