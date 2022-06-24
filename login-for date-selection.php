<html>
<head>
	<title></title>
	<meta name="viewport", content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="log-in-page-style.css">
</head>
<body>
<div class="login">
   <form class="log-in-form" action="http://localhost/moviebookingwebsite/movie-booking-page-after-login.php" method="post">
    <div><input type="text" name="phoneno" placeholder="Mobile Number/Email Id" required/></div>
    <div><input type="password" name="password" placeholder="Password" required/></div>
    <div style="margin-top:12px; margin-left: 25px"><input style="background-color:#454545; width:300px; font-weight: bold; color:#E0E0E0; font-size:20px; font-family:Times new roman;"type="submit" value="Log in"/></div>
   </form>
   <div style="font-size:17px;margin-left:110px;">New user? <a href="http://localhost/moviebookingwebsite/sign-up-page.php" style="color:white; font-size:20px;text-decoration:none;">Sign up</a></div>
</div>
</body>
</html>