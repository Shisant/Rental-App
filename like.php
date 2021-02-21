<?php
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

    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $contact = $row['mobile'];
    $address= $row['address'];
    $user_id = $row['id'];

  $likes_sql = "INSERT INTO liked VALUES (NULL,$user_id, $house_id)";

   if(mysqli_query($link, $likes_sql)){
    // echo "Records inserted successfully.";
    ?>

   <script type="text/javascript">
                        alert("You liked this Property");
                        window.location = "index.php"
                    </script>
    <?php
  } else{
  	?>

  	<script type="text/javascript">
    	alert("Something went wrong.Try Again");
    </script>

  	<?php
  }

  mysqli_close($link);

}

?>