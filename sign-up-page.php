<html>
<head>
<script>
function usernamevalidation(str)
{
 var result=true;
 var y=document.getElementById("validusername");
 var u1=document.getElementById("validu");
 var u2=document.getElementById("invalidu");
 var user = str;
 var usercheck1= /^[A-Za-z][A-Za-z ]{0,6}$/;
 var usercheck= /^[A-Za-z][A-Za-z ]{7,30}$/;
 if(str.length==0 || str.length<=7)
 {
   if(!usercheck1.test(user) && str.length!=0)
  {
   y.innerHTML="**Name is not valid!";
   y.style.color="red";
   u1.style.display="none";
   u2.style.display="block";
   return 0;
  }
  else if(str.length==0)
  {
   y.innerHTML=" ";
   u1.style.display="none";
   u2.style.display="none";
   return 0;
  }
  else{ 
   y.innerHTML="**Name must be between 8-30 letters!";
   y.style.color="red";
   u1.style.display="none";
   u2.style.display="block";
   return 0;
  } 
 }
 else
 {
  if(usercheck.test(user)){
   y.innerHTML=" ";
   u1.style.display="block";
   u2.style.display="none";
   return 1;
  }else{
   y.innerHTML="**Username is invalid!";
   y.style.color="red";
   u1.style.display="none";
   u2.style.display="block";
   return 0;
  }
 }
}
function passwordvalidation(str)
{
 var result=true;
 var p=document.getElementById("validpassword");
 var disclaimer1=document.getElementById("disclaimer");
 var p1=document.getElementById("validp");
 var p2=document.getElementById("invalidp");
 var passwordcheck1= /^[A-Z][A-Za-z0-9!@#$%^&*]{0,10}$/;
 var passwordcheck= /^[A-Z](?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z0-9!@#$%^&*].{9,18}$/;
if(str.length==0 || str.length<11)
{
 if(!passwordcheck1.test(str) && str.length !=0)
  {
   p.innerHTML="**First letter is must be capital letter!";
   p.style.color="red";
   p1.style.display="none";
   p2.style.display="block";
   return 0;
  }
  else if(str.length!=0)
  {
   p.innerHTML="**password must be between 11 to 15 character!!";
   p.style.color="red"; 
   p1.style.display="none";
   p2.style.display="block";
   return 0;
  } 
  else
  {
   p.innerHTML=" ";
   p1.style.display="none";
   p2.style.display="none";
   return 0;
  }
}
else
{ 
 if(passwordcheck.test(str)){
  p.innerHTML=" ";
  p1.style.display="block";
  p2.style.display="none";
  return 1;
 }
 else if(str.length>15)
  {
   p.innerHTML="**password must be between 11 to 15 character!!";
   p.style.color="red"; 
   p1.style.display="none";
   p2.style.display="block";
   return 0;
  } 
 else{
   p.innerHTML="**invalid password!";
   p.style.color="red";
   p1.style.display="none";
   p2.style.display="block";
   return 0;
  }
 }
}
function instruction()
{
  var message=document.getElementById("message");
  message.style.display="block";
}
function removeinstruc()
{
  var message=document.getElementById("message");
  message.style.display="none";
}
function compasswordvalidation(str)
{
 var compassword=document.getElementById("validcompassword");
 var password = document.getElementById("pass").value;
 var p=document.getElementById("validpassword");
 var disclaimer=document.getElementById("disclaimer");
 var cp1=document.getElementById("validcp");
 var cp2=document.getElementById("invalidcp");
 if(str.length!=0 && password.length==0)
  {
   compassword.innerHTML="First fill the password box!!"
   compassword.style.color="red";
   cp1.style.display="none";
   cp2.style.display="block";
   disclaimer.style.display="block";
   return 0;
  }
 else if(str.length==0)
  {
   compassword.innerHTML=" ";
   cp1.style.display="none";
   cp2.style.display="none";
   disclaimer.style.display="none";
   return 0;
  }
  else
  { 
   if(password!=str && str.length!=0)
   {
   compassword.innerHTML="**password does not match!";
   compassword.style.color="red";
   cp1.style.display="none";
   cp2.style.display="block";
   disclaimer.style.display="none";
   return 0;
   }else{
   compassword.innerHTML=" ";
   cp1.style.display="block";
   cp2.style.display="none";
   disclaimer.style.display="none";
   return 1;
  }
 }
}
function emailvalidation(str)
{
 var m = document.getElementById("validemailid");
 var e1=document.getElementById("valide");
 var e2=document.getElementById("invalide");
 var EmailIdcheck= /^[A-Za-z][A-Za-z0-9_.]{2,}@[A-Za-z]{3,}[.]{1}[A-Za-z]{2,5}/;
 if(str.length==0 || str.length<=11)
  {
   if(str.length==0)
   {
   m.innerHTML=" ";
   e1.style.display="none";
   e2.style.display="none";
   return 0;
   } 
   else
   {
    m.innerHTML="**Fill your email id properly";
    m.style.color="red";
    e1.style.display="none";
    e2.style.display="block";
    return 0;
   }
  }
 else if(EmailIdcheck.test(str))
  {
   m.innerHTML=" ";
   e1.style.display="block";
   e2.style.display="none";
   return 1;
  }
  else
  {
   m.innerHTML="**invalid Email id !! ";
   m.style.color="red";
   e1.style.display="none";
   e2.style.display="block";
   return 0;
  }
}
 
function uservalidation(str)
{
 var mob=0;
 var mobilenocheck= /^[6789][0-9]{9}$/;
 var validmob = document.getElementById("validmob");
 var m1= document.getElementById("validm");
 var m2= document.getElementById("invalidm");
  var req = new XMLHttpRequest();
  req.open("GET","http://localhost/moviebookingwebsite/user.php?phoneno="+str,true); 
  req.send();
  req.onreadystatechange = function(){
   if(req.readyState==4 && req.status==200 && str.length>0)
   {
    var x=req.responseText;
    if(x==1)
    {
     validmob.innerHTML="**This Phone no already exist";
     validmob.style.color="red";
     m1.style.display="none";
     m2.style.display="block";
     document.getElementById("addvalue").innerHTML=" ";
     document.getElementById("addvalue").setAttribute("xyz","0");
    }
    else if(x==0)
    {
     if(mobilenocheck.test(str))
     {
      m1.style.display="block";
      m2.style.display="none";
      document.getElementById("addvalue").setAttribute("xyz","5");
     }
     else{ 
     validmob.innerHTML="**Pls enter a valid phone no!!";
     validmob.style.color="red";
     m1.style.display="none";
     m2.style.display="block";
     document.getElementById("addvalue").innerHTML=" ";
     document.getElementById("addvalue").setAttribute("xyz","0");
     }
    }
   }
   else
   {
    validmob.innerHTML=" ";
    m1.style.display="none";
     m2.style.display="none";
    document.getElementById("addvalue").innerHTML=" ";
    document.getElementById("addvalue").setAttribute("xyz","0");
   }
  };
element=document.getElementById("addvalue").getAttribute("xyz");
return element;
}

function enable()
{
 var btn= document.getElementById("btn");
 var username= document.getElementById("username").value;
 var phoneno= document.getElementById("phoneNo").value;
 var emailId= document.getElementById("emailid").value;
 var password= document.getElementById("pass").value;
 var compassword= document.getElementById("compass").value;
 var a=emailvalidation(emailId);
 var b=usernamevalidation(username);
 var c=compasswordvalidation(compassword);
 var d=passwordvalidation(password);
 var e=uservalidation(phoneno);
 if(a==1 && b==1 && c==1 && d==1 && e==5)
 {
 btn.removeAttribute('disabled');
 btn.style.opacity="1";
 }
 else
 {
 btn.setAttribute('disabled','disabled');
 btn.style.opacity="0.5";
 }
}
</script>
<link rel="stylesheet" type="text/css" href="http://localhost/moviebookingwebsite/sign-up form style.css">
<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <div class="container">
  	<div><img class="image-set" src="http://localhost/moviebookingwebsite/s6.jpg" width="600" height="500"></img></div>
  	<div class="form-container">
  	  <div style="padding-top:20px; margin-bottom: 14px;"><img src="http://localhost/moviebookingwebsite/logo-of-company.jpg" width="220" height="40"></img></div>	
      <form action="http://localhost/moviebookingwebsite/new-user-homepage.php" method="post">
        <div class="input-name">
        	<i class="fa fa-user-circle-o lock"></i><input class="text-name" type="text" placeholder="Name" name="username" oninput="usernamevalidation(this.value)" id="username" onkeyup="enable()" required/><div id="validusername"></div><div style="height:30px;width:30px;background-color:green;padding:5px 5px;border-radius:50%;position:relative;margin-left:440px; margin-bottom:10px;margin-top:-37px;display:none;"id="validu"><i style="color:white;"class="fa fa-check" aria-hidden="true"></i></div><div style="height:30px;width:30px;background-color:red;padding:4px 6px;border-radius:50%;position:relative;margin-left:440px;margin-top:-55px;margin-bottom:10px;display:none;"id="invalidu"><i style="color:white;" class="fa fa-times" aria-hidden="true"></i></div>
        </div>

        <div class="input-name">
        	<i class="fa fa-mobile lock" style="margin-right: 12px; font-size: 26px; padding-bottom:10px;"></i><input class="text-name" type="text" placeholder="Phone Number" id="phoneNo" name="phone_no" oninput="uservalidation(this.value)" onkeyup="enable()" required/><span id="addvalue"></span><div id="validmob"></div><div style="height:30px;width:30px;background-color:green;padding:5px 5px;border-radius:50%;position:relative;margin-left:440px;margin-top:-37px;margin-bottom:10px;display: none;"id="validm"><i style="color:white;"class="fa fa-check" aria-hidden="true"></i></div><div style="height:30px;width:30px;background-color:red;padding:4px 6px;border-radius:50%;position:relative;margin-left:440px;margin-top:-55px;margin-bottom:10px;display:none;"id="invalidm"><i style="color:white;" class="fa fa-times" aria-hidden="true"></i></div>
        </div>
        <div class="input-name">
        	<i class="fa fa-envelope lock"></i><input class="text-name" type="text" placeholder="Email Address" name="email_id" oninput="emailvalidation(this.value)" id="emailid" onkeyup="enable()" required/><div id="validemailid"></div><div style="height:30px;width:30px;background-color:green;padding:5px 5px;border-radius:50%;position:relative;margin-left:440px;margin-top:-37px;margin-bottom:10px;display:none;"id="valide"><i style="color:white;"class="fa fa-check" aria-hidden="true"></i></div><div style="height:30px;width:30px;background-color:red;padding:4px 6px;border-radius:50%;position:relative;margin-left:440px;margin-top:-55px;margin-bottom:10px;display:none;"id="invalide"><i style="color:white;" class="fa fa-times" aria-hidden="true"></i></div>
        </div>
        <div class="input-name">
        	<i class="fa fa-key lock"></i><input class="text-name" type="Set Password" placeholder="Enter password" id="pass" name="password" oninput="passwordvalidation(this.value)" onkeyup="enable()" onmouseover="instruction()" onmouseout="removeinstruc()"required/><div id="validpassword"></div><div style="height:30px;width:30px;background-color:green;padding:5px 5px;border-radius:50%;position:relative;margin-left:440px;margin-top:-37px;margin-bottom:10px;display:none;"id="validp"><i style="color:white;"class="fa fa-check" aria-hidden="true"></i></div><div style="height:30px;width:30px;background-color:red;padding:4px 6px;border-radius:50%;position:relative;margin-left:440px;margin-top:-55px;margin-bottom:10px;display:none;"id="invalidp"><i style="color:white;" class="fa fa-times" aria-hidden="true"></i></div>
            <div style="display:none;" id="disclaimer">
              <div style="height:40px;width:180px;position:relative;margin-left:440px;margin-top:-42px;border:solid black 2px; background-color:white;display:inline-flex;padding-left:5px;padding-top:2px;"><div style="height:30px;width:30px;padding:5px 10px; border-radius:50%;background-color:#FF4500;"><i style="color:white;margin-right:10px;" class="fa fa-exclamation" aria-hidden="true"></i></div><span style="margin-left:5px;font-size:17px;margin-top:5px;">First fill this box !</span></div>
            </div>
            <div style="width:480px;background-color:#F5F5F5;padding:0px 30px;border-right:solid black 1px;border-left:solid black 1px;border-bottom:solid black 1px;position:absolute;z-index:1;display:none;" id="message"><ul>
              <li style="color:green;">First letter is must be capital</li>
              <li style="color:green;">At least one lower case letter [a-z]</li>
              <li style="color:green;">At least one numeral [0-9]</li>
              <li style="color:green;">At least one symbol [!@#$%^&*]</li>
              <li style="color:green;">Minimum 10 characters</li>
            </ul></div>
        </div>
        <div class="input-name">
        	<i class="fa fa-lock lock" style="margin-right: 9px; font-size: 20px;"></i><input class="text-name" type="text" placeholder="Confirm Password" id="compass" oninput="compasswordvalidation(this.value)" onkeyup="enable()" required/><div id="validcompassword"></div><div style="height:30px;width:30px;background-color:green;padding:5px 5px;border-radius:50%;position:relative;margin-left:440px;margin-top:-37px;margin-bottom:25px;display:none;"id="validcp"><i style="color:white;"class="fa fa-check" aria-hidden="true"></i></div><div style="height:30px;width:30px;background-color:red;padding:4px 6px;border-radius:50%;position:relative;margin-left:440px;margin-top:-55px;margin-bottom:25px;display:none;"id="invalidcp"><i style="color:white;" class="fa fa-times" aria-hidden="true"></i></div>
        </div>
        <div style="font-size:15px; margin-top:5px; margin-bottom: 12px;">
        	<label style="font-weight: bold;">By signing up, you agree to our <a style="color:black; color:#FF0080"  href="***">Terms of use</a> and <a style="color:black; color:#FF0080"  href="***"> Privacy policy</a></label>
        </div>
        <input style="margin-top: 5px; border-radius: 5px; opacity:0.5; background-color:#FF0080; color:white;" id="btn" type="submit" value="Sign Up" disabled="disabled"/>
      </form>
      <div style="text-align: center; font-size: 17px; margin-top: 10px;">
      <span >Already a member?</span><a style="color:red;" href="http://localhost/moviebookingwebsite/log-in-page.php"> LOG IN</a>
      </div>
    <div>
  </div>
</body>
</html>