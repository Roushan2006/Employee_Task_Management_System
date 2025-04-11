<?php
// error_reporting(-1);
// ini_set('display_errors', 'On');

 session_start(); 
if(!isset($_SESSION['admin_id'])) // to check user is admn or not
{
  session_destroy();
  header("location:../Logout.php");    
}?>
<!DOCTYPE html>
<html>
<head>
  <title>Add New User</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="Slide Login Form template Responsive, Login form web template, Flat Pricing tables, Flat Drop downs Sign up Web Templates, Flat Web Templates, Login sign up Responsive web template, SmartPhone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

  <script>
    addEventListener("load", function () {
      setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
      window.scrollTo(0, 1);
    }
  </script>

  <style type="text/css">
  .switch {
   position: relative;
   display: inline-block;
   width: 60px;
   height: 34px;
 }

 .switch input {
   opacity: 0;
   width: 0;
   height: 0;
 }

 .slider {
   position: absolute;
   cursor: pointer;
   top: 0;
   left: 0;
   right: 0;
   bottom: 0;
   background-color: #ccc;
   -webkit-transition: .4s;
   transition: .4s;
 }

 .slider:before {
   position: absolute;
   content: "";
   height: 26px;
   width: 26px;
   left: 4px;
   bottom: 4px;
   background-color: white;
   -webkit-transition: .4s;
   transition: .4s;
 }

 input:checked + .slider {
   background-color: #2196F3;
 }

 input:focus + .slider {
   box-shadow: 0 0 1px #2196F3;
 }

 input:checked + .slider:before {
   -webkit-transform: translateX(26px);
   -ms-transform: translateX(26px);
   transform: translateX(26px);
 }

 /* Rounded sliders */
 .slider.round {
   border-radius: 34px;
 }

 .slider.round:before {
   border-radius: 50%;
 }

 #popup {
 width: 350px;
    height: 46px;
    border-radius: 25px;
    background: #ffb;
    padding: 10px;
    border: 2px solid #999;
    position: absolute;
    top: 151px;
    left: 582px;
}
h1
{
 text-shadow: 2px 2px #1b3b48;
}
</style>
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
<link href="//fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet">
</head>
<body>
  <?php 
  include("html/AdminHeader.php");  
  ?>
  <!-- add new user form -->
  <div class="w5layouts-main"> 
    <div class="updateprofile-layer">
      <h1 style="color:white;">Add New User</h1>
      <div class="header-main1">  
        <div class="header-left-bottom">
          <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">	

            <div class="icon1">
              <span class="fa fa-user"></span>
              <input type="text" placeholder="First Name" name="fname" required=""/>
            </div>	

            <div class="icon1">
              <span class="fa fa-user"></span>
              <input type="text" placeholder="Last Name" name="lname"  "required=""/>
            </div>	

            <div class="icon1">
              <span class="fa fa-user"></span>
              <input type="email" placeholder="Email Address" name="email"  required=""/>
            </div>

            <div class="icon1">
              <span class="fa fa-user"></span>
              <input type="password" placeholder="Password" name="password"  required=""/>
            </div>  

            <div class="icon1">
              <span class="fa fa-user"></span>
              <input type="file" name="profile" />
            </div>  

            <div class="icon1">
              <span class="fa fa-user"></span>
              Gender :<input type="radio" name="gender" value="male" > Male
              <input type="radio" name="gender" value="female"> Female
              <br>
            </div>

            <label class="switch">
              <input type="checkbox" name="userstatus" value="1">
              <span class="slider round"></span><br>
            </label>	


            <div class="bottom">
              <input  type="submit" class="btn" name="createuser" value="Create" />
            </div><br>
          </form>	
        </div>			
      </div>	
    </div>
  </div>	
    <!--  // add new user form -->

  <?php

  if(isset($_POST["createuser"])) // on submit extact above orm details
  {
    $function = new Operation();
    $userFname=$_POST['fname'];
    $userLname=$_POST['lname'];
    $userEmail=$_POST['email'] ; 
    $userPassword=$_POST['password'];
    $userGender=$_POST['gender'];
    $userStatus = $_POST['userstatus'];
    $uploaddir = '../images/Profile_Images/';
    $uploadfile = $uploaddir . basename($_FILES['profile']['name'].time());

    error_reporting(E_ALL);
    echo "<p>";
    if (move_uploaded_file($_FILES['profile']['tmp_name'], $uploadfile)) // upload user image
    {

    }
    else {
     echo "Upload failed";
   }

   echo "</p>";
  
   
   $result = $function->insert('user',array('user_fname','user_lname','user_email','user_password','user_image','user_status','user_gender'),array("'$userFname'", "'$userLname'","'$userEmail'","'$userPassword'","'$uploadfile'","'$userStatus'","'$userGender'"));
   // $result = $function->insert('user',array('user_fname','user_lname','user_email','user_password','user_image','user_status','user_gender'),array("'"$_POST['fname']"'", "'"$_POST['lname']"'","'"$_POST['email']"'","'"$_POST['password']"'","'$imagePath'","'"$_POST['userstatus']"'","'"$_POST['gender']"'"));
   
    if($result === TRUE)
    {?>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>          
      <div id="popup"><?php echo $userFname." ".$userLname." "; ?>SUCCESSFULLY ADDED</div>
      <script>history.pushState({}, "", "")</script>
      <script type="text/javascript">
        $(function() {
         $('#popup').delay(3000).fadeOut();
       });
     </script>
   <?php
    }
    else
    {
    
    } 
  
 }

 ?>
</body>
</html>