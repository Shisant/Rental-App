<?php
// Include config file
require_once 'config.php';

session_start();

// Define variables and initialize with empty values
$username = $password = "default";
$username_err = $password_err = "";


if(isset($_SESSION['username']) && isset($_GET['id']))
{
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM user_details WHERE username = '".$username."'";

    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);

    $house_id = $_GET['id']; 
    $user_first_name = $row['first_name'];
    $user_last_name = $row['last_name'];
    $user_contact = $row['mobile'];
    $user_address= $row['address'];
    $user_id = $row['id'];
    $user_email =$row['username'];


    $sql = "INSERT INTO successful VALUES (NULL,$user_id, $house_id)";

    $username = $_SESSION['username'];
    $sql2 = "SELECT * FROM houses WHERE id = '".$house_id."'";
    if($result = mysqli_query($link, $sql2)){
    if(mysqli_num_rows($result) > 0){

       while($row = mysqli_fetch_array($result)){

        $house_id = $row['id'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $mobile = $row['mobile'];
        $email = $row['email'];
        $profession = $row['profession'];
        $house_type = $row['house_type'];
        $bolcony = $row['bolcony'];
        $store_room = $row['storeroom'];
        $twowheeler = $row['twowheeler'];
        $fourwheeler = $row['fourwheeler'];
        $discription = $row['discription'];
        $bachelor = $row['bachelor'];
        $family = $row['family'];
        $married = $row['married'];
        $boys = $row['boys'];
        $girls = $row['girls'];
        $smoking = $row['smoking'];
        $alcohol = $row['alcohol'];
        $nonveg = $row['nonveg'];
        $date = $row['date'];
        $contact = $row['contact'];
        $location = $row['location'];
        $state = $row['state'];
        $rent = $row['rent'];
        $colony = $row['colony'];
        $furnished=$row['furnished'];
       }

      // echo $first_name." ".$last_name." ".$mobile." ".$email." ".$date." ".$location." ".$rent; exit();

      }

    }

    if($stmt = mysqli_prepare($link, $sql)){

            if(mysqli_stmt_execute($stmt)){

              // Import PHPMailer classes into the global namespace
              // These must be at the top of your script, not inside a function
             

              // Load Composer's autoloader
              require 'lib/phpmailer/PHPMailerAutoload.php';

              // Instantiation and passing `true` enables exceptions
              $mail = new PHPMailer(true);

              try {
                //Server settings
                //$mail->SMTPDebug = 4;                                       // Enable verbose debug output
                $mail->isSMTP();                                            // Set mailer to use SMTP
                $mail->Host       = 'smtp.gmail.com;';  // Specify main and backup SMTP servers
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'MedicareMedicineDistributors@gmail.com';                     // SMTP username
                $mail->Password   = 'redminote3';                               // SMTP password
                $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
                $mail->Port       = 587;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom('MedicareMedicineDistributors@gmail.com', 'MERO GHAR');
                $mail->addAddress($user_email, '');     // Add a recipient
                $mail->addAddress($email,'');  
                $mail->addAddress('gcshishir007@gmail.com','copy');              // Name is optional
                $mail->addReplyTo('MedicareMedicineDistributors@gmail.com', 'Information');

                // Attachments
               // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
               // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'House Details';
                $mail->Body    = '<h1>Hello, </h1> <h2>this is house details you needed.</h2> <b>House owner: </b>'.$first_name." ".$last_name." ".'<b>House address: </b>'.$location." ".'<b>House owners mobile: </b>'.$mobile." ".'<b>House owners email address: </b>'.$email." ".'<b>Available From: </b>'.$date." ".'<b>Monthly rent: </b>'.$rent." ".'<h1>Tenants Details: </h1><b>Tenant Name: </b>'.$user_first_name." ".$user_last_name." ".'<b>Email: </b>'.$user_email." ".'<b>Address: </b>'.$user_address." ".'<b>Contact: </b>'.$user_contact;

                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                ?>
                 <script type="text/javascript"> -->
                   alert("Mesage has been sent."); 
                </script>
                <?php
                
                echo 'Message has been sent';
              } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
              }

            } else{
                ?>
                <script type="text/javascript"> -->
                   alert("Something went wrong. Please try again later."); 
                </script>
                <?php echo "Error"; ?>
                <?php

            }

}

}
?>

<!DOCTYPE html>
<html>
<head>
  <script type="text/javascript">
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
  </script>
  <title>MERO GHAR</title>
  <meta charset="utf-8"/>
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link type="text/css" rel="stylesheet" href="assets/css/materialize.css"  media="screen,projection"/>
  <link href="assets/css/dcalendar.picker.css" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="assets/css/successful.css" media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="assets/css/header.css" media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="assets/css/footer.css" media="screen,projection"/>
  <script src="https://use.fontawesome.com/4ef4ce7ce4.js"></script>
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi"/>
    <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="assets/js/materialize.min.js"></script>
  <script src="assets/js/slick.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
  <div class="avl-header avl-container">
	<a href="index.php">
		<img src="assets/images/logo.png">
		<h5>MERO GHAR</h5>
	</a>
	<ul>
	  <li><?php if(isset($_SESSION['username'])) { ?>
		   		<a href="index.php">HOME</a>
		  <?php } ?>
	  </li>
    <li><?php if(isset($_SESSION['username'])) { ?>
                <a href="accomodate.php">ACCOMODATE</a>
          <?php } ?>
          <?php  if(!isset($_SESSION['username'])) { ?>
                <a class="modal-trigger" href="#login">ACCOMODATE</a>
          <?php } ?>
    </li>
    <li><?php if(!isset($_SESSION['username'])) { ?>
		   		<a class="modal-trigger" href="#login">LOGIN</a>
		  <?php } ?>
		  <?php  if(isset($_SESSION['username'])) { ?>
		   		<a class="modal-trigger" href="profile.php">
					<?php echo strtoupper($first_name)." ".strtoupper($last_name) ?>
				</a>
		  <?php } ?>
	  </li>
	  <li><?php  if(!isset($_SESSION['username'])) { ?>
		   		<a class="modal-trigger" href="#signup">SIGN UP</a>
		  <?php } ?>
		  <?php  if(isset($_SESSION['username'])) { ?>
		   		<a href="logout.php"> LOGOUT</a>
		  <?php } ?>
	  </li>
	</ul>
  </div>
 <?php  if(isset($_SESSION['username'])) { ?>
         <div class="avl-container">
    <div class="row ack">
      <div class="col s12 m3 l3 offset-l1">
          <img class="responsive-img" src="assets/images/chat.png">
      </div>
      <div class="col s12 m9 l8">
          <div class="tagline">
            <h4>Thank You <span><?php echo $first_name." ".$last_name; ?></span></h4>
            <h4>We have recieved your request.</h4>
            <h4>We will <span>contact you</span> soon.</h4>
            <h4>Wait for E-mail.</h4>
          </div>
      </div>
    </div>
  </div>
  
  <?php } ?>

  
	<?php include 'includes/footer.php';?>
  <script>
$(document).ready(function(){

$('#moveInDate').dcalendarpicker();

});
  </script>
</body>
</html>