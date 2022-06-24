<?php
session_start();
$_SESSION['cities']=$_GET['city'];
$_SESSION['day']=$_GET['day'];
$_SESSION['date']=$_GET['date'];
$_SESSION['month']=$_GET['month'];
$hour=$_GET['hour'];
$cities=$_SESSION['cities'];
$date=$_SESSION['date'];
$f=0;
$con=mysqli_connect('localhost','rudranil','rudra@123');
mysqli_select_db($con,'moviebooking');
$q="select cinema_hall_id from movieandcitywise_book where cities='$cities' && date='$date' && movie_id=".$_SESSION['movie_id'];
$result = mysqli_query($con,$q);
$num=mysqli_num_rows($result);
if($num==0)
{
  echo "sorry, no moviecomplex found in this date1";
}
for($i=1;$i<=$num;$i++)
{
  $row = mysqli_fetch_array($result);
  $cinemahallid['cinemahallid'.$i]=$row['cinema_hall_id'];
}
for($i=1;$i<=$num;$i++)
{
  $s="select * from cinema_hall where cinema_hall_id=".$cinemahallid['cinemahallid'.$i];
  $result= mysqli_query($con,$s);
  $row = mysqli_fetch_array($result);
  $hallname['hall_name'.$i]=$row['cine_hall_name'];
  $time1['firstshow'.$i]=$row['Time1'];
  $time1['hour'.$i]=$row['Time1_hour'];
  $time2['secondshow'.$i]=$row['Time2'];
  $time2['hour'.$i]=$row['Time2_hour'];
  $time3['thirdshow'.$i]=$row['Time3'];
  $time3['hour'.$i]=$row['Time3_hour'];
}
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta name="viewport", content="width=device-width,initial-scale=1.0">
  <link href="http://fonts.cdnfonts.com/css/jenna-sue" rel="stylesheet">
</head>
<body>
  <div style="background-color:white; width:100%;font-family:Times new roman; font-size:15px;">
    <?php
  if($num==0)
  {?>
    <div style="font-size:25px;text-align:center;padding-bottom:30px;padding-top:15px;">Sorry, No complex is available on <?php echo $_SESSION['day'].", ".$_SESSION['date']." ".$_SESSION['month']?></div>
  <?php
  }
  else
  {?>
    <div style="font-size:25px;text-align:center;border-bottom:solid #FF0080 3px;margin-bottom:5px;">Available Complex in <?php echo $cities ?> on <?php echo $_SESSION['day'].", ".$_SESSION['date']." ".$_SESSION['month']?></div>
  <?php 
  for($k=1;$k<=$num;$k++)
    {
      if(($time1['hour'.$k]!=0 && $time1['hour'.$k]>$hour) || ($time2['hour'.$k]!=0 && $time2['hour'.$k]>$hour) || ($time3['hour'.$k]!=0 && $time3['hour'.$k]>$hour))
        {?>
           <div style="width:100%; height:80px; border-bottom:solid #454545 1px; border-right:solid #454545 1px; font-weight:bold; padding:10px 05px;"><div style="margin-left:50px; color:black;text-transform:uppercase;"><?php echo $hallname['hall_name'.$k];?></div><div style="display:inline-flex; margin-top:20px;">
              <?php 
               if($time1['hour'.$k]!=0 && $time1['hour'.$k]>$hour)
               {?>
                 <a href="http://localhost/moviebookingwebsite/seat-booking-slot.php?time=<?php echo $time1['firstshow'.$k];?>&cinemahallname=<?php echo $hallname['hall_name'.$k];?>&cinemahallid=<?php echo $cinemahallid['cinemahallid'.$k];?>" style="text-decoration:none;color:#FF0080;"><div style="width:100px;height:30px; border: solid #FF0080 2px; border-radius:7px; margin-left:25px;padding: 5px 15px;margin-left:10px;margin-top:-10px;"><?php echo $time1['firstshow'.$k];?></div></a>
               <?php
               }
               if($time2['hour'.$k]!=0 && $time2['hour'.$k]>$hour)
               {
               ?>
                 <a href="http://localhost/moviebookingwebsite/seat-booking-slot.php?time=<?php echo $time2['secondshow'.$k];?>&cinemahallname=<?php echo $hallname['hall_name'.$k];?>&cinemahallid=<?php echo $cinemahallid['cinemahallid'.$k];?>" style="text-decoration:none;color:#FF0080;"><div style="width:100px;height:30px; border: solid #FF0080 2px; border-radius:7px; margin-left:25px;padding: 5px 15px;margin-left:10px;margin-top:-10px;"><?php echo $time2['secondshow'.$k]; ?></div></a>
               <?php
               }
               if($time3['hour'.$k]!=0 && $time3['hour'.$k]>$hour)
               {
               ?>
                 <a href="http://localhost/moviebookingwebsite/seat-booking-slot.php?time=<?php echo $time3['thirdshow'.$k];?>&cinemahallname=<?php echo $hallname['hall_name'.$k];?>&cinemahallid=<?php echo $cinemahallid['cinemahallid'.$k];?>" style="text-decoration:none;color:#FF0080;"><div style="width:100px;height:30px; border: solid #FF0080 2px; border-radius:7px; margin-left:25px;padding: 5px 15px;margin-left:10px;margin-top:-10px;"><?php echo $time3['thirdshow'.$k]; ?></div></a>
               <?php
               }
               $f++;
               ?>
           </div>
        </div>
      <?php 
       }
    }
    if($f==0)
    {?>
      <div style="width:100%;background-color:#fff;height:300px;padding:50px 60px;">
        <div style="font-family:'Jenna Sue', sans-serif; font-size:46px;padding: 0px 20px;">Sorry,Today seat is not available, pls select another date.</div>
      </div>
    <?php
    }
   }
  ?> 
  </div>  
</body>
</html>