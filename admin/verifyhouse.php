<?php 
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';


$link = mysqli_connect("localhost", "root", "", "rentalapp");
if($link === false){
  die("ERROR: Could not connect. " . mysqli_connect_error());
}

if(isset($_GET['id']))
{

$house_id = $_GET['id']; 
$value="Verified";
 $verify_sql = "UPDATE houses SET verify='".$value."' WHERE  id='".$house_id."' ";

   if(mysqli_query($link, $verify_sql)){
    // echo "Records inserted successfully.";
    ?>

   <script type="text/javascript">
                        alert("You verified this Property");
                        window.location = "properties.php"
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