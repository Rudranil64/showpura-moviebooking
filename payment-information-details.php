<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Payment-page</title>
  <meta name="viewport", content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="http://localhost/moviebookingwebsite/payment-page.css">
</head>
<body>
      <div class="payment-box">
      	<div class="border">
      		<div style="display: inline-flex;">
      			<div class="box1">
      			<div style="color:#FF0080;">Movie Name: <span class="decoration"><?php echo $_SESSION['movie_name']; ?></span></div>
      			<div style="color:#FF0080;margin-top: 7px;">Cinema Hall Name: <span class="decoration"><?php echo $_SESSION['hallname'];?></span></div>
      			<div style="color:#FF0080;margin-top: 7px;">Address: <div class="decoration"><?php echo $_SESSION['address'];?></div></div>
      			<div style="color:#FF0080;margin-top: 7px;">Date: <span class="decoration"><?php echo $_SESSION['day'];?>, <?php echo $_SESSION['date'];?> <?php echo $_SESSION['month'];?> 2022</span></div>
      			<div style="color:#FF0080;margin-top: 7px;">Time: <span class="decoration"><?php echo $_SESSION['time']; ?></span></div>
      		    </div>
      		    <div class="box2">
      			<div style="color:#FF0080;">Total seat: <span class="decoration"><?Php echo $_SESSION['totalseat'];?></span></div> 
                <div style="color:#FF0080;margin-top: 7px;">Platinum Seat no: <span class="decoration"><?php 
                if($_SESSION['seatnoplatinum']=="")
                {	
                  echo "None";
                }
                else
                  echo $_SESSION['seatnoplatinum'];
                ?>
                </span></div>
                <div style="color:#FF0080;margin-top: 7px;">Gold Seat no: <span class="decoration"><?php
                if($_SESSION['seatnogold']=="") 
                  echo "None";
                else
                  echo $_SESSION['seatnogold'];?>	
                </span></div>
                <div style="color:#FF0080;margin-top: 7px;">Silver Seat no: <span class="decoration"><?php
                if($_SESSION['seatnosilver']=="")
                echo "None";
                else 
                echo $_SESSION['seatnosilver'];?></span>
                </div>
      		    </div></div>
      		<div class="client-detail">
      			<form class="log-in-form" action="http://localhost/moviebookingwebsite/client-booking-information-insert.php" method="GET">
      		    <input type="text" name="clientname" placeholder="Your name" required />
      		    <input type="text" name="age" placeholder="Your age" required />
      		    <input type="submit" value="Confirm to pay Rs.<?php echo $_SESSION['total_bill'];?>" style="background-color:#00FF00; width:300px; font-weight: bold; color:black; font-size:20px; font-family:Times new roman;"/>
      	        </form>
      	    </div>    
      	</div>
      </div>
</body>
</html>