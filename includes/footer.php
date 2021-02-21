  <!--Footer -->
    <footer class="page-footer">
		<div class="avl-container">
			<div class="row">
				<div class="col l6 s12 pd-0 tagicon">
					<h4 class="white-text"><b>MERO GHAR</b></h4>
					<p class="flow-text white-text"> Choose from a large number of accomodations where  you feel at home away from home.</p>
                    <a><img height="40px" width="40px" src="assets/images/icon/facebook.png"></a>
                    <a><img height="40px" width="40px" src="assets/images/icon/twitter.png"></a>
                    <a><img height="40px" width="40px" src="assets/images/icon/google-plus.png"></a>
				</div>
				<div class="col s6 l2 offset-l1 pd-0">
					<h5 class="white-text">Navigate to</h5>
					<ul>
						<li>
                            <?php if(isset($_SESSION['username'])) { ?>
                                <a href="accomodate.php">Accomodate</a>
                            <?php } ?>
                            <?php  if(!isset($_SESSION['username'])) { ?>
                                <a class="modal-trigger" href="#accomodate">Accomodate</a>
                            <?php } ?>
                        </li>
                        <li>
                            <?php if(isset($_SESSION['username'])) { ?>
                                <a class="modal-trigger" href="profile.php">
                                    <?php echo $first_name." ".$last_name ?>
                                </a>
                            <?php } ?>
                            <?php  if(!isset($_SESSION['username'])) { ?>
                                <a class="modal-trigger" href="#login">Login</a>
                            <?php } ?>
                        </li>
                        <li>
                            <?php if(isset($_SESSION['username'])) { ?>
                                <a href="logout.php">Sign Out</a>
                            <?php } ?>
                            <?php  if(!isset($_SESSION['username'])) { ?>
                                <a class="modal-trigger" href="#signup">Sign Up</a>
                            <?php } ?>
                        </li>
						<li><a href="#contact">Contact Us</a></li>
					</ul>
				</div>
                <div id="contact" class="modal tagline">
                   <div class="modal-content m-container">
                       <div class="avl-heading">
                           <h4>Mero Ghar</h4>
                       </div>
                       <div class="row">
                            <p class="mb-4">Mero Ghar, a rental information portal</p>
                            <p class="mb-4"> We offer all varieties of houses, rooms and apartments that you are looking for just in your price range and your preferred location.<br>
                            <p class="mb-4">Upload free advertisement and find a suitable tenant.<br>
                            Please, <span>Login</span> to continue.</p>
                            <a id="lgn" href="#login" class="btn modal-button white-text">Login</a>
                            <p class="mb-4">New? Create a <span>new account</span>.</p>
                            <a id="sgnup" href="#signup" class="btn modal-button white-text">Sign Up</a>
                            <p class="mb-4">We are at, <span>Pepsicola, Kathmandu</span>.</p>
                            <p class="mb-4">Ring us, <span>@ +9779861735652, 01-422125</span>.</p>
                             <p class="mb-4">Mail us, <span>@ info.meroghar.com, meroghar@gmail.com</span>.</p>
                       </div>
                    </div>
                  </div>
              
				<div class="col s6 l2 offset-l1 pd-0">
					<h5 class="white-text">Accomodations</h5>
					<ul>
					<li><a href="#!">Baneshwor</a></li>
                    <li><a href="#!">Koteshwor</a></li>
                    <li><a href="#!">Patan</a></li>
                    <li><a href="#!">Tripureshwor</a></li>
                    <li><a href="#!">Kananki</a></li>
                    <li><a href="#!">Bhaisipati</a></li>
                    <li><a href="#!">Basundhara</a></li>
                    <li><a href="#!">Golfutaar</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="footer-copyright">
			<div style="width:100%" class="avl-container">
			© 2019 Copyright Developed and Designed by Mero Ghar.
			
			</div>
		</div>
	</footer>