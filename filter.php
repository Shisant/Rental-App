<?php
require_once 'config.php';

session_start(); 

include 'signup.php';

if(isset($_SESSION['username']))
{
  $link = mysqli_connect("localhost", "root", "", "rentalapp");
  $username = $_SESSION['username'];
  $sql = "SELECT * FROM user_details WHERE username = '".$username."'";

  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result); 

  $first_name = $row['first_name'];
  $last_name = $row['last_name'];

} 

$link = mysqli_connect("localhost", "root", "", "rentalapp");

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if(isset($_GET['location']))
{
  $search_city = $_GET['location'];
}

if(isset($_GET['date']))
{
  $search_date = $_GET['date'];
}




if(isset($_GET['filter']))
{
	$str = $_GET['filter'];
	$arr = explode(',', $str);


	$type = array();
	$rent=array();

	for($i =0; $i<count($arr);$i++)
	{
		

		if(strcmp($arr[$i],'3BHK')==0 || strcmp($arr[$i],'2BHK')==0 || strcmp($arr[$i],'1BHK')==0 || strcmp($arr[$i],'single_room')==0 || strcmp($arr[$i],'pg')==0 || strcmp($arr[$i],'shared_room')==0 || strcmp($arr[$i],'furnished')==0 )
		{
			array_push($type,"house_type='".$arr[$i]."'");
		}
		elseif (strcmp($arr[$i],'5000')==0 || strcmp($arr[$i],'10000')==0 || strcmp($arr[$i],'15000')==0 || strcmp($arr[$i],'20000')==0 || strcmp($arr[$i],'25000')==0 )
		{
				$temp = (int)$arr[$i];
				array_push($rent, "rent <= ".$temp."");
		}
	}

	$type_query = join(" OR ",$type);
	
	$rent_query = join(" OR ", $rent);

}


$value="Verified";


$sql = "SELECT * FROM houses WHERE verify= '".$value."'";


if(isset($type_query) && isset($rent_query))
{

if( strcmp($type_query, "")!=0 && strcmp($rent_query, "")!=0 )
{
	$sql =  $sql." ACCOMODATE (".$type_query.") AND (".$rent_query." ) AND location='".$search_city."' AND date >= '".$search_date."' ;";	
}
elseif( strcmp($type_query, "")==0 && strcmp($rent_query, "")!=0)
{
	$sql =  $sql." AND (".$rent_query." ) AND location='".$search_city."' AND date>='".$search_date."' ;" ;
}
elseif( strcmp($type_query, "")!=0 && strcmp($rent_query, "")==0)
{
	$sql =  $sql." AND (".$type_query." ) AND location='".$search_city."' AND date>= '".$search_date."' ;";	
}

}
elseif(isset($_GET['location']) && isset($_GET['date']))
{
  $sql = $sql." AND location='".$search_city."' AND date>= '".$search_date."' ;";
}


$colony_list = array();
$city_list = array();
$rent_list = array();
$properties = array();
$id_list = array();
$images = array();

