<?php
session_start();
$_SESSION['hallname']=$_GET['cinemahallname'];
$_SESSION['time']=$_GET['time'];
$_SESSION['cinemahallid']=$_GET['cinemahallid'];
$date=$_SESSION['day'].",".$_SESSION['date']." ".$_SESSION['month'];
$hallname=$_SESSION['hallname'];
$movie_name=$_SESSION['movie_name'];
$time=$_SESSION['time'];
$con=mysqli_connect('localhost','rudranil','rudra@123');
mysqli_select_db($con,'moviebooking');
$q="select*from cinema_hall where cinema_hall_id=".$_SESSION['cinemahallid'];
$result = mysqli_query($con,$q);
$row = mysqli_fetch_array($result);
$platinum=$row['ticket_price_balcony'];
$gold=$row['ticket_price_middle'];
$silver=$row['ticket_price_screen'];
$_SESSION['address']=$row['Address'];
$m="select*from booking_information where cinema_hall_name='$hallname' && movie_name='$movie_name' && time='$time' && date='$date'";
$result1=mysqli_query($con,$m);
$num=mysqli_num_rows($result1);
for($i=1;$i<=$num;$i++)
{
	$row1=mysqli_fetch_array($result1);
	$bookedp['platiseat'.$i]=$row1['platinum_seat_no'];
	$bookedg['goldseat'.$i]=$row1['gold_seat_no'];
	$bookeds['silverseat'.$i]=$row1['silver_seat_no'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="http://localhost/moviebookingwebsite/seat-booking-slot.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
		<?php 
		for($i=1;$i<=$num;$i++)
		{
			if($bookedp['platiseat'.$i]!="")
			{?>
		      let ansplatinum<?php echo $i;?>="<?php echo $bookedp['platiseat'.$i];?>";
		      let ansp<?php echo $i;?>=ansplatinum<?php echo $i;?>.split(",");
            <?php
		    }
		    else
		    {?>
		      let ansp<?php echo $i;?>=0;	
            <?php
		    }
		    if($bookedg['goldseat'.$i]!="")
		    {
		    ?>
		      let ansgold<?php echo $i;?>="<?php echo $bookedg['goldseat'.$i];?>";
		      let ansg<?php echo $i;?>=ansgold<?php echo $i;?>.split(",");
		    <?php
		    }
            else
            {?>
              let ansg<?php echo $i;?>=0;	
            <?php
            }
		    if($bookeds['silverseat'.$i]!="")
		    {
		    ?>
		      let anssilver<?php echo $i;?>="<?php echo $bookeds['silverseat'.$i];?>";
		      let anss<?php echo $i;?>=anssilver<?php echo $i;?>.split(",");
		    <?php
		    }
            else
            {
            ?>
              let anss<?php echo $i;?>=0;
            <?php
            }
		    ?>
		<?php
		}
		?>
		$(document).ready(function(){
			<?php
		   for($A=1;$A<=$num;$A++)
		   {?>	
		   	 var platinum<?php echo $A;?>=ansp<?php echo $A;?>.length;
		   	 var goldnum<?php echo $A;?>=ansg<?php echo $A;?>.length;
		   	 var silvernum<?php echo $A;?>=anss<?php echo $A;?>.length;
		   	 for(var h=0;h<=silvernum<?php echo $A;?>;h++)
             {
             	$('#'+anss<?php echo $A;?>[h]).addClass("occupied");
             }
		     for(var f=0;f<=platinum<?php echo $A;?>;f++)
		     {
                $('#'+ansp<?php echo $A;?>[f]).addClass("occupied");
             }
             for(var g=0;g<=goldnum<?php echo $A;?>;g++)
             {
             	$('#'+ansg<?php echo $A;?>[g]).addClass("occupied");
             }
           <?php
           }
           ?>
		});
	</script>
	<script>
		var i=0;
		var j=0;
		var k=0;
		var seatnop=new Array();
        var seatnog=new Array();
        var seatnos=new Array();
        var platinum_ticket=<?php echo $platinum; ?>;
        var gold_ticket=<?php echo $gold; ?>;
        var silver_ticket=<?php echo $silver; ?>;
        function updateselectedcount()
        {
           var selectedseatsforplatinum=document.querySelectorAll('#platinum .seat.selected');
           var selectedseatsforgold=document.querySelectorAll('#gold .seat.selected');
           var selectedseatsforsilver=document.querySelectorAll('#silver .seat.selected');
           var selected_seat_countp=selectedseatsforplatinum.length;
           var selected_seat_countg=selectedseatsforgold.length;
           var selected_seat_counts=selectedseatsforsilver.length;
           document.getElementById("select-seats").innerText=selected_seat_countp+selected_seat_countg+selected_seat_counts+" ticket";
           if(selected_seat_countp+selected_seat_countg+selected_seat_counts===0)
           {
           	document.getElementById("total-bill-box").style.display="none";
           	document.getElementById("select-seats").innerText="Select";
           }
           else
           {
              document.getElementById("total-bill-box").style.display="block";
              document.getElementById("total-bill").innerText=(selected_seat_countp*platinum_ticket)+(selected_seat_countg*gold_ticket)+(selected_seat_counts*silver_ticket);
           }
        }
          function billpayment()
           {
           	var selectedseatsforplatinum=document.querySelectorAll('#platinum .seat.selected');
            var selectedseatsforgold=document.querySelectorAll('#gold .seat.selected');
            var selectedseatsforsilver=document.querySelectorAll('#silver .seat.selected');
            var selected_seat_countp=selectedseatsforplatinum.length;
            var selected_seat_countg=selectedseatsforgold.length;
            var selected_seat_counts=selectedseatsforsilver.length;
            var total_ammount=(selected_seat_countp*platinum_ticket)+(selected_seat_countg*gold_ticket)+(selected_seat_counts*silver_ticket);
            var total_seat=(selected_seat_countp+selected_seat_countg+selected_seat_counts);
            $('.row .seat.selected').addClass("occupied");
            var req=new XMLHttpRequest();
            req.open("GET","http://localhost/moviebookingwebsite/payment-successful-page.php?totalpayment="+total_ammount+"&totalseat="+total_seat+"&seatnoplatinum="+seatnop+"&seatnogold="+seatnog+"&seatnosilver="+seatnos,true);
            req.send();
            req.onreadystatechange=function(){
            	if(req.readyState==4 && req.status==200){
            		var x=req.responseText;
            		document.getElementById("new-page").innerHTML=x;
            	}
           	};
           } 
      $(document).ready(function(){
        $('#platinum').on("click",function(){
          if(event.target.classList.contains('seat') && !event.target.classList.contains('occupied'))
          {
          	event.target.classList.toggle('selected');
          	var x=event.target.innerText;
          	seatnop[i]=x;
          	i++;
          }
          updateselectedcount();
        });
        $('#gold').on("click",function(){
          if(event.target.classList.contains('seat') && !event.target.classList.contains('occupied'))
          {
          	event.target.classList.toggle('selected');
          	var y=event.target.innerText;
          	seatnog[j]=y;
          	j++;
          }
          updateselectedcount();
        });
        $('#silver').on("click",function(){
          if(event.target.classList.contains('seat') && !event.target.classList.contains('occupied'))
          {
          	event.target.classList.toggle('selected');
          	var z=event.target.innerText;
          	seatnos[k]=z;
          	k++;
          }
          updateselectedcount();
        });
      });


	</script>
</head>
<body id="new-page">
	<h3></h3>
<div class="first-header">
	<a href="http://localhost/moviebookingwebsite/movie-booking-page.php?movieid=<?php echo $_SESSION['movie_id'];?>"><i class="fa fa-chevron-left" style="color:#FF0080;margin-top:10px; font-size:20px;"></i></a>
	<div style="margin-left:7px;">
	    <div class="movie-name"><?php echo $_SESSION['movie_name'];?></div>
	    <div class="hall-name"><?php echo $_SESSION['hallname'];?> | <?php echo $_SESSION['day'];?>, <?php echo $_SESSION['date'];?> <?php echo $_SESSION['month'];?>, <?php echo $_SESSION['time'];?></div>
    </div>
    <div class="no-of-seat-choice" id="select-seats">Select</div>   
</div>
<div class="seat-box" id="mybtn">
	<div class="showcase">
		<div class="connect">
			<div class="seat"></div>
			<div>Available</div>
		</div>
		<div class="connect">
			<div class="seat selected"></div>
			<div>Selected</div>
		</div>
		<div class="connect">
			<div class="seat occupied"></div>
			<div>Sold</div>
		</div>
	</div>
	<div class="seat-variation-platinum">Platinum-Rs. <?php echo $platinum ?>.00</div>
	<div id="platinum">
	<div class="row" style="margin-top: 17px;">
		<div style="margin-right:15px; width:10px;">A</div>
		  <div class="seat" id="A-1">A-1</div>
		  <div class="seat" id="A-2">A-2</div>
		  <div class="seat" id="A-3">A-3</div>
          <div class="seat" id="A-4">A-4</div>
		  <div class="seat" id="A-5">A-5</div>
		  <div class="seat" id="A-6">A-6</div>
		  <div class="seat" id="A-7">A-7</div>
		  <div class="seat" id="A-8">A-8</div>
		  <div class="seat" id="A-9">A-9</div>
		  <div class="seat" id="A-10">A-10</div>
		  <div class="seat" id="A-11">A-11</div>
		  <div class="seat" id="A-12">A-12</div>
		  <div class="seat" id="A-13">A-13</div>
		  <div class="seat" id="A-14">A-14</div>
		  <div class="seat" id="A-15">A-15</div>
		  <div class="seat" id="A-16">A-16</div>
		  <div class="seat" id="A-17">A-17</div>
		  <div class="seat" id="A-18">A-18</div>
		  <div class="seat" id="A-19">A-19</div>
		  <div class="seat" id="A-20">A-20</div>
	</div>
	<div class="row">
		<div style="margin-right:15px; width:10px;">B</div>
		  <div class="seat" id="B-1">B-1</div>
		  <div class="seat" id="B-2">B-2</div>
		  <div class="seat" id="B-3">B-3</div>
          <div class="seat" id="B-4">B-4</div>
		  <div class="seat" id="B-5">B-5</div>
		  <div class="seat" id="B-6">B-6</div>
		  <div class="seat" id="B-7">B-7</div>
		  <div class="seat" id="B-8">B-8</div>
		  <div class="seat" id="B-9">B-9</div>
		  <div class="seat" id="B-10">B-10</div>
		  <div class="seat" id="B-11">B-11</div>
		  <div class="seat" id="B-12">B-12</div>
		  <div class="seat" id="B-13">B-13</div>
		  <div class="seat" id="B-14">B-14</div>
		  <div class="seat" id="B-15">B-15</div>
		  <div class="seat" id="B-16">B-16</div>
		  <div class="seat" id="B-17">B-17</div>
		  <div class="seat" id="B-18">B-18</div>
		  <div class="seat" id="B-19">B-19</div>
		  <div class="seat" id="B-20">B-20</div>
	</div>
	<div class="row">
		<div style="margin-right:15px; width:10px;">C</div>
		  <div class="seat" id="C-1">C-1</div>
		  <div class="seat" id="C-2">C-2</div>
		  <div class="seat" id="C-3">C-3</div>
          <div class="seat" id="C-4">C-4</div>
		  <div class="seat" id="C-5">C-5</div>
		  <div class="seat" id="C-6">C-6</div>
		  <div class="seat" id="C-7">C-7</div>
		  <div class="seat" id="C-8">C-8</div>
		  <div class="seat" id="C-9">C-9</div>
		  <div class="seat" id="C-10">C-10</div>
		  <div class="seat" id="C-11">C-11</div>
		  <div class="seat" id="C-12">C-12</div>
		  <div class="seat" id="C-13">C-13</div>
		  <div class="seat" id="C-14">C-14</div>
		  <div class="seat" id="C-15">C-15</div>
		  <div class="seat" id="C-16">C-16</div>
		  <div class="seat" id="C-17">C-17</div>
		  <div class="seat" id="C-18">C-18</div>
		  <div class="seat" id="C-19">C-19</div>
		  <div class="seat" id="C-20">C-20</div>
	</div> 
	<div class="row">
		<div style="margin-right:15px; width:10px;">D</div>
		  <div class="seat" id="D-1">D-1</div>
		  <div class="seat" id="D-2">D-2</div>
		  <div class="seat" id="D-3">D-3</div>
          <div class="seat" id="D-4">D-4</div>
		  <div class="seat" id="D-5">D-5</div>
		  <div class="seat" id="D-6">D-6</div>
		  <div class="seat" id="D-7">D-7</div>
		  <div class="seat" id="D-8">D-8</div>
		  <div class="seat" id="D-9">D-9</div>
		  <div class="seat" id="D-10">D-10</div>
		  <div class="seat" id="D-11">D-11</div>
		  <div class="seat" id="D-12">D-12</div>
		  <div class="seat" id="D-13">D-13</div>
		  <div class="seat" id="D-14">D-14</div>
		  <div class="seat" id="D-15">D-15</div>
		  <div class="seat" id="D-16">D-16</div>
		  <div class="seat" id="D-17">D-17</div>
		  <div class="seat" id="D-18">D-18</div>
		  <div class="seat" id="D-19">D-19</div>
		  <div class="seat" id="D-20">D-20</div>
	</div> 
	<div class="row">
		<div style="margin-right:15px; width:10px;">E</div>
		  <div class="seat" id="E-1">E-1</div>
		  <div class="seat" id="E-2">E-2</div>
		  <div class="seat" id="E-3">E-3</div>
          <div class="seat" id="E-4">E-4</div>
		  <div class="seat" id="E-5">E-5</div>
		  <div class="seat" id="E-6">E-6</div>
		  <div class="seat" id="E-7">E-7</div>
		  <div class="seat" id="E-8">E-8</div>
		  <div class="seat" id="E-9">E-9</div>
		  <div class="seat" id="E-10">E-10</div>
		  <div class="seat" id="E-11">E-11</div>
		  <div class="seat" id="E-12">E-12</div>
		  <div class="seat" id="E-13">E-13</div>
		  <div class="seat" id="E-14">E-14</div>
		  <div class="seat" id="E-15">E-15</div>
		  <div class="seat" id="E-16">E-16</div>
		  <div class="seat" id="E-17">E-17</div>
		  <div class="seat" id="E-18">E-18</div>
		  <div class="seat" id="E-19">E-19</div>
		  <div class="seat" id="E-20">E-20</div>
	</div> 
	<div class="row">
		<div style="margin-right:15px; width:10px;">F</div>
		  <div class="seat" id="F-1">F-1</div>
		  <div class="seat" id="F-2">F-2</div>
		  <div class="seat" id="F-3">F-3</div>
          <div class="seat" id="F-4">F-4</div>
		  <div class="seat" id="F-5">F-5</div>
		  <div class="seat" id="F-6">F-6</div>
		  <div class="seat" id="F-7">F-7</div>
		  <div class="seat" id="F-8">F-8</div>
		  <div class="seat" id="F-9">F-9</div>
		  <div class="seat" id="F-10">F-10</div>
		  <div class="seat" id="F-11">F-11</div>
		  <div class="seat" id="F-12">F-12</div>
		  <div class="seat" id="F-13">F-13</div>
		  <div class="seat" id="F-14">F-14</div>
		  <div class="seat" id="F-15">F-15</div>
		  <div class="seat" id="F-16">F-16</div>
		  <div class="seat" id="F-17">F-17</div>
		  <div class="seat" id="F-18">F-18</div>
		  <div class="seat" id="F-19">F-19</div>
		  <div class="seat" id="F-20">F-20</div>
	</div></div> 
	<div class="seat-variation-gold">Gold-Rs. <?php echo $gold; ?>.00</div>
	<div id="gold">
	<div class="row" style="margin-top: 17px;">
		<div style="margin-right:15px; width:10px;">G</div>
		  <div class="seat" id="G-1">G-1</div>
		  <div class="seat" id="G-2">G-2</div>
		  <div class="seat" id="G-3">G-3</div>
          <div class="seat" id="G-4">G-4</div>
		  <div class="seat" id="G-5">G-5</div>
		  <div class="seat" id="G-6">G-6</div>
		  <div class="seat" id="G-7">G-7</div>
		  <div class="seat" id="G-8">G-8</div>
		  <div class="seat" id="G-9">G-9</div>
		  <div class="seat" id="G-10">G-10</div>
		  <div class="seat" id="G-11">G-11</div>
		  <div class="seat" id="G-12">G-12</div>
		  <div class="seat" id="G-13">G-13</div>
		  <div class="seat" id="G-14">G-14</div>
		  <div class="seat" id="G-15">G-15</div>
		  <div class="seat" id="G-16">G-16</div>
		  <div class="seat" id="G-17">G-17</div>
		  <div class="seat" id="G-18">G-18</div>
		  <div class="seat" id="G-19">G-19</div>
		  <div class="seat" id="G-20">G-20</div>
	</div> 
	<div class="row">
		<div style="margin-right:15px; width:10px;">H</div>
		  <div class="seat" id="H-1">H-1</div>
		  <div class="seat" id="H-2">H-2</div>
		  <div class="seat" id="H-3">H-3</div>
          <div class="seat" id="H-4">H-4</div>
		  <div class="seat" id="H-5">H-5</div>
		  <div class="seat" id="H-6">H-6</div>
		  <div class="seat" id="H-7">H-7</div>
		  <div class="seat" id="H-8">H-8</div>
		  <div class="seat" id="H-9">H-9</div>
		  <div class="seat" id="H-10">H-10</div>
		  <div class="seat" id="H-11">H-11</div>
		  <div class="seat" id="H-12">H-12</div>
		  <div class="seat" id="H-13">H-13</div>
		  <div class="seat" id="H-14">H-14</div>
		  <div class="seat" id="H-15">H-15</div>
		  <div class="seat" id="H-16">H-16</div>
		  <div class="seat" id="H-17">H-17</div>
		  <div class="seat" id="H-18">H-18</div>
		  <div class="seat" id="H-19">H-19</div>
		  <div class="seat" id="H-20">H-20</div>
	</div></div> 
	<div class="seat-variation-gold">Silver-Rs. <?php echo $silver; ?>.00</div>
	<div id="silver">
	<div class="row" style="margin-top: 17px;">
		<div style="margin-right:15px; width:10px;">I</div>
		  <div class="seat" id="I-1">I-1</div>
		  <div class="seat" id="I-2">I-2</div>
		  <div class="seat" id="I-3">I-3</div>
          <div class="seat" id="I-4">I-4</div>
		  <div class="seat" id="I-5">I-5</div>
		  <div class="seat" id="I-6">I-6</div>
		  <div class="seat" id="I-7">I-7</div>
		  <div class="seat" id="I-8">I-8</div>
		  <div class="seat" id="I-9">I-9</div>
		  <div class="seat" id="I-10">I-10</div>
		  <div class="seat" id="I-11">I-11</div>
		  <div class="seat" id="I-12">I-12</div>
		  <div class="seat" id="I-13">I-13</div>
		  <div class="seat" id="I-14">I-14</div>
		  <div class="seat" id="I-15">I-15</div>
		  <div class="seat" id="I-16">I-16</div>
		  <div class="seat" id="I-17">I-17</div>
		  <div class="seat" id="I-18">I-18</div>
		  <div class="seat" id="I-19">I-19</div>
		  <div class="seat" id="I-20">I-20</div>
	</div> 
	<div class="row">
		<div style="margin-right:15px; width:10px;">J</div>
		  <div class="seat" id="J-1">J-1</div>
		  <div class="seat" id="J-2">J-2</div>
		  <div class="seat" id="J-3">J-3</div>
          <div class="seat" id="J-4">J-4</div>
		  <div class="seat" id="J-5">J-5</div>
		  <div class="seat" id="J-6">J-6</div>
		  <div class="seat" id="J-7">J-7</div>
		  <div class="seat" id="J-8">J-8</div>
		  <div class="seat" id="J-9">J-9</div>
		  <div class="seat" id="J-10">J-10</div>
		  <div class="seat" id="J-11">J-11</div>
		  <div class="seat" id="J-12">J-12</div>
		  <div class="seat" id="J-13">J-13</div>
		  <div class="seat" id="J-14">J-14</div>
		  <div class="seat" id="J-15">J-15</div>
		  <div class="seat" id="J-16">J-16</div>
		  <div class="seat" id="J-17">J-17</div>
		  <div class="seat" id="J-18">J-18</div>
		  <div class="seat" id="J-19">J-19</div>
		  <div class="seat" id="J-20">J-20</div>
	</div> 
	<div class="row">
		<div style="margin-right:15px; width:10px;">K</div>
		  <div class="seat" id="K-1">K-1</div>
		  <div class="seat" id="K-2">K-2</div>
		  <div class="seat" id="K-3">K-3</div>
          <div class="seat" id="K-4">K-4</div>
		  <div class="seat" id="K-5">K-5</div>
		  <div class="seat" id="K-6">K-6</div>
		  <div class="seat" id="K-7">K-7</div>
		  <div class="seat" id="K-8">K-8</div>
		  <div class="seat" id="K-9">K-9</div>
		  <div class="seat" id="K-10">K-10</div>
		  <div class="seat" id="K-11">K-11</div>
		  <div class="seat" id="K-12">K-12</div>
		  <div class="seat" id="K-13">K-13</div>
		  <div class="seat" id="K-14">K-14</div>
		  <div class="seat" id="K-15">K-15</div>
		  <div class="seat" id="K-16">K-16</div>
		  <div class="seat" id="K-17">K-17</div>
		  <div class="seat" id="K-18">K-18</div>
		  <div class="seat" id="K-19">K-19</div>
		  <div class="seat" id="K-20">K-20</div>
	</div></div> 
	<div class="screen"></div>
	<div style="margin-left:420px; font-size:17px; margin-bottom: 70px;">All eyes this way please!</div>
</div>
<div class="total-bill-box" id="total-bill-box">
	<div onclick="billpayment()" class="total-pay">Pay Rs.<span id="total-bill">100</span>.00</div>
</div>
</body>
</html>