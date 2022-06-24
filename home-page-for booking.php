<?php
session_start();
if(!isset($_SESSION['username']))
{
    header('location:http://localhost/moviebookingwebsite/log-in-page.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
  <meta name="viewport", content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="http://localhost/moviebookingwebsite/Front-page-stylesheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function closebar()
       {
        var a=document.querySelector(".pop-up");
        a.style.display="none";
       }
       function popupload()
       {
        var a=document.querySelector(".pop-up");
        a.style.display="block";
       }
        function hwopacity()
       {
        var a=document.querySelector(".city-selector");
        a.style.opacity="1";
       }
       function lwopacity()
       {
        var a=document.querySelector(".city-selector");
        a.style.opacity="0.9";
       }
        function menubar()
        {
            var menu=document.querySelector(".menu-bar");
            menu.style.display="block";
            menu.style.left="1185px";
        }

       document.addEventListener('mouseup',function(event){
        var box = document.getElementById('menu');
        var box1= document.getElementById('menu1');
        var box2= document.getElementById('notify');
        var box3= document.getElementsByClassName('submenu');
        var box4= document.getElementById('notibar');
        var box5= document.getElementById('account');
        var box6= document.getElementById('walletfy');
        var box7= document.getElementById('walletbar');
        var box8= document.getElementById('ticketfy');
        var box9= document.getElementById('ticketbar');
        if(event.target == box)
        {
            box.style.display="block";
        }
        else if(event.target.parentNode == box1)
        {
            box.style.display="block";
        }
        else if(event.target.parentNode == box2)
        {
            box.style.display="block";
        }
        else if(event.target.parentNode == box3)
        {
            alert("yes");
            box.style.display="block";
        }
        else if(event.target.parentNode == box4)
        {
            box.style.display="block";
        }
        else if(event.target.parentNode == box5)
        {
            box.style.display="block";
        }
        else if(event.target.parentNode == box6)
        {
            box.style.display="block";
        }
        else if(event.target.parentNode == box7)
        {
            box.style.display="block";
        }
        else if(event.target.parentNode == box8)
        {
          box.style.display="block";
        }
        else if(event.target.parentNode == box8)
        {
          box.style.display="block"; 
        }
        else
            box.style.display="none";
       });

       function back()
       {
        var navigation=document.querySelector(".navigation-bar");
        var notification=document.querySelector(".notification");
        navigation.style.display="block";
        notification.style.display="none";
       }
       function backwallet()
       {
        var navigation=document.querySelector(".navigation-bar");
        var walletnotification=document.querySelector(".wallet-notification");
        navigation.style.display="block";
        walletnotification.style.display="none";
       }
       function backticket()
       {
        var navigation=document.querySelector(".navigation-bar");
        var ticketnotification=document.querySelector(".ticket-notification");
        navigation.style.display="block";
        ticketnotification.style.display="none";
       }
       function notification()
       {
        var navigation=document.querySelector(".navigation-bar");
        var notification=document.querySelector(".notification");
        navigation.style.display="none";
        notification.style.display="block";
       }
       function wallet()
       {
        var navigation=document.querySelector(".navigation-bar");
        var walletnotification=document.querySelector(".wallet-notification");
        navigation.style.display="none";
        walletnotification.style.display="block";
       }
       function ticket()
       {
        var navigation=document.querySelector(".navigation-bar");
        var ticketnotification=document.querySelector(".ticket-notification");
        navigation.style.display="none";
        ticketnotification.style.display="block";
       }
       var cons=1;
       function submenu()
       {
        cons += cons;
        var submenu=document.querySelector(".sub-menu");
        if(cons===2)
        {
            submenu.style.display="block";
        }
        else
        {
            cons=1;
            submenu.style.display="none";
        }
       }
       function fetchcities(str)
        {
          if(str.length==0)
          {
            document.getElementById("cities").innerHTML=" ";
            document.getElementById("cities").style.display="none";
          }
          else
          {
            var req=new XMLHttpRequest();
            req.open("GET","http://localhost/moviebookingwebsite/film-cities.php?searchbox="+str,true);
            req.send();
            req.onreadystatechange=function(){
            if(req.readyState==4 && req.status==200)
            {
              var dropdown=document.getElementById("cities");
              dropdown.style.display="block";
             document.getElementById("cities").innerHTML=req.responseText;
            }
            };
          }
          $(document).on('click','#cities li',function(){
            $('.search-bar').val($(this).text());
            $("#cities").fadeOut();
            var city=$('.search-bar').val();
            var req=new XMLHttpRequest();
            req.open("GET","http://localhost/moviebookingwebsite/city-wise-cinema-hall.php?city="+city,true);
            req.send();
            req.onreadystatechange=function(){
              if(req.readyState==4 && req.status==200)
              {
                x=req.responseText;
                console.log(x);
              }
            }
          });
          $(document).on('click','#cities li',function(){
            document.getElementById("mysearch").submit();
          });
          window.onload()
         }

         function validation(str)
         {
          var dropdown=document.getElementById("cities"); 
          if(str.length==0)
          { 
            dropdown.innerHTML="pls enter a city name";
            document.getElementById("submitbtn").setAttribute('disabled','disabled');
          }
          else
          {
             var req=new XMLHttpRequest();
             req.open("GET","http://localhost/moviebookingwebsite/city-validation.php?searchbox1="+str,true);
             req.send();
             req.onreadystatechange=function(){
             if(req.readyState==4 && req.status==200){
                 var x=req.responseText;
                 if(x==1)
                 {
                  document.getElementById("submitbtn").removeAttribute('disabled');
                 }
                 else
                 {
                  document.getElementById("submitbtn").setAttribute('disabled','disabled');
                 }
             }
            };
          }
        }
    </script>
</head>
<body>
    <div class="pop-up">
        <div><button id="close" onclick="closebar()">&times;</button></div>
        <form action="http://localhost/moviebookingwebsite/city-wise-cinema-hall.php" method="post" id="mysearch"><div><i class="fa fa-search " style="color:#FF0080; padding:13px 65px; position: absolute; font-size:22px;"></i><input style="font-size:15px;" oninput="fetchcities(this.value)" class="search-bar" type="text" name="cityname" onkeyup="validation(this.value)" placeholder="Search for your city"><button id="submitbtn" style="display: none;" disabled="disabled">submit</button>
          <div class="dropdown" id="cities">
            <div><a href="**">Hello World</a></div>  
          </div></form>
        </div>
        <div style="color:#FF0080; font-weight:bold; text-align: center; margin:25px;margin-bottom:5px;">Popular Cities</div>
        <div class="block">
            <a style="text-decoration:none;" href="**"><img class="state" src="gate-of-india.png" width="90" height="90"></img><div style="color:black;">Delhi</div></a>
            <a style="text-decoration:none;" href="**"><img class="state" src="india-gate.png" width="90" height="90"></img><div style="color:black;">Mumbai</div></a>
            <a style="text-decoration:none;" href="**"><img class="state" src="bangaluru-icon.png" width="90" height="90"></img><div style="color:black;">Bengaluru</div></a>
            <a style="text-decoration:none;" href="**"><img class="state" src="kolkata-icon.jpg" width="90" height="90"></img><div style="color:black;">Kolkata</div></a>
            <a style="text-decoration:none;" href="**"><img class="state" src="hyderabad-charminar.png" width="90" height="90"><div style="color:black;">Hyderabad</div></img></a>
            <a style="text-decoration:none;" href="**"><img class="state" src="chandigarh-icon.png" width="90" height="90"><div style="color:black;">Chandigarh</div></img></a>
            <a style="text-decoration:none;" href="**"><img class="state" src="chennai-icon.png" width="90" height="90"><div style="color:black;">Chennai</div></img></a>
            <a style="text-decoration:none;" href="**"><img class="state" src="Ahmedabad-icon.jfif" width="90" height="90"><div style="color:black;">Ahmedabad</div></img></a>
            <a style="text-decoration:none;" href="**"><img class="state" src="kochi-icon.png" width="90" height="90"><div style="color:black;">Kochi</div></img></a>
        </div>
        <div style="margin-bottom:15px;"><a style="color:#FF0080; text-decoration:none; font-weight:bold; text-align: center;" href="**">View all cities</a></div>
    </div>

    <div class="menu-bar" id="menu">
        <div class="first-content" id="menu1">
            <div style="display: inline-flex;">
                <div><i style="color:#FF0080; font-size:30px; margin-left: 7px; margin-right:5px; margin-top:4px; border:solid #E0E0E0 3px; border-radius:50%;" class="fa fa-user-circle" aria-hidden="true"></i></div>
                <div style="color:#F5F5F5;margin-top:-4px;">Hey, <span style="color:#FF0080; font-size:18px; "><?php echo $_SESSION['username'];?></span></div>
            </div>
            <div style="color:#F5F5F5;margin-left:50px; margin-top: -8px;">Edit Profile <i class="fa fa-angle-right"></i></div>
        </div>
     <div class="notification" id="notibar">
         <div class="back-button" class="submenu" onclick="back()"><i style="color:#FF0080; font-size:16px; " class="fa fa-angle-left"></i> Back<span style="margin-left:90px;font-weight:bold;color:#FF0080;">Notification</span></div>
     </div>
     <div style="display:none;" class="wallet-notification" id="walletbar">
         <div class="back-button" class="submenu" onclick="backwallet()"><i style="color:#FF0080; font-size:16px; " class="fa fa-angle-left"></i> Back<span style="margin-left:90px; font-weight:bold;color:#FF0080;">Wallet</span></div>
         <div style="width:350px;height:500px; background-color:white; padding-top: 15px; padding-left:10px; border-bottom: solid #454545 1px;">
           <img style="margin-left:120px;" src="http://localhost/moviebookingwebsite/wallet-logo.jpg" width="90" height="90">
           <div style="margin-left:110px; font-size:20px;" id="submenu">Total money</div>
           <div style="display:inline-flex;"><img style="margin-left:90px; margin-top: 10px;" src="http://localhost/moviebookingwebsite/Indian-Rupee-symbol.png" width="30" height="30">
            <div style="font-size:40px;margin-left: 5px;">0.00 Rs</div>
           </div>
           <a href="**" style="text-decoration:none; color:white;"><div style="width:120px; height:40px;border:solid red 2px;text-align:center;border-radius:20px;margin-left:110px;margin-top:10px;padding-top:07px;background-color:#FF0080;"><span style="font-size:20px;font-weight:bold;color:white">Add Money</span></div></a>
         </div>
     </div>
     <div style="display:none;" class="ticket-notification" id="ticketbar">
         <div class="back-button" class="submenu" onclick="backticket()"><i style="color:#FF0080; font-size:16px;"class="fa fa-angle-left"></i> Back<span style="margin-left:90px; font-weight:bold;color:#FF0080;">Your Ticket</span></div>
          <?php
          $userid=$_SESSION['userid'];
          $con = mysqli_connect('localhost','rudranil','rudra@123');
          mysqli_select_db($con,'moviebooking');
          $d="select*from booking_information where phone_no='$userid'";
          $result = mysqli_query($con,$d);
          $num = mysqli_num_rows($result);
          if($num!=0)
          {
           for($i=1;$i<=$num;$i++)
           {
             $row=mysqli_fetch_array($result);
             $user['bookingname'.$i]=$row['client_name'];
             $user['moviename'.$i]=$row['movie_name'];
             $user['cinemahallname'.$i]=$row['cinema_hall_name'];
             $user['date'.$i]=$row['date'];
             $user['time'.$i]=$row['time'];
             $user['platinumseat'.$i]=$row['platinum_seat_no'];
             $user['goldseat'.$i]=$row['gold_seat_no'];
             $user['silverseat'.$i]=$row['silver_seat_no'];
             $user['seatno']=$user['platinumseat'.$i].",".$user['goldseat'.$i].",".$user['silverseat'.$i];
             $user['ticketid'.$i]=$row['ticket_id'];?>
             <div style="width:350px;padding-bottom:15px;background-color:white; padding-top: 15px; padding-left:10px; border-bottom: solid #454545 1px;">
               <div style="background-color:green;display:inline-flex;width:330px;height:170px;border:solid black 2px;">
                 <div style="width:150px;height:170px;border-bottom-right-radius:50%;"><img src="ticket.jfif" width="170" height="170"></div>
                 <div style="width:150px;height:170px;margin-left:22px;padding: 4px 10px;border-left:dashed red 2px;">
                    <div><span style="color:yellow;font-size:16px;">Ticket Id:</span> <?php echo $user['ticketid'.$i];?></div>
                    <div><span style="color:yellow;font-size:16px;">Movie Name:</span> <?php echo $user['moviename'.$i];?></div>
                    <div><span style="color:yellow;font-size:16px;">Multiplex:</span> <?php echo $user['cinemahallname'.$i];?></div>
                    <div><span style="color:yellow;font-size:16px;">Date:</span> <?php echo $user['date'.$i];?></div>
                    <div><span style="color:yellow;font-size:16px;">Time:</span> <?php echo $user['time'.$i];?></div>
                    <div><span style="color:yellow;font-size:16px;">Seat No:</span> <?php echo $user['seatno'];?></div>
                 </div>
               </div>
               <a href="$$" style="text-decoration:none; color:white;"><div style="width:190px;height:40;border:solid red 2px;text-align:center;border-radius:20px;margin-left:80px;margin-top:10px;padding-top:04px;background-color:#FF0080;"><span style="font-size:20px;color:white">Get your Ticket</span></div></a>
             </div>
          <?php    
           }
          }
          else
          {?>
            <div>sorry,You have not purchase any tickets!!</div>
          <?php    
          }
          ?>
      </div>
    <div class="navigation-bar"> 
        <div class="next-content" id="notify" onclick="notification()">
            <div style="font-size: 17px;margin-top:5px; ">
             <i style="color:#FF0080; font-size:16px; " class="fa fa-bell-o"></i> Notifications <i class="fa fa-angle-right"></i>
            </div>
        </div>

        <div class="next-content" id="walletfy" onclick="wallet()">
            <div style="font-size: 17px;margin-top:5px; ">
            <i style="color:#FF0080; font-size:16px; " class="fa fa-google-wallet"></i> Wallet <i class="fa fa-angle-right"></i>
            </div>
        </div>

        <div class="next-content" id="ticketfy" onclick="ticket()">
            <div style="font-size: 17px;margin-top:5px; ">
             <i style="color:#FF0080; font-size:16px; " class="fa fa-ticket"></i> Tickets <i class="fa fa-angle-right"></i>
            </div>
        </div>

        <a href="http://localhost/moviebookingwebsite/purchase-history.php" style="text-decoration:none;"><div class="next-content">
            <div style="font-size: 17px;margin-top:5px; ">
            <i style="color:#FF0080; font-size:16px; " class="fa fa-money"></i><span style="color:black;margin-left:5px;">Purchase History</span><i class="fa fa-angle-right"></i>
            </div>
        </div></a>

        <div class="next-content">
            <div style="font-size: 17px;margin-top:5px; ">
            <i style="color:#FF0080; font-size:16px; "class="fa fa-comments-o"></i> Help & Support <i class="fa fa-angle-right"></i>
            </div>
        </div>

        <div class="next-content" id="account">
            <div style="font-size: 17px;margin-top:5px;" onclick="submenu()">
            <i style="color:#FF0080; font-size:16px; "class="fa fa-cog"></i> Account & Setting <i class="fa fa-angle-right"></i></div>
        </div>

        <div class="sub-menu">
            <div class="sub-menu1" style="font-size:16px;">My Account</div>
            <div class="sub-menu1" style="font-size:16px;">Saved Payment Method</div>
        </div>

        <div class="next-content">
            <div style="font-size: 17px;margin-top:5px; ">
            <i style="color:#FF0080; font-size:16px; "class="fa fa-shopping-bag"></i> Reward <i class="fa fa-angle-right"></i>
            </div>
        </div>
     </div>
       <div style="width: 350px; border:solid #454545 0px; height:60px; background-color: #F5F5F5; ">   
         <a style="text-decoration: none;" href="http://localhost/moviebookingwebsite/sign-out.php"><div class="sign-out"><span style="color:#FF0080; font-size: 18px; font-weight: 20px;">Sign Out</span></div></a>
       </div> 
    </div>

    <div class="first-header">
    	<div style="margin-left:10px; margin-top: -15px;"><img src="logo-of-company.jpg" width="250" height="70"><img></div>
    	<div style="margin-left:-70px; margin-top: 0px;"><i class="fa fa-search " style="color:#FF0080; padding:10px 90px; position: absolute; font-size:22px;"></i><input class="search-bar1" style="width: 550px;height:40px;margin-left:80px; padding-left:35px;" type="text" name="searched_city_name" placeholder="Search for Movies,Events,Plays,Sports and Activities"/></div>
      <?php
      if(isset($_SESSION['cities']))
      {?>
        <div class="city-selector" onclick="popupload()" onmouseover="hwopacity()" onmouseout="lwopacity()"><div style="text-transform:capitalize;" id="change-city"> <?php echo $_SESSION['cities']; ?></div><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
      <?php
      }
      else
      {
      ?>
    	  <div class="city-selector" onclick="popupload()" onmouseover="hwopacity()" onmouseout="lwopacity()">Select your city <i class="fa fa-chevron-down" aria-hidden="true"></i></div>
      <?php
      }
      ?>	

      <div><button onclick="menubar()" class="username" style="font-weight:20px;"><?php echo $_SESSION['username'];?></button></div>
    	<div style="margin-left: 25px;"><i onclick="menubar()" style="color:#FF0080; font-size: 25px;" class="fa fa-bars" aria-hidden="true"></i></div>
    </div>
    <div class="second-header">
    	<div><a href="**">Movies</a></div>
    	<div><a href="**">Stream</a></div>
    	<div><a href="**">Event</a></div>
    	<div><a href="**">Plays</a></div>
        <div><a href="**">Sports</a></div>
        <div><a href="**">Activities</a></div>
        <div><a href="**">Buzz</a></div>
        <div><a style="margin-left: 500px; "class="xyz" href="**">ListYourShow</a></div>
        <div><a href="**">Corporates</a></div>
        <div><a href="**">Offers</a></div>
        <div><a href="**">Gift cards</a></div>
    </div>
    <div class="container">
      <div class="image-container">
         <div><a href="**"><img style="margin-left:0px;"src="slide2.jpg" width="1250" height="350px"></a></div>
         <div><a href="**"><img src="slide3.jpg" width="1250" height="350px"></a></div>
         <div><a href="**"><img src="slide4.jpg" width="1250" height="350px"></a></div>
         <div><a href="**"><img src="slide5.jpg" width="1250" height="350px"></a></div>
         <div><a href="**"><img src="slide2.jpg" width="1250" height="350px"></a></div>
         <div><a href="**"><img src="slide3.jpg" width="1250" height="350px"></a></div>
        </div>
        <div class="indicators">
           <span id="btn1" class="active"></span>
           <span id="btn2"></span>
           <span id="btn3"></span>
           <span id="btn4"></span>
        </div>
      <div><button class="btn-scroll" id="btn-scroll-left" onclick="scrollleftHorizontally(1)"><i class="fa fa-chevron-left"></i></button></div>
        <div><button class="btn-scroll" id="btn-scroll-right" onclick="scrollrightHorizontally(-1)"><i class="fa fa-chevron-right"></i></button></div>
    </div>
    <?php
    if(isset($_SESSION['cities']))
    {
      $cities=$_SESSION['cities'];
      $con=mysqli_connect('localhost','rudranil','rudra@123');
      mysqli_select_db($con,'moviebooking');
      $q="select * from citywise_show_name WHERE cities LIKE '$cities'";
      $result = mysqli_query($con,$q);
      $num = mysqli_num_rows($result);
      for($i=1;$i<=$num;$i++)
      {
       $row = mysqli_fetch_array($result);
       $_SESSION['movieid'.$i]=$row['movie_id'];
       $moviename['moviename'.$i]=$row['movie_name'];
       $language['movielanguage'.$i]=$row['movie_language'];
       $r="select image_id1 from movies_information where movie_id=".$row['movie_id'];
       $result1= mysqli_query($con,$r);
       $row1= mysqli_fetch_array($result1);
       $image['imageid'.$i]=$row1['image_id1'];
      }
    ?>
      <div class="city-wise-movie-box">
      <div class="filters">
          <h1>Filters</h1>

      </div>
      <div class="movies">
        <h1 style="text-transform:capitalize;">Movies in <?php echo $_SESSION['cities']; ?></h1>
        <div class="language">
          <div>Hindi</div>
          <div>English</div>
          <div>Bengali</div>
          <div>Tamil</div>
          <div>Telegu</div>
        </div>
        <a href="##" style="text-decoration:none;"><div class="coming-soon">Coming Soon....</div></a>
        <div class="recommended">
          <h1 style="color:#454545; font-size: 30px; text-align:center;  position: relative; left:-230px; top:-35px;">Recommended Movies</h1>
        </div>
      
      <div class="image-box1">
        <?php
        if($num>=6)
        { 
          $j=1;
          $g=6;
          if($num%6==0)
          {  
            $a=($num/6);
            for($k=1;$k<=$a;$k++)
            {?>
            <div class="valid-movie">
            <?php
            while($j<=$g)
            {
              ?>
                <a style="text-decoration:none;" href="http://localhost/moviebookingwebsite/movie-booking-page.php?movieid='<?php echo $_SESSION['movieid'.$j];?>'"><img class="img-link1" src="<?php echo $image['imageid'.$j];?>.jpg" width="210" height="350px"><div class="valid-movie-name"><?php echo $moviename['moviename'.$j]; ?></div><div style="color:black; margin-left: 30px; margin-top:5px;text-align: center;font-size: 15px;" class="lang"><?php echo $language['movielanguage'.$j] ?></div></a>
            <?php 
              $j++;
            }
            $g=$j+5;?>
            </div>
            <?php
            }
          }
          else
          { 
            $a=$num-($num%6);
            $s=$a/6;
            $b=$num%6;
            for($k=1;$k<=$s;$k++)
            {?>
            <div class="valid-movie">
            <?php
            while($j<=$g)
            {
              ?>
                <a style="text-decoration:none;" href="http://localhost/moviebookingwebsite/movie-booking-page.php?movieid='<?php echo $_SESSION['movieid'.$j];?>'"><img class="img-link1" src="<?php echo $image['imageid'.$j]; ?>.jpg" width="210" height="350px"><div class="valid-movie-name"><?php echo $moviename['moviename'.$j]; ?></div><div style="color:black; margin-left: 30px; margin-top: 5px;text-align: center;font-size: 15px;" class="lang"><?php echo $language['movielanguage'.$j] ?></div></a>
            <?php 
              $j++;
            }
            $g=$j+5;?>
            </div>
            <?php
            }?>
            <div class="valid-movie">
            <?php
            while($b!=0)
            {
              ?>
              <a style="text-decoration:none;" href="http://localhost/moviebookingwebsite/movie-booking-page.php?movieid='<?php echo $_SESSION['movieid'.$j];?>'"><img class="img-link1" src="<?php echo $image['imageid'.$j]; ?>.jpg" width="210" height="350px"><div class="valid-movie-name"><?php echo $moviename['moviename'.$j]; ?></div><div style="color:black; margin-left: 30px; margin-top: 5px;text-align: center;font-size: 15px;" class="lang"><?php echo $language['movielanguage'.$j] ?></div></a>
            <?php
              $b=($b-1);
            } ?>
            </div>
           <?php
          }
        }
        else
        {?>
          <div class="valid-movie">
          <?php
          for($k=1;$k<=$num;$k++)
          {?>
            <a style="text-decoration:none;" href="http://localhost/moviebookingwebsite/movie-booking-page.php?movieid='<?php echo $_SESSION['movieid'.$k];?>'"><img class="img-link1" src="<?php echo $image['imageid'.$k]; ?>.jpg" width="210" height="350px"><div class="valid-movie-name"><?php echo $moviename['moviename'.$k]; ?></div><div style="color:black; margin-left: 30px; margin-top: 5px;text-align: center;font-size: 15px;" class="lang"><?php echo $language['movielanguage'.$k] ?></div></a>
          <?php 
          }?>
          </div>
        <?php
        }
        ?>
      </div>
     </div>
    </div>
    <?php
    }
    else
    {?>
      <div class="recommended">
      <h1 style="color:#454545; font-size: 30px; margin-bottom: 20px; padding-left:50px;">Recommended Movies</h1>
      <div class="image-box">
         <div class="image-container1">
           <div><a href="**"><img src="slider6.jpg" width="230" height="350px"><div class="img-link">ANEK<div>Action/Political/Thriler</div></div></a></div>
         <div><a href="**"><img src="slider7.jpg" width="230" height="350px"></a></div>
         <div><a href="**"><img src="slider8.jpg" width="230" height="350px"></a></div>
         <div><a href="**"><img src="slider9.jpg" width="230" height="350px"></a></div>
         <div><a href="**"><img src="slider10.jpg" width="230" height="350px"></a></div>
         </div>
         <div class="image-container1">
           <div><a href="**"><img src="slider6.jpg" width="230" height="350px"></a></div>
         <div><a href="**"><img src="slider7.jpg" width="230" height="350px"></a></div>
         <div><a href="**"><img src="slider8.jpg" width="230" height="350px"></a></div>
         <div><a href="**"><img src="slider9.jpg" width="230" height="350px"></a></div>
         <div><a href="**"><img src="slider10.jpg" width="230" height="350px"></a></div>
         </div>
         <div class="image-container1">
           <div><a href="**"><img src="slider6.jpg" width="230" height="350px"></a></div>
         <div><a href="**"><img src="slider7.jpg" width="230" height="350px"></a></div>
         <div><a href="**"><img src="slider8.jpg" width="230" height="350px"></a></div>
         <div><a href="**"><img src="slider9.jpg" width="230" height="350px"></a></div>
         <div><a href="**"><img src="slider10.jpg" width="230" height="350px"></a></div>
         </div>
         <div class="image-container1">
           <div><a href="**"><img src="slider6.jpg" width="230" height="350px"></a></div>
         <div><a href="**"><img src="slider7.jpg" width="230" height="350px"></a></div>
         <div><a href="**"><img src="slider8.jpg" width="230" height="350px"></a></div>
         <div><a href="**"><img src="slider9.jpg" width="230" height="350px"></a></div>
         <div><a href="**"><img src="slider10.jpg" width="230" height="350px"></a></div>
         </div>   
      </div>
    </div>  
    <?php 
    }
    ?>
    <div style="margin-top:15px;"class="ending">
      <div style="display:inline-flex;"><div style="width:550px;border-bottom:solid #666 1px;margin-top:45px;margin-left: 108px;"></div> <div style="font-size:40px;color:#ff0080;opacity:0.7;margin-top:20px;position:absolute;margin-left:678px;">Showpura</div> <div style="width:550px;border-bottom:solid #666 1px;margin-top:-10px;margin-left:200px;"></div></div>
      <div style="display:inline-flex; margin-left:610px; margin-top:60px;">
        <div ><i style="margin-left:8px;margin-top:8px;font-size:35px;color:#666;" class="fa fa-facebook-official official-logo" aria-hidden="true"></i></div>
        <div style="margin-left:10px;"><i style="margin-left:8px;margin-top:8px;font-size:35px;color:#666;" class="fa fa-twitter-square official-logo" aria-hidden="true"></i></div>
        <div style="margin-left:10px;"><i style="margin-left:8px;margin-top:8px;font-size:35px;color:#666;" class="fa fa-instagram" aria-hidden="true"></i></div>
        <div style="margin-left:10px;"><i style="margin-left:8px;margin-top:8px;font-size:35px;color:#666;" class="fa fa-pinterest-square" aria-hidden="true"></i></div>
        <div style="margin-left:10px;"><i style="margin-left:8px;margin-top:8px;font-size:35px;color:#666;" class="fa fa-youtube-play" aria-hidden="true"></i></div>
        <div style="margin-left:10px;"><i style="margin-left:8px;margin-top:8px;font-size:35px;color:#666;" class="fa fa-linkedin-square" aria-hidden="true"></i></div>
      </div>
      <p style="color:#666;margin-left:30px;font-size:15px;padding:10px 100px;">
        <span style="margin-left:370px;">Copyright 2022 © Rudranil_Banerjee Entertainment Pvt. Ltd. All Rights Reserved.</span></br>
        <span>The content and images used on this site are copyright protected and copyrights vests with the respective owners. The usage of the content and images on this website is intended to promote the works and no</br> 
        <span style="margin-left:340px">endorsement of the artist shall be implied.  Unauthorized use is prohibited and punishable by law.</span>
      </p>
    </div>
</body>
</html>