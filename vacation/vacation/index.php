<?php
session_start();

include "searchPage.php";


# log out user and unset session
if(isset($_GET['action']) and $_GET['action'] == "logout"){

  unset($_SESSION['Username']);
  echo "ENTERED FOR LOGOUT";
  session_destroy();
  header( 'Location: index.php' );
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Vacation - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="dist/bootstrap-clockpicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/github.min.css">
  </head>
  <body>
	  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.html"> DIDISA <span>Parking Spaces</span></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
            <?php
              if(isset($_SESSION['Username'])){
                echo '<li class="nav-item"><a href="mybookings.php" class="nav-link">My Bookings</a></li>';
              }
            ?>
	          <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
            <?php
              if(isset($_SESSION['Username'])){
                echo '<li class="nav-item cta"><a href="index.php?action=logout" class="nav-link">Log Out</a></li>';
              }else{
                echo '<li class="nav-item cta"><a href="bookNow.php" class="nav-link">Book Now</a></li>';
              }
            ?>

	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
    
    <div class="hero-wrap js-fullheight" style="background-image: url('images/destination-22.jpg'); height: 881px;" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-9 text text-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
          	<a href="images/videoplayback" class="icon-video popup-vimeo d-flex align-items-center justify-content-center mb-4">
          		<span class="ion-ios-play"></span>
            </a>
            <p class="caps" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Park comfortably at any corner of the world, without going around in circles</p>
            <h1 data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Make Your Parking Amazing With Us</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-no-pb ftco-no-pt">
    	<div class="container">
	    	<div class="row">
					<div class="col-md-12">
            <?php 
                if(isset($errorMessage)){
                  echo '<div class="search-wrap-1 ftco-animate p-3" style="border: 3px solid #f93030;" >';
                }else if(isset($registerBooking)){
                  
                  echo '<div class="search-wrap-1 ftco-animate p-3" style="border: 3px solid #25d900;" >';
                }else{
                  echo '<div class="search-wrap-1 ftco-animate p-3" style="border: 3px solid #33313b;" >';

                }
						
            ?>
							<form action="?query=1" method = "post" class="search-property-1">
		        		<div class="row">
		        			<div class="col-lg align-items-end">
		        				<div class="form-group">
		        					<label for="#">Park-in date</label>
		        					<div class="form-field">
		          					<div class="icon"><span class="ion-ios-calendar"></span></div>
                        <?php
                          if(isset($errorMessage)){
                            echo '<input type="text" class="form-control checkin_date" value="'. $date .'" name="searchDate" placeholder="Check In Date" required>';
                          }else{
                            echo '<input type="text" class="form-control checkin_date" name="searchDate" placeholder="Check In Date" required>';

                          }
                        ?>
				              </div>
			              </div>
		        			</div>

		        			<div class="col-lg align-items-end">
		        				<div class="form-group">
		        					<label for="#">Start-time</label>
		        					<div class="form-field">
		          					<div class="icon"><span class="ion-ios-calendar"></span></div>
                        <input class="form-control" type="time" value="10:00:00" name ="searchStart" id="example-time-input">
				              </div>
			              </div>
		        			</div>
                  <div class="col-lg align-items-end">
                    <div class="form-group">
                      <label for="#">End-time</label>
                      <div class="form-field">
                        <div class="icon"><span class="ion-ios-calendar"></span></div>
                        <input class="form-control" type="time" value="13:00:00" name ="searchEnd" id="example-time-input">
                      </div>
                    </div>
                  </div>
                  <div class="col-lg align-items-end">
                    <div class="form-group">
                      <label for="#">Car Type</label>
                      <div class="form-field">
                        <select class="browser-default custom-select" name="searchCarType" required>
                          <option selected disabled>Select Car-Type</option>
                          <option value="Truck">Truck</option>
                          <option value="Car">Car</option>
                          <option value="Bike">Bike</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <?php 
                  if(isset($errorMessage)){
                    echo '<div class="col-lg align-items-end">
                    <div class="form-group">
                      <label for="#">Error</label>
                      <br>
                      <label">'. $errorMessage . '</label>
                    </div>
                  </div> ';
                  } else if(isset($registerBooking)){
                    echo '<div class="col-lg align-items-end">
                    <div class="form-group">
                      <label for="#">Booked!</label>
                      <br>
                      <label"> Successfully </label>
                    </div>
                  </div> ';
                  }
              ?>
		        			<div class="col-lg align-self-end">
		        				<div class="form-group">
		        					<div class="form-field">
                        <input type="submit" value="Book Slot" class="form-control btn btn-primary">
				              </div>
			              </div>
		        			</div>
		        		</div>
		        	</form>
		        </div>
					</div>
	    	</div>
	    </div>
    </section>


    <section class="ftco-section services-section">
      <div class="container" >
        <div class="row d-flex">
          <div class="col-md-6 order-md-last heading-section pl-md-5 ftco-animate">
          	<h2 class="mb-4">It's time to start your adventure</h2>
            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.
            A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
            <p><a href="#" class="btn btn-primary py-3 px-4">Search Destination</a></p>
          </div>
          <div class="col-md-6">
          	<div class="row">
          		<div class="col-md-6 d-flex align-self-stretch ftco-animate">
		            <div class="media block-6 services d-block">
		              <div class="icon"><span class="flaticon-paragliding"></span></div>
		              <div class="media-body">
		                <h3 class="heading mb-3">Security</h3>
		                <p>A small river named Duden flows by their place and supplies it with the necessary</p>
		              </div>
		            </div>      
		          </div>
		          <div class="col-md-6 d-flex align-self-stretch ftco-animate">
		            <div class="media block-6 services d-block">
		              <div class="icon"><span class="flaticon-route"></span></div>
		              <div class="media-body">
		                <h3 class="heading mb-3">Comfortable Parking</h3>
		                <p>A small river named Duden flows by their place and supplies it with the necessary</p>
		              </div>
		            </div>    
		          </div>
		          <div class="col-md-6 d-flex align-self-stretch ftco-animate">
		            <div class="media block-6 services d-block">
		              <div class="icon"><span class="flaticon-tour-guide"></span></div>
		              <div class="media-body">
		                <h3 class="heading mb-3">Private Parking</h3>
		                <p>A small river named Duden flows by their place and supplies it with the necessary</p>
		              </div>
		            </div>      
		          </div>
		          <div class="col-md-6 d-flex align-self-stretch ftco-animate">
		            <div class="media block-6 services d-block">
		              <div class="icon"><span class="flaticon-map"></span></div>
		              <div class="media-body">
		                <h3 class="heading mb-3">Manage your parking</h3>
		                <p>A small river named Duden flows by their place and supplies it with the necessary</p>
		              </div>
		            </div>      
		          </div>
          	</div>
          </div>
        </div>
      </div>
    </section>

  
    <footer class="ftco-footer bg-bottom" style="background-image: url(images/footer-bg.jpg);">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Vacation</h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2">Infromation</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">Online Enquiry</a></li>
                <li><a href="#" class="py-2 d-block">General Enquiries</a></li>
                <li><a href="#" class="py-2 d-block">Booking Conditions</a></li>
                <li><a href="#" class="py-2 d-block">Privacy and Policy</a></li>
                <li><a href="#" class="py-2 d-block">Refund Policy</a></li>
                <li><a href="#" class="py-2 d-block">Call Us</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Experience</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">Adventure</a></li>
                <li><a href="#" class="py-2 d-block">Hotel and Restaurant</a></li>
                <li><a href="#" class="py-2 d-block">Beach</a></li>
                <li><a href="#" class="py-2 d-block">Nature</a></li>
                <li><a href="#" class="py-2 d-block">Camping</a></li>
                <li><a href="#" class="py-2 d-block">Party</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
          </div>
        </div>
      </div>
    </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
  <script type="text/javascript">
$('.clockpicker').clockpicker();
</script>
    
  </body>
</html>
