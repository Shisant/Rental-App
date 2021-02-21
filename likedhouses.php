<?php
// Include config file
require_once 'config.php';

session_start();
include 'signup.php';

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

  $likes_sql = "SELECT * FROM liked WHERE user_id = '".$user_id."'";
  $users_likes_data = mysqli_query($link, $likes_sql);
  $row = mysqli_fetch_assoc($users_likes_data);
  $liked_id = $row['like_id'];
  $property_id = $row['property_id'];

  $users_data = mysqli_query($link, $user_data_sql);
  $row = mysqli_fetch_assoc($users_data);

  $first_name = $row['first_name'];
  $last_name = $row['last_name'];
  $email= $row['username'];
  $mobile_number= $row['mobile'];
  $city= $row['address'];
  $state= $row['state'];
  $id = $row['id'];

 $user_houses_sql = "SELECT * FROM houses WHERE id = '".$property_id."'";
  $houses_query = mysqli_query($link, $user_houses_sql);
  $houses_result = mysqli_fetch_all($houses_query);

  $user_id = $row['id'];

  $colony_list = array();
  $city_list = array();
  $properties = array();
  $id_list = array();
  $rent_list = array();

if($result = mysqli_query($link, $user_houses_sql)){
    if(mysqli_num_rows($result) > 0){

       while($row = mysqli_fetch_array($result)){

        $id = $row['id'];
        $o_first_name = $row['first_name'];
        $o_last_name = $row['last_name'];
        $mobile = $row['mobile'];
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

        $image1 = "'"."view.php?id=".$id."& no=1"."'";

        array_push($colony_list,$colony);
        array_push($city_list,$location);
        array_push($rent_list,$rent);
        array_push($id_list,$id);


        
        $tags = array($house_type);

        if(strcmp($twowheeler, 'true')==0 || strcmp($fourwheeler, 'true')==0)
        {
          array_push($tags, "Parking");
        }

        if(strcmp($furnished, 'true')==0)
        {
          array_push($tags, "Furnised");
        }

        if(strcmp($bolcony, 'true')==0)
        {
          array_push($tags, "Balcony");
        }

        if(strcmp($store_room, 'true')==0)
        {
          array_push($tags, "Store room");
        }

      array_push($properties,$tags);      

       }

      }



    }
  }

?>

<!DOCTYPE html>
<html>
<link type="text/css" rel="stylesheet" href="assets/css/city.css"  media="screen,projection"/>
<body>
   
  <!-- HEADER BEGINS -->
  
  <?php include 'includes/header.php'; ?>
  <?php include 'includes/profilesidebar.php'; ?>

<script>
  
  function myFunction() {
    var img = document.getElementsByClassName("image-fit");
    var card = document.getElementsByClassName("card-image");
    var hor = document.getElementsByClassName("horizontal");
      for(var i=0; i<img.length; i++) 
      { var h = img[i].height;
      var w = img[i].width;
      console.log(h);     
      h = (170 - h)/2;
      w = (170 - w)/2;
      hor[i].style.height = "170px";
      img[i].style.marginLeft = w+"px";
      img[i].style.marginRight = w+"px";
      card[i].style.paddingTop = h+"px"; 
      card[i].style.paddingBottom = h+"px";}
    }
  </script>
  <!--MOBILE HEADER & SIDE-NAV-->
  <?php include 'includes/navbar.php'; ?>
  <div class="avl-container">
  <div class="tagline">
    <h4>Welcome <span><?php echo ($first_name)." ".($last_name) ?></span></h4>
    <p>You can view your liked posts here.</p>
  </div>
  </div>

 <div class="col offset-m3 m19 offset-l2 l10 houses">
      <div class="card-container">
      <?php 

      if(count($colony_list) <= 0)
      {
        echo "<h4>No Posts till now.</h4>";
      }

      for ($x = 0; $x <= count($colony_list)-1; $x++) { ?>
      <div class="col s12 m12 l6">
      <a href="room.php?id=<?php echo $id_list[$x] ?>">
      <div class="card horizontal">
        <div style="background-image:url(<?php echo $image1 ?>)" class="card-image">
        </div>
        <div class="card-stacked">
        <div class="card-content">
          <div class="row no-margin">
            <div class="col s12 m8 l8 loc">
              <div class="avl-c-heading m-b hide-on-small-only">
               <p>LOCATION</p>
               <div></div>
              </div>
              <p><?php echo $colony_list[$x];?></p>
              <p style="margin-top: 0px"><?php echo $location; ?></p>
            </div>
            <div class="col s12 m4 l4 rent">
              <div class="avl-c-heading m-b hide-on-small-only">
               <p>RENT</p>
               <div></div>
              </div>          
              <p>₹ <?php echo $rent_list[$x] ?></p>
            </div>
          </div>
          <div class="row no-margin">
            <div class="col s12 chip-div">

            <?php 

              foreach ($properties[$x] as $value) {
                 echo "<div class='chip'><p>$value</p></div>";
              }
            ?>
            </div>
             <?php
                  $dislikes = "dislike.php?id=$user_id"
                ?>
            <a href="<?php echo "$dislikes"?> " class="btn waves-effect waves-light theme-color-bg" name="action">Dislike
                <i class="material-icons right">thumb_down</i>
            </a>
          </div>

        </div>
        </div>
      </div>
      </a>
      </div>
      <?php }  ?>   


      
      
      </div>  
    </div>



  <!-- FOOTER BEGINS -->
  <?php include 'includes/footer.php'; ?>
  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="assets/js/materialize.min.js"></script>
    <script src="assets/js/dcalendar.picker.js"></script>
  <script>
  $(document).ready(function(){
     $(".button-collapse").sideNav({
      closeOnClick: true,
      draggable: true,
     });
     $('#moveInDate').dcalendarpicker();
     $('#login').modal();
     $('#filter-mob').modal({
        endingTop: '30',
     });
     $('#accomodate').modal();
     $('#signup').modal({
        endingTop: '30', // Ending top style attribute
     });
     $('#lgn').click(function(){
          $('#accomodate').modal('close');
          $('#login').modal('open');
     });
     $('#sgnup').click(function(){
          $('#accomodate').modal('close');
          $('#signup').modal('open');
     });
  });
  </script>
</body>
</html>

 