if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){

    	 while($row = mysqli_fetch_array($result)){

    	 	$id = $row['id'];
    	 	$first_name = $row['first_name'];
    	 	$last_name = $row['last_name'];
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

        $image1 = "'"."view.php?id=".$row['id']."& no=1"."'";

    		array_push($colony_list,$colony);
    		array_push($city_list,$location);
    		array_push($rent_list,$rent);
    		array_push($id_list,$id);
        array_push($images, $image1);


    	 	
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


if(isset($_SESSION['username']))
{
  $link = mysqli_connect("localhost", "root", "", "rentalapp");
  $username = $_SESSION['username'];
  $sql_session = "SELECT * FROM user_details WHERE username = '".$username."'";

  $result = mysqli_query($link, $sql_session);
  $row = mysqli_fetch_assoc($result); 

  $first_name = $row['first_name'];
  $last_name = $row['last_name'];

} 

?>

<!DOCTYPE html>
<html>
<head>
  <title>MERO GHAR</title>
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="assets/css/materialize.css"  media="screen,projection"/>
  <link href="assets/css/dcalendar.picker.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="assets/css/header.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="assets/css/city.css"  media="screen,projection"/>
  <script src="https://use.fontawesome.com/4ef4ce7ce4.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <script>
  
  function myFunction() {
    var img = document.getElementsByClassName("image-fit");
    var card = document.getElementsByClassName("card-image");
    var hor = document.getElementsByClassName("horizontal");
      for(var i=0; i<img.length; i++)	
      {	var h = img[i].height;
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
</head>
<body>
  <div class="fixed-action-btn show-on-small hide-on-med-only hide-on-large-only">
    <a href="#filter-mob" class="btn-floating btn-large modal-trigger theme-color-bg">
      <i class="large material-icons">sort</i>
    </a>
  </div>
  <div id="filter-mob" class="modal tagline">
   <div class="modal-content m-container">
       <div class="avl-heading">
           <h5>FILTER</h5>
           <div></div>
       </div>
    </div>
  </div>
  <div class="avl-header avl-container show-on-med-and-large hide-on-small-only">
	<a href="index.php">
		<img src="assets/images/logo.png">
		<h5>MERO GHAR</h5>
	</a>
	<ul>
    <li><a href="index.php">HOME</a></li>
	  <li><?php if(isset($_SESSION['username'])) { ?>
          <a href="accomodate.php">ACCOMODATE</a>
      <?php } ?>
      <?php  if(!isset($_SESSION['username'])) { ?>
          <a class="modal-trigger" href="#accomodate">ACCOMODATE</a>
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
  <!--MOBILE HEADER & SIDE-NAV-->
  <nav class="theme-color-bg show-on-small hide-on-med-only hide-on-large-only">
    <div class="nav-wrapper">
      <a href="index.php" class="white-text brand-logo center">MERO GHAR</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i id="nav_icon" class="material-icons">MENU</i></a>
      <ul class="side-nav" id="mobile-demo">
        <li class="first_li theme-color-bg">
            <?php if(isset($_SESSION['username'])) { ?>
                <h5 id="welcome">Welcome</h5>
                <h4 id="user_name">
                    <b>
                        <?php echo $first_name." ".$last_name ?>
                    </b>
                </h4>
            <?php } else { ?>
                <h5 id="welcome"></h5>
                <h4 id="user_name">
                    <b>
                        Welcome
                    </b>
                </h4>
            <?php } ?>
        </li>
        <li><a href="index.php">HOME</a></li>
        <li><?php if(isset($_SESSION['username'])) { ?>
                <a href="accomodate.php">ACCOMODATE</a>
          <?php } ?>
          <?php  if(!isset($_SESSION['username'])) { ?>
                <a class="modal-trigger" href="#accomodate">ACCOMODATE</a>
          <?php } ?>
        </li>
        <li>
              <?php if(!isset($_SESSION['username'])) { ?>
                    <a class="modal-trigger" href="#login">LOGIN</a>
              <?php } ?>
              <?php  if(isset($_SESSION['username'])) { ?>
                    <a class="modal-trigger" href="profile.php">
                        ACCOUNT
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
  </nav>

  <div id="accomodate" class="modal tagline">
   <div class="modal-content m-container">
       <div class="avl-heading">
           <h4>Accomodate</h4>
           <div></div>
       </div>
       <div class="row">
            <p class="mb-4">Upload free advertisement and find a suitable tenant.<br>
            Please, <span>Login</span> to continue.</p>
            <a id="lgn" class="btn modal-button white-text">Login</a>
            <p class="mb-4">New? Create a <span>new account</span>.</p>
            <a id="sgnup" class="btn modal-button white-text">Sign Up</a>
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

  <div class="row filter-fix">
     <div class="col m3 l2 filter hide-on-small-only">
		<form class="houseType" onsubmit="return false" >
          <h5>Type of House</h5>
            <ul>
              <li>

                <input onchange="changeCheck(this)" class="filled-in filter1" type="checkbox" id="3bhk" name="type" value="3BHK" 
                <?php 

                if(strpos($sql,"3BHK"))
                {
                  echo "checked='checked'";
                }

                ?>
                 />
  				<label for="3bhk">3 BHK</label>
  			  </li>
              <li>
              	<input onchange="changeCheck(this)" class="filled-in filter1" type="checkbox" id="2bhk" name="type" value="2BHK"  

                <?php 

                if(strpos($sql,"2BHK"))
                {
                  echo "checked='checked'";
                }
                

                ?>

                />
  				<label for="2bhk">2 BHK</label>
  			  </li>
              <li>
              	<input onchange="changeCheck(this)" class="filled-in filter1" type="checkbox" id="1bhk" name="type" value="1BHK"  

                <?php 

                if(strpos($sql,"1BHK"))
                {
                  echo "checked='checked'";
                
                }

                ?>

                />
  				<label for="1bhk">1 BHK</label>
  			  </li>
  			  <li>
              	<input onchange="changeCheck(this)" class="filled-in filter1" type="checkbox" id="Single_Room" name="type" value="single_room"  
                <?php 

                if(strpos($sql,"single_room"))
                {
                  echo "checked='checked'";
                
                }

                ?>


                />
  				<label for="Single_Room">Single Room</label>
  			  </li>
              <li>
              	<input onchange="changeCheck(this)" class="filled-in filter1" type="checkbox" id="Pg" name="type" value="pg"  

                <?php 

                if(strpos($sql,"pg"))
                {
                  echo "checked='checked'";
                }
                

                ?>

                />
  				<label for="Pg">Paying Guest</label>
  			  </li>
  			  <li>
              	<input onchange="changeCheck(this)" class="filled-in filter1" type="checkbox" id="Shared_Room" name="type" value="shared_room"  

                <?php 

                if(strpos($sql,"shared_room"))
                {
                  echo "checked='checked'";
                
                }

                ?>


                />
  				<label for="Shared_Room">Shared Room</label>
  			  </li>
  			  <li>
              <input onchange="changeCheck(this)" class="filled-in filter1" type="checkbox" id="Furnished" name="type" value="furnished" 

                 <?php 

                if(strpos($sql,"furnished_room"))
                {
                  echo "checked='checked'";
                }

                ?>
                />
  				<label for="Furnished">Furnished</label>
  			  </li>
          </ul>
          <h5>Price Range</h5>
          <div class="priceRange">
            <ul>
              <li>
                <input onchange="changeCheck(this)" class="filled-in filter1" type="checkbox" id="10005000" name="rent" value="5000"  

                <?php 

                if(strpos($sql,"5000"))
                {
                  echo "checked='checked'";
                }

                ?>

                />
  				<label for="10005000">1,000-5,000</label>
  			  </li>
              <li>
              	<input onchange="changeCheck(this)" class="filled-in filter1" type="checkbox" id="100010000" name="rent" value="10000"  

                <?php 

                if(strpos($sql,"10000"))
                {
                  echo "checked='checked'";
                }

                ?>

                />
  				<label for="100010000">1,000-10,000</label>
  			  </li>
              <li>
              	<input onchange="changeCheck(this)" class="filled-in filter1" type="checkbox" id="100015000" name="rent" value="15000"  

                <?php 

                if(strpos($sql,"15000"))
                {
                  echo "checked='checked'";
                }

                ?>

                />
  				<label for="100015000">1,000-15,000</label>
  			  </li>
              <li>
              	<input onchange="changeCheck(this)" class="filled-in filter1" type="checkbox" id="100020000" name="rent" value="20000"  

                <?php 

                if(strpos($sql,"20000"))
                {
                  echo "checked='checked'";
                }

                ?>


                />
  				<label for="100020000">1,000-20,000</label>
  			  </li>
  			  <li>
              	<input onchange="changeCheck(this)" class="filled-in filter1" type="checkbox" id="25000" name="rent" value="25000"  

                <?php 

                if(strpos($sql,"25000"))
                {
                  echo "checked='checked'";
                }

                ?>

                />
  				<label for="25000">upto 25,000</label>
  			  </li>

  			  <li>
          	<button class="filled-in filter1 btn waves-effect waves-light" style="margin-top: 20px;background-color:#49baff;" type="submit" id="submit" onclick="check()">FILTER</button>
  				
  			  </li>


            </ul>
          </div>
	    </form>
	 </div>
	 <div class="col offset-m3 m19 offset-l2 l10 houses">
	    <h5 style="text-align:center;color: #7d7d7d; "><?php echo 'Search Property'; ?></h5>
      <div class="card-container">
        <div class="row">
          <form action="filter.php" method="GET" class="col s12 offset-m2 m8 offset-l4 l4" style="padding:0px">      
            <div class="search-bar"> 
              <div class="row">
              <div class="col s5 m6 l5" style="border-right:1px solid #eee">
                <label><h6>LOCATION</h6></label>
                <input type="text" name="location" placeholder="Enter Location" id="location" required>
              </div>
              <div class="col s5 m5 l4" style="padding: 0 0.75rem 0 1.45rem;">
                <label><h6>DATE</h6></label>
                <input id="moveInDate" name="date" placeholder="Enter date" required>
              </div>
              <div class="col s2 m3 l3" style="text-align:center">
                <button type="submit"><i class="material-icons">search</i></button>         
                </div> 
              </div>
            </div>
          </form>
        </div>
      </div>



	    <div class="card-container">
			<?php 

      if(count($colony_list) <= 0)
      {
        echo "<h4>Nothing Found according to your search</h4>";
      }

			for ($x = 0; $x <= count($colony_list)-1; $x++) { ?>
      <div class="col s12 m12 l6">
			<a href="room.php?id=<?php echo $id_list[$x] ?>">
			<div class="card horizontal">
			  <div style="background-image:url(<?php echo $images[$x]; ?>)" class="card-image h_img">
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
					</div>
				</div>
			  </div>
			</div>
      </a>
      </div>
			<?php }  ?>		


		  
		  
		  </div>  
	    </div>        	
	 </div>
  </div>
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
     $('#contact').modal();
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
          $('#contact').modal('close');
     });
     $('#sgnup').click(function(){
          $('#accomodate').modal('close');
          $('#signup').modal('open');
          $('#contact').modal('close');
     });
  });
  </script>

  <script type="text/javascript">
  	
  function check()
  {

  	var c = document.getElementsByClassName("filter1");

  	var a = [];

  	for(var i =0; i< c.length;i++)
  	{
  		if(c[i].getAttribute("checked") == "checked")
  		{
  			a.push(c[i].value);
        alert(c[i].value);
  		}
  		else
  		{
  		
  		}
  		
  	}
  	window.location = "http://localhost/rentalapp/filter.php"+"?filter="+a.toString()+"&location="+<?php echo "'".$search_city."'" ?>+"&date="+<?php echo "'".$search_date."'" ?>+"" ;
  	
  }

  
  function changeCheck(el){
    if(el.checked == "checked" || !el.checked){
      el.checked = false;
      el.removeAttribute("checked");
    }else{
      el.setAttribute("checked","checked");
    }
  }  	

  </script>


</body>
</html>